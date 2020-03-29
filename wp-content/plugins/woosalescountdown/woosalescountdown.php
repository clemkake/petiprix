<?php
/*
  Plugin Name: WooCommerce Sales Countdown
  Plugin URI: http://thimpress.com
  Description: Show countdown for sales products from WooCommerce plugin.
  Version: 2.2.6
  Author: ThimPress
  Author URI: http://thimpress.com
  Copyright 2007-2017 ThimPress.com. All rights reserved.
 */

/* Register hook */
@session_start();

if ( !defined( 'ABSPATH' ) ) {
    exit();
}

define( 'WSCD_URI', plugin_dir_url( __FILE__ ) );
define( 'WSCD_DIR', plugin_dir_path( __FILE__ ) );
define( 'WSCD_ASSET_URI', WSCD_URI . 'assets/' );

class WSCD {

    public function __construct() {
        register_activation_hook( __FILE__, array( $this, 'install' ) );
        register_deactivation_hook( __FILE__, array( $this, 'uninstall' ) );

        /* loaded */
        add_action( 'plugins_loaded', array( $this, 'init_woosalecountdown' ) );
    }

    public function before_template_part( $template_name, $template_path, $located, $args ) {
        $template = str_replace( array( '\\', '/' ), '-', $template_name );
        $template = sanitize_title( str_replace( '.php', '', $template ) );
        do_action( 'wscd_position_before-' . $template );
        if ( array_key_exists( 'countdown-position', $_REQUEST ) ) {
            echo "<code class=\"thim-position-code\">[before-{$template}]</code>";
        }
    }

    public function after_template_part( $template_name, $template_path, $located, $args ) {
        $template = str_replace( array( '\\', '/' ), '-', $template_name );
        $template = sanitize_title( str_replace( '.php', '', $template ) );
        do_action( 'wscd_position_after-' . $template );
        if ( array_key_exists( 'countdown-position', $_REQUEST ) ) {
            echo "<code class=\"thim-position-code\">[after-{$template}]</code>";
        }
    }

	/**
	 * WooCommerce hooks to displays the countdown
	 *
	 * @since 2.0
	 */
	public function add_hooks() {
		global $woocommerce;
		if( !$woocommerce ){
			return;
		}

		if ( version_compare( $woocommerce->version, '3.0.0', '>=' ) ) {
			add_filter( 'woocommerce_product_is_on_sale', 'woosales_woocommerce_product_is_on_sale', 1, 2  );
			add_filter( 'woocommerce_product_get_price', 'wscd_filter_woocommerce_product_get_price', 1, 3 );
// 			add_filter('woocommerce_variation_prices_price','wscd_filter_callback_woocommerce_variation_prices_price', 10, 3);
			add_filter( 'woocommerce_product_variation_get_price', 'wscd_filter_woocommerce_product_get_price', 10, 4 ); 

		} else {
// 			add_filter( 'woocommerce_get_price', 'wscd_filter_woocommerce_get_price', 10, 3 );
// 			add_filter( 'woocommerce_variation_get_price', 'wscd_filter_woocommerce_get_price', 10, 4 );
		}

		add_action( 'woocommerce_before_template_part', array( $this, 'before_template_part' ), 10, 4 );
		add_action( 'woocommerce_after_template_part', array( $this, 'after_template_part' ), 10, 4 );

        $pattern = '/[\[]?([a-zA-Z\-\_]+)[\]]?/';
        /* loop product */
        if ( woosale_categories_is_enabled() ) {
            $category_position = get_option( 'ob_categories_position', 0 );
            switch ( $category_position ) {
                case '0': // above price
                    add_action( 'woocommerce_after_shop_loop_item_title', array( $this, 'loop_countdown' ), 9.9 );
                    break;
                case '1': // above title
                    add_action( 'woocommerce_shop_loop_item_title', array( $this, 'loop_countdown' ), 9.9 );
                    break;
                case '2': // above add-to-cart
                    add_action( 'woocommerce_after_shop_loop_item', array( $this, 'loop_countdown' ), 9.9 );
                    break;
                case '3': // below add-to-cart
                    add_action( 'woocommerce_after_shop_loop_item', array( $this, 'loop_countdown' ), 10.1 );
                    break;
                case '4': // above thumbnail
                    add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'loop_countdown' ), 9.9 );
                    break;
                default:
                    $positions = get_option( 'ob_categories_element_text' );
                    $positions = explode( ',', $positions );
                    $positions = array_map( 'trim', $positions );
                    if ( sizeof( $positions ) )
                        foreach ( $positions as $position ) {
                            preg_match( $pattern, $position, $match );
                            if ( isset( $match[1] ) && $match[1] ) {
                                $position = $match[1];
                                add_action( 'wscd_position_' . $position, array( $this, 'loop_countdown' ) );
                            }
                        }
                    break;
            }
        }

        /* single product */
        if ( woosale_single_is_enabled() ) {
            $single_position = get_option( 'ob_detail_position', 0 );
            switch ( $single_position ) {
                case '0': // above tabs
                    add_action( 'woocommerce_after_single_product_summary', array( $this, 'single_countdown' ), 9.9 );
                    break;
                case '1': // below tabs
                    add_action( 'woocommerce_after_single_product_summary', array( $this, 'single_countdown' ), 10.1 );
                    break;
                case '2': // above short description
                    add_action( 'woocommerce_single_product_summary', array( $this, 'single_countdown' ), 19.9 );
                    break;
                case '3': // below short description
                    add_action( 'woocommerce_single_product_summary', array( $this, 'single_countdown' ), 20.1 );
                    break;
                case '4': // above add to cart
                    add_action( 'woocommerce_single_product_summary', array( $this, 'single_countdown' ), 29.9 );
                    break;
                case '5': // below add to cart
                    add_action( 'woocommerce_single_product_summary', array( $this, 'single_countdown' ), 30.1 );
                    break;
                case '6': // above title
                    add_action( 'woocommerce_single_product_summary', array( $this, 'single_countdown' ), 4.9 );
                    break;
                case '7': // below title
                    add_action( 'woocommerce_single_product_summary', array( $this, 'single_countdown' ), 5.1 );
                    break;
                case '8': // above price
                    add_action( 'woocommerce_single_product_summary', array( $this, 'single_countdown' ), 9.9 );
                    break;
                case '9': // below price
                    add_action( 'woocommerce_single_product_summary', array( $this, 'single_countdown' ), 10.1 );
                    break;
                default: /* custom */
                    $positions = get_option( 'ob_single_element_text' );
                    $positions = explode( ',', $positions );
                    $positions = array_map( 'trim', $positions );
                    if ( sizeof( $positions ) )
                        foreach ( $positions as $position ) {
                            preg_match( $pattern, $position, $match );
                            if ( isset( $match[1] ) && $match[1] ) {
                                $position = $match[1];
                                add_action( 'wscd_position_' . $position, array( $this, 'single_countdown' ) );
                            }
                        }
                    break;
            }
        }
    }

    /* product loop */

    public function loop_countdown() {
        if ( !woosale_categories_is_enabled() || !woosales_has_countdown() || is_admin() ) {
            return;
        }
        global $product;
        $classes = array( 'ob_categories', 'woosalescountdown', 'woosalescountdown-category' );
        $options = get_option( 'ob_woosales_categories', array(
            'sort' => array( 'title', 'schedule', 'sale-bar', 'countdown' ),
            'enabled' => array( 'title' => 'on', 'schedule' => 'on', 'sale-bar' => 'on', 'countdown' => 'on' ) ) );

        $products = woosales_setup_product_countdown( false );
        $this->get_template( 'item.php', array(
            'products' => $products,
            'classes' => $classes,
            'options' => $options,
                // 'is_single'	=> true
        ) );
        /* Clear Cache */
        $this->clear_cache();
    }

    /* product single */

    public function single_countdown() {
		
        if ( !woosale_single_is_enabled() || !woosales_has_countdown() || is_admin() ) {
            return;
        }
        $classes = array( 'woosalescountdown', 'woosalescountdown-single' );
        $options = get_option( 'ob_woosales_single', array(
            'sort' => array( 'title', 'schedule', 'sale-bar', 'countdown' ),
            'enabled' => array( 'title' => 'on', 'schedule' => 'on', 'sale-bar' => 'on', 'countdown' => 'on' )
                ) );

        $products = woosales_setup_product_countdown();
        $this->get_template( 'item.php', array(
            'products' => $products,
            'classes' => $classes,
            'options' => $options,
                // 'is_single'	=> false
        ) );
        /* Clear Cache */
        $this->clear_cache();
    }

    /**
     * This is an extremely useful function if you need to execute any actions when your plugin is activated.
     */
    public function install() {
        global $wp_version;
        if ( version_compare( $wp_version, "2.9", "<" ) ) {
            deactivate_plugins( basename( __FILE__ ) ); // Deactivate our plugin
            wp_die( "This plugin requires WordPress version 2.9 or higher." );
        }
    }

    /**
     * This function is called when deactive.
     */
    public function uninstall() {
        //do something
    }

    /**
     * Function set up include javascript, css.
     */
    public function obScriptInit() {
        wp_enqueue_script( 'wscd-script-name', WSCD_ASSET_URI . 'js/jquery.mb-comingsoon.min.js', array(), false, true );
        wp_enqueue_style( 'wscd-style-name', WSCD_ASSET_URI . 'css/woosalescountdown.css' );

        /* register main js */
        wp_register_script( 'woosalescountdown', WSCD_ASSET_URI . 'js/woosalescountdown.js', array(), false, true );
        wp_localize_script( 'woosalescountdown', 'woosalescountdown_i18n', apply_filters( 'woosalescountdown_i18n', array(
            'localization' => array(
                'days' => __( 'days', 'woosalescountdown' ),
                'hours' => __( 'hours', 'woosalescountdown' ),
                'minutes' => __( 'minutes', 'woosalescountdown' ),
                'seconds' => __( 'seconds', 'woosalescountdown' )
            )
        ) ) );

        wp_enqueue_script( 'woosalescountdown' );
    }

    public function admin_assets() {
        global $pagenow;
        if ( 'widgets.php' == $pagenow ) {
            wp_enqueue_style( 'woocommerce_admin_styles' );
            wp_enqueue_script( 'select2' );
        }

        if ( !empty( $_REQUEST['tab'] ) && $_REQUEST['tab'] == 'wscd' ) {
            wp_enqueue_script( 'wscd-admin-settings', WSCD_ASSET_URI . 'js/admin-settings.js', array( 'wc-admin-variation-meta-boxes', 'wc-admin-meta-boxes', 'serializejson', 'media-models' ) );
        }

        wp_enqueue_style( 'wscd-admin', WSCD_ASSET_URI . 'css/wscd-admin.css' );
        wp_register_script( 'woosalescountdown-admin', WSCD_ASSET_URI . 'js/woosalescountdown-admin.js', array( 'jquery' ), false, true );
        wp_localize_script( 'woosalescountdown-admin', 'woosalescountdown_i18n', apply_filters( 'woosalescountdown_i18n', array(
            'sync_variation' => __( 'Sync Countdown Variable', 'woosalescountdown' ),
            'confirm' => __( 'Set this countdown for all variable', 'woosalescountdown' )
        ) ) );
        wp_enqueue_script( 'woosalescountdown-admin' );
    }

    /**
     * Register widget
     */
    public function register_widgets() {
        require_once WSCD_DIR . '/includes/class-wscd-widget-sale-products.php';

        register_widget( 'WSCD_Widget_Sale_Products' );
    }

    /**
     * Load and custom CSS from setting
     */
    public function woosalescountdown_style_load() {
        @$colors = array_map( 'esc_attr', (array) get_option( 'woocommerce_frontend_css_colors' ) );

        // Defaults
        if ( empty( $colors['primary'] ) ) {
            $colors['primary'] = '#ad74a2';
        }
        if ( empty( $colors['secondary'] ) ) {
            $colors['secondary'] = '#f7f6f7';
        }

        @$ob_use_color = get_option( 'ob_use_color' );
        if ( $ob_use_color ) {
            @$background_color = get_option( 'ob_background_color' );
            @$time_color = get_option( 'ob_time_color' );
            @$ob_bar_color = get_option( 'ob_bar_color' );
            @$ob_bg_bar_color = get_option( 'ob_bg_bar_color' );
        } else {
            @$background_color = $colors['secondary'];
            @$time_color = $colors['primary'];
            @$ob_bar_color = $time_color;
            @$ob_bg_bar_color = $background_color;
        }
        echo "<style type='text/css'>
			.counter-block .counter .number{background-color:$background_color;color:$time_color;}
			.ob_discount{background-color:$ob_bg_bar_color;}
			.ob_sale{background-color:$ob_bar_color}
		</style>";
    }

	/**
	 * Init when plugin load
	 */
	public function init_woosalecountdown() {
		load_plugin_textdomain( 'woosalescountdown' );
		$this->load_plugin_textdomain();
		
		if ( ! class_exists( 'WooCommerce' ) ) {
			add_action( 'admin_notices', array(
					$this,
					'admin_notices' 
			) );
			return;
		}
		
		require_once ('includes/class-wscd-admin.php');
		require_once ('includes/functions.php');
		
		if ( ! is_admin() ) {
			require_once 'includes/class-wscd-shortcodes.php';
			/* intt shortcode */
			WSCD_Shortcodes::init();
		}

		/**
		 * add action of plugin
		 */
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_assets' ), 99 );
		add_action( 'wp_enqueue_scripts', array( $this, 'obScriptInit' ) );
		add_action( 'widgets_init', array( $this, 'register_widgets' ) );
		add_action( 'wp_print_scripts', array( $this, 'woosalescountdown_style_load' ) );
		add_filter( 'woocommerce_get_cart_item_from_session', array( $this, 'check_quantity_product_in_sale' ) );
		add_action( 'wp_head', array( $this, 'add_hooks' ) );
	}

    public function admin_notices() {
        ?>
        <div class="notice notice-error">
            <p><?php _e( '<strong>WooCommerce</strong> plugin is not installed or activated.', 'woosalescountdown' ); ?></p>
        </div>
        <?php
    }

    /**
     * Function load language
     */
    public function load_plugin_textdomain() {
        $locale = apply_filters( 'plugin_locale', get_locale(), 'woosalescountdown' );

        // Admin Locale
        if ( is_admin() ) {
            load_textdomain( 'woosalescountdown', WSCD_DIR . "/languages/woosalescountdown-$locale.mo" );
        }

        // Global + Frontend Locale
        load_textdomain( 'woosalescountdown', WSCD_DIR . "/languages/woosalescountdown-$locale.mo" );
        load_plugin_textdomain( 'woosalescountdown', false, WSCD_DIR . "/languages/" );
    }

    /*
     * Function Setting link in plugin manager
     */

    public function settings_link( $links ) {
        $settings_link = '<a href="admin.php?page=wc-settings&tab=woosalescountdown" title="' . __( 'Settings', 'woosalescountdown' ) . '">' . __( 'Settings', 'woosalescountdown' ) . '</a>';
        array_unshift( $links, $settings_link );

        return $links;
    }

    /**
     * Function check quantity in sale
     */
    public function check_quantity_product_in_sale( $data ) {
        if ( isset( $data['product_id'] ) ) {
			$product_id = $data['product_id'];
			$product = wc_get_product($product_id);
			if(!$product->is_on_sale()){
				return $data;
			}
            $_quantity_discount = get_post_meta( $data['product_id'], '_quantity_discount', true );
            $_quantity_sale = get_post_meta( $data['product_id'], '_quantity_sale', true );
            $_quantity_sale = $_quantity_sale ? $_quantity_sale : 0;
            if ( $_quantity_discount ) {
                $total = absint( $_quantity_discount ) - absint( $_quantity_sale );
                if ( $total > 0 && $total < absint( $data['quantity'] ) ) {
                    $data['quantity'] = $total;
                }
            }
        }

        return $data;
    }

    /**
     * Clear cache. Support Supper Cache
     */
    protected function clear_cache() {
        include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

        /* Clear Cache with Supper Cache */
        if ( function_exists( 'wp_cache_clean_cache' ) ) {
            global $file_prefix;
            wp_cache_clean_cache( $file_prefix );
        }
    }

    /* template path */

    public function template_path() {
        return apply_filters( 'woosalescountdown_template_path', 'woosalescountdown' );
    }

    /**
     * get template part
     *
     * @param   string $slug
     * @param   string $name
     *
     * @return  string
     */
    public function get_template_part( $slug, $name = '' ) {
        $template = '';

        // Look in yourtheme/slug-name.php and yourtheme/courses-manage/slug-name.php
        if ( $name ) {
            $template = locate_template( array( "{$slug}-{$name}.php", $this->template_path() . "/{$slug}-{$name}.php" ) );
        }

        // Get default slug-name.php
        if ( !$template && $name && file_exists( WSCD_DIR . "/templates/{$slug}-{$name}.php" ) ) {
            $template = WSCD_DIR . "/templates/{$slug}-{$name}.php";
        }

        // If template file doesn't exist, look in yourtheme/slug.php and yourtheme/courses-manage/slug.php
        if ( !$template ) {
            $template = locate_template( array( "{$slug}.php", $this->template_path() . "{$slug}.php" ) );
        }

        // Allow 3rd party plugin filter template file from their plugin
        if ( $template ) {
            $template = apply_filters( 'woosalescountdown_get_template_part', $template, $slug, $name );
        }
        if ( $template && file_exists( $template ) ) {
            load_template( $template, false );
        }

        return $template;
    }

    /**
     * Get other templates passing attributes and including the file.
     *
     * @param string $template_name
     * @param array  $args          (default: array())
     * @param string $template_path (default: '')
     * @param string $default_path  (default: '')
     *
     * @return void
     */
    public function get_template( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
        if ( $args && is_array( $args ) ) {
            extract( $args );
        }

        $located = $this->locate_template( $template_name, $template_path, $default_path );

        if ( !file_exists( $located ) ) {
            _doing_it_wrong( __FUNCTION__, sprintf( '<code>%s</code> does not exist.', $located ), '2.1' );
            return;
        }
        // Allow 3rd party plugin filter template file from their plugin
        $located = apply_filters( 'woosalescountdown_get_template', $located, $template_name, $args, $template_path, $default_path );

        do_action( 'woosalescountdown_before_template_part', $template_name, $template_path, $located, $args );

        include( $located );

        do_action( 'woosalescountdown_after_template_part', $template_name, $template_path, $located, $args );
    }

    /**
     * Locate a template and return the path for inclusion.
     *
     * This is the load order:
     *
     *        yourtheme        /    $template_path    /    $template_name
     *        yourtheme        /    $template_name
     *        $default_path    /    $template_name
     *
     * @access public
     *
     * @param string $template_name
     * @param string $template_path (default: '')
     * @param string $default_path  (default: '')
     *
     * @return string
     */
    public function locate_template( $template_name, $template_path = '', $default_path = '' ) {

        if ( !$template_path ) {
            $template_path = $this->template_path();
        }

        if ( !$default_path ) {
            $default_path = WSCD_DIR . '/templates/';
        }

        $template = null;
        // Look within passed path within the theme - this is priority
        $template = locate_template(
                array(
                    trailingslashit( $template_path ) . $template_name,
                    $template_name
                )
        );
        // Get default template
        if ( !$template ) {
            $template = $default_path . $template_name;
        }

        // Return what we found
        return apply_filters( 'woosalescountdown_locate_template', $template, $template_name, $template_path );
    }

    public function get_template_content( $template_name, $args = array(), $template_path = '', $default_path = '' ) {
        ob_start();
        $this->get_template( $template_name, $args, $template_path, $default_path );
        return ob_get_clean();
    }

}

$GLOBALS['woosalescountdown'] = new WSCD();
//add_action( 'plugins_loaded', function() {
//    $date = new DateTime( '2016-08-05 17:00:00' );
//    $date->setTimezone( new DateTimeZone( woosales_get_timezone_string() ) );
//    var_dump( $date->format(DATE_ATOM) ); die();
//} );
