<?php
/**
 * Placeholder app screen, shown until a real screenshot is uploaded.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

$ressa_rows = array(
	array( __( 'Ferritin', 'ressa-health' ), '38 ng/mL' ),
	array( __( 'hs-CRP', 'ressa-health' ), '2.1 mg/L' ),
	array( __( 'Sleep debt', 'ressa-health' ), '6h 12m' ),
	array( __( 'HRV trend', 'ressa-health' ), '+8%' ),
	array( __( 'Vitamin D', 'ressa-health' ), '31 ng/mL' ),
	array( __( 'Fasting glucose', 'ressa-health' ), '94 mg/dL' ),
	array( __( 'TSH', 'ressa-health' ), '3.8 mIU/L' ),
);
?>
<div class="rh-phone__demo" aria-hidden="true">
	<div class="rh-phone__demo-head">
		<span><?php esc_html_e( 'Your Trend', 'ressa-health' ); ?></span>
		<span><?php esc_html_e( '12 months', 'ressa-health' ); ?></span>
	</div>

	<svg class="rh-phone__demo-chart" viewBox="0 0 200 90" preserveAspectRatio="none">
		<path class="rh-phone__demo-area" d="M0 66 L20 58 L40 62 L60 44 L80 50 L100 33 L120 40 L140 25 L160 31 L180 18 L200 24 L200 90 L0 90 Z"/>
		<path class="rh-phone__demo-line" d="M0 66 L20 58 L40 62 L60 44 L80 50 L100 33 L120 40 L140 25 L160 31 L180 18 L200 24"/>
	</svg>

	<div class="rh-phone__demo-rows">
		<?php foreach ( $ressa_rows as $ressa_row ) : ?>
			<div class="rh-phone__demo-row">
				<i></i>
				<span><?php echo esc_html( $ressa_row[0] ); ?></span>
				<span><?php echo esc_html( $ressa_row[1] ); ?></span>
			</div>
		<?php endforeach; ?>
	</div>
</div>
