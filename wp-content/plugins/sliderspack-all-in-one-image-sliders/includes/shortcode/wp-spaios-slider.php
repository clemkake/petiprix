<?php
/**
 * 
 * @package  SlidersPack - All In One Image Sliders
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

function wp_spaios_slider_shortcode( $atts, $content = null) {
	
	extract(shortcode_atts(array(
		'id'				=> '',
	), $atts));
	
	// Taking some globals
	global $post;

	// Taking some variables
	$unique 		= wp_spaios_get_unique();
	$slider_id 		= !empty($id) ? $id	: $post->ID;
	$prefix 		= WP_APAIOIS_META_PREFIX; // Metabox prefix

	//Check Post Gallery
	$check_post_gallery			= get_post_meta( $slider_id, $prefix.'check_post_gallery', true );
	$slider_type 				= get_post_meta( $id, $prefix.'slider_type', true );

	// Taking Common values	
	$slide_media_size 			= get_post_meta( $slider_id, $prefix.'slide_media_size', true );
	$slide_media_size 			= (!empty($slide_media_size)) 	? $slide_media_size 	: 'full';
	$arrow						= get_post_meta( $slider_id, $prefix.'arrow', true );
	$pagination 				= get_post_meta( $slider_id, $prefix.'pagination', true );
	$speed 						= get_post_meta( $slider_id, $prefix.'speed', true );
	$speed 						= (!empty($speed)) 				? $speed 				: '300';
	$autoplay 					= get_post_meta( $slider_id, $prefix.'autoplay', true );
	$autoplay_speed				= get_post_meta( $slider_id, $prefix.'autoplay_speed', true );
	$autoplay_speed 			= (!empty($autoplay_speed)) 	? $autoplay_speed 		: '3000';
	$loop						= get_post_meta( $slider_id, $prefix.'loop', true );
	$caption					= get_post_meta( $slider_id, $prefix.'caption', true );
	$fancy_box					= get_post_meta( $slider_id, $prefix.'fancy_box', true );
	$fancy_box 					= ($fancy_box == 'true') 		? 1 					: 0;
	$link_target 				= get_post_meta( $slider_id, $prefix.'link_target', true );
	$link_target 				= ($link_target == 'blank') 	? '_blank' 				: '_self';
	
	if($fancy_box) {
		wp_enqueue_style( 'wp-fancybox-public-css' );
		wp_enqueue_script( 'wp-fancybox-public-js' );
	}

	// Gallery Type Images
	if($check_post_gallery == 'gallery') {
		$images 			= get_post_meta($slider_id, $prefix.'gallery_id', true);
	}

	if($check_post_gallery == 'acf-gallery') {
		$acf_images 		= get_post_meta($slider_id, $prefix.'acf_field_name', true);
		$acf_gallery_img 	= get_field($acf_images);
	}

	// Get Post data
	if($check_post_gallery == 'post') {

		// Include category 
		$include_category 	= get_post_meta( $id, $prefix.'include_category', true );
		$include_category 	= (!empty($include_category))		? explode(',',$include_category) 	: '';

		$slide_ptype_cat_name		= get_post_meta( $slider_id, $prefix.'slide_ptype_cat_name', true );
		$slide_ptype_title			= get_post_meta( $slider_id, $prefix.'slide_ptype_title', true );
		$slide_ptype_content		= get_post_meta( $slider_id, $prefix.'slide_ptype_content', true );
		$words_limit				= get_post_meta( $slider_id, $prefix.'content_word_limit', true );
		$words_limit				= !empty($words_limit) 		? $words_limit  					: '55';
		$slide_ptype_readmorebtn	= get_post_meta( $slider_id, $prefix.'slide_ptype_readmorebtn', true );
		$read_more_text				= get_post_meta( $slider_id, $prefix.'content_readmore_text', true );
		$read_more_text				= !empty($read_more_text) 	? $read_more_text 					: __('Read More' , 'sliderspack');
		$slide_ptype_limit 			= get_post_meta( $id, $prefix.'slide_ptype_limit', true );

		//Post Type Parameter
		$support_post_types = 'post';
		$texonmy_terms 		= 'category';
		$content_tail 		= "...";

		//WP Query Argument
		$args = array ( 
			'post_type'			=> $support_post_types, 
			'order'				=> 'DESC',
			'orderby'			=> 'date',
			'posts_per_page'	=> $slide_ptype_limit,
		);

		// Category Parameter
		if($include_category != "") {

			$args['tax_query'] = array(
										array( 
											'taxonomy' 	=> $texonmy_terms,
											'field' 	=> 'term_id',
											'terms' 	=> $include_category,
									));

		}

		//WP Query
		$query 	= new WP_Query($args);
	}

	// Taking bxSlider values	
	if($slider_type == 'bxslider') {
		$mode_bx				= get_post_meta( $slider_id, $prefix.'mode_bx', true );
		$slide_to_show_bx		= get_post_meta( $slider_id, $prefix.'slide_to_show_bx', true );
		$slide_to_show_bx 		= (!empty($slide_to_show_bx)) ? $slide_to_show_bx : '1';
		
		$max_slide_to_show_bx	= get_post_meta( $slider_id, $prefix.'max_slide_to_show_bx', true );
		$max_slide_to_show_bx 	= (!empty($max_slide_to_show_bx)) ? $max_slide_to_show_bx : '1';
		
		$slide_to_scroll_bx		= get_post_meta( $slider_id, $prefix.'slide_to_scroll_bx', true );
		$slide_to_scroll_bx		= (!empty($slide_to_scroll_bx)) ? $slide_to_scroll_bx : '1';

		$slide_margin_bx   		= get_post_meta( $slider_id, $prefix.'slide_margin_bx', true );
		$slide_margin_bx 		= (!empty($slide_margin_bx)) ? $slide_margin_bx : '0';
		
		$slide_width_bx   		= get_post_meta( $slider_id, $prefix.'slide_width_bx', true );
		$slide_width_bx 		= (!empty($slide_width_bx)) ? $slide_width_bx : '0';
		
		$start_slide_bx   		= get_post_meta( $slider_id, $prefix.'start_slide_bx', true );
		$start_slide_bx 		= (!empty($start_slide_bx)) ? $start_slide_bx : '0';
		
		$ticker_bx				= get_post_meta( $slider_id, $prefix.'ticker_bx', true );		
		$ticker_hover_bx		= get_post_meta( $slider_id, $prefix.'ticker_hover_bx', true );		
		$height_start_bx		= get_post_meta( $slider_id, $prefix.'height_start_bx', true );
		$random_start_bx		= get_post_meta( $slider_id, $prefix.'random_start_bx', true );

		// Slider configuration
		$slider_conf = compact('arrow', 'pagination', 'speed', 'autoplay', 'autoplay_speed', 'loop', 'mode_bx', 'slide_to_show_bx', 'max_slide_to_show_bx', 'slide_to_scroll_bx', 'slide_margin_bx', 'slide_width_bx', 'start_slide_bx', 'ticker_bx', 'ticker_hover_bx', 'height_start_bx', 'random_start_bx', 'caption');

		// Enquque JS & CSS
		wp_enqueue_style( 'wpos-bxslider-style');
		wp_enqueue_script( 'wpos-bxslider-jquery' );
		wp_enqueue_script( 'wpos-bxslider-public' );
	}
	
	// Taking flexSlider values	
	if($slider_type == 'flexslider') {
		$animation_flex			= get_post_meta( $slider_id, $prefix.'animation_flex', true );		
		$slide_to_show_flex		= get_post_meta( $slider_id, $prefix.'slide_to_show_flex', true );
		$slide_to_show_flex 	= (!empty($slide_to_show_flex)) ? $slide_to_show_flex : '1';
		
		$max_slide_to_show_flex	= get_post_meta( $slider_id, $prefix.'max_slide_to_show_flex', true );
		$max_slide_to_show_flex = (!empty($max_slide_to_show_flex)) ? $max_slide_to_show_flex : '1';
		
		$slide_to_scroll_flex	= get_post_meta( $slider_id, $prefix.'slide_to_scroll_flex', true );
		$slide_to_scroll_flex	= (!empty($slide_to_scroll_flex)) ? $slide_to_scroll_flex : '1';

		$slide_margin_flex 		= get_post_meta( $slider_id, $prefix.'slide_margin_flex', true );
		$slide_margin_flex		= (!empty($slide_margin_flex)) ? $slide_margin_flex : '0';
		
		$slide_width_flex  	 	= get_post_meta( $slider_id, $prefix.'slide_width_flex', true );
		$slide_width_flex 		= (!empty($slide_width_flex)) ? $slide_width_flex : '0';
		
		$start_slide_flex   	= get_post_meta( $slider_id, $prefix.'start_slide_flex', true );
		$start_slide_flex 		= (!empty($start_slide_flex)) ? $start_slide_flex : '0';	
		
		$ticker_hover_flex		= get_post_meta( $slider_id, $prefix.'ticker_hover_flex', true );
		$height_auto_flex		= get_post_meta( $slider_id, $prefix.'height_auto_flex', true );
		$random_start_flex		= get_post_meta( $slider_id, $prefix.'random_start_flex', true );
		
		// Slider configuration
		$slider_conf = compact('arrow', 'pagination', 'speed', 'autoplay', 'autoplay_speed', 'loop', 'animation_flex', 'slide_to_show_flex','max_slide_to_show_flex', 'slide_to_scroll_flex', 'slide_margin_flex', 'slide_width_flex', 'start_slide_flex', 'ticker_hover_flex', 'height_auto_flex', 'random_start_flex', 'caption');

		// Enqueue JS & CSS
		wp_enqueue_style( 'wpos-flexslider-style');
		wp_enqueue_script( 'wpos-flexslider-jquery' );
		wp_enqueue_script( 'wpos-flexslider-public' );
	}

	// Taking owl Slider values
	if($slider_type == 'owl-slider') {
		$slide_to_show_owl	= get_post_meta( $slider_id, $prefix.'slide_to_show_owl', true );
		$slide_to_show_owl 	= (!empty($slide_to_show_owl)) ? $slide_to_show_owl : '3';	

		$slide_show_ipad_owl	= get_post_meta( $slider_id, $prefix.'slide_show_ipad_owl', true );
		$slide_show_ipad_owl	= (!empty($slide_show_ipad_owl)) ? $slide_show_ipad_owl : '2';

		$slide_show_tablet_owl	= get_post_meta( $slider_id, $prefix.'slide_show_tablet_owl', true );
		$slide_show_tablet_owl	= (!empty($slide_show_tablet_owl)) ? $slide_show_tablet_owl : '1';

		$slide_show_mobile_owl	= get_post_meta( $slider_id, $prefix.'slide_show_mobile_owl', true );
		$slide_show_mobile_owl	= (!empty($slide_show_mobile_owl)) ? $slide_show_mobile_owl : '1';
		
		$slide_to_scroll_owl	= get_post_meta( $slider_id, $prefix.'slide_to_scroll_owl', true );
		$slide_to_scroll_owl	= (!empty($slide_to_scroll_owl)) ? $slide_to_scroll_owl : '1';

		$slide_margin_owl   = get_post_meta( $slider_id, $prefix.'slide_margin_owl', true );
		$slide_margin_owl 	= (!empty($slide_margin_owl)) ? $slide_margin_owl : '0';
		
		$slide_padding_owl  = get_post_meta( $slider_id, $prefix.'slide_padding_owl', true );
		$slide_padding_owl 	= (!empty($slide_padding_owl)) ? $slide_padding_owl : '0';
		
		$start_slide_owl   	= get_post_meta( $slider_id, $prefix.'start_slide_owl', true );
		$start_slide_owl 	= (!empty($start_slide_owl)) ? $start_slide_owl : '0';	
		
		$slide_center_owl	= get_post_meta( $slider_id, $prefix.'slide_center_owl', true );
		$slide_center_owl 	= ($slide_center_owl == 'true') ? 'true' : 'false';
		
		$slide_autowidth_owl	= get_post_meta( $slider_id, $prefix.'slide_autowidth_owl', true );
		$slide_autowidth_owl 	= ($slide_autowidth_owl == 'true') ? 'true' : 'false';
		
		$slide_freeDrag_owl	= get_post_meta( $slider_id, $prefix.'slide_freeDrag_owl', true );
		$slide_freeDrag_owl = ($slide_freeDrag_owl == 'true') ? 'true' : 'false';
		
		$height_auto_owl	= get_post_meta( $slider_id, $prefix.'height_auto_owl', true );
		$height_auto_owl 	= ($height_auto_owl == 'true') ? 'true' : 'false'; 
		
		$slide_rtl_owl		= get_post_meta( $slider_id, $prefix.'slide_rtl_owl', true );
		$slide_rtl_owl 		= ($slide_rtl_owl == 'true') ? 'true' : 'false';

		// Slider configuration
		$slider_conf = compact('arrow', 'pagination', 'speed', 'autoplay', 'autoplay_speed', 'loop','slide_to_show_owl', 'slide_show_ipad_owl', 'slide_show_tablet_owl', 'slide_show_mobile_owl', 'slide_to_scroll_owl', 'slide_margin_owl', 'slide_padding_owl', 'start_slide_owl', 'slide_center_owl', 'slide_autowidth_owl', 'slide_freeDrag_owl', 'height_auto_owl', 'caption', 'slide_rtl_owl');

		// Enqueue JS & CSS
		wp_enqueue_style( 'wpos-owlcarousel-style');
		wp_enqueue_script( 'wpos-owl-slider-jquery' );
		wp_enqueue_script( 'wpos-owl-slider-public' );
	}

	// Taking Slidejs Slider values
	if($slider_type == 'slidesjs') {
		$width_js			= get_post_meta( $slider_id, $prefix.'width_js', true );
		$width_js 			= (!empty($width_js)) ? $width_js : '1000';	
		
		$height_js			= get_post_meta( $slider_id, $prefix.'height_js', true );
		$height_js			= (!empty($height_js)) ? $height_js : '400';

		$start_js   		= get_post_meta( $slider_id, $prefix.'start_js', true );
		$start_js 			= (!empty($start_js)) ? $start_js : '1';
		
		$effect_js   		= get_post_meta( $slider_id, $prefix.'effect_js', true );		
		$pauseon_over_js	= get_post_meta( $slider_id, $prefix.'pauseon_over_js', true );

		// Slider configuration
		$slider_conf = compact('arrow', 'pagination', 'speed', 'autoplay', 'autoplay_speed', 'loop', 'width_js', 'height_js','start_js', 'effect_js', 'pauseon_over_js');

		// Enqueue JS & CSS
		wp_enqueue_script( 'wpos-slidesjs-jquery' );
		wp_enqueue_script( 'wpos-slides-public' );
		wp_enqueue_style( 'wpos-slidesjs-style');
	}
	
	// Taking Nivo Slider values		
	if($slider_type == 'nivo-slider') {
		$width_nivo			= get_post_meta( $slider_id, $prefix.'width_nivo', true );
		$width_nivo 		= (!empty($width_nivo)) ? $width_nivo : '1000';		

		$start_nivo   		= get_post_meta( $slider_id, $prefix.'start_nivo', true );
		$start_nivo 		= (!empty($start_nivo)) ? $start_nivo : '0';
		
		$effect_nivo   		= get_post_meta( $slider_id, $prefix.'effect_nivo', true );
		$pauseon_over_nivo	= get_post_meta( $slider_id, $prefix.'pauseon_over_nivo', true );
		$random_start_nivo	= get_post_meta( $slider_id, $prefix.'random_start_nivo', true );

		// Slider configuration
		$slider_conf = compact('arrow', 'pagination', 'speed', 'autoplay', 'autoplay_speed', 'loop', 'start_nivo', 'effect_nivo', 'pauseon_over_nivo', 'random_start_nivo');

		// Enquque JS & CSS
		wp_enqueue_style( 'wpos-nivoslider-style');
		wp_enqueue_script( 'wpos-nivo-slider-jquery' );
		wp_enqueue_script( 'wpos-nivo-public' );
	}

	// Taking UnSlider values
	if($slider_type == 'un-slider') {
		$mode_un			= get_post_meta( $slider_id, $prefix.'mode_un', true );
		$height_auto_un		= get_post_meta( $slider_id, $prefix.'height_auto_un', true );
		$height_un			= get_post_meta( $slider_id, $prefix.'height_un', true );
		$height_un 			= (!empty($height_un)) ? $height_un : '350';
		$fading_slider 		= "style='height:{$height_un}px;'";

		// Slider configuration
		$slider_conf = compact('arrow', 'pagination', 'speed', 'autoplay', 'autoplay_speed', 'height_auto_un', 'mode_un');

		// Enquque JS & CSS
		wp_enqueue_style( 'wpos-unslider-style');
		wp_enqueue_script( 'wpos-unslider-jquery' );
		wp_enqueue_script( 'wpos-unslider-public' );
	}
	
	// Taking wallop values
	if($slider_type == 'wallop-slider') {
		$mode_wallop		= get_post_meta( $slider_id, $prefix.'mode_wallop', true );
		$mode_wallop 		= (!empty($mode_wallop)) ? $mode_wallop : 'slide';
		
		$slider_conf 		= compact('arrow', 'pagination');

		// Slider configuration
		wp_enqueue_style( 'wpos-wallop-style');
		wp_enqueue_script( 'wpos-wallop-slider-jquery' );
		wp_enqueue_script( 'wpos-wallop-public' );
	}
	
	// Taking 3DSlider values
	if($slider_type == '3dslider') {
		$slide_to_show_3d	= get_post_meta( $slider_id, $prefix.'slide_to_show_3d', true );
		$slide_to_show_3d 	= (!empty($slide_to_show_3d)) ? $slide_to_show_3d : '3';
		
		$slide_show_ipad_3d	= get_post_meta( $slider_id, $prefix.'slide_show_ipad_3d', true );
		$slide_show_ipad_3d	= (!empty($slide_show_ipad_3d)) ? $slide_show_ipad_3d : '2';

		$slide_show_tablet_3d	= get_post_meta( $slider_id, $prefix.'slide_show_tablet_3d', true );
		$slide_show_tablet_3d	= (!empty($slide_show_tablet_3d)) ? $slide_show_tablet_3d : '1';

		$slide_show_mobile_3d	= get_post_meta( $slider_id, $prefix.'slide_show_mobile_3d', true );
		$slide_show_mobile_3d	= (!empty($slide_show_mobile_3d)) ? $slide_show_mobile_3d : '1';

		$slide_to_scroll_3d	= get_post_meta( $slider_id, $prefix.'slide_to_scroll_3d', true );
		$slide_to_scroll_3d	= (!empty($slide_to_scroll_3d)) ? $slide_to_scroll_3d : '1';	
		
		$auto_stop			= get_post_meta( $slider_id, $prefix.'auto_stop_3d', true );
		$auto_stop 			= ($auto_stop == 'true') ? 'true' : 'false';	

		$centermode_3d 		= get_post_meta( $slider_id, $prefix.'centermode_3d', true );
		$centermode_3d 		= ($centermode_3d == 'true') ? 'true' : 'false';

		$space_between_3d   = get_post_meta( $slider_id, $prefix.'space_between_3d', true );
		$space_between_3d 	= (!empty($space_between_3d)) ? $space_between_3d : '0';

		$depth   			= get_post_meta( $slider_id, $prefix.'depth', true );
		$depth 				= (!empty($depth)) ? $depth : '20';
		
		$modifier   		= get_post_meta( $slider_id, $prefix.'modifier', true );
		$modifier 			= (!empty($modifier)) ? $modifier : '20';

		$slider_conf 		= compact('arrow', 'pagination', 'speed', 'autoplay', 'autoplay_speed', 'loop','slide_to_show_3d', 'slide_show_ipad_3d', 'slide_show_tablet_3d', 'slide_show_mobile_3d', 'slide_to_scroll_3d', 'auto_stop', 'centermode_3d', 'space_between_3d','depth','modifier' );

		// Enqueue JS & CSS
		wp_enqueue_style( 'wpos-swiper-style');
		wp_enqueue_script( 'wpos-swiper-jquery' );
		wp_enqueue_script( 'wp-3d-public' );

	}

	// Taking swprSlider values
	if($slider_type == 'swiperslider') {
		$slide_to_show		= get_post_meta( $slider_id, $prefix.'slide_to_show_swpr', true );
		$slide_to_show 		= (!empty($slide_to_show)) ? $slide_to_show : '1';
		
		$slide_show_ipad_swpr	= get_post_meta( $slider_id, $prefix.'slide_show_ipad_swpr', true );
		$slide_show_ipad_swpr	= (!empty($slide_show_ipad_swpr)) ? $slide_show_ipad_swpr : '2';

		$slide_show_tablet_swpr	= get_post_meta( $slider_id, $prefix.'slide_show_tablet_swpr', true );
		$slide_show_tablet_swpr	= (!empty($slide_show_tablet_swpr)) ? $slide_show_tablet_swpr : '1';

		$slide_show_mobile_swpr	= get_post_meta( $slider_id, $prefix.'slide_show_mobile_swpr', true );
		$slide_show_mobile_swpr	= (!empty($slide_show_mobile_swpr)) ? $slide_show_mobile_swpr : '1';

		$slide_to_column	= get_post_meta( $slider_id, $prefix.'slide_to_scroll_swpr', true );
		$slide_to_column	= (!empty($slide_to_column)) ? $slide_to_column : '1';	
		
		$auto_stop			= get_post_meta( $slider_id, $prefix.'auto_stop_swpr', true );
		$centermode 		= get_post_meta( $slider_id, $prefix.'centermode_swpr', true );
		$space_between   	= get_post_meta( $slider_id, $prefix.'space_between_swpr', true );
		$space_between 		= (!empty($space_between)) ? $space_between : '0';
		
		$animation_swpr   	= get_post_meta( $slider_id, $prefix.'animation_swpr', true );
		$direction_swpr   	= get_post_meta( $slider_id, $prefix.'direction_swpr', true );		
		$height_auto_swiper	= get_post_meta( $slider_id, $prefix.'height_auto_swiper', true );		
		$height_slider_swpr = get_post_meta( $slider_id, $prefix.'height_slider_swpr', true );
	    $height_slider_swpr = (!empty($height_slider_swpr)) ? $height_slider_swpr : '';
		
		$vertical_height 	= ($direction_swpr == 'vertical' && empty($height_slider_swpr)) ? '500' : $height_slider_swpr ;
	    
		$slider_height 		= (!empty($height_slider_swpr)) ? $height_slider_swpr : '';
		$slider_wrap_height = ($direction_swpr == 'vertical' && empty($height_slider_swpr)) ? 500 : $slider_height;

		// Slider configuration
		$slider_conf = compact('arrow', 'pagination', 'speed', 'autoplay', 'autoplay_speed', 'loop','slide_to_show', 'slide_show_ipad_swpr', 'slide_show_tablet_swpr', 'slide_show_mobile_swpr', 'slide_to_column', 'auto_stop', 'centermode', 'space_between', 'animation_swpr', 'height_auto_swiper', 'direction_swpr', 'vertical_height' );

		// Enquque JS & CSS
		wp_enqueue_style( 'wpos-swiper-style');
		wp_enqueue_script( 'wpos-swiper-jquery' );
		wp_enqueue_script( 'wp-swiper-public' );
	}

	if($slider_type == 'polaroids-gallery') {
		// Slider configuration
		wp_enqueue_style( 'wpos-polaroids-gallery-style');
		wp_enqueue_script( 'wpos-classie-jquery' );
		wp_enqueue_script( 'wpos-modernizr-jquery' );
		wp_enqueue_script( 'wpos-polaroids-gallery-jquery' );
		wp_enqueue_script( 'wpos-polaroids-gallery-public' );
	}

	$design_type 	= 'design-1';
	
	ob_start();

	// Slider File
	$slider_file_path 		= WP_APAIOIS_DIR . '/includes/slider-files/'.$slider_type . '-file.php';
	$slider_file 			= (file_exists($slider_file_path)) ? $slider_file_path : '';

	// Design File
	$design_file_path 		= WP_APAIOIS_DIR . '/includes/design-files/' . $check_post_gallery.'/'.$design_type.'.php';
	$design_file 			= (file_exists($design_file_path)) ? $design_file_path : '';

	?>
	<div class="wp-spaios-slider-wrap wp-spaios-row-clearfix">		
		<?php if( $slider_file ) {
			include( $slider_file );
		} ?>
	</div>
	<?php
	if($check_post_gallery == 'post') {
		wp_reset_postdata(); // Reset WP Query
	}
	$content .= ob_get_clean();
	return $content;
}
add_shortcode("sliders_pack", "wp_spaios_slider_shortcode");