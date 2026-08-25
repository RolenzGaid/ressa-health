<?php
/**
 * Content accessors used by the templates.
 *
 * Templates never talk to get_theme_mod() or WP_Query directly: they ask for a
 * key or a group and receive a normalised value, whether it came from the
 * Customizer, a custom post type, or the bundled starter content.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

/**
 * Read a Customizer value, falling back to the bundled default.
 *
 * @param string $key      Setting key.
 * @param string $fallback Fallback when the key is unknown.
 * @return string
 */
function ressa_opt( $key, $fallback = '' ) {
	$value = get_theme_mod( $key, null );

	if ( null === $value || '' === $value ) {
		return ressa_default_option( $key, $fallback );
	}

	return (string) $value;
}

/**
 * Echo a value that may contain the small set of inline tags used by headlines.
 *
 * @param string $key Setting key.
 */
function ressa_the_html( $key ) {
	echo wp_kses( ressa_opt( $key ), ressa_allowed_inline_html() );
}

/**
 * Return a value escaped for inline HTML output.
 *
 * @param string $key Setting key.
 * @return string
 */
function ressa_html( $key ) {
	return wp_kses( ressa_opt( $key ), ressa_allowed_inline_html() );
}

/**
 * Escape a string that may contain the allowed inline tags.
 *
 * @param string $value Raw value.
 * @return string
 */
function ressa_kses( $value ) {
	return wp_kses( (string) $value, ressa_allowed_inline_html() );
}

/**
 * Whether a front page section should render.
 *
 * @param string $section Section key.
 * @return bool
 */
function ressa_section_enabled( $section ) {
	return (bool) get_theme_mod( 'section_' . $section . '_enabled', true );
}

/**
 * Normalised items for a repeatable content type.
 *
 * Returns published posts when they exist, otherwise the bundled starter
 * content, so the design is intact on a brand new install.
 *
 * @param string $type  Post type key.
 * @param int    $limit Maximum items, -1 for all.
 * @return array<int, array<string, mixed>>
 */
function ressa_items( $type, $limit = -1 ) {
	static $cache = array();

	$cache_key = $type . ':' . $limit;

	if ( isset( $cache[ $cache_key ] ) ) {
		return $cache[ $cache_key ];
	}

	$types  = ressa_post_types();
	$config = isset( $types[ $type ] ) ? $types[ $type ] : array();
	$fields = isset( $config['fields'] ) ? $config['fields'] : array();

	$posts = get_posts(
		array(
			'post_type'        => $type,
			'post_status'      => 'publish',
			'numberposts'      => $limit,
			'orderby'          => array(
				'menu_order' => 'ASC',
				'date'       => 'ASC',
			),
			'suppress_filters' => false,
		)
	);

	$items = array();

	if ( $posts ) {
		foreach ( $posts as $post ) {
			$item = array(
				'id'    => $post->ID,
				'title' => $post->post_title,
			);

			foreach ( $fields as $key => $field ) {
				$item[ $key ] = ressa_get_meta( $post->ID, $key );

				if ( '' === $item[ $key ] && isset( $field['default'] ) ) {
					$item[ $key ] = $field['default'];
				}
			}

			$item['image_id'] = (int) get_post_thumbnail_id( $post->ID );

			$items[] = $item;
		}
	} else {
		$items = ressa_default_items( $type );

		if ( $limit > 0 ) {
			$items = array_slice( $items, 0, $limit );
		}

		// Backfill declared keys so templates can index without isset() noise.
		foreach ( $items as $index => $item ) {
			foreach ( $fields as $key => $field ) {
				if ( ! isset( $item[ $key ] ) ) {
					$items[ $index ][ $key ] = isset( $field['default'] ) ? $field['default'] : '';
				}
			}

			$items[ $index ]['id']       = 0;
			$items[ $index ]['image_id'] = 0;
		}
	}

	$cache[ $cache_key ] = $items;

	return $items;
}

/**
 * Convenience reader for one item key.
 *
 * @param array  $item    Item array.
 * @param string $key     Key to read.
 * @param string $default Fallback.
 * @return mixed
 */
function ressa_item( $item, $key, $default = '' ) {
	if ( ! isset( $item[ $key ] ) || '' === $item[ $key ] ) {
		return $default;
	}

	return $item[ $key ];
}

/**
 * Item keyword pills, always returned as an array.
 *
 * @param array  $item Item array.
 * @param string $key  Meta key holding the pills.
 * @return string[]
 */
function ressa_item_tags( $item, $key = 'tags' ) {
	$tags = isset( $item[ $key ] ) ? $item[ $key ] : array();

	if ( is_string( $tags ) ) {
		$tags = array_filter( array_map( 'trim', explode( ',', $tags ) ) );
	}

	return is_array( $tags ) ? $tags : array();
}

/**
 * URL of the artwork bundled with the theme for an item, if any.
 *
 * Used when nothing has been uploaded in WordPress yet, so a fresh install
 * shows the supplied photography rather than an empty colour block.
 *
 * @param array $item Item array.
 * @return string
 */
function ressa_item_default_image( $item ) {
	if ( empty( $item['default_image'] ) ) {
		return '';
	}

	return RESSA_URI . '/' . ltrim( $item['default_image'], '/' );
}

/**
 * Render a media frame for an item, or the flat colour placeholder used in the
 * design comp when no image has been attached yet.
 *
 * @param array $item Item array.
 * @param array $args {
 *     @type string $size    Image size. Default 'ressa-card'.
 *     @type string $classes Extra classes for the frame.
 *     @type string $icon    Placeholder glyph key.
 *     @type bool   $lazy    Whether to lazy load.
 * }
 */
function ressa_media_frame( $item, $args = array() ) {
	$args = wp_parse_args(
		$args,
		array(
			'size'    => 'ressa-card',
			'classes' => 'rh-media--mint',
			'icon'    => 'image',
			'lazy'    => true,
		)
	);

	$image_id = isset( $item['image_id'] ) ? (int) $item['image_id'] : 0;
	$bundled  = ressa_item_default_image( $item );

	printf(
		'<div class="rh-media %s%s">',
		esc_attr( $args['classes'] ),
		( $image_id || $bundled ) ? ' has-image' : ''
	);

	if ( $image_id ) {
		echo wp_get_attachment_image(
			$image_id,
			$args['size'],
			false,
			array(
				'loading'  => $args['lazy'] ? 'lazy' : 'eager',
				'decoding' => 'async',
				'alt'      => esc_attr( ressa_item( $item, 'title' ) ),
			)
		);
	} elseif ( $bundled ) {
		printf(
			'<img src="%s" alt="%s" loading="%s" decoding="async">',
			esc_url( $bundled ),
			esc_attr( ressa_item( $item, 'title' ) ),
			esc_attr( $args['lazy'] ? 'lazy' : 'eager' )
		);
	} else {
		echo '<span class="rh-media__placeholder" aria-hidden="true">' . ressa_icon( $args['icon'] ) . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput -- trusted inline SVG.
	}

	echo '</div>';
}

/**
 * Video source for a story card.
 *
 * Falls back to the bundled abstract placeholder clip so the hover-to-play
 * behaviour is visible before real footage has been uploaded.
 *
 * @param array $item Story item.
 * @return string
 */
function ressa_story_video( $item ) {
	$url = ressa_item( $item, 'video_url' );

	return $url ? $url : RESSA_URI . '/assets/media/story-placeholder.mp4';
}
