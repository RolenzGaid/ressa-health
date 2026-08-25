<?php
/**
 * Comparison table.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

$ressa_rows = ressa_items( 'rh_compare' );

if ( ! $ressa_rows ) {
	return;
}
?>
<?php ressa_section_open( 'compare', array( 'labelledby' => 'compare-title' ) ); ?>
	<div class="rh-container rh-compare__inner">
		<div class="rh-compare__grid">

			<div class="rh-compare__copy" data-rh-reveal="left" data-rh-stagger>
				<p class="rh-eyebrow" style="--stagger-index:0"><?php ressa_the_html( 'compare_eyebrow' ); ?></p>

				<h2 id="compare-title" class="rh-display rh-display--md" style="--stagger-index:1">
					<?php ressa_the_html( 'compare_title' ); ?>
				</h2>

				<p class="rh-lede" style="--stagger-index:2"><?php ressa_the_html( 'compare_lede' ); ?></p>
			</div>

			<div class="rh-compare__table-wrap" data-rh-reveal="right">
				<div class="rh-compare__frame">
				<table class="rh-compare__table">
					<caption class="screen-reader-text">
						<?php esc_html_e( 'How Ressa Health compares with single-layer health products', 'ressa-health' ); ?>
					</caption>
					<thead>
						<tr>
							<th scope="col"><?php echo esc_html( wp_strip_all_tags( ressa_opt( 'compare_col_feature' ) ) ); ?></th>
							<th scope="col"><?php echo esc_html( wp_strip_all_tags( ressa_opt( 'compare_col_ours' ) ) ); ?></th>
							<th scope="col"><?php echo esc_html( wp_strip_all_tags( ressa_opt( 'compare_col_other' ) ) ); ?></th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ( $ressa_rows as $ressa_index => $ressa_row ) : ?>
							<tr style="--row-index:<?php echo (int) $ressa_index; ?>">
								<th scope="row"><?php echo wp_kses( ressa_item( $ressa_row, 'title' ), ressa_allowed_inline_html() ); ?></th>
								<td><?php ressa_compare_mark( ressa_item( $ressa_row, 'ours', 'yes' ) ); ?></td>
								<td><?php ressa_compare_mark( ressa_item( $ressa_row, 'other', 'no' ) ); ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
				</div>
			</div>

		</div>
	</div>
<?php ressa_section_close(); ?>
