<?php
/**
 * The template for displaying posts in the Quote post format
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
    <section class="entry entry-content">
        <?php the_content(); ?>         
        <div class="clearfix"></div>
    </section>
    <?php mp_artwork_post_meta($post); ?>
</article><!-- #post -->


