<?php
/**
 * 404 Page
 */

get_header(); ?>

    <div class="alternis-error--wrap">

        <div class="alternis-error--big-title"><?php esc_html_e( 'OOPS!', 'alternis' ); ?></div>

        <div class="alternis-error--small-title"><?php esc_html_e( '404', 'alternis' ); ?></div>

        <h1 class="alternis-error--title"><?php esc_html_e( 'Page not found', 'alternis' ); ?></h1>

        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="alternis-error--button"><?php esc_html_e( 'Go home', 'alternis' ); ?></a>

    </div>

<?php get_footer();
