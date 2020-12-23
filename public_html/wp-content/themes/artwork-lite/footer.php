<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Artwork
 * @since Artwork 1.0
 */

?>

<?php if ( get_page_template_slug() != 'template-landing-page.php' || is_search() ): ?>
	<footer id="footer" class="site-footer">
		<div class="footer-inner">
			<?php get_sidebar( 'footer' ); ?>

			<div class="copyright">
				<div class="container">
					<p><span class="copyright-date"><?php esc_html_e( '&copy; Copyright ', 'artwork-lite' ); ?><?php
							$mp_artwork_dateObj = new DateTime;
							$mp_artwork_year    = $mp_artwork_dateObj->format( "Y" );
							echo $mp_artwork_year; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
							?>
                        </span>
						<?php
						?>
						  <a href="<?php echo esc_url(home_url('/')); ?>" title="<?php bloginfo('name'); ?>" target="_blank"><?php bloginfo('name'); ?></a>
						  <?php printf(__('&#8226; Designed by', 'artwork-lite')); ?> <a href="<?php echo esc_url(__('https://motopress.com/', 'artwork-lite' )); ?>" rel="nofollow" title="<?php esc_attr_e('Premium WordPress Plugins and Themes', 'artwork-lite' ); ?>"><?php _e('MotoPress', 'artwork-lite'); ?></a>
						  <?php printf(__('&#8226; Proudly Powered by ',  'artwork-lite')); ?><a href="<?php echo esc_url(__('http://wordpress.org/', 'artwork-lite')); ?>"  rel="nofollow" title="<?php esc_attr_e('Semantic Personal Publishing Platform', 'artwork-lite' ); ?>"><?php _e('WordPress',  'artwork-lite' ); ?></a>
						  <?php
						?>
					</p><!-- .copyright -->
				</div>
			</div>
		</div>
	</footer>
<?php endif; ?>
</div>
<?php wp_footer(); ?>
</body>
</html>