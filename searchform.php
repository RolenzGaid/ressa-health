<?php
/**
 * Search form.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

$ressa_id = 'search-' . wp_unique_id();
?>
<form role="search" method="get" class="rh-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="<?php echo esc_attr( $ressa_id ); ?>">
		<?php esc_html_e( 'Search for:', 'ressa-health' ); ?>
	</label>
	<input type="search" id="<?php echo esc_attr( $ressa_id ); ?>" name="s" value="<?php echo esc_attr( get_search_query() ); ?>" placeholder="<?php esc_attr_e( 'Search&hellip;', 'ressa-health' ); ?>">
	<button class="rh-btn rh-btn--teal rh-btn--sm" type="submit"><?php esc_html_e( 'Search', 'ressa-health' ); ?></button>
</form>
