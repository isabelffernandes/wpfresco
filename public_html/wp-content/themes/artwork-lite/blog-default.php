<?php
/**
 * Blog
 * The template file for blog.
 * @package Artwork
 * @since Artwork 1.0
 */
if (!(is_front_page())) {
    $GLOBALS['mp_artwork_page_template'] = get_page_template_slug();
}

if (have_posts()) :
    ?>
    <div class="work-blog">
        <?php while (have_posts()) : the_post(); ?>
            <?php get_template_part('content-work', get_post_format()); ?>
    <?php endwhile; ?>
        <div class="clearfix"></div>
    </div>
    <div class="hidden">
        <div class="older-works">
        <?php next_posts_link(__('&laquo; Older Entries', 'artwork-lite')); ?>
        </div>
    <?php previous_posts_link(__('Newer Entries &raquo;', 'artwork-lite')); ?>
    </div>
<?php endif; 

