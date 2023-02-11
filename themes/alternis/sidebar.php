<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Alternis
 */

if ( ! is_active_sidebar( 'alternis-sidebar' ) ) {
	return;
}
?>

<div class="col-12 col-lg-4">
    <div class="alternis-blog--sidebar">
		<?php dynamic_sidebar( 'alternis-sidebar' ); ?>
    </div>
</div>

