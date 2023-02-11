<?php
namespace Elementor;
use WP_Query;

class Alternis_Section_Post_Latest extends Widget_Base {

	public function get_name() {
		return 'alternis-section-latest-post';
	}

	public function get_title() {
		return 'Alternis Slider Posts';
	}

	public function get_icon() {
		return 'dashicons dashicons-admin-post';
	}

	public function get_categories() {
		return [ 'general' ];
	}


	public function __construct($data = [], $args = null) {

		parent::__construct($data, $args);
		wp_register_style( 'latest-post', '/wp-content/themes/alternis/widgets/post-latest/assets/css/post-latest.css' );
	}


	public function get_style_depends() {
		return [ 'latest-post' ];
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

<div class="alternis-post-latest">
  <?php if($news_query->have_posts()) {?>
  <?php while ($news_query->have_posts()) : $news_query->the_post();
	
		$id = get_the_ID();
	?>
  <div class="alternis-post-latest__item">

    <div class="alternis-post-latest__img">
      <a href="<?php echo get_permalink($id); ?>">
        <?php the_post_thumbnail( 'custom-size', array( 'loading' => 'lazy', )  ); ?>
      </a>
    </div>

    <div class="alternis-post-latest__date">
      <p><?php echo get_the_date();?></p>
      <?php 
				$categories = get_the_category();
			?>
      <a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ) ?>">
        <?php echo esc_html( $categories[0]->name ); ?>
      </a>
    </div>

    <h4>
      <a href="<?php echo get_permalink($id); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
        <?php echo get_the_title(); ?>
      </a>
    </h4>

    <p class="alternis-post-latest__desc"><?php echo wp_trim_words( get_the_excerpt(), 31, '' ); ?></p>

    <a href="<?php echo get_permalink($id); ?>">Read More</a>

  </div>
  <?php endwhile;?>
  <?php wp_reset_postdata(); }?>
</div>

<?php
	}
}