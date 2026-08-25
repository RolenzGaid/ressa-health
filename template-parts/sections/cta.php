<?php
/**
 * Closing call to action.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;
?>
<section id="start" class="rh-section rh-cta" aria-labelledby="cta-title">
	<div class="rh-cta__inner">
		<h2 id="cta-title" class="rh-display rh-display--lg rh-cta__title" data-rh-reveal="up">
			<?php ressa_the_html( 'cta_title' ); ?>
		</h2>

		<p class="rh-lede rh-cta__lede" data-rh-reveal="up" style="--reveal-delay:.1s">
			<?php ressa_the_html( 'cta_lede' ); ?>
		</p>

		<div class="rh-btn-group rh-cta__actions" data-rh-reveal="up" style="--reveal-delay:.2s">
			<?php ressa_button( ressa_opt( 'cta_label' ), ressa_opt( 'cta_url' ), array( 'variant' => 'primary' ) ); ?>
		</div>
	</div>
</section>
