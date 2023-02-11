<?php
//BLOG LIST
$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
$term  = get_query_var( 's' );

$args = array(
	'post_type' => 'post',
	'paged'     => $paged,
);

if ( is_search() ) {
	$args['s'] = $term;
}

$posts = new WP_Query( $args );

$count = isset( $posts->found_posts ) && ! empty( $posts->found_posts ) ? $posts->found_posts : '0';
$cda_blog_title_text =  esc_html( $term ) ?>

<div class="alternis-search">
  <div class="container">
    <div class="alternis-search__heading">
      <h6>Search Results:</h6>
      <h2><?php echo esc_html($cda_blog_title_text); ?></h2>
    </div>

    <div class="alternis-search__input">
      <?php get_search_form(true)?>
      If you are not happy with the results below please do another search
    </div>

    <div class="alternis-search__quanty">
      <?php echo 'We found ' . $count . ' articles' ?>
    </div>

    <div class="alternis-search__wrap">
      <?php while ( $posts->have_posts() ) :
						$posts->the_post();

						$post_id   = get_the_ID();
						$no_image  = ! has_post_thumbnail() ? ' no-image' : '';
						$image_id  = get_post_thumbnail_id( $post_id );
						$author_id = get_the_author_meta( 'ID' ); ?>
      <div class="alternis-search__item">
        <?php if ( ! empty( $image_id ) ) {
									$image     = wp_get_attachment_image_url( $image_id, 'large' );
									$image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true ); ?>
        <div class="alternis-search__item-media">
          <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
        </div>
        <?php } ?>

        <div class="alternis-search__item-wrap">
          <div class="alternis-search__item-header">
            <span><?php echo esc_html( get_the_author() ); ?></span>
            <span><?php echo get_the_date();?></span>
            <?php  $categories = get_the_category(); ?>
            <a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ) ?>">
              <?php echo esc_html( $categories[0]->name ); ?>
            </a>
          </div>

          <?php if(!empty(get_the_title())){ ?>
          <h2>
            <a href="<?php the_permalink(); ?>" class="alternis-blog--post__title"><?php the_title(); ?></a>
          </h2>
          <?php } ?>

          <div class="alternis-search__item-text"><?php the_excerpt(); ?></div>
        </div>
      </div>
      <?php endwhile; wp_reset_postdata(); ?>
    </div>


    <?php if ( $wp_query->max_num_pages > 1 ) { ?>
    <div class="alternis-blog__pagination">
      <div class="container">
        <div class="alternis-blog__pagination-wrap">
          <?php echo paginate_links(array(
            'prev_text' => false,
            'next_text' => false,
            'total'     => $wp_query->max_num_pages
            ) ); ?>
        </div>
      </div>
    </div>
    <?php } ?>

  </div>
</div>