<?php
/*
Plugin Name: PickPlugins Product Slider for WooCommerce
Plugin URI: http://pickplugins.com/items/woocommerce-product-slider-for-wordpress/
Description: Fully responsive and mobile ready Carousel Slider for your WooCommerce product. unlimited slider anywhere via short-codes and easy admin setting.
Version: 1.12.23
WC requires at least: 3.0.0
WC tested up to: 3.7
Author: PickPlugins
Text Domain: woocommerce-products-slider
Author URI: http://pickplugins.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined('ABSPATH')) exit;  // if direct access


class WoocommerceProductsSlider{

	public function __construct(){

		define('wcps_plugin_url', plugins_url('/', __FILE__)  );
		define('wcps_plugin_dir', plugin_dir_path( __FILE__ ) );
		define('wcps_wp_url', 'https://wordpress.org/plugins/woocommerce-products-slider/' );
		define('wcps_plugin_name', 'PickPlugins Product Slider' );
        define('wcps_version', '1.12.23' );
        define('wcps_server_url', 'https://www.pickplugins.com' );
        define('wcps_plugin_basename', plugin_basename( __FILE__ ) );


        require_once( plugin_dir_path( __FILE__ ) . 'includes/wcps-meta-box.php');
		require_once( plugin_dir_path( __FILE__ ) . 'includes/functions/functions.php');
        require_once( plugin_dir_path( __FILE__ ) . 'includes/functions/functions-wcps-meta-box.php');
        require_once( plugin_dir_path( __FILE__ ) . 'includes/functions/functions-wcps-settings.php');

		require_once( plugin_dir_path( __FILE__ ) . 'includes/classes/class-functions.php');
		require_once( plugin_dir_path( __FILE__ ) . 'includes/classes/class-shortcodes.php');
		require_once( plugin_dir_path( __FILE__ ) . 'includes/classes/class-update.php');

        require_once( plugin_dir_path( __FILE__ ) . 'includes/classes/class-wcps-support.php');
        require_once( plugin_dir_path( __FILE__ ) . 'includes/classes/class-settings-tabs.php');


		// to work upload button
		add_action( 'admin_enqueue_scripts', 'wp_enqueue_media' );

		//short-code support into sidebar.
		add_filter('widget_text', 'do_shortcode');

		add_action( 'wp_enqueue_scripts', array( $this, 'wcps_front_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'wcps_admin_scripts' ) );

		add_action( 'plugins_loaded', array( $this, 'textdomain' ));


		register_activation_hook( __FILE__, array( $this, 'wcps_install' ) );
		register_deactivation_hook( __FILE__, array( $this, 'wcps_uninstall' ) );


		}



	public function textdomain() {
	  load_plugin_textdomain( 'woocommerce-products-slider', false, plugin_basename( dirname( __FILE__ ) ) . '/languages/' );
	}






	public function wcps_install(){


		do_action( 'wcps_action_install' );

		}

	public function wcps_uninstall(){

		do_action( 'wcps_action_uninstall' );
		}

	public function wcps_deactivation(){

		do_action( 'wcps_action_deactivation' );
		}

	public function wcps_front_scripts(){

		$wcps_load_script_pages = get_option('wcps_load_script_pages');

        wp_register_style('wcps-builder', wcps_plugin_url.'assets/front/css/wcps-builder.css');
        wp_register_script('wcps-builder', plugins_url( '/assets/front/js/wcps-builder.js' , __FILE__ ) , array( 'jquery' ));



        if(empty($wcps_load_script_pages)):

			wp_enqueue_script('jquery');
			wp_enqueue_script('wcps_js', plugins_url( '/assets/front/js/scripts.js' , __FILE__ ) , array( 'jquery' ));
			wp_localize_script('wcps_js', 'wcps_ajax', array( 'wcps_ajaxurl' => admin_url( 'admin-ajax.php')));

			wp_enqueue_style('wcps_style', wcps_plugin_url.'assets/front/css/style.css');
			wp_enqueue_style('wcps_style.themes', wcps_plugin_url.'assets/global/css/style.themes.css');
			wp_enqueue_style('font-awesome-4', wcps_plugin_url.'assets/global/css/font-awesome.css');
            wp_enqueue_style('fontawesome-5.min', wcps_plugin_url.'assets/global/css/fontawesome-5.min.css');

			wp_enqueue_script('owl.carousel.min', plugins_url( '/assets/front/js/owl.carousel.min.js' , __FILE__ ) , array( 'jquery' ));
			wp_enqueue_script('owl.rows.js', plugins_url( '/assets/front/js/owl.rows.js' , __FILE__ ) , array( 'jquery' ));

			wp_enqueue_style('owl.carousel', wcps_plugin_url.'assets/front/css/owl.carousel.css');
			wp_enqueue_style('animate', wcps_plugin_url.'assets/front/css/animate.css');

		else:

			$page_id = get_the_id();
			$wcps_load_script_pages = explode(',', $wcps_load_script_pages);

			if(in_array($page_id, $wcps_load_script_pages)):
				wp_enqueue_script('jquery');
				wp_enqueue_script('wcps_js', plugins_url( '/assets/front/js/scripts.js' , __FILE__ ) , array( 'jquery' ));
				wp_localize_script('wcps_js', 'wcps_ajax', array( 'wcps_ajaxurl' => admin_url( 'admin-ajax.php')));

				wp_enqueue_style('wcps_style', wcps_plugin_url.'assets/front/css/style.css');
				wp_enqueue_style('wcps_style.themes', wcps_plugin_url.'assets/global/css/style.themes.css');
				wp_enqueue_style('font-awesome-4', wcps_plugin_url.'assets/global/css/font-awesome.css');
                wp_enqueue_style('fontawesome-5.min', wcps_plugin_url.'assets/global/css/fontawesome-5.min.css');

				wp_enqueue_script('owl.carousel.min', plugins_url( '/assets/front/js/owl.carousel.min.js' , __FILE__ ) , array( 'jquery' ));
				wp_enqueue_script('owl.rows.js', plugins_url( '/assets/front/js/owl.rows.js' , __FILE__ ) , array( 'jquery' ));

				wp_enqueue_style('owl.carousel', wcps_plugin_url.'assets/front/css/owl.carousel.css');
				wp_enqueue_style('animate', wcps_plugin_url.'assets/front/css/animate.css');
			endif;

		endif;










		}

	public function wcps_admin_scripts(){

		wp_enqueue_script('jquery');
		wp_enqueue_script('wcps_admin_js', plugins_url( '/assets/admin/js/scripts.js' , __FILE__ ) , array( 'jquery' ));
		wp_localize_script('wcps_admin_js', 'wcps_ajax', array( 'wcps_ajaxurl' => admin_url( 'admin-ajax.php')));

		wp_enqueue_style('font-awesome-4', wcps_plugin_url.'assets/global/css/font-awesome.css');
        wp_enqueue_style('fontawesome-5.min', wcps_plugin_url.'assets/global/css/fontawesome-5.min.css');
		wp_enqueue_style('wcps_style', wcps_plugin_url.'assets/admin/css/style.css');



        wp_enqueue_script('codemirror', plugins_url( 'assets/admin/js/codemirror.js' , __FILE__ ) , array( 'jquery' ));
        wp_enqueue_style('codemirror', wcps_plugin_url.'assets/admin/css/codemirror.css');


        wp_enqueue_style('settings-tabs', wcps_plugin_url.'assets/admin/css/settings-tabs.css');
        wp_enqueue_script('settings-tabs', plugins_url( 'assets/admin/js/settings-tabs.js' , __FILE__ ) , array( 'jquery' ));


		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wcps_color_picker', plugins_url('assets/admin/js/color-picker.js', __FILE__ ), array( 'wp-color-picker' ), false, true );

		}

	}

	new WoocommerceProductsSlider();
