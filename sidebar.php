<?php
/**
 * Blog sidebar.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

if ( ! is_active_sidebar( 'sidebar-1' ) ) {
	return;
}
?>
<aside class="rh-sidebar" aria-label="<?php esc_attr_e( 'Sidebar', 'ressa-health' ); ?>">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>
