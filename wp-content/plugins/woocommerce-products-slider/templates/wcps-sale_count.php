<?php

/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 

global $product;

$units_sold = get_post_meta( $loop_post_id, 'total_sales', true );

$wcps_sale_count_text = !empty($wcps_sale_count_text) ? $wcps_sale_count_text : __('Total sold: %d', 'woocommerce-products-slider');



    $html.= '<div  class="wcps-items-sale-count">'.sprintf($wcps_sale_count_text,$units_sold).'</div>';
