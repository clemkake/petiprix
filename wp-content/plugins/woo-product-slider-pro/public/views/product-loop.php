<?php
/**
 * Product loop.
 *
 * @link       https://shapedplugin.com/
 * @since      2.5.0
 *
 * @package    Woo_Product_Slider_Pro
 * @subpackage Woo_Product_Slider_Pro/public/views
 */

if ( $que->have_posts() ) {
	require SP_WPSPRO_PATH . '/public/views/content/slider-title.php';
	require SP_WPSPRO_PATH . '/public/views/preloader.php';

	$outline .= '<div id="sp-woo-product-slider-pro' . $post_id . '" class="wpsp-product-section ' . $grid_pagination_type . '"' . $the_rtl . ' ' . $slider_data . ' >';

	if ( $que->have_posts() ) {
		while ( $que->have_posts() ) :
			$que->the_post();

			global $product, $woocommerce_loop, $woocommerce;
			$post_thumbnail_id = $product->get_image_id();

			if ( $shortcode_data['product_name_word_limit'] == 'true' ) {
				$sp_wpsp_product_name = wp_trim_words( get_the_title(), $shortcode_data['product_name_word_limit_number'], $shortcode_data['product_name_word_limit_after'] );
			} else {
				$sp_wpsp_product_name = get_the_title();
			}

			include SP_WPSPRO_PATH . '/public/views/content/product-image.php';

			$theme_name = str_replace( '_', '-', $theme_style );
			$theme_file = SP_WPSPRO_THEME_DIR . '/woo-product-slider-pro/templates/' . $theme_name . '.php';

			if ( file_exists( $theme_file ) ) {
				// Get file from current theme directory.
				include SP_WPSPRO_THEME_DIR . '/woo-product-slider-pro/templates/' . $theme_name . '.php';
			} else {
				include SP_WPSPRO_PATH . '/public/views/templates/' . $theme_name . '.php';
			}

		endwhile;
	}
	$outline .= '</div>';// sp-woo-product-slider-pro.

	include SP_WPSPRO_PATH . '/public/views/pagination.php';

} else {

	if ( sp_get_option( 'no_products_found' ) ) {
		$outline .= '<h3 class="wpsp-no-products-found">' . sp_get_option( 'no_products_found' ) . '</h3>';
	}
}
