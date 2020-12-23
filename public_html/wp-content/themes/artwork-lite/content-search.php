<?php
/**
 * The default template for displaying content
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
	<header class="entry-header">
		<?php
			if ( is_single() ) :
				the_title( '<h1 class="entry-title">', '</h1>', true );
			else :
				the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' );
			endif;
		?> 
	</header>
    <section class="entry entry-content">
        <p>
            <?php
            mp_artwork_get_content_theme(200, false);
            ?>
        </p>
    </section>
    <?php mp_artwork_post_meta($post); ?>
</article><!-- #post -->