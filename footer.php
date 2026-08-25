<?php
/**
 * Site footer.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

$ressa_footer_menus = array(
	'footer_one'   => __( 'Product', 'ressa-health' ),
	'footer_two'   => __( 'Company', 'ressa-health' ),
	'footer_three' => __( 'Resources', 'ressa-health' ),
);
?>
</main>

<footer class="rh-footer">
	<div class="rh-footer__inner">

		<div class="rh-footer__brand">
			<?php ressa_brand( 'footer' ); ?>
			<p><?php echo wp_kses( ressa_opt( 'footer_blurb' ), ressa_allowed_inline_html() ); ?></p>

			<div class="rh-footer__social">
				<a href="#" aria-label="<?php esc_attr_e( 'Share', 'ressa-health' ); ?>"><?php ressa_the_icon( 'share' ); ?></a>
				<a href="#" aria-label="<?php esc_attr_e( 'Website', 'ressa-health' ); ?>"><?php ressa_the_icon( 'globe' ); ?></a>
				<a href="#" aria-label="<?php esc_attr_e( 'Contact', 'ressa-health' ); ?>"><?php ressa_the_icon( 'link' ); ?></a>
			</div>
		</div>

		<?php foreach ( $ressa_footer_menus as $ressa_location => $ressa_label ) : ?>
			<div class="rh-footer__col">
				<h2 class="rh-footer__col-title"><?php echo esc_html( $ressa_label ); ?></h2>
				<?php
				if ( has_nav_menu( $ressa_location ) ) {
					wp_nav_menu(
						array(
							'theme_location' => $ressa_location,
							'container'      => false,
							'menu_class'     => 'rh-footer__menu',
							'depth'          => 1,
						)
					);
				} else {
					ressa_fallback_footer_menu( $ressa_location );
				}
				?>
			</div>
		<?php endforeach; ?>

	</div>

	<div class="rh-footer__bar">
		<div>
			<p><?php echo wp_kses( ressa_tokens( ressa_opt( 'footer_copyright' ) ), ressa_allowed_inline_html() ); ?></p>
			<p><?php echo esc_html( wp_strip_all_tags( ressa_opt( 'footer_disclaimer' ) ) ); ?></p>

			<?php
			if ( has_nav_menu( 'legal' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'legal',
						'container'      => false,
						'menu_class'     => 'rh-footer__legal',
						'depth'          => 1,
					)
				);
			}
			?>
		</div>
	</div>
</footer>

<button class="rh-to-top" type="button" data-rh-to-top>
	<?php ressa_the_icon( 'arrow-up' ); ?>
	<span class="screen-reader-text"><?php esc_html_e( 'Back to top', 'ressa-health' ); ?></span>
</button>

<?php wp_footer(); ?>
</body>
</html>
