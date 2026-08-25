<?php
/**
 * Search results.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="rh-page-header">
	<div class="rh-container--slim">
		<p class="rh-eyebrow"><?php esc_html_e( 'Search', 'ressa-health' ); ?></p>
		<h1 class="rh-display rh-display--md">
			<?php
			printf(
				/* translators: %s: search query. */
				esc_html__( 'Results for &ldquo;%s&rdquo;', 'ressa-health' ),
				esc_html( get_search_query() )
			);
			?>
		</h1>
		<?php get_search_form(); ?>
	</div>
</div>

<div class="rh-section rh-section--cream">
	<div class="rh-container">
		<?php if ( have_posts() ) : ?>
			<div class="rh-entry-grid" data-rh-stagger>
				<?php
				$ressa_index = 0;

				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content/entry-card', null, array( 'index' => $ressa_index ) );
					$ressa_index++;
				endwhile;
				?>
			</div>
		<?php else : ?>
			<p class="rh-lede rh-lede--center"><?php esc_html_e( 'Nothing matched that search.', 'ressa-health' ); ?></p>
		<?php endif; ?>
	</div>
</div>

<?php
get_footer();
