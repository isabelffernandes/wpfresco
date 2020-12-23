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
?>
<article class="post no-results not-found">
    <div class="container">
		<div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<header class="entry-header">
					<h1 class="entry-title"><?php esc_html_e('Nothing Found', 'artwork-lite'); ?></h1>
				</header>
				<div class="entry-content">
					<?php if (is_home() && current_user_can('publish_posts')) : ?>
						<p><?php printf(esc_html__('Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'artwork-lite'), esc_url(admin_url('post-new.php'))); ?></p>
					<?php elseif (is_search()) : ?>
						<p><?php esc_html_e('Sorry, but nothing matched your search criteria. Please try again with some different keywords.', 'artwork-lite'); ?></p>
					<?php else : ?>
						<p><?php esc_html_e('It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'artwork-lite'); ?></p>
					<?php endif; ?>
					<?php get_search_form(); ?>
				</div><!-- .entry-content -->
			</div>
		</div>
    </div><!-- .entry-content -->
</article><!-- #post-0 -->