<?php
namespace Elementor;
use WP_Query;

class Alternis_Section_Post_Latest_Sidebar extends Widget_Base {

	public function get_name() {
		return 'alternis-section-latest-post-sidebar';
	}

	public function get_title() {
		return 'Alternis Sidebar Posts';
	}

	public function get_icon() {
		return 'dashicons dashicons-admin-post';
	}

	public function get_categories() {
		return [ 'general' ];
	}


	public function __construct($data = [], $args = null) {

		parent::__construct($data, $args);
		wp_register_style( 'latest-post-sidebar', '/wp-content/themes/alternis/widgets/post-latest-sidebar/assets/css/post-latest-sidebar.css' );
	}


	public function get_style_depends() {
		return [ 'latest-post-sidebar' ];
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
        'posts_per_page' => 3,
    );

	 if(isset($settings['categories']) && is_array($settings['categories']) && count($settings['categories']) > 0){
		$news_args['cat'] = $settings['categories'];
  	}
    $news_query = new WP_Query( $news_args );
	
	
		?>

<div class="alternis-post-sidebar">
  <?php if($news_query->have_posts()) {?>
  <?php while ($news_query->have_posts()) : $news_query->the_post();
	
	$id = get_the_ID();
	?>
  <div class="alternis-post-sidebar__item">

    <div class="alternis-post-sidebar__media">
      <a href="<?php echo get_permalink($id); ?>">
        <?php the_post_thumbnail( 'custom-size', array( 'loading' => 'lazy', )  ); ?>
      </a>
    </div>

    <div class="alternis-post-sidebar__content">

      <h5>
        <a href="<?php echo get_permalink($id); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
          <?php echo get_the_title(); ?>
        </a>
      </h5>

      <div class="alternis-post-sidebar__date">
        <span><?php echo get_the_date();?></span>
        <?php 
				$categories = get_the_category();
			?>
        <a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ) ?>">
          <?php echo esc_html( $categories[0]->name ); ?>
        </a>
      </div>
    </div>

  </div>
  <?php endwhile;?>
  <?php wp_reset_postdata(); }?>
</div>

<?php
	}
}