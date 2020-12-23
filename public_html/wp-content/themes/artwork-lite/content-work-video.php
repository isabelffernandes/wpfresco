<?php
/**
 * The default template for displaying work content
 *
 * Used for  template-works.
 *
 * @package WordPress
 * @subpackage Artwork
 * @since Artwork 1.0
 */
global $mp_artwork_page_template;

?>
<article class="page-wrapper">
    <div id="post-<?php the_ID(); ?>" <?php post_class('work-post'); ?>>
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-md-8 col-lg-6 col-lg-offset-3 col-sm-offset-1 col-md-offset-2"> 
                    <?php mp_artwork_post_first_category($post); ?>
                    <div class="entry-wrapper">
                        <header class="entry-header">
                            <?php
                            $mp_artwork_title = the_title('<h2 class="entry-title h4"><a href="' . get_permalink() . '" rel="bookmark">', '</a></h2>', false);
                            if ($mp_artwork_title) {
                                echo $mp_artwork_title; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                            } else {
                                mp_artwork_posted_on_meta($post);
                            }
                            ?> 
                        </header>
                        <?php
                        if ($mp_artwork_title) {
                            ?>
                            <footer class="entry-footer">                                
                                <?php mp_artwork_posted_on_meta($post); ?>
                            </footer>
                        <?php } ?>
                    </div>  
                </div>  
            </div>              
            <?php
            $mp_artwork_media = mp_artwork_get_first_embed_media($post->ID);
            if ($mp_artwork_media === false):
                mp_artwork_post_thumbnail($post, $mp_artwork_page_template);
            else:
                echo $mp_artwork_media; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            endif;
            ?>
        </div>  
    </div>  
</article>
