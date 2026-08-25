/**
 * Ressa Health — front-end behaviour.
 *
 * Everything here is progressive enhancement: the page is complete and
 * readable without it, and every motion effect is skipped when the visitor has
 * asked for reduced motion.
 */
(function () {
	'use strict';

	var reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)');
	var scrollHandlers = [];
	var scrollTicking = false;

	// ---------------------------------------------------------------------
	// Helpers
	// ---------------------------------------------------------------------
	function $(selector, scope) {
		return (scope || document).querySelector(selector);
	}

	function $$(selector, scope) {
		return Array.prototype.slice.call((scope || document).querySelectorAll(selector));
	}

	function clamp(value, min, max) {
		return Math.min(max, Math.max(min, value));
	}

	function prefersReducedMotion() {
		return reduceMotion.matches;
	}

	/** Registers a callback driven by one shared rAF-throttled scroll loop. */
	function onScroll(handler) {
		scrollHandlers.push(handler);
	}

	function runScrollHandlers() {
		scrollTicking = false;

		for (var i = 0; i < scrollHandlers.length; i++) {
			scrollHandlers[i]();
		}
	}

	function requestScrollTick() {
		if (!scrollTicking) {
			scrollTicking = true;
			window.requestAnimationFrame(runScrollHandlers);
		}
	}

	function debounce(fn, wait) {
		var timer;

		return function () {
			var context = this;
			var args = arguments;

			window.clearTimeout(timer);
			timer = window.setTimeout(function () {
				fn.apply(context, args);
			}, wait || 150);
		};
	}

	// ---------------------------------------------------------------------
	// Scroll reveals
	// ---------------------------------------------------------------------
	function initReveal() {
		var targets = $$('[data-rh-reveal]');

		if (!targets.length) {
			return;
		}

		if (!('IntersectionObserver' in window) || prefersReducedMotion()) {
			targets.forEach(function (el) {
				el.classList.add('is-revealed');
			});
			return;
		}

		var observer = new IntersectionObserver(
			function (entries) {
				entries.forEach(function (entry) {
					if (!entry.isIntersecting) {
						return;
					}

					entry.target.classList.add('is-revealed');
					observer.unobserve(entry.target);
				});
			},
			{ rootMargin: '0px 0px -8% 0px', threshold: 0.08 }
		);

		targets.forEach(function (el) {
			observer.observe(el);
		});
	}

	/** Kicks the orbit illustration's draw-in the first time it is seen. */
	function initOrbit() {
		var orbits = $$('[data-rh-orbit]');

		if (!orbits.length) {
			return;
		}

		if (!('IntersectionObserver' in window)) {
			orbits.forEach(function (el) {
				el.classList.add('is-active');
			});
			return;
		}

		var observer = new IntersectionObserver(
			function (entries) {
				entries.forEach(function (entry) {
					if (entry.isIntersecting) {
						entry.target.classList.add('is-active');
						observer.unobserve(entry.target);
					}
				});
			},
			{ threshold: 0.25 }
		);

		orbits.forEach(function (el) {
			observer.observe(el);
		});
	}

	// ---------------------------------------------------------------------
	// Header state, scroll progress, back to top
	// ---------------------------------------------------------------------
	function initHeader() {
		var header = $('[data-rh-header]');
		var toTop = $('[data-rh-to-top]');

		if (!header && !toTop) {
			return;
		}

		function update() {
			var y = window.pageYOffset || document.documentElement.scrollTop;

			if (header) {
				header.classList.toggle('is-stuck', y > 12);
			}

			if (toTop) {
				toTop.classList.toggle('is-visible', y > window.innerHeight * 0.9);
			}
		}

		onScroll(update);
		update();

		if (toTop) {
			toTop.addEventListener('click', function () {
				window.scrollTo({
					top: 0,
					behavior: prefersReducedMotion() ? 'auto' : 'smooth'
				});
			});
		}
	}

	// ---------------------------------------------------------------------
	// Mobile drawer
	// ---------------------------------------------------------------------
	function initDrawer() {
		var burger = $('[data-rh-burger]');
		var drawer = $('[data-rh-drawer]');

		if (!burger || !drawer) {
			return;
		}

		drawer.removeAttribute('hidden');

		$$('.rh-drawer__list > li', drawer).forEach(function (item, index) {
			item.style.setProperty('--stagger-index', index);
		});

		function setOpen(open) {
			burger.setAttribute('aria-expanded', open ? 'true' : 'false');
			drawer.classList.toggle('is-open', open);
			document.body.classList.toggle('rh-drawer-open', open);
		}

		burger.addEventListener('click', function () {
			setOpen(burger.getAttribute('aria-expanded') !== 'true');
		});

		drawer.addEventListener('click', function (event) {
			if (event.target.closest('a')) {
				setOpen(false);
			}
		});

		document.addEventListener('keydown', function (event) {
			if ('Escape' === event.key && drawer.classList.contains('is-open')) {
				setOpen(false);
				burger.focus();
			}
		});

		window.addEventListener(
			'resize',
			debounce(function () {
				if (window.innerWidth >= 992) {
					setOpen(false);
				}
			})
		);
	}

	// ---------------------------------------------------------------------
	// Seven layers — tabs drive the wheel
	// ---------------------------------------------------------------------
	function initLayers() {
		var root = $('[data-rh-layers]');

		if (!root) {
			return;
		}

		var tabs = $$('[data-layer-index]', root);
		var panels = $$('.rh-layers__panel', root);
		var wedges = $$('[data-wheel-slice]', root);
		var dots = $$('[data-wheel-dot]', root);
		var labels = $$('[data-wheel-label]', root);

		if (!tabs.length) {
			return;
		}

		var current = -1;

		function select(index, focusTab) {
			index = clamp(index, 0, tabs.length - 1);

			if (index === current) {
				return;
			}

			current = index;

			tabs.forEach(function (tab, i) {
				var active = i === index;

				tab.setAttribute('aria-selected', active ? 'true' : 'false');
				tab.setAttribute('tabindex', active ? '0' : '-1');
			});

			panels.forEach(function (panel, i) {
				var active = i === index;

				panel.hidden = !active;
				panel.classList.remove('is-entering');

				if (active && !prefersReducedMotion()) {
					// Force a reflow so the entrance animation restarts cleanly.
					void panel.offsetWidth;
					panel.classList.add('is-entering');
				}
			});

			[wedges, dots, labels].forEach(function (group) {
				group.forEach(function (node, i) {
					node.classList.toggle('is-active', i === index);
				});
			});

			if (focusTab) {
				tabs[index].focus();

				// Keep the active tab visible in the horizontally scrolling strip.
				if (tabs[index].scrollIntoView) {
					tabs[index].scrollIntoView({
						behavior: prefersReducedMotion() ? 'auto' : 'smooth',
						block: 'nearest',
						inline: 'center'
					});
				}
			}
		}

		tabs.forEach(function (tab, index) {
			tab.addEventListener('click', function () {
				select(index, false);
			});

			tab.addEventListener('keydown', function (event) {
				var map = {
					ArrowRight: index + 1,
					ArrowLeft: index - 1,
					Home: 0,
					End: tabs.length - 1
				};

				if (!(event.key in map)) {
					return;
				}

				event.preventDefault();

				var next = map[event.key];

				if (next < 0) {
					next = tabs.length - 1;
				} else if (next >= tabs.length) {
					next = 0;
				}

				select(next, true);
			});
		});

		// Clicking a wheel label selects its tab.
		labels.forEach(function (label, index) {
			label.addEventListener('click', function () {
				select(index, false);
			});
		});

		select(0, false);
	}

	// ---------------------------------------------------------------------
	// How it works — one step at a time, driven by scroll position
	// ---------------------------------------------------------------------
	function initSteps() {
		var scroller = $('[data-rh-steps]');

		if (!scroller) {
			return;
		}

		var sticky = $('.rh-steps__sticky', scroller);
		var panels = $$('[data-step-panel]', scroller);
		var rails = $$('[data-step-index]', scroller);
		var links = $$('[data-step-link]', scroller);

		if (!sticky || !panels.length) {
			return;
		}

		var current = -1;

		function setIndex(index, fill) {
			if (index !== current) {
				current = index;

				panels.forEach(function (panel, i) {
					panel.classList.toggle('is-current', i === index);
					panel.classList.toggle('is-past', i < index);
				});

				rails.forEach(function (rail, i) {
					rail.setAttribute('aria-selected', i === index ? 'true' : 'false');
					rail.setAttribute('tabindex', i === index ? '0' : '-1');
					rail.classList.toggle('is-done', i < index);
				});
			}

			// The connector to the right of the current pill grows with that
			// step's own progress; connectors behind it are already complete.
			links.forEach(function (link, i) {
				var value = i < index ? 1 : i === index ? fill : 0;

				link.style.setProperty('--link-fill', value.toFixed(3));
			});
		}

		/** True when the pinned behaviour is active for the current viewport. */
		function isPinned() {
			return window.innerWidth >= 992 && !prefersReducedMotion();
		}

		function update() {
			if (!isPinned()) {
				// Stacked layout: every step is visible, so the rail is a plain
				// jump list rather than a progress indicator.
				setIndex(0, 0);
				panels.forEach(function (panel) {
					panel.classList.add('is-current');
					panel.classList.remove('is-past');
				});
				return;
			}

			var total = scroller.offsetHeight - sticky.offsetHeight;

			if (total <= 0) {
				return;
			}

			var stickyTop = parseFloat(window.getComputedStyle(sticky).top) || 0;
			var scrolled = clamp(stickyTop - scroller.getBoundingClientRect().top, 0, total);
			var progress = scrolled / total;
			var raw = progress * panels.length;
			var index = clamp(Math.floor(raw), 0, panels.length - 1);

			setIndex(index, clamp(raw - index, 0, 1));
		}

		onScroll(update);
		window.addEventListener('resize', debounce(update));
		update();

		// The rail doubles as a jump control.
		rails.forEach(function (rail, index) {
			rail.addEventListener('click', function () {
				if (!isPinned()) {
					panels[index].scrollIntoView({
						behavior: prefersReducedMotion() ? 'auto' : 'smooth',
						block: 'center'
					});
					return;
				}

				var total = scroller.offsetHeight - sticky.offsetHeight;
				var target =
					scroller.getBoundingClientRect().top +
					window.pageYOffset +
					(total * (index + 0.5)) / panels.length;

				window.scrollTo({
					top: target,
					behavior: prefersReducedMotion() ? 'auto' : 'smooth'
				});
			});
		});
	}

	// ---------------------------------------------------------------------
	// Story carousel
	// ---------------------------------------------------------------------
	function initSliders() {
		$$('[data-rh-slider]').forEach(function (slider) {
			var viewport = $('[data-slider-viewport]', slider);
			var track = $('[data-slider-track]', slider);
			var slides = $$('.rh-slider__slide', track);
			var prev = $('[data-slider-prev]', slider);
			var next = $('[data-slider-next]', slider);
			var dotsWrap = $('[data-slider-dots]', slider);

			if (!track || !slides.length) {
				return;
			}

			var index = 0;
			var perView = 1;
			var maxIndex = 0;
			var dots = [];

			function slidesPerView() {
				var width = window.innerWidth;

				if (width >= 992) {
					return parseInt(slider.dataset.slidesLg, 10) || 3;
				}

				if (width >= 640) {
					return parseInt(slider.dataset.slidesMd, 10) || 2;
				}

				return parseInt(slider.dataset.slidesSm, 10) || 1;
			}

			function gapSize() {
				return parseFloat(window.getComputedStyle(track).columnGap || '0') || 0;
			}

			function buildDots() {
				if (!dotsWrap) {
					return;
				}

				dotsWrap.innerHTML = '';
				dots = [];

				for (var i = 0; i <= maxIndex; i++) {
					var dot = document.createElement('button');

					dot.type = 'button';
					dot.className = 'rh-slider__dot';
					dot.setAttribute('aria-label', 'Go to slide ' + (i + 1));
					dot.addEventListener('click', createDotHandler(i));

					dotsWrap.appendChild(dot);
					dots.push(dot);
				}
			}

			function createDotHandler(target) {
				return function () {
					goTo(target);
				};
			}

			function layout() {
				perView = slidesPerView();
				maxIndex = Math.max(0, slides.length - perView);

				var gap = gapSize();

				slider.style.setProperty(
					'--slide-basis',
					'calc((100% - ' + (perView - 1) * gap + 'px) / ' + perView + ')'
				);

				buildDots();
				goTo(Math.min(index, maxIndex), true);
			}

			function goTo(target, immediate) {
				index = clamp(target, 0, maxIndex);

				var slideWidth = slides[0].getBoundingClientRect().width + gapSize();

				if (immediate) {
					track.style.transition = 'none';
				}

				track.style.transform = 'translate3d(' + -index * slideWidth + 'px, 0, 0)';

				if (immediate) {
					void track.offsetWidth;
					track.style.transition = '';
				}

				if (prev) {
					prev.disabled = index === 0;
				}

				if (next) {
					next.disabled = index >= maxIndex;
				}

				dots.forEach(function (dot, i) {
					dot.setAttribute('aria-current', i === index ? 'true' : 'false');
				});

				// Slides scrolled out of view must not be reachable by keyboard.
				slides.forEach(function (slide, i) {
					var visible = i >= index && i < index + perView;

					slide.setAttribute('aria-hidden', visible ? 'false' : 'true');
					$$('a, button, video', slide).forEach(function (node) {
						if (visible) {
							node.removeAttribute('tabindex');
						} else {
							node.setAttribute('tabindex', '-1');
						}
					});
				});
			}

			if (prev) {
				prev.addEventListener('click', function () {
					goTo(index - 1);
				});
			}

			if (next) {
				next.addEventListener('click', function () {
					goTo(index + 1);
				});
			}

			// Pointer dragging.
			var dragStartX = 0;
			var dragging = false;

			function onPointerDown(event) {
				if (event.pointerType === 'mouse' && event.button !== 0) {
					return;
				}

				dragging = true;
				dragStartX = event.clientX;
				track.classList.add('is-dragging');
			}

			function onPointerUp(event) {
				if (!dragging) {
					return;
				}

				dragging = false;
				track.classList.remove('is-dragging');

				var delta = event.clientX - dragStartX;
				var threshold = Math.max(40, slides[0].getBoundingClientRect().width * 0.18);

				if (delta < -threshold) {
					goTo(index + 1);
				} else if (delta > threshold) {
					goTo(index - 1);
				} else {
					goTo(index);
				}
			}

			if (viewport && window.PointerEvent) {
				viewport.addEventListener('pointerdown', onPointerDown);
				window.addEventListener('pointerup', onPointerUp);
				window.addEventListener('pointercancel', function () {
					dragging = false;
					track.classList.remove('is-dragging');
				});

				// Suppress the click that follows a drag.
				viewport.addEventListener('dragstart', function (event) {
					event.preventDefault();
				});
			}

			slider.addEventListener('keydown', function (event) {
				if ('ArrowRight' === event.key) {
					event.preventDefault();
					goTo(index + 1);
				} else if ('ArrowLeft' === event.key) {
					event.preventDefault();
					goTo(index - 1);
				}
			});

			window.addEventListener('resize', debounce(layout));
			layout();
		});
	}

	// ---------------------------------------------------------------------
	// Story videos — play on hover, focus or tap
	// ---------------------------------------------------------------------
	function initStoryVideos() {
		$$('[data-rh-story]').forEach(function (story) {
			var video = $('[data-story-video]', story);
			var toggle = $('[data-story-toggle]', story);

			function play() {
				if (!video) {
					return;
				}

				video.muted = true;

				var attempt = video.play();

				if (attempt && typeof attempt.catch === 'function') {
					// Autoplay can still be refused; leave the poster in place.
					attempt.catch(function () {
						story.classList.remove('is-playing');
					});
				}

				story.classList.add('is-playing');
			}

			function stop() {
				if (!video) {
					return;
				}

				video.pause();
				story.classList.remove('is-playing');
			}

			if (video) {
				story.addEventListener('mouseenter', play);
				story.addEventListener('mouseleave', stop);
				story.addEventListener('focusin', play);
				story.addEventListener('focusout', function (event) {
					if (!story.contains(event.relatedTarget)) {
						stop();
					}
				});
			}

			if (toggle) {
				toggle.addEventListener('click', function () {
					if (story.classList.contains('is-playing')) {
						stop();
					} else {
						play();
					}
				});
			}
		});
	}

	// ---------------------------------------------------------------------
	// FAQ accordion
	// ---------------------------------------------------------------------
	function initAccordions() {
		$$('[data-rh-accordion]').forEach(function (accordion) {
			var triggers = $$('.rh-faq__trigger', accordion);

			triggers.forEach(function (trigger) {
				var panel = document.getElementById(trigger.getAttribute('aria-controls'));

				if (!panel) {
					return;
				}

				panel.style.height = '0px';

				trigger.addEventListener('click', function () {
					var isOpen = trigger.getAttribute('aria-expanded') === 'true';

					// One open answer at a time keeps the column from jumping.
					triggers.forEach(function (other) {
						if (other === trigger) {
							return;
						}

						var otherPanel = document.getElementById(other.getAttribute('aria-controls'));

						other.setAttribute('aria-expanded', 'false');

						if (otherPanel) {
							otherPanel.style.height = '0px';
							otherPanel.classList.remove('is-open');
						}
					});

					trigger.setAttribute('aria-expanded', isOpen ? 'false' : 'true');
					panel.classList.toggle('is-open', !isOpen);
					panel.style.height = isOpen ? '0px' : panel.scrollHeight + 'px';
				});
			});

			window.addEventListener(
				'resize',
				debounce(function () {
					triggers.forEach(function (trigger) {
						if (trigger.getAttribute('aria-expanded') !== 'true') {
							return;
						}

						var panel = document.getElementById(trigger.getAttribute('aria-controls'));

						if (panel) {
							panel.style.height = panel.scrollHeight + 'px';
						}
					});
				})
			);
		});
	}

	// ---------------------------------------------------------------------
	// Gentle parallax
	// ---------------------------------------------------------------------
	function initParallax() {
		var targets = $$('[data-rh-parallax]');

		if (!targets.length || prefersReducedMotion()) {
			return;
		}

		function update() {
			var viewportH = window.innerHeight;

			targets.forEach(function (el) {
				var rect = el.getBoundingClientRect();

				if (rect.bottom < -200 || rect.top > viewportH + 200) {
					return;
				}

				var strength = parseFloat(el.dataset.parallaxStrength) || 0.05;
				var centre = rect.top + rect.height / 2 - viewportH / 2;

				el.style.setProperty('--parallax-y', (-centre * strength).toFixed(2) + 'px');
			});
		}

		onScroll(update);
		update();
	}

	// ---------------------------------------------------------------------
	// Boot
	// ---------------------------------------------------------------------
	function init() {
		document.documentElement.classList.remove('no-js');
		document.body.classList.remove('no-js');

		initReveal();
		initOrbit();
		initHeader();
		initDrawer();
		initLayers();
		initSteps();
		initSliders();
		initStoryVideos();
		initAccordions();
		initParallax();

		window.addEventListener('scroll', requestScrollTick, { passive: true });
		window.addEventListener('resize', requestScrollTick, { passive: true });

		// Re-evaluate motion-dependent behaviour if the OS preference changes.
		var onMotionChange = function () {
			requestScrollTick();
		};

		if (typeof reduceMotion.addEventListener === 'function') {
			reduceMotion.addEventListener('change', onMotionChange);
		} else if (typeof reduceMotion.addListener === 'function') {
			reduceMotion.addListener(onMotionChange);
		}
	}

	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', init);
	} else {
		init();
	}
})();
