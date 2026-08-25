<?php
/**
 * Ressa Health theme bootstrap.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

define( 'RESSA_VERSION', '1.0.0' );
define( 'RESSA_DIR', get_template_directory() );
define( 'RESSA_URI', get_template_directory_uri() );

/**
 * Load a theme include.
 *
 * @param string $file Path relative to /inc, without extension.
 */
function ressa_require( $file ) {
	$path = RESSA_DIR . '/inc/' . $file . '.php';

	if ( is_readable( $path ) ) {
		require_once $path;
	}
}

array_map(
	'ressa_require',
	array(
		'setup',        // Theme supports, menus, image sizes, widget areas.
		'enqueue',      // Styles and scripts.
		'fields',       // Field schemas shared by the customizer and meta boxes.
		'post-types',   // Repeatable front page content as custom post types.
		'meta-boxes',   // Generic meta box renderer driven by the field schema.
		'defaults',     // Bundled starter content.
		'content',      // Content accessors used by the templates.
		'customizer',   // Section headings, copy and toggles.
		'svg',          // Inline icon + illustration helpers.
		'template-tags' // Small markup helpers.
	)
);
