<?php

/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access  
	
	$product_tags = wp_get_post_terms( get_the_ID(), 'product_tag' );
	$cat_link = array();
	$cat_name = array();

		$cat_html = '';

	$product_tags_count = count($product_tags);

	//var_dump($product_tags_count);

	$i=1;
	foreach($product_tags as $key => $cat)
		{
		
		$cat_link = get_term_link( $cat->term_id, 'product_tag' );
		$cat_name = $cat->name;
			
		$cat_html.= '<a href="'.$cat_link.'">'.$cat_name.'</a>';

		if($product_tags_count > $i){
			$cat_html.= '<span class="cat-separator">'.$wcps_items_cat_separator.'</span>';


		}


			$i++;
		}
		
	$html.= '<div class="wcps-items-category" >'.$cat_html.'</div>';