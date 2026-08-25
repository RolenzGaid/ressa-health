<?php
/**
 * Site footer.
 *
 * The landing page ends on the closing call to action, so there is no footer
 * band — this template only closes the document.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;
?>
</main>

<button class="rh-to-top" type="button" data-rh-to-top>
	<?php ressa_the_icon( 'arrow-up' ); ?>
	<span class="screen-reader-text"><?php esc_html_e( 'Back to top', 'ressa-health' ); ?></span>
</button>

<?php wp_footer(); ?>
</body>
</html>
