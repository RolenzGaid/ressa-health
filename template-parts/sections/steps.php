<?php
/**
 * How It Works.
 *
 * The section intro and the three steps are stages of one pinned sequence:
 * the intro holds the first screenful, then Test, Analyze and Act each take
 * a turn as the visitor scrolls, in both directions.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

$ressa_steps = ressa_items( 'rh_step' );

if ( ! $ressa_steps ) {
	return;
}

// One stage for the intro, then one per step.
$ressa_stages = count( $ressa_steps ) + 1;
?>
<?php ressa_section_open( 'steps', array( 'labelledby' => 'steps-title', 'spacing' => 'tight' ) ); ?>

	<div class="rh-steps__scroller" data-rh-steps style="--stage-count:<?php echo (int) $ressa_stages; ?>">
		<div class="rh-steps__sticky rh-container">

			<div class="rh-steps__rail" role="tablist" aria-label="<?php esc_attr_e( 'Process steps', 'ressa-health' ); ?>">
				<?php foreach ( $ressa_steps as $ressa_index => $ressa_step ) : ?>
					<?php if ( $ressa_index > 0 ) : ?>
						<span class="rh-steps__link" aria-hidden="true" data-step-link="<?php echo (int) ( $ressa_index - 1 ); ?>">
							<i></i>
						</span>
					<?php endif; ?>

					<button
						class="rh-steps__rail-btn"
						type="button"
						role="tab"
						id="step-tab-<?php echo (int) $ressa_index; ?>"
						aria-controls="step-panel-<?php echo (int) $ressa_index; ?>"
						aria-selected="<?php echo 0 === $ressa_index ? 'true' : 'false'; ?>"
						tabindex="<?php echo 0 === $ressa_index ? '0' : '-1'; ?>"
						data-step-index="<?php echo (int) $ressa_index; ?>"
					>
						<?php echo esc_html( ressa_item( $ressa_step, 'rail_label', ressa_item( $ressa_step, 'title' ) ) ); ?>
					</button>
				<?php endforeach; ?>
			</div>

			<div class="rh-steps__stage">

				<div class="rh-step rh-steps__intro is-current" data-step-intro>
					<?php
					ressa_section_head(
						array(
							'eyebrow' => ressa_html( 'steps_eyebrow' ),
							'title'   => ressa_html( 'steps_title' ),
							'lede'    => ressa_html( 'steps_lede' ),
							'id'      => 'steps-title',
							'class'   => 'rh-steps__head',
							'reveal'  => false,
						)
					);
					?>
				</div>

				<?php foreach ( $ressa_steps as $ressa_index => $ressa_step ) : ?>
					<article
						class="rh-step"
						id="step-panel-<?php echo (int) $ressa_index; ?>"
						role="tabpanel"
						aria-labelledby="step-tab-<?php echo (int) $ressa_index; ?>"
						data-step-panel="<?php echo (int) $ressa_index; ?>"
					>
						<div class="rh-step__media rh-media-zoom" style="--stagger-index:0">
							<?php
							ressa_media_frame(
								$ressa_step,
								array(
									'classes' => 'rh-media--yellow rh-media--round',
									'icon'    => 'upload',
								)
							);
							?>
						</div>

						<div class="rh-step__body" style="--stagger-index:1">
							<p class="rh-step__label"><?php echo esc_html( ressa_item( $ressa_step, 'step_label', sprintf( 'Step %02d', $ressa_index + 1 ) ) ); ?></p>
							<h3 class="rh-step__title"><?php echo esc_html( ressa_item( $ressa_step, 'title' ) ); ?></h3>
							<p class="rh-step__text"><?php echo wp_kses( ressa_item( $ressa_step, 'description' ), ressa_allowed_inline_html() ); ?></p>
						</div>
					</article>
				<?php endforeach; ?>

			</div>
		</div>
	</div>
<?php ressa_section_close(); ?>
