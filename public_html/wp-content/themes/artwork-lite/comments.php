<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage Artwork
 * @since Artwork 1.0
 */
/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */

if (post_password_required())
    return;
?>

<div id="comments" class="comments-area">
    <?php if (have_comments()) : ?>
        <ol class="comment-list">
            <?php
			
            wp_list_comments(array(
                'style' => 'ol',
                'short_ping' => true,
                'avatar_size' => 72,
                'callback' => 'mp_artwork_theme_comment'
            ));
            ?>
        </ol><!-- .comment-list -->

        <?php
        // Are there comments to navigate through?
        if (get_comment_pages_count() > 1 && get_option('page_comments')) :
            ?>
            <nav class="navigation comment-navigation">
                <ul>
                    <li class="nav-previous"><?php previous_comments_link(__('previous', 'artwork-lite')); ?></li>
                    <li class="nav-next"><?php next_comments_link(__('next', 'artwork-lite')); ?></li>
                </ul
            </nav> 
        <?php endif; // Check for comment navigation  ?>

        <?php if (!comments_open() && get_comments_number()) : ?>
            <p class="no-comments"><?php esc_html_e('Comments are closed.', 'artwork-lite'); ?></p>
        <?php endif; ?>

    <?php endif; // have_comments()  ?>
    <?php
    if (comments_open()) {
        $mp_artwork_req = get_option('require_name_email');
        $mp_artwork_aria_req = ( $mp_artwork_req ? " aria-required='true'" : '' );
        $mp_artwork_comment_args = array(
            'fields' => apply_filters('comment_form_default_fields', array(
                'author' => '<div class="form-group comment-form-author">' .
                '<input class="form-control" id="author" placeholder="' . __('Name*', 'artwork-lite') . '" name="author" type="text" value="' .
                esc_attr($commenter['comment_author']) . '" size="30"' . $mp_artwork_aria_req . ' />' .
                '</div><!-- #form-section-author .form-section -->',
                'email' => '<div class="form-group comment-form-email">' .
                '<input class="form-control" id="email" placeholder="' . __('Email*', 'artwork-lite') . '" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $mp_artwork_aria_req . ' />' .
                '</div><!-- #form-section-email .form-section -->',
                'url' => '<div class="form-group comment-form-url">' .
                '<input class="form-control" placeholder="' .__('Website', 'artwork-lite') . '" id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) .
                '" size="30" /></div>')),
            'comment_notes_after' => '',
            'comment_field' => '<div class="form-group comment-form-comment"><textarea placeholder="'. __('Comment*', 'artwork-lite') .'" rows="2" class="form-control" id="comment" name="comment" aria-required="true"></textarea></div>'
        );
        comment_form($mp_artwork_comment_args);
    }
    ?>

</div><!-- #comments -->