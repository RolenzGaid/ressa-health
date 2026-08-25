/**
 * Customizer preview bindings.
 */
(function ($) {
	'use strict';

	wp.customize('hero_title', function (value) {
		value.bind(function (to) {
			$('.rh-hero__title').html(to);
		});
	});

	wp.customize('blogname', function (value) {
		value.bind(function (to) {
			$('.rh-brand__text > span').first().text(to);
		});
	});
})(jQuery);
