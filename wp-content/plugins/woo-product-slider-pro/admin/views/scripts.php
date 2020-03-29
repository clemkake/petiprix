<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access

/**
 * Scripts and styles
 */
class SP_WPSPRO_Admin_Scripts {

	/**
	 * @var null
	 * @since 2.4
	 */
	protected static $_instance = null;

	/**
	 * @return SP_WPSPRO_Admin_Scripts
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

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
	}

	/**
	 * Enqueue admin scripts
	 */
	public function admin_scripts() {
		wp_enqueue_style(
			'wpsp-admin-style', SP_WPSPRO_URL . 'admin/assets/css/admin-style.min.css', array(),
			SP_WPSPRO_VERSION
		);
	}

}

new SP_WPSPRO_Admin_Scripts();
