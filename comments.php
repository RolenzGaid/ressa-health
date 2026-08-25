<?php
/**
 * Comments.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

if ( post_password_required() ) {
	return;
}
?>
<div id="comments" class="rh-comments">
	<?php if ( have_comments() ) : ?>
		<h2 class="rh-display rh-display--sm">
			<?php
			printf(
				/* translators: %d: comment count. */
				esc_html( _n( '%d response', '%d responses', get_comments_number(), 'ressa-health' ) ),
				(int) get_comments_number()
			);
			?>
		</h2>

		<ol class="rh-comment-list">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'short_ping' => true,
					'avatar_size' => 44,
				)
			);
			?>
		</ol>

		<?php the_comments_pagination( array( 'class' => 'rh-pagination' ) ); ?>
	<?php endif; ?>

	<?php
	comment_form(
		array(
			'class_submit'  => 'rh-btn rh-btn--primary',
			'title_reply'   => __( 'Leave a comment', 'ressa-health' ),
			'title_reply_before' => '<h2 class="rh-display rh-display--sm">',
			'title_reply_after'  => '</h2>',
		)
	);
	?>
</div>
