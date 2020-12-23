<?php
/**
 * Artwork functions and definitions
 *
 * @package WordPress
 * @subpackage Artwork
 * @since Artwork 1.0
 */
require get_template_directory() . '/inc/theme/init.php';
require get_template_directory() . '/inc/theme/utils.php';

/**
 * Note: Do not add any custom code here. Please use a child theme so that your customizations aren't lost during updates.
 * http://codex.wordpress.org/Child_Themes
 */


// change the button label at the front page 
/*add_filter('mp_artwork_frontpage_button_label', 'artwork_child_frontpage_button_label');
function artwork_child_frontpage_button_label() {
	return 'Details';
}*/

// display original image at the front page
/*add_filter('mp_artwork_frontpage_image_size', 'artwork_child_frontpage_image_size');
function artwork_child_frontpage_image_size() {
	return 'original';
}*/