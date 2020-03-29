<?php
/**
 * Admin Class
 *
 * Handles the Admin side functionality of plugin
 *
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

class Wp_spaios_Admin {

	function __construct() {
		
		// Action to add metabox
		add_action( 'add_meta_boxes', array($this, 'wp_spaios_post_sett_metabox') );

		// Action to save metabox
		add_action( 'save_post', array($this, 'wp_spaios_save_metabox_value') );

		// Action to add custom column to Gallery listing
		add_filter( 'manage_'.WP_APAIOIS_POST_TYPE.'_posts_columns', array($this, 'wp_spaios_posts_columns') );

		// Action to add custom column data to Gallery listing
		add_action('manage_'.WP_APAIOIS_POST_TYPE.'_posts_custom_column', array($this, 'wp_spaios_post_columns_data'), 10, 2);

		// Filter to add row data
		add_filter( 'post_row_actions', array($this, 'wp_spaios_add_post_row_data'), 10, 2 );

		// Action to add Attachment Popup HTML
		add_action( 'admin_footer', array($this,'wp_spaios_image_update_popup_html') );

		// Ajax call to update option
		add_action( 'wp_ajax_wp_spaios_get_attachment_edit_form', array($this, 'wp_spaios_get_attachment_edit_form'));
		add_action( 'wp_ajax_nopriv_wp_spaios_get_attachment_edit_form',array( $this, 'wp_spaios_get_attachment_edit_form'));

		// Ajax call to update attachment data
		add_action( 'wp_ajax_wp_spaios_save_attachment_data', array($this, 'wp_spaios_save_attachment_data'));
		add_action( 'wp_ajax_nopriv_wp_spaios_save_attachment_data',array( $this, 'wp_spaios_save_attachment_data'));
	}

	/**
	 * Post Settings Metabox
	 * 
	 * @package SlidersPack - All In One Image Sliders
	 * @since 1.0
	 */
	function wp_spaios_post_sett_metabox() {
		
		// Getting all post types
		$all_post_types = array(WP_APAIOIS_POST_TYPE);
		
		add_meta_box( 'wp-spaios-post-sett', __( 'Select Images', 'sliderspack-all-in-one-image-sliders' ), array($this, 'wp_spaios_post_sett_mb_content'), $all_post_types, 'normal', 'high' );
		
		add_meta_box( 'wp-spaios-select-slider', __( 'Select Slider', 'sliderspack-all-in-one-image-sliders' ), array($this, 'wp_spaios_post_selectslider_mb_content'), $all_post_types, 'normal', 'high' );
		
		add_meta_box( 'wp-spaios-post-slider-sett', __( 'Slider Parameters', 'sliderspack-all-in-one-image-sliders' ), array($this, 'wp_spaios_post_slider_sett_mb_content'), $all_post_types, 'normal', 'default' );

		add_meta_box( 'wp-spaios-meta-box-id', __( 'Shortcode', 'sliderspack-all-in-one-image-sliders' ), array($this, 'wp_spaios_display_callback'), $all_post_types, 'side');		
	}

	/**
	* Meta box to display shortcode
	*
	* @param WP_Post $post Current post object.
	*/
	function wp_spaios_display_callback( $post) {
		echo "<h3>" .__( 'Shortcode', 'sliderspack-all-in-one-image-sliders'). "</h3>";
		echo '<div class="wp-spaios-shortcode-preview">[sliders_pack id="'.$post->ID.'"]</div>';	
		echo "<h3>" .__( 'Template Code', 'sliderspack-all-in-one-image-sliders'). "</h3>";
		echo '<div class="wp-spaios-shortcode-preview">&lt;?php do_shortcode("[sliders_pack id="'.$post->ID.'"]"); ?&gt;</div>';		
	}
	
	/**
	 * Post Settings Metabox HTML
	 * 
	 * @package SlidersPack - All In One Image Sliders
	 * @since 1.0
	 */
	function wp_spaios_post_sett_mb_content() {
		include_once( WP_APAIOIS_DIR .'/includes/admin/metabox/wp-spaios-sett-metabox.php');
	}
	
	/**
	 * Post Settings Metabox HTML
	 * 
	 * @package SlidersPack - All In One Image Sliders
	 * @since 1.0
	 */
	function wp_spaios_post_selectslider_mb_content() {
		include_once( WP_APAIOIS_DIR .'/includes/admin/metabox/wp-spaios-select-slider-metabox.php');
	}

	/**
	 * Post Settings Metabox HTML
	 * 
	 * @package SlidersPack - All In One Image Sliders
	 * @since 1.0
	 */
	function wp_spaios_post_slider_sett_mb_content() {
		include_once( WP_APAIOIS_DIR .'/includes/admin/metabox/wp-spaios-slider-parameter.php');
	}
	
	/**
	 * Function to save metabox values
	 * 
	 * @package SlidersPack - All In One Image Sliders
	 * @since 1.0
	 */
	function wp_spaios_save_metabox_value( $post_id ) {

		global $post_type;

		$registered_posts = array(WP_APAIOIS_POST_TYPE); // Getting registered post types

		if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )                	// Check Autosave
		|| ( ! isset( $_POST['post_ID'] ) || $post_id != $_POST['post_ID'] )  	// Check Revision
		|| ( !current_user_can('edit_post', $post_id) )              			// Check if user can edit the post.
		|| ( !in_array($post_type, $registered_posts) ) )             			// Check if user can edit the post.
		{
		  return $post_id;
		}

		$prefix = WP_APAIOIS_META_PREFIX; // Taking metabox prefix
		
		// Slecting Slider Type
		$slider_type 		= isset($_POST[$prefix.'slider_type']) 			? $_POST[$prefix.'slider_type'] 							: '';						

		//Check Post Type
		$check_post_gallery = isset($_POST[$prefix.'check_post_gallery']) 	? wp_spaios_clean($_POST[$prefix.'check_post_gallery']) 	: 'gallery';
		
		//Post taxonomy		
		$include_category 	= isset($_POST[$prefix.'include_category']) 	? $_POST[$prefix.'include_category'] 						: '';
		
		// ACF Fiels name
		$acf_field_name 	= isset($_POST[$prefix.'acf_field_name']) 		? $_POST[$prefix.'acf_field_name'] 							: '';
		
		// Taking images value variables
		$gallery_imgs 		= isset($_POST['wp_spaios_img']) 				? wp_spaios_clean($_POST['wp_spaios_img']) 					: '';		
		
		// Getting common Variables
		$slide_media_size 				= isset($_POST[$prefix.'slide_media_size']) 		? wp_spaios_clean($_POST[$prefix.'slide_media_size']) 				: 'large';
		$slide_ptype_limit 				= !empty($_POST[$prefix.'slide_ptype_limit']) 		? wp_spaios_clean_number($_POST[$prefix.'slide_ptype_limit']) 		: 5;
		$slide_ptype_cat_name 			= isset($_POST[$prefix.'slide_ptype_cat_name']) 	? wp_spaios_clean($_POST[$prefix.'slide_ptype_cat_name']) 			: 'true';
		$slide_ptype_title 				= isset($_POST[$prefix.'slide_ptype_title']) 		? wp_spaios_clean($_POST[$prefix.'slide_ptype_title']) 				: 'true';
		$slide_ptype_content 			= isset($_POST[$prefix.'slide_ptype_content']) 		? wp_spaios_clean($_POST[$prefix.'slide_ptype_content']) 			: 'true';
		$content_word_limit 			= !empty($_POST[$prefix.'content_word_limit']) 		? wp_spaios_clean_number($_POST[$prefix.'content_word_limit']) 		: '55';
		$slide_ptype_readmorebtn 		= isset($_POST[$prefix.'slide_ptype_readmorebtn']) 	? wp_spaios_clean($_POST[$prefix.'slide_ptype_readmorebtn']) 		: 'true';
		$content_readmore_text 			= isset($_POST[$prefix.'content_readmore_text']) 	? wp_spaios_clean($_POST[$prefix.'content_readmore_text']) 			: 'Read More';
		$height 						= !empty($_POST[$prefix.'height']) 					? wp_spaios_clean_number($_POST[$prefix.'height']) 					: '';
		$width 							= !empty($_POST[$prefix.'width']) 					? wp_spaios_clean_number($_POST[$prefix.'width']) 					: '';
		$arrow 							= isset($_POST[$prefix.'arrow']) 					? wp_spaios_clean($_POST[$prefix.'arrow']) 							: 'true';
		$pagination 					= isset($_POST[$prefix.'pagination']) 				? wp_spaios_clean($_POST[$prefix.'pagination']) 					: 'true';
		$speed 							= !empty($_POST[$prefix.'speed']) 					? wp_spaios_clean_number($_POST[$prefix.'speed']) 					: '';
		$autoplay 						= isset($_POST[$prefix.'autoplay']) 				? wp_spaios_clean($_POST[$prefix.'autoplay']) 						: 'true';
		$autoplay_speed					= !empty($_POST[$prefix.'autoplay_speed']) 			? wp_spaios_clean_number($_POST[$prefix.'autoplay_speed']) 			: '';
		$loop							= isset($_POST[$prefix.'loop']) 					? wp_spaios_clean($_POST[$prefix.'loop']) 							: 'true';
		$caption						= isset($_POST[$prefix.'caption']) 					? wp_spaios_clean($_POST[$prefix.'caption']) 						: 'false';
		$fancy_box						= isset($_POST[$prefix.'fancy_box']) 				? wp_spaios_clean($_POST[$prefix.'fancy_box']) 						: 'false';
		$link_target					= isset($_POST[$prefix.'link_target']) 				? wp_spaios_clean($_POST[$prefix.'link_target']) 					: 'blank';
		

		// Getting BXSlider Variables
		if($slider_type == 'bxslider') {
			$mode_bx 					= isset($_POST[$prefix.'mode_bx']) 					? wp_spaios_clean($_POST[$prefix.'mode_bx']) 						: 'horizontal';
			$slide_to_show_bx 			= !empty($_POST[$prefix.'slide_to_show_bx']) 		? wp_spaios_clean_number($_POST[$prefix.'slide_to_show_bx']) 		: '';
			$max_slide_to_show_bx 		= !empty($_POST[$prefix.'max_slide_to_show_bx']) 	? wp_spaios_clean_number($_POST[$prefix.'max_slide_to_show_bx']) 	: '';
			$slide_to_scroll_bx 		= !empty($_POST[$prefix.'slide_to_scroll_bx']) 		? wp_spaios_clean_number($_POST[$prefix.'slide_to_scroll_bx']) 		: '';
			$slide_margin_bx 			= !empty($_POST[$prefix.'slide_margin_bx']) 		? wp_spaios_clean_number($_POST[$prefix.'slide_margin_bx']) 		: '';
			$slide_width_bx 			= !empty($_POST[$prefix.'slide_width_bx']) 			? wp_spaios_clean_number($_POST[$prefix.'slide_width_bx']) 			: '';
			$ticker_bx 					= isset($_POST[$prefix.'ticker_bx']) 				? wp_spaios_clean($_POST[$prefix.'ticker_bx']) 						: 'false';
			$ticker_hover_bx 			= isset($_POST[$prefix.'ticker_hover_bx']) 			? wp_spaios_clean($_POST[$prefix.'ticker_hover_bx']) 				: 'true';
			$start_slide_bx 			= !empty($_POST[$prefix.'start_slide_bx']) 			? wp_spaios_clean_number($_POST[$prefix.'start_slide_bx']) 			: '';
			$height_start_bx			= !empty($_POST[$prefix.'height_start_bx']) 		? wp_spaios_clean($_POST[$prefix.'height_start_bx']) 				: 'false';
			$random_start_bx			= isset($_POST[$prefix.'random_start_bx']) 			? wp_spaios_clean($_POST[$prefix.'random_start_bx']) 				: 'false';
		}
		
		// Getting FLEXSlider Variables
		if($slider_type == 'flexslider') {
			$animation_flex 			= isset($_POST[$prefix.'animation_flex']) 			? wp_spaios_clean($_POST[$prefix.'animation_flex']) 				: 'slide';		
			$slide_to_show_flex 		= !empty($_POST[$prefix.'slide_to_show_flex']) 		? wp_spaios_clean_number($_POST[$prefix.'slide_to_show_flex']) 		: '';
			$max_slide_to_show_flex 	= !empty($_POST[$prefix.'max_slide_to_show_flex']) 	? wp_spaios_clean_number($_POST[$prefix.'max_slide_to_show_flex']) 	: '';
			$slide_to_scroll_flex 		= !empty($_POST[$prefix.'slide_to_scroll_flex']) 	? wp_spaios_clean_number($_POST[$prefix.'slide_to_scroll_flex']) 	: '';
			$slide_margin_flex 			= !empty($_POST[$prefix.'slide_margin_flex']) 		? wp_spaios_clean_number($_POST[$prefix.'slide_margin_flex']) 		: '';
			$slide_width_flex 			= !empty($_POST[$prefix.'slide_width_flex']) 		? wp_spaios_clean_number($_POST[$prefix.'slide_width_flex']) 		: '';		
			$ticker_hover_flex 			= isset($_POST[$prefix.'ticker_hover_flex']) 		? wp_spaios_clean($_POST[$prefix.'ticker_hover_flex']) 				: 'true';
			$start_slide_flex 			= !empty($_POST[$prefix.'start_slide_flex']) 		? wp_spaios_clean_number($_POST[$prefix.'start_slide_flex']) 		: '';
			$height_auto_flex			= !empty($_POST[$prefix.'height_auto_flex']) 		? wp_spaios_clean($_POST[$prefix.'height_auto_flex']) 				: 'false';
			$random_start_flex			= isset($_POST[$prefix.'random_start_flex']) 		? wp_spaios_clean($_POST[$prefix.'random_start_flex']) 				: 'false';
		}
		
		// Getting Owl Slider Variables
		if($slider_type == 'owl-slider') {
			$slide_to_show_owl 			= !empty($_POST[$prefix.'slide_to_show_owl']) 		? wp_spaios_clean_number($_POST[$prefix.'slide_to_show_owl']) 		: '';
			$slide_show_ipad_owl 		= !empty($_POST[$prefix.'slide_show_ipad_owl']) 	? wp_spaios_clean_number($_POST[$prefix.'slide_show_ipad_owl']) 	: '';
			$slide_show_tablet_owl 		= !empty($_POST[$prefix.'slide_show_tablet_owl']) 	? wp_spaios_clean_number($_POST[$prefix.'slide_show_tablet_owl']) 	: '';
			$slide_show_mobile_owl 		= !empty($_POST[$prefix.'slide_show_mobile_owl']) 	? wp_spaios_clean_number($_POST[$prefix.'slide_show_mobile_owl']) 	: '';
			$slide_to_scroll_owl 		= !empty($_POST[$prefix.'slide_to_scroll_owl'])		? wp_spaios_clean_number($_POST[$prefix.'slide_to_scroll_owl']) 	: '';
			$slide_margin_owl 			= !empty($_POST[$prefix.'slide_margin_owl']) 		? wp_spaios_clean_number($_POST[$prefix.'slide_margin_owl']) 		: '';
			$slide_padding_owl 			= !empty($_POST[$prefix.'slide_padding_owl']) 		? wp_spaios_clean_number($_POST[$prefix.'slide_padding_owl']) 		: '';
			$slide_center_owl 			= isset($_POST[$prefix.'slide_center_owl']) 		? wp_spaios_clean($_POST[$prefix.'slide_center_owl']) 				: 'false';
			$slide_autowidth_owl 		= isset($_POST[$prefix.'slide_autowidth_owl']) 		? wp_spaios_clean($_POST[$prefix.'slide_autowidth_owl']) 			: 'false';
			$slide_freeDrag_owl 		= isset($_POST[$prefix.'slide_freeDrag_owl']) 		? wp_spaios_clean($_POST[$prefix.'slide_freeDrag_owl']) 			: 'false';		
			$slide_rtl_owl 				= isset($_POST[$prefix.'slide_rtl_owl']) 			? wp_spaios_clean($_POST[$prefix.'slide_rtl_owl']) 					: 'false';
			$start_slide_owl 			= !empty($_POST[$prefix.'start_slide_owl'])			? wp_spaios_clean_number($_POST[$prefix.'start_slide_owl']) 		: '';
			$height_auto_owl 			= isset($_POST[$prefix.'height_auto_owl']) 			? wp_spaios_clean($_POST[$prefix.'height_auto_owl']) 				: 'false';
		}
		
		// Getting Slide js Slider Variables
		if($slider_type == 'slidesjs') {
			$width_js 					= !empty($_POST[$prefix.'width_js']) 				? wp_spaios_clean_number($_POST[$prefix.'width_js']) 				: '';		
			$height_js 					= !empty($_POST[$prefix.'height_js']) 				? wp_spaios_clean_number($_POST[$prefix.'height_js']) 				: '';
			$start_js 					= !empty($_POST[$prefix.'start_js']) 				? wp_spaios_clean_number($_POST[$prefix.'start_js']) 				: '';
			$effect_js 					= isset($_POST[$prefix.'effect_js']) 				? wp_spaios_clean($_POST[$prefix.'effect_js']) 						: 'slide';
			$pauseon_over_js 			= isset($_POST[$prefix.'pauseon_over_js']) 			? wp_spaios_clean($_POST[$prefix.'pauseon_over_js']) 				: 'true';
		}
		
		// Getting Slide nivo Slider Variables
		if($slider_type == 'nivo-slider') {
			$width_nivo 				= !empty($_POST[$prefix.'width_nivo']) 				? wp_spaios_clean_number($_POST[$prefix.'width_nivo']) 				: '';	
			$start_nivo 				= !empty($_POST[$prefix.'start_nivo']) 				? wp_spaios_clean_number($_POST[$prefix.'start_nivo']) 				: '';
			$effect_nivo 				= isset($_POST[$prefix.'effect_nivo']) 				? wp_spaios_clean($_POST[$prefix.'effect_nivo']) 					: 'sliceDown';
			$pauseon_over_nivo 			= isset($_POST[$prefix.'pauseon_over_nivo']) 		? wp_spaios_clean($_POST[$prefix.'pauseon_over_nivo']) 				: 'true';
			$random_start_nivo			= isset($_POST[$prefix.'random_start_nivo']) 		? wp_spaios_clean($_POST[$prefix.'random_start_nivo']) 				: 'false';
		}
		
		// Getting UnSlider Variables
		if($slider_type == 'un-slider') {
			$mode_un 					= isset($_POST[$prefix.'mode_un']) 					? wp_spaios_clean($_POST[$prefix.'mode_un']) 						: 'horizontal';
			$height_un 					= !empty($_POST[$prefix.'height_un']) 				? wp_spaios_clean_number($_POST[$prefix.'height_un']) 				: '';
			$height_auto_un 			= isset($_POST[$prefix.'height_auto_un']) 			? wp_spaios_clean($_POST[$prefix.'height_auto_un']) 				: 'false';
		}

		// Getting wallop Variables height_auto_un
		if($slider_type == 'wallop-slider') {
			$mode_wallop 				= isset($_POST[$prefix.'mode_wallop']) 				? wp_spaios_clean($_POST[$prefix.'mode_wallop']) 					: 'slide';
		}
	
		// Getting 3d slider Variables
		if($slider_type == '3dslider') {
			$slide_to_show_3d 			= !empty($_POST[$prefix.'slide_to_show_3d']) 		? wp_spaios_clean_number($_POST[$prefix.'slide_to_show_3d']) 		: '';
			$slide_show_ipad_3d 		= !empty($_POST[$prefix.'slide_show_ipad_3d']) 		? wp_spaios_clean_number($_POST[$prefix.'slide_show_ipad_3d']) 		: '';
			$slide_show_tablet_3d 		= !empty($_POST[$prefix.'slide_show_tablet_3d']) 	? wp_spaios_clean_number($_POST[$prefix.'slide_show_tablet_3d']) 	: '';
			$slide_show_mobile_3d 		= !empty($_POST[$prefix.'slide_show_mobile_3d']) 	? wp_spaios_clean_number($_POST[$prefix.'slide_show_mobile_3d']) 	: '';
			$slide_to_scroll_3d 		= !empty($_POST[$prefix.'slide_to_scroll_3d']) 		? wp_spaios_clean_number($_POST[$prefix.'slide_to_scroll_3d']) 		: '';			
			$auto_stop_3d 	  			= isset($_POST[$prefix.'auto_stop_3d']) 			? wp_spaios_clean($_POST[$prefix.'auto_stop_3d']) 					: 'false';		
			$centermode_3d 				= isset($_POST[$prefix.'centermode_3d']) 			? wp_spaios_clean($_POST[$prefix.'centermode_3d']) 					: 'true';
			$space_between_3d 			= !empty($_POST[$prefix.'space_between_3d']) 		? wp_spaios_clean_number($_POST[$prefix.'space_between_3d']) 		: '';		
			$depth 						= !empty($_POST[$prefix.'depth']) 					? wp_spaios_clean_number($_POST[$prefix.'depth']) 					: '';
			$modifier 					= !empty($_POST[$prefix.'modifier']) 				? wp_spaios_clean_number($_POST[$prefix.'modifier']) 				: '';	
		}

		// Getting Swiper slider Variables
		if($slider_type == 'swiperslider') {
			$slide_to_show_swpr 		= !empty($_POST[$prefix.'slide_to_show_swpr']) 		? wp_spaios_clean_number($_POST[$prefix.'slide_to_show_swpr']) 		: '';
			$slide_show_ipad_swpr 		= !empty($_POST[$prefix.'slide_show_ipad_swpr']) 	? wp_spaios_clean_number($_POST[$prefix.'slide_show_ipad_swpr']) 	: '';
			$slide_show_tablet_swpr 	= !empty($_POST[$prefix.'slide_show_tablet_swpr']) 	? wp_spaios_clean_number($_POST[$prefix.'slide_show_tablet_swpr']) 	: '';
			$slide_show_mobile_swpr 	= !empty($_POST[$prefix.'slide_show_mobile_swpr']) 	? wp_spaios_clean_number($_POST[$prefix.'slide_show_mobile_swpr']) 	: '';
			$slide_to_scroll_swpr 		= !empty($_POST[$prefix.'slide_to_scroll_swpr']) 	? wp_spaios_clean_number($_POST[$prefix.'slide_to_scroll_swpr']) 	: '';			
			$auto_stop_swpr 			= isset($_POST[$prefix.'auto_stop_swpr']) 			? wp_spaios_clean($_POST[$prefix.'auto_stop_swpr']) 				: 'false';		
			$centermode_swpr 			= isset($_POST[$prefix.'centermode_swpr']) 			? wp_spaios_clean($_POST[$prefix.'centermode_swpr']) 				: 'true';
			$space_between_swpr 		= !empty($_POST[$prefix.'space_between_swpr']) 		? wp_spaios_clean_number($_POST[$prefix.'space_between_swpr']) 		: '';		
			$animation_swpr 			= isset($_POST[$prefix.'animation_swpr']) 			? wp_spaios_clean($_POST[$prefix.'animation_swpr']) 				: 'slide';	
			$direction_swpr 			= isset($_POST[$prefix.'direction_swpr']) 			? wp_spaios_clean($_POST[$prefix.'direction_swpr']) 				: 'horizontal';	
			$height_slider_swpr 		= !empty($_POST[$prefix.'height_slider_swpr']) 		? wp_spaios_clean_number($_POST[$prefix.'height_slider_swpr']) 		: '';
			$height_auto_swiper 		= isset($_POST[$prefix.'height_auto_swiper']) 			? wp_spaios_clean($_POST[$prefix.'height_auto_swiper']) 		: 'false';
		}

		// Style option update		
		update_post_meta($post_id, $prefix.'slider_type', $slider_type);
		update_post_meta($post_id, $prefix.'check_post_gallery', $check_post_gallery);		
		update_post_meta($post_id, $prefix.'include_category', $include_category);		
		update_post_meta($post_id, $prefix.'acf_field_name', $acf_field_name);		
		update_post_meta($post_id, $prefix.'gallery_id', $gallery_imgs);		

		// Updating Coomon settings  
		update_post_meta($post_id, $prefix.'slide_media_size', $slide_media_size);
		update_post_meta($post_id, $prefix.'slide_ptype_limit', $slide_ptype_limit);
		update_post_meta($post_id, $prefix.'slide_ptype_cat_name', $slide_ptype_cat_name);
		update_post_meta($post_id, $prefix.'slide_ptype_title', $slide_ptype_title);
		update_post_meta($post_id, $prefix.'slide_ptype_content', $slide_ptype_content);
		update_post_meta($post_id, $prefix.'content_word_limit', $content_word_limit);
		update_post_meta($post_id, $prefix.'slide_ptype_readmorebtn', $slide_ptype_readmorebtn);
		update_post_meta($post_id, $prefix.'content_readmore_text', $content_readmore_text);
		update_post_meta($post_id, $prefix.'link_target', $link_target);

		update_post_meta($post_id, $prefix.'arrow', $arrow);
		update_post_meta($post_id, $prefix.'pagination', $pagination);
		update_post_meta($post_id, $prefix.'speed', $speed);
		update_post_meta($post_id, $prefix.'autoplay', $autoplay);
		update_post_meta($post_id, $prefix.'autoplay_speed', $autoplay_speed);
		update_post_meta($post_id, $prefix.'loop', $loop);		
		update_post_meta($post_id, $prefix.'caption', $caption);
		update_post_meta($post_id, $prefix.'fancy_box', $fancy_box);		
		
		// Updating bxSlider settings
		if($slider_type == 'bxslider') {
			update_post_meta($post_id, $prefix.'mode_bx', $mode_bx);
			update_post_meta($post_id, $prefix.'slide_to_show_bx', $slide_to_show_bx);
			update_post_meta($post_id, $prefix.'max_slide_to_show_bx', $max_slide_to_show_bx);
			update_post_meta($post_id, $prefix.'slide_to_scroll_bx', $slide_to_scroll_bx);
			update_post_meta($post_id, $prefix.'slide_margin_bx', $slide_margin_bx);
			update_post_meta($post_id, $prefix.'slide_width_bx', $slide_width_bx);
			update_post_meta($post_id, $prefix.'ticker_bx', $ticker_bx);
			update_post_meta($post_id, $prefix.'ticker_hover_bx', $ticker_hover_bx);
			update_post_meta($post_id, $prefix.'height_start_bx', $height_start_bx);
			update_post_meta($post_id, $prefix.'random_start_bx', $random_start_bx);		
			update_post_meta($post_id, $prefix.'start_slide_bx', $start_slide_bx);
		}

		// Updating flexSlider settings
		if($slider_type == 'flexslider') {
			update_post_meta($post_id, $prefix.'animation_flex', $animation_flex);		
			update_post_meta($post_id, $prefix.'slide_to_show_flex', $slide_to_show_flex);
			update_post_meta($post_id, $prefix.'max_slide_to_show_flex', $max_slide_to_show_flex);
			update_post_meta($post_id, $prefix.'slide_to_scroll_flex', $slide_to_scroll_flex);
			update_post_meta($post_id, $prefix.'slide_margin_flex', $slide_margin_flex);
			update_post_meta($post_id, $prefix.'slide_width_flex', $slide_width_flex);		
			update_post_meta($post_id, $prefix.'ticker_hover_flex', $ticker_hover_flex);
			update_post_meta($post_id, $prefix.'height_auto_flex', $height_auto_flex); 
			update_post_meta($post_id, $prefix.'random_start_flex', $random_start_flex);		
			update_post_meta($post_id, $prefix.'start_slide_flex', $start_slide_flex);
		}

		// Updating owlSlider settings
		if($slider_type == 'owl-slider') {
			update_post_meta($post_id, $prefix.'slide_to_show_owl', $slide_to_show_owl);
			update_post_meta($post_id, $prefix.'slide_show_ipad_owl', $slide_show_ipad_owl);
			update_post_meta($post_id, $prefix.'slide_show_tablet_owl', $slide_show_tablet_owl);
			update_post_meta($post_id, $prefix.'slide_show_mobile_owl', $slide_show_mobile_owl);
			update_post_meta($post_id, $prefix.'slide_to_scroll_owl', $slide_to_scroll_owl);
			update_post_meta($post_id, $prefix.'slide_margin_owl', $slide_margin_owl);
			update_post_meta($post_id, $prefix.'slide_padding_owl', $slide_padding_owl);
			update_post_meta($post_id, $prefix.'slide_center_owl', $slide_center_owl);
			update_post_meta($post_id, $prefix.'slide_autowidth_owl', $slide_autowidth_owl);
			update_post_meta($post_id, $prefix.'slide_freeDrag_owl', $slide_freeDrag_owl);		
			update_post_meta($post_id, $prefix.'slide_rtl_owl', $slide_rtl_owl);
			update_post_meta($post_id, $prefix.'start_slide_owl', $start_slide_owl);
			update_post_meta($post_id, $prefix.'height_auto_owl', $height_auto_owl);
		}

		// Updating Slider Js Slider settings
		if($slider_type == 'slidesjs') {
			update_post_meta($post_id, $prefix.'width_js', $width_js);		
			update_post_meta($post_id, $prefix.'height_js', $height_js);
			update_post_meta($post_id, $prefix.'start_js', $start_js);
			update_post_meta($post_id, $prefix.'effect_js', $effect_js);
			update_post_meta($post_id, $prefix.'pauseon_over_js', $pauseon_over_js);		
		}

		// Updating Nivo Js Slider settings
		if($slider_type == 'nivo-slider') {
			update_post_meta($post_id, $prefix.'width_nivo', $width_nivo);		
			update_post_meta($post_id, $prefix.'start_nivo', $start_nivo);
			update_post_meta($post_id, $prefix.'effect_nivo', $effect_nivo);
			update_post_meta($post_id, $prefix.'pauseon_over_nivo', $pauseon_over_nivo);		
			update_post_meta($post_id, $prefix.'random_start_nivo', $random_start_nivo);
		}

		// Updating UnSlider settings 
		if($slider_type == 'un-slider') {
			update_post_meta($post_id, $prefix.'mode_un', $mode_un);
			update_post_meta($post_id, $prefix.'height_un', $height_un); 	
			update_post_meta($post_id, $prefix.'height_auto_un', $height_auto_un); 		
		}

		// Updating wallop Slider settings
		if($slider_type == 'wallop-slider') {
			update_post_meta($post_id, $prefix.'mode_wallop', $mode_wallop);
		}
		
		// Updating 3d slider settings
		if($slider_type == '3dslider') {
			update_post_meta($post_id, $prefix.'slide_to_show_3d', $slide_to_show_3d);
			update_post_meta($post_id, $prefix.'slide_show_ipad_3d', $slide_show_ipad_3d);
			update_post_meta($post_id, $prefix.'slide_show_tablet_3d', $slide_show_tablet_3d);
			update_post_meta($post_id, $prefix.'slide_show_mobile_3d', $slide_show_mobile_3d);
			update_post_meta($post_id, $prefix.'slide_to_scroll_3d', $slide_to_scroll_3d);
			update_post_meta($post_id, $prefix.'auto_stop_3d', $auto_stop_3d);
			update_post_meta($post_id, $prefix.'centermode_3d', $centermode_3d);
			update_post_meta($post_id, $prefix.'space_between_3d', $space_between_3d);
			update_post_meta($post_id, $prefix.'depth', $depth);
			update_post_meta($post_id, $prefix.'modifier', $modifier);	
		}

		// Updating swpr slider settings
		if($slider_type == 'swiperslider') {
			update_post_meta($post_id, $prefix.'slide_to_show_swpr', $slide_to_show_swpr);
			update_post_meta($post_id, $prefix.'slide_show_ipad_swpr', $slide_show_ipad_swpr);
			update_post_meta($post_id, $prefix.'slide_show_tablet_swpr', $slide_show_tablet_swpr);
			update_post_meta($post_id, $prefix.'slide_show_mobile_swpr', $slide_show_mobile_swpr);
			update_post_meta($post_id, $prefix.'slide_to_scroll_swpr', $slide_to_scroll_swpr);
			update_post_meta($post_id, $prefix.'auto_stop_swpr', $auto_stop_swpr);
			update_post_meta($post_id, $prefix.'centermode_swpr', $centermode_swpr);
			update_post_meta($post_id, $prefix.'space_between_swpr', $space_between_swpr);
			update_post_meta($post_id, $prefix.'animation_swpr', $animation_swpr);
			update_post_meta($post_id, $prefix.'direction_swpr', $direction_swpr);
			update_post_meta($post_id, $prefix.'height_slider_swpr', $height_slider_swpr);		 
			update_post_meta($post_id, $prefix.'height_auto_swiper', $height_auto_swiper);
		}
	}

	/**
	 * Add custom column to Post listing page
	 * 
	 * @package SlidersPack - All In One Image Sliders
	 * @since 1.0
	 */
	function wp_spaios_posts_columns( $columns ) {

	    $new_columns['wp_spaios_shortcode'] 	= __('Shortcode', 'sliderspack-all-in-one-image-sliders');
	    $new_columns['wp_spaios_photos'] 		= __('Number of Photos', 'sliderspack-all-in-one-image-sliders');
		$new_columns['wp_spaios_slider_type'] 			= __('Slider Type', 'sliderspack-all-in-one-image-sliders');
		
	    $columns = wp_spaios_add_array( $columns, $new_columns, 1, true );

	    return $columns;
	}

	/**
	 * Add custom column data to Post listing page
	 * 
	 * @package SlidersPack - All In One Image Sliders
	 * @since 1.0
	 */
	function wp_spaios_post_columns_data( $column, $post_id ) {

		global $post;
		// Taking some variables
		$prefix = WP_APAIOIS_META_PREFIX;		
		
	    switch ($column) {
	    	case 'wp_spaios_shortcode':	    		
					echo '<div class="wp-spaios-shortcode-preview">[sliders_pack id="'.$post_id.'"]</div>';				
	    		break;

	    	case 'wp_spaios_photos':
	    		$total_photos = get_post_meta($post_id, $prefix.'gallery_id', true);
	    		echo !empty($total_photos) ? count($total_photos) : '--';
	    		break;
	    		
	    	case 'wp_spaios_slider_type':
				$slider_type_list 	= wp_spaios_slider_type();
	    		$slider_type = get_post_meta($post_id, $prefix.'slider_type', true);
	    		if( !empty($slider_type)){
					if( !empty($slider_type_list) ) {
						foreach ($slider_type_list as $key => $value) {
							if($slider_type == $key){ echo '<div class="wp-spaios-slider-type">'.$value.'</div>'; }
						}
					}
				}else{
					echo '<div class="wp-spaios-slider-type">--</div>';
				}
	    		break;
		}
	}

	/**
	 * Function to add custom quick links at post listing page
	 * 
	 * @package SlidersPack - All In One Image Sliders
	 * @since 1.0
	 */
	function wp_spaios_add_post_row_data( $actions, $post ) {
		
		if( $post->post_type == WP_APAIOIS_POST_TYPE ) {
			return array_merge( array( 'wp_spaios_id' => 'ID: ' . $post->ID ), $actions );
		}
		
		return $actions;
	}

	/**
	 * Image data popup HTML
	 * 
	 * @package SlidersPack - All In One Image Sliders
	 * @since 1.0
	 */
	function wp_spaios_image_update_popup_html() {

		global $post_type;

		$registered_posts = array(WP_APAIOIS_POST_TYPE); // Getting registered post types

		if( in_array($post_type, $registered_posts) ) {
			include_once( WP_APAIOIS_DIR .'/includes/admin/settings/wp-spaios-img-popup.php');
		}
	}

	/**
	 * Get attachment edit form
	 * 
	 * @package SlidersPack - All In One Image Sliders
	 * @since 1.0
	 */
	function wp_spaios_get_attachment_edit_form() {
		
		// Taking some defaults
		$result 			= array();
		$result['success'] 	= 0;
		$result['msg'] 		= __('Sorry, Something happened wrong.', 'sliderspack-all-in-one-image-sliders');
		$attachment_id 		= !empty($_POST['attachment_id']) ? trim($_POST['attachment_id']) : '';
	
		if( !empty($attachment_id) ) {
			
			$attachment_post = get_post( $_POST['attachment_id'] );
			
			if( !empty($attachment_post) ) {
				
				ob_start();

				// Popup Data File
				include( WP_APAIOIS_DIR . '/includes/admin/settings/wp-spaios-img-popup-data.php' );

				$attachment_data = ob_get_clean();

				$result['success'] 	= 1;
				$result['msg'] 		= __('Attachment Found.', 'sliderspack-all-in-one-image-sliders');
				$result['data']		= $attachment_data;
			}
		}
	
		echo json_encode($result);
		exit;
	}

	/**
	 * Get attachment edit form
	 * 
	 * @package SlidersPack - All In One Image Sliders
	 * @since 1.0
	 */
	function wp_spaios_save_attachment_data() {

		global $wp_error;

		$prefix 			= WP_APAIOIS_META_PREFIX;
		$result 			= array();
		$result['success'] 	= 0;
		$result['msg'] 		= __('Sorry, Something happened wrong.', 'sliderspack-all-in-one-image-sliders');
		$attachment_id 		= !empty($_POST['attachment_id']) ? trim($_POST['attachment_id']) : '';
		$form_data 			= parse_str($_POST['form_data'], $form_data_arr);

		if( !empty($attachment_id) && !empty($form_data_arr) ) {

			// Getting attachment post
			$wp_spaios_attachment_post = get_post( $attachment_id );

			// If post type is attachment
			if( isset($wp_spaios_attachment_post->post_type) && $wp_spaios_attachment_post->post_type == 'attachment' ) {
				$post_args = array(
									'ID'			=> $attachment_id,
									'post_title'	=> !empty($form_data_arr['wp_spaios_attachment_title']) ? $form_data_arr['wp_spaios_attachment_title'] : $wp_spaios_attachment_post->post_name,									
									'post_excerpt'	=> $form_data_arr['wp_spaios_attachment_caption'],
								);
				$update = wp_update_post( $post_args, $wp_error );

				if( !is_wp_error( $update ) ) {

					update_post_meta( $attachment_id, '_wp_attachment_image_alt', wp_spaios_clean($form_data_arr['wp_spaios_attachment_alt']) );
					update_post_meta( $attachment_id, $prefix.'attachment_link', wp_spaios_clean_url($form_data_arr['wp_spaios_attachment_link']) );

					$result['success'] 	= 1;
					$result['msg'] 		= __('Your changes saved successfully.', 'sliderspack-all-in-one-image-sliders');
				}
			}
		}
		echo json_encode($result);
		exit;
	}
}

$wp_spaios_admin = new Wp_spaios_Admin();