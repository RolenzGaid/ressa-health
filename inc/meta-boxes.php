<?php
/**
 * A single generic meta box driven by the shared field schema.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

const RESSA_META_PREFIX = '_ressa_';
const RESSA_NONCE       = 'ressa_meta_nonce';

/**
 * Register the details meta box on every repeatable content type.
 */
function ressa_add_meta_boxes() {
	foreach ( ressa_post_types() as $slug => $config ) {
		if ( empty( $config['fields'] ) ) {
			continue;
		}

		add_meta_box(
			'ressa-details',
			/* translators: %s: singular content type name. */
			sprintf( __( '%s details', 'ressa-health' ), $config['singular'] ),
			'ressa_render_meta_box',
			$slug,
			'normal',
			'high'
		);
	}
}
add_action( 'add_meta_boxes', 'ressa_add_meta_boxes' );

/**
 * Render the meta box for the current post type.
 *
 * @param WP_Post $post Current post.
 */
function ressa_render_meta_box( $post ) {
	$types  = ressa_post_types();
	$config = isset( $types[ $post->post_type ] ) ? $types[ $post->post_type ] : array();
	$fields = isset( $config['fields'] ) ? $config['fields'] : array();

	wp_nonce_field( 'ressa_save_meta', RESSA_NONCE );

	if ( ! empty( $config['help'] ) ) {
		echo '<p class="description rh-meta-intro">' . esc_html( $config['help'] ) . '</p>';
	}

	echo '<div class="rh-meta-grid">';

	foreach ( $fields as $key => $field ) {
		$value = ressa_get_meta( $post->ID, $key );

		if ( '' === $value && isset( $field['default'] ) ) {
			$value = $field['default'];
		}

		ressa_render_field( $key, $field, $value );
	}

	echo '</div>';

	if ( ressa_type_supports_image( $post->post_type ) ) {
		printf(
			'<p class="description rh-meta-note">%s</p>',
			esc_html(
				sprintf(
					/* translators: %s: featured image slot label. */
					__( 'Set the “%s” using the Featured image panel in the sidebar.', 'ressa-health' ),
					isset( $config['image_label'] ) ? $config['image_label'] : __( 'image', 'ressa-health' )
				)
			)
		);
	}
}

/**
 * Render one field control.
 *
 * @param string $key   Field key.
 * @param array  $field Field definition.
 * @param mixed  $value Current value.
 */
function ressa_render_field( $key, $field, $value ) {
	$id   = 'ressa-field-' . $key;
	$name = RESSA_META_PREFIX . $key;
	$type = isset( $field['type'] ) ? $field['type'] : 'text';

	$wide = in_array( $type, array( 'textarea', 'tags', 'image', 'video' ), true );

	printf( '<div class="rh-meta-field%s">', $wide ? ' rh-meta-field--wide' : '' );
	printf( '<label for="%s">%s</label>', esc_attr( $id ), esc_html( $field['label'] ) );

	switch ( $type ) {
		case 'textarea':
			printf(
				'<textarea id="%s" name="%s" rows="3" class="widefat">%s</textarea>',
				esc_attr( $id ),
				esc_attr( $name ),
				esc_textarea( (string) $value )
			);
			break;

		case 'select':
			printf( '<select id="%s" name="%s" class="widefat">', esc_attr( $id ), esc_attr( $name ) );
			foreach ( $field['options'] as $opt_value => $opt_label ) {
				printf(
					'<option value="%s"%s>%s</option>',
					esc_attr( $opt_value ),
					selected( $value, $opt_value, false ),
					esc_html( $opt_label )
				);
			}
			echo '</select>';
			break;

		case 'color':
			printf(
				'<input type="color" id="%s" name="%s" value="%s">',
				esc_attr( $id ),
				esc_attr( $name ),
				esc_attr( $value ? $value : '#0f5d57' )
			);
			break;

		case 'tags':
			printf(
				'<input type="text" id="%s" name="%s" value="%s" class="widefat">',
				esc_attr( $id ),
				esc_attr( $name ),
				esc_attr( is_array( $value ) ? implode( ', ', $value ) : (string) $value )
			);
			break;

		case 'image':
		case 'video':
			printf(
				'<div class="rh-media-field" data-media-type="%s">
					<input type="url" id="%s" name="%s" value="%s" class="widefat rh-media-field__input" placeholder="https://">
					<button type="button" class="button rh-media-field__pick">%s</button>
					<button type="button" class="button-link rh-media-field__clear">%s</button>
				</div>',
				esc_attr( $type ),
				esc_attr( $id ),
				esc_attr( $name ),
				esc_url( (string) $value ),
				esc_html__( 'Choose file', 'ressa-health' ),
				esc_html__( 'Clear', 'ressa-health' )
			);
			break;

		case 'url':
			printf(
				'<input type="url" id="%s" name="%s" value="%s" class="widefat">',
				esc_attr( $id ),
				esc_attr( $name ),
				esc_url( (string) $value )
			);
			break;

		default:
			printf(
				'<input type="text" id="%s" name="%s" value="%s" class="widefat">',
				esc_attr( $id ),
				esc_attr( $name ),
				esc_attr( (string) $value )
			);
	}

	if ( ! empty( $field['help'] ) ) {
		printf( '<span class="description">%s</span>', esc_html( $field['help'] ) );
	}

	echo '</div>';
}

/**
 * Persist meta box values.
 *
 * @param int     $post_id Post ID.
 * @param WP_Post $post    Post object.
 */
function ressa_save_meta( $post_id, $post ) {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	$types = ressa_post_types();

	if ( ! isset( $types[ $post->post_type ] ) ) {
		return;
	}

	if ( ! isset( $_POST[ RESSA_NONCE ] ) ) {
		return;
	}

	$nonce = sanitize_text_field( wp_unslash( $_POST[ RESSA_NONCE ] ) );

	if ( ! wp_verify_nonce( $nonce, 'ressa_save_meta' ) ) {
		return;
	}

	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}

	foreach ( $types[ $post->post_type ]['fields'] as $key => $field ) {
		$name = RESSA_META_PREFIX . $key;

		if ( ! isset( $_POST[ $name ] ) ) {
			delete_post_meta( $post_id, $name );
			continue;
		}

		$raw   = wp_unslash( $_POST[ $name ] ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput -- sanitised per type below.
		$value = ressa_sanitize_field_value( $raw, $field );

		if ( '' === $value || array() === $value ) {
			delete_post_meta( $post_id, $name );
		} else {
			update_post_meta( $post_id, $name, $value );
		}
	}
}
add_action( 'save_post', 'ressa_save_meta', 10, 2 );

/**
 * Sanitise one submitted value according to its declared field type.
 *
 * @param mixed $raw   Submitted value.
 * @param array $field Field definition.
 * @return mixed
 */
function ressa_sanitize_field_value( $raw, $field ) {
	$type = isset( $field['type'] ) ? $field['type'] : 'text';

	switch ( $type ) {
		case 'textarea':
			return wp_kses( (string) $raw, ressa_allowed_inline_html() );

		case 'url':
		case 'image':
		case 'video':
			return esc_url_raw( (string) $raw );

		case 'color':
			$color = sanitize_hex_color( (string) $raw );
			return $color ? $color : '';

		case 'select':
			$options = isset( $field['options'] ) ? array_keys( $field['options'] ) : array();
			return in_array( $raw, $options, true ) ? $raw : reset( $options );

		case 'tags':
			$parts = array_map( 'trim', explode( ',', (string) $raw ) );
			$parts = array_filter( array_map( 'sanitize_text_field', $parts ) );
			return array_values( $parts );

		default:
			return wp_kses( (string) $raw, ressa_allowed_inline_html() );
	}
}

/**
 * Inline HTML permitted inside headline and copy fields.
 *
 * @return array
 */
function ressa_allowed_inline_html() {
	return array(
		'em'     => array( 'class' => array() ),
		'i'      => array( 'class' => array() ),
		'strong' => array( 'class' => array() ),
		'b'      => array( 'class' => array() ),
		'span'   => array( 'class' => array() ),
		'br'     => array(),
		'a'      => array(
			'href'   => array(),
			'title'  => array(),
			'target' => array(),
			'rel'    => array(),
		),
	);
}

/**
 * Read one prefixed meta value.
 *
 * @param int    $post_id Post ID.
 * @param string $key     Unprefixed key.
 * @return mixed
 */
function ressa_get_meta( $post_id, $key ) {
	$value = get_post_meta( $post_id, RESSA_META_PREFIX . $key, true );

	return ( '' === $value ) ? '' : $value;
}
