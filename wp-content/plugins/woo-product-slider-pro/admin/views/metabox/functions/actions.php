<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access pages directly.
/**
 *
 * Get icons from admin ajax
 *
 * @since 1.0.0
 * @version 1.0.0
 */
if ( ! function_exists( 'sp_get_icons' ) ) {
	function sp_get_icons() {

		do_action( 'sp_add_icons_before' );

		$jsons = glob( SP_WPSP_DIR . '/fields/icon/*.json' );

		if ( ! empty( $jsons ) ) {

			foreach ( $jsons as $path ) {

				$object = sp_get_icon_fonts( 'fields/icon/' . basename( $path ) );

				if ( is_object( $object ) ) {

					echo ( count( $jsons ) >= 2 ) ? '<h4 class="sp-icon-title">' . $object->name . '</h4>' : '';

					foreach ( $object->icons as $icon ) {
						echo '<a class="sp-icon-tooltip" data-icon="' . $icon . '" data-title="' . $icon . '"><span class="sp-icon sp-selector"><i class="' . $icon . '"></i></span></a>';
					}
				} else {
						  echo '<h4 class="sp-icon-title">' . __( 'Error! Can not load json file.', 'woo-product-slider-pro' ) . '</h4>';
				}
			}
		}

		do_action( 'sp_add_icons' );
		do_action( 'sp_add_icons_after' );

		die();
	}
	add_action( 'wp_ajax_sp-get-icons', 'sp_get_icons' );
}

/**
 * This function for attr terms
 */
function sp_wpsp_attribute_term() {
	extract( $_REQUEST );
	$terms = get_terms( $product_attribute );
	foreach ( $terms as $key => $value ) {
		echo '<option value="' . $value->slug . '">' . $value->name . '</option>';
	}
	die( 0 );
}
add_action( 'wp_ajax_sp_wpsp_attribute_term', 'sp_wpsp_attribute_term' );
