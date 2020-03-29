<?php
/**
 * Fired during plugin activation
 *
 * @link       https://shapedplugin.com/
 * @since      2.5.3
 *
 * @package    Woo_Product_Slider_Pro
 * @subpackage Woo_Product_Slider_Pro/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      2.5.3
 * @package    Woo_Product_Slider_Pro
 * @subpackage Woo_Product_Slider_Pro/includes
 * @author     ShapedPlugin <support@shapedplugin.com>
 */
class Woo_Product_Slider_Pro_Activator {

	/**
	 * Activator
	 *
	 * @since    2.5.3
	 */
	public static function activate() {
		$current_version    = get_option( 'woo_product_slider_pro_version', null );
		$current_db_version = get_option( 'woo_product_slider_pro_db_version', null );

		// Update to latest version.
		$latest_version = SP_WPSPRO_VERSION;
		update_option( 'woo_product_slider_pro_version', $latest_version );
		update_option( 'woo_product_slider_pro_db_version', $latest_version );

		// Deactivate free version.
		deactivate_plugins( 'woo-product-slider/main.php' );
	}

}
