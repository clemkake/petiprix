<?php
/**
 * Category loop.
 *
 * @link       https://shapedplugin.com/
 * @since      2.5.0
 *
 * @package    Woo_Product_Slider_Pro
 * @subpackage Woo_Product_Slider_Pro/public/views
 */

switch ( $category_theme_style ) {
	case 'theme_one':
		$outline .= '<div class="wpsp-cat-item wpsp-masonry-item sp-text-center ' . $item_class . '">';
		$outline .= '<div class="wpspro-cat-data">';
		$outline .= '<a class="wpsp-cat-name" href="' . esc_url(
			get_term_link(
				$term->term_id
			)
		) . '">';
		$outline .= esc_html( $term->name );
		if ( 'false' == $hide_category_count ) {
			$outline .= '<span class="wpsp-cat-item-count">(' . esc_html( $term->count ) . ')</span>';
		}
		$outline .= ' </a>';
		$outline .= '</div>';
		$outline .= '</div>';
		break;
	case 'theme_two':
		$thumbnail_id  = get_woocommerce_term_meta( $term->term_id, 'thumbnail_id', true );
		$image_size    = apply_filters( 'single_product_archive_thumbnail_size', 'shop_catalog' );
		$thumbnail_img = wp_get_attachment_image_src( $thumbnail_id, $image_size );

		$outline .= '<div class="wpsp-cat-item wpsp-masonry-item sp-text-center ' . $item_class . '">';
		$outline .= '<div class="wpspro-cat-data">';

		$outline .= '<a href="' . esc_url( get_term_link( $term->term_id ) ) . '">';
		if ( $thumbnail_img ) {
			$outline .= '<img src="' . $thumbnail_img[0] . '" alt="' . esc_html( $term->name ) . '" class="wpsp-cat-image" />';
		} else {
			$outline .= '<img src="' . SP_WPSPRO_URL . '/admin/assets/images/default-placeholder.png" alt="' . esc_html( $term->name ) . '" class="wpsp-cat-image" />';
		}
		$outline .= '</a>';

		$outline .= '<a class="wpsp-cat-name" href="' . esc_url( get_term_link( $term->term_id ) ) . '">';
		$outline .= esc_html( $term->name );
		if ( 'false' == $hide_category_count ) {
			$outline .= ' (' . esc_html( $term->count ) . ')';
		}
		$outline .= ' </a>';
		$outline .= '</div>';
		$outline .= '</div>';
		break;
}
