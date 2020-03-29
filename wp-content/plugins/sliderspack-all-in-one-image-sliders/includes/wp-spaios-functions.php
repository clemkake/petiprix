<?php
/**
 * Plugin generic functions file
 *
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

/**
 * Function to get slider style type
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_slider_type() {
	$slider_type = array(
						'bxslider'				=> __('bxSlider','sliderspack-all-in-one-image-sliders'),
						'flexslider'			=> __('FlexSlider 2','sliderspack-all-in-one-image-sliders'),
						'owl-slider'			=> __('Owl Slider/Carousel 2','sliderspack-all-in-one-image-sliders'),
						'slidesjs'				=> __('SlidesJS - Responsive slideshow','sliderspack-all-in-one-image-sliders'),
						'nivo-slider'			=> __('Nivo Slider','sliderspack-all-in-one-image-sliders'),
						'3dslider'				=> __('3D Slider','sliderspack-all-in-one-image-sliders'),
						'swiperslider'			=> __('Swiper Slider','sliderspack-all-in-one-image-sliders'),
						'polaroids-gallery'		=> __('Scattered Polaroids Gallery','sliderspack-all-in-one-image-sliders'),
						'wallop-slider'			=> __('Wallop Slider','sliderspack-all-in-one-image-sliders'),
						'un-slider'				=> __('Unslider','sliderspack-all-in-one-image-sliders'),
					);
	return apply_filters('wp_spaios_slider_type', $slider_type );
}



/**
 * Function to get Nivo Slider effect slider style type
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_nivoslider_effect() {
	$nivoslider_effect = array(
						'sliceDown'				=> __('sliceDown','sliderspack-all-in-one-image-sliders'),
						'sliceDownLeft'			=> __('sliceDownLeft','sliderspack-all-in-one-image-sliders'),
						'sliceUp'				=> __('sliceUp','sliderspack-all-in-one-image-sliders'),
						'sliceUpLeft'			=> __('sliceUpLeft','sliderspack-all-in-one-image-sliders'),
						'sliceUpDown'			=> __('sliceUpDown','sliderspack-all-in-one-image-sliders'),
						'sliceUpDownLeft'		=> __('sliceUpDownLeft','sliderspack-all-in-one-image-sliders'),
						'fold'					=> __('fold','sliderspack-all-in-one-image-sliders'),
						'fade'					=> __('fade','sliderspack-all-in-one-image-sliders'),
						'random'				=> __('random','sliderspack-all-in-one-image-sliders'),
						'slideInRight'			=> __('slideInRight','sliderspack-all-in-one-image-sliders'),
						'slideInLeft'			=> __('slideInLeft','sliderspack-all-in-one-image-sliders'),
						'boxRandom'				=> __('boxRandom','sliderspack-all-in-one-image-sliders'),
						'boxRain'				=> __('boxRain','sliderspack-all-in-one-image-sliders'),
						'boxRainReverse'		=> __('boxRainReverse','sliderspack-all-in-one-image-sliders'),
						'boxRainGrow'			=> __('boxRainGrow','sliderspack-all-in-one-image-sliders'),
						'boxRainGrowReverse'	=> __('boxRainGrowReverse','sliderspack-all-in-one-image-sliders'),
					);
	return apply_filters('wp_spaios_nivoslider_effect', $nivoslider_effect );
}

/**
 * Function to get slider style type
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_bxslider_mode_type() {
	$bxslider_mode = array(
						'horizontal'	=> __('Horizontal','sliderspack-all-in-one-image-sliders'),
						'vertical'		=> __('Vertical','sliderspack-all-in-one-image-sliders'),
						'fade'			=> __('Fade','sliderspack-all-in-one-image-sliders'),
					);
	return apply_filters('wp_spaios_bxslider_mode_type', $bxslider_mode );
}

/**
 * Function to get slider style type
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_flex_slider_animation() {
	$flex_slider_animation = array(
						'slide'	=> __( 'Slide','sliderspack-all-in-one-image-sliders' ),
						'fade'	=> __( 'Fade','sliderspack-all-in-one-image-sliders' ),
					);
	return apply_filters( 'wp_spaios_flex_slider_animation', $flex_slider_animation );
}

/**
 * Function to get slider style type
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_flex_slider_direction() {
	$flex_slider_direction = array(
						'horizontal'	=> __( 'Horizontal','sliderspack-all-in-one-image-sliders' ),
						'vertical'		=> __( 'Vertical','sliderspack-all-in-one-image-sliders' ),
					);
	return apply_filters( 'wp_spaios_flex_slider_direction', $flex_slider_direction );
}

/**
 * Function to get slider style type
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_wallopslider_mode_type() {
	$wallopslider_mode = array(
						'slide'				=> __( 'Slide','sliderspack-all-in-one-image-sliders' ),
						'vertical-slide'	=> __( 'Vertical','sliderspack-all-in-one-image-sliders' ),
						'fade'				=> __( 'Fade','sliderspack-all-in-one-image-sliders' ),
						'scale'				=> __( 'Scale','sliderspack-all-in-one-image-sliders' ),
						'fade'				=> __( 'Fade','sliderspack-all-in-one-image-sliders' ),
						'rotate'			=> __( 'Rotate','sliderspack-all-in-one-image-sliders' ),
						'fold'				=> __( 'Fold','sliderspack-all-in-one-image-sliders' ),
					);
	return apply_filters( 'wp_spaios_wallopslider_mode_type', $wallopslider_mode );
}

/**
 * Escape Tags & Slashes
 *
 * Handles escapping the slashes and tags
 *
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_esc_attr($data) {
	return esc_attr( stripslashes($data) );
}

/**
 * Clean variables using sanitize_text_field. Arrays are cleaned recursively.
 * Non-scalar values are ignored.
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_clean( $var ) {
	if ( is_array( $var ) ) {
		return array_map( 'wp_spaios_clean', $var );
	} else {
		$data = is_scalar( $var ) ? sanitize_text_field( $var ) : $var;
		return wp_unslash($data);
	}
}

/**
 * Sanitize number value and return fallback value if it is blank
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_clean_number( $var, $fallback = null ) {
	$data = absint($var);
	return ( empty($data) && $fallback ) ? $fallback : $data;
}

/**
 * Sanitize URL
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_clean_url( $url ) {
	return esc_url_raw( trim($url) );
}

/**
 * Strip Html Tags 
 * 
 * It will sanitize text input (strip html tags, and escape characters)
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */

function wp_spaios_nohtml_kses($data = array()) {

	if ( is_array($data) ) {

	$data = array_map('wp_spaios_nohtml_kses', $data);

	} elseif ( is_string( $data ) ) {
	$data = trim( $data );
	$data = wp_filter_nohtml_kses($data);
	}

	return $data;
}

/**
 * Function to unique number value
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_get_unique() {
	static $unique = 0;
	$unique++;

	return $unique;
}

/**
 * Function to add array after specific key
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_add_array(&$array, $value, $index, $from_last = false) {
	
	if( is_array($array) && is_array($value) ) {

		if( $from_last ) {
			$total_count 	= count($array);
			$index 			= (!empty($total_count) && ($total_count > $index)) ? ($total_count-$index): $index;
		}
		
		$split_arr 	= array_splice($array, max(0, $index));
		$array 		= array_merge( $array, $value, $split_arr);
	}

	return $array;
}

/**
 * Function to get post excerpt
 * 
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */
function wp_spaios_get_post_excerpt( $post_id = null, $content = '', $word_length = '55', $more = '...' ) {

	$has_excerpt 	= false;
	$word_length 	= !empty($word_length) ? $word_length : '55';

	// If post id is passed
	if( !empty($post_id) ) {
		if (has_excerpt($post_id)) {

			$has_excerpt 	= true;
			$content 		= get_the_excerpt();

		} else {
			$content = !empty($content) ? $content : get_the_content();
		}
	}

	if( !empty($content) && (!$has_excerpt) ) {
		$content = strip_shortcodes( $content ); // Strip shortcodes
		$content = wp_trim_words( $content, $word_length, $more );
	}

	return $content;
}