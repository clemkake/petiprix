<?php

/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 
	
	$title_text = get_the_title(get_the_ID());
	
	$html_title = '<div class="wcps-items-title" ><a style="color:'.$wcps_items_title_color.';font-size:'.$wcps_items_title_font_size.'" href="'.$permalink.'">'.$title_text.'</a></div>';
	
	$html.= apply_filters( 'wcps_filter_title', $html_title );