<?php
/**
 * Seven Layers — tabbed panels driving the wheel graphic.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

$ressa_layers = ressa_items( 'rh_layer' );

if ( ! $ressa_layers ) {
	return;
}
?>
<?php ressa_section_open( 'layers', array( 'labelledby' => 'layers-title' ) ); ?>
	<div class="rh-container--wide">

		<?php
		ressa_section_head(
			array(
				'eyebrow' => ressa_html( 'layers_eyebrow' ),
				'title'   => ressa_html( 'layers_title' ),
				'lede'    => ressa_html( 'layers_lede' ),
				'id'      => 'layers-title',
				'class'   => 'rh-layers__head rh-section-head--wide',
			)
		);
		?>

		<div class="rh-layers__widget" data-rh-layers>

			<div class="rh-layers__tabs" role="tablist" aria-label="<?php esc_attr_e( 'Health data layers', 'ressa-health' ); ?>" data-rh-reveal="up">
				<?php foreach ( $ressa_layers as $ressa_index => $ressa_layer ) : ?>
					<button
						class="rh-layers__tab"
						type="button"
						role="tab"
						id="layer-tab-<?php echo (int) $ressa_index; ?>"
						aria-controls="layer-panel-<?php echo (int) $ressa_index; ?>"
						aria-selected="<?php echo 0 === $ressa_index ? 'true' : 'false'; ?>"
						tabindex="<?php echo 0 === $ressa_index ? '0' : '-1'; ?>"
						data-layer-index="<?php echo (int) $ressa_index; ?>"
					>
						<?php echo esc_html( ressa_item( $ressa_layer, 'title' ) ); ?>
					</button>
				<?php endforeach; ?>
			</div>

			<div class="rh-layers__body">

				<div class="rh-layers__panels" data-rh-reveal="left">
					<?php foreach ( $ressa_layers as $ressa_index => $ressa_layer ) : ?>
						<div
							class="rh-layers__panel"
							id="layer-panel-<?php echo (int) $ressa_index; ?>"
							role="tabpanel"
							aria-labelledby="layer-tab-<?php echo (int) $ressa_index; ?>"
							tabindex="0"
							<?php echo 0 === $ressa_index ? '' : 'hidden'; ?>
						>
							<?php if ( ressa_item( $ressa_layer, 'eyebrow' ) ) : ?>
								<p class="rh-eyebrow" style="--stagger-index:0">
									<?php echo wp_kses( ressa_item( $ressa_layer, 'eyebrow' ), ressa_allowed_inline_html() ); ?>
								</p>
							<?php endif; ?>

							<h3 class="rh-display rh-display--md" style="--stagger-index:1">
								<?php echo esc_html( ressa_item( $ressa_layer, 'headline', ressa_item( $ressa_layer, 'title' ) ) ); ?>
							</h3>

							<p class="rh-lede" style="--stagger-index:2">
								<?php echo wp_kses( ressa_item( $ressa_layer, 'description' ), ressa_allowed_inline_html() ); ?>
							</p>

							<div style="--stagger-index:3">
								<?php ressa_pills( ressa_item_tags( $ressa_layer ) ); ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>

				<div class="rh-layers__chart" data-rh-reveal="zoom">
					<?php ressa_render_wheel( $ressa_layers ); ?>
				</div>

			</div>
		</div>

		<p class="rh-layers__foot" data-rh-reveal="up"><?php ressa_the_html( 'layers_foot' ); ?></p>

	</div>
<?php ressa_section_close(); ?>
