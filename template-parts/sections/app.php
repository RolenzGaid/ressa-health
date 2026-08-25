<?php
/**
 * The Output — phone mockup beside the closing product pitch.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

$ressa_screen_id  = (int) get_theme_mod( 'app_screen', 0 );
$ressa_screen_url = $ressa_screen_id
	? wp_get_attachment_image_url( $ressa_screen_id, 'large' )
	: RESSA_URI . '/assets/img/phone-output.png';
?>
<?php ressa_section_open( 'app', array( 'labelledby' => 'app-title' ) ); ?>
	<div class="rh-container">
		<div class="rh-split rh-split--media-narrow">

			<div class="rh-app__visual" data-rh-reveal="zoom" data-rh-parallax data-parallax-strength="0.04">
				<?php if ( $ressa_screen_url ) : ?>
					<img
						class="rh-app__shot"
						src="<?php echo esc_url( $ressa_screen_url ); ?>"
						alt="<?php esc_attr_e( 'The Ressa Health app showing a glucose trend over six months', 'ressa-health' ); ?>"
						width="412"
						height="620"
						loading="lazy"
						decoding="async"
					>
				<?php else : ?>
					<div class="rh-phone">
						<div class="rh-phone__screen">
							<?php get_template_part( 'template-parts/content/phone-demo' ); ?>
						</div>
						<span class="rh-phone__glare" aria-hidden="true"></span>
					</div>
				<?php endif; ?>
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
