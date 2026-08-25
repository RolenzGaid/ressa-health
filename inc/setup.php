<?php
/**
 * Theme setup.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register theme supports, menus and image sizes.
 */
function ressa_setup() {
	load_theme_textdomain( 'ressa-health', RESSA_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'wp-block-styles' );
	add_theme_support( 'custom-line-height' );
	add_theme_support( 'custom-spacing' );

	add_theme_support(
		'html5',
		array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script', 'navigation-widgets' )
	);

	add_theme_support(
		'custom-logo',
		array(
			'height'      => 48,
			'width'       => 190,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	add_editor_style( 'assets/css/main.css' );

	register_nav_menus(
		array(
			'primary' => __( 'Primary Navigation', 'ressa-health' ),
		)
	);

	// Crops used by the front page media slots.
	add_image_size( 'ressa-card', 720, 405, true );      // 16:9 feature + step media.
	add_image_size( 'ressa-portrait', 640, 747, true );  // Story carousel video posters.
	add_image_size( 'ressa-member', 560, 420, true );    // 4:3 team portraits.
}
add_action( 'after_setup_theme', 'ressa_setup' );

/**
 * Content width used by embeds.
 */
function ressa_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'ressa_content_width', 820 );
}
add_action( 'after_setup_theme', 'ressa_content_width', 0 );

/**
 * Register widget areas.
 */
function ressa_widgets_init() {
	register_sidebar(
		array(
			'name'          => __( 'Blog Sidebar', 'ressa-health' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Shown beside posts and the blog archive.', 'ressa-health' ),
			'before_widget' => '<section id="%1$s" class="rh-widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'ressa_widgets_init' );

/**
 * Adds a `no-js` class that main.js immediately removes, so CSS can provide a
 * safe non-animated fallback when scripting is unavailable.
 *
 * @param string[] $classes Body classes.
 * @return string[]
 */
function ressa_body_classes( $classes ) {
	$classes[] = 'no-js';

	if ( is_front_page() ) {
		$classes[] = 'rh-front';
	}

	return $classes;
}
add_filter( 'body_class', 'ressa_body_classes' );

/**
 * Preconnect to the Google Fonts hosts so the brand faces paint sooner.
 *
 * @param array  $urls           Resource hints.
 * @param string $relation_type  Hint type.
 * @return array
 */
function ressa_resource_hints( $urls, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array( 'href' => 'https://fonts.googleapis.com' );
		$urls[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'ressa_resource_hints', 10, 2 );

/**
 * Trim the default excerpt and give it a typographic ellipsis.
 *
 * @return string
 */
function ressa_excerpt_more() {
	return '&hellip;';
}
add_filter( 'excerpt_more', 'ressa_excerpt_more' );
