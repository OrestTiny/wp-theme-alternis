<?php

$social = cmb2_get_option('alternis_main_options', 'alternis_social_group');

$copyright = cmb2_get_option('alternis_main_options', 'alternis_footer_copyright');
$copyright_link = cmb2_get_option('alternis_main_options', 'alternis_footer_copyright_link');
$copyright_empty = strtoupper(get_bloginfo('name'))  . esc_html__(' &copy;', 'etnos') . date('Y') . ' '  . 'All Rights Reserved.';



$inst = cmb2_get_option('alternis_main_options', 'alternis_footer_inst');

$subscribe_form = cmb2_get_option('alternis_main_options', 'alternis_footer_subscribe');





$needle = "twitter";

$result = array_filter($social, function ($innerArray) {
  global $needle;

  return $innerArray['alternis_social_name'] == 'Instagram';
});



?>

<footer class="alternis-footer">

  <?php if (!empty($inst)) { ?>
    <div class="alternis-footer__inst">
      <div class="alternis-footer__inst-heading">
        <h6>Follow us on Instagram</h6>
      </div>
      <div class="alternis-footer__inst-wrap">
        <div class="swiper">
          <div class="swiper-wrapper">
            <?php foreach ((array) $inst as $attachment_id => $attachment_url) { ?>
              <div class="swiper-slide">
                <a href="<?php echo $result ? esc_url($result[0]["alternis_social_link"]) : '/'; ?>" class="alternis-footer__inst-item" target="_blank">
                  <?php echo wp_get_attachment_image($attachment_id, 'full', array('loading' => 'lazy')); ?>
                </a>
              </div>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  <?php } ?>


  <div class="alternis-footer__wrap">
    <div class="container">
      <div class="alternis-footer__content">
        <div>
          <h4>Category</h4>
          <?php
          if (has_nav_menu('footer-category')) {
            $args                   = array('container' => '');
            $args['theme_location'] = 'footer-category';
            wp_nav_menu($args);
          }
          ?>
        </div>

        <div class="alternis-footer__subscribe">
          <h3>Get the best blog stories
            into you inbox!</h3>

          <?php echo do_shortcode($subscribe_form); ?>
        </div>

        <div>
          <h4>Follow me</h4>

          <ul class="alternis-footer__social">
            <?php if (!empty($social)) {
              foreach ($social as $item) { ?>
                <li>
                  <a href="<?php echo esc_url($item['alternis_social_link']); ?>" title="<?php echo esc_html($item['alternis_social_name']); ?>" aria-label="<?php echo esc_html($item['alternis_social_name']); ?>" target="_blank" rel="noopener">
                    <?php echo esc_html($item['alternis_social_name']); ?></a>
                </li>

            <?php }
            } ?>
          </ul>

        </div>
      </div>
      <div class="alternis-footer__copyright">
        <a href="<?php echo esc_url($copyright_link); ?>" target="_blank" rel="noopener">
          <?php echo $copyright ? esc_html($copyright) : esc_html($copyright_empty); ?>
        </a>
      </div>
    </div>
  </div>
</footer>
</div>