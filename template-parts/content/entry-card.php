<?php
/**
 * Post card used in archives.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

$ressa_index = isset( $args['index'] ) ? (int) $args['index'] : 0;
?>
<article <?php post_class( 'rh-entry-card rh-media-zoom' ); ?> data-rh-reveal="up" style="--stagger-index:<?php echo (int) $ressa_index; ?>">
	<a href="<?php the_permalink(); ?>" class="rh-entry-card__media" aria-hidden="true" tabindex="-1">
		<div class="rh-media rh-media--mint">
			<?php
			if ( has_post_thumbnail() ) {
				the_post_thumbnail(
					'ressa-card',
					array(
						'loading' => 'lazy',
						'alt'     => '',
					)
				);
			} else {
				echo '<span class="rh-media__placeholder">' . ressa_icon( 'image' ) . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput
			}
			?>
		</div>
	</a>

	<?php ressa_entry_meta(); ?>

	<h2 class="rh-entry-card__title">
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
	</h2>

	<p class="rh-feature__text"><?php echo esc_html( wp_trim_words( get_the_excerpt(), 24 ) ); ?></p>
</article>
