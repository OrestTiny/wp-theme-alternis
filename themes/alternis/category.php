<?php
/**
 * Category Template
 */

get_header();

if ( have_posts() ) :
	get_template_part( 'template-parts/blog', 'list-category' );
else : ?>
    <div class="alternis-blog--wrapper alternis-blog--search-page">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h3 class="alternis-blog--search-page__title"><?php esc_html_e( 'Sorry, no posts matched your criteria.', 'alternis' ); ?></h3>
                    <div class="alternis-blog--search-page__search-form">
						<?php get_search_form( true ); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif;

get_footer();