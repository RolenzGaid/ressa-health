<?php
/**
 * How It Works — Test → Analyze → Act, revealed one step at a time on scroll.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

$ressa_steps = ressa_items( 'rh_step' );

if ( ! $ressa_steps ) {
	return;
}
?>
<?php ressa_section_open( 'steps', array( 'labelledby' => 'steps-title', 'spacing' => 'tight' ) ); ?>
	<div class="rh-container">
		<?php
		ressa_section_head(
			array(
				'eyebrow' => ressa_html( 'steps_eyebrow' ),
				'title'   => ressa_html( 'steps_title' ),
				'lede'    => ressa_html( 'steps_lede' ),
				'id'      => 'steps-title',
				'class'   => 'rh-steps__head',
			)
		);
		?>
	</div>

	<div class="rh-steps__scroller" data-rh-steps style="--step-count:<?php echo (int) count( $ressa_steps ); ?>">
		<div class="rh-steps__sticky">

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
				<?php foreach ( $ressa_steps as $ressa_index => $ressa_step ) : ?>
					<article
						class="rh-step<?php echo 0 === $ressa_index ? ' is-current' : ''; ?>"
						id="step-panel-<?php echo (int) $ressa_index; ?>"
						role="tabpanel"
						aria-labelledby="step-tab-<?php echo (int) $ressa_index; ?>"
						data-step-panel="<?php echo (int) $ressa_index; ?>"
					>
						<div class="rh-step__tags" style="--stagger-index:0">
							<?php ressa_pills( ressa_item_tags( $ressa_step ), 'mint' ); ?>
						</div>

						<div class="rh-step__media rh-media-zoom" style="--stagger-index:1">
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

						<div class="rh-step__body" style="--stagger-index:2">
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
