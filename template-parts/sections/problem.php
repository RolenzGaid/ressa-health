<?php
/**
 * The Problem — copy beside the orbit illustration.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

$ressa_layers = ressa_items( 'rh_layer' );
?>
<?php ressa_section_open( 'problem', array( 'labelledby' => 'problem-title' ) ); ?>
	<div class="rh-container">
		<div class="rh-split rh-split--copy-narrow">

			<div class="rh-problem__copy" data-rh-reveal="left" data-rh-stagger>
				<p class="rh-eyebrow" style="--stagger-index:0"><?php ressa_the_html( 'problem_eyebrow' ); ?></p>

				<h2 id="problem-title" class="rh-display rh-display--md" style="--stagger-index:1">
					<?php ressa_the_html( 'problem_title' ); ?>
				</h2>

				<p class="rh-lede" style="--stagger-index:2"><?php ressa_the_html( 'problem_lede' ); ?></p>

				<div style="--stagger-index:3">
					<?php
					ressa_button(
						ressa_opt( 'problem_cta_label' ),
						ressa_opt( 'problem_cta_url' ),
						array( 'variant' => 'primary' )
					);
					?>
				</div>
			</div>

			<div class="rh-problem__visual" data-rh-reveal="right" data-rh-parallax data-parallax-strength="0.05">
				<?php ressa_render_orbit( $ressa_layers ); ?>
			</div>

		</div>
	</div>
<?php ressa_section_close(); ?>
