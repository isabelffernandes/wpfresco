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
            <?php
            $mp_artwork_img = mp_artwork_get_post_image();
            if (!empty($mp_artwork_img)):
                ?>
                <div class="entry-thumbnail">              
                    <a href = "<?php the_permalink(); ?>"><img src="<?php echo $mp_artwork_img // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped?>" class="attachment-post-thumbnail wp-post-image" alt="<?php the_title(); ?>"></a>
                </div>
                <?php
            else:
                mp_artwork_post_thumbnail($post, $mp_artwork_page_template);
            endif;
            ?>
            <div class="row">
                <div class="col-xs-12 col-sm-10 col-md-8 <?php if (has_post_thumbnail()) { ?> col-lg-6 col-lg-offset-3 <?php } else { ?> col-lg-8 col-lg-offset-2 <?php } ?> col-sm-offset-1 col-md-offset-2 ">
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
        </div>  
    </div>  
</article>
