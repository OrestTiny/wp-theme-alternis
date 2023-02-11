<?php
if (!class_exists('Alternis_Elementor_Widgets')) {
	class Alternis_Elementor_Widgets
	{

		protected static $instance = null;

		public static function get_instance()
		{
			if (!isset(static::$instance)) {
				static::$instance = new static;
			}

			return static::$instance;
		}

		protected function __construct()
		{
			require_once ALTERNIS_T_PATH . '/widgets/slider-post-latest/slider-post-latest.php';
			require_once ALTERNIS_T_PATH . '/widgets/post-latest/post-latest.php';
			require_once ALTERNIS_T_PATH . '/widgets/post-latest-sidebar/post-latest-sidebar.php';
			require_once ALTERNIS_T_PATH . '/widgets/featured-posts/featured-posts.php';

			add_action('elementor/widgets/widgets_registered', [$this, 'register_widgets']);
		}

		public function register_widgets()
		{
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Elementor\Alternis_Slider_Post_Latest());
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Elementor\Alternis_Section_Post_Latest());
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Elementor\Alternis_Section_Post_Latest_Sidebar());
			\Elementor\Plugin::instance()->widgets_manager->register_widget_type(new \Elementor\Alternis_Section_Featured_Posts());
		}
	}
}

if (!function_exists('alternis_elementor_init')) {

	function alternis_elementor_init()
	{
		Alternis_Elementor_Widgets::get_instance();
	}
	add_action('init', 'alternis_elementor_init');
}
