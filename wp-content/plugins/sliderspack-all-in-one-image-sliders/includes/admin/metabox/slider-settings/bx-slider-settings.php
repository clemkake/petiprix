<?php
/**
 * Handles bxSlider Setting metabox HTML
 *
 * @package SlidersPack - All In One Image Sliders
 * @since 1.0
 */

// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;
?>
<table class="form-table wp-spaios-sdetails-tbl">		
	<tbody>
		<tr valign="top">
			<td scope="row">
				<label><?php _e('Mode', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<select name="<?php echo $prefix;?>mode_bx" class="wp-spaios-select-box" id="slider-type">
					<?php
					if( !empty($bxslider_mode_list) ) {
						foreach ($bxslider_mode_list as $key => $value) {
							echo '<option value="'.$key.'" '.selected($mode_bx,$key).'>'.$value.'</option>';
						}
					}
					?>
				</select><br/>
				<span class="description"><?php _e('Select mode for bxSlider','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		
		</tr>
		<tr valign="top">					
			<td scope="row">
				<label><?php _e('Minimum Number of Slides to be Shown', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
			<input type="number" min="1" step="1" name="<?php echo $prefix; ?>slide_to_show_bx" value="<?php echo wp_spaios_esc_attr($slide_to_show_bx); ?>"><br/>
			<span class="description"><?php _e('The minimum number of slides to be shown in small devices ie mobile. Eg 1.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		
		<tr valign="top">					
			<td scope="row">
				<label><?php _e('Maximum Number of Slides to be Shown', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
			<input type="number" min="1" step="1" name="<?php echo $prefix; ?>max_slide_to_show_bx" value="<?php echo wp_spaios_esc_attr($max_slide_to_show_bx); ?>"><br/>
			<span class="description"><?php _e('The maximum number of slides to be shown in desktop. Eg 3','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>

		<tr valign="top">
			<td scope="row">
				<label><?php _e('Slide To Scroll', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="number" min="1" step="1" name="<?php echo $prefix; ?>slide_to_scroll_bx" value="<?php echo wp_spaios_esc_attr($slide_to_scroll_bx); ?>"><br/>
				<span class="description"><?php _e('Set slide to scroll at a time. Useful to use with "Maximum Number of Slides to be Shown" > 1','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<td scope="row">
				<label><?php _e('Slide Width', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="text"  name="<?php echo $prefix; ?>slide_width_bx" value="<?php echo wp_spaios_esc_attr($slide_width_bx); ?>"><br/>
				<span class="description"><?php _e('The width of each slide. This setting is required for all horizontal carousels! and use with "Maximum Number of Slides to be Shown" > 1. eg : 400','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<td scope="row">
				<label><?php _e('Slide margin', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="text"  name="<?php echo $prefix; ?>slide_margin_bx" value="<?php echo wp_spaios_esc_attr($slide_margin_bx); ?>"><br/>
				<span class="description"><?php _e('Margin between each slide. eg. 5','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<td scope="row">
				<label><?php _e('Start Slide', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="text"  name="<?php echo $prefix; ?>start_slide_bx" value="<?php echo wp_spaios_esc_attr($start_slide_bx); ?>"><br/>
				<span class="description"><?php _e('Starting slide index (zero-based). eg. 3','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<td scope="row">
				<label><?php _e('Auto height', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="radio" name="<?php echo $prefix; ?>height_start_bx" value="true" <?php checked( 'true', $height_start_bx ); ?>><?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				<input type="radio" name="<?php echo $prefix; ?>height_start_bx" value="false" <?php checked( 'false', $height_start_bx ); ?>><?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?><br/>
				<span class="description"><?php _e('Allow height of the slider to animate smoothly.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<td scope="row">
				<label><?php _e('Random Start', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="radio" name="<?php echo $prefix; ?>random_start_bx" value="true" <?php checked( 'true', $random_start_bx ); ?>><?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				<input type="radio" name="<?php echo $prefix; ?>random_start_bx" value="false" <?php checked( 'false', $random_start_bx ); ?>><?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?><br/>
				<span class="description"><?php _e('Start slider on a random slide','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">
		
			<td scope="row">
				<label><?php _e('Ticker', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="radio" name="<?php echo $prefix; ?>ticker_bx" value="true" <?php checked( 'true', $ticker_bx ); ?>><?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				<input type="radio" name="<?php echo $prefix; ?>ticker_bx" value="false" <?php checked( 'false', $ticker_bx ); ?>><?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?><br/>
				<span class="description"><?php _e('Use slider in ticker mode (similar to a news ticker).','sliderspack-all-in-one-image-sliders'); ?></span><br>
				<span class="description wp-spaios-red"><?php _e('<strong>NOTE:</strong> If you are using Ticker mode, Please set autoplay to FALSE & Speed => 20000.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">				
			<td scope="row">
				<label><?php _e('Ticker Pause on Mouse Hover', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="radio" name="<?php echo $prefix; ?>ticker_hover_bx" value="true" <?php checked( 'true', $ticker_hover_bx ); ?>><?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>	
				<input type="radio" name="<?php echo $prefix; ?>ticker_hover_bx" value="false" <?php checked( 'false', $ticker_hover_bx ); ?>><?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?>	 <br/>										
				<span class="description"><?php _e('Ticker will pause when mouse hovers over slider','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		
	</tbody>
</table>