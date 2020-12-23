<?php
/**
 * Blog with sidebar
 * The template file for pages with right sidebar.
 * @package Artwork
 * @since Artwork 1.0
 */



if (!(is_front_page())) {
    $GLOBALS['mp_artwork_page_template'] = get_page_template_slug();
}
?>
<div class="container main-container">
    <div class="row clearfix">
        <div class=" col-xs-12 col-sm-8 col-md-8 col-lg-8">
            <?php if (have_posts()) : ?>
                <?php /* The loop */ ?>
                <?php while (have_posts()) : the_post(); ?>
                    <?php get_template_part('content', get_post_format()); ?>
                <?php endwhile; ?>
                <?php mp_artwork_content_nav( 'nav-below' ); ?>
            <?php endif; ?>
        </div>
        <div class=" col-xs-12 col-sm-4 col-md-4 col-lg-4">
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>
<?php
