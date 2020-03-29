<?php
/**
 * Script Class
 *
 * Handles the script and style functionality of plugin
 *
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class WP_spaios_Script {

	function __construct() {

		// Action to add style at front side
		add_action( 'wp_enqueue_scripts', array($this, 'wp_spaios_front_style') );

		// Action to add script at front side
		add_action( 'wp_enqueue_scripts', array($this, 'wp_spaios_front_script') );

		// Action to add style in backend
		add_action( 'admin_enqueue_scripts', array($this, 'wp_spaios_admin_style') );

		// Action to add script at admin side
		add_action( 'admin_enqueue_scripts', array($this, 'wp_spaios_admin_script') );
	}

	/**
	 * Function to add style at front side
	 * 
	 * @package SlidersPack - All In One Image Sliders
	 * @since 1.0
	 */
	function wp_spaios_front_style() {

		// Registring and enqueing swiper-style css
		if( !wp_style_is( 'wpos-swiper-style', 'registered' ) ) {
			wp_register_style( 'wpos-swiper-style', WP_APAIOIS_URL.'assets/css/swiper.min.css', array(), WP_APAIOIS_VERSION );
		}

		// Registring and enqueing flexslider css
		wp_register_style( 'wpos-flexslider-style', WP_APAIOIS_URL.'assets/css/flexslider.css', array(), WP_APAIOIS_VERSION );

		// Registring and enqueing jquery.bxslider css
		wp_register_style( 'wpos-bxslider-style', WP_APAIOIS_URL.'assets/css/jquery.bxslider.css', array(), WP_APAIOIS_VERSION );

		// Registring and enqueing nivoslider css
		wp_register_style( 'wpos-nivoslider-style', WP_APAIOIS_URL.'assets/css/nivo-slider.css', array(), WP_APAIOIS_VERSION );

		// Registring and enqueing owlcarousel css
		wp_register_style( 'wpos-owlcarousel-style', WP_APAIOIS_URL.'assets/css/owl.carousel.css', array(), WP_APAIOIS_VERSION );

		// Registring and enqueing polaroids-gallery css
		wp_register_style( 'wpos-polaroids-gallery-style', WP_APAIOIS_URL.'assets/css/polaroids-gallery.css', array(), WP_APAIOIS_VERSION );

		// Registring and enqueing slidesjs css	
		wp_register_style( 'wpos-slidesjs-style', WP_APAIOIS_URL.'assets/css/slidesjs.css', array(), WP_APAIOIS_VERSION );

		// Registring and enqueing unslider-slider css
		wp_register_style( 'wpos-unslider-style', WP_APAIOIS_URL.'assets/css/unslider.css', array(), WP_APAIOIS_VERSION );

		// Registring and enqueing wlop-slider css
		wp_register_style( 'wpos-wallop-style', WP_APAIOIS_URL.'assets/css/wallop.css', array(), WP_APAIOIS_VERSION );

		// Registring and enqueing public css
		wp_register_style( 'wp-spaios-public-css', WP_APAIOIS_URL.'assets/css/wp-spaios-public.css', null, WP_APAIOIS_VERSION );
		wp_enqueue_style( 'wp-spaios-public-css' );

		wp_register_style( 'wp-fancybox-public-css', WP_APAIOIS_URL.'assets/css/jquery.fancybox.min.css', null, WP_APAIOIS_VERSION );

	}

	/**
	 * Function to add script at front side
	 * 
	 * @package SlidersPack - All In One Image Sliders
	 * @since 1.0
	 */
	function wp_spaios_front_script() {

		if( !wp_script_is( 'wpos-swiper-jquery', 'registered' ) ) {
			wp_register_script( 'wpos-swiper-jquery', WP_APAIOIS_URL.'assets/js/swiper/swiper.min.js', array('jquery'), WP_APAIOIS_VERSION, true );
		}
		wp_register_script( 'wp-3d-public', WP_APAIOIS_URL.'assets/js/swiper/wp-swiper-public.js', array('jquery'), WP_APAIOIS_VERSION, true );	
		wp_register_script( 'wp-swiper-public', WP_APAIOIS_URL.'assets/js/swiper/wp-swiper-slider-public.js', array('jquery'), WP_APAIOIS_VERSION, true );

		wp_register_script( 'wpos-bxslider-jquery', WP_APAIOIS_URL.'assets/js/bxslider/jquery.bxslider.js', array('jquery'), WP_APAIOIS_VERSION, true );
		wp_register_script( 'wpos-bxslider-public', WP_APAIOIS_URL.'assets/js/bxslider/wpos-bxslider-public.js', array('jquery'), WP_APAIOIS_VERSION, true );

		wp_register_script( 'wpos-flexslider-jquery', WP_APAIOIS_URL.'assets/js/flexslider/jquery.flexslider-min.js', array('jquery'), WP_APAIOIS_VERSION, true );
		wp_register_script( 'wpos-flexslider-public', WP_APAIOIS_URL.'assets/js/flexslider/wpos-flexslider-public.js', array('jquery'), WP_APAIOIS_VERSION, true );

		wp_register_script( 'wpos-nivo-slider-jquery', WP_APAIOIS_URL.'assets/js/nivo-slider/jquery.nivo.slider.pack.js', array('jquery'), WP_APAIOIS_VERSION, true );
		wp_register_script( 'wpos-nivo-public', WP_APAIOIS_URL.'assets/js/nivo-slider/wpos-nivo-public.js', array('jquery'), WP_APAIOIS_VERSION, true );

		wp_register_script( 'wpos-owl-slider-jquery', WP_APAIOIS_URL.'assets/js/owl-slider/owl.carousel.min.js', array('jquery'), WP_APAIOIS_VERSION, true );
		wp_register_script( 'wpos-owl-slider-public', WP_APAIOIS_URL.'assets/js/owl-slider/wpos-owl-slider-public.js', array('jquery'), WP_APAIOIS_VERSION, true );

		wp_register_script( 'wpos-classie-jquery', WP_APAIOIS_URL.'assets/js/polaroids-gallery/classie.js', array('jquery'), WP_APAIOIS_VERSION, true );
		wp_register_script( 'wpos-modernizr-jquery', WP_APAIOIS_URL.'assets/js/polaroids-gallery/modernizr.min.js', array('jquery'), WP_APAIOIS_VERSION, true );
		wp_register_script( 'wpos-polaroids-gallery-jquery', WP_APAIOIS_URL.'assets/js/polaroids-gallery/photostack.js', array('jquery'), WP_APAIOIS_VERSION, true );
		wp_register_script( 'wpos-polaroids-gallery-public', WP_APAIOIS_URL.'assets/js/polaroids-gallery/wpos-polaroids-gallery-public.js', array('jquery'), WP_APAIOIS_VERSION, true );

		wp_register_script( 'wpos-slidesjs-jquery', WP_APAIOIS_URL.'assets/js/slidesjs/jquery.slides.min.js', array('jquery'), WP_APAIOIS_VERSION, true );
		wp_register_script( 'wpos-slides-public', WP_APAIOIS_URL.'assets/js/slidesjs/wpos-slides-public.js', array('jquery'), WP_APAIOIS_VERSION, true );

		wp_register_script( 'wpos-unslider-jquery', WP_APAIOIS_URL.'assets/js/unslider/unslider.js', array('jquery'), WP_APAIOIS_VERSION, true );
		wp_register_script( 'wpos-unslider-public', WP_APAIOIS_URL.'assets/js/unslider/wpos-unslider-public.js', array('jquery'), WP_APAIOIS_VERSION, true );

		wp_register_script( 'wpos-wallop-slider-jquery', WP_APAIOIS_URL.'assets/js/wallop-slider/wallop.min.js', array('jquery'), WP_APAIOIS_VERSION, true );
		wp_register_script( 'wpos-wallop-public', WP_APAIOIS_URL.'assets/js/wallop-slider/wpos-wallop-public.js', array('jquery'), WP_APAIOIS_VERSION, true );

		// Registring fancybox script
		wp_register_script( 'wp-fancybox-public-js', WP_APAIOIS_URL.'assets/js/jquery.fancybox.min.js', array('jquery'), WP_APAIOIS_VERSION, true );

	}
	
	/**
	 * Enqueue admin styles
	 * 
	 * @package SlidersPack - All In One Image Sliders
	 * @since 1.0
	 */
	function wp_spaios_admin_style( $hook ) {

		global $post_type, $typenow;

		$registered_posts = array(WP_APAIOIS_POST_TYPE, 'wpspaios_slider_page_welcome_sliderspack'); // Getting registered post types

		// If page is plugin setting page then enqueue script
		if( in_array($post_type, $registered_posts) || in_array($hook, $registered_posts) ) {

			// Registring admin script
			wp_register_style( 'wp-spaios-admin-style', WP_APAIOIS_URL.'assets/css/wp-spaios-admin.css', null, WP_APAIOIS_VERSION );
			wp_enqueue_style( 'wp-spaios-admin-style' );
		}
	}

	/**
	 * Function to add script at admin side
	 * 
	 * @package SlidersPack - All In One Image Sliders
	 * @since 1.0
	 */
	function wp_spaios_admin_script( $hook ) {

		global $wp_version, $wp_query, $typenow, $post_type;

		$registered_posts = array(WP_APAIOIS_POST_TYPE); // Getting registered post types
		$new_ui = $wp_version >= '3.5' ? '1' : '0'; // Check wordpress version for older scripts

		if( in_array($post_type, $registered_posts) ) {

			// Enqueue required inbuilt sctipt
			wp_enqueue_script( 'jquery-ui-sortable' );

			// Registring admin script
			wp_register_script( 'wp-spaios-admin-script', WP_APAIOIS_URL.'assets/js/wp-spaios-admin.js', array('jquery'), WP_APAIOIS_VERSION, true );
			wp_localize_script( 'wp-spaios-admin-script', 'WpSpaiosAdmin', array(
																	'new_ui' 				=>	$new_ui,
																	'img_edit_popup_text'	=> __('Edit Image in Popup', 'sliderspack-all-in-one-image-sliders'),
																	'attachment_edit_text'	=> __('Edit Image', 'sliderspack-all-in-one-image-sliders'),
																	'img_delete_text'		=> __('Remove Image', 'sliderspack-all-in-one-image-sliders'),
																));
			wp_enqueue_script( 'wp-spaios-admin-script' );
			wp_enqueue_media(); // For media uploader
		}
	}
}

$wp_spaios_script = new WP_spaios_Script();