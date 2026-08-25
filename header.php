<?php
/**
 * Site header.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<a class="skip-link" href="#main"><?php esc_html_e( 'Skip to content', 'ressa-health' ); ?></a>

<header class="rh-header" data-rh-header>
	<div class="rh-header__inner">

		<?php ressa_brand( 'header' ); ?>

		<nav class="rh-nav" aria-label="<?php esc_attr_e( 'Primary', 'ressa-health' ); ?>">
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'container'      => false,
						'menu_class'     => 'rh-nav__list',
						'depth'          => 2,
					)
				);
			} else {
				ressa_fallback_menu( 'rh-nav__list' );
			}
			?>
		</nav>

		<div class="rh-header__actions">
			<a class="rh-header__icon-btn" href="<?php echo esc_url( ressa_opt( 'header_search_url' ) ); ?>">
				<?php ressa_the_icon( 'globe' ); ?>
				<span class="screen-reader-text"><?php esc_html_e( 'Search the site', 'ressa-health' ); ?></span>
			</a>

			<?php
			ressa_button(
				ressa_opt( 'header_cta_label' ),
				ressa_opt( 'header_cta_url' ),
				array(
					'variant' => 'primary',
					'size'    => 'sm',
					'class'   => 'rh-header__cta',
				)
			);
			?>

			<button class="rh-burger" type="button" aria-expanded="false" aria-controls="rh-drawer" data-rh-burger>
				<span class="rh-burger__bar"></span><span class="rh-burger__bar"></span><span class="rh-burger__bar"></span>
				<span class="screen-reader-text"><?php esc_html_e( 'Toggle navigation', 'ressa-health' ); ?></span>
			</button>
		</div>
	</div>

</header>

<div class="rh-drawer" id="rh-drawer" data-rh-drawer hidden>
	<nav aria-label="<?php esc_attr_e( 'Mobile', 'ressa-health' ); ?>">
		<?php
		if ( has_nav_menu( 'primary' ) ) {
			wp_nav_menu(
				array(
					'theme_location' => 'primary',
					'container'      => false,
					'menu_class'     => 'rh-drawer__list',
					'depth'          => 2,
				)
			);
		} else {
			ressa_fallback_menu( 'rh-drawer__list' );
		}
		?>
	</nav>

	<?php
	ressa_button(
		ressa_opt( 'header_cta_label' ),
		ressa_opt( 'header_cta_url' ),
		array( 'variant' => 'primary' )
	);
	?>
</div>

<main id="main" class="rh-main">
