<?php

/**
 * Get prefix.
 *
 * @access public
 * @return sting
 */
function mp_artwork_get_prefix() {
	return 'mp_artwork_';
}

/**
 * /**
 * Display navigation to next/previous pages when applicable.
 *
 * @since Artwork 1.0
 *
 * @param string $mp_artwork_html_id The HTML id attribute.
 */
function mp_artwork_content_nav( $mp_artwork_html_id ) {
	global $wp_query;
	if ( $wp_query->max_num_pages > 1 ) :
		?>
		<nav id="<?php echo esc_attr( $mp_artwork_html_id ); ?>" class="<?php echo esc_attr( $mp_artwork_html_id ); ?>">
			<div
				class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'artwork-lite' ) ); ?></div>
			<div
				class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'artwork-lite' ) ); ?></div>
			<div class="clearfix"></div>
		</nav>
		<?php
	endif;
}

/*
 * Post comments
 */

function mp_artwork_theme_comment( $mp_artwork_comment, $mp_artwork_args, $mp_artwork_depth ) {
	extract( $mp_artwork_args, EXTR_SKIP );

	if ( 'div' == $mp_artwork_args['style'] ) {
		$mp_artwork_tag       = 'div';
		$mp_artwork_add_below = 'comment';
	} else {
		$mp_artwork_tag       = 'li';
		$mp_artwork_add_below = 'div-comment';
	}
	?>
	<<?php echo $mp_artwork_tag ?><?php comment_class( empty( $mp_artwork_args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>"> <?php // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
	<?php if ( 'div' != $mp_artwork_args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-body">
		<div class="comment-description">
	<?php endif; ?>
	<div class="comment-author vcard">
		<?php if ( $mp_artwork_args['avatar_size'] != 0 ) {
			echo get_avatar( $mp_artwork_comment, $mp_artwork_args['avatar_size'] );
		} ?>
	</div>
	<div class="comment-content">
	<div class="comment-content-header">
		<div>

			<?php printf( '<h6 class="fn">%s</h6>', get_comment_author_link() ); ?>
			<?php if ( $mp_artwork_comment->comment_approved == '0' ) : ?>
				<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'artwork-lite' ); ?></em>
				<br/>
			<?php endif; ?>
			<div class="comment-meta date-post">
				<?php
				// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				printf( __( '%1$s <span>at %2$s</span>', 'artwork-lite' ), get_comment_date( 'F j, Y' ), get_comment_time() );
				?>
				<?php edit_comment_link( __( '(Edit)', 'artwork-lite' ), '  ', '' ); ?>
			</div>
		</div>
	</div>
	<?php comment_text(); ?>

	<div class="reply">
		<?php comment_reply_link( array_merge( $mp_artwork_args, array(
			'add_below' => $mp_artwork_add_below,
			'depth'     => $mp_artwork_depth,
			'max_depth' => $mp_artwork_args['max_depth']
		) ) ); ?>
	</div>
	<?php if ( 'div' != $mp_artwork_args['style'] ) : ?>
		</div>
		</div>
		</div>
	<?php endif; ?>

	<?php
}

/*
 * Define the get_comment_author_link callback
 */
function mp_artwork_filter_get_comment_author_link( $mp_artwork_return, $mp_artwork_author, $mp_artwork_comment_comment_id ) {
	$mp_artwork_comment = get_comment( $mp_artwork_comment_comment_id );
	$mp_artwork_url     = get_comment_author_url( $mp_artwork_comment );
	$mp_artwork_user    = get_userdata( $mp_artwork_comment->user_id );
	if ( $mp_artwork_user ) {
		$mp_artwork_author = $mp_artwork_user->display_name;
		if ( empty( $mp_artwork_url ) || 'http://' == $mp_artwork_url ) {
			$mp_artwork_return = $mp_artwork_author;
		} else {
			$mp_artwork_return = "<a href='$mp_artwork_url' rel='external nofollow' class='url'>$mp_artwork_author</a>";
		}
	}
	return $mp_artwork_return;
}

/*
 * add the filter get_comment_author_link
 */
add_filter( 'get_comment_author_link', 'mp_artwork_filter_get_comment_author_link', 10, 3 );

/*
 * Gett HTML  information for the current post-date/time and author. *
 */

function mp_artwork_posted_on( $mp_artwork_post ) {
	if ( strcmp( get_post_type( $mp_artwork_post ), 'post' ) === 0 ) {
		$mp_artwork_archive_year  = get_the_time( 'Y' );
		$mp_artwork_archive_month = get_the_time( 'm' );
		$mp_artwork_archive_day   = get_the_time( 'd' );
		printf( '<span class="date-post"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>', esc_url( get_day_link( $mp_artwork_archive_year, $mp_artwork_archive_month, $mp_artwork_archive_day ) ), esc_attr( get_the_time() ), esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ) );
	} else {
		printf( '<span class="date-post"><time class="entry-date" datetime="%1$s">%2$s</time></span>', esc_attr( get_the_date( 'c' ) ), esc_html( get_the_date() ) );
	}
}

/*
 * Gety meta  information for the current post-date/time and author. *
 */

function mp_artwork_posted_on_meta( $mp_artwork_post ) {
	if ( get_theme_mod( mp_artwork_get_prefix() . 'show_meta', '1' ) === '1' || get_theme_mod( mp_artwork_get_prefix() . 'show_meta' ) ): ?>
	
	<div class="entry-meta">
        <span>
    <?php esc_html_e( 'Posted on', 'artwork-lite' ); ?>
        </span>
		<?php mp_artwork_posted_on( $mp_artwork_post ); ?>
	</div>
	
	<?php
	endif;
}

/*
 * Get list term
 */

function mp_artwork_get_term_list( $term_list ) {
	foreach ( $term_list as $mp_artwork_term ) {
		echo '<a href="' . get_term_link( $mp_artwork_term ) . '">' . $mp_artwork_term->name . '</a>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		if ( $mp_artwork_term != end( $term_list ) ) :
			echo ", ";
		endif;
	}
}

/*
 * Post Category
 */

function mp_artwork_post_category( $mp_artwork_post ) {
	if ( get_theme_mod( mp_artwork_get_prefix() . 'show_categories', '1' ) === '1' || get_theme_mod( mp_artwork_get_prefix() . 'show_categories' ) ):
		if ( strcmp( get_post_type( $mp_artwork_post ), 'post' ) === 0 ) :
			?>
			<?php $mp_artwork_categories = get_the_category_list( '<span>,</span> ', 'multiple', $mp_artwork_post->ID ); ?>
			<?php if ( ! empty( $mp_artwork_categories ) ) : ?>
			<span class="seporator">/</span>
			<span><?php esc_html_e( 'Posted in', 'artwork-lite' ); ?></span>
			<?php echo $mp_artwork_categories; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php endif; ?>
			<?php
		else:
			$mp_artwork_postTypeSlug = mp_artwork_get_post_type_slug();
			if ( $mp_artwork_postTypeSlug ):
				$mp_artwork_postTypeSlugName = 'category_' . $mp_artwork_postTypeSlug;
				$mp_artwork_term_list        = wp_get_post_terms( $mp_artwork_post->ID, $mp_artwork_postTypeSlugName, array( "fields" => "all" ) );
				?>
				<?php if ( ! empty( $mp_artwork_term_list ) ) : ?>
				<span class="seporator">/</span>
				<span><?php esc_html_e( 'Posted in', 'artwork-lite' ); ?></span>
				<?php
				mp_artwork_get_term_list( $mp_artwork_term_list );
				?>
				<?php
			endif;
			endif;
		endif;
	endif;
}

/*
 * Post first Category
 */

function mp_artwork_post_first_category( $mp_artwork_post ) {
	if ( get_theme_mod( mp_artwork_get_prefix() . 'show_categories', '1' ) === '1' || get_theme_mod( mp_artwork_get_prefix() . 'show_categories' ) ):
		$mp_artwork_category = get_the_category();
		if ( $mp_artwork_category ) {
			echo '<a href="' . esc_url(get_category_link( $mp_artwork_category[0]->term_id )) . '" title="' . sprintf( __( "View all posts in %s", 'artwork-lite' ), $mp_artwork_category[0]->name ) . '" ' . ' class="category-wrapper">' . $mp_artwork_category[0]->name . '</a> '; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	endif;
}

/*
 * Post Tag
 */

function mp_artwork_post_tag( $mp_artwork_post ) {
	if ( get_theme_mod( mp_artwork_get_prefix() . 'show_tags', '1' ) === '1' || get_theme_mod( mp_artwork_get_prefix() . 'show_tags' ) ):

		if ( strcmp( get_post_type( $mp_artwork_post ), 'post' ) === 0 ) :
			the_tags( '<span class="seporator">/</span> <span>' . __( 'Tagged with', 'artwork-lite' ) . '</span> ', '<span>,</span> ', '' );
		else:
			$mp_artwork_postTypeSlug = mp_artwork_get_post_type_slug();
			if ( $mp_artwork_postTypeSlug ):
				$mp_artwork_postTypeSlugName = 'post_tag_' . $mp_artwork_postTypeSlug;
				$mp_artwork_term_list        = wp_get_post_terms( $mp_artwork_post->ID, $mp_artwork_postTypeSlugName, array( "fields" => "all" ) );
				if ( ! empty( $mp_artwork_term_list ) ) :
					?>
					<span class="seporator">/</span>
					<span><?php esc_html_e( 'Tagged with', 'artwork-lite' ); ?></span>
					<?php
					mp_artwork_get_term_list( $mp_artwork_term_list );
				endif;
			endif;
		endif;
	endif;
}

/*
 * Post meta
 */

function mp_artwork_post_meta( $mp_artwork_post ) {
	if ( get_theme_mod( mp_artwork_get_prefix() . 'show_meta', '1' ) === '1' || get_theme_mod( mp_artwork_get_prefix() . 'show_meta' ) || get_theme_mod( mp_artwork_get_prefix() . 'show_tags', '1' ) === '1' || get_theme_mod( mp_artwork_get_prefix() . 'show_tags' ) || get_theme_mod( mp_artwork_get_prefix() . 'show_categories', '1' ) === '1' || get_theme_mod( mp_artwork_get_prefix() . 'show_categories' ) ):
		?>
		<footer class="entry-footer">
			<?php if ( get_theme_mod( mp_artwork_get_prefix() . 'show_meta', '1' ) === '1' || get_theme_mod( mp_artwork_get_prefix() . 'show_meta' ) ): ?>
				<div class="entry-meta">
					<span class="author"><?php esc_html_e( 'Posted by', 'artwork-lite' ); ?> </span><?php the_author_posts_link(); ?>
					<span class="seporator">/</span>
					<?php mp_artwork_posted_on( $mp_artwork_post ); ?>
					<?php if ( comments_open() ) : ?>
						<span class="seporator">/</span>
						<a class="blog-icon underline" href="<?php
						if ( ! is_single() ): the_permalink();
						endif;
						?>#comments"><span><?php comments_number(__('No Comments', 'artwork-lite'), __('One Comment', 'artwork-lite'), __('% Comments', 'artwork-lite')); ?></span></a>
						<?php
					endif;
					mp_artwork_post_tag( $mp_artwork_post );
					mp_artwork_post_category( $mp_artwork_post );
					edit_post_link( __( 'Edit', 'artwork-lite' ), '<span class="seporator">/</span> ', '' );
					?>
				</div>
			<?php endif; ?>
		</footer>
		<?php
	endif;
}

/*
 * Post first embed media
 */

function mp_artwork_get_first_embed_media( $mp_artwork_post_id ) {
	$mp_artwork_post    = get_post( $mp_artwork_post_id );
	$mp_artwork_content = do_shortcode( apply_filters( 'the_content', $mp_artwork_post->post_content ) );
	$mp_artwork_embeds  = get_media_embedded_in_content( $mp_artwork_content );
	if ( ! empty( $mp_artwork_embeds ) ) {
		return '<div class="entry-media">' . $mp_artwork_embeds[0] . '</div>';
	} else {
		return false;
	}
}

/*
 * Post content
 */

function mp_artwork_get_content_theme( $mp_artwork_content_length ) {
	?>
	<?php
	$mp_artwork_content = apply_filters( 'the_content', strip_shortcodes( get_the_content() ) );
	$mp_artwork_content = wp_strip_all_tags( $mp_artwork_content );
	$mp_artwork_content = wp_kses( $mp_artwork_content, array() );
	$mp_artwork_content = preg_replace( '/<(script|style)(.*?)>(.*?)<\/(script|style)>/is', '', $mp_artwork_content );
	if ( strlen( $mp_artwork_content ) > $mp_artwork_content_length ) {
		$mp_artwork_content = extension_loaded( 'mbstring' ) ? mb_substr( $mp_artwork_content, 0, $mp_artwork_content_length ) . '...' : substr( $mp_artwork_content, 0, $mp_artwork_content_length ) . '...';
	}
	echo $mp_artwork_content; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	?>
	<?php
}

/*
 * Post image
 */

function mp_artwork_get_post_image() {
	global $post, $posts;
	$mp_artwork_first_img = '';
	ob_start();
	ob_end_clean();
	$mp_artwork_output = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $mp_artwork_matches );
	if ( ! empty( $mp_artwork_matches[1] ) ) {
		$mp_artwork_first_img = $mp_artwork_matches[1][0];
		if ( empty( $mp_artwork_first_img ) ) {
			$mp_artwork_first_img = "";
		}
	}

	return $mp_artwork_first_img;
}

function mp_artwork_posttype_name_sanitize_text( $mp_artwork_txt ) {
	$mp_artwork_txt = strip_tags( $mp_artwork_txt, '' );
	$mp_artwork_txt = preg_replace( "/[^a-zA-Z0-9-]+/", "", $mp_artwork_txt );
	$mp_artwork_txt = substr( strtolower( $mp_artwork_txt ), 0, 19 );

	return wp_kses_post( force_balance_tags( $mp_artwork_txt ) );
}

/*
 * Get post type slug
 * 
 * @return string 
 */

function mp_artwork_get_post_type_slug() {
	$mp_artwork_post_type_slug = '';
	if ( is_plugin_active( 'mp-artwork/mp-artwork.php' ) ) {
		$mp_artwork_post_type_slug = mp_artwork_posttype_name_sanitize_text( get_option( mp_artwork_get_prefix() . 'post_type_slug' ) );
	}
	if ( $mp_artwork_post_type_slug ) {
		return $mp_artwork_post_type_slug;
	} else {
		if ( has_post_format( 'work' ) ) {
			return '';
		}
	}
}

/**
 * Artwork page menu.
 *
 * Show pages of site.
 *
 * @since Artwork 1.0
 */
function mp_artwork_page_menu() {
	echo '<ul class="sf-menu">';
	wp_list_pages( array( 'title_li' => '', 'depth' => 1 ) );
	echo '</ul>';
}

/**
 * Artwork page top menu.
 *
 * Show pages of site.
 *
 * @since Artwork 1.0
 */
function mp_artwork_page_short_menu() {
	echo '<ul id="menu-top-menu" class="menu">';
	$mp_artwork_pages = wp_list_pages( array( 'title_li' => '', 'depth' => 1, 'echo' => 0 ) );
	$mp_artwork_pages = explode( "</li>", $mp_artwork_pages );
	$mp_artwork_count = 0;
	foreach ( $mp_artwork_pages as $mp_artwork_page ) {
		$mp_artwork_count ++;
		echo $mp_artwork_page; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		if ( $mp_artwork_count == 3 ) {
			break;
		}
	}
	echo '</ul>';
}

/**
 * Artwork post gallery.
 *
 * Show  post gallery.
 *
 * @since Artwork 1.0
 */
function mp_artwork_get_post_gallery( $mp_artwork_post, $mp_artwork_page_template ) {
	$mp_artwork_galleryPost = new MP_Artwork_Gallery( mp_artwork_get_prefix() );
	$mp_artwork_galleryPost->get_post_gallery( $mp_artwork_post, $mp_artwork_page_template );
}

/**
 * Artwork post related posts.
 *
 * Show post related posts.
 *
 * @since Artwork 1.0
 */
function mp_artwork_get_related_posts() {
	$mp_artwork_relatedPost = new MP_Artwork_Related( mp_artwork_get_prefix() );
	$mp_artwork_relatedPost->related_posts();
}

/*
 * Post thumbnail 
 *  @since Artwork 1.0
 */

function mp_artwork_post_thumbnail( $mp_artwork_post, $mp_artwork_page_template ) {
	?>
	<?php if ( has_post_thumbnail() && ! post_password_required() && ! is_attachment() ) : ?>
		<div class="entry-thumbnail">
			<?php if ( $mp_artwork_page_template == 'template-works.php' ): ?>
				<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( mp_artwork_get_prefix() . 'thumb-large-blog' ); ?></a>
			<?php else: ?>
				<?php if ( $mp_artwork_page_template == 'single.php' ): ?>
					<?php the_post_thumbnail( mp_artwork_get_prefix() . 'thumb-large-blog' ); ?>
				<?php else: ?>
					<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( mp_artwork_get_prefix() . 'thumb-large-blog' ); ?></a>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	<?php else:
		?>
		<?php if ( $mp_artwork_page_template == 'template-two-columns-blog.php' ): ?>
		<div class="entry-thumbnail empty-entry-thumbnail">
			<a href="<?php the_permalink(); ?>" rel="external" title="<?php the_title(); ?>"><span class="date-post">
            <?php echo esc_html(get_post_time( 'j M' )); ?>
                    </span></a>
		</div>
	<?php endif; ?>
		<?php
	endif;
}

add_filter('body_class', 'mp_artwork_filter_body_class');
function mp_artwork_filter_body_class($classes){

    if(wp_is_mobile()){
        $classes[] = 'mobile-device';
    }

    return $classes;
}