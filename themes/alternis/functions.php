<?php

/**
 * Alternis functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Alternis
 */

defined('ALTERNIS_T_URI') or define('ALTERNIS_T_URI', get_template_directory_uri());
defined('ALTERNIS_T_PATH') or define('ALTERNIS_T_PATH', get_template_directory());

require_once ABSPATH . 'wp-admin/includes/plugin.php';
require_once ALTERNIS_T_PATH . '/include/actions-config.php';

require_once ALTERNIS_T_PATH . '/include/optimization.php';
require_once ALTERNIS_T_PATH . '/include/site-options.php';
if (defined('ELEMENTOR_VERSION')) {
	include_once ALTERNIS_T_PATH . '/include/elementor-widgets.php';
}


if (!function_exists('alternis_setup')) :

	function alternis_setup()
	{

		register_nav_menus(array('primary-menu' => esc_html__('Primary menu', 'alternis')));
		register_nav_menus(array('secondary-menu' => esc_html__('Secondary menu', 'alternis')));
		register_nav_menus(array('footer-category' => esc_html__('Footer Category', 'alternis')));


		load_theme_textdomain('alternis', get_template_directory() . '/languages');

		add_theme_support('automatic-feed-links');
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');
		add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption'));
		add_theme_support('post-formats', array(
			'aside',
			'gallery',
			'link',
			'image',
			'quote',
			'status',
			'video',
			'audio',
			'chat'
		));

		// Set up the WordPress core custom background feature.
		add_theme_support('custom-background', apply_filters('alternis_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		)));

		// Add theme support for selective refresh for widgets.
		add_theme_support('customize-selective-refresh-widgets');

		add_theme_support('custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		));
	}
endif;

add_action('after_setup_theme', 'alternis_setup');


if (!function_exists('alternis_mime_types')) {
	function alternis_mime_types($mimes)
	{
		$mimes['svg'] = 'image/svg+xml';
		return $mimes;
	}

	add_filter('upload_mimes', 'alternis_mime_types');
}


// function fix_svg_thumb_display() {
//   echo '
//     td.media-icon img[src$=".svg"], img[src$=".svg"].attachment-post-thumbnail { 
//       width: 100% !important; 
//       height: auto !important; 
//     }
//   ';
// }
// add_action('admin_head', 'fix_svg_thumb_display');


function isLink($data)
{
	$el = $data;

	echo $el['is_external'] ? ' target="_blank" ' : ' target="_self" ';
	echo $el['nofollow'] ? ' rel="nofollow" ' : '';
	echo $el['url'] ? ' href="' . esc_url($el['url']) . '" ' : '';
	echo $el['custom_attributes'] ? ' ' . esc_attr($el['custom_attributes']) . ' ' : '';
}

// 

remove_action('wp_head', 'rest_output_link_wp_head', 10);
remove_action('wp_enqueue_scripts', 'wp_enqueue_global_styles');
remove_action('wp_footer', 'wp_enqueue_global_styles', 1);
remove_action('wp_body_open', 'wp_global_styles_render_svg_filters');
remove_filter('render_block', 'wp_render_layout_support_flag', 10, 2);


function wpse_time_diff_mins($since, $diff, $from, $to)
{
	return str_replace('mins', 'minutes', $since);
}

add_filter('human_time_diff', 'wpse_time_diff_mins', 10, 4);
