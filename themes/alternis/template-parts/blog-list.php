<?php
//BLOG LIST

$args = array(
	'post_type' => 'post',
	'paged'     => $paged,
);

$posts = new WP_Query( $args );

?>

<div class="alternis-blog">
  <div class="alternis-blog__main">
    <div class="container">
      <div class="alternis-blog__main-wrap">
        <?php while ($posts->have_posts() ) :
        $posts->the_post();
        $post_id   = get_the_ID();
        $image_id  = get_post_thumbnail_id( $post_id );
        ?>

        <div class="alternis-blog__post">
          <?php if (!empty( $image_id )) {
            $image     = wp_get_attachment_image_url( $image_id, 'large' );
            $image_alt = get_post_meta( $image_id, '_wp_attachment_image_alt', true ); ?>

          <div class="alternis-blog__post-media">
            <a href="<?php the_permalink(); ?>">
              <img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
            </a>
          </div>
          <?php } ?>

          <div class="alternis-blog__post-date">
            <span><?php echo get_the_date();?></span>
            <?php  $categories = get_the_category(); ?>
            <a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ) ?>">
              <?php echo esc_html( $categories[0]->name ); ?>
            </a>
          </div>

          <?php if(!empty(get_the_title())){ ?>
          <h4>
            <a href="<?php the_permalink(); ?>" class="alternis-blog--post__title">
              <?php the_title(); ?>
            </a>
          </h4>
          <?php } ?>

          <a href="<?php the_permalink(); ?>" class="btn">Read More</a>
        </div>

        <?php endwhile; wp_reset_postdata(); ?>
      </div>
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


</div>