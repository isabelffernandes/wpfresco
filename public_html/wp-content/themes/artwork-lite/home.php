<?php
/**
 * The home template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @subpackage Artwork
 * @since Artwork 
 */

get_header();

$mp_artwork_blog_type = esc_html(get_theme_mod(mp_artwork_get_prefix().'blog_style','default'));

get_template_part( 'blog', $mp_artwork_blog_type );
 
get_footer();