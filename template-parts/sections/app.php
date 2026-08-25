<?php
/**
 * The Output — phone mockup beside the closing product pitch.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

$ressa_screen_id = (int) get_theme_mod( 'app_screen', 0 );
?>
<?php ressa_section_open( 'app', array( 'labelledby' => 'app-title' ) ); ?>
	<div class="rh-container">
		<div class="rh-split rh-split--media-narrow">

			<div class="rh-app__visual" data-rh-reveal="zoom" data-rh-parallax data-parallax-strength="0.04">
				<div class="rh-phone">
					<div class="rh-phone__screen">
						<?php if ( $ressa_screen_id ) : ?>
							<?php
							echo wp_get_attachment_image(
								$ressa_screen_id,
								'large',
								false,
								array(
									'loading' => 'lazy',
									'alt'     => esc_attr__( 'The Ressa Health app', 'ressa-health' ),
								)
							);
							?>
						<?php else : ?>
							<?php get_template_part( 'template-parts/content/phone-demo' ); ?>
						<?php endif; ?>
					</div>
					<span class="rh-phone__glare" aria-hidden="true"></span>
				</div>
			</div>

			<div class="rh-app__copy" data-rh-reveal="right" data-rh-stagger>
				<p class="rh-eyebrow" style="--stagger-index:0"><?php ressa_the_html( 'app_eyebrow' ); ?></p>

				<h2 id="app-title" class="rh-display rh-display--md" style="--stagger-index:1">
					<?php ressa_the_html( 'app_title' ); ?>
				</h2>

				<p class="rh-lede" style="--stagger-index:2"><?php ressa_the_html( 'app_lede' ); ?></p>

				<div style="--stagger-index:3">
					<?php
					ressa_button(
						ressa_opt( 'app_cta_label' ),
						ressa_opt( 'app_cta_url' ),
						array( 'variant' => 'primary' )
					);
					?>
				</div>
			</div>

		</div>
	</div>
<?php ressa_section_close(); ?>
