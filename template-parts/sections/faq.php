<?php
/**
 * FAQ accordion.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

$ressa_faqs = ressa_items( 'rh_faq' );

if ( ! $ressa_faqs ) {
	return;
}
?>
<?php ressa_section_open( 'faq', array( 'labelledby' => 'faq-title' ) ); ?>
	<div class="rh-container">
		<div class="rh-faq__grid">

			<div class="rh-faq__copy" data-rh-reveal="left" data-rh-stagger>
				<p class="rh-eyebrow" style="--stagger-index:0"><?php ressa_the_html( 'faq_eyebrow' ); ?></p>
				<h2 id="faq-title" class="rh-display rh-display--sm" style="--stagger-index:1">
					<?php ressa_the_html( 'faq_title' ); ?>
				</h2>
			</div>

			<div class="rh-faq__list" data-rh-accordion data-rh-reveal="right">
				<?php foreach ( $ressa_faqs as $ressa_index => $ressa_faq ) : ?>
					<div class="rh-faq__item">
						<h3>
							<button
								class="rh-faq__trigger"
								type="button"
								id="faq-trigger-<?php echo (int) $ressa_index; ?>"
								aria-expanded="false"
								aria-controls="faq-panel-<?php echo (int) $ressa_index; ?>"
							>
								<span class="rh-faq__q"><?php echo esc_html( ressa_item( $ressa_faq, 'title' ) ); ?></span>
								<span class="rh-faq__icon" aria-hidden="true"></span>
							</button>
						</h3>

						<div
							class="rh-faq__panel"
							id="faq-panel-<?php echo (int) $ressa_index; ?>"
							role="region"
							aria-labelledby="faq-trigger-<?php echo (int) $ressa_index; ?>"
						>
							<p class="rh-faq__answer"><?php echo wp_kses( ressa_item( $ressa_faq, 'answer' ), ressa_allowed_inline_html() ); ?></p>
						</div>
					</div>
				<?php endforeach; ?>
			</div>

		</div>
	</div>
<?php ressa_section_close(); ?>
