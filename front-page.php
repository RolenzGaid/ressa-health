<?php
/**
 * Front page.
 *
 * Sections render in the order declared by ressa_front_sections() and can be
 * switched off individually in Appearance → Customize → Section Visibility.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

get_header();

foreach ( array_keys( ressa_front_sections() ) as $ressa_section ) {
	if ( ! ressa_section_enabled( $ressa_section ) ) {
		continue;
	}

	get_template_part( 'template-parts/sections/' . $ressa_section );
}

get_footer();
