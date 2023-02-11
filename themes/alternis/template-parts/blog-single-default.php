<?php
/*
 * Single post
 */

$get_id    = get_the_ID();
$author_id = get_the_author_meta( 'ID' );

$social = cmb2_get_option( 'alternis_main_options', 'alternis_social_group');

?>

<div class="alternis-single">

  <?php if ( has_post_thumbnail() ) { ?>
  <div class="alternis-single__banner">
    <div class="container">
      <div class="alternis-single__banner-wrap">
        <div><?php the_category( '+' ); ?></div>
        <?php the_title( '<h1>', '</h1>' ); ?>
        <div class="alternis-single__banner-date">
          <span><?php echo sprintf( esc_html__( '%s ago', 'alternis' ), human_time_diff( get_the_time( 'U' ), current_time( 'timestamp' ) ) ); ?></span>
          <span><?php echo get_the_date();?></span>
          <span><?php echo esc_html( get_the_author() ); ?></span>
        </div>

        <?php $image_url = get_the_post_thumbnail_url( $get_id, 'full' );
            $image_id        = get_post_thumbnail_id( $get_id );
            $image_alt       = get_post_meta( $image_id, '_wp_attachment_image_alt', true ); ?>

        <div class="alternis-single__banner-media">
          <img src="<?php echo esc_url( $image_url ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">
        </div>
      </div>
    </div>
  </div>
  <?php } ?>

  <div class="alternis-single__content">
    <div class="container">
      <div class="alternis-single__content-wrap">
        <div class="alternis-single__content-author">
          <div>
            <?php echo get_avatar( $get_id, 74 ); ?>
            <span>Written by <b><?php echo esc_html( get_the_author() ); ?></b></span>
          </div>

          <ul class="alternis-single__content-social">
            <?php if(!empty($social)) {?>
            <?php foreach($social as $item) { ?>
            <li>
              <a href="<?php echo esc_url($item['alternis_social_link']); ?>"
                class="<?php echo esc_attr($item['alternis_social_icon'])?>"
                title="<?php echo esc_html($item['alternis_social_name']); ?>"
                aria-label="<?php echo esc_html($item['alternis_social_name']); ?>" target="_blank" rel="noopener"></a>
            </li>
            <?php }?>
            <?php }?>
          </ul>
        </div>

        <div class="alternis-single__content-main">
          <?php the_content(); ?>
        </div>


        <div class="alternis-single__content-social-second">
          <ul>
            <?php if(!empty($social)) {
              foreach($social as $item) { ?>
            <li>
              <a href="<?php echo esc_url($item['alternis_social_link']); ?>"
                class="<?php echo esc_attr($item['alternis_social_icon'])?>"
                title="<?php echo esc_html($item['alternis_social_name']); ?>"
                aria-label="<?php echo esc_html($item['alternis_social_name']); ?>" target="_blank" rel="noopener"></a>
            </li>
            <?php } }?>
          </ul>
        </div>


        <?php the_tags( '<div class="alternis-single__content-tags">', ' ', '</div>' ); ?>
      </div>
    </div>
    <?php get_template_part( 'template-parts/theme', 'related' ); ?>
  </div>
</div>