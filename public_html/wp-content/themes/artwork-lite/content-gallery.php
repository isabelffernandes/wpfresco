<?php
/**
 * The template for displaying posts in the Gallery post format
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
    <?php mp_artwork_get_post_gallery($post, $mp_artwork_page_template); ?>
    <div class="clearfix"></div>
    <?php mp_artwork_post_meta($post); ?>
</article><!-- #post -->