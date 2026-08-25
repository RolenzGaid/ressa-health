<?php
/**
 * Hero.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;
?>
<section id="hero" class="rh-hero" aria-labelledby="hero-title">
	<div class="rh-hero__inner">

		<p class="rh-eyebrow" data-rh-reveal="fade"><?php ressa_the_html( 'hero_eyebrow' ); ?></p>

		<h1 id="hero-title" class="rh-display rh-display--xl rh-hero__title" data-rh-reveal="up">
			<?php ressa_the_html( 'hero_title' ); ?>
		</h1>

		<p class="rh-lede rh-hero__lede" data-rh-reveal="up" style="--reveal-delay:.12s">
			<?php ressa_the_html( 'hero_lede' ); ?>
		</p>

		<div class="rh-btn-group rh-hero__actions" data-rh-reveal="up" style="--reveal-delay:.22s">
			<?php
			ressa_button( ressa_opt( 'hero_cta_label' ), ressa_opt( 'hero_cta_url' ), array( 'variant' => 'primary' ) );
			ressa_button(
				ressa_opt( 'hero_alt_label' ),
				ressa_opt( 'hero_alt_url' ),
				array(
					'variant' => 'ghost',
					'icon'    => 'arrow-right',
				)
			);
			?>
		</div>

	</div>
</section>
