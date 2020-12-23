<?php
/**
 * The template for displaying posts in the Link post format
 *
 * Used for  index/archive/search.
 *
 * @package WordPress
 * @subpackage Artwork
 * @since Artwork 1.0
 */
global $mp_artwork_page_template;

?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-in-blog post'); ?>>
    <?php mp_artwork_post_thumbnail($post, $mp_artwork_page_template); ?>
    <section class="entry entry-content">
        <?php the_content(); ?>         
        <div class="clearfix"></div>
    </section>
    
    <?php mp_artwork_post_meta($post); ?>
</article><!-- #post -->

