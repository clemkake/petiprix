<?php
$attachment_ids = $product->get_gallery_image_ids();

$outline .= '<div class="wpsp-product wpsp-masonry-item ' . $item_class;
if ( $attachment_ids && $product_image_flip == 'true' ) {
	$outline .= ' wpsp-product-image-flip';
}
$outline .= '">';
$outline .= '<div class="wpspro-product-data">';
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

	include SP_WPSPRO_PATH . '/public/views/content/sale-ribbon.php';
	if ( $out_of_stock_ribbon == 'true' ) {
		if ( ! $product->is_in_stock() ) {
			$outline .= '<div class="wpsp-out-of-stock" title="' . $out_of_stock_ribbon_text . '">' . $out_of_stock_ribbon_text . '</div>';
		}
	}

	$outline .= '</a>';

	if ( $add_to_cart_button == 'true' ) {
		$outline .= '<div class="wpsp-cart-button">' . do_shortcode( '[add_to_cart id="' . get_the_ID() . '" show_price="false"]' ) . '</div>';
	}
	$outline .= '</div>';
}

$outline .= '<div class="product-details">';
$outline .= '<div class="product-details-inner">';
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

if ( $product_content == 'true' ) {
	switch ( $product_content_type ) {
		case 'short_description':
			$product_the_content = get_the_excerpt();
			break;
		case 'full_description':
			$product_the_content = get_the_content();
			break;
	}
	$short_product_content = wp_trim_words( $product_the_content, $num_words = $product_content_word_limit, $more = '' );
	$count                 = str_word_count( $product_the_content );
	$outline                     .= '<div class="sp-product-content" style="';
	if ( isset( $shortcode_data['product_description_font_load'] ) && $shortcode_data['product_description_font_load'] == 'true' ) {
		$outline .= 'font-family: ' . $product_description_typography['family'] . ';' . $this->wpspro_the_font_variants( $product_description_typography['variant'] ) . '';
	}
	$outline .= 'color: ' . $product_description_typography['color'] . ';font-size: ' . $product_description_typography['size'] . 'px;line-height: ' . $product_description_typography['height'] . 'px;text-transform: ' . $product_description_typography['transform'] . ';letter-spacing: ' . $product_description_typography['spacing'] . ';text-align: ' . $product_description_typography['alignment'] . '">' . do_shortcode( $short_product_content );
	if ( $count >= $product_content_word_limit && $product_content_more_button == 'true' ) {
		$outline .= '<div class="sp-product-more-content"><a href="' . get_the_permalink() . '">' . $product_content_more_button_text . '</a></div>';
	}
	$outline .= '</div>';
}

$outline .= '</div>'; // product-details-inner.
$outline .= '</div>'; // product-details.
$outline .= '</div>';
$outline .= '</div>';
