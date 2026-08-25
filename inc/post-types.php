<?php
/**
 * Registers the repeatable front page content types described in inc/fields.php.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

/**
 * Register every content type from the shared schema.
 */
function ressa_register_post_types() {
	foreach ( ressa_post_types() as $slug => $config ) {
		$singular = $config['singular'];
		$plural   = $config['plural'];

		$labels = array(
			'name'               => $plural,
			'singular_name'      => $singular,
			'menu_name'          => $plural,
			/* translators: %s: singular content type name. */
			'add_new_item'       => sprintf( __( 'Add New %s', 'ressa-health' ), $singular ),
			/* translators: %s: singular content type name. */
			'edit_item'          => sprintf( __( 'Edit %s', 'ressa-health' ), $singular ),
			/* translators: %s: singular content type name. */
			'new_item'           => sprintf( __( 'New %s', 'ressa-health' ), $singular ),
			/* translators: %s: singular content type name. */
			'view_item'          => sprintf( __( 'View %s', 'ressa-health' ), $singular ),
			/* translators: %s: plural content type name. */
			'search_items'       => sprintf( __( 'Search %s', 'ressa-health' ), $plural ),
			/* translators: %s: plural content type name. */
			'not_found'          => sprintf( __( 'No %s yet.', 'ressa-health' ), strtolower( $plural ) ),
			'all_items'          => $plural,
		);

		$supports = array( 'title', 'page-attributes' );

		if ( ressa_type_supports_image( $slug ) ) {
			$supports[] = 'thumbnail';
		}

		register_post_type(
			$slug,
			array(
				'labels'              => $labels,
				'description'         => isset( $config['help'] ) ? $config['help'] : '',
				'public'              => false,
				'show_ui'             => true,
				'show_in_menu'        => 'ressa-content',
				'show_in_rest'        => false,
				'menu_icon'           => $config['menu_icon'],
				'supports'            => $supports,
				'hierarchical'        => false,
				'has_archive'         => false,
				'rewrite'             => false,
				'exclude_from_search' => true,
				'capability_type'     => 'post',
			)
		);
	}
}
add_action( 'init', 'ressa_register_post_types' );

/**
 * Whether a content type uses the featured image.
 *
 * @param string $slug Post type key.
 * @return bool
 */
function ressa_type_supports_image( $slug ) {
	$types = ressa_post_types();

	if ( ! isset( $types[ $slug ] ) ) {
		return false;
	}

	return ! isset( $types[ $slug ]['supports_image'] ) || false !== $types[ $slug ]['supports_image'];
}

/**
 * A single top-level admin menu that gathers every front page content type,
 * so editors are not hunting through eight separate sidebar entries.
 */
function ressa_admin_menu() {
	add_menu_page(
		__( 'Front Page Content', 'ressa-health' ),
		__( 'Front Page', 'ressa-health' ),
		'edit_posts',
		'ressa-content',
		'ressa_render_admin_landing',
		'dashicons-layout',
		3
	);

	add_submenu_page(
		'ressa-content',
		__( 'Front Page Content', 'ressa-health' ),
		__( 'Overview', 'ressa-health' ),
		'edit_posts',
		'ressa-content',
		'ressa_render_admin_landing'
	);
}
add_action( 'admin_menu', 'ressa_admin_menu' );

/**
 * Overview screen listing each editable group with its item count.
 */
function ressa_render_admin_landing() {
	echo '<div class="wrap rh-admin-landing">';
	echo '<h1>' . esc_html__( 'Front Page Content', 'ressa-health' ) . '</h1>';
	echo '<p class="description">' . esc_html__( 'Everything on the Ressa Health front page is edited here or in the Customizer. Headlines, intros and buttons live under Appearance → Customize; the repeating groups below hold the cards, tabs, steps and rows.', 'ressa-health' ) . '</p>';

	echo '<p><a class="button button-primary" href="' . esc_url( admin_url( 'customize.php' ) ) . '">' . esc_html__( 'Edit headlines in the Customizer', 'ressa-health' ) . '</a></p>';

	echo '<div class="rh-admin-cards">';

	foreach ( ressa_post_types() as $slug => $config ) {
		$count = (int) wp_count_posts( $slug )->publish;

		echo '<div class="rh-admin-card">';
		echo '<h2>' . esc_html( $config['plural'] ) . '</h2>';
		echo '<p>' . esc_html( isset( $config['help'] ) ? $config['help'] : '' ) . '</p>';
		printf(
			'<p class="rh-admin-count">%s</p>',
			esc_html(
				sprintf(
					/* translators: %d: number of published items. */
					_n( '%d item published', '%d items published', $count, 'ressa-health' ),
					$count
				)
			)
		);
		echo '<p>';
		echo '<a class="button" href="' . esc_url( admin_url( 'edit.php?post_type=' . $slug ) ) . '">' . esc_html__( 'Manage', 'ressa-health' ) . '</a> ';
		echo '<a class="button" href="' . esc_url( admin_url( 'post-new.php?post_type=' . $slug ) ) . '">' . esc_html__( 'Add new', 'ressa-health' ) . '</a>';
		echo '</p>';
		echo '</div>';
	}

	echo '</div></div>';
}

/**
 * Order the repeatable types by menu order in the admin list tables so the
 * front-end order is obvious while editing.
 *
 * @param WP_Query $query Current query.
 */
function ressa_admin_order( $query ) {
	if ( ! is_admin() || ! $query->is_main_query() ) {
		return;
	}

	$post_type = $query->get( 'post_type' );

	if ( is_string( $post_type ) && array_key_exists( $post_type, ressa_post_types() ) ) {
		$query->set( 'orderby', 'menu_order title' );
		$query->set( 'order', 'ASC' );
	}
}
add_action( 'pre_get_posts', 'ressa_admin_order' );

/**
 * Replace the "Enter title here" placeholder with the field-specific label.
 *
 * @param string  $title Placeholder text.
 * @param WP_Post $post  Current post.
 * @return string
 */
function ressa_title_placeholder( $title, $post ) {
	$types = ressa_post_types();

	if ( isset( $types[ $post->post_type ]['title_label'] ) ) {
		return $types[ $post->post_type ]['title_label'];
	}

	return $title;
}
add_filter( 'enter_title_here', 'ressa_title_placeholder', 10, 2 );

/**
 * Show a menu order column so editors can see and sort by display order.
 *
 * @param array $columns Existing columns.
 * @return array
 */
function ressa_admin_columns( $columns ) {
	$columns['menu_order'] = __( 'Order', 'ressa-health' );

	return $columns;
}

/**
 * Render the menu order column.
 *
 * @param string $column  Column key.
 * @param int    $post_id Post ID.
 */
function ressa_admin_column_content( $column, $post_id ) {
	if ( 'menu_order' === $column ) {
		echo (int) get_post_field( 'menu_order', $post_id );
	}
}

foreach ( array_keys( ressa_post_types() ) as $ressa_type ) {
	add_filter( "manage_{$ressa_type}_posts_columns", 'ressa_admin_columns' );
	add_action( "manage_{$ressa_type}_posts_custom_column", 'ressa_admin_column_content', 10, 2 );
}
unset( $ressa_type );
