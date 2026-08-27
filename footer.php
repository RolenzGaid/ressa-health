<?php
/**
 * Site footer.
 *
 * A landing-page footer: the brand, the copyright line and the two legal
 * links. Everything else belongs in the closing call to action above it.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;
?>
</main>

<footer class="rh-footer">
	<div class="rh-footer__inner">

		<?php ressa_brand( 'footer' ); ?>

		<p class="rh-footer__copyright">
			<?php echo wp_kses( ressa_tokens( ressa_opt( 'footer_copyright' ) ), ressa_allowed_inline_html() ); ?>
		</p>

		<nav aria-label="<?php esc_attr_e( 'Legal', 'ressa-health' ); ?>">
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
			} else {
				ressa_fallback_legal_menu();
			}
			?>
		</nav>

	</div>
</footer>

<button class="rh-to-top" type="button" data-rh-to-top>
	<?php ressa_the_icon( 'arrow-up' ); ?>
	<span class="screen-reader-text"><?php esc_html_e( 'Back to top', 'ressa-health' ); ?></span>
</button>

<?php wp_footer(); ?>
</body>
</html>
