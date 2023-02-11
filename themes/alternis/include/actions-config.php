<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Alternis
 */

add_action('tgmpa_register', 'alternis_include_required_plugins');
add_action('after_setup_theme', 'alternis_content_width', 0);
add_action('wp_enqueue_scripts', 'alternis_enqueue_scripts');

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function alternis_body_classes($classes)
{
	// Adds a class of hfeed to non-singular pages.
	if (!is_singular()) {
		$classes[] = 'alternis-page';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if (!is_active_sidebar('alternis-enable-sidebar')) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}

add_filter('body_class', 'alternis_body_classes');


/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 */
function alternis_content_width()
{
	$GLOBALS['content_width'] = apply_filters('alternis_content_width', 1200);
}

/**
 * Enqueue scripts and styles.
 */
function alternis_enqueue_scripts()
{

	$style_ver = filemtime(get_stylesheet_directory() . '/assets/css/style.css');

	// general settings
	if ((is_admin())) {
		return;
	}

	if (is_page() || is_home()) {
		$post_id = get_queried_object_id();
	} else {
		$post_id = get_the_ID();
	}

	if (is_404()) {
		wp_enqueue_style('alternis-error-page', ALTERNIS_T_URI . '/assets/css/error-page/error-page.css');
	}

	if (is_search()) {
		wp_enqueue_style('alternis-search', ALTERNIS_T_URI . '/assets/css/search/search.css');
	}

	if (is_archive() || is_author() || is_category() || is_home() || is_tag()) {
		wp_enqueue_style('alternis-blog-list', ALTERNIS_T_URI . '/assets/css/blog/blog-list.css');
	}

	if (is_single() && !(is_archive() || is_author() || is_category() || is_home() || is_tag())) {
		wp_enqueue_style('alternis-blog-single', ALTERNIS_T_URI . '/assets/css/blog/blog-single.css');
	}

	if (is_single()) {
		wp_enqueue_style('alternis-gutenberg', ALTERNIS_T_URI . '/assets/css/gutenberg.css', '', $style_ver);
	}

	// if (is_active_sidebar('alternis-sidebar') && !(is_home() || is_front_page())) {
	// 	wp_enqueue_style('alternis-sidebar', ALTERNIS_T_URI . '/assets/css/blog/sidebar.css');
	// }

	wp_enqueue_style('neuron-icon', ALTERNIS_T_URI . '/assets/css/lib/neuron-icon.css');
	wp_enqueue_style('raleway-fonts', ALTERNIS_T_URI . '/assets/css/lib/raleway.css');
	wp_enqueue_style('poppins-fonts', ALTERNIS_T_URI . '/assets/css/lib/poppins.css');
	wp_enqueue_style('awesome-fonts', ALTERNIS_T_URI . '/assets/css/lib/awesome.min.css');

	wp_enqueue_style('swiper-css', ALTERNIS_T_URI . '/assets/css/lib/swiper-bundle.css');
	wp_enqueue_style('alternis-main-style', ALTERNIS_T_URI . '/assets/css/style.css');
	// wp_enqueue_style( 'alternis-main-style', ALTERNIS_T_URI . '/assets/css/style.css');
	wp_enqueue_style('alternis-style', ALTERNIS_T_URI . '/style.css');

	// add TinyMCE style
	add_editor_style();

	// including jQuery plugins
	wp_localize_script(
		'alternis-script',
		'get',
		array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'siteurl' => get_template_directory_uri(),
		)
	);

	if (is_singular()) {
		wp_enqueue_script('comment-reply');
	}

	wp_enqueue_script('alternis-swiper', ALTERNIS_T_URI . '/assets/js/lib/swiper.min.js', array('jquery'), '', true);
	wp_enqueue_script('navigation-script', ALTERNIS_T_URI . '/assets/js/navigation.min.js', array('jquery'), '', true);
	wp_enqueue_script('alternis-script', ALTERNIS_T_URI . '/assets/js/script.min.js', array('jquery'), '', true);

	if (is_singular() && comments_open() && get_option('thread_comments')) {
		wp_enqueue_script('comment-reply');
	}
}
