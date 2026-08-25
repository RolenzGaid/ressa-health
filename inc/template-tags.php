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
 * Placeholder brand mark: concentric rings reading as layered data.
 *
 * @return string
 */
function ressa_brand_mark() {
	return '<svg class="rh-brand__mark" viewBox="0 0 32 32" aria-hidden="true" focusable="false">
		<circle cx="16" cy="16" r="14.2" fill="none" stroke="currentColor" stroke-width="1.5" opacity="0.35"/>
		<circle cx="16" cy="16" r="9.2" fill="none" stroke="currentColor" stroke-width="1.5" opacity="0.6"/>
		<circle cx="16" cy="16" r="4.2" fill="currentColor"/>
		<path d="M16 1.8A14.2 14.2 0 0 1 30.2 16" fill="none" stroke="#f6c445" stroke-width="2.6" stroke-linecap="round"/>
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
 * Placeholder footer column links.
 *
 * @param string $location Menu location key.
 */
function ressa_fallback_footer_menu( $location ) {
	$columns = array(
		'footer_one'   => array(
			'#steps'    => __( 'How It Works', 'ressa-health' ),
			'#layers'   => __( 'The Seven Layers', 'ressa-health' ),
			'#features' => __( 'The Platform', 'ressa-health' ),
			'#compare'  => __( 'Pricing', 'ressa-health' ),
		),
		'footer_two'   => array(
			'#team'  => __( 'Medical Team', 'ressa-health' ),
			'#trust' => __( 'Our Promises', 'ressa-health' ),
			'#faq'   => __( 'FAQ', 'ressa-health' ),
			'#start' => __( 'Get Started', 'ressa-health' ),
		),
		'footer_three' => array(
			'#stories' => __( 'Member Stories', 'ressa-health' ),
			'#faq'     => __( 'Learn', 'ressa-health' ),
			'#team'    => __( 'Find a Practitioner', 'ressa-health' ),
			'#start'   => __( 'Contact', 'ressa-health' ),
		),
	);

	if ( ! isset( $columns[ $location ] ) ) {
		return;
	}

	echo '<ul class="rh-footer__menu">';

	foreach ( $columns[ $location ] as $url => $label ) {
		printf( '<li><a href="%s">%s</a></li>', esc_url( $url ), esc_html( $label ) );
	}

	echo '</ul>';
}

/**
 * Render a comparison table tick or dash.
 *
 * @param string $state 'yes' or 'no'.
 */
function ressa_compare_mark( $state ) {
	$yes = ( 'yes' === $state );

	printf(
		'<span class="rh-compare__mark rh-compare__mark--%s">%s<span class="screen-reader-text">%s</span></span>',
		$yes ? 'yes' : 'no',
		$yes
			? ressa_icon( 'check' ) // phpcs:ignore WordPress.Security.EscapeOutput
			: '<svg class="rh-icon" viewBox="0 0 24 24" aria-hidden="true" focusable="false"><path d="M7 12h10"/></svg>',
		$yes ? esc_html__( 'Included', 'ressa-health' ) : esc_html__( 'Not included', 'ressa-health' )
	);
}
