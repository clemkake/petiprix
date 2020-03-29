<?php

/**
 * The Pro Loader Class
 *
 * @package woo-product-slider-pro
 *
 * @since 2.4
 */
class SP_WPSPRO_Loader {

	function __construct() {
		require_once SP_WPSPRO_PATH . 'admin/views/resizer.php';
		require_once SP_WPSPRO_PATH . 'public/views/shortcoderender.php';
		require_once SP_WPSPRO_PATH . 'public/views/scripts.php';
		require_once SP_WPSPRO_PATH . 'admin/views/scripts.php';
		require_once SP_WPSPRO_PATH . 'admin/views/vc-add-on.php';
		require_once SP_WPSPRO_PATH . 'admin/views/widget.php';
		require_once SP_WPSPRO_PATH . 'admin/views/mce-button.php';
	}

}

new SP_WPSPRO_Loader();
