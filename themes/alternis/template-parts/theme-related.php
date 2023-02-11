<div class="alternis-single__related">
  <div class="container">
    <h2>Continue reading</h2>
    <div class="alternis-single__related-wrap">
      <?php
$related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 3, 'post__not_in' => array($post->ID) ) );

foreach( $related as $post ) {
    setup_postdata($post); ?>
      <?php if(has_post_thumbnail()) {?>

      <div class="alternis-single__related-item">
        <div class="alternis-single__related-media">
          <a href="<?php echo get_post_permalink(); ?>">
            <?php the_post_thumbnail(); ?>
          </a>
        </div>

        <div class="alternis-single__related-date">
          <span>
            <?php echo get_post_time( 'F j, Y' );?>
          </span>
          <?php $categories = get_the_category(); ?>
          <a href="<?php echo esc_url( get_category_link( $categories[0]->term_id ) ) ?>">
            <?php echo esc_html( $categories[0]->name ); ?>
          </a>
        </div>

        <h4>
          <a href="<?php echo get_post_permalink(); ?>">
            <?php echo get_the_title(); ?>
          </a>
        </h4>

        <div>
          <a class="btn" href="<?php echo get_post_permalink(); ?>">Read More</a>
        </div>
      </div>
      <?php } }?>
      <?php  wp_reset_postdata(); ?>
    </div>
  </div>
</div>