<?php
/**
 * The template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Artwork
 * @since Artwork 1.0
 */
get_header();
?>
<div class="main-container">
    <?php while (have_posts()) : the_post(); ?>
        <?php get_template_part('content', 'single'); ?>       
    <?php endwhile; ?>
</div>
<?php get_footer(); ?>