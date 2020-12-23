<?php
/**
 * The template for displaying about page
 *
 * This is the template that displays about page by default.
 *
 * @package WordPress
 * @subpackage Artwork
 * @since Artwork 1.0
 */

get_header();
?>
<div class="container main-container theme-about-page">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>
                <?php
                if (has_action(mp_artwork_get_prefix() . 'about_page')) {
                    do_action(mp_artwork_get_prefix() . 'about_page');
                } else {
                    if (has_post_thumbnail() && !post_password_required()) :
                        ?>
                        <div class="entry-thumbnail">
                        <?php the_post_thumbnail(); ?>
                        </div>
                        <?php endif; ?>
                    <div class="entry-content">
                    <?php the_content(); ?>                    
                    </div><!-- .entry-content -->
            <?php } ?>
            </article><!-- #post -->
        <?php endwhile; ?>
<?php endif; ?>

</div>
<?php
get_footer();

