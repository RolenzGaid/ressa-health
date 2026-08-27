<?php
/**
 * Field schemas.
 *
 * A single declarative description of every editable field drives three things
 * at once: post type registration, the meta boxes and the Customizer. Adding a
 * field anywhere in the theme means adding one array entry here.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

/**
 * Repeatable front page content, expressed as custom post types.
 *
 * @return array<string, array<string, mixed>>
 */
function ressa_post_types() {
	return array(

		'rh_layer' => array(
			'singular'   => __( 'Data Layer', 'ressa-health' ),
			'plural'     => __( 'Data Layers', 'ressa-health' ),
			'menu_icon'  => 'dashicons-chart-pie',
			'title_label' => __( 'Tab label (e.g. Labs)', 'ressa-health' ),
			'help'       => __( 'The seven layers shown in the “We read seven” wheel. Order here is the order around the wheel.', 'ressa-health' ),
			'fields'     => array(
				'eyebrow'     => array(
					'label' => __( 'Eyebrow', 'ressa-health' ),
					'type'  => 'text',
					'help'  => __( 'Small teal line above the heading, e.g. “Biomarkers, in context.”', 'ressa-health' ),
				),
				'headline'    => array(
					'label' => __( 'Heading', 'ressa-health' ),
					'type'  => 'text',
					'help'  => __( 'Leave empty to reuse the tab label.', 'ressa-health' ),
				),
				'description' => array(
					'label' => __( 'Description', 'ressa-health' ),
					'type'  => 'textarea',
				),
				'tags'        => array(
					'label' => __( 'Keyword pills', 'ressa-health' ),
					'type'  => 'tags',
					'help'  => __( 'Comma separated.', 'ressa-health' ),
				),
				'accent'      => array(
					'label'   => __( 'Wheel slice colour', 'ressa-health' ),
					'type'    => 'color',
					'help'    => __( 'Used for the slice when no image is set.', 'ressa-health' ),
					'default' => '#0f5d57',
				),
			),
			'image_label' => __( 'Wheel slice image', 'ressa-health' ),
		),

		'rh_step' => array(
			'singular'    => __( 'Process Step', 'ressa-health' ),
			'plural'      => __( 'Process Steps', 'ressa-health' ),
			'menu_icon'   => 'dashicons-editor-ol',
			'title_label' => __( 'Step heading', 'ressa-health' ),
			'help'        => __( 'The Test → Analyze → Act sequence revealed as visitors scroll through “Works with the data you already have”.', 'ressa-health' ),
			'fields'      => array(
				'rail_label'  => array(
					'label' => __( 'Short rail label', 'ressa-health' ),
					'type'  => 'text',
					'help'  => __( 'One word: Test, Analyze, Act.', 'ressa-health' ),
				),
				'step_label'  => array(
					'label' => __( 'Step label', 'ressa-health' ),
					'type'  => 'text',
					'help'  => __( 'e.g. “Step 01”.', 'ressa-health' ),
				),
				'description' => array(
					'label' => __( 'Description', 'ressa-health' ),
					'type'  => 'textarea',
				),
			),
			'image_label' => __( 'Step image', 'ressa-health' ),
		),

		'rh_feature' => array(
			'singular'    => __( 'Platform Feature', 'ressa-health' ),
			'plural'      => __( 'Platform Features', 'ressa-health' ),
			'menu_icon'   => 'dashicons-screenoptions',
			'title_label' => __( 'Feature name', 'ressa-health' ),
			'help'        => __( 'The card grid under “Everything you need to understand your health”.', 'ressa-health' ),
			'fields'      => array(
				'description' => array(
					'label' => __( 'Description', 'ressa-health' ),
					'type'  => 'textarea',
				),
				'link_label'  => array(
					'label' => __( 'Link label', 'ressa-health' ),
					'type'  => 'text',
					'help'  => __( 'Optional. Leave empty to hide the link.', 'ressa-health' ),
				),
				'link_url'    => array(
					'label' => __( 'Link URL', 'ressa-health' ),
					'type'  => 'url',
				),
			),
			'image_label' => __( 'Card image', 'ressa-health' ),
		),

		'rh_story' => array(
			'singular'    => __( 'Member Story', 'ressa-health' ),
			'plural'      => __( 'Member Stories', 'ressa-health' ),
			'menu_icon'   => 'dashicons-format-video',
			'title_label' => __( 'Member name', 'ressa-health' ),
			'help'        => __( 'Slides in the story carousel. Video slides play on hover.', 'ressa-health' ),
			'fields'      => array(
				'format'    => array(
					'label'   => __( 'Slide type', 'ressa-health' ),
					'type'    => 'select',
					'options' => array(
						'video' => __( 'Video', 'ressa-health' ),
						'quote' => __( 'Pull quote', 'ressa-health' ),
					),
					'default' => 'video',
				),
				'meta'      => array(
					'label' => __( 'Caption line', 'ressa-health' ),
					'type'  => 'text',
					'help'  => __( 'e.g. “Hashimoto’s, found at 31”.', 'ressa-health' ),
				),
				'quote'     => array(
					'label' => __( 'Quote', 'ressa-health' ),
					'type'  => 'textarea',
					'help'  => __( 'Used by pull quote slides only.', 'ressa-health' ),
				),
				'video_url' => array(
					'label' => __( 'Video file URL', 'ressa-health' ),
					'type'  => 'video',
					'help'  => __( 'MP4 or WebM. Plays muted on hover, poster image shows otherwise.', 'ressa-health' ),
				),
			),
			'image_label' => __( 'Poster image', 'ressa-health' ),
		),

		'rh_member' => array(
			'singular'    => __( 'Team Member', 'ressa-health' ),
			'plural'      => __( 'Team Members', 'ressa-health' ),
			'menu_icon'   => 'dashicons-groups',
			'title_label' => __( 'Name', 'ressa-health' ),
			'help'        => __( 'The medical team row.', 'ressa-health' ),
			'fields'      => array(
				'role' => array(
					'label' => __( 'Role', 'ressa-health' ),
					'type'  => 'text',
				),
			),
			'image_label' => __( 'Portrait', 'ressa-health' ),
		),

		'rh_compare' => array(
			'singular'      => __( 'Comparison Row', 'ressa-health' ),
			'plural'        => __( 'Comparison Rows', 'ressa-health' ),
			'menu_icon'     => 'dashicons-editor-table',
			'title_label'   => __( 'Row label', 'ressa-health' ),
			'help'          => __( 'Rows of the “One panel, or the whole picture” table.', 'ressa-health' ),
			'supports_image' => false,
			'fields'        => array(
				'ours'  => array(
					'label'   => __( 'Ressa Health column', 'ressa-health' ),
					'type'    => 'select',
					'options' => array(
						'yes'     => __( 'Included (tick)', 'ressa-health' ),
						'partial' => __( 'Partial (tilde)', 'ressa-health' ),
						'no'      => __( 'Not included (cross)', 'ressa-health' ),
					),
					'default' => 'yes',
				),
				'other' => array(
					'label'   => __( 'Comparison column', 'ressa-health' ),
					'type'    => 'select',
					'options' => array(
						'yes'     => __( 'Included (tick)', 'ressa-health' ),
						'partial' => __( 'Partial (tilde)', 'ressa-health' ),
						'no'      => __( 'Not included (cross)', 'ressa-health' ),
					),
					'default' => 'no',
				),
			),
		),

		'rh_trust' => array(
			'singular'      => __( 'Trust Promise', 'ressa-health' ),
			'plural'        => __( 'Trust Promises', 'ressa-health' ),
			'menu_icon'     => 'dashicons-shield-alt',
			'title_label'   => __( 'Promise', 'ressa-health' ),
			'help'          => __( 'The four mint cards under “Trust is part of the story, too.”', 'ressa-health' ),
			'supports_image' => false,
			'fields'        => array(
				'description' => array(
					'label' => __( 'Supporting line', 'ressa-health' ),
					'type'  => 'textarea',
				),
			),
		),

		'rh_faq' => array(
			'singular'      => __( 'FAQ', 'ressa-health' ),
			'plural'        => __( 'FAQs', 'ressa-health' ),
			'menu_icon'     => 'dashicons-editor-help',
			'title_label'   => __( 'Question', 'ressa-health' ),
			'help'          => __( 'Accordion items in the FAQ section.', 'ressa-health' ),
			'supports_image' => false,
			'fields'        => array(
				'answer' => array(
					'label' => __( 'Answer', 'ressa-health' ),
					'type'  => 'textarea',
				),
			),
		),
	);
}

/**
 * Customizer panels, sections and settings for the front page.
 *
 * @return array<string, array<string, mixed>>
 */
function ressa_customizer_schema() {
	$text     = 'text';
	$textarea = 'textarea';
	$url      = 'url';

	$heading_help = __( 'Accepts &lt;em&gt;, &lt;strong&gt;, &lt;span&gt; and &lt;br&gt; so you can italicise or break the headline exactly like the design.', 'ressa-health' );

	return array(

		'brand' => array(
			'title'  => __( 'Brand &amp; Header', 'ressa-health' ),
			'fields' => array(
				'brand_name'        => array( 'label' => __( 'Brand word one', 'ressa-health' ), 'type' => $text ),
				'brand_name_alt'    => array( 'label' => __( 'Brand word two', 'ressa-health' ), 'type' => $text ),
				'header_cta_label'  => array( 'label' => __( 'Header button label', 'ressa-health' ), 'type' => $text ),
				'header_cta_url'    => array( 'label' => __( 'Header button URL', 'ressa-health' ), 'type' => $url ),
				'header_search_url' => array( 'label' => __( 'Header icon link URL', 'ressa-health' ), 'type' => $url ),
			),
		),

		'hero' => array(
			'title'  => __( 'Front Page — Hero', 'ressa-health' ),
			'fields' => array(
				'hero_eyebrow'   => array( 'label' => __( 'Eyebrow', 'ressa-health' ), 'type' => $text ),
				'hero_title'     => array( 'label' => __( 'Headline', 'ressa-health' ), 'type' => $textarea, 'help' => $heading_help ),
				'hero_lede'      => array( 'label' => __( 'Intro paragraph', 'ressa-health' ), 'type' => $textarea ),
				'hero_cta_label' => array( 'label' => __( 'Primary button label', 'ressa-health' ), 'type' => $text ),
				'hero_cta_url'   => array( 'label' => __( 'Primary button URL', 'ressa-health' ), 'type' => $url ),
				'hero_alt_label' => array( 'label' => __( 'Secondary button label', 'ressa-health' ), 'type' => $text ),
				'hero_alt_url'   => array( 'label' => __( 'Secondary button URL', 'ressa-health' ), 'type' => $url ),
			),
		),

		'problem' => array(
			'title'  => __( 'Front Page — The Problem', 'ressa-health' ),
			'fields' => array(
				'problem_eyebrow'   => array( 'label' => __( 'Eyebrow', 'ressa-health' ), 'type' => $text ),
				'problem_title'     => array( 'label' => __( 'Headline', 'ressa-health' ), 'type' => $textarea, 'help' => $heading_help ),
				'problem_lede'      => array( 'label' => __( 'Paragraph', 'ressa-health' ), 'type' => $textarea ),
				'problem_cta_label' => array( 'label' => __( 'Button label', 'ressa-health' ), 'type' => $text ),
				'problem_cta_url'   => array( 'label' => __( 'Button URL', 'ressa-health' ), 'type' => $url ),
			),
		),

		'manifesto' => array(
			'title'  => __( 'Front Page — Statement', 'ressa-health' ),
			'fields' => array(
				'manifesto_title' => array( 'label' => __( 'Headline', 'ressa-health' ), 'type' => $textarea, 'help' => $heading_help ),
				'manifesto_lede'  => array( 'label' => __( 'Paragraph', 'ressa-health' ), 'type' => $textarea ),
			),
		),

		'layers' => array(
			'title'  => __( 'Front Page — Seven Layers', 'ressa-health' ),
			'fields' => array(
				'layers_eyebrow'    => array( 'label' => __( 'Eyebrow', 'ressa-health' ), 'type' => $text ),
				'layers_title'      => array( 'label' => __( 'Headline', 'ressa-health' ), 'type' => $textarea, 'help' => $heading_help ),
				'layers_lede'       => array( 'label' => __( 'Paragraph', 'ressa-health' ), 'type' => $textarea ),
				'layers_hub_line_a' => array( 'label' => __( 'Wheel centre, line one', 'ressa-health' ), 'type' => $text ),
				'layers_hub_line_b' => array( 'label' => __( 'Wheel centre, line two', 'ressa-health' ), 'type' => $text ),
				'layers_foot'       => array( 'label' => __( 'Closing note', 'ressa-health' ), 'type' => $textarea, 'help' => $heading_help ),
			),
		),

		'steps' => array(
			'title'  => __( 'Front Page — How It Works', 'ressa-health' ),
			'fields' => array(
				'steps_eyebrow' => array( 'label' => __( 'Eyebrow', 'ressa-health' ), 'type' => $text ),
				'steps_title'   => array( 'label' => __( 'Headline', 'ressa-health' ), 'type' => $textarea, 'help' => $heading_help ),
				'steps_lede'    => array( 'label' => __( 'Paragraph', 'ressa-health' ), 'type' => $textarea ),
			),
		),

		'app' => array(
			'title'  => __( 'Front Page — The Output', 'ressa-health' ),
			'fields' => array(
				'app_eyebrow'   => array( 'label' => __( 'Eyebrow', 'ressa-health' ), 'type' => $text ),
				'app_title'     => array( 'label' => __( 'Headline', 'ressa-health' ), 'type' => $textarea, 'help' => $heading_help ),
				'app_lede'      => array( 'label' => __( 'Paragraph', 'ressa-health' ), 'type' => $textarea ),
				'app_cta_label' => array( 'label' => __( 'Button label', 'ressa-health' ), 'type' => $text ),
				'app_cta_url'   => array( 'label' => __( 'Button URL', 'ressa-health' ), 'type' => $url ),
				'app_screen'    => array( 'label' => __( 'Phone screenshot', 'ressa-health' ), 'type' => 'image' ),
			),
		),

		'features' => array(
			'title'  => __( 'Front Page — Platform Features', 'ressa-health' ),
			'fields' => array(
				'features_eyebrow' => array( 'label' => __( 'Eyebrow', 'ressa-health' ), 'type' => $text ),
				'features_title'   => array( 'label' => __( 'Headline', 'ressa-health' ), 'type' => $textarea, 'help' => $heading_help ),
			),
		),

		'compare' => array(
			'title'  => __( 'Front Page — Comparison', 'ressa-health' ),
			'fields' => array(
				'compare_eyebrow'   => array( 'label' => __( 'Eyebrow', 'ressa-health' ), 'type' => $text ),
				'compare_title'     => array( 'label' => __( 'Headline', 'ressa-health' ), 'type' => $textarea, 'help' => $heading_help ),
				'compare_lede'      => array( 'label' => __( 'Paragraph', 'ressa-health' ), 'type' => $textarea ),
				'compare_col_feature' => array( 'label' => __( 'First column heading', 'ressa-health' ), 'type' => $text ),
				'compare_col_ours'  => array( 'label' => __( 'Our column heading', 'ressa-health' ), 'type' => $text ),
				'compare_col_other' => array( 'label' => __( 'Their column heading', 'ressa-health' ), 'type' => $text ),
			),
		),

		'stories' => array(
			'title'  => __( 'Front Page — Member Stories', 'ressa-health' ),
			'fields' => array(
				'stories_eyebrow' => array( 'label' => __( 'Eyebrow', 'ressa-health' ), 'type' => $text ),
				'stories_title'   => array( 'label' => __( 'Headline', 'ressa-health' ), 'type' => $textarea, 'help' => $heading_help ),
			),
		),

		'team' => array(
			'title'  => __( 'Front Page — Medical Team', 'ressa-health' ),
			'fields' => array(
				'team_eyebrow' => array( 'label' => __( 'Eyebrow', 'ressa-health' ), 'type' => $text ),
				'team_title'   => array( 'label' => __( 'Headline', 'ressa-health' ), 'type' => $textarea, 'help' => $heading_help ),
				'team_lede'    => array( 'label' => __( 'Paragraph', 'ressa-health' ), 'type' => $textarea ),
			),
		),

		'trust' => array(
			'title'  => __( 'Front Page — Trust', 'ressa-health' ),
			'fields' => array(
				'trust_eyebrow' => array( 'label' => __( 'Eyebrow', 'ressa-health' ), 'type' => $text ),
				'trust_title'   => array( 'label' => __( 'Headline', 'ressa-health' ), 'type' => $text ),
			),
		),

		'faq' => array(
			'title'  => __( 'Front Page — FAQ', 'ressa-health' ),
			'fields' => array(
				'faq_eyebrow' => array( 'label' => __( 'Eyebrow', 'ressa-health' ), 'type' => $text ),
				'faq_title'   => array( 'label' => __( 'Headline', 'ressa-health' ), 'type' => $text ),
			),
		),

		'footer' => array(
			'title'  => __( 'Footer', 'ressa-health' ),
			'fields' => array(
				'footer_copyright' => array(
					'label' => __( 'Copyright line', 'ressa-health' ),
					'type'  => $text,
					'help'  => __( '{year} is replaced with the current year.', 'ressa-health' ),
				),
			),
		),

		'cta' => array(
			'title'  => __( 'Front Page — Closing CTA', 'ressa-health' ),
			'fields' => array(
				'cta_title' => array( 'label' => __( 'Headline', 'ressa-health' ), 'type' => $text ),
				'cta_lede'  => array( 'label' => __( 'Paragraph', 'ressa-health' ), 'type' => $textarea ),
				'cta_label' => array( 'label' => __( 'Button label', 'ressa-health' ), 'type' => $text ),
				'cta_url'   => array( 'label' => __( 'Button URL', 'ressa-health' ), 'type' => $url ),
			),
		),

	);
}

/**
 * Front page sections in render order, with the label used by the visibility
 * toggles in the Customizer.
 *
 * @return array<string, string>
 */
function ressa_front_sections() {
	return array(
		'hero'      => __( 'Hero', 'ressa-health' ),
		'problem'   => __( 'The Problem', 'ressa-health' ),
		'manifesto' => __( 'Statement', 'ressa-health' ),
		'layers'    => __( 'Seven Layers', 'ressa-health' ),
		'steps'     => __( 'How It Works', 'ressa-health' ),
		'app'       => __( 'The Output', 'ressa-health' ),
		'features'  => __( 'Platform Features', 'ressa-health' ),
		'compare'   => __( 'Comparison', 'ressa-health' ),
		'stories'   => __( 'Member Stories', 'ressa-health' ),
		'team'      => __( 'Medical Team', 'ressa-health' ),
		'trust'     => __( 'Trust', 'ressa-health' ),
		'faq'       => __( 'FAQ', 'ressa-health' ),
		'cta'       => __( 'Closing CTA', 'ressa-health' ),
	);
}
