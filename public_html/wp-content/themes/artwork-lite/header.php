<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Artwork
 * @since Artwork 1.0
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>"/>
	<meta name="viewport" content="width=device-width, initial-scale=1"/>
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<?php
$mp_artwork_class = 'artwork';
if ( is_front_page() ) :
	if ( get_page_template_slug() === 'template-front-page.php' ):
		$mp_artwork_class = $mp_artwork_class . ' artwork-custom-home';
	endif;
endif;
$mp_artwork_menu_behavior = esc_attr( get_theme_mod( mp_artwork_get_prefix() . 'menu_behavior' ) );
if ( $mp_artwork_menu_behavior === 'always' ) {
	$mp_artwork_class = $mp_artwork_class . ' show-header-always';
}
?>

<body <?php body_class( $mp_artwork_class ); ?> >
<div class="site-wrapper">
	<?php if ( get_page_template_slug() != 'template-landing-page.php' ): ?>
	<header id="header" class="main-header">
		<div class="top-header">
			<span class="menu-icon"><i class="fa fa-bars"></i></span>
			<div class="top-header-content">
				<div class="top-content <?php echo get_theme_mod( 'custom_logo' ) ? 'with-logo' : 'without-logo' ?>">
					<?php if ( get_theme_mod( 'custom_logo' ) ) : ?>
						<div class="site-logo">
							<div class="header-logo ">
								<?php the_custom_logo(); ?>
							</div>
						</div>
					<?php endif; ?>
					<div id="navbar" class="navbar <?php
					if ( get_theme_mod( 'custom_logo' ) === "" ): echo 'navbar-full-width';
					endif;
					?>">
						<nav id="site-navigation" class="main-navigation">
							<?php
							$mp_artwork_defaults = array(
								'theme_location' => 'primary',
								'menu_class'     => 'sf-menu ',
								'menu_id'        => 'main-menu',
								'fallback_cb'    => 'mp_artwork_page_menu'
							);
							wp_nav_menu( $mp_artwork_defaults );
							?>
						</nav>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>

	</header>
<?php


endif;