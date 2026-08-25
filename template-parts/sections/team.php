<?php
/**
 * Medical team.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

$ressa_members = ressa_items( 'rh_member' );

if ( ! $ressa_members ) {
	return;
}
?>
<?php ressa_section_open( 'team', array( 'labelledby' => 'team-title' ) ); ?>
	<div class="rh-container">

		<?php
		ressa_section_head(
			array(
				'eyebrow' => ressa_html( 'team_eyebrow' ),
				'title'   => ressa_html( 'team_title' ),
				'lede'    => ressa_html( 'team_lede' ),
				'size'    => 'md',
				'id'      => 'team-title',
				'class'   => 'rh-team__head',
			)
		);
		?>

		<div class="rh-team__grid" data-rh-stagger>
			<?php foreach ( $ressa_members as $ressa_index => $ressa_member ) : ?>
				<article class="rh-member rh-media-zoom" data-rh-reveal="up" style="--stagger-index:<?php echo (int) $ressa_index; ?>">
					<?php
					ressa_media_frame(
						$ressa_member,
						array(
							'size'    => 'ressa-member',
							'classes' => 'rh-media--mint',
							'icon'    => 'clipboard',
						)
					);
					?>
					<h3 class="rh-member__name"><?php echo esc_html( ressa_item( $ressa_member, 'title' ) ); ?></h3>
					<p class="rh-member__role"><?php echo esc_html( ressa_item( $ressa_member, 'role' ) ); ?></p>
				</article>
			<?php endforeach; ?>
		</div>

	</div>
<?php ressa_section_close(); ?>
