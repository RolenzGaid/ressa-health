<?php
/**
 * Small markup helpers shared by the templates.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

/**
 * Render a section heading block (eyebrow + display heading + optional lede).
 *
 * @param array $args {
 *     @type string $eyebrow  Eyebrow key or literal text.
 *     @type string $title    Headline HTML.
 *     @type string $lede     Paragraph HTML.
 *     @type string $size     Display size modifier: xl|lg|md|sm.
 *     @type string $align    'center' or 'left'.
 *     @type string $class    Extra classes.
 *     @type string $tag      Heading tag. Default h2.
 *     @type string $id       Optional id for the heading.
 * }
 */
function ressa_section_head( $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'eyebrow' => '',
			'title'   => '',
			'lede'    => '',
			'size'    => 'lg',
			'align'   => 'center',
			'class'   => '',
			'tag'     => 'h2',
			'id'      => '',
			'reveal'  => true,
		)
	);

	$classes = array( 'rh-section-head' );

	if ( 'left' === $args['align'] ) {
		$classes[] = 'rh-section-head--left';
	}

	if ( $args['class'] ) {
		$classes[] = $args['class'];
	}

	$tag    = preg_match( '/^h[1-6]$/', $args['tag'] ) ? $args['tag'] : 'h2';
	$reveal = $args['reveal'] ? ' data-rh-reveal="up" data-rh-stagger' : '';

	printf( '<div class="%s"%s>', esc_attr( implode( ' ', $classes ) ), $reveal ); // phpcs:ignore WordPress.Security.EscapeOutput

	if ( $args['eyebrow'] ) {
		printf(
			'<span class="rh-eyebrow" style="--stagger-index:0">%s</span>',
			wp_kses( $args['eyebrow'], ressa_allowed_inline_html() )
		);
	}

	if ( $args['title'] ) {
		printf(
			'<%1$s class="rh-display rh-display--%2$s"%3$s style="--stagger-index:1">%4$s</%1$s>',
			esc_attr( $tag ),
			esc_attr( $args['size'] ),
			$args['id'] ? ' id="' . esc_attr( $args['id'] ) . '"' : '',
			wp_kses( $args['title'], ressa_allowed_inline_html() )
		);
	}

	if ( $args['lede'] ) {
		printf(
			'<p class="rh-lede%s" style="--stagger-index:2">%s</p>',
			'center' === $args['align'] ? ' rh-lede--center' : '',
			wp_kses( $args['lede'], ressa_allowed_inline_html() )
		);
	}

	echo '</div>';
}

/**
 * Render a button.
 *
 * @param string $label   Button text.
 * @param string $url     Destination.
 * @param array  $args {
 *     @type string $variant primary|teal|ghost|ghost-light.
 *     @type string $icon    Icon key appended after the label.
 *     @type string $class   Extra classes.
 * }
 */
function ressa_button( $label, $url, $args = array() ) {
	$label = trim( wp_strip_all_tags( $label ) );

	if ( '' === $label ) {
		return;
	}

	$args = wp_parse_args(
		$args,
		array(
			'variant' => 'primary',
			'icon'    => '',
			'class'   => '',
			'size'    => '',
		)
	);

	$classes = array( 'rh-btn', 'rh-btn--' . $args['variant'] );

	if ( $args['size'] ) {
		$classes[] = 'rh-btn--' . $args['size'];
	}

	if ( $args['class'] ) {
		$classes[] = $args['class'];
	}

	printf(
		'<a class="%s" href="%s">%s%s</a>',
		esc_attr( implode( ' ', $classes ) ),
		esc_url( $url ? $url : '#' ),
		esc_html( $label ),
		$args['icon'] ? ressa_icon( $args['icon'], array( 'class' => 'rh-icon rh-btn__icon' ) ) : '' // phpcs:ignore WordPress.Security.EscapeOutput
	);
}

/**
 * Render a list of keyword pills.
 *
 * @param string[] $tags     Pill labels.
 * @param string   $modifier Optional pill modifier class, e.g. 'mint'.
 */
function ressa_pills( $tags, $modifier = '' ) {
	if ( empty( $tags ) ) {
		return;
	}

	$class = 'rh-pill' . ( $modifier ? ' rh-pill--' . $modifier : '' );

	echo '<ul class="rh-pills">';

	foreach ( $tags as $tag ) {
		printf(
			'<li><span class="%s">%s</span></li>',
			esc_attr( $class ),
			wp_kses( $tag, ressa_allowed_inline_html() )
		);
	}

	echo '</ul>';
}

/**
 * Open a front page section wrapper.
 *
 * @param string $key   Section key, used for the id and modifier.
 * @param array  $args {
 *     @type string $class   Extra classes.
 *     @type string $tone    Background modifier: cream|cream-deep|white|mint|teal.
 *     @type string $spacing tight|roomy|''.
 *     @type string $label   aria-label for the section.
 * }
 */
function ressa_section_open( $key, $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'class'   => '',
			'tone'    => '',
			'spacing' => '',
			'labelledby' => '',
		)
	);

	$classes = array( 'rh-section', 'rh-' . $key );

	if ( $args['tone'] ) {
		$classes[] = 'rh-section--' . $args['tone'];
	}

	if ( $args['spacing'] ) {
		$classes[] = 'rh-section--' . $args['spacing'];
	}

	if ( $args['class'] ) {
		$classes[] = $args['class'];
	}

	printf(
		'<section id="%s" class="%s"%s>',
		esc_attr( $key ),
		esc_attr( implode( ' ', $classes ) ),
		$args['labelledby'] ? ' aria-labelledby="' . esc_attr( $args['labelledby'] ) . '"' : ''
	);
}

/**
 * Close a front page section wrapper.
 */
function ressa_section_close() {
	echo '</section>';
}

/**
 * Render the site brand lockup.
 *
 * @param string $context 'header' or 'footer'.
 */
function ressa_brand( $context = 'header' ) {
	if ( has_custom_logo() ) {
		the_custom_logo();
		return;
	}

	printf(
		'<a class="rh-brand" href="%s" rel="home">%s<span class="rh-brand__text"><span>%s</span><span>%s</span></span></a>',
		esc_url( home_url( '/' ) ),
		ressa_brand_mark(), // phpcs:ignore WordPress.Security.EscapeOutput -- trusted inline SVG.
		esc_html( ressa_opt( 'brand_name' ) ),
		esc_html( ressa_opt( 'brand_name_alt' ) )
	);

	unset( $context );
}

/**
 * Placeholder brand mark: a small constellation of data points in the two
 * brand colours. Replaced by uploading a logo under Site Identity.
 *
 * @return string
 */
function ressa_brand_mark() {
	return '<svg class="rh-brand__mark" viewBox="0 0 34 34" aria-hidden="true" focusable="false">
		<g fill="#118c8c">
			<circle cx="6" cy="7" r="3.4"/>
			<circle cx="17.5" cy="13" r="4.4"/>
			<circle cx="6.5" cy="19.5" r="2.4"/>
		</g>
		<g fill="#f2bb16">
			<circle cx="7" cy="27.5" r="4"/>
			<circle cx="17" cy="24" r="2.6"/>
		</g>
		<g stroke="#118c8c" stroke-width="1.4" stroke-linecap="round" opacity="0.55">
			<path d="M8.6 8.6 14.4 11.4"/>
			<path d="M8.2 17.6 14.1 15.2"/>
		</g>
	</svg>';
}

/**
 * Post meta line for the blog templates.
 */
function ressa_entry_meta() {
	echo '<div class="rh-entry-meta">';
	printf(
		'<time datetime="%s">%s</time>',
		esc_attr( get_the_date( DATE_W3C ) ),
		esc_html( get_the_date() )
	);

	$categories = get_the_category_list( ', ' );

	if ( $categories ) {
		echo '<span>' . wp_kses_post( $categories ) . '</span>';
	}

	echo '</div>';
}

/**
 * Placeholder primary navigation, shown until a menu is assigned in WordPress.
 *
 * Mirrors the navigation in the approved design so the header is never empty.
 *
 * @param string $class List class.
 */
function ressa_fallback_menu( $class ) {
	$items = array(
		'#steps'   => __( 'How It Works', 'ressa-health' ),
		'#layers'  => __( 'The Seven Sources', 'ressa-health' ),
		'#faq'     => __( 'Learn', 'ressa-health' ),
		'#compare' => __( 'Pricing', 'ressa-health' ),
		'#team'    => __( 'Find a Practitioner', 'ressa-health' ),
	);


	printf( '<ul class="%s">', esc_attr( $class ) );

	$index = 0;

	foreach ( $items as $url => $label ) {
		printf(
			'<li style="--stagger-index:%d"><a href="%s">%s</a></li>',
			(int) $index,
			esc_url( $url ),
			esc_html( $label )
		);
		$index++;
	}

	echo '</ul>';
}

/**
 * Render a comparison table mark.
 *
 * @param string $state 'yes', 'partial' or 'no'.
 */
function ressa_compare_mark( $state ) {
	$states = array(
		'yes'     => array( 'check', __( 'Included', 'ressa-health' ) ),
		'partial' => array( '', __( 'Sometimes, or only in part', 'ressa-health' ) ),
		'no'      => array( 'close', __( 'Not included', 'ressa-health' ) ),
	);

	if ( ! isset( $states[ $state ] ) ) {
		$state = 'no';
	}

	list( $glyph, $label ) = $states[ $state ];

	printf(
		'<span class="rh-compare__mark rh-compare__mark--%s">%s<span class="screen-reader-text">%s</span></span>',
		esc_attr( $state ),
		$glyph
			? ressa_icon( $glyph ) // phpcs:ignore WordPress.Security.EscapeOutput -- trusted inline SVG.
			: '<span class="rh-compare__tilde" aria-hidden="true">&#8764;</span>',
		esc_html( $label )
	);
}
