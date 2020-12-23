<?php
/**
 * The sidebar containing the footer widget area
 *
 * If no active widgets in this sidebar, hide it completely.
 *
 * @package WordPress
 * @subpackage Artwork
 * @since Artwork
 */
?>
<?php if ( is_active_sidebar( 'sidebar-2' ) || is_active_sidebar( 'sidebar-3' ) || is_active_sidebar( 'sidebar-4' ) ) : ?>
	<div class="container">
		<div class="row">
			<div
				class="col-xs-12 <?php if ( is_active_sidebar( 'sidebar-3' ) || is_active_sidebar( 'sidebar-4' ) ) : echo 'col-sm-4 col-md-4 col-lg-4';
				else: echo 'col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center'; endif; ?> ">
				<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
					<?php dynamic_sidebar( 'sidebar-2' );
				endif; ?>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
					<?php dynamic_sidebar( 'sidebar-3' );
				endif; ?>
			</div>
			<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4">
				<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
					<?php dynamic_sidebar( 'sidebar-4' );
				endif; ?>
			</div>
		</div><!-- .widget-area -->
	</div>
<?php endif; ?>