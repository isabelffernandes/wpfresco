<?php
/**
 * The template for displaying Forum pages
 *
 * @package WordPress
 * @subpackage Artwork
 * @since Artwork 1.0
 */
get_header();
?>
<div class="container main-container">
    <?php if (have_posts()) : ?>
        <?php /* The loop */ ?>
        <?php while (have_posts()) : the_post(); ?>
            <?php the_content(); ?>
        <?php endwhile; ?>
    <?php endif; ?>
</div>
<?php get_footer(); ?>