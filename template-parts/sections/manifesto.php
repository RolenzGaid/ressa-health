<?php
/**
 * Statement — "You are not a result. You are a story."
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;
?>
<?php ressa_section_open( 'manifesto', array( 'spacing' => 'tight', 'labelledby' => 'manifesto-title' ) ); ?>
	<div class="rh-manifesto__inner">
		<h2 id="manifesto-title" class="rh-display rh-display--lg rh-manifesto__title" data-rh-reveal="up">
			<?php ressa_the_html( 'manifesto_title' ); ?>
		</h2>

		<p class="rh-lede rh-manifesto__lede" data-rh-reveal="up" style="--reveal-delay:.12s">
			<?php ressa_the_html( 'manifesto_lede' ); ?>
		</p>
	</div>
<?php ressa_section_close(); ?>
