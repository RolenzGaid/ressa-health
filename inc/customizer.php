<?php
/**
 * Customizer registration, generated from the shared field schema.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register every front page panel, section, setting and control.
 *
 * @param WP_Customize_Manager $wp_customize Customizer manager.
 */
function ressa_customize_register( $wp_customize ) {
	$wp_customize->add_panel(
		'ressa_front',
		array(
			'title'       => __( 'Ressa Health Content', 'ressa-health' ),
			'description' => __( 'Headlines, intro copy and buttons for the front page. Repeating cards, tabs and rows are edited under “Front Page” in the admin sidebar.', 'ressa-health' ),
			'priority'    => 20,
		)
	);

	// -- Section visibility --------------------------------------------------
	$wp_customize->add_section(
		'ressa_visibility',
		array(
			'title'    => __( 'Section Visibility', 'ressa-health' ),
			'panel'    => 'ressa_front',
			'priority' => 5,
		)
	);

	foreach ( ressa_front_sections() as $key => $label ) {
		$setting = 'section_' . $key . '_enabled';

		$wp_customize->add_setting(
			$setting,
			array(
				'default'           => true,
				'sanitize_callback' => 'ressa_sanitize_checkbox',
				'transport'         => 'refresh',
			)
		);

		$wp_customize->add_control(
			$setting,
			array(
				'label'   => $label,
				'section' => 'ressa_visibility',
				'type'    => 'checkbox',
			)
		);
	}

	// -- Generated content sections -----------------------------------------
	$priority = 10;

	foreach ( ressa_customizer_schema() as $section_key => $section ) {
		$section_id = 'ressa_' . $section_key;

		$wp_customize->add_section(
			$section_id,
			array(
				'title'    => $section['title'],
				'panel'    => 'ressa_front',
				'priority' => $priority,
			)
		);

		$priority += 5;

		foreach ( $section['fields'] as $key => $field ) {
			$type = isset( $field['type'] ) ? $field['type'] : 'text';

			$wp_customize->add_setting(
				$key,
				array(
					'default'           => ressa_default_option( $key ),
					'sanitize_callback' => ressa_sanitize_callback_for( $type ),
					'transport'         => 'refresh',
				)
			);

			$args = array(
				'label'       => $field['label'],
				'section'     => $section_id,
				'description' => isset( $field['help'] ) ? $field['help'] : '',
			);

			if ( 'image' === $type ) {
				$wp_customize->add_control(
					new WP_Customize_Media_Control(
						$wp_customize,
						$key,
						array_merge( $args, array( 'mime_type' => 'image' ) )
					)
				);
				continue;
			}

			$args['type'] = ( 'textarea' === $type ) ? 'textarea' : ( 'url' === $type ? 'url' : 'text' );

			$wp_customize->add_control( $key, $args );
		}
	}

	// Live preview for the plain-text pieces of the hero.
	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->get_setting( 'hero_title' )->transport = 'postMessage';

		$wp_customize->selective_refresh->add_partial(
			'hero_title',
			array(
				'selector'        => '.rh-hero__title',
				'render_callback' => function () {
					return ressa_html( 'hero_title' );
				},
			)
		);
	}
}
add_action( 'customize_register', 'ressa_customize_register' );

/**
 * Map a field type to its sanitize callback.
 *
 * @param string $type Field type.
 * @return string|callable
 */
function ressa_sanitize_callback_for( $type ) {
	switch ( $type ) {
		case 'url':
			return 'esc_url_raw';
		case 'image':
			return 'absint';
		case 'textarea':
		case 'text':
		default:
			return 'ressa_sanitize_inline_html';
	}
}

/**
 * Sanitize a headline or copy value, keeping the small inline tag allowlist.
 *
 * @param string $value Raw value.
 * @return string
 */
function ressa_sanitize_inline_html( $value ) {
	return wp_kses( (string) $value, ressa_allowed_inline_html() );
}

/**
 * Sanitize a checkbox.
 *
 * @param mixed $value Raw value.
 * @return bool
 */
function ressa_sanitize_checkbox( $value ) {
	return (bool) $value;
}

/**
 * Enqueue the Customizer preview helper.
 */
function ressa_customize_preview_js() {
	wp_enqueue_script(
		'ressa-customizer',
		RESSA_URI . '/assets/js/customizer.js',
		array( 'customize-preview' ),
		ressa_asset_version( '/assets/js/customizer.js' ),
		true
	);
}
add_action( 'customize_preview_init', 'ressa_customize_preview_js' );
