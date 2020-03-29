<?php
if ( ! defined('ABSPATH')) exit;  // if direct access




//add_filter( 'body_class', 'custom_class' );
function custom_class( $classes ) {



    if(is_singular('page')):
        global $post;
        $content = $post->content;

        if ( has_shortcode( $content, 'wcps_builder' ) ) {
            $classes[] = 'wcps_builder';
        }
    endif;


    return $classes;
}



























/*

function wcps_grid_items($grid_items){
		
			$grid_items_extra = array(
							'thumb1'=>'Thumbnail 1',
							'title1'=>'Title 1',																												
							);
							
			$grid_items = array_merge($grid_items,$grid_items_extra);
			
			return $grid_items;
		}

add_filter('wcps_grid_items', 'wcps_grid_items');

*/





function wcps_get_categories($post_id){
	

	$post_types =  array('product');

	$wcps_product_categories = get_post_meta( $post_id, 'wcps_product_categories', true );
	
	if(!empty($wcps_product_categories)){
		$categories = $wcps_product_categories;
		}
	else{
		$categories = array();
		}
	
	
	
	$taxonomies = get_object_taxonomies( $post_types );

	//var_dump($taxonomies);


	if(!empty($taxonomies)){
		
		echo '<select  class="categories" name="wcps_product_categories[]" multiple="multiple" size="10">';
		
		foreach ($taxonomies as $taxonomy ) {

		    if($taxonomy != 'product_cat') continue;
			
			$the_taxonomy = get_taxonomy($taxonomy);
			
			$args=array(
			  'orderby' => 'name',
			  'order' => 'ASC',
			  'taxonomy' => $taxonomy,
			  'hide_empty' => false,
			  );
			
			$categories_all = get_categories($args);
			
			if(!empty($categories_all)){
				
				//var_dump($categories_all);
				
				
				?>
				<option disabled value="<?php echo $taxonomy; ?>" > - - - <?php echo $the_taxonomy->labels->name; ?> - - -</option>
										 
				<?php
				foreach($categories_all as $category_info){
					
					if(in_array($taxonomy.','.$category_info->cat_ID, $categories)){
						$selected = 'selected';
						}
					else{
						$selected = '';
						}
					
					?>
					<option <?php echo $selected; ?> value="<?php echo $taxonomy.','.$category_info->cat_ID; ?>" ><?php echo $category_info->cat_name; echo ' (Total Post: '.$category_info->count.')'; ?></option>
					<?php
			
					
					}
				
				}
	
			
			}
		
		echo '</select>';
	
		}
	else{
		echo 'No categories found.';
		}
		
		
	
	
	}
	






















add_action( 'template_redirect', 'wcps_track_product_view', 20 );


function wcps_track_product_view() {
	
	$wcps_track_product_view = get_option( 'wcps_track_product_view' );
	
	if($wcps_track_product_view=='yes' && is_singular('product')){
        global $post;

        if ( empty( $_COOKIE['woocommerce_recently_viewed'] ) )
            $viewed_products = array();
        else
            $viewed_products = (array) explode( '|', $_COOKIE['woocommerce_recently_viewed'] );

        if ( ! in_array( $post->ID, $viewed_products ) ) {
            $viewed_products[] = $post->ID;
        }

        if ( sizeof( $viewed_products ) > 15 ) {
            array_shift( $viewed_products );
        }

        //var_dump($viewed_products);


        // Store for session only
        wc_setcookie( 'woocommerce_recently_viewed', implode( '|', $viewed_products ) );
    }


}






















function wcps_add_shortcode_column( $columns ) {
    return array_merge( $columns, 
        array( 'shortcode' => __( 'Shortcode',  'woocommerce-products-slider' ) ) );
}
add_filter( 'manage_wcps_posts_columns' , 'wcps_add_shortcode_column' );


function wcps_posts_shortcode_display( $column, $post_id ) {
    if ($column == 'shortcode'){
		?>
        <input style="background:#bfefff" type="text" onClick="this.select();" value="[wcps <?php echo 'id=&quot;'.$post_id.'&quot;';?>]" /><br />
      <textarea cols="50" rows="1" style="background:#bfefff" onClick="this.select();" ><?php echo '<?php echo do_shortcode("[wcps id='; echo "'".$post_id."']"; echo '"); ?>'; ?></textarea>
        <?php		
		
    }
}
add_action( 'manage_wcps_posts_custom_column' , 'wcps_posts_shortcode_display', 10, 2 );










function wcps_grid_items_reset(){
	
	if(current_user_can('manage_options')){
		
		$wcps_id = sanitize_text_field($_POST['wcps_id']);
		
		if(delete_post_meta($wcps_id, 'wcps_grid_items')){
			echo __('Reset done!', 'woocommerce-products-slider');
			}
		else{
			echo __('Reset failed!', 'woocommerce-products-slider');
			}
			
		}

	die();
	
	}
	
add_action('wp_ajax_wcps_grid_items_reset', 'wcps_grid_items_reset');
//add_action('wp_ajax_nopriv_wcps_grid_items_reset', 'wcps_grid_items_reset');



function wcps_get_item_thumb_url(){
	
	
	$product_id = (int)sanitize_text_field($_POST['product_id']);
	
	$wcps_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($product_id), 'full' );
	$wcps_thumb_url = $wcps_thumb['0'];
	
	
	echo $wcps_thumb_url;
	
	die();
	
	}
	
add_action('wp_ajax_wcps_get_item_thumb_url', 'wcps_get_item_thumb_url');
add_action('wp_ajax_nopriv_wcps_get_item_thumb_url', 'wcps_get_item_thumb_url');



















function wcps_get_product_categories($postid)
	{
		
		$taxonomy= "product_cat";
		$wcps_taxonomy_category = get_post_meta( $postid, 'wcps_slide_categories', true );
		$args=array(
		  'orderby' => 'name',
		  'order' => 'ASC',
		  'taxonomy' => $taxonomy,
		  );
	
	$categories = get_categories($args);
	
	
	if(empty($categories))
		{
		echo __('No categories found!', 'woocommerce-products-slider');
			$categories = array();
		}
	
	
		$html = '';
		$html .= '<ul style="margin: 0;">';
	
	foreach($categories as $category){
		
		if(array_search($category->cat_ID, $wcps_taxonomy_category))
			{
				$html .= '<li class='.$category->cat_ID.'><label ><input checked type="checkbox" name="wcps_slide_categories['.$category->cat_ID.']" value ="'.$category->cat_ID.'" />'.$category->cat_name.'</label ></li>';
			}
		
		else
			{
				$html .= '<li class='.$category->cat_ID.'><label ><input type="checkbox" name="wcps_slide_categories['.$category->cat_ID.']" value ="'.$category->cat_ID.'" />'.$category->cat_name.'</label ></li>';			
			}
		
		

		
		}
	
		$html .= '</ul>';
		
		echo $html;
	
		
	}











	
	
		
	function wcps_admin_notices()
		{
			$wcps_license_key = get_option('wcps_license_key');
			
			$html= '';
			
			
			
			if(empty($wcps_license_key))
				{
					$admin_url = get_admin_url();
					
					$html.= '<div class="update-nag">';
					$html.= sprintf(__('Please activate your license for <b>%s &raquo; <a href="%sedit.php?post_type=wcps&page=wcps_menu_license">License</a></b>', 'woocommerce-products-slider') ,wcps_plugin_name, $admin_url);
					
					
					$html.= '</div>';	
				}
			else
				{

				}
			
			
			
			
			
			
								
			
			
			echo $html;
		}
	
	//add_action('admin_notices', 'wcps_admin_notices');
	