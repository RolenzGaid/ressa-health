<?php
/**
 * Platform feature cards.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

$ressa_features = ressa_items( 'rh_feature' );

if ( ! $ressa_features ) {
	return;
}

$ressa_icons = ressa_feature_icons();
?>
<?php ressa_section_open( 'features', array( 'labelledby' => 'features-title' ) ); ?>
	<div class="rh-container">

		<?php
		ressa_section_head(
			array(
				'eyebrow' => ressa_html( 'features_eyebrow' ),
				'title'   => ressa_html( 'features_title' ),
				'id'      => 'features-title',
				'class'   => 'rh-features__head',
			)
		);
		?>

		<div class="rh-features__grid" data-rh-stagger>
			<?php foreach ( $ressa_features as $ressa_index => $ressa_feature ) : ?>
				<article class="rh-feature rh-media-zoom" data-rh-reveal="up" style="--stagger-index:<?php echo (int) $ressa_index; ?>">
					<?php
					ressa_media_frame(
						$ressa_feature,
						array(
							'classes' => 'rh-media--mint',
							'icon'    => isset( $ressa_icons[ $ressa_index % count( $ressa_icons ) ] ) ? $ressa_icons[ $ressa_index % count( $ressa_icons ) ] : 'image',
						)
					);
					?>

					<h3 class="rh-feature__title"><?php echo wp_kses( ressa_item( $ressa_feature, 'title' ), ressa_allowed_inline_html() ); ?></h3>
					<p class="rh-feature__text"><?php echo wp_kses( ressa_item( $ressa_feature, 'description' ), ressa_allowed_inline_html() ); ?></p>

					<?php if ( ressa_item( $ressa_feature, 'link_label' ) ) : ?>
						<p class="rh-feature__link">
							<a class="rh-link" href="<?php echo esc_url( ressa_item( $ressa_feature, 'link_url', '#' ) ); ?>">
								<?php echo esc_html( ressa_item( $ressa_feature, 'link_label' ) ); ?>
								<?php ressa_the_icon( 'arrow-right' ); ?>
							</a>
						</p>
					<?php endif; ?>
				</article>
			<?php endforeach; ?>
		</div>

	</div>
<?php ressa_section_close(); ?>
