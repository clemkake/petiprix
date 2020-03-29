<?php

/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 
	
	
	
	
	$primary_product_cat = (int)get_post_meta( get_the_ID(), '_yoast_wpseo_primary_product_cat', true );	
	
	
	
	
	if(!empty($primary_product_cat)){
		
		//var_dump($primary_product_cat);
		
		$cat_link = get_term_link( $primary_product_cat, 'product_cat' );
		//$cat_link = '#';
		}
	else{
		
			$product_cats = wp_get_post_terms( get_the_ID(), 'product_cat' );
			
			if(!empty($product_cats[0])){


				$term_id = $product_cats[0]->term_id;

                //var_dump($term_id);

				$cat_link = get_term_link( $term_id, 'product_cat' );
				}
			else{
				$cat_link = get_permalink(get_the_ID());
				}
			

			
			
		
		}
	

	
	
	$html.= '<div class="wcps-items-thumb">';
	
	$html_thumb = '';

	if($wcps_slider_lazy_load == 'true'){
        $html_thumb = '<a target="'.$wcps_items_thumb_link_target.'" href="'.$permalink.'"><img class="owl-lazy"  alt="'.get_the_title().'" data-src="'.$wcps_thumb_url.'" src="'.$wcps_items_thumb_lazy_src.'" /></a>';

    }else{
        $html_thumb = '<a target="'.$wcps_items_thumb_link_target.'" href="'.$permalink.'"><img   alt="'.get_the_title().'" src="'.$wcps_thumb_url.'" /></a>';

    }


	$html.= apply_filters( 'wcps_filter_thumb', $html_thumb );

    $html_zoom = apply_filters('wcps_filter_zoom', '<i class="fa fa-search-plus"></i>');

    if ($wcps_items_thumb_zoom == 'yes') {
        $html .= '<div class="wcps-zoom" slider-id="' . $post_id . '" product-id="' . get_the_ID() . '">' . $html_zoom . '</div>';
    }

	$html.= '</div>';