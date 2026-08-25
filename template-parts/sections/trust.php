<?php
/**
 * Trust promises.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

$ressa_promises = ressa_items( 'rh_trust' );

if ( ! $ressa_promises ) {
	return;
}
?>
<?php ressa_section_open( 'trust', array( 'spacing' => 'tight', 'labelledby' => 'trust-title' ) ); ?>
	<div class="rh-container">

		<div class="rh-trust__head" data-rh-reveal="up">
			<p class="rh-eyebrow--mut"><?php ressa_the_html( 'trust_eyebrow' ); ?></p>
			<h2 id="trust-title" class="rh-trust__title"><?php ressa_the_html( 'trust_title' ); ?></h2>
		</div>

		<div class="rh-trust__grid" data-rh-stagger>
			<?php foreach ( $ressa_promises as $ressa_index => $ressa_promise ) : ?>
				<div class="rh-trust__card" data-rh-reveal="up" style="--stagger-index:<?php echo (int) $ressa_index; ?>">
					<h3 class="rh-trust__card-title"><?php echo wp_kses( ressa_item( $ressa_promise, 'title' ), ressa_allowed_inline_html() ); ?></h3>
					<p class="rh-trust__card-text"><?php echo wp_kses( ressa_item( $ressa_promise, 'description' ), ressa_allowed_inline_html() ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>

	</div>
<?php ressa_section_close(); ?>
