<?php
/**
 * The template for displaying posts in the Image post format
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
    <?php
    $mp_artwork_img = mp_artwork_get_post_image();
    if (!empty($mp_artwork_img)): ?>
        <div class="entry-thumbnail">              
            <a href = "<?php the_permalink(); ?>"><img src="<?php echo $mp_artwork_img // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped?>" class="attachment-post-thumbnail wp-post-image" alt="<?php the_title(); ?>"></a>
        </div>
        <?php
    else:
        if (has_post_thumbnail() && !post_password_required() && !is_attachment()) : ?>
            <div class="entry-thumbnail">
                <?php if ($mp_artwork_page_template == 'template-full-width-blog.php'): ?>
                    <a href = "<?php the_permalink(); ?>" ><?php the_post_thumbnail( mp_artwork_get_prefix() . 'thumb-large'); ?></a>
                <?php else: ?>               
                    <a href = "<?php the_permalink(); ?>" ><?php the_post_thumbnail(); ?></a>
                <?php endif; ?>
            </div>
            <?php
        endif;
    endif;
    ?>        
    <div class="clearfix"></div>
    <?php mp_artwork_post_meta($post); ?>
</article><!-- #post -->