<?php
/**
 * Single post.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

get_header();

while ( have_posts() ) :
	the_post();
	?>

	<article <?php post_class(); ?>>
		<header class="rh-page-header">
			<div class="rh-container--slim">
				<?php ressa_entry_meta(); ?>
				<h1 class="rh-entry__title"><?php the_title(); ?></h1>
			</div>
		</header>

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="rh-section rh-section--tight rh-section--cream">
				<div class="rh-container">
					<div class="rh-media rh-media--wide rh-media--round" data-rh-reveal="zoom">
						<?php the_post_thumbnail( 'large', array( 'alt' => '' ) ); ?>
					</div>
				</div>
			</div>
		<?php endif; ?>

		<div class="rh-section rh-section--cream">
			<div class="rh-container--slim">
				<div class="rh-prose">
					<?php
					the_content();

					wp_link_pages(
						array(
							'before' => '<nav class="rh-pagination">',
							'after'  => '</nav>',
						)
					);
					?>
				</div>

				<?php
				if ( comments_open() || get_comments_number() ) {
					comments_template();
				}
				?>
			</div>
		</div>
	</article>

	<?php
endwhile;

get_footer();
