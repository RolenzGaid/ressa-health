<?php
/**
 * One story card — either a hover-to-play video or a pull quote.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

$ressa_story = isset( $args['story'] ) ? $args['story'] : array();

if ( ! $ressa_story ) {
	return;
}

$ressa_format = ressa_item( $ressa_story, 'format', 'video' );
$ressa_video  = ressa_story_video( $ressa_story );
$ressa_name   = ressa_item( $ressa_story, 'title' );
$ressa_meta   = ressa_item( $ressa_story, 'meta' );

if ( 'quote' === $ressa_format ) :
	?>
	<figure class="rh-story rh-story--quote">
		<span class="rh-story__quote-mark" aria-hidden="true">&ldquo;</span>
		<blockquote class="rh-story__quote">
			<?php echo wp_kses( ressa_item( $ressa_story, 'quote' ), ressa_allowed_inline_html() ); ?>
		</blockquote>
		<figcaption class="rh-story__attrib">
			<?php echo esc_html( $ressa_name ); ?>
			<?php if ( $ressa_meta ) : ?>
				<span> &middot; <?php echo esc_html( wp_strip_all_tags( $ressa_meta ) ); ?></span>
			<?php endif; ?>
		</figcaption>
	</figure>
	<?php
	return;
endif;
?>
<figure class="rh-story rh-story--video" data-rh-story<?php echo $ressa_video ? ' data-has-video="true"' : ''; ?>>
	<div class="rh-story__media">
		<?php
		if ( ! empty( $ressa_story['image_id'] ) ) {
			echo wp_get_attachment_image(
				(int) $ressa_story['image_id'],
				'ressa-portrait',
				false,
				array(
					'loading' => 'lazy',
					'alt'     => esc_attr( $ressa_name ),
				)
			);
		}
		?>

		<?php if ( $ressa_video ) : ?>
			<video
				data-story-video
				src="<?php echo esc_url( $ressa_video ); ?>"
				muted
				loop
				playsinline
				preload="none"
				tabindex="-1"
				aria-hidden="true"
			></video>
		<?php endif; ?>

		<span class="rh-story__scrim" aria-hidden="true"></span>

		<button class="rh-story__play" type="button" data-story-toggle>
			<?php ressa_the_icon( 'play' ); ?>
			<span class="screen-reader-text">
				<?php
				printf(
					/* translators: %s: member name. */
					esc_html__( 'Play the story of %s', 'ressa-health' ),
					esc_html( $ressa_name )
				);
				?>
			</span>
		</button>
	</div>

	<figcaption class="rh-story__caption">
		<span class="rh-story__name"><?php echo esc_html( $ressa_name ); ?></span>
		<?php if ( $ressa_meta ) : ?>
			<span class="rh-story__meta"><?php echo wp_kses( $ressa_meta, ressa_allowed_inline_html() ); ?></span>
		<?php endif; ?>
	</figcaption>
</figure>
