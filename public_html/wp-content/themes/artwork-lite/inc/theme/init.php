<?php

class MP_Artwork {

	private $prefix;

	public function __construct() {
		$this->prefix = 'mp_artwork';
		$this->define_constant();
		$this->init();
		$this->add_actions();
	}

	/**
	 * Add theme actions.
	 *
	 * @access public
	 * @return voi
	 */
	public function add_actions() {
		add_action( 'after_setup_theme', array( $this, 'setup' ) );
		add_action( 'wp_print_styles', array( $this, 'load_google_fonts' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'scripts_styles' ) );
		add_action( 'widgets_init', array( $this, 'widgets_init' ) );
		add_action( 'after_setup_theme', array( $this, 'woocommerce_support' ) );
		add_action( 'enqueue_block_editor_assets', array( $this, 'generate_editor_font_style' ) );
	}

	/**
	 *  Add theme add_filters.
	 *
	 * @access public
	 * @return voi
	 */
	public function add_filters() {
		add_filter( 'excerpt_length', array( $this, 'excerpt_length', 999 ) );
		add_filter( 'wp_audio_shortcode', array( $this, 'audio_short_fix', 10, 5 ) );
	}

	/**
	 * Get prefix.
	 *
	 * @access public
	 * @return sting
	 */
	private function get_prefix() {
		return $this->prefix . '_';
	}

	/**
	 * Set constants.
	 *
	 * @access private
	 * @return void
	 */
	private function define_constant() {
		define( 'MP_ARTWORK_DEFAULT_ADDRESS', '24 Hillside Gardens, Northwood' );
		define( 'MP_ARTWORK_DEFAULT_OPEN_HOURS', '10am-6pm, 7 days a week' );
		define( 'MP_ARTWORK_TEXT_COLOR', '#707070' );
		define( 'MP_ARTWORK_BRAND_COLOR', '#ef953e' );
		define( 'MP_ARTWORK_SECOND_BRAND_COLOR', '#753249' );
		define( 'MP_ARTWORK_THIRD_BRAND_COLOR', '#ea5455' );
		define( 'MP_ARTWORK_FOURTH_BRAND_COLOR', '#2e3f59' );
	}

	public function init() {
		/*
		 * Set up the content width value based on the theme's design.
		 *
		 */
		if ( ! isset( $content_width ) ):
			$content_width = 770;
		endif;


		include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

		$this->theme_requires();
	}

	/**
	 * Artwork setup.
	 *
	 * Sets up theme defaults and registers the various WordPress features that
	 * Artwork supports.
	 *
	 * @since Artwork 1.0
	 */
	public function setup() {
		/*
		 * This theme styles the visual editor to resemble the theme style,
		 * specifically font, colors, icons, and column width.
		 */
		$font_family = get_theme_mod( $this->get_prefix() . "text_font_family", "Josefin Sans" );
		$editor_google_font = 'https://fonts.googleapis.com/css?family='.str_replace( " ", "+", $font_family ) . ":100,100italic,300,300italic,400,400italic,600,600italic,700italic,700" ;
		add_theme_support('editor-styles');
		add_editor_style(array('css/artwork-editor-style.css', $editor_google_font, $this->generate_editor_font_style()));
		/*
		 * Makes Artwork available for translation.
		 *
		 * Translations can be added to the /languages/ directory.
		 * If you're building a theme based on Artwork, use a find and
		 * replace to change 'Artwork' to the name of your theme in all
		 * template files.
		 */
		load_theme_textdomain('artwork-lite', get_template_directory() . '/languages');

		$locale      = get_locale();
		$locale_file = get_template_directory() . "/languages/$locale.php";

		if ( is_readable( $locale_file ) ) {
			require_once( $locale_file );
		}
		/*
		 *  Adds RSS feed links to <head> for posts and comments.
		 */
		add_theme_support( 'automatic-feed-links' );
		/*
		 * Supporting title tag via add_theme_support (since WordPress 4.1)
		 */
		add_theme_support( 'title-tag' );
		/*
		 * This theme supports a variety of post formats.
		 */
		add_theme_support( 'post-formats', array(
			'aside',
			'gallery',
			'image',
			'video',
			'quote',
			'audio',
			'link',
			'status',
		) );
		/*
		 *  This theme uses wp_nav_menu() in one location.
		 */
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu', 'artwork-lite' )
			) );

		/*
		 * This theme uses its own gallery styles.
		 */
		add_filter( 'use_default_gallery_style', '__return_false' );

		$this->add_theme_image_sizes();

		add_theme_support('editor-color-palette', array(
			array(
				'name' => esc_html__('Color-1', 'artwork-lite' ),
				'slug' => 'color-1',
				'color' => '#707070'
			),
			array(
				'name' => esc_html__('Color-2', 'artwork-lite' ),
				'slug' => 'color-2',
				'color' => '#ef953e'
			),
			array(
				'name' => esc_html__('Color-3', 'artwork-lite' ),
				'slug' => 'color-3',
				'color' => '#753249'
			),
			array(
				'name' => esc_html__('Color-4', 'artwork-lite' ),
				'slug' => 'color-4',
				'color' => '#2e3f59'
			),
			array(
				'name' => esc_html__('Color-5', 'artwork-lite' ),
				'slug' => 'color-5',
				'color' => '#171717'
			),
			array(
				'name' => esc_html__('Color-6', 'artwork-lite' ),
				'slug' => 'color-6',
				'color' => '#f6f6f6'
			),
		));
	}

	/*
	 * Add theme support post thumbnails.
	 */

	public function add_theme_image_sizes() {
		if ( function_exists( 'add_theme_support' ) ) {
			add_theme_support( 'post-thumbnails' );
			set_post_thumbnail_size( 770, 578, true );
		}
		add_image_size( $this->get_prefix() . 'thumb-large', 2000 );
		add_image_size( $this->get_prefix() . 'thumb-large-blog', 1170 );
		add_image_size( $this->get_prefix() . 'thumb-medium', 960, 640, true );
	}

	/* Return the Google font stylesheet URL, if available.
	 *
	 * The use of Open Sans by default is localized.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */

	function load_google_fonts() {

		//Josefin Sans
		$font_family_text       = get_theme_mod( $this->get_prefix() . "text_font_family", "Josefin Sans" );
		//Niconne
		$font_family_title       = get_theme_mod( $this->get_prefix() . "title_font_family", "Niconne" );

		if ( strcasecmp( $font_family_text, "Josefin Sans" ) == 0 ) {
			wp_register_style( $this->get_prefix() . 'JosefinSans',
				'https://fonts.googleapis.com/css?family=Josefin+Sans:400,100,100italic,300,300italic,400italic,600,600italic,700italic,700', array(), null );
			wp_enqueue_style( $this->get_prefix() . 'JosefinSans' );
		}

		if ( strcasecmp( $font_family_title, "Niconne" ) == 0 ) {
			wp_register_style( $this->get_prefix() . 'Niconne', 'https://fonts.googleapis.com/css?family=Niconne', array(), null );
			wp_enqueue_style( $this->get_prefix() . 'Niconne' );
		}
	}

	/**
	 * Enqueue scripts and styles for the front end.
	 */
	function scripts_styles() {
		/*
		 * Adds JavaScript to pages with the comment form to support
		 * sites with threaded comments (when in use).
		 */
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
		/*
		 *  Scripts for template masonry blog
		 */
		wp_enqueue_script( 'jquery-infinitescroll', get_template_directory_uri() . '/js/jquery.infinitescroll.min.js', array( 'jquery' ), '2.1.0', true );
		wp_enqueue_script( 'superfish', get_template_directory_uri() . '/js/superfish.min.js', array( 'jquery' ), '1.7.5', true );
		wp_enqueue_script( 'jquery-labelauty', get_template_directory_uri() . '/js/jquery-labelauty.min.js', array( 'jquery', ), '1.1', true );
		wp_enqueue_script( $this->get_prefix() . 'script', get_template_directory_uri() . '/js/artwork.min.js', array(
			'jquery',
			'superfish',
			'jquery-labelauty',
			'jquery-infinitescroll'
		), $this->get_theme_version(), true );

		$translation_array = array(
			'url' => get_template_directory_uri()
		);
		wp_localize_script( $this->get_prefix() . 'script', 'template_directory_uri', $translation_array );

		/*
		 * Loads Artwork Styles
		 */
		wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css', array( 'bootstrap' ), '4.3.0', 'all' );
		wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), '3.3.5', 'all' );
		wp_enqueue_style( $this->get_prefix() . 'main', get_template_directory_uri() . '/css/artwork-style.min.css', array(
			'bootstrap',
			'font-awesome'
		), $this->get_theme_version(), 'all' );

		if ( is_plugin_active( 'motopress-content-editor/motopress-content-editor.php' ) || is_plugin_active( 'motopress-content-editor-lite/motopress-content-editor.php' ) ) {
			wp_enqueue_style( $this->get_prefix() . 'motopress', get_template_directory_uri() . '/css/artwork-motopress.min.css', array(
				'bootstrap',
				'font-awesome',
				$this->get_prefix() . 'main'
			), $this->get_theme_version(), 'all' );
		}

		if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
			wp_enqueue_style( $this->get_prefix() . 'woocommerce', get_template_directory_uri() . '/css/artwork-woocommerce.min.css', array(
				'bootstrap',
				'font-awesome',
				$this->get_prefix() . 'main'
			), $this->get_theme_version(), 'all' );
		}

		if ( is_plugin_active( 'bbpress/bbpress.php' ) ) {
			wp_enqueue_style( $this->get_prefix() . 'bbpress', get_template_directory_uri() . '/css/artwork-bbpress.min.css', array(
				'bootstrap',
				'font-awesome',
				$this->get_prefix() . 'main'
			), $this->get_theme_version(), 'all' );
		}
		if ( is_rtl() ) {
			wp_enqueue_style( $this->get_prefix() . 'rtl', get_template_directory_uri() . '/css/artwork-rtl.min.css', array(
				'bootstrap',
				'font-awesome',
				$this->get_prefix() . 'main'
			), $this->get_theme_version(), 'all' );
		}
		/*
		 *  Loads our main stylesheet.
		 */
		wp_enqueue_style( $this->get_prefix() . 'style', get_stylesheet_uri(), array(), $this->get_theme_version() );
	}

	/**
	 * Register widget areas.
	 *
	 * @since Artwork 1.0
	 * @access public
	 * @return void
	 */
	function widgets_init() {
		register_sidebar( array(
			'name'          => __( 'Main Widget Area', 'artwork-lite' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Appears on posts and pages in the sidebar.', 'artwork-lite' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );
		if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
			register_sidebar( array(
				'name'          => __( 'Shop Widget Area', 'artwork-lite' ),
				'id'            => 'sidebar-shop',
				'description'   => __( 'Appears on shop pages in the sidebar.', 'artwork-lite' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			) );
		}
		register_sidebar( array(
			'name'          => __( 'Footer Left', 'artwork-lite' ),
			'id'            => 'sidebar-2',
			'description'   => __( 'Appears in the footer section of the site.', 'artwork-lite' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="footer-title">',
			'after_title'   => '</div>',
		) );

		register_sidebar( array(
			'name'          => __( 'Footer Center', 'artwork-lite' ),
			'id'            => 'sidebar-3',
			'description'   => __( 'Appears in the footer section of the site.', 'artwork-lite' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="footer-title">',
			'after_title'   => '</div>',
		) );

		register_sidebar( array(
			'name'          => __( 'Footer Right', 'artwork-lite' ),
			'id'            => 'sidebar-4',
			'description'   => __( 'Appears in the footer section of the site.', 'artwork-lite' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<div class="footer-title">',
			'after_title'   => '</div>',
		) );
	}

	/*
	 * The experts length
	 */

	function excerpt_length( $length ) {
		return 13;
	}

	/*
	 * Declare WooCommerce support
	 */

	function woocommerce_support() {
		add_theme_support( 'woocommerce' );
	}

	/**
	 * Artwork page menu.
	 *
	 * Show pages of site.
	 *
	 * @since artwork 1.0
	 */
	function page_menu() {
		echo '<ul class="sf-menu">';
		wp_list_pages( array( 'title_li' => '', 'depth' => 1 ) );
		echo '</ul>';
	}

	/**
	 * Require files.
	 *
	 * @since Artwork 1.0
	 * @access public
	 * @return void
	 */
	function theme_requires() {
		/**
		 * Add support for a custom header image.
		 */
		require get_template_directory() . '/inc/custom-header.php';
		new MP_Artwork_Custom_Header( $this->prefix );
		/*
		 * Customizer
		 */
		require get_template_directory() . '/inc/admin/customize.php';
		new MP_Artwork_Customizer( $this->prefix );

		/*
		 * Artwork only works in WordPress 3.6 or later.
		 */
		if ( version_compare( $GLOBALS['wp_version'], '3.6-alpha', '<' ) ):
			require get_template_directory() . '/inc/back-compat.php';
		endif;
		/*
		 *  Post related posts
		 */
		require get_template_directory() . '/inc/theme/post-related.php';
		/*
		 * Post gallery
		 */
		require get_template_directory() . '/inc/theme/post-gallery.php';

		/*
		 * Post thumbnail
		 */
		require get_template_directory() . '/inc/theme/post-thumbnail.php';
		/*
		 * Init woocommerce
		 */

		if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
			require get_template_directory() . '/inc/woocommerce/woo-init.php';
		}
		/*
		 * Init motopress
		 */
		if ( is_plugin_active( 'motopress-content-editor/motopress-content-editor.php' ) || is_plugin_active( 'motopress-content-editor-lite/motopress-content-editor.php' ) ) {
			require get_template_directory() . '/inc/motopress/motopress-init.php';
			new MP_Artwork_MP_Motopress_Init( $this->get_prefix() );
		}
		/*
			 * Init  mp-restaurant-menu
			 */

		if ( is_plugin_active( 'mp-restaurant-menu/restaurant-menu.php' ) ) {
			require get_template_directory() . '/inc/mp-restaurant-menu/mp-restaurant-menu-init.php';
		}
		/*
		 * Init  mp-timetable
		 */

		if ( is_plugin_active( 'mp-timetable/mp-timetable.php' ) ) {
			require get_template_directory() . '/inc/mp-timetable/mp-timetable-init.php';
		}

		if ( current_user_can( 'install_plugins' ) ) {
			require get_template_directory() . '/inc/theme/tgm-init.php';
		}
		
	}

	function audio_short_fix( $html, $atts, $audio, $post_id, $library ) {
		$html = str_replace( 'visibility: hidden;', '', $html );

		return $html;
	}

	/**
	 * Get theme vertion.
	 *
	 * @since Atrwork 1.1.2
	 * @access public
	 * @return string
	 */
	function get_theme_version() {
		$theme_info = wp_get_theme( get_template() );

		return $theme_info->get( 'Version' );
	}

	function generate_editor_font_style(){

		$font_family = get_theme_mod( $this->get_prefix() . "text_font_family", false );

		if (!$font_family) {
			return;
		}

		$css = <<<CSS
		.editor-styles-wrapper{
			font-family: {$font_family} !important;
		}
CSS;
		wp_register_style( 'artwork-editor-font', false );
		wp_enqueue_style( 'artwork-editor-font' );
		wp_add_inline_style( 'artwork-editor-font', $css );

	}
}

new MP_Artwork();
