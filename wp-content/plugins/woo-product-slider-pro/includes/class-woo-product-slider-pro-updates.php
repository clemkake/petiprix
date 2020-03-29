<?php
/**
 * Fired during plugin updates
 *
 * @link       https://shapedplugin.com/
 * @since      2.5.4
 *
 * @package    Woo_Product_Slider_Pro
 * @subpackage Woo_Product_Slider_Pro/includes
 */

// don't call the file directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Fired during plugin updates.
 *
 * This class defines all code necessary to run during the plugin's updates.
 *
 * @since      2.5.4
 * @package    Woo_Product_Slider_Pro
 * @subpackage Woo_Product_Slider_Pro/includes
 * @author     ShapedPlugin <support@shapedplugin.com>
 */
class Woo_Product_Slider_Pro_Updates {

	/**
	 * DB updates that need to be run
	 *
	 * @var array
	 */
	private static $updates = [
		'2.5.4' => 'updates/update-2.5.4.php',
	];

	/**
	 * Binding all events
	 *
	 * @since 2.5.4
	 *
	 * @return void
	 */
	public function __construct() {
		add_action( 'plugins_loaded', array( $this, 'do_updates' ) );
	}

	/**
	 * Check if need any update
	 *
	 * @since 2.5.4
	 *
	 * @return boolean
	 */
	public function is_needs_update() {
		$installed_version = get_option( 'woo_product_slider_pro_version' );

		if ( false === $installed_version ) {
			update_option( 'woo_product_slider_pro_version', '2.5.4' );
			update_option( 'woo_product_slider_pro_db_version', '2.5.4' );
		}

		if ( version_compare( $installed_version, SP_WPSPRO_VERSION, '<' ) ) {
			return true;
		}

		return false;
	}



	/**
	 * Do updates.
	 *
	 * @since 2.5.4
	 *
	 * @return void
	 */
	public function do_updates() {
		$this->perform_updates();
	}

	/**
	 * Perform all updates
	 *
	 * @since 2.5.4
	 *
	 * @return void
	 */
	public function perform_updates() {
		if ( ! $this->is_needs_update() ) {
			return;
		}

		$installed_version = get_option( 'woo_product_slider_pro_version' );

		foreach ( self::$updates as $version => $path ) {
			if ( version_compare( $installed_version, $version, '<' ) ) {
				include $path;
				update_option( 'woo_product_slider_pro_version', $version );
			}
		}

		update_option( 'woo_product_slider_pro_version', SP_WPSPRO_VERSION );

	}

}
new Woo_Product_Slider_Pro_Updates();
