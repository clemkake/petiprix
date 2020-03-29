<?php
$attachment_ids = $product->get_gallery_image_ids();

$outline .= '<div class="wpsp-product wpsp-masonry-item ' . $item_class;
if ( $attachment_ids && $product_image_flip == 'true' ) {
	$outline .= ' wpsp-product-image-flip';
}
$outline .= '">';
$outline .= '<div class="wpspro-product-data">';
$outline .= '<div class="wpsp-product-box">';

if ( has_post_thumbnail() && $product_image == 'true' || $product_image == 'true' && $placeholder_image ) {
	$outline            .= '<div class="wpsp-product-image-area">';
	if ( $wpsp_image_lightbox == 'true' ) {
		$outline            .= '<a href="' . get_the_post_thumbnail_url( get_the_ID(), 'full' ) . '" class="wpsp-product-image sp-wpsp-lightbox ' . $image_gray_scale . '">';
	} else {
		$outline            .= '<a href="' . esc_url( get_the_permalink() ) . '" class="wpsp-product-image ' . $image_gray_scale . '">';
	}

	$img_outline = '';
	if ( has_post_thumbnail() ) {
		$img_outline .= $image;
	} else {
		$img_outline .= $place_image;
	}
	$outline .= apply_filters( 'sp_wpspro_product_image', $img_outline, $post_thumbnail_id );

	include SP_WPSPRO_PATH . '/public/views/content/flip-image.php';

	$outline .= '</a>';
	$outline .= '</div>';
}

$outline .= '<div class="wpsp-product-content-area">';
$outline .= '<div class="product-details">';
$outline .= '<div class="product-details-inner sp-text-left">';
if ( $product_cat == 'true' ) {
	$outline .= '<div class="wpsp-product-cat">';
	$outline .= get_the_term_list( $que->post->ID, 'product_cat', '', ', ', '' );
	$outline .= '</div>';
}
if ( $product_name == 'true' ) {
	$outline .= '<div class="wpsp-product-title"><a href="' . get_the_permalink() . '">' . $sp_wpsp_product_name . '</a></div>';
}
if ( $product_price == 'true' ) {
	if ( class_exists( 'WooCommerce' ) && $price_html = $product->get_price_html() ) {
		$outline .= '<div class="wpsp-product-price">' . $price_html . '</div>';
	};
}

if ( class_exists( 'WooCommerce' ) && $product_rating == 'true' ) {
	$average = $product->get_average_rating();
	if ( $average > 0 ) {
		$outline .= '<div class="' . $product_rating_alignment . '"><div class="star-rating" title="' . esc_html__( 'Rated', 'woo-product-slider-pro' ) . ' ' . $average . '' . esc_html__( ' out of 5', 'woo-product-slider-pro' ) . '"><span style="width:' . ( ( $average / 5 ) * 100 ) . '%"><strong itemprop="ratingValue" class="rating">' . $average . '</strong> ' . esc_html__( 'out of 5', 'woo-product-slider-pro' ) . '</span></div></div>';
	}
}

$outline .= '</div>'; // product-details-inner.
$outline .= '</div>'; // product-details.

$outline .= '<div class="product-wishlist-com">';
if ( in_array( 'yith-woocommerce-compare/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && $compare == 'true' ) {
	$outline .= do_shortcode( '[yith_compare_button]' );
}
if ( in_array( 'yith-woocommerce-wishlist/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && $wishlist == 'true' ) {
	$outline .= do_shortcode( '[yith_wcwl_add_to_wishlist]' );
}
$outline .= '</div>';

$outline .= '</div>';
$outline .= '</div>';
$outline .= '</div>'; // wpsp-product-content-area.
$outline .= '</div>';
