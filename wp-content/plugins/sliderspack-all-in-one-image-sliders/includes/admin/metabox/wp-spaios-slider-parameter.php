<?php
/**
 * Handles Post Setting metabox HTML
 *
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

global $post;

$prefix = WP_APAIOIS_META_PREFIX; // Metabox prefix
$bxslider_mode_list 			= wp_spaios_bxslider_mode_type();
$flex_slider_animation_list 	= wp_spaios_flex_slider_animation();
$flex_slider_direction_list 	= wp_spaios_flex_slider_direction();
$nivo_slider_effect_list 		= wp_spaios_nivoslider_effect();
$wallopslider_mode_list			= wp_spaios_wallopslider_mode_type();

// Getting saved values
$slider_type 				= get_post_meta( $post->ID, $prefix.'slider_type', true );
$slider_type 				= (!empty($slider_type)) 	? $slider_type : 'bxslider';

// Common Variables
$slide_media_size			= get_post_meta( $post->ID, $prefix.'slide_media_size', true );	
$slide_media_size 			= (!empty($slide_media_size)) 	? $slide_media_size : 'large';

$slide_ptype_limit			= get_post_meta( $post->ID, $prefix.'slide_ptype_limit', true );	
$slide_ptype_limit 			= (!empty($slide_ptype_limit)) 	? $slide_ptype_limit : 5;

$slide_ptype_cat_name		= get_post_meta( $post->ID, $prefix.'slide_ptype_cat_name', true );	
$slide_ptype_cat_name 		= (!empty($slide_ptype_cat_name)) 	? $slide_ptype_cat_name : 'true';

$slide_ptype_title			= get_post_meta( $post->ID, $prefix.'slide_ptype_title', true );	
$slide_ptype_title 			= (!empty($slide_ptype_title)) 	? $slide_ptype_title : 'true';

$slide_ptype_content		= get_post_meta( $post->ID, $prefix.'slide_ptype_content', true );	
$slide_ptype_content 		= (!empty($slide_ptype_content)) 	? $slide_ptype_content : 'true';

$content_word_limit			= get_post_meta( $post->ID, $prefix.'content_word_limit', true );	
$content_word_limit 		= (!empty($content_word_limit)) 	? $content_word_limit : '55';

$slide_ptype_readmorebtn	= get_post_meta( $post->ID, $prefix.'slide_ptype_readmorebtn', true );	
$slide_ptype_readmorebtn 	= (!empty($slide_ptype_readmorebtn)) 	? $slide_ptype_readmorebtn : 'true';

$content_readmore_text		= get_post_meta( $post->ID, $prefix.'content_readmore_text', true );	
$content_readmore_text 		= (!empty($content_readmore_text)) 	? $content_readmore_text : 'Read More';

$arrow 						= get_post_meta( $post->ID, $prefix.'arrow', true );
$arrow 						= (!empty($arrow)) 	? $arrow : 'true' ;

$pagination 				= get_post_meta( $post->ID, $prefix.'pagination', true );
$pagination 				= (!empty($pagination)) 	? $pagination : 'true' ;

$speed 						= get_post_meta( $post->ID, $prefix.'speed', true );

$autoplay 					= get_post_meta( $post->ID, $prefix.'autoplay', true );
$autoplay 					= (!empty($autoplay)) 	? $autoplay : 'true' ;

$autoplay_speed				= get_post_meta( $post->ID, $prefix.'autoplay_speed', true );

$loop 						= get_post_meta( $post->ID, $prefix.'loop', true );
$loop 						= (!empty($loop)) 	? $loop : 'true' ;

$caption 					= get_post_meta( $post->ID, $prefix.'caption', true );
$caption 					= (!empty($caption)) 	? $caption : 'false' ;

$fancy_box 					= get_post_meta( $post->ID, $prefix.'fancy_box', true );
$fancy_box 					= (!empty($fancy_box)) 	? $fancy_box : 'false' ;

$link_target 				= get_post_meta( $post->ID, $prefix.'link_target', true );
$link_target 				= (!empty($link_target)) 	? $link_target : 'blank' ;

//BX Slider
$mode_bx				= get_post_meta( $post->ID, $prefix.'mode_bx', true );
$mode_bx 				= (!empty($mode_bx)) 			? $mode_bx 				: 'horizontal' ;
$slide_to_show_bx 		= get_post_meta( $post->ID, $prefix.'slide_to_show_bx', true );
$max_slide_to_show_bx 	= get_post_meta( $post->ID, $prefix.'max_slide_to_show_bx', true );
$slide_to_scroll_bx 	= get_post_meta( $post->ID, $prefix.'slide_to_scroll_bx', true );
$slide_margin_bx		= get_post_meta( $post->ID, $prefix.'slide_margin_bx', true );
$slide_width_bx			= get_post_meta( $post->ID, $prefix.'slide_width_bx', true );
$ticker_bx				= get_post_meta( $post->ID, $prefix.'ticker_bx', true );		
$ticker_bx 				= (!empty($ticker_bx)) 			? $ticker_bx 			: 'false' ;
$ticker_hover_bx		= get_post_meta( $post->ID, $prefix.'ticker_hover_bx', true );
$ticker_hover_bx 		= (!empty($ticker_hover_bx)) 	? $ticker_hover_bx 		: 'true' ;
$start_slide_bx			= get_post_meta( $post->ID, $prefix.'start_slide_bx', true );
$height_start_bx		= get_post_meta( $post->ID, $prefix.'height_start_bx', true );
$height_start_bx 		= (!empty($height_start_bx)) 	? $height_start_bx 		: 'false' ;
$random_start_bx		= get_post_meta( $post->ID, $prefix.'random_start_bx', true );
$random_start_bx 		= (!empty($random_start_bx)) 	? $random_start_bx 		: 'false' ;
//$captions_bx			= get_post_meta( $post->ID, $prefix.'captions_bx', true );

//FLEX Slider
$animation_flex			= get_post_meta( $post->ID, $prefix.'animation_flex', true );
$animation_flex 		= (!empty($animation_flex)) 	? $animation_flex 		: 'slide' ;

$slide_to_show_flex 	= get_post_meta( $post->ID, $prefix.'slide_to_show_flex', true );
$max_slide_to_show_flex = get_post_meta( $post->ID, $prefix.'max_slide_to_show_flex', true );
$slide_to_scroll_flex 	= get_post_meta( $post->ID, $prefix.'slide_to_scroll_flex', true );
$slide_margin_flex		= get_post_meta( $post->ID, $prefix.'slide_margin_flex', true );
$slide_width_flex		= get_post_meta( $post->ID, $prefix.'slide_width_flex', true );	
$ticker_hover_flex		= get_post_meta( $post->ID, $prefix.'ticker_hover_flex', true );		
$ticker_hover_flex 		= (!empty($ticker_hover_flex)) 	? $ticker_hover_flex 	: 'true' ;
$start_slide_flex		= get_post_meta( $post->ID, $prefix.'start_slide_flex', true );
$height_auto_flex		= get_post_meta( $post->ID, $prefix.'height_auto_flex', true );
$height_auto_flex 		= (!empty($height_auto_flex)) 	? $height_auto_flex 	: 'false' ;
$random_start_flex		= get_post_meta( $post->ID, $prefix.'random_start_flex', true );
$random_start_flex 		= (!empty($random_start_flex)) 	? $random_start_flex 	: 'false' ;
$rtl_flex				= get_post_meta( $post->ID, $prefix.'rtl_flex', true );
$rtl_flex 				= (!empty($rtl_flex)) 			? $rtl_flex 			: 'false' ;
//$captions_flex		= get_post_meta( $post->ID, $prefix.'captions_flex', true );

//Slider
$width_js  			= get_post_meta( $post->ID, $prefix.'width_js', true );
$height_js       	= get_post_meta( $post->ID, $prefix.'height_js', true );
$start_js 			= get_post_meta( $post->ID, $prefix.'start_js', true );
$effect_js			= get_post_meta( $post->ID, $prefix.'effect_js', true );
$effect_js 			= (!empty($effect_js)) 	? $effect_js : 'slide' ;
$pauseon_over_js	= get_post_meta( $post->ID, $prefix.'pauseon_over_js', true );
$pauseon_over_js 	= (!empty($pauseon_over_js)) 	? $pauseon_over_js 			: 'true' ;

//OWL Slider
$slide_to_show_owl  	= get_post_meta( $post->ID, $prefix.'slide_to_show_owl', true );
$slide_show_ipad_owl  	= get_post_meta( $post->ID, $prefix.'slide_show_ipad_owl', true );
$slide_show_tablet_owl 	= get_post_meta( $post->ID, $prefix.'slide_show_tablet_owl', true );
$slide_show_mobile_owl 	= get_post_meta( $post->ID, $prefix.'slide_show_mobile_owl', true );
$slide_to_scroll_owl    = get_post_meta( $post->ID, $prefix.'slide_to_scroll_owl', true );
$slide_margin_owl 		= get_post_meta( $post->ID, $prefix.'slide_margin_owl', true );
$slide_padding_owl		= get_post_meta( $post->ID, $prefix.'slide_padding_owl', true );
$start_slide_owl		= get_post_meta( $post->ID, $prefix.'start_slide_owl', true );
$slide_center_owl		= get_post_meta( $post->ID, $prefix.'slide_center_owl', true );
$slide_center_owl 		= (!empty($slide_center_owl)) 	? $slide_center_owl : 'false' ;
$height_auto_owl 		= (!empty($height_auto_owl)) 	? $height_auto_owl : 'false' ;
$height_auto_owl		= get_post_meta( $post->ID, $prefix.'height_auto_owl', true );
$slide_autowidth_owl	= get_post_meta( $post->ID, $prefix.'slide_autowidth_owl', true );
$slide_autowidth_owl 	= (!empty($slide_autowidth_owl)) 	? $slide_autowidth_owl : 'false' ;
$slide_freeDrag_owl		= get_post_meta( $post->ID, $prefix.'slide_freeDrag_owl', true );
$slide_freeDrag_owl 	= (!empty($slide_freeDrag_owl)) 	? $slide_freeDrag_owl : 'false' ;
$slide_rtl_owl			= get_post_meta( $post->ID, $prefix.'slide_rtl_owl', true );
$slide_rtl_owl 			= (!empty($slide_rtl_owl)) 	? $slide_rtl_owl : 'false' ;

//Nivo Slider
$effect_nivo			= get_post_meta( $post->ID, $prefix.'effect_nivo', true );
$effect_nivo 			= (!empty($effect_nivo)) 	? $effect_nivo : 'sliceDown' ;
$width_nivo  			= get_post_meta( $post->ID, $prefix.'width_nivo', true );
$start_nivo 			= get_post_meta( $post->ID, $prefix.'start_nivo', true );

$pauseon_over_nivo		= get_post_meta( $post->ID, $prefix.'pauseon_over_nivo', true );
$pauseon_over_nivo 		= (!empty($pauseon_over_nivo)) 	? $pauseon_over_nivo : 'true' ;
$random_start_nivo		= get_post_meta( $post->ID, $prefix.'random_start_nivo', true );
$random_start_nivo 		= (!empty($random_start_nivo)) 	? $random_start_nivo : 'false' ;
//$captions_nivo		= get_post_meta( $post->ID, $prefix.'captions_nivo', true );

//Un Slider
$mode_un		= get_post_meta( $post->ID, $prefix.'mode_un', true );
$mode_un 		= (!empty($mode_un)) 	? $mode_un : 'horizontal' ;
$height_auto_un		= get_post_meta( $post->ID, $prefix.'height_auto_un', true );
$height_auto_un 	= (!empty($height_auto_un)) 	? $height_auto_un : 'false' ;

$height_un		= get_post_meta( $post->ID, $prefix.'height_un', true );

//WlLop Slider
$mode_wallop		= get_post_meta( $post->ID, $prefix.'mode_wallop', true );
$mode_wallop 		= (!empty($mode_wallop)) 	? $mode_wallop : 'slide' ;

//3D Slider
$slide_to_show_3d 		= get_post_meta( $post->ID, $prefix.'slide_to_show_3d', true );
$slide_show_ipad_3d  	= get_post_meta( $post->ID, $prefix.'slide_show_ipad_3d', true );
$slide_show_tablet_3d 	= get_post_meta( $post->ID, $prefix.'slide_show_tablet_3d', true );
$slide_show_mobile_3d 	= get_post_meta( $post->ID, $prefix.'slide_show_mobile_3d', true );
$slide_to_scroll_3d 	= get_post_meta( $post->ID, $prefix.'slide_to_scroll_3d', true );
$auto_stop_3d 			= get_post_meta( $post->ID, $prefix.'auto_stop_3d', true );
$auto_stop_3d 			= (!empty($auto_stop_3d)) 	? $auto_stop_3d : 'false' ;
$space_between_3d 		= get_post_meta( $post->ID, $prefix.'space_between_3d', true );
$centermode_3d 			= get_post_meta( $post->ID, $prefix.'centermode_3d', true );
$centermode_3d 			= (!empty($centermode_3d)) 	? $centermode_3d : 'true' ;
$depth 					= get_post_meta( $post->ID, $prefix.'depth', true );
$modifier 				= get_post_meta( $post->ID, $prefix.'modifier', true );

//Swiper Slider
$slide_to_show_swpr 	= get_post_meta( $post->ID, $prefix.'slide_to_show_swpr', true );
$slide_show_ipad_swpr  	= get_post_meta( $post->ID, $prefix.'slide_show_ipad_swpr', true );
$slide_show_tablet_swpr = get_post_meta( $post->ID, $prefix.'slide_show_tablet_swpr', true );
$slide_show_mobile_swpr = get_post_meta( $post->ID, $prefix.'slide_show_mobile_swpr', true );
$slide_to_scroll_swpr 	= get_post_meta( $post->ID, $prefix.'slide_to_scroll_swpr', true );
$auto_stop_swpr 		= get_post_meta( $post->ID, $prefix.'auto_stop_swpr', true );
$auto_stop_swpr 		= (!empty($auto_stop_swpr)) 	? $auto_stop_swpr : 'false' ;
$space_between_swpr 	= get_post_meta( $post->ID, $prefix.'space_between_swpr', true );
$centermode_swpr 		= get_post_meta( $post->ID, $prefix.'centermode_swpr', true );
$centermode_swpr 		= (!empty($centermode_swpr)) 	? $centermode_swpr : 'true' ;
$animation_swpr 		= get_post_meta( $post->ID, $prefix.'animation_swpr', true );
$animation_swpr 		= (!empty($animation_swpr)) 	? $animation_swpr : 'slide' ;
$direction_swpr 		= get_post_meta( $post->ID, $prefix.'direction_swpr', true );
$direction_swpr 		= (!empty($direction_swpr)) 	? $direction_swpr : 'horizontal' ;
$height_slider_swpr 	= get_post_meta( $post->ID, $prefix.'height_slider_swpr', true );
$height_auto_swiper		= get_post_meta( $post->ID, $prefix.'height_auto_swiper', true );
$height_auto_swiper 		= (!empty($height_auto_swiper)) 	? $height_auto_swiper : 'false' ;
?>

<div class="wp-spaios-mb-tabs-wrp">
	<div id="wp-spaios-sdetails" class="wp-spaios-sdetails wp-spaios-carousel">
		<table class="form-table wp-spaios-sdetails-tbl wp-spaios-common-settings">			
			<tbody>
				<?php if($slider_type == 'polaroids-gallery'){ $common_display = 'display:none;'; }else{ $common_display = ''; } ?>
				<tr valign="top">
					<td colspan="2" class="wp-spaios-commeta-settings">
						<h4><?php _e('Common Parameters For All Slider Type', 'sliderspack-all-in-one-image-sliders') ?></h4>
					</td>
				</tr>
				
				<tr valign="top">
					<td scope="row">
						<label><?php _e('Slider Media Size', 'sliderspack-all-in-one-image-sliders'); ?></label>
					</td>
					<td>
						<input type="text"  name="<?php echo $prefix; ?>slide_media_size" value="<?php echo wp_spaios_esc_attr($slide_media_size); ?>"><br/>
						<em> <?php _e( 'Choose WordPress registered image size. e.g thumbnail, medium, medium-large, large, full OR size registered in your theme.', 'sliderspack-all-in-one-image-sliders' ) ?></em>
					</td>
				</tr>
				
				<tr valign="top" class="wp-spaios-posttype-settings">
					<td scope="row">
						<label><?php _e('Limit', 'sliderspack-all-in-one-image-sliders'); ?></label>
					</td>
					<td>
						<input type="number" min="-1" name="<?php echo $prefix; ?>slide_ptype_limit" value="<?php echo wp_spaios_esc_attr($slide_ptype_limit); ?>"><br/>
						<em><?php _e('Enter slider post limit.','sliderspack-all-in-one-image-sliders'); ?></em>
					</td>
				</tr>

				<tr valign="top" class="wp-spaios-posttype-settings">
					<td scope="row">
						<label><?php _e('Show Category Name', 'sliderspack-all-in-one-image-sliders'); ?></label>
					</td>
					<td>
						<input type="radio" name="<?php echo $prefix; ?>slide_ptype_cat_name" value="true" <?php checked( 'true', $slide_ptype_cat_name ); ?>><?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>
						<input type="radio" name="<?php echo $prefix; ?>slide_ptype_cat_name" value="false" <?php checked( 'false', $slide_ptype_cat_name ); ?>><?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?><br/>
						<em><?php _e('Display slider category name.','sliderspack-all-in-one-image-sliders'); ?></em>
					</td>
				</tr>

				<tr valign="top" class="wp-spaios-posttype-settings">
					<td scope="row">
						<label><?php _e('Show Post Title', 'sliderspack-all-in-one-image-sliders'); ?></label>
					</td>
					<td>
						<input type="radio" name="<?php echo $prefix; ?>slide_ptype_title" value="true" <?php checked( 'true', $slide_ptype_title ); ?>><?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>
						<input type="radio" name="<?php echo $prefix; ?>slide_ptype_title" value="false" <?php checked( 'false', $slide_ptype_title ); ?>><?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?><br/>
						<em><?php _e('Display slider post title.','sliderspack-all-in-one-image-sliders'); ?></em>
					</td>
				</tr>
				
				<tr valign="top" class="wp-spaios-posttype-settings wp-spaios-scattered-sett">
					<td scope="row">
						<label><?php _e('Show Post Content', 'sliderspack-all-in-one-image-sliders'); ?></label>
					</td>
					<td>
						<input type="radio" name="<?php echo $prefix; ?>slide_ptype_content" value="true" <?php checked( 'true', $slide_ptype_content ); ?>><?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>
						<input type="radio" name="<?php echo $prefix; ?>slide_ptype_content" value="false" <?php checked( 'false', $slide_ptype_content ); ?>><?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?><br/>
						<em><?php _e('Display slider post content.','sliderspack-all-in-one-image-sliders'); ?></em>
					</td>
				</tr>

				<tr valign="top" class="wp-spaios-posttype-settings wp-spaios-postwordlimit-settings wp-spaios-scattered-sett">
					<td scope="row">
						<label><?php _e('Post Content Word Limit', 'sliderspack-all-in-one-image-sliders'); ?></label>
					</td>
					<td>
						<input type="number" min="1" name="<?php echo $prefix; ?>content_word_limit" value="<?php echo wp_spaios_esc_attr($content_word_limit); ?>"><br/>
						<em><?php _e('Display post content word limit.','sliderspack-all-in-one-image-sliders'); ?></em>
					</td>
				</tr>

				<tr valign="top" class="wp-spaios-posttype-settings wp-spaios-ptypereadmore-settings wp-spaios-scattered-sett">
					<td scope="row">
						<label><?php _e('Show Readmore Button', 'sliderspack-all-in-one-image-sliders'); ?></label>
					</td>
					<td>
						<input type="radio" name="<?php echo $prefix; ?>slide_ptype_readmorebtn" value="true" <?php checked( 'true', $slide_ptype_readmorebtn ); ?>><?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>
						<input type="radio" name="<?php echo $prefix; ?>slide_ptype_readmorebtn" value="false" <?php checked( 'false', $slide_ptype_readmorebtn ); ?>><?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?><br/>
						<em><?php _e('Display slider readmore button.','sliderspack-all-in-one-image-sliders'); ?></em>
					</td>
				</tr>
				
				<tr valign="top" class="wp-spaios-posttype-settings wp-spaios-readmoretext-settings wp-spaios-scattered-sett">
					<td scope="row">
						<label><?php _e('Display Read More Text', 'sliderspack-all-in-one-image-sliders'); ?></label>
					</td>
					<td>
						<input type="text" name="<?php echo $prefix; ?>content_readmore_text" value="<?php echo wp_spaios_esc_attr($content_readmore_text); ?>"><br/>	
						<em><?php _e('Enter read more button text.','sliderspack-all-in-one-image-sliders'); ?></em>
					</td>
				</tr>

				<tr valign="top" id="common_setting" style="<?php echo $common_display; ?>">
					<td scope="row">
						<label><?php _e('Arrow', 'sliderspack-all-in-one-image-sliders'); ?></label>
					</td>
					<td>
						<input type="radio" name="<?php echo $prefix; ?>arrow" value="true" <?php checked( 'true', $arrow ); ?>><?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>
						<input type="radio" name="<?php echo $prefix; ?>arrow" value="false" <?php checked( 'false', $arrow ); ?>><?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?><br/>
						<em><?php _e('Enable Arrows for slider','sliderspack-all-in-one-image-sliders'); ?></em>
					</td>
				
				</tr>
				<tr valign="top" id="common_setting" style="<?php echo $common_display; ?>">
					<td scope="row">
						<label><?php _e('Pagination', 'sliderspack-all-in-one-image-sliders'); ?></label>
					</td>
					<td>
						<input type="radio" name="<?php echo $prefix; ?>pagination" value="true" <?php checked( 'true', $pagination ); ?>><?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>
						<input type="radio" name="<?php echo $prefix; ?>pagination" value="false" <?php checked( 'false', $pagination ); ?>><?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?><br/>
						<em><?php _e('String with CSS selector or HTML element of the container with pagination','sliderspack-all-in-one-image-sliders'); ?></em>
					</td>
				</tr>
				<?php if($slider_type == 'wallop-slider'){ $wallop_display = 'display:none;'; }else{ $wallop_display = ''; } ?>
				<tr valign="top" id="common_setting" class="wallop_autoplay" style="<?php echo $common_display; ?><?php echo $wallop_display; ?>">
					<td scope="row">
						<label><?php _e('Autoplay', 'sliderspack-all-in-one-image-sliders'); ?></label>
					</td>
					<td>
						<input type="radio" name="<?php echo $prefix; ?>autoplay" value="true" <?php checked( 'true', $autoplay ); ?>><?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>
						<input type="radio" name="<?php echo $prefix; ?>autoplay"  value="false" <?php checked( 'false', $autoplay ); ?>><?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?><br/>
						<em><?php _e('Enable Autoplay for Slider.','sliderspack-all-in-one-image-sliders'); ?></em>
					</td>
				</tr>
				<tr valign="top" id="common_setting" class="wallop_autoplay_speed" style="<?php echo $common_display; ?><?php echo $wallop_display; ?>">
					<td scope="row">
						<label><?php _e('Autoplay Speed', 'sliderspack-all-in-one-image-sliders'); ?></label>
					</td>
					<td>
						<input type="number"  name="<?php echo $prefix; ?>autoplay_speed" value="<?php echo wp_spaios_esc_attr($autoplay_speed); ?>"><br/>
						<em><?php _e('Delay between transitions (in ms). If this parameter is not specified, auto play will be disabled','sliderspack-all-in-one-image-sliders'); ?></em>
					</td>
				</tr>	

				<tr valign="top" id="common_setting" style="<?php echo $common_display; ?>" class="wallop_slider_speed">
					<td scope="row">
						<label><?php _e('Speed', 'sliderspack-all-in-one-image-sliders'); ?></label>
					</td>
					<td>
						<input type="number"  name="<?php echo $prefix; ?>speed" value="<?php echo wp_spaios_esc_attr($speed); ?>"><br/>
						<em><?php _e('Duration of transition between slides (in ms).','sliderspack-all-in-one-image-sliders'); ?></em>
					</td>
				</tr>				

				<?php if($slider_type == 'nivo-slider'){ $nivo_display = 'display:none;'; }else{ $nivo_display = ''; } ?>
				<?php if($slider_type == 'slidesjs'){ $slidesjs_display = 'display:none;'; }else{ $slidesjs_display = ''; } ?>
				<?php if($slider_type == 'un-slider'){ $unslider_display = 'display:none;'; }else{ $unslider_display = ''; } ?>
				
				<tr valign="top" id="common_setting" class="nivo_loop slidesjs_loop wallop_loop unslider_loop" style="<?php echo $common_display; ?> <?php echo $nivo_display; ?> <?php echo $slidesjs_display; ?> <?php echo $wallop_display; ?> <?php echo $unslider_display; ?> ">
					<td scope="row">
						<label><?php _e('Loop', 'sliderspack-all-in-one-image-sliders'); ?></label>
					</td>
					<td>
						<input type="radio" name="<?php echo $prefix; ?>loop" value="true" <?php checked( 'true', $loop ); ?>> <?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>
						<input type="radio" name="<?php echo $prefix; ?>loop" value="false" <?php checked( 'false', $loop ); ?>> <?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?><br/>
						<em><?php _e('Set to true to enable continuous loop mode','sliderspack-all-in-one-image-sliders'); ?></em>
					</td>
				</tr>
				<?php if($slider_type == 'swiperslider'){ $swiperslider_display = 'display:none;'; }else{ $swiperslider_display = ''; } ?>
				<tr valign="top" class="swiperslider_caption"  style="<?php echo $swiperslider_display; ?>">
					<td scope="row" >
						<label><?php _e('Caption', 'sliderspack-all-in-one-image-sliders'); ?></label>
					</td>
					<td>
						<input type="radio" name="<?php echo $prefix; ?>caption" value="true" <?php checked( 'true', $caption ); ?>> <?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>
						<input type="radio" name="<?php echo $prefix; ?>caption"  value="false" <?php checked( 'false', $caption ); ?>> <?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?><br/>
						<em><?php _e('Include image caption','sliderspack-all-in-one-image-sliders'); ?></em>
					</td>
				</tr>
				<tr valign="top" class="wp-spaios-link-target">
					<td scope="row">
						<label><?php _e('Link Target', 'sliderspack-all-in-one-image-sliders'); ?></label>
					</td>
					<td>
						<input type="radio" name="<?php echo $prefix; ?>link_target" value="blank" <?php checked( 'blank', $link_target ); ?>> <?php _e('Blank', 'sliderspack-all-in-one-image-sliders'); ?>
						<input type="radio" name="<?php echo $prefix; ?>link_target"  value="self" <?php checked( 'self', $link_target ); ?>> <?php _e('Self', 'sliderspack-all-in-one-image-sliders'); ?><br/>
						<em><?php _e('Open image link in new tab or in same window when Fancy Box disabled. ','sliderspack-all-in-one-image-sliders'); ?></em>
					</td>
				</tr>
				<tr valign="top">
					<td scope="row">
						<label><?php _e('Fancy Box Enable', 'sliderspack-all-in-one-image-sliders'); ?></label>
					</td>
					<td>
						<input type="radio" name="<?php echo $prefix; ?>fancy_box"  value="true" <?php checked( 'true', $fancy_box ); ?>> <?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>
						<input type="radio" name="<?php echo $prefix; ?>fancy_box" value="false" <?php checked( 'false', $fancy_box ); ?>> <?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?><br/>
						<em><?php _e('Enable Fancy Box','sliderspack-all-in-one-image-sliders'); ?></em>
					</td>
				</tr>
					
			</tbody>
		</table>
		
			<?php if($slider_type == 'bxslider'){ $bxdisplay = 'display:block;'; }else{ $bxdisplay = 'display:none;'; } ?>
			<!-- BX Slider -->
			<div class="wp-spaios-bxslider-settings wp-spaios-commeta-settings" style="<?php echo $bxdisplay; ?>" id="slider-setting">
				<h4><?php _e('Parameters For bxSlider', 'sliderspack-all-in-one-image-sliders') ?></h4>						
				<?php include_once( WP_APAIOIS_DIR .'/includes/admin/metabox/slider-settings/bx-slider-settings.php'); ?>
			</div>
			
			<!-- FLEX Slider -->
			<?php if($slider_type == 'flexslider'){ $flexdisplay = 'display:block;'; }else{ $flexdisplay = 'display:none;'; } ?>
			<div class="wp-spaios-flexslider-settings wp-spaios-commeta-settings" style="<?php echo $flexdisplay; ?>" id="slider-setting">
				<h4><?php _e('Parameters For flexSlider', 'sliderspack-all-in-one-image-sliders') ?></h4>				
				<?php include_once( WP_APAIOIS_DIR .'/includes/admin/metabox/slider-settings/flex-slider-settings.php'); ?>
			</div>
			
			<!-- Owl Slider -->
			<?php if($slider_type == 'owl-slider'){ $owldisplay = 'display:block;'; }else{ $owldisplay = 'display:none;'; } ?>
			<div class="wp-spaios-owlslider-settings wp-spaios-commeta-settings"  style="<?php echo $owldisplay; ?>" id="slider-setting">
				<h4><?php _e('Parameters For Owl Slider', 'sliderspack-all-in-one-image-sliders') ?></h4>				
				<?php include_once( WP_APAIOIS_DIR .'/includes/admin/metabox/slider-settings/owl-slider-settings.php'); ?>
			</div>
			
			<!-- Slider.js Slider -->
			<?php if($slider_type == 'slidesjs'){ $slidedisplay = 'display:block;'; }else{ $slidedisplay = 'display:none;'; } ?>
			<div class="wp-spaios-slidejs-slider-settings wp-spaios-commeta-settings" style="<?php echo $slidedisplay; ?>" id="slider-setting">
				<h4><?php _e('Parameters For slideJs Slider', 'sliderspack-all-in-one-image-sliders') ?></h4>				
				<?php include_once( WP_APAIOIS_DIR .'/includes/admin/metabox/slider-settings/slidejs-slider-settings.php'); ?>
			</div>
			
			<!-- Nivo.js Slider -->
			<?php if($slider_type == 'nivo-slider'){ $nivodisplay = 'display:block;'; }else{ $nivodisplay = 'display:none;'; } ?>
			<div class="wp-spaios-nivo-slider-settings wp-spaios-commeta-settings" style="<?php echo $nivodisplay; ?>" id="slider-setting">
				<h4><?php _e('Parameters For Nivo Slider', 'sliderspack-all-in-one-image-sliders') ?></h4>				
				<?php include_once( WP_APAIOIS_DIR .'/includes/admin/metabox/slider-settings/nivo-slider-settings.php'); ?>
			</div>
			
			<!-- Slider.js Slider -->
			<?php if($slider_type == 'un-slider'){ $unslidedisplay = 'display:block;'; }else{ $unslidedisplay = 'display:none;'; } ?>
			<div class="wp-spaios-un-slider-settings wp-spaios-commeta-settings" style="<?php echo $unslidedisplay; ?>" id="slider-setting">
				<h4><?php _e('Parameters For UnSlider', 'sliderspack-all-in-one-image-sliders') ?></h4>				
				<?php include_once( WP_APAIOIS_DIR .'/includes/admin/metabox/slider-settings/un-slider-settings.php'); ?>
			</div>
			
			<!-- Wallop Slider -->
			<?php if($slider_type == 'wallop-slider'){ $wallopdisplay = 'display:block;'; }else{ $wallopdisplay = 'display:none;'; } ?>
			<div class="wp-spaios-wallop-slider-settings wp-spaios-commeta-settings" style="<?php echo $wallopdisplay; ?>" id="slider-setting">
				<h4><?php _e('Parameters For Wallop Slider', 'sliderspack-all-in-one-image-sliders') ?></h4>				
				<?php include_once( WP_APAIOIS_DIR .'/includes/admin/metabox/slider-settings/wallop-slider-settings.php'); ?>
			</div>
			
			<!-- 3d Slider -->
			<?php if($slider_type == '3dslider'){ $threedisplay = 'display:block;'; }else{ $threedisplay = 'display:none;'; } ?>
			<div class="wp-spaios-3d-slider-settings wp-spaios-commeta-settings" style="<?php echo $threedisplay; ?>" id="slider-setting">
				<h4><?php _e('Parameters For 3D Slider', 'sliderspack-all-in-one-image-sliders') ?></h4>				
				<?php include_once( WP_APAIOIS_DIR .'/includes/admin/metabox/slider-settings/3d-slider-settings.php'); ?>
			</div>
			
			<!-- Swiper Slider -->
			<?php if($slider_type == 'swiperslider'){ $swiperdisplay = 'display:block;'; }else{ $swiperdisplay = 'display:none;'; } ?>
			<div class="wp-spaios-swiper-slider-settings wp-spaios-commeta-settings" style="<?php echo $swiperdisplay; ?>" id="slider-setting">
				<h4><?php _e('Parameters For Swiper Slider', 'sliderspack-all-in-one-image-sliders') ?></h4>				
				<?php include_once( WP_APAIOIS_DIR .'/includes/admin/metabox/slider-settings/swiper-slider-settings.php'); ?>
			</div>
	</div>
</div>