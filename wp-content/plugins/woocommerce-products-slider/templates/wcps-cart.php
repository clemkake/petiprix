<?php

/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access  
	
	$html_cart = apply_filters( 'wcps_filter_cart', do_shortcode('[add_to_cart show_price="false" quantity="1" id="'.get_the_ID().'"]') );




    global $woocommerce;
    $cart_url = wc_get_cart_url();

	$html.= '<div class="wcps-items-cart '.$wcps_cart_style.'">';
    $html.= $html_cart;
    $html.= '</div>';







