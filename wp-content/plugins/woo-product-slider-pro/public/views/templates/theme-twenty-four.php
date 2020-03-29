<?php
$attachment_ids = $product->get_gallery_image_ids();

$outline .= '<div class="wpsp-product wpsp-masonry-item ' . $item_class;
if ( $attachment_ids && $product_image_flip == 'true' ) {
	$outline .= ' wpsp-product-image-flip';
}
$outline .= '">';
$outline .= '<div class="wpspro-product-data">';
$outline .= '<div class="wpsp-product-image-area">';
if ( has_post_thumbnail() && $product_image == 'true' || $product_image == 'true' && $placeholder_image
) {
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

	include SP_WPSPRO_PATH . '/public/views/content/sale-ribbon.php';
	if ( $out_of_stock_ribbon == 'true' ) {
		if ( ! $product->is_in_stock() ) {
			$outline .= '<div class="wpsp-out-of-stock" title="' . $out_of_stock_ribbon_text . '">' . $out_of_stock_ribbon_text . '</div>';
		}
	}

	$outline .= '</a>';
}
$outline .= '<div class="wpsp-product-add-to-cart sp-text-center">';

$outline .= '<ul>';
if ( $add_to_cart_button == 'true' ) {
	$outline .= '<li>';
	$outline .= '<div class="wpsp-cart-button">' . do_shortcode( '[add_to_cart id="' . get_the_ID() . '" show_price="false"]' ) . '</div>';
	$outline .= '</li>';
}

if ( in_array( 'yith-woocommerce-compare/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && $compare == 'true' ) {
	$outline .= '<li>';
	$outline .= do_shortcode( '[yith_compare_button]' );
	$outline .= '</li>';
}

if ( class_exists( 'SP_Woo_Quick_View_Pro' ) && $quick_view == 'true' ) {
	$popup_close_icon        = sp_wqvpro_get_option( 'wqvpro_popup_close_icon' );
	$close_button            = sp_wqvpro_get_option( 'wqvpro_popup_close_button' );
	$gallery                 = sp_wqvpro_get_option( 'wqvpro_gallery' );
	$gallery_arrow           = sp_wqvpro_get_option( 'wqvpro_gallery_icon' );
	$auto_play               = sp_wqvpro_get_option( 'wqvpro_product_gallery_slider_auto' );
	$thumbnail_items         = sp_wqvpro_get_option( 'wqvpro_thumbnail_items' );
	$gallery_slider_nav      = sp_wqvpro_get_option( 'wqvpro_product_gallery_slider_nav' );
	$gallery_slider_nav_icon = sp_wqvpro_get_option( 'wqvpro_product_gallery_slider_nav_icon' );

	$product_gallery_pagination = sp_wqvpro_get_option( 'wqvpro_product_gallery_pagination' );
	if ( 'thumbnail' == $product_gallery_pagination ) {
		$wqvpro_gallery_thumb = 'true';
		$wqvpro_gallery_pagination = 'true';
	} elseif ( 'dots' == $product_gallery_pagination ) {
		$wqvpro_gallery_thumb = 'false';
		$wqvpro_gallery_pagination = 'true';
	} else {
		$wqvpro_gallery_thumb = 'false';
		$wqvpro_gallery_pagination = 'false';
	}

	$outline .= '<a href="#" class="button sp-wqvpro-view-button sp-wpsp-wqv-button" data-id="' . esc_attr( get_the_ID() ) . '" data-effect="' . sp_wqvpro_get_option( 'wqvpro_popup_effect' ) . '" data-wqvpro=\'{"close_button": "' . $close_button . '", "close_icon": "' . $popup_close_icon . '", "gallery": "' . $gallery . '", "gallery_arrow": "' . $gallery_arrow . '", "thumbnail": "' . $wqvpro_gallery_thumb . '", "thumbnail_items": "' . $thumbnail_items . '", "pagination": "' . $wqvpro_gallery_pagination . '", "auto_play": "' . $auto_play . '", "gallery_slider_nav": "' . $gallery_slider_nav . '", "gallery_slider_nav_icon": "' . $gallery_slider_nav_icon . '" } \'></a>';
} elseif ( class_exists( 'SP_Woo_Quick_View' ) && $quick_view == 'true' ) {
	$close_button            = sp_wqv_get_option( 'wqv_popup_close_button' );
	$outline .= '<li><a href="#" class="button sp-wqv-view-button sp-wpsp-wqv-button" data-id="' . esc_attr( get_the_ID() ) . '" data-effect="' . sp_wqv_get_option( 'wqv_popup_effect' ) . '" data-wqv=\'{"close_button": "' . $close_button . '" } \'></a></li>';
} elseif ( class_exists( 'YITH_WCQV_Frontend' ) && $quick_view == 'true' ) {
	global $woocommerce, $product;
	if ( $woocommerce->version >= '3.0' ) {
		$product_id = $product->get_id();
	} else {
		$product_id = $product->id;
	}
	$label   = esc_html( get_option( 'yith-wcqv-button-label' ) );
	$outline .= '<li><a href="#" class="yith-wcqv-button sp-wpsp-wqv-button" data-product_id="' . $product_id . '">' . $label . '</a></li>';
}

if ( in_array( 'yith-woocommerce-wishlist/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) && $wishlist == 'true' ) {
	$outline .= '<li>';
	$outline .= do_shortcode( '[yith_wcwl_add_to_wishlist]' );
	$outline .= '</li>';
}

$outline .= '</ul>';
$outline .= '</div>'; // wpsp-product-add-to-cart.

$outline .= '</div>'; // wpsp-product-image-area.
$outline .= '<div class="product-details">';
$outline .= '<div class="product-details-inner sp-text-center">';
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

$outline .= '</div>';
$outline .= '</div>';
