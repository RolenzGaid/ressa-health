<?php
/**
 * Styles and scripts.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

/**
 * Google Fonts URL for the two brand faces.
 *
 * Lora carries the display voice, Montserrat the interface voice.
 *
 * @return string
 */
function ressa_fonts_url() {
	return add_query_arg(
		array(
			'family' => implode(
				'&family=',
				array(
					'Lora:ital,wght@0,400..700;1,400..700',
					'Montserrat:ital,wght@0,300..900;1,300..900',
				)
			),
			'display' => 'swap',
		),
		'https://fonts.googleapis.com/css2'
	);
}

/**
 * Front-end assets.
 */
function ressa_enqueue_assets() {
	wp_enqueue_style( 'ressa-fonts', ressa_fonts_url(), array(), null );

	wp_enqueue_style(
		'ressa-main',
		RESSA_URI . '/assets/css/main.css',
		array( 'ressa-fonts' ),
		ressa_asset_version( '/assets/css/main.css' )
	);

	wp_enqueue_script(
		'ressa-main',
		RESSA_URI . '/assets/js/main.js',
		array(),
		ressa_asset_version( '/assets/js/main.js' ),
		true
	);

	wp_script_add_data( 'ressa-main', 'strategy', 'defer' );

	wp_localize_script(
		'ressa-main',
		'ressaTheme',
		array(
			'reduceMotionNotice' => __( 'Animations are reduced based on your system preference.', 'ressa-health' ),
		)
	);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'ressa_enqueue_assets' );

/**
 * Cache-busting version based on file mtime, falling back to the theme version.
 *
 * @param string $relative_path Path relative to the theme root.
 * @return string
 */
function ressa_asset_version( $relative_path ) {
	$file = RESSA_DIR . $relative_path;

	return file_exists( $file ) ? (string) filemtime( $file ) : RESSA_VERSION;
}

/**
 * Admin assets — the media picker used by the theme's meta boxes.
 *
 * @param string $hook Current admin page.
 */
function ressa_admin_assets( $hook ) {
	if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) ) {
		return;
	}

	$screen = get_current_screen();

	if ( ! $screen || ! in_array( $screen->post_type, array_keys( ressa_post_types() ), true ) ) {
		return;
	}

	wp_enqueue_media();

	wp_enqueue_style(
		'ressa-admin',
		RESSA_URI . '/assets/css/admin.css',
		array(),
		ressa_asset_version( '/assets/css/admin.css' )
	);

	wp_enqueue_script(
		'ressa-admin',
		RESSA_URI . '/assets/js/admin.js',
		array( 'jquery' ),
		ressa_asset_version( '/assets/js/admin.js' ),
		true
	);
}
add_action( 'admin_enqueue_scripts', 'ressa_admin_assets' );
