<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Product Slider Pro for WooCommerce - router class
 * @since 2.4
 */
class WPSPRO_Router {

	/**
	 * @var WPSPRO_Router single instance of the class
	 *
	 * @since 2.4
	 */
	protected static $_instance = null;


	/**
	 * Main WPSPRO_Router Instance
	 *
	 * @since 3.0
	 * @static
	 * @return self Main instance
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Include the required files
	 *
	 * @since 2.4
	 * @return void
	 */
	function includes() {
		include_once SP_WPSPRO_PATH . '/includes/pro/loader.php';
	}

	/**
	 * WPSPRO function
	 *
	 * @since 1.0
	 * @return void
	 */
	function sp_wpspro_function() {
		include_once SP_WPSPRO_PATH . '/includes/functions.php';
	}

	/**
	 * WPSPRO MeatBox
	 *
	 * @since 1.0
	 * @return void
	 */
	function sp_wpspro_metabox() {
		include_once SP_WPSPRO_PATH . '/admin/views/metabox/sp-framework.php';
	}

}
