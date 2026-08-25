<?php
/**
 * Fallback template — used for the blog index and any unmatched query.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<div class="rh-page-header">
	<div class="rh-container">
		<h1 class="rh-display rh-display--lg">
			<?php
			if ( is_home() && ! is_front_page() ) {
				echo esc_html( get_the_title( (int) get_option( 'page_for_posts' ) ) );
			} else {
				esc_html_e( 'Latest thinking', 'ressa-health' );
			}
			?>
		</h1>
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

					get_template_part(
						'template-parts/content/entry-card',
						null,
						array( 'index' => $ressa_index )
					);

					$ressa_index++;
				endwhile;
				?>
			</div>

			<?php
			$ressa_links = paginate_links(
				array(
					'prev_text' => esc_html__( 'Previous', 'ressa-health' ),
					'next_text' => esc_html__( 'Next', 'ressa-health' ),
				)
			);

			if ( $ressa_links ) {
				echo '<nav class="rh-pagination" aria-label="' . esc_attr__( 'Posts', 'ressa-health' ) . '">' . wp_kses_post( $ressa_links ) . '</nav>';
			}
			?>

		<?php else : ?>
			<p class="rh-lede rh-lede--center"><?php esc_html_e( 'Nothing published yet.', 'ressa-health' ); ?></p>
		<?php endif; ?>
	</div>
</div>

<?php
get_footer();
