<?php
/**
 * This file render the shortcode to the frontend
 *
 * @package woo-product-slider-pro
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Product Slider Pro for WooCommerce - Shortcode Render class
 *
 * @since 2.4
 */
if ( ! class_exists( 'WPSPRO_Shortcode_Render' ) ) {
	class WPSPRO_Shortcode_Render {
		/**
		 * @var WPSPRO_Shortcode_Render single instance of the class
		 *
		 * @since 2.4
		 */
		protected static $_instance = null;


		/**
		 * WPSPRO_Shortcode_Render Instance
		 *
		 * @since 2.4
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
		 * WPSPRO_Shortcode_Render constructor.
		 */
		public function __construct() {
			add_shortcode( 'woo-product-slider-pro', array( $this, 'shortcode_render' ) );
		}

		/**
		 * Shortcode Render.
		 */
		public function shortcode_render( $attributes ) {
			extract(
				shortcode_atts(
					array(
						'id' => '',
					), $attributes, 'woo-product-slider-pro'
				)
			);

			$post_id = $attributes['id'];

			$shortcode_data = get_post_meta( $post_id, 'sp_wpsp_shortcode_options', true );

			// General Settings.
			$carousel_type                  = ( isset( $shortcode_data['carousel_type'] ) ? $shortcode_data['carousel_type'] : 'product_carousel' );
			$layout_preset                  = ( isset( $shortcode_data['layout_preset'] ) ? $shortcode_data['layout_preset'] : 'slider' );
			$grid_style                     = ( isset( $shortcode_data['grid_style'] ) ? $shortcode_data['grid_style'] : 'even' );
			$product_data_type              = ( isset( $shortcode_data['product_data_type'] ) ? $shortcode_data['product_data_type'] : '' );
			$theme_style                    = ( isset( $shortcode_data['theme_style'] ) ? $shortcode_data['theme_style'] : 'theme_one' );
			$category_theme_style           = ( isset( $shortcode_data['category_theme_style'] ) ? $shortcode_data['category_theme_style'] : 'theme_one' );
			$old_number_of_products         = ( isset( $shortcode_data['number_of_products'] ) ? $shortcode_data['number_of_products'] : '4' );
			$old_number_of_products_desktop = ( isset( $shortcode_data['number_of_products_desktop'] ) ? $shortcode_data['number_of_products_desktop'] : '3' );
			$old_number_of_products_tablet  = ( isset( $shortcode_data['number_of_products_tablet'] ) ? $shortcode_data['number_of_products_tablet'] : '2' );
			$old_number_of_products_mobile  = ( isset( $shortcode_data['number_of_products_mobile'] ) ? $shortcode_data['number_of_products_mobile'] : '1' );
			$columns                        = ( isset( $shortcode_data['wpsp_number_of_products'] ) ? $shortcode_data['wpsp_number_of_products'] : '' );
			$number_of_products             = ( isset( $columns['number1'] ) ? $columns['number1'] : $old_number_of_products );
			$number_of_products_desktop     = ( isset( $columns['number2'] ) ? $columns['number2'] : $old_number_of_products_desktop );
			$number_of_products_tablet      = ( isset( $columns['number3'] ) ? $columns['number3'] : $old_number_of_products_tablet );
			$number_of_products_mobile      = ( isset( $columns['number4'] ) ? $columns['number4'] : $old_number_of_products_mobile );
			$number_of_total_products       = ( isset( $shortcode_data['number_of_total_products'] ) ? $shortcode_data['number_of_total_products'] : '16' );
			$product_order_by               = ( isset( $shortcode_data['product_order_by'] ) ? $shortcode_data['product_order_by'] : 'date' );
			$product_order                  = ( isset( $shortcode_data['product_order'] ) ? $shortcode_data['product_order'] : 'DESC' );
			$product_type                   = ( isset( $shortcode_data['product_type'] ) ? $shortcode_data['product_type'] : 'latest_products' );
			$category_order_by              = ( isset( $shortcode_data['category_order_by'] ) ? $shortcode_data['category_order_by'] : 'count' );
			$category_order                 = ( isset( $shortcode_data['category_order'] ) ? $shortcode_data['category_order'] : 'DESC' );
			$wpspro_preloader               = ( isset( $shortcode_data['wpspro_preloader'] ) ? $shortcode_data['wpspro_preloader'] : 'true' );

			// Slider Controls.
			$carousel_scroll_speed         = ( isset( $shortcode_data['carousel_scroll_speed'] ) ? $shortcode_data['carousel_scroll_speed'] : '600' );
			$carousel_auto_play_speed      = ( isset( $shortcode_data['carousel_auto_play_speed'] ) ? $shortcode_data['carousel_auto_play_speed'] : '3000' );
			$pagination_type               = ( isset( $shortcode_data['pagination_type'] ) ? $shortcode_data['pagination_type'] : 'dots' );
			$pagination_number_color       = ( isset( $shortcode_data['pagination_number_color'] ) ? $shortcode_data['pagination_number_color'] : '#222222' );
			$pagination_number_hover_color = ( isset( $shortcode_data['pagination_number_hover_color'] ) ? $shortcode_data['pagination_number_hover_color'] : '#ffffff' );
			$pagination_number_hover_bg    = ( isset( $shortcode_data['pagination_number_hover_bg'] ) ? $shortcode_data['pagination_number_hover_bg'] : '#444444' );
			$pagination_dots_bg            = ( isset( $shortcode_data['pagination_dots_bg'] ) ? $shortcode_data['pagination_dots_bg'] : '#cccccc' );
			$pagination_dots_active_bg     = ( isset( $shortcode_data['pagination_dots_active_bg'] ) ? $shortcode_data['pagination_dots_active_bg'] : '#333333' );

			// Display Options.
			$slider_title                            = ( isset( $shortcode_data['slider_title'] ) ? $shortcode_data['slider_title'] : false );
			$slider_title_link                       = ( isset( $shortcode_data['slider_title_link'] ) ? $shortcode_data['slider_title_link'] : '' );
			$category_color                          = ( isset( $shortcode_data['category_color'] ) ? $shortcode_data['category_color'] : '#ffffff' );
			$category_hover_color                    = ( isset( $shortcode_data['category_hover_color'] ) ? $shortcode_data['category_hover_color'] : '#ffffff' );
			$category_bg                             = ( isset( $shortcode_data['category_bg'] ) ? $shortcode_data['category_bg'] : '#e99b05' );
			$category_hover_bg                       = ( isset( $shortcode_data['category_hover_bg'] ) ? $shortcode_data['category_hover_bg'] : '#e99b05' );
			$category_bg_2                           = ( isset( $shortcode_data['category_bg_2'] ) ? $shortcode_data['category_bg_2'] : $category_bg );
			$category_hover_bg_2                     = ( isset( $shortcode_data['category_hover_bg_2'] ) ? $shortcode_data['category_hover_bg_2'] : $category_hover_bg );
			$product_del_price_color                 = ( isset( $shortcode_data['product_del_price_color'] ) ? $shortcode_data['product_del_price_color'] : '#888888' );
			$product_rating_alignment                = ( isset( $shortcode_data['product_rating_alignment'] ) ? $shortcode_data['product_rating_alignment'] : 'sp-text-center' );
			$old_rating_color                        = ( isset( $shortcode_data['product_rating_color'] ) ? $shortcode_data['product_rating_color'] : '' );
			$old_empty_rating_color                  = ( isset( $shortcode_data['product_empty_rating_color'] ) ? $shortcode_data['product_empty_rating_color'] : '' );
			$rating_colors                           = ( isset( $shortcode_data['product_rating_colors'] ) ? $shortcode_data['product_rating_colors'] : '' );
			$product_rating_color                    = ( isset( $rating_colors['color'] ) ? $rating_colors['color'] : $old_rating_color );
			$product_empty_rating_color              = ( isset( $rating_colors['empty_color'] ) ? $rating_colors['empty_color'] : $old_empty_rating_color );
			$sale_ribbon_bg                          = ( isset( $shortcode_data['sale_ribbon_bg'] ) ? $shortcode_data['sale_ribbon_bg'] : '#1abc9c' );
			$sale_ribbon_text                        = ( isset( $shortcode_data['sale_ribbon_text'] ) ? $shortcode_data['sale_ribbon_text'] : 'On Sale!' );
			$out_of_stock_ribbon_bg                  = ( isset( $shortcode_data['out_of_stock_ribbon_bg'] ) ? $shortcode_data['out_of_stock_ribbon_bg'] : '#fd5a27' );
			$out_of_stock_ribbon_text                = ( isset( $shortcode_data['out_of_stock_ribbon_text'] ) ? $shortcode_data['out_of_stock_ribbon_text'] : 'Out of Stock' );
			$add_to_cart_button_color                = ( isset( $shortcode_data['add_to_cart_button_color'] ) ? $shortcode_data['add_to_cart_button_color'] : '#444444' );
			$add_to_cart_border_radius               = ( isset( $shortcode_data['add_to_cart_border_radius'] ) ? $shortcode_data['add_to_cart_border_radius'] : 0 );
			$add_to_cart_button_bg                   = ( isset( $shortcode_data['add_to_cart_button_bg'] ) ? $shortcode_data['add_to_cart_button_bg'] : 'transparent' );
			$add_to_cart_button_border_color         = ( isset( $shortcode_data['add_to_cart_button_border_color'] ) ? $shortcode_data['add_to_cart_button_border_color'] : '#222222' );
			$add_to_cart_button_hover_color          = ( isset( $shortcode_data['add_to_cart_button_hover_color'] ) ? $shortcode_data['add_to_cart_button_hover_color'] : '#ffffff' );
			$add_to_cart_button_hover_bg             = ( isset( $shortcode_data['add_to_cart_button_hover_bg'] ) ? $shortcode_data['add_to_cart_button_hover_bg'] : '#222222' );
			$add_to_cart_button_hover_border_color   = ( isset( $shortcode_data['add_to_cart_button_hover_border_color'] ) ? $shortcode_data['add_to_cart_button_hover_border_color'] : '#222222' );
			$add_to_cart_border_size                 = ( isset( $shortcode_data['add_to_cart_border_size'] ) ? $shortcode_data['add_to_cart_border_size'] : 1 );
			$product_content_word_limit              = ( isset( $shortcode_data['product_content_word_limit'] ) ? $shortcode_data['product_content_word_limit'] : 19 );
			$product_content_more_button_text        = ( isset( $shortcode_data['product_content_more_button_text'] ) ? $shortcode_data['product_content_more_button_text'] : 'Read More' );
			$product_content_more_button_color       = ( isset( $shortcode_data['product_content_more_button_color'] ) ? $shortcode_data['product_content_more_button_color'] : '#e74c3c' );
			$product_content_more_button_hover_color = ( isset( $shortcode_data['product_content_more_button_hover_color'] ) ? $shortcode_data['product_content_more_button_hover_color'] : '#e8210b' );
			$product_margin                          = ( isset( $shortcode_data['product_margin'] ) ? $shortcode_data['product_margin'] : 20 );
			$category_margin                         = ( isset( $shortcode_data['category_margin'] ) ? $shortcode_data['category_margin'] : 20 );
			$product_border_size                     = ( isset( $shortcode_data['product_border_size'] ) ? $shortcode_data['product_border_size'] : 1 );
			$product_border_color                    = ( isset( $shortcode_data['product_border_color'] ) ? $shortcode_data['product_border_color'] : '#dddddd' );
			$product_button_border_color             = ( isset( $shortcode_data['product_button_border_color'] ) ? $shortcode_data['product_button_border_color'] : '#222222' );
			$product_hover_border_color              = ( isset( $shortcode_data['product_hover_border_color'] ) ? $shortcode_data['product_hover_border_color'] : '#dddddd' );
			$product_top_info_bg                     = ( isset( $shortcode_data['product_top_info_bg'] ) ? $shortcode_data['product_top_info_bg'] : '#ddd' );
			$product_info_bg                         = ( isset( $shortcode_data['product_info_bg'] ) ? $shortcode_data['product_info_bg'] : '#ffffff' );
			$product_info_hover_bg                   = ( isset( $shortcode_data['product_info_hover_bg'] ) ? $shortcode_data['product_info_hover_bg'] : '#ffffff' );
			$product_info_gradient                   = ( isset( $shortcode_data['product_info_gradient'] ) ? $shortcode_data['product_info_gradient'] : '#000' );
			$product_overlay_bg                      = ( isset( $shortcode_data['product_overlay_bg'] ) ? $shortcode_data['product_overlay_bg'] : 'rgba(10,10,10,0.50)' );
			$view_detail_button_text                 = ( isset( $shortcode_data['view_detail_button_text'] ) ? $shortcode_data['view_detail_button_text'] : 'View Detail' );
			$view_detail_button_color                = ( isset( $shortcode_data['view_detail_button_color'] ) ? $shortcode_data['view_detail_button_color'] : '#444444' );
			$view_detail_button_bg                   = ( isset( $shortcode_data['view_detail_button_bg'] ) ? $shortcode_data['view_detail_button_bg'] : 'transparent' );
			$view_detail_border_size                 = ( isset( $shortcode_data['view_detail_border_size'] ) ? $shortcode_data['view_detail_border_size'] : 1 );
			$view_detail_border_color                = ( isset( $shortcode_data['view_detail_border_color'] ) ? $shortcode_data['view_detail_border_color'] : '#222222' );
			$view_detail_button_hover_color          = ( isset( $shortcode_data['view_detail_button_hover_color'] ) ? $shortcode_data['view_detail_button_hover_color'] : '#ffffff' );
			$view_detail_button_hover_bg             = ( isset( $shortcode_data['view_detail_button_hover_bg'] ) ? $shortcode_data['view_detail_button_hover_bg'] : '#222222' );
			$view_detail_button_hover_border_color   = ( isset( $shortcode_data['view_detail_button_hover_border_color'] ) ? $shortcode_data['view_detail_button_hover_border_color'] : '#222222' );
			$wishlist_button_color                   = ( isset( $shortcode_data['wishlist_button_color'] ) ? $shortcode_data['wishlist_button_color'] : '#444444' );
			$wishlist_button_bg                      = ( isset( $shortcode_data['wishlist_button_bg'] ) ? $shortcode_data['wishlist_button_bg'] : 'transparent' );
			$wishlist_border_size                    = ( isset( $shortcode_data['wishlist_border_size'] ) ? $shortcode_data['wishlist_border_size'] : 1 );
			$wishlist_button_border_color            = ( isset( $shortcode_data['wishlist_button_border_color'] ) ? $shortcode_data['wishlist_button_border_color'] : '#222222' );
			$wishlist_button_hover_color             = ( isset( $shortcode_data['wishlist_button_hover_color'] ) ? $shortcode_data['wishlist_button_hover_color'] : '#ffffff' );
			$wishlist_button_hover_bg                = ( isset( $shortcode_data['wishlist_button_hover_bg'] ) ? $shortcode_data['wishlist_button_hover_bg'] : '#222222' );
			$wishlist_button_hover_border_color      = ( isset( $shortcode_data['wishlist_button_hover_border_color'] ) ? $shortcode_data['wishlist_button_hover_border_color'] : '#222222' );
			$compare_button_color                    = ( isset( $shortcode_data['compare_button_color'] ) ? $shortcode_data['compare_button_color'] : '#444444' );
			$compare_button_hover_color              = ( isset( $shortcode_data['compare_button_hover_color'] ) ? $shortcode_data['compare_button_hover_color'] : '#ffffff' );
			$quick_view_button_color                 = ( isset( $shortcode_data['quick_view_button_color'] ) ? $shortcode_data['quick_view_button_color'] : '#444444' );
			$quick_view_button_bg                    = ( isset( $shortcode_data['quick_view_button_bg'] ) ? $shortcode_data['quick_view_button_bg'] : 'transparent' );
			$quick_view_border_size                  = ( isset( $shortcode_data['quick_view_border_size'] ) ? $shortcode_data['quick_view_border_size'] : '1' );
			$quick_view_button_border_color          = ( isset( $shortcode_data['quick_view_button_border_color'] ) ? $shortcode_data['quick_view_button_border_color'] : '#222222' );
			$quick_view_button_hover_color           = ( isset( $shortcode_data['quick_view_button_hover_color'] ) ? $shortcode_data['quick_view_button_hover_color'] : '#ffffff' );
			$quick_view_button_hover_bg              = ( isset( $shortcode_data['quick_view_button_hover_bg'] ) ? $shortcode_data['quick_view_button_hover_bg'] : '#222222' );
			$quick_view_button_hover_border_color    = ( isset( $shortcode_data['quick_view_button_hover_border_color'] ) ? $shortcode_data['quick_view_button_hover_border_color'] : '#222222' );
			$navigation_position                     = ( isset( $shortcode_data['navigation_position'] ) ? $shortcode_data['navigation_position'] : 'top_right' );
			$navigation_border_radius                = ( isset( $shortcode_data['navigation_border_radius'] ) ? $shortcode_data['navigation_border_radius'] : '0px' );
			$navigation_arrow_type                   = ( isset( $shortcode_data['navigation_arrow_type'] ) ? $shortcode_data['navigation_arrow_type'] : 'angle' );
			$product_box_shadow_color                = ( isset( $shortcode_data['product_box_shadow_color'] ) ? $shortcode_data['product_box_shadow_color'] : '#dddddd' );
			$product_box_shadow_hover_color          = ( isset( $shortcode_data['product_box_shadow_hover_color'] ) ? $shortcode_data['product_box_shadow_hover_color'] : '#dddddd' );
			$grid_pagination                         = ( isset( $shortcode_data['grid_pagination'] ) ? $shortcode_data['grid_pagination'] : 'true' );
			$grid_pagination_type                    = ( isset( $shortcode_data['grid_pagination_type'] ) ? $shortcode_data['grid_pagination_type'] : 'normal' );
			$grid_pagination_alignment               = ( isset( $shortcode_data['grid_pagination_alignment'] ) ? $shortcode_data['grid_pagination_alignment'] : 'wpspro-align-center' );
			$grid_load_more_text                     = ( isset( $shortcode_data['grid_load_more_text'] ) ? $shortcode_data['grid_load_more_text'] : 'Load More' );
			$products_per_page                       = ( isset( $shortcode_data['products_per_page'] ) ? $shortcode_data['products_per_page'] : '8' );
			$hide_category_count                     = ( isset( $shortcode_data['hide_category_count'] ) && $shortcode_data['hide_category_count'] == true ? 'true' : 'false' );
			$compare                                 = ( isset( $shortcode_data['compare'] ) && $shortcode_data['compare'] == true ? 'true' : 'false' );
			$wishlist                                = ( isset( $shortcode_data['wishlist'] ) && $shortcode_data['wishlist'] == true ? 'true' : 'false' );
			$quick_view                              = ( isset( $shortcode_data['quick_view'] ) && $shortcode_data['quick_view'] == true ? 'true' : 'false' );
			$product_cat                             = ( isset( $shortcode_data['product_cat'] ) && $shortcode_data['product_cat'] == true ? 'true' : 'false' );
			$view_detail_button                      = ( isset( $shortcode_data['view_detail_button'] ) && $shortcode_data['view_detail_button'] == true ? 'true' : 'false' );
			$product_border                          = ( isset( $shortcode_data['product_border'] ) && $shortcode_data['product_border'] == true ? 'true' : 'false' );
			$product_content_more_button             = ( isset( $shortcode_data['product_content_more_button'] ) && $shortcode_data['product_content_more_button'] == true ? 'true' : 'false' );
			$product_content                         = ( isset( $shortcode_data['product_content'] ) && $shortcode_data['product_content'] == true ? 'true' : 'false' );
			$product_content_type                    = ( isset( $shortcode_data['product_content_type'] ) ? $shortcode_data['product_content_type'] : 'short_description' );
			$hide_free_product                       = ( isset( $shortcode_data['hide_free_product'] ) && $shortcode_data['hide_free_product'] == true ? 'true' : 'false' );
			$hide_on_sale_product                    = ( isset( $shortcode_data['hide_on_sale_product'] ) && true == $shortcode_data['hide_on_sale_product'] ? 'true' : 'false' );
			$hide_out_of_stock_product               = ( isset( $shortcode_data['hide_out_of_stock_product'] ) && $shortcode_data['hide_out_of_stock_product'] == true ? 'true' : 'false' );
			$show_hidden_product                     = ( isset( $shortcode_data['show_hidden_product'] ) && $shortcode_data['show_hidden_product'] == true ? 'true' : 'false' );
			$add_to_cart_button                      = ( isset( $shortcode_data['add_to_cart_button'] ) && $shortcode_data['add_to_cart_button'] == true ? 'true' : 'false' );
			$sale_ribbon                             = ( isset( $shortcode_data['sale_ribbon'] ) && $shortcode_data['sale_ribbon'] == true ? 'true' : 'false' );
			$out_of_stock_ribbon                     = ( isset( $shortcode_data['out_of_stock_ribbon'] ) && $shortcode_data['out_of_stock_ribbon'] == true ? 'true' : 'false' );
			$product_rating                          = ( isset( $shortcode_data['product_rating'] ) && $shortcode_data['product_rating'] == true ? 'true' : 'false' );
			$product_price                           = ( isset( $shortcode_data['product_price'] ) && $shortcode_data['product_price'] == true ? 'true' : 'false' );
			$product_name                            = ( isset( $shortcode_data['product_name'] ) && $shortcode_data['product_name'] == true ? 'true' : 'false' );
			$wpsp_image_lightbox                     = ( isset( $shortcode_data['image_lightbox'] ) && $shortcode_data['image_lightbox'] == true ? 'true' : 'false' );

			// Image Settings.
			$image_border             = ( isset( $shortcode_data['image_border'] ) && $shortcode_data['image_border'] == true ? 'true' : 'false' );
			$image_border_size        = ( isset( $shortcode_data['image_border_size'] ) ? $shortcode_data['image_border_size'] : '1' );
			$image_border_color       = ( isset( $shortcode_data['image_border_color'] ) ? $shortcode_data['image_border_color'] : '#dddddd' );
			$image_hover_border_color = ( isset( $shortcode_data['image_hover_border_color'] ) ? $shortcode_data['image_hover_border_color'] : '#dddddd' );
			$image_sizes              = ( isset( $shortcode_data['wpspro_image_sizes'] ) ? $shortcode_data['wpspro_image_sizes'] : 'custom' );
			$width                    = ( isset( $shortcode_data['product_image_width'] ) ? $shortcode_data['product_image_width'] : '250' );
			$height                   = ( isset( $shortcode_data['product_image_height'] ) ? $shortcode_data['product_image_height'] : '300' );
			$placeholder_image        = ( isset( $shortcode_data['wpsp_placeholder_image'] ) ? $shortcode_data['wpsp_placeholder_image'] : '' );
			$image_gray_scale         = ( isset( $shortcode_data['image_gray_scale'] ) ? $shortcode_data['image_gray_scale'] : '' );
			$image_title_attr         = ( isset( $shortcode_data['image_title_attr'] ) && true == $shortcode_data['image_title_attr'] ? 'true' : 'false' );
			$product_image            = ( isset( $shortcode_data['product_image'] ) && $shortcode_data['product_image'] == true ? 'true' : 'false' );
			$crop                     = ( isset( $shortcode_data['product_image_crop'] ) && $shortcode_data['product_image_crop'] == true ? true : false );

			// Navigation.
			$navigation_data = ( isset( $shortcode_data['navigation_arrow'] ) ? $shortcode_data['navigation_arrow'] : '' );
			switch ( $navigation_data ) {
				case 'true':
					$navigation        = 'true';
					$navigation_mobile = 'true';
					break;
				case 'hide_on_mobile':
					$navigation        = 'true';
					$navigation_mobile = 'false';
					break;
				default:
					$navigation        = 'false';
					$navigation_mobile = 'false';
			}

			$product_image_flip = isset( $shortcode_data['product_image_flip'] ) && $shortcode_data['product_image_flip'] == true ? 'true' : 'false';

			if ( 'true' == $navigation || 'true' == $navigation_mobile ) {
				$old_nav_color              = ( isset( $shortcode_data['navigation_arrow_color'] ) ? $shortcode_data['navigation_arrow_color'] : '' );
				$old_nav_hover_color        = ( isset( $shortcode_data['navigation_arrow_hover_color'] ) ? $shortcode_data['navigation_arrow_hover_color'] : '' );
				$old_nav_bg                 = ( isset( $shortcode_data['navigation_arrow_bg'] ) ? $shortcode_data['navigation_arrow_bg'] : '' );
				$old_nav_hover_bg           = ( isset( $shortcode_data['navigation_arrow_hover_bg'] ) ? $shortcode_data['navigation_arrow_hover_bg'] : '' );
				$old_nav_border_color       = ( isset( $shortcode_data['navigation_arrow_border_color'] ) ? $shortcode_data['navigation_arrow_border_color'] : '' );
				$old_nav_border_hover_color = ( isset( $shortcode_data['navigation_arrow_border_hover_color'] ) ? $shortcode_data['navigation_arrow_border_hover_color'] : '' );

				$nav_colors                          = ( isset( $shortcode_data['navigation_arrow_colors'] ) ? $shortcode_data['navigation_arrow_colors'] : '' );
				$navigation_arrow_color              = ( isset( $nav_colors['color'] ) ? $nav_colors['color'] : $old_nav_color );
				$navigation_arrow_hover_color        = ( isset( $nav_colors['hover_color'] ) ? $nav_colors['hover_color'] : $old_nav_hover_color );
				$navigation_arrow_bg                 = ( isset( $nav_colors['background'] ) ? $nav_colors['background'] : $old_nav_bg );
				$navigation_arrow_hover_bg           = ( isset( $nav_colors['hover_background'] ) ? $nav_colors['hover_background'] : $old_nav_hover_bg );
				$navigation_arrow_border_color       = ( isset( $nav_colors['border'] ) ? $nav_colors['border'] : $old_nav_border_color );
				$navigation_arrow_border_hover_color = ( isset( $nav_colors['hover_border'] ) ? $nav_colors['hover_border'] : $old_nav_border_hover_color );
			}

			// Pagination.
			$pagination_data = ( isset( $shortcode_data['pagination'] ) ? $shortcode_data['pagination'] : '' );
			switch ( $pagination_data ) {
				case 'true':
					$pagination        = 'true';
					$pagination_mobile = 'true';
					break;
				case 'hide_on_mobile':
					$pagination        = 'true';
					$pagination_mobile = 'false';
					break;
				default:
					$pagination        = 'false';
					$pagination_mobile = 'false';
			}

			$carousel_ticker_mode           = ( isset( $shortcode_data['carousel_ticker_mode'] ) && $shortcode_data['carousel_ticker_mode'] == true ? 'true' : 'false' );
			$carousel_auto_play             = ( isset( $shortcode_data['carousel_auto_play'] ) && $shortcode_data['carousel_auto_play'] == true ? 'true' : 'false' );
			$old_slides_to_scroll           = ( isset( $shortcode_data['number_of_slides_to_scroll'] ) ? $shortcode_data['number_of_slides_to_scroll'] : '1' );
			$old_slides_to_scroll_on_mobile = ( isset( $shortcode_data['number_of_slides_to_scroll_on_mobile'] ) ? $shortcode_data['number_of_slides_to_scroll_on_mobile'] : '1' );
			$wpsp_slider_row                = ( isset( $shortcode_data['wpsp_slider_row'] ) ? $shortcode_data['wpsp_slider_row'] : '' );
			$wpsp_scrolls                   = ( isset( $shortcode_data['wpsp_slides_to_scroll'] ) ? $shortcode_data['wpsp_slides_to_scroll'] : '' );
			$wpsp_slides_to_scroll          = ( isset( $wpsp_scrolls['number1'] ) ? $wpsp_scrolls['number1'] : $old_slides_to_scroll );
			$wpsp_slides_to_scroll_desktop  = ( isset( $wpsp_scrolls['number2'] ) ? $wpsp_scrolls['number2'] : $old_slides_to_scroll );
			$wpsp_slides_to_scroll_tablet   = ( isset( $wpsp_scrolls['number3'] ) ? $wpsp_scrolls['number3'] : $old_slides_to_scroll );
			$wpsp_slides_to_scroll_moile    = ( isset( $wpsp_scrolls['number4'] ) ? $wpsp_scrolls['number4'] : $old_slides_to_scroll_on_mobile );
			$carousel_pause_on_hover        = ( isset( $shortcode_data['carousel_pause_on_hover'] ) && $shortcode_data['carousel_pause_on_hover'] == true ? 'true' : 'false' );
			$carousel_infinite              = ( isset( $shortcode_data['carousel_infinite'] ) && $shortcode_data['carousel_infinite'] == true ? 'true' : 'false' );
			$carousel_swipe                 = ( isset( $shortcode_data['carousel_swipe'] ) && $shortcode_data['carousel_swipe'] == true ? 'true' : 'false' );
			$carousel_draggable             = ( isset( $shortcode_data['carousel_draggable'] ) && $shortcode_data['carousel_draggable'] == true ? 'true' : 'false' );
			$rtl_mode                       = ( isset( $shortcode_data['rtl_mode'] ) && $shortcode_data['rtl_mode'] == true ? 'true' : 'false' );
			$the_rtl                        = ( 'true' === $rtl_mode ) ? ' dir="rtl"' : ' dir="ltr"';

			// Responsive screen sizes.
			$wpspro_screen_sizes = sp_get_option( 'wpspro_screen_sizes_setting' );
			$small_desktop_size  = isset( $wpspro_screen_sizes['number1'] ) ? $wpspro_screen_sizes['number1'] : '1100';
			$tablet_size         = isset( $wpspro_screen_sizes['number2'] ) ? $wpspro_screen_sizes['number2'] : '990';
			$mobile_size         = isset( $wpspro_screen_sizes['number3'] ) ? $wpspro_screen_sizes['number3'] : '650';

			/**
			 * Typography
			 */
			$product_name_typography        = $shortcode_data['product_name_typography'];
			$product_description_typography = $shortcode_data['product_description_typography'];
			$product_price_typography       = $shortcode_data['product_price_typography'];
			$sale_ribbon_typography         = $shortcode_data['sale_ribbon_typography'];
			$out_of_stock_ribbon_typography = $shortcode_data['out_of_stock_ribbon_typography'];
			$product_category_typography    = $shortcode_data['product_category_typography'];
			$compare_wishlist_typography    = $shortcode_data['compare_wishlist_typography'];
			$add_to_cart_typography         = $shortcode_data['add_to_cart_typography'];
			$category_carousel_typography   = $shortcode_data['category_carousel_typography'];
			$slider_title_typography        = $shortcode_data['slider_title_typography'];

			$google_fonts = ( sp_get_option( 'google_fonts' ) == true ? 'true' : 'false' );

			if ( 'false' == $google_fonts ) {
				/**
				 * Google font link enqueue
				 */
				$custom_id         = uniqid();
				$enqueue_fonts     = array();
				$wpsp_typography   = array();
				$wpsp_typography[] = $shortcode_data['product_name_typography'];
				$wpsp_typography[] = $shortcode_data['product_description_typography'];
				$wpsp_typography[] = $shortcode_data['product_price_typography'];
				$wpsp_typography[] = $shortcode_data['sale_ribbon_typography'];
				$wpsp_typography[] = $shortcode_data['out_of_stock_ribbon_typography'];
				$wpsp_typography[] = $shortcode_data['product_category_typography'];
				$wpsp_typography[] = $shortcode_data['compare_wishlist_typography'];
				$wpsp_typography[] = $shortcode_data['add_to_cart_typography'];
				$wpsp_typography[] = $shortcode_data['category_carousel_typography'];
				$wpsp_typography[] = $shortcode_data['slider_title_typography'];

				if ( ! empty( $wpsp_typography ) ) {
					foreach ( $wpsp_typography as $font ) {
						if ( isset( $font['font'] ) && $font['font'] == 'google' ) {
							$variant         = ( isset( $font['variant'] ) && $font['variant'] !== 'regular' ) ? ':' . $font['variant'] : '';
							$enqueue_fonts[] = $font['family'] . $variant;
						}
					}
				}
				if ( ! empty( $enqueue_fonts ) ) {
					wp_enqueue_style( 'sp-wpsp-google-fonts' . $custom_id, esc_url( add_query_arg( 'family', urlencode( implode( '|', $enqueue_fonts ) ), '//fonts.googleapis.com/css' ) ), array(), '1.0', false );
				}
			}

			$products_from_exclude_category = isset( $shortcode_data['products_from_exclude_category'] ) ? $shortcode_data['products_from_exclude_category'] : '';
			$product_from_category          = isset( $shortcode_data['product_from_category'] ) ? $shortcode_data['product_from_category'] : '';
			$products_from_tag              = isset( $shortcode_data['products_from_tag'] ) ? $shortcode_data['products_from_tag'] : '';
			$products_from_exclude_tag      = isset( $shortcode_data['products_from_exclude_tag'] ) ? $shortcode_data['products_from_exclude_tag'] : '';
			$product_sku                    = isset( $shortcode_data['product_sku'] ) ? $shortcode_data['product_sku'] : '';
			$product_attribute              = isset( $shortcode_data['product_attribute'] ) ? $shortcode_data['product_attribute'] : '';
			$product_attribute_terms        = isset( $shortcode_data['product_attribute_terms'] ) ? $shortcode_data['product_attribute_terms'] : '';

			if ( 'product_carousel' === $carousel_type ) {

				$posts_per_page = $number_of_total_products;
				if ( 'true' == $grid_pagination && 'grid' == $layout_preset ) {
					$posts_per_page = $products_per_page;
				}

				if ( 'specific_products' === $product_type && ! empty( $shortcode_data['specific_product'] ) ) {
					$viewed_products = $shortcode_data['specific_product'];
				} elseif ( 'on_sell_products' === $product_type ) {
					$on_sale_product_ids   = wc_get_product_ids_on_sale();
					$on_sale_product_ids[] = 0;
					$viewed_products       = $on_sale_product_ids;
				} else {
					$viewed_products = null;
				}

				switch ( $product_type ) {
					case 'recently_viewed_products':
						$arg               = array(
							'post_type'      => 'product',
							'post_status'    => 'publish',
							'orderby'        => 'wpspro_recent_view_time',
							'order'          => 'DESC',
							'fields'         => 'ids',
							'posts_per_page' => $number_of_total_products,
						);
						$arg['meta_query'] = array(
							array(
								'key'     => 'wpspro_recent_view_time',
								'value'   => '',
								'compare' => '!=',
							),
						);
						$product_order_by  = 'wpspro_recent_view_time';
						break;
					case 'best_selling_products':
					case 'top_rated_products':
					case 'most_viewed_products':
						$arg              = array(
							'post_type'      => 'product',
							'post_status'    => 'publish',
							'orderby'        => 'meta_value_num',
							'order'          => 'DESC',
							'fields'         => 'ids',
							'posts_per_page' => $number_of_total_products,
						);
						$product_order_by = 'meta_value_num';
						break;
					case 'related_products':
						global $product;
						$related_products = array( '0000000' );
						if ( is_product() ) {
							$related_product_list = wc_get_related_products( $product->get_id(), $number_of_total_products, $product->get_upsell_ids() );
							$related_products     = ! empty( $related_product_list ) ? $related_product_list : $related_products;
						}
						$arg = array(
							'post_type'           => 'product',
							'post_status'         => 'publish',
							'post__not_in'        => array( get_the_ID() ),
							'post__in'            => $related_products,
							'orderby'             => 'date',
							'order'               => 'DESC',
							'fields'              => 'ids',
							'posts_per_page'      => $number_of_total_products,
							'ignore_sticky_posts' => 1,
						);
						break;
					case 'up_sells':
						global $product;
						$upsells = ( is_product() ) ? $product->get_upsell_ids() : '';
						if ( count( $upsells ) !== 0 && is_product() ) {
							$meta_query = WC()->query->get_meta_query();
							$arg        = array(
								'post_type'      => 'product',
								'post_status'    => 'publish',
								'orderby'        => 'post__in',
								'order'          => 'DESC',
								'fields'         => 'ids',
								'post__in'       => $upsells,
								'post__not_in'   => array( $product->get_id() ),
								'posts_per_page' => $number_of_total_products,
								'meta_query'     => $meta_query,
							);
						};
						break;
					case 'cross_sells':
						global $product;
						$cross_sells = WC()->cart->get_cross_sells();
						if ( count( $cross_sells ) !== 0 ) {
							$arg = array(
								'post_type'      => 'product',
								'post_status'    => 'publish',
								'orderby'        => 'post__in',
								'order'          => 'DESC',
								'fields'         => 'ids',
								'post__in'       => $cross_sells,
								'posts_per_page' => $number_of_total_products,
							);
						};
						break;
					default:
						$arg = array(
							'post_type'      => 'product',
							'post_status'    => 'publish',
							'orderby'        => 'date',
							'order'          => 'DESC',
							'fields'         => 'ids',
							'post__in'       => $viewed_products,
							'posts_per_page' => $number_of_total_products,
						);
						break;
				}

				switch ( $product_type ) {
					case 'products_from_categories':
					case 'best_selling_products':
					case 'most_viewed_products':
					case 'on_sell_products':
					case 'products_from_free':
					case 'featured_products':
					case 'top_rated_products':
					case 'recently_viewed_products':
						if ( ! empty( $product_from_category ) ) {
							$arg['tax_query'][] = array(
								'taxonomy' => 'product_cat',
								'field'    => 'term_id',
								'terms'    => $product_from_category,
								'operator' => 'IN',
							);
						}
						break;
					case 'products_from_exclude_categories':
						$arg['tax_query'][] = array(
							'taxonomy' => 'product_cat',
							'field'    => 'term_id',
							'terms'    => $products_from_exclude_category,
							'operator' => 'NOT IN',
						);
						break;
					case 'products_from_tags':
						$arg['tax_query'][] = array(
							'taxonomy' => 'product_tag',
							'field'    => 'term_id',
							'terms'    => $products_from_tag,
							'operator' => 'IN',
						);
						break;
					case 'products_from_exclude_tags':
						$arg['tax_query'][] = array(
							'taxonomy' => 'product_tag',
							'field'    => 'term_id',
							'terms'    => $products_from_exclude_tag,
							'operator' => 'NOT IN',
						);
						break;
					case 'products_from_sku':
						$arg['meta_query'][] = array(
							'key'     => '_sku',
							'value'   => $product_sku,
							'compare' => 'IN',
						);
						break;
					case 'products_from_attribute':
						$arg['tax_query'][] = array(
							'taxonomy' => $product_attribute,
							'terms'    => $product_attribute_terms,
							'field'    => 'slug',
							'operator' => 'IN',
						);
						break;
				}

				switch ( $product_type ) {
					case 'top_rated_products':
						$arg['meta_query'][] = array(
							array(
								'key'     => '_wc_average_rating',
								'value'   => 0,
								'compare' => '>',
							),
						);
						break;
					case 'featured_products':
						$product_visibility_term_ids = wc_get_product_visibility_term_ids();
						$arg['tax_query'][]          = array(
							'taxonomy' => 'product_visibility',
							'field'    => 'term_taxonomy_id',
							'terms'    => $product_visibility_term_ids['featured'],
						);
						break;
					case 'most_viewed_products':
						$count_key         = 'sp_wpsp_product_view_count';
						$arg['meta_query'] = array(
							array(
								'key'     => $count_key,
								'value'   => '0',
								'type'    => 'numeric',
								'compare' => '>',
							),
						);
						break;
					case 'best_selling_products':
						$arg['meta_query'][] = array(
							array(
								'key'     => 'total_sales',
								'value'   => 0,
								'compare' => '>',
							),
						);
						break;
				}
				if ( 'true' === $hide_on_sale_product ) {
					$arg['meta_query'][] = array(
						'key'     => '_sale_price',
						'value'   => '',
						'compare' => '=',
					);
				}
				if ( 'products_from_free' === $product_type ) {
					$arg['meta_query'][] = array(
						'key'     => '_price',
						'value'   => '0',
						'compare' => '<=',
					);
				} elseif ( 'true' === $hide_free_product ) {
					$arg['meta_query'][] = array(
						'key'     => '_price',
						'value'   => 0,
						'compare' => '>',
						'type'    => 'DECIMAL',
					);
				}

				// Product from product type.
				if ( $product_type == 'latest_products' || 'featured_products' || 'products_from_categories' || 'products_from_exclude_categories' || 'products_from_tags' || 'products_from_exclude_tags' || 'best_selling_products' || 'top_rated_products' || 'on_sell_products' ) {
					if ( 'all' !== $product_data_type && '' !== $product_data_type ) {
						$arg['tax_query'][] = array(
							'taxonomy' => 'product_type',
							'field'    => 'slug',
							'terms'    => $product_data_type,
						);
					}
				}

				if ( $show_hidden_product !== 'true' ) {
					$product_visibility_term_ids = wc_get_product_visibility_term_ids();
					$arg['tax_query'][]          = array(
						'taxonomy' => 'product_visibility',
						'field'    => 'term_taxonomy_id',
						'terms'    => is_search() ? $product_visibility_term_ids['exclude-from-search'] : $product_visibility_term_ids['exclude-from-catalog'],
						'operator' => 'NOT IN',
					);
					$arg['post_parent']          = 0;
				}

				if ( $hide_out_of_stock_product == 'true' ) {
					$product_visibility_term_ids = wc_get_product_visibility_term_ids();
					$arg['tax_query'][]          = array(
						'taxonomy' => 'product_visibility',
						'field'    => 'term_taxonomy_id',
						'terms'    => $product_visibility_term_ids['outofstock'],
						'operator' => 'NOT IN',
					);
				}

				$viewed_products = get_posts(
					$arg
				);
				if ( 'DESC' === $product_order ) {
					krsort( $viewed_products, SORT_STRING );
				}

				$args = [];
				if ( $viewed_products ) {
					$args = array(
						'post_type'      => 'product',
						'post_status'    => 'publish',
						'orderby'        => $product_order_by,
						'order'          => $product_order,
						'post__in'       => $viewed_products,
						'posts_per_page' => $posts_per_page,
					);
					if ( 'true' == $grid_pagination && 'grid' == $layout_preset ) {
						if ( is_front_page() ) {
							$paged_query = 'page' . $post_id;
						} else {
							$paged_query = 'paged' . $post_id;
						}
						$paged      = ( ! empty( $_GET[ "$paged_query" ] ) ) ? $_GET[ "$paged_query" ] : 1;
						$paged_args = array(
							'paged' => $paged,
						);
						$args       = array_merge( $args, $paged_args );
					}
				}

				$que = new WP_Query( $args );
			} //Product Carousel args.

			/**
			 * Infinite Scroll js.
			 */
			if ( 'load_more_btn' == $grid_pagination_type && 'true' == $grid_pagination && 'grid' == $layout_preset || 'load_more_scroll' == $grid_pagination_type && 'true' == $grid_pagination && 'grid' == $layout_preset ) {
				wp_enqueue_script( 'sp-wpsp-infinite-scroll-js' );
			}

			$outline = '';

			include SP_WPSPRO_PATH . '/public/views/dynamic-style.php';

			$slider_data      = ' data-layout="' . $layout_preset . '" data-pagination="' . $grid_pagination_type . '" data-preloader="' . $wpspro_preloader . '" data-lightbox="' . $wpsp_image_lightbox . '"';
			$item_class       = ( 'grid' == $layout_preset ) ? 'sp-wpspro-col-xl-' . $number_of_products . ' sp-wpspro-col-lg-' . $number_of_products_desktop . ' sp-wpspro-col-md-' . $number_of_products_tablet . ' sp-wpspro-col-sm-' . $number_of_products_mobile . '' : '';
			$grid_style_class = ( 'grid' == $layout_preset ) ? ' grid_style_' . $grid_style : '';

			if ( 'slider' == $layout_preset && 'product_carousel' == $carousel_type || 'slider' == $layout_preset && 'category_carousel' == $carousel_type ) {

				wp_enqueue_style( 'sp-wpsp-slick' );
				wp_enqueue_script( 'sp-wpsp-slick-min-js' );

				if ( 'false' === $carousel_ticker_mode ) {
					$slides_to_scroll           = $wpsp_slides_to_scroll;
					$slides_to_scroll_desktop   = $wpsp_slides_to_scroll_desktop;
					$slides_to_scroll_tablet    = $wpsp_slides_to_scroll_tablet;
					$slides_to_scroll_on_mobile = $wpsp_slides_to_scroll_moile;
					$dots_mobile                = $pagination_mobile;
					$nav_mobile                 = $navigation_mobile;
					$swipe                      = $carousel_swipe;
					$draggable                  = $carousel_draggable;
					$autoplay                   = $carousel_auto_play;
					$autoplay_speed             = $carousel_auto_play_speed;
					$pagination_dots            = $pagination;
					$navigation_arrows          = $navigation;
					$css_ease                   = 'ease';
				} else {
					$slides_to_scroll           = 1;
					$slides_to_scroll_desktop   = 1;
					$slides_to_scroll_tablet    = 1;
					$slides_to_scroll_on_mobile = 1;
					$dots_mobile                = 'false';
					$nav_mobile                 = 'false';
					$autoplay_speed             = 0;
					$swipe                      = 'false';
					$draggable                  = 'false';
					$autoplay                   = 'true';
					$css_ease                   = 'linear';
					$pagination_dots            = 'false';
					$navigation_arrows          = 'false';
				}
				$row_large_desktop = isset( $wpsp_slider_row['number1'] ) ? $wpsp_slider_row['number1'] : 1;
				$row_desktop       = isset( $wpsp_slider_row['number2'] ) ? $wpsp_slider_row['number2'] : 1;
				$row_tablet        = isset( $wpsp_slider_row['number3'] ) ? $wpsp_slider_row['number3'] : 1;
				$row_mobile        = isset( $wpsp_slider_row['number4'] ) ? $wpsp_slider_row['number4'] : 1;

				$slider_data .= ' data-arrowicon="' . $navigation_arrow_type . '" data-slick=\'{"dots": ' . $pagination_dots . ', "pauseOnHover": ' . $carousel_pause_on_hover . ', "slidesToShow": ' . $number_of_products . ', "speed": ' . $carousel_scroll_speed . ', "arrows": ' . $navigation_arrows . ', "autoplay": ' . $autoplay . ', "autoplaySpeed": ' . $autoplay_speed . ', "swipe": ' . $swipe . ', "draggable": ' . $draggable . ', "rtl": ' . $rtl_mode . ', "infinite": ' . $carousel_infinite . ', "slidesToScroll": ' . $slides_to_scroll . ', "rows": ' . $row_large_desktop . ', "cssEase": "' . $css_ease . '", "responsive": [ {"breakpoint": ' . $small_desktop_size . ', "settings": { "slidesToShow": ' . $number_of_products_desktop . ', "slidesToScroll": ' . $slides_to_scroll_desktop . ', "rows": ' . $row_desktop . ' } }, {"breakpoint": ' . $tablet_size . ', "settings": { "slidesToShow": ' . $number_of_products_tablet . ', "slidesToScroll": ' . $slides_to_scroll_tablet . ', "rows": ' . $row_tablet . ' } }, {"breakpoint": ' . $mobile_size . ', "settings": { "slidesToShow": ' . $number_of_products_mobile . ', "slidesToScroll": ' . $slides_to_scroll_on_mobile . ', "rows": ' . $row_mobile . ', "dots": ' . $dots_mobile . ', "arrows": ' . $nav_mobile . ' } } ] }\'';
			}

			wp_enqueue_style( 'sp-wpsp-font-awesome' );
			wp_enqueue_style( 'sp-wpsp-magnific-popup' );
			wp_enqueue_script( 'sp-wpsp-magnific-popup-min-js' );

			switch ( $carousel_type ) {
				// Product Carousel.
				case 'product_carousel':
					$outline .= '<div id="wpsp-slider-section" class="wpsp-slider-section wpsp-slider-section' . $post_id . ' sp-woo-product-slider-pro' . $post_id . ' wpsp_' . $theme_style . ' pagination-type-' . $pagination_type . ' navigation_position_' . $navigation_position . $grid_style_class . '">';

					include SP_WPSPRO_PATH . '/public/views/product-loop.php';

					$outline .= '</div>';// wpsp-slider-section.
					break;
				// Category Carousel.
				case 'category_carousel':
					if ( ! empty( $shortcode_data['choose_category'] ) ) {
						$cat_args = array(
							'taxonomy'   => 'product_cat',
							'include'    => $shortcode_data['choose_category'],
							'hide_empty' => 0,
							'orderby'    => $category_order_by,
							'order'      => $category_order,
						);
					} else {
						$cat_args = array(
							'taxonomy'   => 'product_cat',
							'hide_empty' => 0,
							'parent'     => 0,
							'orderby'    => $category_order_by,
							'order'      => $category_order,
						);
					}

					$terms = get_terms( $cat_args );
					if ( $terms ) {
						$outline .= '<div id="wpsp-slider-section" class="wpsp-slider-section wpsp-slider-section' . $post_id . ' sp-woo-product-slider-pro' . $post_id . ' wpsp_category_' . $category_theme_style . ' pagination-type-' . $pagination_type . ' navigation_position_' . $navigation_position . $grid_style_class . '">';

						include SP_WPSPRO_PATH . '/public/views/content/slider-title.php';
						include SP_WPSPRO_PATH . '/public/views/preloader.php';

						$outline .= '<div id="sp-woo-product-slider-pro' . $post_id . '" class="wpsp-product-section ' . $grid_pagination_type . '" ' . $the_rtl . ' ' . $slider_data . ' >';

						foreach ( $terms as $term ) {
							include SP_WPSPRO_PATH . '/public/views/cat_loop.php';
						}

						$outline .= '</div>';// sp-woo-category-slider.
						$outline .= '</div>';// wpsp-category-slider-section.
					}
					break;
			}

			wp_reset_query();

			return $outline;
		}

		/**
		 * The font variants for the Advanced Typography.
		 *
		 * @param string $sp_wpspro_font_variant The typography field ID with.
		 * @return string
		 * @since 2.4.20
		 */
		private function wpspro_the_font_variants( $sp_wpspro_font_variant ) {
			$wpsp_font_style  = 'normal';
			$wpsp_font_weight = '400';
			switch ( $sp_wpspro_font_variant ) {
				case '100':
					$wpsp_font_weight = '100';
					break;
				case '100italic':
					$wpsp_font_weight = '100';
					$wpsp_font_style  = 'italic';
					break;
				case '200':
					$wpsp_font_weight = '200';
					break;
				case '200italic':
					$wpsp_font_weight = '200';
					$wpsp_font_style  = 'italic';
					break;
				case '300':
					$wpsp_font_weight = '300';
					break;
				case '300italic':
					$wpsp_font_weight = '300';
					$wpsp_font_style  = 'italic';
					break;
				case '500':
					$wpsp_font_weight = '500';
					break;
				case '500italic':
					$wpsp_font_weight = '500';
					$wpsp_font_style  = 'italic';
					break;
				case '600':
					$wpsp_font_weight = '600';
					break;
				case '600italic':
					$wpsp_font_weight = '600';
					$wpsp_font_style  = 'italic';
					break;
				case '700':
					$wpsp_font_weight = '700';
					break;
				case '700italic':
					$wpsp_font_weight = '700';
					$wpsp_font_style  = 'italic';
					break;
				case '800':
					$wpsp_font_weight = '800';
					break;
				case '800italic':
					$wpsp_font_weight = '800';
					$wpsp_font_style  = 'italic';
					break;
				case '900':
					$wpsp_font_weight = '900';
					break;
				case '900italic':
					$wpsp_font_weight = '900';
					$wpsp_font_style  = 'italic';
					break;
				case 'italic':
					$wpsp_font_style = 'italic';
					break;
			}
			return 'font-style: ' . $wpsp_font_style . '; font-weight: ' . $wpsp_font_weight . ';';
		}

	}

	new WPSPRO_Shortcode_Render();
}
