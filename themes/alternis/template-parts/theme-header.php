<?php

$logo_header = cmb2_get_option('alternis_main_options', 'alternis_header_logo');
$text_header = cmb2_get_option('alternis_main_options', 'alternis_header_text');
$banner_header = cmb2_get_option('alternis_main_options', 'alternis_header_banner');

$social = cmb2_get_option('alternis_main_options', 'alternis_social_group');

$navigation_star = cmb2_get_option('alternis_main_options', 'alternis_header_navigation_star');
$flag_navigation_star = $navigation_star ? 'first-item-red' : '';
?>

<div id="alternis-overlay"></div>
<!-- <div id="alternis-preload"></div> -->

<div class="alternis-header__main-search-popup" id="alternis-search-popup">
  <?php get_search_form(true) ?>
</div>

<div class="alternis-main-wrapper">
  <header class="alternis-header" id="alternis-header">

    <div class="alternis-header__top">
      <div class="container">
        <div class="alternis-header__top-wrap">
          <div><?php echo date("F j, Y"); ?></div>

          <?php if (!empty($text_header)) { ?>
            <div class="alternis-header__top-info">
              <?php echo wp_kses_post($text_header); ?>
            </div>
          <?php } ?>

          <ul class="alternis-header__top-social">
            <?php if (!empty($social)) { ?>
              <?php foreach ($social as $item) { ?>
                <li>
                  <a href="<?php echo esc_url($item['alternis_social_link']); ?>" class="<?php echo esc_attr($item['alternis_social_icon']) ?>" title="<?php echo esc_html($item['alternis_social_name']); ?>" aria-label="<?php echo esc_html($item['alternis_social_name']); ?>" target="_blank" rel="noopener"></a>
                </li>
              <?php } ?>
            <?php } ?>
          </ul>
        </div>
      </div>
    </div>

    <div class="alternis-header__main">
      <div class="container">
        <div class="alternis-header__main-wrap">
          <div class="alternis-header__main-burger" id="alternis-header__main-burger">
            <i class="fas fa-bars burger-btn"></i>

            <div class="alternis-header__main-burger-menu">
              <i class="fas fa-times burger-btn"></i>
              <div id="burger-menu-logo"></div>
              <div id="burger-menu-main" class="<?php echo $flag_navigation_star; ?>"></div>
              <div id="burger-menu-social"></div>
            </div>
            <div class="alternis-header__main-burger-overlay" id="burger-overlay"></div>

          </div>

          <?php if (!empty($logo_header)) { ?>
            <a class="alternis-header__main-logo" href="<?php echo esc_url(home_url('/')); ?>">
              <img src="<?php echo $logo_header; ?>" title="<?php echo get_option('blogname'); ?>" alt="<?php echo get_option('blogname'); ?>">
            </a>
          <?php } ?>

          <div class="alternis-header__main-menu <?php echo $flag_navigation_star; ?>">
            <?php
            if (has_nav_menu('primary-menu')) {
              $args                   = array('container' => '');
              $args['theme_location'] = 'primary-menu';
              wp_nav_menu($args);
            }
            ?>

            <?php if (has_nav_menu('secondary-menu')) { ?>
              <div class="alternis-header__main-menu-secondary">
                <span>···</span>
                <?php

                $args                   = array('container' => '');
                $args['theme_location'] = 'secondary-menu';
                wp_nav_menu($args);

                ?>
              </div>
            <?php } ?>
          </div>

          <div class="alternis-header__main-search" id="alternis-search-btn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19 19" fill="none">
              <path d="M8.25 14.75C11.5637 14.75 14.25 12.0637 14.25 8.75C14.25 5.43629 11.5637 2.75 8.25 2.75C4.93629 2.75 2.25 5.43629 2.25 8.75C2.25 12.0637 4.93629 14.75 8.25 14.75Z" stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
              <path d="M15.75 16.25L12.75 13.25" stroke="#1A1A1A" stroke-width="1.5" stroke-linecap="square" stroke-linejoin="round"></path>
            </svg>
          </div>
        </div>
      </div>
    </div>



    <?php if (!empty($banner_header)) { ?>
      <div class="alternis-header__announcement">
        <div class="container">
          <?php echo $banner_header; ?>
        </div>
      </div>
    <?php } ?>


  </header>