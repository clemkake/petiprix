<?php

/*
* @Author 		PickPlugins
* Copyright: 	2015 PickPlugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


$meta_query = array();
$default_query = array();
$tax_terms = array();
$tax_query = array();
$query_parameter = array();

	

	
/*Categories and taxonomies*/

//var_dump($wcps_product_categories);



if(!empty($wcps_product_categories))
foreach($wcps_product_categories as $category){
    $tax_cat = explode(',',$category);

    $taxonomy = isset($tax_cat[0]) ? $tax_cat[0] : '';
    $term_id  = isset($tax_cat[1]) ? $tax_cat[1] : '';

    if(!empty($taxonomy) && !empty($term_id))
    $tax_terms[$taxonomy][] = $term_id;

    }

//var_dump($tax_terms);



if(!empty($tax_terms))
foreach($tax_terms as $taxonomy=>$terms){

    $tax_query[] = array(
        'taxonomy' => $taxonomy,
        'field'    => 'id',
        'terms'    => $terms,
        //'operator'    => '',
        );

    }




if($wcps_hide_out_of_stock=='yes'){

    $tax_query[] = array(
        'taxonomy' => 'product_visibility',
        'field' => 'name',
        'terms' => 'outofstock',
        'operator' => 'NOT IN',
    );

}


if($wcps_product_featured=='yes'){

    $tax_query[] = array(
        'taxonomy' => 'product_visibility',
        'field' => 'name',
        'terms' => 'featured',
        'operator' => 'IN',
    );

}
elseif($wcps_product_featured=='no'){

    $tax_query[] = array(
        'taxonomy' => 'product_visibility',
        'field' => 'name',
        'terms' => 'featured',
        'operator' => 'NOT IN',
    );

}

	
	
if($wcps_product_on_sale=='yes'){


    $wc_get_product_ids_on_sale = wc_get_product_ids_on_sale();
    //echo '<pre>'.var_export($wc_get_product_ids_on_sale, true).'</pre>';

    $default_query['post__in'] = $wc_get_product_ids_on_sale;




//    $meta_query[] =  array(
//        'relation' => 'OR',
//        array( // Variable products type
//            'key'           => '_min_variation_sale_price',
//            'value'         => 0,
//            'compare'       => '>',
//            'type'          => 'numeric'
//        ),
//            array(
//            'key' => '_sale_price',
//            'value' => 0,
//            'compare' => '>',
//            'type' => 'NUMERIC'
//            )
//        );

}
	



	
	
	if(!empty($wcps_product_ids)){

		$wcps_product_ids = array_map('intval',explode(',', $wcps_product_ids));
	}
	else{
		$wcps_product_ids = array();

	}



$default_query['post_type'] = 'product';
$default_query['post_status'] = 'publish';
$default_query['posts_per_page'] = $wcps_total_items;

if(!empty($wcps_query_orderby) && $wcps_query_orderby != 'none')
    $default_query['orderby'] = $wcps_query_orderby;

$default_query['order'] = $wcps_query_order;






if(!empty($meta_query))
    $default_query['meta_query'] = $meta_query;

if(!empty($tax_query))
    $default_query['tax_query'] = $tax_query;





//echo '<pre>'.var_export($query_args).'</pre>';

$query_args = array_merge($default_query, $query_parameter);


    //echo '<pre>'.var_export($query_args, true).'</pre>';

	
	$query_args = apply_filters('wcps_filter_query_args', $query_args);

	
	$wp_query = new WP_Query($query_args);




