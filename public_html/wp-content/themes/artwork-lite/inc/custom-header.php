<?php

/**
 * Implement a custom header for Artwork
 *
 * @link https://codex.wordpress.org/Custom_Headers
 *
 * @package WordPress
 * @subpackage Artwork
 * @since Artwork 1.0
 */
class MP_Artwork_Custom_Header {

	private $prefix;

	public function __construct( $prefix ) {
		$this->prefix = $prefix;
		add_action( 'after_setup_theme', array( $this, 'custom_header_setup' ), 11 );
	}

	/**
	 * Get prefix.
	 *
	 * @access public
	 * @return sting
	 */
	public function get_prefix() {
		return $this->prefix . '_';
	}

	/**
	 * Set up the WordPress core custom header arguments and settings.
	 *
	 * @uses add_theme_support() to register support for 3.4 and up.
	 * @uses theme_header_style() to style front-end.
	 *
	 * @since Artwork 1.0
	 */
	function custom_header_setup() {
		$args = array(
			// Text color and image (empty to use none).
			'default-text-color'     => '#676767',
			// Callbacks for styling the header and the admin preview.
			'wp-head-callback'       => array( $this, 'header_style' ),
			'admin-head-callback'    => array( $this, 'header_style' ),
			'admin-preview-callback' => array( $this, 'header_style' ),
		);

		add_theme_support( 'custom-header', $args );
		$args_bg = array(
			'default-color' => 'ffffff',
		);
		add_theme_support( 'custom-background', $args_bg );
		add_theme_support( 'custom-logo', array(
			/*'height'      => 160,
			'width'       => 135,*/
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		) );
	}

	/**
	 * Style the header text displayed on the blog.
	 *
	 * get_header_textcolor() options: Hide text (returns 'blank'), or any hex value.
	 *
	 * @since Artwork 1.0
	 */
	function header_style() {
		$header_text_color     = get_header_textcolor();
		$color_text            = get_option( $this->get_prefix() . 'color_text' );
		$brand_color           = get_option( $this->get_prefix() . 'color_primary' );
		$section_color_primary = get_option( $this->get_prefix() . 'section_color_primary' );
		$second_brand_color    = get_option( $this->get_prefix() . 'color_second' );
		$third_brand_color     = get_option( $this->get_prefix() . 'color_third' );
		$fourth_brand_color    = get_option( $this->get_prefix() . 'color_fourth' );
		$font_family       = esc_html( get_theme_mod( $this->get_prefix() . "title_font_family", "Niconne" ) );
		$font_weight_style = esc_html( get_theme_mod( $this->get_prefix() . "title_font_weight" ) );
		$font_weight       = preg_replace( "/[^0-9?! ]/", "", $font_weight_style );
		$font_style        = preg_replace( "/[^A-Za-z?! ]/", "", $font_weight_style );
		$font_size         = esc_html( get_theme_mod( $this->get_prefix() . "title_font_size", "90px" ) );
		if ( $font_style == "" ) {
			$font_style = "normal";
		}
		if ( $font_weight == "" ) {
			$font_weight = "400";
		}
		if ( strcasecmp( $font_family, "Niconne" ) != 0 ) {
			?>
			<link id='theme-title-font-family' href="https://fonts.googleapis.com/css?family=<?php echo esc_html(str_replace( " ", "+", $font_family )) . ":" . esc_html($font_weight_style) . esc_html( $font_weight_style != '400' ? ',400' : '' ); ?>" rel='stylesheet' type='text/css'> <?php // phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedStylesheet?>
			<?php
		}
		$font_family_text       = esc_html( get_theme_mod( $this->get_prefix() . "text_font_family", "Josefin Sans" ) );
		$font_weight_style_text = esc_html( get_theme_mod( $this->get_prefix() . "text_font_weight", "400" ) );
		$font_weight_text       = preg_replace( "/[^0-9?! ]/", "", $font_weight_style_text );
		$font_style_text        = preg_replace( "/[^A-Za-z?! ]/", "", $font_weight_style_text );
		if ( $font_style_text == "" ) {
			$font_style_text = "normal";
		}
		if ( $font_weight_text == "" ) {
			$font_weight_text = "400";
		}
		$font_size_text = esc_html( get_theme_mod( $this->get_prefix() . "text_font_size", "16px" ) );
		if ( strcasecmp( $font_family_text, "Josefin Sans" ) != 0 ) {
			?>
			<link id='theme-text-font-family' href="https://fonts.googleapis.com/css?family=<?php echo esc_html(str_replace( " ", "+", $font_family_text )) . ":" . esc_html($font_weight_style_text) . esc_html( $font_weight_style_text != '400' ? ',400' : '' ); ?>" rel='stylesheet' type='text/css'> <?php // phpcs:ignore WordPress.WP.EnqueuedResources.NonEnqueuedStylesheet?>
			<?php
		}
		$tagline_font = esc_html( get_theme_mod( $this->get_prefix() . "tagline_font", 0 ) );
		$logo_border  = esc_html( get_theme_mod( $this->get_prefix() . "logo_border", 1 ) );
		?>
		<style type="text/css" id="theme-header-css">
			<?php if (strcasecmp($logo_border, "1") != 0) { ?>
				.site-header .site-description {
					border: 0px solid;
				}
			<?php } ?>
			<?php if (!get_bloginfo('description')) : ?>
				.site-footer .site-description {
					margin: 0;
				}
			<?php endif; ?>
			<?php if (strcasecmp($tagline_font, "0") != 0) { ?>
				.site-tagline {
					font-family: <?php echo esc_attr($font_family); ?>;
					font-weight: <?php echo esc_attr($font_weight); ?>;
					font-style: <?php echo esc_attr($font_style); ?>;
				}
			<?php } ?>

			.site-wrapper {
				font-family: <?php echo esc_attr($font_family_text); ?>;
				font-size: <?php echo esc_attr($font_size_text); ?>;
				font-weight: <?php echo esc_attr($font_weight_text); ?>;
				font-style: <?php echo esc_attr($font_style_text); ?>
			}
			.site-header .site-title,
			.site-footer .site-title {
				font-family: <?php echo esc_attr($font_family); ?>;
				font-weight: <?php echo esc_attr($font_weight); ?>;
				font-style: <?php echo esc_attr($font_style); ?>;
			}
			.site-header .site-title {
				font-size: <?php echo esc_attr($font_size); ?>;
			}

			<?php if ($header_text_color != '676767' && $header_text_color != ''){ ?>
				.sf-menu ul,
				.site-header .site-tagline,
				.sf-menu > li > a {
					color: #<?php echo esc_attr($header_text_color); ?>;
				}
			<?php } ?>

			<?php if ($color_text != MP_ARTWORK_TEXT_COLOR && $color_text != '') { ?>
				body,
				.site-footer .site-tagline,
				.form-control,
				input[type="text"],
				input[type="url"],
				input[type="email"],
				input[type="number"],
				input[type="password"],
				input[type="search"],
				input[type="tel"],
				select,
				textarea,
				.work-post.format-link .entry-header a:after {
					color: <?php echo esc_attr($color_text); ?>;
				}

				.form-control,
				input[type="text"],
				input[type="url"],
				input[type="email"],
				input[type="number"],
				input[type="password"],
				input[type="search"],
				input[type="tel"],
				textarea,
				.form-control:focus {
					border-color: <?php echo esc_attr($color_text); ?>;
				}

				.radio-labelauty + label > span.labelauty-checked-image:before {
					background: <?php echo esc_attr($color_text); ?>;
				}
			<?php } ?>
			<?php if ($brand_color != MP_ARTWORK_BRAND_COLOR && $brand_color != '') { ?>
				a:hover,
				a:focus,
				.site-footer a:hover,
				.site-footer a:focus,
				blockquote:before,
				.brand-color {
					color: <?php echo esc_attr($brand_color); ?>;
				}

				.button:hover, .button:focus, button:hover, button:focus, input[type="button"]:hover, input[type="button"]:focus, input[type="submit"]:hover, input[type="submit"]:focus {
					background: <?php echo esc_attr($brand_color); ?>;
				}

				blockquote {
					border-color: <?php echo esc_attr($brand_color); ?>;
				}
				<?php if (is_plugin_active('motopress-content-editor/motopress-content-editor.php') || is_plugin_active('motopress-content-editor-lite/motopress-content-editor.php')) { ?>
					.artwork .motopress-cta-obj .motopress-button-wrap .mp-theme-button-white:hover, .artwork .motopress-cta-obj .motopress-button-wrap .mp-theme-button-white:focus,
					.mp-theme-icon-brand, .motopress-ce-icon-obj.mp-theme-icon-bg-brand .motopress-ce-icon-preview,
					.motopress-list-obj .motopress-list-type-icon .fa,
					.artwork .motopress-button-obj .mp-theme-button-white:hover, .artwork .motopress-button-obj .mp-theme-button-white:focus, .artwork .motopress-modal-obj .mp-theme-button-white:hover, .artwork .motopress-modal-obj .mp-theme-button-white:focus, .artwork .motopress-download-button-obj .mp-theme-button-white:hover, .artwork .motopress-download-button-obj .mp-theme-button-white:focus, .artwork .motopress-button-group-obj .mp-theme-button-white:hover, .artwork .motopress-button-group-obj .mp-theme-button-white:focus,
					.motopress-ce-icon-obj.mp-theme-icon-bg-brand.motopress-ce-icon-shape-outline-rounded .motopress-ce-icon-bg .motopress-ce-icon-preview, .motopress-ce-icon-obj.mp-theme-icon-bg-brand.motopress-ce-icon-shape-outline-circle .motopress-ce-icon-bg .motopress-ce-icon-preview, .motopress-ce-icon-obj.mp-theme-icon-bg-brand.motopress-ce-icon-shape-outline-square .motopress-ce-icon-bg .motopress-ce-icon-preview {
						color: <?php echo esc_attr($brand_color); ?>;
					}

					.motopress-countdown_timer.mp-theme-countdown-timer-brand .countdown-section,
					.motopress-cta-style-brand,
					.motopress-accordion-obj.ui-accordion.mp-theme-accordion-brand .ui-accordion-header .ui-icon,
					.motopress-service-box-obj.motopress-service-box-brand .motopress-service-box-icon-holder-rounded, .motopress-service-box-obj.motopress-service-box-brand .motopress-service-box-icon-holder-square, .motopress-service-box-obj.motopress-service-box-brand .motopress-service-box-icon-holder-circle,
					.artwork .motopress-service-box-obj .motopress-service-box-button-section .mp-theme-button-brand:hover, .artwork .motopress-service-box-obj .motopress-service-box-button-section .mp-theme-button-brand:focus, .artwork .motopress-button-group-obj .mp-theme-button-brand:hover, .artwork .motopress-button-group-obj .mp-theme-button-brand:focus, .artwork .motopress-button-obj .mp-theme-button-brand:hover, .artwork .motopress-button-obj .mp-theme-button-brand:focus, .artwork .motopress-modal-obj .mp-theme-button-brand:hover, .artwork .motopress-modal-obj .mp-theme-button-brand:focus, .artwork .motopress-download-button-obj .mp-theme-button-brand:hover, .artwork .motopress-download-button-obj .mp-theme-button-brand:focus,
					.motopress-ce-icon-obj.mp-theme-icon-bg-brand.motopress-ce-icon-shape-rounded .motopress-ce-icon-bg, .motopress-ce-icon-obj.mp-theme-icon-bg-brand.motopress-ce-icon-shape-square .motopress-ce-icon-bg, .motopress-ce-icon-obj.mp-theme-icon-bg-brand.motopress-ce-icon-shape-circle .motopress-ce-icon-bg {
						background: <?php echo esc_attr($brand_color); ?>;
					}

					.artwork .motopress-button-obj .mp-theme-button-white:hover, .artwork .motopress-button-obj .mp-theme-button-white:focus, .artwork .motopress-modal-obj .mp-theme-button-white:hover, .artwork .motopress-modal-obj .mp-theme-button-white:focus, .artwork .motopress-download-button-obj .mp-theme-button-white:hover, .artwork .motopress-download-button-obj .mp-theme-button-white:focus, .artwork .motopress-button-group-obj .mp-theme-button-white:hover, .artwork .motopress-button-group-obj .mp-theme-button-white:focus,
					.motopress-ce-icon-obj.mp-theme-icon-bg-brand.motopress-ce-icon-shape-outline-rounded .motopress-ce-icon-bg, .motopress-ce-icon-obj.mp-theme-icon-bg-brand.motopress-ce-icon-shape-outline-circle .motopress-ce-icon-bg, .motopress-ce-icon-obj.mp-theme-icon-bg-brand.motopress-ce-icon-shape-outline-square .motopress-ce-icon-bg {
						border-color: <?php echo esc_attr($brand_color); ?>;
					}

					.artwork .motopress-tabs-obj.ui-tabs.motopress-tabs-vertical .ui-tabs-nav li.ui-state-active a, .artwork .motopress-tabs-obj.ui-tabs.motopress-tabs-no-vertical .ui-tabs-nav li.ui-state-active a {
						border-color: <?php echo esc_attr($brand_color); ?> !important;
						color: <?php echo esc_attr($brand_color); ?> !important;
					}
				<?php } ?>
				<?php if (is_plugin_active('woocommerce/woocommerce.php')) { ?>
					.woocommerce-pagination a:hover, .woocommerce-pagination span, .woocommerce-pagination a.page-numbers:hover, .woocommerce-pagination .page-numbers.current,
					.woocommerce span.onsale {
						background: <?php echo esc_attr($brand_color); ?>;
					}

					.widget.widget_product_search .woocommerce-product-search:before,
					.woocommerce p.stars a.active:after, .woocommerce p.stars a:hover:after,
					.single-product ol.commentlist time,
					.woocommerce .star-rating span {
						color: <?php echo esc_attr($brand_color); ?>;
					}

					.woocommerce .woocommerce-message, .woocommerce .woocommerce-info,
					.wc-tabs li.active a {
						border-color: <?php echo esc_attr($brand_color); ?>;
					}
				<?php } ?>
				<?php if (is_plugin_active('bbpress/bbpress.php')) { ?>
					#bbp-search-form:before {
						color: <?php echo esc_attr($brand_color); ?>;
					}
				<?php } ?>
			<?php } ?>

			<?php if ($second_brand_color != MP_ARTWORK_SECOND_BRAND_COLOR && $second_brand_color != '') { ?>
				.page-wrapper,
				.two-col-works .work-element {
					background-color: <?php echo esc_attr($second_brand_color); ?>;
				}
			<?php } ?>

			<?php if ($section_color_primary != MP_ARTWORK_BRAND_COLOR && $section_color_primary != '') { ?>
				.two-col-works .work-element:nth-child(4n+2),
				.page-wrapper:nth-child(4n+2) {
					background-color: <?php echo esc_attr($section_color_primary); ?>;
				}
			<?php }
			 if ($third_brand_color != MP_ARTWORK_THIRD_BRAND_COLOR && $third_brand_color != '') :?>
				.two-col-works .work-element:nth-child(4n+3),
				.page-wrapper:nth-child(4n+3) {
					background-color: <?php echo esc_attr($third_brand_color); ?>;
				}
			<?php endif; ?>
			<?php if ($fourth_brand_color != MP_ARTWORK_FOURTH_BRAND_COLOR && $fourth_brand_color != '') : ?>
				.two-col-works .work-element:nth-child(4n+4),
				.page-wrapper:nth-child(4n+4) {
					background-color: <?php echo esc_attr($fourth_brand_color); ?>;
				}
			<?php endif; ?>
		</style>
		<?php
	}

}
