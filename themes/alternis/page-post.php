<?php
/**
 * Template Name: Alternis posts
 */
?>

<?php
    $news_args = array(
        'posts_per_page' => 3,
    );

    $news_query = new WP_Query( $news_args );

    ?>

<div class="blog_latest-news" id="blog_news_main">
  <?php if($news_query->have_posts()) {?>
  <?php while ($news_query->have_posts()) : $news_query->the_post();
  
  $id = get_the_ID();
  ?>

  <div class="blog_latest-news__item">
    <a href="<?php echo get_permalink($id); ?>" target="_blank">
      <div class="blog_latest-news__img">
        <?php the_post_thumbnail( 'full' , array( 'loading' => 'lazy', 'class' => 'test' )  ); ?>
      </div>
    </a>
    <div class="blog_latest-news__date">
      <?php echo get_the_date();?>
    </div>
    <a href="<?php echo get_permalink($id); ?>" target="_blank">
      <h4> <?php echo get_the_title(); ?> </h4>
    </a>
    <p>
      <?php echo wp_trim_words( get_the_content(), 40, '...' ); ?>
    </p>
  </div>
  <?php endwhile;?>
  <?php wp_reset_postdata(); }else{ echo wpautop( 'No posts.' ); }?>
</div>