<?php
/**
 * Bundled starter content.
 *
 * Every string on the front page is editable in WordPress. These defaults are
 * what the theme falls back to before anything has been edited, so a fresh
 * activation looks exactly like the approved design instead of an empty shell.
 *
 * @package RessaHealth
 */

defined( 'ABSPATH' ) || exit;

/**
 * Default values for every Customizer setting.
 *
 * Headline fields accept <em>, <strong>, <span> and <br> so the two-tone
 * display lockups from the design can be authored inline.
 *
 * @return array<string, string>
 */
function ressa_default_options() {
	static $defaults = null;

	if ( null !== $defaults ) {
		return $defaults;
	}

	$defaults = array(
		// -- Header ---------------------------------------------------------
		'brand_name'        => 'Ressa',
		'brand_name_alt'    => 'Health',
		'header_cta_label'  => 'Professionals',
		'header_cta_url'    => '#start',
		'header_search_url' => '#start',

		// -- Hero -----------------------------------------------------------
		'hero_eyebrow'      => 'The Story of You',
		'hero_title'        => 'Your labs came back normal.<br><strong>You <em>knew</em> something was still wrong.</strong>',
		'hero_lede'         => 'You weren&rsquo;t imagining it &mdash; you were just never fully seen. Ressa Health reads your health across seven sources, not one, to tell the whole story your panel left out.',
		'hero_cta_label'    => 'Start Your Story',
		'hero_cta_url'      => '#start',
		'hero_alt_label'    => 'See How It Works',
		'hero_alt_url'      => '#how-it-works',

		// -- Problem --------------------------------------------------------
		'problem_eyebrow'   => 'The Problem',
		'problem_title'     => 'A single lab panel is<br><em>one frame of a film.</em>',
		'problem_lede'      => 'One blood draw, one moment, one layer. Your body is a system in motion, and a single frame can never show you where it is heading. Ressa Health reads the whole reel &mdash; every layer, every month, together.',
		'problem_cta_label' => 'Learn More',
		'problem_cta_url'   => '#how-it-works',

		// -- Manifesto ------------------------------------------------------
		'manifesto_title'   => 'You are not a result.<br><strong>You are <em class="rh-accent">a story.</em></strong>',
		'manifesto_lede'    => 'Written in more than one language at once &mdash; your blood, your genes, your microbiome, your sleep, your imaging, your history, your lived experience. No single one is you. You&rsquo;re the pattern that runs through all of them.',

		// -- Seven layers ---------------------------------------------------
		'layers_eyebrow'    => 'Why We&rsquo;re Different',
		'layers_title'      => 'Everyone else reads one layer.<br><em>We read seven.</em>',
		'layers_lede'       => 'Ressa Health is the intelligence layer that sits above the data, not another source of it. We don&rsquo;t replace your labs, your devices, your records, or your doctor &mdash; we&rsquo;re the first thing that reads all of them together.',
		'layers_hub_line_a' => '7 Layers',
		'layers_hub_line_b' => '1 Story',
		'layers_foot'       => 'Ressa Health&rsquo;s intelligence reads across all seven &mdash; <strong>finding the connection no single source can see.</strong> The AI is the reader, never an eighth source.',

		// -- How it works ---------------------------------------------------
		'steps_eyebrow'     => 'How It Works',
		'steps_title'       => 'Works with the data <em>you already have.</em>',
		'steps_lede'        => 'Ressa Health sits above the data you have already paid for. Connect a panel you ran last year, sync the watch on your wrist, add the history in your chart &mdash; and watch the layers finally get read together.',

		// -- Product / app --------------------------------------------------
		'app_eyebrow'       => 'The Output',
		'app_title'         => 'The Story of You &mdash;<br><em>finally in one place.</em>',
		'app_lede'          => 'Not a dashboard of numbers you have to interpret on your own. A story that reads your labs, your wearables, your history and your symptoms together, then tells you what it means, what changed, and what to do next.',
		'app_cta_label'     => 'Start Your Story',
		'app_cta_url'       => '#start',

		// -- Features -------------------------------------------------------
		'features_eyebrow'  => 'Inside the Platform',
		'features_title'    => 'Everything you need to understand<br>your health &mdash; in one place.',

		// -- Comparison -----------------------------------------------------
		'compare_eyebrow'   => 'How We Compare',
		'compare_title'     => 'One panel,<br>or <em>the whole picture.</em>',
		'compare_lede'      => 'Every other company in this space is built to sell you a panel &mdash; their economics depend on you ordering it. That single constraint shapes everything they can and can&rsquo;t offer you. Here&rsquo;s what the difference actually looks like, side by side.',
		'compare_col_feature' => 'Feature',
		'compare_col_ours'  => 'Ressa Health',
		'compare_col_other' => 'Standard Visit',

		// -- Stories --------------------------------------------------------
		'stories_eyebrow'   => 'Real Stories',
		'stories_title'     => 'Stories that started with <em>&ldquo;everything&rsquo;s normal.&rdquo;</em>',

		// -- Team -----------------------------------------------------------
		'team_eyebrow'      => 'Who&rsquo;s Behind Every Story We Tell',
		'team_title'        => 'A visible medical team behind every story we tell.',
		'team_lede'         => 'Every insight Ressa Health surfaces is designed and reviewed by licensed clinicians. The intelligence is ours; the accountability is theirs.',

		// -- Trust ----------------------------------------------------------
		'trust_title'       => 'Trust is part of the story, too.',
		'trust_eyebrow'     => 'What We&rsquo;ll Never Do',

		// -- FAQ ------------------------------------------------------------
		'faq_eyebrow'       => 'Questions',
		'faq_title'         => 'Frequently Asked Questions',

		// -- Footer ---------------------------------------------------------
		'footer_copyright'  => '&copy; {year} Ressa Health. All rights reserved.',

		// -- Closing CTA ----------------------------------------------------
		'cta_title'         => 'The whole story. Yours.',
		'cta_lede'          => 'Your labs are already telling a story. Ressa Health is the first thing that reads all of it &mdash; and finally tells it back to you.',
		'cta_label'         => 'Start Your Story',
		'cta_url'           => '#start',

	);

	return $defaults;
}

/**
 * Single default option lookup.
 *
 * @param string $key     Setting key.
 * @param string $fallback Value used when the key is unknown.
 * @return string
 */
function ressa_default_option( $key, $fallback = '' ) {
	$defaults = ressa_default_options();

	return isset( $defaults[ $key ] ) ? $defaults[ $key ] : $fallback;
}

/**
 * Starter items for each repeatable post type.
 *
 * Keys mirror the meta keys registered in inc/fields.php so both paths return
 * identically shaped arrays to the templates.
 *
 * @param string $type Post type key.
 * @return array<int, array<string, mixed>>
 */
function ressa_default_items( $type ) {
	$items = array(

		'rh_layer' => array(
			array(
				'title'       => 'Labs',
				'default_image' => 'assets/img/layer-labs.webp',
				'eyebrow'     => 'Biomarkers, in context.',
				'description' => 'Metabolism, inflammation, and hormones &mdash; read alongside everything else your body is telling you, not alone.',
				'tags'        => array( 'Biomarkers', 'Metabolism', 'Inflammation', 'Hormones' ),
				'accent'      => '#b8342c',
			),
			array(
				'title'       => 'Genomics',
				'default_image' => 'assets/img/layer-genomics.webp',
				'eyebrow'     => 'Your blueprint, decoded.',
				'description' => 'Inherited risk and drug response, interpreted against what your body is actually doing today &mdash; not against a population average.',
				'tags'        => array( 'Variants', 'Inherited Risk', 'Pharmacogenomics', 'Traits' ),
				'accent'      => '#1d5fa8',
			),
			array(
				'title'       => 'Microbiome',
				'default_image' => 'assets/img/layer-microbiome.webp',
				'eyebrow'     => 'The ecosystem within.',
				'description' => 'Gut diversity and metabolite production, connected to the digestion, mood and immunity you actually feel day to day.',
				'tags'        => array( 'Diversity', 'Digestion', 'Metabolites', 'Immunity' ),
				'accent'      => '#8a7326',
			),
			array(
				'title'       => 'Wearables',
				'default_image' => 'assets/img/layer-wearables.webp',
				'eyebrow'     => 'Every day in between.',
				'description' => 'Sleep, recovery and heart rate variability fill in the months of your life that a once-a-year blood draw never sees.',
				'tags'        => array( 'Sleep', 'HRV', 'Activity', 'Recovery' ),
				'accent'      => '#2a7f74',
			),
			array(
				'title'       => 'Imaging',
				'default_image' => 'assets/img/layer-imaging.webp',
				'eyebrow'     => 'Structure and change.',
				'description' => 'Scans and body composition tracked over time, so a shift shows up in the picture long before it shows up as a symptom.',
				'tags'        => array( 'Composition', 'Scans', 'Density', 'Change' ),
				'accent'      => '#4b4f8f',
			),
			array(
				'title'       => 'Surveys',
				'default_image' => 'assets/img/layer-surveys.webp',
				'eyebrow'     => 'What only you can report.',
				'description' => 'Energy, mood, pain and stress &mdash; the subjective signal that gives every objective number its meaning.',
				'tags'        => array( 'Symptoms', 'Energy', 'Mood', 'Stress' ),
				'accent'      => '#a35a2a',
			),
			array(
				'title'       => 'Clinical Data',
				'default_image' => 'assets/img/layer-clinical-data.webp',
				'eyebrow'     => 'Your history, remembered.',
				'description' => 'Visits, diagnoses and prescriptions carried forward, so nothing about you ever has to be explained from scratch twice.',
				'tags'        => array( 'History', 'Diagnoses', 'Medications', 'Visits' ),
				'accent'      => '#5f7d3a',
			),
		),

		'rh_step' => array(
			array(
				'title'       => 'Share or upload your labs',
				'default_image' => 'assets/img/step-1.webp',
				'rail_label'  => 'Test',
				'step_label'  => 'Step 01',
				'description' => 'Connect results you already have from Quest, Labcorp or your patient portal &mdash; or order a fresh panel through the Ressa partner network.',
			),
			array(
				'title'       => 'See what your body is saying',
				'default_image' => 'assets/img/step-2.webp',
				'rail_label'  => 'Analyze',
				'step_label'  => 'Step 02',
				'description' => 'Our engine reads across all seven layers at once and surfaces the connection that no single panel, device or visit could show on its own.',
			),
			array(
				'title'       => 'You get the Story of You',
				'default_image' => 'assets/img/step-3.webp',
				'rail_label'  => 'Act',
				'step_label'  => 'Step 03',
				'description' => 'One narrative picture of your health &mdash; the thread running through everything, written in plain language you can act on and share.',
			),
		),

		'rh_feature' => array(
			array(
				'title'         => 'Your Results',
				'default_image' => 'assets/img/feature-results.webp',
				'description'   => 'Every marker in plain language, with the context that makes the number actually mean something.',
			),
			array(
				'title'         => 'AI Insights',
				'default_image' => 'assets/img/feature-insights.webp',
				'description'   => 'The connections across your seven layers, surfaced automatically as new data arrives.',
			),
			array(
				'title'         => 'Learn',
				'default_image' => 'assets/img/feature-learn.webp',
				'description'   => 'Guided, sourced explanations of the terms your doctor never had the time to unpack.',
			),
			array(
				'title'         => 'Find a Practitioner',
				'default_image' => 'assets/img/feature-practitioner.webp',
				'description'   => 'Ressa-verified clinicians who already speak the language your data is written in.',
			),
			array(
				'title'         => 'Track Over Time',
				'default_image' => 'assets/img/feature-track.webp',
				'description'   => 'Watch every marker move, so change shows up in the data long before it shows up in you.',
			),
			array(
				'title'         => 'Connect &amp; Share',
				'default_image' => 'assets/img/feature-share.webp',
				'description'   => 'Bring your whole story with you, and share it with exactly the people you choose.',
			),
		),

		'rh_story' => array(
			array(
				'title'         => 'Maya R.',
				'format'        => 'video',
				'meta'          => 'Hashimoto&rsquo;s, found at 31',
				'default_image' => 'assets/img/stories-video-1.png',
			),
			array(
				'title'  => 'Daniel K.',
				'format' => 'quote',
				'quote'  => 'My labs were &ldquo;normal&rdquo; for four years. Ressa Health found the pattern across my thyroid panel and my sleep data in an afternoon.',
				'meta'   => 'Member since 2024',
			),
			array(
				'title'         => 'Priya S.',
				'format'        => 'video',
				'meta'          => 'Insulin resistance, caught early',
				'default_image' => 'assets/img/stories-video-2.png',
			),
			array(
				'title'  => 'Elena M.',
				'format' => 'quote',
				'quote'  => 'I stopped feeling like I was imagining it the day somebody finally read all of it together.',
				'meta'   => 'Member since 2023',
			),
			array(
				'title'         => 'James T.',
				'format'        => 'video',
				'meta'          => 'Chronic fatigue, finally explained',
				'default_image' => 'assets/img/stories-video-1.png',
			),
		),

		'rh_member' => array(
			array(
				'title'         => 'Dr. Lorem Ipsum',
				'role'          => 'Clinical Lead, MD',
				'default_image' => 'assets/img/doctor-lorem-ipsum-1.png',
			),
			array(
				'title'         => 'Dr. Lorem Ipsum',
				'role'          => 'Functional Medicine',
				'default_image' => 'assets/img/doctor-lorem-ipsum-2.png',
			),
			array(
				'title'         => 'Dr. Lorem Ipsum',
				'role'          => 'Data Science',
				'default_image' => 'assets/img/doctor-lorem-ipsum-3.png',
			),
			array(
				'title'         => 'Dr. Lorem Ipsum',
				'role'          => 'Cross-Disciplinary Review',
				'default_image' => 'assets/img/doctor-lorem-ipsum-4.png',
			),
		),

		'rh_compare' => array(
			array(
				'title' => 'Comprehensive biomarker testing (100+)',
				'ours'  => 'yes',
				'other' => 'partial',
			),
			array(
				'title' => 'Historical pattern analysis over time',
				'ours'  => 'yes',
				'other' => 'no',
			),
			array(
				'title' => 'Wearable + CGM data integration',
				'ours'  => 'yes',
				'other' => 'no',
			),
			array(
				'title' => 'Upload past labs from any provider',
				'ours'  => 'yes',
				'other' => 'no',
			),
			array(
				'title' => 'AI-driven cross-marker insights',
				'ours'  => 'yes',
				'other' => 'no',
			),
			array(
				'title' => 'Optimal ranges (beyond standard reference)',
				'ours'  => 'yes',
				'other' => 'no',
			),
			array(
				'title' => 'Physician-reviewed insights',
				'ours'  => 'yes',
				'other' => 'yes',
			),
			array(
				'title' => 'Plain-language explanations',
				'ours'  => 'yes',
				'other' => 'no',
			),
			array(
				'title' => 'No referral needed',
				'ours'  => 'yes',
				'other' => 'partial',
			),
			array(
				'title' => 'Free plan available',
				'ours'  => 'yes',
				'other' => 'no',
			),
		),

		'rh_trust' => array(
			array(
				'title'       => 'We&rsquo;ll never sell your data',
				'description' => 'Your record is yours. We do not sell it, and we do not share it without your explicit say-so.',
			),
			array(
				'title'       => 'Physician-built, physician-reviewed',
				'description' => 'Licensed clinicians design and review every insight the system is allowed to surface.',
			),
			array(
				'title'       => 'You can export everything',
				'description' => 'Take your complete record with you at any time, in a format your own doctor can read.',
			),
			array(
				'title'       => 'We&rsquo;ll never replace your doctor',
				'description' => 'We are the reading layer, not the diagnosis. Your clinician simply gets a far better starting point.',
			),
		),

		'rh_faq' => array(
			array(
				'title'  => 'Is Ressa Health a lab?',
				'answer' => 'No. We are the intelligence layer that sits above your data. You can order a panel through our partner network if you want one, but Ressa Health works just as well with results you already have.',
			),
			array(
				'title'  => 'How much data do I need to start?',
				'answer' => 'A single lab panel is enough to begin. Every additional layer you connect &mdash; wearables, genomics, symptoms, history &mdash; makes the reading sharper and the story more specific to you.',
			),
			array(
				'title'  => 'Does this replace my doctor?',
				'answer' => 'Never. Ressa Health hands your clinician a far better starting point than a page of numbers, and gives you the language to have a much better conversation.',
			),
			array(
				'title'  => 'How is my health data protected?',
				'answer' => 'Everything is encrypted in transit and at rest, never sold, and fully exportable or deletable by you at any moment. Access is yours to grant and yours to revoke.',
			),
			array(
				'title'  => 'Which labs and devices do you support?',
				'answer' => 'The major US laboratories and the common wearable platforms are supported today, and new integrations are added continuously as members request them.',
			),
			array(
				'title'  => 'What does it cost?',
				'answer' => 'There is a free tier for reading a single panel, and a membership for continuous reading across all seven layers as your data changes over time.',
			),
		),
	);

	return isset( $items[ $type ] ) ? $items[ $type ] : array();
}
