<?php
/**
 * Plugin Name:     Product Slider Pro for WooCommerce
 * Plugin URI:      https://shapedplugin.com/plugin/woocommerce-product-slider-pro
 * Description:     Slide your WooCommerce Products in a tidy and professional slider or carousel with an easy-to-use and intuitive Shortcode Generator. Highly customizable and No coding required!
 * Version:         2.5.4
 * Author:          ShapedPlugin
 * Author URI:      http://shapedplugin.com/
 * Text Domain:     woo-product-slider-pro
 * Domain Path:     /languages
 * WC requires at least: 2.6.0
 * WC tested up to: 3.8.0
 *
 * @package woo-product-slider-pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woo-product-slider-pro-activator.php
 */
function activate_woo_product_slider_pro() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-product-slider-pro-activator.php';
	Woo_Product_Slider_Pro_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woo-product-slider-pro-deactivator.php
 */
function deactivate_woo_product_slider_pro() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-product-slider-pro-deactivator.php';
	Woo_Product_Slider_Pro_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_woo_product_slider_pro' );
register_deactivation_hook( __FILE__, 'deactivate_woo_product_slider_pro' );

/**
 * The code that runs during plugin updates.
 * This action is documented in includes/class-woo-product-slider-pro-updates.php
 */
require_once plugin_dir_path( __FILE__ ) . 'includes/class-woo-product-slider-pro-updates.php';

if ( ! class_exists( 'SP_WooCommerce_Product_Slider_PRO' ) ) {
	/**
	 * Handles core plugin hooks and action setup.
	 *
	 * @package woo-product-slider-pro
	 * @since 2.4
	 */
	class SP_WooCommerce_Product_Slider_PRO {
		/**
		 * Plugin version
		 *
		 * @var string
		 */
		public $version = '2.5.4';

		/**
		 * WPSPRO_License Class
		 *
		 * @var WPSPRO_License $license
		 */
		public $license;

		/**
		 * WPSPRO_Help Class
		 *
		 * @var WPSPRO_Help $help
		 */
		public $help;

		/**
		 * WPSPRO_Shortcode Class
		 *
		 * @var WPSPRO_Shortcode $shortcode
		 */
		public $shortcode;

		/**
		 * WPSPRO_Router Class
		 *
		 * @var WPSPRO_Router $router
		 */
		public $router;

		/**
		 * WPSPRO_Check Class
		 *
		 * @var WPSPRO_Check $check
		 */
		public $check;

		/**
		 * @var null
		 * @since 2.4
		 */
		protected static $_instance = null;

		/**
		 * @return SP_WooCommerce_Product_Slider_PRO
		 * @since 2.4
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new SP_WooCommerce_Product_Slider_PRO();
			}

			return self::$_instance;
		}

		/**
		 * SP_WooCommerce_Product_Slider_PRO constructor.
		 */
		public function __construct() {
			// Define constants.
			$this->define_constants();

			// Required class file include.
			spl_autoload_register( array( $this, 'autoload' ) );

			// Include required files.
			$this->includes();

			// instantiate classes.
			$this->instantiate();

			// Initialize the filter hooks.
			$this->init_filters();

			// Initialize the action hooks.
			$this->init_actions();
		}


		/**
		 * Initialize WordPress filter hooks
		 *
		 * @return void
		 */
		public function init_filters() {
			if ( WPSPRO_Check::is_woocommerce_active() ) {
				add_filter( 'plugin_action_links', array( $this, 'add_plugin_action_links' ), 10, 2 );
				add_filter( 'manage_sp_wpsp_shortcodes_posts_columns', array( $this, 'add_shortcode_column' ) );
				add_filter( 'plugin_row_meta', array( $this, 'after_woo_product_slider_pro_row_meta' ), 10, 4 );
			}
		}

		/**
		 * Initialize WordPress action hooks
		 *
		 * @return void
		 */
		public function init_actions() {
			if ( WPSPRO_Check::is_woocommerce_active() ) {
				$wpsp_related_products = sp_get_option( 'wpsp_related_products_shortcode' );
				$related_products_data = get_post_meta( $wpsp_related_products, 'sp_wpsp_shortcode_options', true );
				$product_type          = ( isset( $related_products_data['product_type'] ) ? $related_products_data['product_type'] : 'latest_products' );
				if ( $wpsp_related_products != 'none' && 'related_products' == $product_type ) {
					add_action( 'woocommerce_after_single_product_summary', array( $this, 'sp_wpspro_related_products_shortcode' ), 20 );
				}

				$wpsp_upsells_products = sp_get_option( 'wpsp_upsells_products_shortcode' );
				$upsells_products_data = get_post_meta( $wpsp_upsells_products, 'sp_wpsp_shortcode_options', true );
				$product_type          = ( isset( $upsells_products_data['product_type'] ) ? $upsells_products_data['product_type'] : 'latest_products' );
				if ( $wpsp_upsells_products != 'none' && 'up_sells' == $product_type ) {
					add_action( 'woocommerce_after_single_product_summary', array( $this, 'sp_wpspro_upsells_products_shortcode' ), 15 );
				}
				add_action( 'plugins_loaded', array( $this, 'load_text_domain' ) );
				add_action( 'plugins_loaded', array( $this, 'remove_hooks' ) );
				add_action( 'manage_sp_wpsp_shortcodes_posts_custom_column', array( $this, 'add_shortcode_form' ), 10, 2 );
				add_action( 'admin_init', array( $this, 'sp_wpspro_updater_init' ), 0 );
			} else {
				add_action( 'admin_notices', array( $this, 'error_admin_notice' ) );
			}
		}

		/**
		 * Define constants
		 *
		 * @since 2.4
		 */
		public function define_constants() {
			$this->define( 'SP_WPSPRO_ITEM_NAME', 'Product Slider Pro for WooCommerce' );
			$this->define( 'SP_WPSPRO_ITEM_ID', 1634 );
			$this->define( 'SP_WPSPRO_STORE_URL', 'http://shapedplugin.com' );
			$this->define( 'SP_WPSPRO_VERSION', $this->version );
			$this->define( 'SP_WPSPRO_PATH', plugin_dir_path( __FILE__ ) );
			$this->define( 'SP_WPSPRO_URL', plugin_dir_url( __FILE__ ) );
			$this->define( 'SP_WPSPRO_BASENAME', plugin_basename( __FILE__ ) );
			$this->define( 'SP_WPSPRO_THEME_DIR', get_template_directory() );
		}

		/**
		 * Define constant if not already set
		 *
		 * @param  string      $name
		 * @param  string|bool $value
		 */
		public function define( $name, $value ) {
			if ( ! defined( $name ) ) {
				define( $name, $value );
			}
		}

		/**
		 * Updater
		 */
		public function sp_wpspro_updater_init() {
			// retrieve our license key from the DB.
			$license_key = trim( get_option( 'sp_wpspro_license_key' ) );

			// setup the updater.
			$edd_updater = new SP_WPSPRO_Plugin_Updater(
				SP_WPSPRO_STORE_URL,
				__FILE__,
				array(
					'version' => SP_WPSPRO_VERSION, // current version number.
					'license' => $license_key,
					'item_id' => SP_WPSPRO_ITEM_ID,
					'author'  => 'ShapedPlugin',
					'url'     => home_url(),
				)
			);
		}

		/**
		 * Add Related Products Shortcode
		 */
		public function sp_wpspro_related_products_shortcode() {
			echo do_shortcode( '[woo-product-slider-pro id="' . sp_get_option( 'wpsp_related_products_shortcode' ) . '"]' );
		}

		/**
		 * Add Upsells Products Shortcode
		 */
		public function sp_wpspro_upsells_products_shortcode() {
			echo do_shortcode( '[woo-product-slider-pro id="' . sp_get_option( 'wpsp_upsells_products_shortcode' ) . '"]' );
		}

		/**
		 * Load TextDomain for plugin.
		 */
		public function load_text_domain() {
			load_textdomain( 'woo-product-slider-pro', WP_LANG_DIR . '/woo-product-slider-pro/languages/woo-product-slider-pro-' . apply_filters( 'plugin_locale', get_locale(), 'woo-product-slider-pro' ) . '.mo' );
			load_plugin_textdomain( 'woo-product-slider-pro', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
		}

		/**
		 * Remove Hooks
		 */
		public function remove_hooks() {
			if ( sp_get_option( 'wpsp_related_products_hide' ) == 'true' ) {
				// Remove WooCommerce default related products.
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
			}
			if ( sp_get_option( 'wpsp_upsells_products_hide' ) == 'true' ) {
				// Remove up sells from after single product hook.
				remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
				add_action(
					'wp_loaded',
					function() {
						remove_action( 'woocommerce_after_single_product_summary', 'storefront_upsell_display', 15 );
					}
				);
			}

		}

		/**
		 * Add plugin action menu
		 *
		 * @param array  $links
		 * @param string $file
		 *
		 * @return array
		 */
		public function add_plugin_action_links( $links, $file ) {

			if ( $file == SP_WPSPRO_BASENAME ) {
				$new_links = array(
					sprintf( '<a href="%s">%s</a>', admin_url( 'post-new.php?post_type=sp_wpsp_shortcodes' ), __( 'Create Slider', 'woo-product-slider-pro' ) ),
				);

				return array_merge( $new_links, $links );
			}

			return $links;
		}

		/**
		 * Add plugin row meta link
		 *
		 * @since 2.4
		 *
		 * @param $plugin_meta
		 * @param $file
		 *
		 * @return array
		 */
		public function after_woo_product_slider_pro_row_meta( $plugin_meta, $file ) {
			if ( $file == SP_WPSPRO_BASENAME ) {
				$plugin_meta[] = '<a href="https://shapedplugin.com/demo/woocommerce-product-slider-pro/" target="_blank">' . __( 'Live Demo', 'woo-product-slider-pro' ) . '</a>';
			}

			return $plugin_meta;
		}

		/**
		 * Autoload class files on demand
		 *
		 * @param string $class requested class name
		 */
		public function autoload( $class ) {
			$name = explode( '_', $class );
			if ( isset( $name[1] ) ) {
				$class_name = strtolower( $name[1] );
				$filename   = SP_WPSPRO_PATH . '/class/' . $class_name . '.php';

				if ( file_exists( $filename ) ) {
					require_once $filename;
				}
			}
		}

		/**
		 * Instantiate all the required classes
		 *
		 * @since 2.4
		 */
		public function instantiate() {
			if ( WPSPRO_Check::is_woocommerce_active() ) {
				$this->license   = WPSPRO_License::getInstance();
				$this->help      = WPSPRO_Help::getInstance();
				$this->shortcode = WPSPRO_Shortcode::getInstance();
			}
			$this->check = WPSPRO_Check::getInstance();

			do_action( 'wpspro_instantiate', $this );
		}

		/**
		 * Page router instantiate.
		 *
		 * @since 2.4
		 */
		public function page() {
			if ( WPSPRO_Check::is_woocommerce_active() ) {
				$this->router = WPSPRO_Router::instance();
			}

			return $this->router;
		}

		/**
		 * Include the required files
		 *
		 * @return void
		 */
		public function includes() {
			if ( WPSPRO_Check::is_woocommerce_active() ) {
				$this->page()->sp_wpspro_function();
				$this->page()->sp_wpspro_metabox();
				$this->router->includes();
			}
		}

		/**
		 * ShortCode Column
		 *
		 * @param $columns
		 *
		 * @return array
		 */
		public function add_shortcode_column() {
			$new_columns['cb']        = '<input type="checkbox" />';
			$new_columns['title']     = __( 'Slider Title', 'woo-product-slider-pro' );
			$new_columns['shortcode'] = __( 'Shortcode', 'woo-product-slider-pro' );
			$new_columns['']          = '';
			$new_columns['date']      = __( 'Date', 'woo-product-slider-pro' );

			return $new_columns;
		}

		/**
		 * @param $column
		 * @param $post_id
		 */
		public function add_shortcode_form( $column, $post_id ) {

			switch ( $column ) {

				case 'shortcode':
					$column_field = '<input style="width: 270px;padding: 6px;" type="text" onClick="this.select();" readonly="readonly" value="[woo-product-slider-pro ' . 'id=&quot;' . $post_id . '&quot;' . ']"/>';
					echo $column_field;
					break;
				default:
					break;

			} // end switch

		}

		/**
		 * WooCommerce not installed error message
		 */
		public function error_admin_notice() {
			$outline = '<div class="error"><p>' . __( 'Please install and activate <strong><a href="https://wordpress.org/plugins/woocommerce/">WooCommerce</a></strong> plugin to make the <strong>Product Slider Pro for WooCommerce</strong> work.', 'woo-product-slider-pro' ) . '</p></div>';
			echo $outline;
		}

	}
}

/**
 * Returns the main instance.
 *
 * @since 2.4
 * @return SP_WooCommerce_Product_Slider_PRO
 */
function sp_woo_product_slider_pro() {
	return SP_WooCommerce_Product_Slider_PRO::instance();
}

/**
 * SP_woo_product_slider_pro instance.
 */
sp_woo_product_slider_pro();

if ( ! class_exists( 'SP_WPSPRO_Plugin_Updater' ) ) {
	// load our custom updater if it doesn't already exist.
	include dirname( __FILE__ ) . '/class/updater.php';
}
