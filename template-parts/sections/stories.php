<?php
/**
 * Member stories carousel. Video slides play muted on hover.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

$ressa_stories = ressa_items( 'rh_story' );

if ( ! $ressa_stories ) {
	return;
}
?>
<?php ressa_section_open( 'stories', array( 'labelledby' => 'stories-title' ) ); ?>
	<div class="rh-container">
		<div class="rh-stories__grid">

			<div class="rh-stories__copy" data-rh-reveal="left" data-rh-stagger>
				<p class="rh-eyebrow" style="--stagger-index:0"><?php ressa_the_html( 'stories_eyebrow' ); ?></p>

				<h2 id="stories-title" class="rh-display rh-display--sm" style="--stagger-index:1">
					<?php ressa_the_html( 'stories_title' ); ?>
				</h2>
			</div>

			<div class="rh-slider" data-rh-slider data-slides-lg="3" data-slides-md="2" data-slides-sm="1" data-rh-reveal="right">

				<div class="rh-slider__viewport" data-slider-viewport>
					<div class="rh-slider__track" data-slider-track>
						<?php foreach ( $ressa_stories as $ressa_index => $ressa_story ) : ?>
							<div class="rh-slider__slide" role="group" aria-roledescription="<?php esc_attr_e( 'slide', 'ressa-health' ); ?>" aria-label="<?php echo esc_attr( sprintf( '%1$d / %2$d', $ressa_index + 1, count( $ressa_stories ) ) ); ?>">
								<?php
								get_template_part(
									'template-parts/content/story',
									null,
									array( 'story' => $ressa_story )
								);
								?>
							</div>
						<?php endforeach; ?>
					</div>
				</div>

				<div class="rh-slider__controls">
					<button class="rh-slider__btn" type="button" data-slider-prev>
						<?php ressa_the_icon( 'chevron-left' ); ?>
						<span class="screen-reader-text"><?php esc_html_e( 'Previous stories', 'ressa-health' ); ?></span>
					</button>
					<button class="rh-slider__btn" type="button" data-slider-next>
						<?php ressa_the_icon( 'chevron-right' ); ?>
						<span class="screen-reader-text"><?php esc_html_e( 'More stories', 'ressa-health' ); ?></span>
					</button>

					<div class="rh-slider__dots" data-slider-dots></div>
				</div>

			</div>
		</div>
	</div>
<?php ressa_section_close(); ?>
