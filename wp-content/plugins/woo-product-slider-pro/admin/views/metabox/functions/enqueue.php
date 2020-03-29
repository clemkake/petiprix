<?php if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access pages directly.
/**
 *
 * Framework admin enqueue style and scripts
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! function_exists( 'sp_wpsp_admin_enqueue_scripts' ) ) {
	function sp_wpsp_admin_enqueue_scripts() {
		$current_screen        = get_current_screen();
		$the_current_post_type = $current_screen->post_type;
		if ( $the_current_post_type == 'sp_wpsp_shortcodes' ) {

			// admin utilities.
			wp_enqueue_media();

			// wp core styles.
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style( 'wp-jquery-ui-dialog' );

			// framework core styles.
			wp_enqueue_style( 'wpsp-framework', SP_WPSPRO_URL . 'admin/views/metabox/assets/css/sp-framework.min.css', array(), SP_WPSPRO_VERSION, 'all' );
			wp_enqueue_style( 'wpsp-custom', SP_WPSPRO_URL . 'admin/views/metabox/assets/css/sp-custom.min.css', array(), SP_WPSPRO_VERSION, 'all' );
			wp_enqueue_style( 'wpsp-style', SP_WPSPRO_URL . 'admin/views/metabox/assets/css/wpsp-style.min.css', array(), SP_WPSPRO_VERSION, 'all' );
			wp_enqueue_style( 'font-awesome', SP_WPSPRO_URL . 'public/assets/css/font-awesome.min.css', array(), SP_WPSPRO_VERSION, 'all' );

			if ( is_rtl() ) {
				wp_enqueue_style( 'wpsp-framework-rtl', SP_WPSPRO_URL . 'admin/views/metabox/assets/css/sp-framework-rtl.min.css', array(), SP_WPSPRO_VERSION, 'all' );
			}

			// wp core scripts.
			wp_enqueue_script( 'wp-color-picker' );
			wp_enqueue_script( 'jquery-ui-dialog' );
			// wp_enqueue_script( 'jquery-ui-sortable' );
			// framework core scripts.
			wp_enqueue_script( 'wpsp-plugins', SP_WPSPRO_URL . 'admin/views/metabox/assets/js/sp-plugins.min.js', array(), SP_WPSPRO_VERSION, true );
			wp_enqueue_script( 'wpsp-framework', SP_WPSPRO_URL . 'admin/views/metabox/assets/js/sp-framework.min.js', array( 'wpsp-plugins' ), SP_WPSPRO_VERSION, true );
		}

	}

	add_action( 'admin_enqueue_scripts', 'sp_wpsp_admin_enqueue_scripts' );
}
