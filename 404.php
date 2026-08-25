<?php
/**
 * 404.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="rh-404 rh-section--cream">
	<div class="rh-container--slim">
		<p class="rh-eyebrow"><?php esc_html_e( 'Error 404', 'ressa-health' ); ?></p>
		<h1 class="rh-display rh-display--lg"><?php esc_html_e( 'That page is not part of the story.', 'ressa-health' ); ?></h1>
		<p class="rh-lede rh-lede--center"><?php esc_html_e( 'The link may be out of date. Try a search, or head back to the beginning.', 'ressa-health' ); ?></p>

		<div class="rh-btn-group rh-btn-group--center" style="margin-top:2rem">
			<?php ressa_button( __( 'Back to home', 'ressa-health' ), home_url( '/' ), array( 'variant' => 'primary' ) ); ?>
		</div>
	</div>
</div>

<?php
get_footer();
