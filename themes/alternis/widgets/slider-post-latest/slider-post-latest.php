<?php
namespace Elementor;
use WP_Query;

class Alternis_Slider_Post_Latest extends Widget_Base {

	public function get_name() {
		return 'alternis-slider-latest-post';
	}

	public function get_title() {
		return 'Alternis Slider Posts';
	}

	public function get_icon() {
		return 'dashicons dashicons-slides';
	}

	public function get_categories() {
		return [ 'general' ];
	}


	public function __construct($data = [], $args = null) {

		parent::__construct($data, $args);
		wp_register_style( 'slider-latest-post', '/wp-content/themes/alternis/widgets/slider-post-latest/assets/css/slider-post-latest.css' );
	}


	public function get_style_depends() {
		return [ 'slider-latest-post' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'alternis' ),
			]
		);

		
		$this->add_control(
			'more_options',
			[
				'label' => esc_html__( 'Additional Options', 'alternis' ),
				'type' => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$categories = get_categories();
        $categories_array = array();
        foreach ($categories as $category) {
            $categories_array[$category->term_id] = $category->name;
        };

        $this->add_control(
            'categories',
            [
                'label'   => esc_html__( 'Choose categories', 'treacy' ),
                'type'    => \Elementor\Controls_Manager::SELECT2,
                'multiple' => true,
                'options' => $categories_array,
            ]
        );

		$this->end_controls_section();
	}



	protected function render() {

		$settings = $this->get_settings_for_display();

		$news_args = array(
        'posts_per_page' => 6,
    );

	 if(isset($settings['categories']) && is_array($settings['categories']) && count($settings['categories']) > 0){
		$news_args['cat'] = $settings['categories'];
  	}
    $news_query = new WP_Query( $news_args );
	
	
		?>

<div class="alternis-swiper-post">
  <div class="swiper mySwiper">
    <div class="swiper-wrapper">
      <?php if($news_query->have_posts()) {?>
      <?php while ($news_query->have_posts()) : $news_query->the_post();
			
			$id = get_the_ID();
			?>
      <div class="swiper-slide">
        <div class="alternis-swiper-post__item">
          <a href="<?php echo get_permalink($id); ?>">
            <?php the_post_thumbnail( array(926, 565), array( 'loading' => 'lazy', )  ); ?>

            <div class="alternis-swiper-post__content">
              <h3><?php echo get_the_title(); ?></h3>
              <p><?php echo get_the_category()[0]->name; ?></p>
            </div>
          </a>
        </div>
      </div>
      <?php endwhile;?>
      <?php wp_reset_postdata(); }?>
    </div>
  </div>
</div>


<?php
	}
}