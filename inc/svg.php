<?php
/**
 * Inline SVG helpers.
 *
 * Icons are inlined rather than loaded from a sprite so they inherit
 * `currentColor` and can be animated with CSS. Every glyph here is a neutral
 * placeholder intended to be swapped for final brand artwork.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

/**
 * Icon path data, keyed by name.
 *
 * @return array<string, string>
 */
function ressa_icon_paths() {
	return array(
		'arrow-right'  => '<path d="M4 12h15M13 6l6 6-6 6"/>',
		'arrow-left'   => '<path d="M20 12H5M11 6l-6 6 6 6"/>',
		'arrow-up'     => '<path d="M12 20V5M6 11l6-6 6 6"/>',
		'chevron-left' => '<path d="M15 5l-7 7 7 7"/>',
		'chevron-right'=> '<path d="M9 5l7 7-7 7"/>',
		'check'        => '<path d="M4.5 12.5l5 5 10-11"/>',
		'close'        => '<path d="M7 7l10 10M17 7L7 17"/>',
		'search'       => '<circle cx="11" cy="11" r="6.5"/><path d="M16 16l4.5 4.5"/>',
		'globe'        => '<circle cx="12" cy="12" r="8.5"/><path d="M3.5 12h17M12 3.5c2.4 2.4 3.6 5.4 3.6 8.5S14.4 18.1 12 20.5c-2.4-2.4-3.6-5.4-3.6-8.5S9.6 5.9 12 3.5z"/>',
		'play'         => '<path d="M8 5.5l11 6.5-11 6.5z" fill="currentColor" stroke="none"/>',
		'quote'        => '<path d="M9 6c-3 1.5-4.5 4-4.5 7.5V18h6v-6H7c0-2 .7-3.4 2-4.3zM19 6c-3 1.5-4.5 4-4.5 7.5V18h6v-6H17c0-2 .7-3.4 2-4.3z" fill="currentColor" stroke="none"/>',
		'image'        => '<rect x="3" y="4.5" width="18" height="15" rx="2.5"/><circle cx="8.5" cy="10" r="1.8"/><path d="M3.5 17l5-5 4 4 3-2.5 5 4.5"/>',
		'chart'        => '<path d="M4 19V5M4 19h16"/><path d="M7.5 15.5l3.5-4 3 2.5 4.5-6"/>',
		'sparkle'      => '<path d="M12 3.5l1.9 5.1 5.1 1.9-5.1 1.9L12 17.5l-1.9-5.1L5 10.5l5.1-1.9z"/><path d="M18.5 16.5l.8 2 2 .8-2 .8-.8 2-.8-2-2-.8 2-.8z"/>',
		'book'         => '<path d="M4 5.5A2.5 2.5 0 016.5 3H20v14.5H6.5A2.5 2.5 0 004 20z"/><path d="M4 17.5A2.5 2.5 0 016.5 15H20"/>',
		'pin'          => '<path d="M12 21s6.5-6 6.5-10.5a6.5 6.5 0 10-13 0C5.5 15 12 21 12 21z"/><circle cx="12" cy="10.5" r="2.5"/>',
		'trend'        => '<path d="M4 16.5l5-5 3.5 3.5L20 7"/><path d="M15 7h5v5"/>',
		'share'        => '<circle cx="6" cy="12" r="2.5"/><circle cx="17.5" cy="6" r="2.5"/><circle cx="17.5" cy="18" r="2.5"/><path d="M8.3 10.8l7-3.6M8.3 13.2l7 3.6"/>',
		'shield'       => '<path d="M12 3l7 3v5.5c0 4.5-3 8-7 9.5-4-1.5-7-5-7-9.5V6z"/><path d="M9 12l2 2 4-4.5"/>',
		'flask'        => '<path d="M9.5 3v6L4.8 17.4A2 2 0 006.5 20.5h11a2 2 0 001.7-3.1L14.5 9V3"/><path d="M8.5 3h7M7.4 14h9.2"/>',
		'dna'          => '<path d="M7 3c0 5 10 5 10 10S7 18 7 21"/><path d="M17 3c0 5-10 5-10 10s10 3 10 8"/><path d="M8.5 7h7M8.5 17h7"/>',
		'watch'        => '<rect x="7" y="6" width="10" height="12" rx="3"/><path d="M9.5 6l.5-3h4l.5 3M9.5 18l.5 3h4l.5-3M12 10v2.5l1.8 1"/>',
		'scan'         => '<path d="M4 8V5.5A1.5 1.5 0 015.5 4H8M16 4h2.5A1.5 1.5 0 0120 5.5V8M20 16v2.5a1.5 1.5 0 01-1.5 1.5H16M8 20H5.5A1.5 1.5 0 014 18.5V16"/><circle cx="12" cy="12" r="3"/>',
		'clipboard'    => '<rect x="5" y="5" width="14" height="16" rx="2"/><path d="M9 5V3.8A1.2 1.2 0 0110.2 2.6h3.6A1.2 1.2 0 0115 3.8V5"/><path d="M9 11h6M9 15h4"/>',
		'microbe'      => '<circle cx="12" cy="12" r="7"/><circle cx="10" cy="10.5" r="1.3"/><circle cx="14.5" cy="13" r="1"/><path d="M12 5V3M19 12h2M12 19v2M5 12H3"/>',
		'upload'       => '<path d="M12 16V5M8 9l4-4 4 4"/><path d="M4.5 15v3A2.5 2.5 0 007 20.5h10a2.5 2.5 0 002.5-2.5v-3"/>',
		'link'         => '<path d="M10.5 13.5a4 4 0 005.7 0l2.6-2.6a4 4 0 10-5.7-5.7L11.6 6.7"/><path d="M13.5 10.5a4 4 0 00-5.7 0l-2.6 2.6a4 4 0 105.7 5.7l1.4-1.5"/>',
		'menu'         => '<path d="M4 7h16M4 12h16M4 17h16"/>',
	);
}

/**
 * Return an inline SVG icon.
 *
 * @param string $name    Icon key.
 * @param array  $args    Optional class / size / title overrides.
 * @return string
 */
function ressa_icon( $name, $args = array() ) {
	$paths = ressa_icon_paths();

	if ( ! isset( $paths[ $name ] ) ) {
		return '';
	}

	$args = wp_parse_args(
		$args,
		array(
			'class' => 'rh-icon',
			'title' => '',
		)
	);

	$label = $args['title']
		? ' role="img" aria-label="' . esc_attr( $args['title'] ) . '"'
		: ' aria-hidden="true" focusable="false"';

	return sprintf(
		'<svg class="%s" viewBox="0 0 24 24"%s>%s</svg>',
		esc_attr( $args['class'] ),
		$label,
		$paths[ $name ]
	);
}

/**
 * Echo an inline icon.
 *
 * @param string $name Icon key.
 * @param array  $args Overrides.
 */
function ressa_the_icon( $name, $args = array() ) {
	echo ressa_icon( $name, $args ); // phpcs:ignore WordPress.Security.EscapeOutput -- trusted inline SVG.
}

/**
 * Placeholder glyphs assigned to the seven layers, in wheel order.
 *
 * @return string[]
 */
function ressa_layer_icons() {
	return array( 'flask', 'dna', 'microbe', 'watch', 'scan', 'clipboard', 'chart' );
}

/**
 * Placeholder glyphs assigned to the platform feature cards.
 *
 * @return string[]
 */
function ressa_feature_icons() {
	return array( 'chart', 'sparkle', 'book', 'pin', 'trend', 'share' );
}

/**
 * Lighten or darken a hex colour.
 *
 * @param string $hex     Hex colour, with or without leading hash.
 * @param float  $percent -1 (black) … 1 (white).
 * @return string
 */
function ressa_shade_hex( $hex, $percent ) {
	$hex = ltrim( (string) $hex, '#' );

	if ( 3 === strlen( $hex ) ) {
		$hex = $hex[0] . $hex[0] . $hex[1] . $hex[1] . $hex[2] . $hex[2];
	}

	if ( 6 !== strlen( $hex ) ) {
		$hex = '0f5d57';
	}

	$out = '#';

	for ( $i = 0; $i < 3; $i++ ) {
		$channel = hexdec( substr( $hex, $i * 2, 2 ) );
		$target  = $percent > 0 ? 255 : 0;
		$channel = (int) round( $channel + ( $target - $channel ) * abs( $percent ) );
		$out    .= str_pad( dechex( max( 0, min( 255, $channel ) ) ), 2, '0', STR_PAD_LEFT );
	}

	return $out;
}

/**
 * Point on the wheel, measured clockwise from twelve o'clock.
 *
 * @param float $cx    Centre x.
 * @param float $cy    Centre y.
 * @param float $r     Radius.
 * @param float $angle Degrees clockwise from top.
 * @return array{0: float, 1: float}
 */
function ressa_polar( $cx, $cy, $r, $angle ) {
	$rad = deg2rad( $angle );

	return array(
		round( $cx + $r * sin( $rad ), 2 ),
		round( $cy - $r * cos( $rad ), 2 ),
	);
}

/**
 * Render the seven-layer wheel.
 *
 * Each layer owns one slice. The slice for the current tab is revealed by CSS
 * (`.is-active`), so switching tabs cross-fades one slice into the next.
 *
 * @param array $layers Normalised layer items.
 */
function ressa_render_wheel( $layers ) {
	$count = max( 1, count( $layers ) );
	$step  = 360 / $count;

	$cx      = 285.0;
	$cy      = 258.0;
	$r_ring  = 186.0;   // Thin outline circle.
	$r_wedge = 202.0;   // Filled slice sits slightly proud of the outline.
	$r_hub   = 50.0;
	$r_label = 208.0;

	echo '<svg class="rh-wheel" viewBox="0 0 570 528" role="img" aria-label="' .
		esc_attr__( 'Seven health data layers arranged around a single story', 'ressa-health' ) .
		'" style="--wheel-cx:' . esc_attr( $cx ) . 'px;--wheel-cy:' . esc_attr( $cy ) . 'px">';

	// -- Slice fills --------------------------------------------------------
	echo '<defs>';

	foreach ( $layers as $index => $layer ) {
		$accent   = ressa_item( $layer, 'accent', '#0f5d57' );
		$image_id = isset( $layer['image_id'] ) ? (int) $layer['image_id'] : 0;
		$fill_id  = 'rh-slice-' . $index;

		if ( $image_id ) {
			$src = wp_get_attachment_image_url( $image_id, 'large' );

			printf(
				'<pattern id="%1$s" patternUnits="objectBoundingBox" width="1" height="1">
					<image href="%2$s" x="0" y="0" width="%3$s" height="%3$s" preserveAspectRatio="xMidYMid slice"/>
				</pattern>',
				esc_attr( $fill_id ),
				esc_url( $src ),
				esc_attr( (string) ( $r_wedge * 2 ) )
			);
			continue;
		}

		// Placeholder: a soft two-stop gradient in the layer's accent colour.
		printf(
			'<linearGradient id="%1$s" x1="0" y1="0" x2="0.85" y2="1">
				<stop offset="0%%" stop-color="%2$s"/>
				<stop offset="100%%" stop-color="%3$s"/>
			</linearGradient>',
			esc_attr( $fill_id ),
			esc_attr( ressa_shade_hex( $accent, 0.22 ) ),
			esc_attr( ressa_shade_hex( $accent, -0.28 ) )
		);
	}

	echo '</defs>';

	// -- Slices -------------------------------------------------------------
	echo '<g class="rh-wheel__wedges">';

	foreach ( $layers as $index => $layer ) {
		$start = $index * $step;
		$end   = $start + $step;

		list( $x1, $y1 ) = ressa_polar( $cx, $cy, $r_wedge, $start );
		list( $x2, $y2 ) = ressa_polar( $cx, $cy, $r_wedge, $end );

		$large = ( $step > 180 ) ? 1 : 0;

		printf(
			'<path class="rh-wheel__wedge" data-wheel-slice="%1$d" d="M %2$s %3$s L %4$s %5$s A %6$s %6$s 0 %7$d 1 %8$s %9$s Z" fill="url(#rh-slice-%1$d)"/>',
			(int) $index,
			esc_attr( (string) $cx ),
			esc_attr( (string) $cy ),
			esc_attr( (string) $x1 ),
			esc_attr( (string) $y1 ),
			esc_attr( (string) $r_wedge ),
			$large,
			esc_attr( (string) $x2 ),
			esc_attr( (string) $y2 )
		);
	}

	echo '</g>';

	// -- Outline, spokes, dots and labels -----------------------------------
	printf(
		'<circle class="rh-wheel__outline" cx="%s" cy="%s" r="%s"/>',
		esc_attr( (string) $cx ),
		esc_attr( (string) $cy ),
		esc_attr( (string) $r_ring )
	);

	foreach ( $layers as $index => $layer ) {
		$angle = $index * $step;

		list( $sx, $sy ) = ressa_polar( $cx, $cy, $r_hub, $angle );
		list( $ex, $ey ) = ressa_polar( $cx, $cy, $r_ring, $angle );
		list( $dx, $dy ) = ressa_polar( $cx, $cy, $r_ring, $angle );
		list( $lx, $ly ) = ressa_polar( $cx, $cy, $r_label, $angle );

		printf(
			'<line class="rh-wheel__spoke" x1="%s" y1="%s" x2="%s" y2="%s"/>',
			esc_attr( (string) $sx ),
			esc_attr( (string) $sy ),
			esc_attr( (string) $ex ),
			esc_attr( (string) $ey )
		);

		printf(
			'<circle class="rh-wheel__dot" data-wheel-dot="%d" cx="%s" cy="%s" r="4.6"/>',
			(int) $index,
			esc_attr( (string) $dx ),
			esc_attr( (string) $dy )
		);

		// Anchor labels away from the wheel so they never overlap a slice.
		$sin = sin( deg2rad( $angle ) );
		$cos = cos( deg2rad( $angle ) );

		if ( $sin > 0.25 ) {
			$anchor = 'start';
			$lx    += 6;
		} elseif ( $sin < -0.25 ) {
			$anchor = 'end';
			$lx    -= 6;
		} else {
			$anchor = 'middle';
		}

		$ly += ( $cos > 0.5 ) ? -9 : ( ( $cos < -0.5 ) ? 19 : 5 );

		printf(
			'<text class="rh-wheel__label" data-wheel-label="%d" x="%s" y="%s" text-anchor="%s">%s</text>',
			(int) $index,
			esc_attr( (string) $lx ),
			esc_attr( (string) $ly ),
			esc_attr( $anchor ),
			esc_html( ressa_item( $layer, 'title' ) )
		);
	}

	// -- Hub ----------------------------------------------------------------
	printf(
		'<g class="rh-wheel__hub-group">
			<circle class="rh-wheel__hub" cx="%1$s" cy="%2$s" r="%3$s"/>
			<text class="rh-wheel__hub-text" x="%1$s" y="%4$s">%5$s</text>
			<text class="rh-wheel__hub-text" x="%1$s" y="%6$s">%7$s</text>
		</g>',
		esc_attr( (string) $cx ),
		esc_attr( (string) $cy ),
		esc_attr( (string) $r_hub ),
		esc_attr( (string) ( $cy - 2 ) ),
		esc_html( strtoupper( wp_strip_all_tags( ressa_opt( 'layers_hub_line_a' ) ) ) ),
		esc_attr( (string) ( $cy + 13 ) ),
		esc_html( strtoupper( wp_strip_all_tags( ressa_opt( 'layers_hub_line_b' ) ) ) )
	);

	echo '</svg>';
}

/**
 * Render the orbit diagram beside "A single lab panel is one frame of a film".
 *
 * Node labels are pulled from the seven layers so the illustration always
 * reflects the data sources the site actually talks about.
 *
 * @param array $layers Normalised layer items.
 */
function ressa_render_orbit( $layers ) {
	$nodes = array_slice( $layers, 0, 6 );
	$count = max( 1, count( $nodes ) );
	$step  = 360 / $count;

	$cx = 260.0;
	$cy = 197.0;
	$r  = 150.0;

	$icons = ressa_layer_icons();
	$paths = ressa_icon_paths();

	echo '<div class="rh-orbit" data-rh-orbit>';
	echo '<svg class="rh-orbit__svg" viewBox="0 0 520 400" role="img" aria-label="' .
		esc_attr__( 'A single reading surrounded by the other layers it is missing', 'ressa-health' ) . '">';

	printf(
		'<circle class="rh-orbit__ring" cx="%s" cy="%s" r="%s"/>',
		esc_attr( (string) $cx ),
		esc_attr( (string) $cy ),
		esc_attr( (string) $r )
	);

	foreach ( $nodes as $index => $node ) {
		$angle = $index * $step + 12;

		list( $nx, $ny ) = ressa_polar( $cx, $cy, $r, $angle );
		list( $sx, $sy ) = ressa_polar( $cx, $cy, 42.0, $angle );

		$length = (int) round( $r - 42 );

		printf(
			'<line class="rh-orbit__spoke" style="--i:%d;--len:%d" x1="%s" y1="%s" x2="%s" y2="%s"/>',
			(int) $index,
			$length,
			esc_attr( (string) $sx ),
			esc_attr( (string) $sy ),
			esc_attr( (string) $nx ),
			esc_attr( (string) $ny )
		);

		$label = ressa_item( $node, 'title' );
		$width = max( 78, 34 + strlen( $label ) * 5.4 );

		$glyph      = isset( $icons[ $index ] ) ? $icons[ $index ] : 'image';
		$glyph_path = isset( $paths[ $glyph ] ) ? $paths[ $glyph ] : '';

		printf(
			'<g class="rh-orbit__node" style="--i:%d">
				<rect class="rh-orbit__node-card" x="%s" y="%s" width="%s" height="27" rx="13.5"/>
				<svg class="rh-orbit__node-icon" x="%s" y="%s" width="12" height="12" viewBox="0 0 24 24">%s</svg>
				<text class="rh-orbit__node-text" x="%s" y="%s">%s</text>
			</g>',
			(int) $index,
			esc_attr( (string) round( $nx - $width / 2, 2 ) ),
			esc_attr( (string) round( $ny - 13.5, 2 ) ),
			esc_attr( (string) round( $width, 2 ) ),
			esc_attr( (string) round( $nx - $width / 2 + 9, 2 ) ),
			esc_attr( (string) round( $ny - 6, 2 ) ),
			$glyph_path,
			esc_attr( (string) round( $nx - $width / 2 + 26, 2 ) ),
			esc_attr( (string) round( $ny + 3.5, 2 ) ),
			esc_html( $label )
		);
	}

	printf(
		'<circle class="rh-orbit__hub-ring" cx="%1$s" cy="%2$s" r="34"/>
		<circle class="rh-orbit__hub" cx="%1$s" cy="%2$s" r="30"/>
		<path class="rh-orbit__hub-mark" d="M%3$s %4$s l7 -9 6 6 5 -12 6 15"/>',
		esc_attr( (string) $cx ),
		esc_attr( (string) $cy ),
		esc_attr( (string) ( $cx - 12 ) ),
		esc_attr( (string) ( $cy + 4 ) )
	);

	echo '</svg></div>';
}
