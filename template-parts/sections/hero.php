<?php
/**
 * Hero.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

$ressa_hero_bg    = RESSA_URI . '/assets/img/hero-background.webp';
$ressa_hero_woman = RESSA_URI . '/assets/img/hero-woman.webp';
?>
<section id="hero" class="rh-hero" aria-labelledby="hero-title">

	<img
		class="rh-hero__bg"
		src="<?php echo esc_url( $ressa_hero_bg ); ?>"
		alt=""
		width="1771"
		height="888"
		fetchpriority="high"
		decoding="async"
	>

	<img
		class="rh-hero__figure"
		src="<?php echo esc_url( $ressa_hero_woman ); ?>"
		alt=""
		width="699"
		height="833"
		fetchpriority="high"
		decoding="async"
	>

	<div class="rh-hero__glass" data-rh-reveal="fade" data-rh-stagger>

		<p class="rh-eyebrow" style="--stagger-index:0"><?php ressa_the_html( 'hero_eyebrow' ); ?></p>

		<h1 id="hero-title" class="rh-display rh-display--xl rh-hero__title" style="--stagger-index:1">
			<?php ressa_the_html( 'hero_title' ); ?>
		</h1>

		<p class="rh-lede rh-hero__lede" style="--stagger-index:2">
			<?php ressa_the_html( 'hero_lede' ); ?>
		</p>

		<div class="rh-btn-group rh-hero__actions" style="--stagger-index:3">
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
