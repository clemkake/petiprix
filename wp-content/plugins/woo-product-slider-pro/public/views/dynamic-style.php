<?php
/**
 * Dynamic style for the plugin
 *
 * @link       https://shapedplugin.com/
 * @since      1.0.0
 *
 * @package    Woo_Product_Slider_Pro
 * @subpackage Woo_Product_Slider_Pro/public
 */
$grid_pagination_colors             = ( isset( $shortcode_data['grid_pagination_colors'] ) ? $shortcode_data['grid_pagination_colors'] : '' );
$grid_pagination_bg_color           = ( isset( $grid_pagination_colors['background'] ) ? $grid_pagination_colors['background'] : 'transparent' );
$grid_pagination_color              = ( isset( $grid_pagination_colors['color'] ) ? $grid_pagination_colors['color'] : '#5e5e5e' );
$grid_pagination_border_color       = ( isset( $grid_pagination_colors['border'] ) ? $grid_pagination_colors['border'] : '#dddddd' );
$grid_pagination_hover_bg_color     = ( isset( $grid_pagination_colors['hover_background'] ) ? $grid_pagination_colors['hover_background'] : '#5e5e5e' );
$grid_pagination_hover_color        = ( isset( $grid_pagination_colors['hover_color'] ) ? $grid_pagination_colors['hover_color'] : '#ffffff' );
$grid_pagination_hover_border_color = ( isset( $grid_pagination_colors['hover_border'] ) ? $grid_pagination_colors['hover_border'] : '#5e5e5e' );

$dynamic_style = '<style>';

if ( $carousel_type == 'product_carousel' ) {
	$dynamic_style .= '
        .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .slick-list {
            margin-bottom: -' . $product_margin . 'px;
        }
        .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section{
            margin-left: -' . $product_margin . 'px;
        }
        .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .slick-slide {
            margin-left: ' . $product_margin . 'px;
        }
        .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product {
            margin-bottom: ' . $product_margin . 'px;
        }
    ';
	if ( 'grid' == $layout_preset || 'filter' == $layout_preset ) {
		$dynamic_style .= '
            .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product {
                padding-left: ' . $product_margin . 'px;
            }
        ';
	}
}
if ( $carousel_type == 'category_carousel' ) {
	$dynamic_style .= '
        .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .slick-list{
            margin-bottom: -' . $category_margin . 'px;
        }
        .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section{
            margin-left: -' . $category_margin . 'px;
        }
        .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .slick-slide {
            margin-left: ' . $category_margin . 'px;
        }
        .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-cat-item .wpspro-cat-data {
            margin-bottom: ' . $category_margin . 'px;
        }
    ';
	if ( 'grid' == $layout_preset || 'filter' == $layout_preset ) {
		$dynamic_style .= '
        .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-cat-item {
                padding-left: ' . $category_margin . 'px;
            }
        ';
	}
}
if ( $pagination_type == 'number' && $pagination == 'true' || $pagination_type == 'number' && $pagination_mobile == 'true' ) {
	$dynamic_style .= '
        .pagination-type-number #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .slick-dots li button{
            color: ' . $pagination_number_color . ';
        }
        .pagination-type-number #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .slick-dots li.slick-active button,
        .pagination-type-number #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .slick-dots li button:hover{
            color: ' . $pagination_number_hover_color . ';
        }
        .pagination-type-number #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .slick-dots li button:before{
            background-color: ' . $pagination_number_hover_bg . ';
        }
    ';
}
if ( $sale_ribbon == 'true' ) {
	$dynamic_style .= '.wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .sale_text{
    color: ' . $sale_ribbon_typography['color'] . ';
    font-size: ' . $sale_ribbon_typography['size'] . 'px;
    line-height: ' . $sale_ribbon_typography['height'] . 'px;
    text-transform: ' . $sale_ribbon_typography['transform'] . ';
    letter-spacing: ' . $sale_ribbon_typography['spacing'] . ';
    text-align: ' . $sale_ribbon_typography['alignment'] . ';';
	if ( isset( $shortcode_data['sale_ribbon_font_load'] ) && $shortcode_data['sale_ribbon_font_load'] == 'true' ) {
		$dynamic_style .= '
        font-family: ' . $sale_ribbon_typography['family'] . ';
        ' . $this->wpspro_the_font_variants( $sale_ribbon_typography['variant'] ) . '';
	}
	$dynamic_style .= '
    background-color: ' . $sale_ribbon_bg . ';
}';
}
if ( $out_of_stock_ribbon == 'true' ) {
	$dynamic_style .= '.wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .wpsp-out-of-stock{
    color: ' . $out_of_stock_ribbon_typography['color'] . ';
    font-size: ' . $out_of_stock_ribbon_typography['size'] . 'px;
    line-height: ' . $out_of_stock_ribbon_typography['height'] . 'px;
    text-transform: ' . $out_of_stock_ribbon_typography['transform'] . ';
    letter-spacing: ' . $out_of_stock_ribbon_typography['spacing'] . ';
    text-align: ' . $out_of_stock_ribbon_typography['alignment'] . ';';
	if ( isset( $shortcode_data['out_of_stock_ribbon_font_load'] ) && $shortcode_data['out_of_stock_ribbon_font_load'] == 'true' ) {
		$dynamic_style .= '
        font-family: ' . $out_of_stock_ribbon_typography['family'] . ';
        ' . $this->wpspro_the_font_variants( $out_of_stock_ribbon_typography['variant'] ) . '';
	}
	$dynamic_style .= '
    background-color: ' . $out_of_stock_ribbon_bg . ';
    }';
}
if ( $slider_title == 'true' ) {
	$dynamic_style .= '#wpsp-slider-section.wpsp-slider-section' . $post_id . ' h2.sp-woo-product-slider-pro-section-title{
        color: ' . $slider_title_typography['color'] . ';
        font-size: ' . $slider_title_typography['size'] . 'px;
        line-height: ' . $slider_title_typography['height'] . 'px;
        text-transform: ' . $slider_title_typography['transform'] . ';
        letter-spacing: ' . $slider_title_typography['spacing'] . ';
        text-align: ' . $slider_title_typography['alignment'] . ';';
	if ( isset( $shortcode_data['slider_title_font_load'] ) && $shortcode_data['slider_title_font_load'] == 'true' ) {
		$dynamic_style .= '
                font-family: ' . $slider_title_typography['family'] . ';
                ' . $this->wpspro_the_font_variants( $slider_title_typography['variant'] ) . '';
	}
		$dynamic_style .= '
    }';
}
if ( $pagination_type == 'dots' && $pagination == 'true' || $pagination_type == 'dots' && $pagination_mobile == 'true' ) {
	$dynamic_style .= '
        .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .slick-dots li button{
            background-color: ' . $pagination_dots_bg . ';
        }
        .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .slick-dots li.slick-active button{
            background-color: ' . $pagination_dots_active_bg . ';
        }
    ';
}

if ( $image_border == 'true' ) {
	if ( $theme_style == 'theme_one' || $theme_style == 'theme_eight' || $theme_style == 'theme_nine' ||
		 $theme_style == 'theme_fifteen' || $theme_style == 'theme_sixteen' || $theme_style == 'theme_seventeen' || $theme_style == 'theme_thirteen' || $theme_style == 'theme_fourteen'
	) {
		$dynamic_style .= '
    #wpsp-slider-section.wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .wpsp-product-image{
        border: ' . $image_border_size . 'px solid ' . $image_border_color . ';
    }
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product:hover .wpsp-product-image{
        border-color: ' . $image_hover_border_color . ';
    }
';
	}
	if ( $theme_style == 'theme_five' || $theme_style == 'theme_seven' || $theme_style == 'theme_eleven' || $theme_style == 'theme_twenty_four' || $theme_style == 'theme_three' || $theme_style == 'theme_four' ) {
		$dynamic_style .= '
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .wpsp-product-image-area{
        border: ' . $image_border_size . 'px solid ' . $image_border_color . ';
    }
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product:hover .wpsp-product-image-area{
        border-color: ' . $image_hover_border_color . ';
    }
';
	}
}
if ( $product_price == 'true' ) {
	$dynamic_style .= '
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product-price{
        color: ' . $product_price_typography['color'] . ';
        font-size: ' . $product_price_typography['size'] . 'px;
        line-height: ' . $product_price_typography['height'] . 'px;
        text-transform: ' . $product_price_typography['transform'] . ';
        letter-spacing: ' . $product_price_typography['spacing'] . ';
        text-align: ' . $product_price_typography['alignment'] . ';';
	if ( isset( $shortcode_data['product_price_font_load'] ) && $shortcode_data['product_price_font_load'] == 'true' ) {
		$dynamic_style .= '
        font-family: ' . $product_price_typography['family'] . ';
        ' . $this->wpspro_the_font_variants( $product_price_typography['variant'] ) . '';
	}
	$dynamic_style .= '
    }
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product-price del{
        color: ' . $product_del_price_color . ';
    }
';
}
if ( $product_rating == 'true' ) {
	$dynamic_style .= '
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .star-rating span:before{
        color: ' . $product_rating_color . ';
    }
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .star-rating:before{
        color: ' . $product_empty_rating_color . ';
    }
';
}
if ( $product_name == 'true' ) {
	$dynamic_style .= '
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product-title a{
        color: ' . $product_name_typography['color'] . ';
        font-size: ' . $product_name_typography['size'] . 'px;
        line-height: ' . $product_name_typography['height'] . 'px;
        text-transform: ' . $product_name_typography['transform'] . ';
        letter-spacing: ' . $product_name_typography['spacing'] . ';';
	if ( isset( $shortcode_data['product_name_font_load'] ) && $shortcode_data['product_name_font_load'] == 'true' ) {
		$dynamic_style .= '
        font-family: ' . $product_name_typography['family'] . ';
        ' . $this->wpspro_the_font_variants( $product_name_typography['variant'] ) . '';
	}
		$dynamic_style .= '
    }
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product-title{
        text-align: ' . $product_name_typography['alignment'] . ';
    }
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product-title a:hover{
        color: ' . $product_name_typography['hover_color'] . ';
    }
';
}
if ( $product_cat == 'true' ) {
	$dynamic_style .= '
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product-cat{
        text-align: ' . $product_category_typography['alignment'] . ';
    }
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product-cat a{
        color: ' . $product_category_typography['color'] . ';
        font-size: ' . $product_category_typography['size'] . 'px;
        line-height: ' . $product_category_typography['height'] . 'px;
        text-transform: ' . $product_category_typography['transform'] . ';
        letter-spacing: ' . $product_category_typography['spacing'] . ';';
	if ( isset( $shortcode_data['product_category_font_load'] ) && $shortcode_data['product_category_font_load'] == 'true' ) {
		$dynamic_style .= '
        font-family: ' . $product_category_typography['family'] . ';
        ' . $this->wpspro_the_font_variants( $product_category_typography['variant'] ) . '';
	}
	$dynamic_style .= '
    }
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product-cat a:hover{
        color: ' . $product_category_typography['hover_color'] . ';
    }
';
}
if ( $add_to_cart_button == 'true' ) {
	$dynamic_style .= '
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-cart-button a.button:not(.sp-wqvpro-view-button):not(.sp-wqv-view-button){
        font-size: ' . $add_to_cart_typography['size'] . 'px;
        line-height: ' . $add_to_cart_typography['height'] . 'px;
        text-transform: ' . $add_to_cart_typography['transform'] . ';
        letter-spacing: ' . $add_to_cart_typography['spacing'] . ';
        text-align: ' . $add_to_cart_typography['alignment'] . ';';
	if ( isset( $shortcode_data['add_to_cart_font_load'] ) && $shortcode_data['add_to_cart_font_load'] == 'true' ) {
		$dynamic_style .= 'font-family: ' . $add_to_cart_typography['family'] . ';
        ' . $this->wpspro_the_font_variants( $add_to_cart_typography['variant'] ) . '';
	}
	$dynamic_style .= '
        color: ' . $add_to_cart_button_color . ';
        background-color: ' . $add_to_cart_button_bg . ';
        border: ' . $add_to_cart_border_size . 'px solid ' . $add_to_cart_button_border_color . ';
        border-radius: ' . $add_to_cart_border_radius . 'px;
    }
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-cart-button a.button:not(.sp-wqvpro-view-button):not(.sp-wqv-view-button):hover,
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-cart-button a.button:not(.sp-wqvpro-view-button):not(.sp-wqv-view-button).added_to_cart{
        color: ' . $add_to_cart_button_hover_color . ';
        background-color: ' . $add_to_cart_button_hover_bg . ';
        border-color: ' . $add_to_cart_button_hover_border_color . ';
    }
';
}
if ( $product_content_more_button == 'true' && $product_content == 'true' ) {
	$dynamic_style .= '
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .sp-product-more-content a{
        color: ' . $product_content_more_button_color . ';
    }
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .sp-product-more-content a:hover{
        color: ' . $product_content_more_button_hover_color . ';
    }
';
}
if ( $product_border == 'true' ) {
	if ( $theme_style == 'theme_two' || $theme_style == 'theme_twenty_seven' || $theme_style == 'theme_twenty_eight' || $theme_style == 'theme_six' || $theme_style == 'theme_ten' || $theme_style == 'theme_twenty_two' || $theme_style == 'theme_twenty_three' ||
		 $theme_style == 'theme_twenty_six'
	) {
		$dynamic_style .= '
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .wpspro-product-data{
        border: ' . $product_border_size . 'px solid ' . $product_border_color . ';
    }
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .wpspro-product-data:hover{
        border-color: ' . $product_hover_border_color . ';
    }
    ';
	}
	if ( $theme_style == 'theme_thirteen' ) {
		$dynamic_style .= '
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .product-details{
        border-bottom: ' . $product_border_size . 'px solid ' . $product_border_color . ';
    }
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product:hover .product-details{
        border-color: ' . $product_hover_border_color . ';
    }
    ';
	}
}

if ( $theme_style == 'theme_five' ) {
	$dynamic_style .= '
.wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .wpsp-buttons-area{
    background-color: ' . $product_overlay_bg . ';
}
.wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .wpsp-view-details a{
    font-size: ' . $add_to_cart_typography['size'] . 'px;
    line-height: ' . $add_to_cart_typography['height'] . 'px;
    text-transform: ' . $add_to_cart_typography['transform'] . ';
    letter-spacing: ' . $add_to_cart_typography['spacing'] . ';
    text-align: ' . $add_to_cart_typography['alignment'] . ';';
	if ( isset( $shortcode_data['add_to_cart_font_load'] ) && $shortcode_data['add_to_cart_font_load'] == 'true' ) {
		$dynamic_style .= '
        font-family: ' . $add_to_cart_typography['family'] . ';
        ' . $this->wpspro_the_font_variants( $add_to_cart_typography['variant'] ) . '';
	}
	$dynamic_style .= '
    color: ' . $view_detail_button_color . ';
    background-color: ' . $view_detail_button_bg . ';
    border: ' . $view_detail_border_size . 'px solid ' . $view_detail_border_color . ';
}
.wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .wpsp-view-details a:hover{
    color: ' . $view_detail_button_hover_color . ';
    background-color: ' . $view_detail_button_hover_bg . ';
    border-color: ' . $view_detail_button_hover_border_color . ';
}
';
}

if ( $theme_style == 'theme_three' ) {
	$dynamic_style .= '
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .wpsp-cart-button{
        background-color: ' . $product_overlay_bg . ';
    }
    ';
}
if ( $theme_style == 'theme_four' ) {
	$dynamic_style .= '
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .product-details{
        background-color: ' . $product_overlay_bg . ';
    }
    ';
}
if ( $theme_style == 'theme_twenty_eight' || $theme_style == 'theme_six' || $theme_style == 'theme_ten' || $theme_style == 'theme_thirteen' || $theme_style == 'theme_fourteen' || $theme_style == 'theme_nineteen' || $theme_style == 'theme_twenty_two' || $theme_style == 'theme_twenty_three' || $theme_style == 'theme_twenty_five' || $theme_style == 'theme_twenty_six' ) {
	$dynamic_style .= '
.wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .product-details{
    background-color: ' . $product_info_bg . ';
}';
}

if ( $theme_style == 'theme_nineteen' ) {
	$dynamic_style .= '
.wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .product-details:after{
    border-bottom-color: ' . $product_info_bg . ';
}
.wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product:hover .product-details:after{
    border-bottom-color: ' . $product_info_hover_bg . ';
}
';
}

if ( $theme_style == 'theme_thirteen' || $theme_style == 'theme_fourteen' || $theme_style == 'theme_nineteen' || $theme_style == 'theme_twenty_two' || $theme_style == 'theme_twenty_three' || $theme_style == 'theme_twenty_five' || $theme_style == 'theme_twenty_six' ) {
	$dynamic_style .= '
.wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product:hover .product-details{
    background-color: ' . $product_info_hover_bg . ';
}';
}
if ( $theme_style == 'theme_two' ) {
	$dynamic_style .= '
.wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .product-details-inner{
    background-color: ' . $product_info_bg . ';
}';
}
if ( $theme_style == 'theme_twenty_three' || $theme_style == 'theme_twenty_four' ) {
	$dynamic_style .= '
.wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .wpsp-product-add-to-cart{
    background-color: ' . $product_top_info_bg . ';
}';
}
if ( $theme_style == 'theme_twenty_seven' ) {
	$dynamic_style .= '
.wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .product-details-inner{
    background: linear-gradient( rgba(0, 0, 0, 0), ' . $product_info_gradient . ' 90%);
}';
}
if ( $theme_style == 'theme_seven' || $theme_style == 'theme_thirteen' ) {
	$dynamic_style .= '
.wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .product-overlay-color{
    background-color: ' . $product_overlay_bg . ';
}';
}
if ( $theme_style == 'theme_eleven' ) {
	$dynamic_style .= '
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .product-overlay-color{
        background-color: ' . $product_overlay_bg . ';
    }
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product:hover .wpsp-product-title a{
        color: ' . $product_name_typography['hover_color'] . ';
    }
    ';
}
if ( $quick_view == 'false' ) {
	$dynamic_style .= '.wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product a.sp-wqv-view-button,
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product a.sp-wqvpro-view-button{
        display: none !important;
    }';
}
if ( $theme_style == 'theme_sixteen' || $theme_style == 'theme_seventeen' ) {
	$dynamic_style .= '
        .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .wpsp-product-image-area a.sp-wpsp-wqv-button{
            color: ' . $quick_view_button_color . ';
            background-color: ' . $quick_view_button_bg . ';
            border: ' . $quick_view_border_size . 'px solid ' . $quick_view_button_border_color . ';
        }
        .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .wpsp-product-image-area a.sp-wpsp-wqv-button:hover{
            color: ' . $quick_view_button_hover_color . ';
            background-color: ' . $quick_view_button_hover_bg . ';
            border-color: ' . $quick_view_button_hover_border_color . ';
        }
        ';
}
if ( $theme_style == 'theme_twenty_four' ) {
	$dynamic_style .= '
        .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .wpsp-product-image-area a.sp-wpsp-wqv-button{
            color: ' . $quick_view_button_color . ';
        }
        .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .wpsp-product-image-area a.sp-wpsp-wqv-button:hover{
            color: ' . $quick_view_button_hover_color . ';
        }
        .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .wpsp-product-add-to-cart ul li{
            border-color: ' . $product_button_border_color . ';
        }
        ';
}
if ( $theme_style == 'theme_seventeen' ) {
	if ( $add_to_cart_button == 'true' && $quick_view == 'false' ) {
		$dynamic_style .= '
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .wpsp-product-image-area .wpsp-cart-button a.button:not(.sp-wqvpro-view-button):not(.sp-wqv-view-button){
        right: 0;
    }
    ';
	}
	if ( $add_to_cart_button == 'false' && $quick_view == 'true' ) {
		$dynamic_style .= '
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .wpsp-product-image-area a.sp-wpsp-wqv-button{
        left: 0;
    }
    ';
	}
}
if ( $theme_style == 'theme_fifteen' ) {
	$dynamic_style .= '
.wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .wpsp-product-image-area .yith-wcwl-add-to-wishlist a{
    color: ' . $wishlist_button_color . ';
    background-color: ' . $wishlist_button_bg . ';
    border: ' . $wishlist_border_size . 'px solid ' . $wishlist_button_border_color . ';
}
.wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .wpsp-product-image-area .yith-wcwl-add-to-wishlist a:hover,
.wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .wpsp-product-image-area .yith-wcwl-wishlistaddedbrowse.show a,
.wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .wpsp-product-image-area .yith-wcwl-wishlistexistsbrowse.show a{
    color: ' . $wishlist_button_hover_color . ';
    background-color: ' . $wishlist_button_hover_bg . ';
    border-color: ' . $wishlist_button_hover_border_color . ';
}
.wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .wpsp-product-image-area a.sp-wpsp-wqv-button{
    color: ' . $quick_view_button_color . ';
    background-color: ' . $quick_view_button_bg . ';
    border: ' . $quick_view_border_size . 'px solid ' . $quick_view_button_border_color . ';
}
.wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .wpsp-product-image-area a.sp-wpsp-wqv-button:hover{
    color: ' . $quick_view_button_hover_color . ';
    background-color: ' . $quick_view_button_hover_bg . ';
    border-color: ' . $quick_view_button_hover_border_color . ';
}

';

	if ( $wishlist == 'true' && $quick_view == 'true' ) {
		$dynamic_style .= '
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .wpsp-product-image-area .wpsp-cart-button a.button:not(.sp-wqvpro-view-button):not(.sp-wqv-view-button){
        right: 74px;
    }
    ';
	}
	if ( $wishlist == 'false' && $quick_view == 'true' || $wishlist == 'true' && $quick_view == 'false' ) {
		$dynamic_style .= '
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .wpsp-product-image-area .wpsp-cart-button a.button:not(.sp-wqvpro-view-button):not(.sp-wqv-view-button){
        right: 38px;
    }
    ';
	}
	if ( $wishlist == 'false' && $quick_view == 'true' ) {
		$dynamic_style .= '
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .wpsp-product-image-area a.sp-wpsp-wqv-button{
        right: 0;
    }
    ';
	}
}
if ( $wishlist == 'true' && $theme_style == 'theme_twenty' || $wishlist == 'true' && $theme_style == 'theme_twenty_one' ) {
	$dynamic_style .= '
        #wpsp-slider-section.wpsp-slider-section' . $post_id . ' .wpsp-product .product-wishlist-com{
            text-align: ' . $compare_wishlist_typography['alignment'] . ';
        }
        #wpsp-slider-section.wpsp-slider-section' . $post_id . ' .wpsp-product .product-wishlist-com .yith-wcwl-add-to-wishlist a{
            color: ' . $wishlist_button_color . ';
            font-size: ' . $compare_wishlist_typography['size'] . 'px;
            line-height: ' . $compare_wishlist_typography['height'] . 'px;
            text-transform: ' . $compare_wishlist_typography['transform'] . ';
            letter-spacing: ' . $compare_wishlist_typography['spacing'] . ';';
	if ( isset( $shortcode_data['compare_wishlist_font_load'] ) && $shortcode_data['compare_wishlist_font_load'] == 'true' ) {
		$dynamic_style .= '
            font-family: ' . $compare_wishlist_typography['family'] . ';
            ' . $this->wpspro_the_font_variants( $compare_wishlist_typography['variant'] ) . '';
	}
	$dynamic_style .= '
        }
        #wpsp-slider-section.wpsp-slider-section' . $post_id . ' .wpsp-product .product-wishlist-com .yith-wcwl-add-to-wishlist a:hover,
        #wpsp-slider-section.wpsp-slider-section' . $post_id . ' .wpsp-product .product-wishlist-com .yith-wcwl-wishlistexistsbrowse.show a,
        #wpsp-slider-section.wpsp-slider-section' . $post_id . ' .wpsp-product .product-wishlist-com .yith-wcwl-wishlistaddedbrowse.show a{
            color: ' . $wishlist_button_hover_color . ';
        }
        ';
}
if ( $wishlist == 'true' && $theme_style == 'theme_twenty_four' ) {
	$dynamic_style .= '
        #wpsp-slider-section.wpsp-slider-section' . $post_id . ' .wpsp-product .yith-wcwl-add-to-wishlist a{
            color: ' . $wishlist_button_color . ';
        }
        #wpsp-slider-section.wpsp-slider-section' . $post_id . ' .wpsp-product .yith-wcwl-add-to-wishlist a:hover,
        #wpsp-slider-section.wpsp-slider-section' . $post_id . ' .wpsp-product .yith-wcwl-wishlistexistsbrowse.show a,
        #wpsp-slider-section.wpsp-slider-section' . $post_id . ' .wpsp-product .yith-wcwl-wishlistaddedbrowse.show a{
            color: ' . $wishlist_button_hover_color . ';
        }
        ';
}
if ( $compare == 'true' && $theme_style == 'theme_twenty' || $compare == 'true' && $theme_style == 'theme_twenty_one' ) {
	$dynamic_style .= '
        #wpsp-slider-section.wpsp-slider-section' . $post_id . ' .wpsp-product .product-wishlist-com{
            text-align: ' . $compare_wishlist_typography['alignment'] . ';
        }
        #wpsp-slider-section.wpsp-slider-section' . $post_id . ' .wpsp-product .product-wishlist-com .compare-button a{
            color: ' . $compare_button_color . ';
            font-size: ' . $compare_wishlist_typography['size'] . 'px;
            line-height: ' . $compare_wishlist_typography['height'] . 'px;
            text-transform: ' . $compare_wishlist_typography['transform'] . ';
            letter-spacing: ' . $compare_wishlist_typography['spacing'] . ';';
	if ( isset( $shortcode_data['compare_wishlist_font_load'] ) && $shortcode_data['compare_wishlist_font_load'] == 'true' ) {
		$dynamic_style .= '
            font-family: ' . $compare_wishlist_typography['family'] . ';
            ' . $this->wpspro_the_font_variants( $compare_wishlist_typography['variant'] ) . '';
	}
	$dynamic_style .= '
        }
        #wpsp-slider-section.wpsp-slider-section' . $post_id . ' .wpsp-product .product-wishlist-com .compare-button a:hover,
        #wpsp-slider-section.wpsp-slider-section' . $post_id . ' .wpsp-product .product-wishlist-com .compare-button a.added{
            color: ' . $compare_button_hover_color . ';
        }
        ';
}
if ( $compare == 'true' && $theme_style == 'theme_twenty_four' ) {
	$dynamic_style .= '
        #wpsp-slider-section.wpsp-slider-section' . $post_id . ' .wpsp-product .compare-button a{
            color: ' . $compare_button_color . ';
        }
        #wpsp-slider-section.wpsp-slider-section' . $post_id . ' .wpsp-product .compare-button a:hover,
        #wpsp-slider-section.wpsp-slider-section' . $post_id . ' .wpsp-product .compare-button a.added{
            color: ' . $compare_button_hover_color . ';
        }
        ';
}
if ( $theme_style == 'theme_twenty_five' ) {
	$dynamic_style .= '
        #wpsp-slider-section.wpsp-slider-section' . $post_id . ' .wpsp-product .wpsp-product-box{
            -webkit-box-shadow: 0 0 10px 0 ' . $product_box_shadow_color . ';
            -moz-box-shadow: 0 0 10px 0 ' . $product_box_shadow_color . ';
            box-shadow: 0 0 10px 0 ' . $product_box_shadow_color . ';
        }
        #wpsp-slider-section.wpsp-slider-section' . $post_id . ' .wpsp-product:hover .wpsp-product-box{
            -webkit-box-shadow: 0 0 10px 0 ' . $product_box_shadow_hover_color . ';
            -moz-box-shadow: 0 0 10px 0 ' . $product_box_shadow_hover_color . ';
            box-shadow: 0 0 10px 0 ' . $product_box_shadow_hover_color . ';
        }
        ';
}
if ( $theme_style == 'theme_twenty' ) {
	$dynamic_style .= '
        #wpsp-slider-section.wpsp-slider-section' . $post_id . '.wpsp_theme_twenty .wpsp-product .product-wishlist-com{
            border-top: 1px solid ' . $product_border_color . ';
        }
        #wpsp-slider-section.wpsp-slider-section' . $post_id . '.wpsp_theme_twenty .wpsp-product .wpsp-product-box{
            -webkit-box-shadow: 0 0 10px 0 ' . $product_box_shadow_color . ';
            -moz-box-shadow: 0 0 10px 0 ' . $product_box_shadow_color . ';
            box-shadow: 0 0 10px 0 ' . $product_box_shadow_color . ';
        }
        #wpsp-slider-section.wpsp-slider-section' . $post_id . '.wpsp_theme_twenty .wpsp-product:hover .wpsp-product-box{
            -webkit-box-shadow: 0 0 10px 0 ' . $product_box_shadow_hover_color . ';
            -moz-box-shadow: 0 0 10px 0 ' . $product_box_shadow_hover_color . ';
            box-shadow: 0 0 10px 0 ' . $product_box_shadow_hover_color . ';
        }
        ';
}
if ( $theme_style == 'theme_twenty_one' ) {
	$dynamic_style .= '
        #wpsp-slider-section.wpsp-slider-section' . $post_id . '.wpsp_theme_twenty_one .wpsp-product .product-wishlist-com{
            border-top: 1px solid ' . $product_border_color . ';
        }
        #wpsp-slider-section.wpsp-slider-section' . $post_id . '.wpsp_theme_twenty_one .wpsp-product .wpsp-product-box{
            -webkit-box-shadow: 0 0 10px 0 ' . $product_box_shadow_color . ';
            -moz-box-shadow: 0 0 10px 0 ' . $product_box_shadow_color . ';
            box-shadow: 0 0 10px 0 ' . $product_box_shadow_color . ';
        }
        #wpsp-slider-section.wpsp-slider-section' . $post_id . '.wpsp_theme_twenty_one .wpsp-product:hover .wpsp-product-box{
            -webkit-box-shadow: 0 0 10px 0 ' . $product_box_shadow_hover_color . ';
            -moz-box-shadow: 0 0 10px 0 ' . $product_box_shadow_hover_color . ';
            box-shadow: 0 0 10px 0 ' . $product_box_shadow_hover_color . ';
        }
        ';
}

if ( $theme_style == 'theme_twelve' ) {
	$dynamic_style .= '
.wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .wpspro-product-data{
    border-top: ' . $product_border_size . 'px solid ' . $product_border_color . ';
    background-image: -webkit-gradient(linear, 0 0, 0 100%, from(' . $product_border_color . '), to(transparent));
    background-image: -webkit-linear-gradient(' . $product_border_color . ', transparent);
    background-image: -moz-linear-gradient(' . $product_border_color . ', transparent), -moz-linear-gradient(' . $product_border_color . ', transparent);
    background-image: -o-linear-gradient(' . $product_border_color . ', transparent), -o-linear-gradient(' . $product_border_color . ', transparent);
    background-image: linear-gradient(' . $product_border_color . ', transparent), linear-gradient(' . $product_border_color . ', transparent);
    -moz-background-size: ' . $product_border_size . 'px 100%;
    background-size: ' . $product_border_size . 'px 100%;
    background-position: 0 0, 100% 0;
    background-repeat: no-repeat;
    padding-left: ' . $product_border_size . 'px;
    padding-right: ' . $product_border_size . 'px;
}
.wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product .wpspro-product-data:hover{
    border-color: ' . $product_hover_border_color . ';
    background-image: -webkit-gradient(linear, 0 0, 0 100%, from(' . $product_hover_border_color . '), to(transparent));
    background-image: -webkit-linear-gradient(' . $product_hover_border_color . ', transparent);
    background-image: -moz-linear-gradient(' . $product_hover_border_color . ', transparent), -moz-linear-gradient(' . $product_hover_border_color . ', transparent);
    background-image: -o-linear-gradient(' . $product_hover_border_color . ', transparent), -o-linear-gradient(' . $product_hover_border_color . ', transparent);
    background-image: linear-gradient(' . $product_hover_border_color . ', transparent), linear-gradient(' . $product_hover_border_color . ', transparent);
}
';
}
if ( $navigation == 'true' || $navigation_mobile == 'true' ) {
	$dynamic_style .= '
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .slick-prev,
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .slick-next{
        border-color: ' . $navigation_arrow_border_color . ';
        background-color: ' . $navigation_arrow_bg . ';
        color: ' . $navigation_arrow_color . ';
        border-radius: ' . $navigation_border_radius . ';
    }
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .slick-prev:hover,
    .wpsp-slider-section #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .slick-next:hover{
        color: ' . $navigation_arrow_hover_color . ';
        background-color: ' . $navigation_arrow_hover_bg . ';
        border-color: ' . $navigation_arrow_border_hover_color . ';
    }
    .navigation_position_vertical_center #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section .wpsp-product{
        padding-right: 2px;
    }
';
	if ( 'top_right' || 'top_left' || 'top_center' === $navigation_position ) {
		if ( $slider_title == ! 'true' && $carousel_ticker_mode == 'false' ) {
			$dynamic_style .= '#wpsp-slider-section.wpsp-slider-section' . $post_id . '{
                padding-top: 46px;
            }';
		}
		$dynamic_style .= '
        #wpsp-slider-section.wpsp-slider-section' . $post_id . '.navigation_position_top_left .slick-next {
            left: ' . $product_margin . 'px;
            margin-left: 36px;
        }
        #wpsp-slider-section.wpsp-slider-section' . $post_id . '.navigation_position_top_left .slick-prev {
            left: ' . $product_margin . 'px;
        }
        ';
	}
	if ( 'bottom_right' || 'bottom_left' || 'bottom_center' === $navigation_position ) {
		$nav_padding_bottom = ( 'true' === $pagination || 'true' === $pagination_mobile ) ? '46px' : '66px';
		$dynamic_style     .= '#wpsp-slider-section.wpsp-slider-section' . $post_id . '{
            padding-bottom: ' . $nav_padding_bottom . ';
        }';
		$dynamic_style     .= '#wpsp-slider-section.wpsp-slider-section' . $post_id . '.navigation_position_bottom_left .slick-next {
            left: ' . $product_margin . 'px;
            margin-left: 36px;
        }
        #wpsp-slider-section.wpsp-slider-section' . $post_id . '.navigation_position_bottom_left .slick-prev {
            left: ' . $product_margin . 'px;
        }
        ';
	}
	if ( $navigation_position == 'vertical_center' ) {
		if ( $carousel_type == 'category_carousel' ) {
			$dynamic_style .= '
            #wpsp-slider-section.wpsp-slider-section' . $post_id . '.navigation_position_vertical_center .slick-prev{
                margin-left: ' . $category_margin . 'px;
            }';
		} else {
			$dynamic_style .= '
            #wpsp-slider-section.wpsp-slider-section' . $post_id . '.navigation_position_vertical_center .slick-prev{
                margin-left: ' . $product_margin . 'px;
            }';
		}
		$dynamic_style .= '#wpsp-slider-section.wpsp-slider-section' . $post_id . ' #sp-woo-product-slider-pro' . $post_id . '.wpsp-product-section{
                padding: 0 45px;
            }
        ';
	}
	if ( $navigation_position == 'vertical_center_inner' ) {
		$dynamic_style .= '
    #wpsp-slider-section.wpsp-slider-section' . $post_id . '.navigation_position_vertical_center_inner .slick-prev{
        margin-left: ' . $product_margin . 'px;
    }
    ';
	}
	if ( $navigation_position == 'vertical_center_inner_hover' ) {
		$dynamic_style .= '
    #wpsp-slider-section.wpsp-slider-section' . $post_id . '.navigation_position_vertical_center_inner_hover .slick-prev{
        margin-left: ' . $product_margin . 'px;
    }
    ';
	}
}
if ( $category_theme_style == 'theme_one' || $category_theme_style == 'theme_two' ) {
	$dynamic_style .= '
#wpsp-slider-section.wpsp-slider-section' . $post_id . '.wpsp_category_theme_one .wpsp-cat-item a.wpsp-cat-name,
#wpsp-slider-section.wpsp-slider-section' . $post_id . '.wpsp_category_theme_two .wpsp-cat-item a.wpsp-cat-name{
        font-size: ' . $category_carousel_typography['size'] . 'px;
        line-height: ' . $category_carousel_typography['height'] . 'px;
        text-transform: ' . $category_carousel_typography['transform'] . ';
        letter-spacing: ' . $category_carousel_typography['spacing'] . ';
        text-align: ' . $category_carousel_typography['alignment'] . ';';
	if ( isset( $shortcode_data['category_carousel_font_load'] ) && $shortcode_data['category_carousel_font_load'] == 'true' ) {
		$dynamic_style .= '
        font-family: ' . $category_carousel_typography['family'] . ';
        ' . $this->wpspro_the_font_variants( $category_carousel_typography['variant'] ) . '';
	}
	$dynamic_style .= '
}
#wpsp-slider-section.wpsp-slider-section' . $post_id . '.wpsp_category_theme_one .wpsp-cat-item a.wpsp-cat-name{
       background-color: ' . $category_bg . ';
       color: ' . $category_color . ';
}
#wpsp-slider-section.wpsp-slider-section' . $post_id . '.wpsp_category_theme_one .wpsp-cat-item:hover a.wpsp-cat-name{
       background-color: ' . $category_hover_bg . ';
       color: ' . $category_hover_color . ';
}
#wpsp-slider-section.wpsp-slider-section' . $post_id . '.wpsp_category_theme_two .wpsp-cat-item a.wpsp-cat-name{
       background-color: ' . $category_bg_2 . ';
       color: ' . $category_color . ';
}
#wpsp-slider-section.wpsp-slider-section' . $post_id . '.wpsp_category_theme_two .wpsp-cat-item:hover a.wpsp-cat-name{
       background-color: ' . $category_hover_bg_2 . ';
       color: ' . $category_hover_color . ';
}
';
}
if ( 'true' == $grid_pagination ) {
	$dynamic_style .= '#wpsp-slider-section.wpsp-slider-section' . $post_id . ' .wpspro-pagination ul li .page-numbers,
    #wpsp-slider-section.wpsp-slider-section' . $post_id . ' .wpspro-item-load-more span {
        background: ' . $grid_pagination_bg_color . ';
        color: ' . $grid_pagination_color . ';
        border: 2px solid ' . $grid_pagination_border_color . ';
    }
    #wpsp-slider-section.wpsp-slider-section' . $post_id . ' .wpspro-pagination ul li .page-numbers:hover,
    #wpsp-slider-section.wpsp-slider-section' . $post_id . ' .wpspro-pagination ul li .page-numbers.current,
    #wpsp-slider-section.wpsp-slider-section' . $post_id . ' .wpspro-item-load-more span:hover {
        background: ' . $grid_pagination_hover_bg_color . ';
        color: ' . $grid_pagination_hover_color . ';
        border-color: ' . $grid_pagination_hover_border_color . ';
    }';
}

$dynamic_style .= '/* Responsive CSS */
/* lg */
@media (min-width: ' . $tablet_size . 'px) and (max-width: ' . $small_desktop_size . 'px) {
    .sp-wpspro-col-lg-1{
        width: 100%;
    }
    .sp-wpspro-col-lg-2{
        width: 50%;
    }
    .sp-wpspro-col-lg-3{
        width: 33.2222%;
    }
    .sp-wpspro-col-lg-4{
        width: 24.9%;
    }
    .sp-wpspro-col-lg-5{
        width: 19.9%;
    }
    .sp-wpspro-col-lg-6{
        width: 16.6667%;
    }
    .sp-wpspro-col-lg-7 {
        width: 14.285714286%;
    }
    .sp-wpspro-col-lg-8 {
        width: 12.5%;
    }
    .sp-wpspro-col-lg-9 {
        width: 11.111111111%;
    }
    .sp-wpspro-col-lg-10 {
        width: 10%;
    }
    .sp-wpspro-col-lg-11 {
        width: 9.090909091%;
    }
    .sp-wpspro-col-lg-12 {
        width: 8.333333333%;
    }

}
/* md */
@media (min-width: ' . $mobile_size . 'px) and (max-width: ' . $tablet_size . 'px) {
    .sp-wpspro-col-md-1{
        width: 100%;
    }
    .sp-wpspro-col-md-2{
        width: 50%;
    }
    .sp-wpspro-col-md-3{
        width: 33.2222%;
    }
    .sp-wpspro-col-md-4{
        width: 24.9%;
    }
    .sp-wpspro-col-md-5{
        width: 19.9%;
    }
    .sp-wpspro-col-md-6{
        width: 16.6667%;
    }
    .sp-wpspro-col-md-7 {
        width: 14.285714286%;
    }
    .sp-wpspro-col-md-8 {
        width: 12.5%;
    }
    .sp-wpspro-col-md-9 {
        width: 11.111111111%;
    }
    .sp-wpspro-col-md-10 {
        width: 10%;
    }
    .sp-wpspro-col-md-11 {
        width: 9.090909091%;
    }
    .sp-wpspro-col-md-12 {
        width: 8.333333333%;
    }

}

/* sm */
@media (max-width: ' . $mobile_size . 'px) {
    .sp-wpspro-col-sm-1{
        width: 100%;
    }
    .sp-wpspro-col-sm-2{
        width: 49.9%;
    }
    .sp-wpspro-col-sm-3{
        width: 33.2222%;
    }
    .sp-wpspro-col-sm-4{
        width: 24.9%;
    }
    .sp-wpspro-col-sm-5{
        width: 19.9%;
    }
    .sp-wpspro-col-sm-6{
        width: 16.6667%;
    }
    .sp-wpspro-col-sm-7 {
        width: 14.285714286%;
    }
    .sp-wpspro-col-sm-8 {
        width: 12.5%;
    }
    .sp-wpspro-col-sm-9 {
        width: 11.111111111%;
    }
    .sp-wpspro-col-sm-10 {
        width: 10%;
    }
    .sp-wpspro-col-sm-11 {
        width: 9.090909091%;
    }
    .sp-wpspro-col-sm-12 {
        width: 8.333333333%;
    }

}';
$dynamic_style .= '</style>';

$outline .= $dynamic_style;
