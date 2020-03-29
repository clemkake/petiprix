<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; }  // if direct access.

/**
 * Scripts and styles
 */
class SP_WPSPRO_Front_Scripts {

	/**
	 * @var null
	 * @since 2.4
	 */
	protected static $_instance = null;

	/**
	 * @return SP_WPSPRO_Front_Scripts
	 * @since 2.4
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Initialize the class
	 */
	public function __construct() {

		add_action( 'wp_enqueue_scripts', array( $this, 'front_scripts' ) );
	}

	/**
	 * Plugin Scripts and Styles
	 */
	function front_scripts() {
		$wpsp_font_awesome       = ( sp_get_option( 'wpsp_font_awesome' ) == true ? 'true' : 'false' );
		$wpsp_slick_css          = ( sp_get_option( 'wpsp_slick_css' ) == true ? 'true' : 'false' );
		$wpsp_magnific_popup_css = ( sp_get_option( 'wpsp_magnific_popup_css' ) == true ? 'true' : 'false' );
		$wpsp_slick_js           = ( sp_get_option( 'wpsp_slick_js' ) == true ? 'true' : 'false' );
		$wpsp_magnific_popup_js  = ( sp_get_option( 'wpsp_magnific_popup_js' ) == true ? 'true' : 'false' );

		// CSS Files.
		if ( 'false' == $wpsp_slick_css ) {
			wp_register_style( 'sp-wpsp-slick', SP_WPSPRO_URL . 'public/assets/css/slick.min.css', array(), SP_WPSPRO_VERSION );
		}
		if ( 'false' == $wpsp_font_awesome ) {
			wp_register_style( 'sp-wpsp-font-awesome', SP_WPSPRO_URL . 'public/assets/css/font-awesome.min.css', array(), SP_WPSPRO_VERSION );
		}
		if ( 'false' == $wpsp_magnific_popup_css ) {
			wp_register_style( 'sp-wpsp-magnific-popup', SP_WPSPRO_URL . 'public/assets/css/magnific-popup.min.css', array(), SP_WPSPRO_VERSION );
		}
		wp_enqueue_style( 'sp-wpsp-custom', SP_WPSPRO_URL . 'public/assets/css/custom.min.css', array(), SP_WPSPRO_VERSION );
		wp_enqueue_style( 'sp-wpsp-style', SP_WPSPRO_URL . 'public/assets/css/style.min.css', array(), SP_WPSPRO_VERSION );

		include SP_WPSPRO_PATH . '/includes/custom-css.php';
		wp_add_inline_style( 'sp-wpsp-custom', $custom_css );

		// JS Files.
		if ( 'false' == $wpsp_slick_js ) {
			wp_register_script( 'sp-wpsp-slick-min-js', SP_WPSPRO_URL . 'public/assets/js/slick.min.js', array( 'jquery' ), SP_WPSPRO_VERSION, true );
		}
		if ( 'false' == $wpsp_magnific_popup_js ) {
			wp_register_script( 'sp-wpsp-magnific-popup-min-js', SP_WPSPRO_URL . 'public/assets/js/jquery.magnific-popup.min.js', array( 'jquery' ), SP_WPSPRO_VERSION, true );
		}
		wp_register_script( 'sp-wpsp-infinite-scroll-js', SP_WPSPRO_URL . 'public/assets/js/infinite-scroll.min.js', array( 'jquery' ), SP_WPSPRO_VERSION, true );
		wp_enqueue_script( 'jquery-masonry' );
		wp_enqueue_script( 'sp-wpsp-scripts-js', SP_WPSPRO_URL . 'public/assets/js/scripts.min.js', array( 'jquery' ), SP_WPSPRO_VERSION, true );

	}

}
new SP_WPSPRO_Front_Scripts();
