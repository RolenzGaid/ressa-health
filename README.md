# Ressa Health — WordPress Theme

A custom, fully responsive WordPress theme built to the Ressa Health landing page design.
Every section of the front page is editable in WordPress; nothing is hard-coded into the templates.

![Ressa Health theme](screenshot.png)

---

## Requirements

| | |
|---|---|
| WordPress | 6.0+ |
| PHP | 7.4+ |
| Node (build only) | 18+ |

No plugins are required. The theme has no third-party runtime dependencies — no jQuery on the
front end, no carousel library, no animation library, no CDN assets other than Google Fonts.

## Install

1. Copy this folder into `wp-content/themes/ressa-health` (or upload the zip via **Appearance → Themes → Add New**).
2. Activate **Ressa Health**.
3. Create a page and set it as the static front page under **Settings → Reading**, or leave the
   front page as the blog — `front-page.php` renders the landing page either way.

On activation the theme already renders the full design using the bundled starter content, so
there is no empty-state to configure before it looks right.

---

## Editing the content

### Headlines, intro copy and buttons — Appearance → Customize

Everything lives under the **Ressa Health Content** panel, one section per band of the page:

* Brand & Header, Hero, The Problem, Statement, Seven Layers, How It Works, The Output,
  Platform Features, Comparison, Member Stories, Medical Team, Trust, FAQ, Closing CTA, Footer.
* **Section Visibility** switches any band of the front page on or off.

Headline fields accept a small set of inline tags so the two-tone lockups from the design can be
authored directly:

```html
Everyone else reads one layer.<br><em>We read seven.</em>
```

`<em>` renders as the bold italic serif, `<strong>` as bold, and `<br>` forces the line break.
Anything else is stripped on save.

### Repeating content — the “Front Page” admin menu

Each repeating group is a custom post type with its own fields. Drag the **Order** value
(Page Attributes → Order) to control sequence.

| Group | Drives | Notes |
|---|---|---|
| Data Layers | The “We read seven” tabs and wheel | Order = order around the wheel. Featured image fills the wheel slice; the bundled photograph is used until one is set, then the accent colour as a last resort. |
| Process Steps | Test → Analyze → Act | The short *rail label* is the pill text; the *step label* is the “Step 01” line. |
| — | — | Each step's featured image fills the media frame above its copy. |
| Platform Features | The six-card grid | Featured image is the card visual. |
| Member Stories | The story carousel | Choose **Video** or **Pull quote** per slide. Video slides play muted on hover. |
| Team Members | The medical team row | Featured image is the portrait. |
| Comparison Rows | The comparison table | Two dropdowns per row: tick, tilde (partial) or cross. |
| Trust Promises | The four mint cards | |
| FAQs | The accordion | |

Menus: **Appearance → Menus** provides a *Primary* location for the masthead. Until a menu is
assigned, the header falls back to the navigation shown in the design.

Logo: **Appearance → Customize → Site Identity** replaces the placeholder brand mark.

---

## The three signature interactions

**Seven-layer tabs.** Selecting a tab cross-fades the copy panel and blooms that layer's slice of
the wheel open from the centre. Slices accumulate as you move along the tabs, so by Clinical Data
the wheel is a complete pie of all seven photographs; stepping back peels them away again. Each
photograph is clipped to its own slice rather than cropped out of one image spanning the wheel, and
the spoke separators are drawn twice — dark beneath the slices where they read against the empty
wheel, light above them where they part two photographs — so neither pass needs any state. Full
keyboard support (arrow keys, Home/End) and correct `role="tablist"` semantics. Clicking a label on
the wheel itself also selects that layer.

**Test → Analyze → Act.** The “Works with the data you already have” band pins to the viewport and
plays as a four-stage sequence: the section's own heading holds the first screenful, then Test,
Analyze and Act each take a turn as the page scrolls — forwards and backwards. The connector
between two pills fills with the scroll progress of the step on its left, and reaching the far side
is what promotes the next pill. Below 992px — and whenever reduced motion is requested — the pin is
dropped and the intro and all three steps simply stack.

**Story carousel.** A dependency-free slider with pointer dragging, keyboard arrows, dots and
disabled-state arrows. The track keeps the container's left gutter and runs on past the right edge
of the page, showing part of the next card; paging is clamped so the last page lands flush rather
than over-scrolling into empty space. Video slides start muted and play on hover or keyboard focus,
and pause on leave; the play button toggles them on touch devices. Off-screen slides are removed
from the tab order.

## Motion

Reveals, staggered entrances, parallax and hover states are all built on one shared
`requestAnimationFrame` scroll loop and a single `IntersectionObserver`.

`prefers-reduced-motion: reduce` is respected globally: transforms are neutralised, animations are
collapsed, the pinned step sequence becomes a plain stack, and smooth scrolling is turned off.
With JavaScript disabled the page renders complete and readable — the `no-js` class guarantees
every revealed element starts visible.

---

## Working on the styles

Styles are authored in SCSS under `assets/scss` and compiled to `assets/css/main.css`, which is the
file WordPress enqueues. `style.css` carries only the theme header.

```bash
npm install
npm run dev:css     # watch
npm run build:css   # compressed production build
```

```
assets/scss
├── abstracts/   tokens and mixins
├── base/        reset, root custom properties, typography, animation primitives
├── layout/      container scale, header, back-to-top
├── components/  buttons, pills, media frames, WordPress core markup
└── sections/    one partial per band of the front page
```

Design tokens live in `abstracts/_variables.scss` and are mirrored onto `:root` in
`base/_root.scss`, so the same palette is available to the block editor and to inline styles.

The palette is deliberately small:

| Token | Value | Used for |
|---|---|---|
| `$c-teal-500` | `#118c8c` | every green on the page — eyebrows, ticks, active states, the wheel |
| `$c-teal-800` | `#0c6363` | the closing CTA band only |
| `$c-yellow-500` | `#f2bb16` | every button, always with white text |
| `$c-surface` | `#ffffff` | the page, and all but two sections |
| `$c-surface-alt` | `#fafaf7` | How It Works and How We Compare |
| `$c-mint-200` | `#eaf5f4` | pull-quote cards, the highlighted comparison column |

## Template map

```
front-page.php              renders the sections in order, honouring the visibility toggles
template-parts/sections/    one partial per band
template-parts/content/     story card, entry card, phone demo
inc/fields.php              the single schema that drives post types, meta boxes and the Customizer
inc/defaults.php            bundled starter content
inc/content.php             the accessors templates use
inc/svg.php                 icon set plus the generated wheel and orbit illustrations
inc/template-tags.php       section heads, buttons, pills, brand lockup
```

Adding an editable field anywhere means adding one array entry to `inc/fields.php`; the meta box,
the sanitiser and the Customizer control are all generated from it.

## Artwork shipped with the theme

`assets/img/` holds the supplied photography, used as the starting state for the seven wheel
slices, the clinician row, the story carousel posters and The Output. Setting a featured image (or
the Customizer's phone screenshot) overrides the bundled file — nothing needs to be deleted first.

The rest are neutral stand-ins meant to be replaced:

* Flat colour media frames for feature and step images — these match the comp, and become real
  images as soon as a featured image is set.
* A line-icon set in `inc/svg.php` (`ressa_icon_paths()`), used for the orbit diagram, feature
  frames and UI affordances.
* A generated brand mark in `ressa_brand_mark()`.
* `assets/media/story-placeholder.mp4`, an abstract 4-second clip used by story cards that have no
  video yet, so the hover-to-play behaviour is demonstrable out of the box.

## Accessibility

Landmark elements and a skip link, `aria-labelledby` on every section, real `tablist` /
`tabpanel` / `region` semantics, visible focus rings, `screen-reader-text` labels on every
icon-only control, and a comparison table built from `<th scope>` with a caption.

## Notes

* This is a landing page: it ends on the closing call to action and has no footer band. `footer.php`
  only closes the document and renders the back-to-top control.
* The hero is sized so the masthead plus the hero come to exactly one viewport height.
* `.preview/` contains the local render harness used to check the build against the comp. It is not
  part of the theme and is excluded from version control.
