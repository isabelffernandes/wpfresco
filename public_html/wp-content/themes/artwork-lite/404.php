<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * @package WordPress
 * @subpackage artwork
 * @since artwork 1.0
 */
get_header();
?>
<div class="container main-container">
    <article id="page-404" <?php post_class('page-404'); ?>>
        <div class="entry-content">
            <h1>404</h1>
            <h2><?php esc_html_e("<span class='brand-color'>Oo0ps!</span> That page not found.", 'artwork-lite'); ?></h2>
            <p><?php esc_html_e('The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'artwork-lite'); ?></p>
            <p><?php esc_html_e('Please try using our search box below to look for information on the website', 'artwork-lite'); ?></p>
            <div class="row"> 
                <div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 col-sm-offset-3 col-md-offset-4 col-lg-offset-4">
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div><!-- .entry-content -->    
    </article>
</div>
<?php get_footer(); ?>
