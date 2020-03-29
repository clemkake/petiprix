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
<table class="form-table wp-spaios-sdetails-tbl wp-spaios-bxslider-settings">		
	<tbody>
		<tr valign="top">
			<td scope="row">
				<label><?php _e('Effect', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<select name="<?php echo $prefix;?>effect_nivo" class="wp-spaios-select-box" id="slider-type">
					<?php
					if( !empty($nivo_slider_effect_list) ) {
						foreach ($nivo_slider_effect_list as $key => $value) {
							echo '<option value="'.$key.'" '.selected($effect_nivo,$key).'>'.$value.'</option>';
						}
					}
					?>
				</select> <br/>
				<span class="description"><?php _e('Select effect for Nivo Slider','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">					
			<td scope="row">
				<label><?php _e('Width', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
			<input type="number" min="1" step="1" name="<?php echo $prefix; ?>width_nivo" value="<?php echo wp_spaios_esc_attr($width_nivo); ?>"> px<br/>
			<span class="description"><?php _e('Width of Slider eg 400','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<td scope="row">
				<label><?php _e('Start Slide', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="text"  name="<?php echo $prefix; ?>start_nivo" value="<?php echo wp_spaios_esc_attr($start_nivo); ?>"><br/>
				<span class="description"><?php _e('Starting slide index(Zero based). eg. 3','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<td scope="row">
				<label><?php _e('Random Start', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="radio" name="<?php echo $prefix; ?>random_start_nivo" value="true" <?php checked( 'true', $random_start_nivo ); ?>><?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				<input type="radio" name="<?php echo $prefix; ?>random_start_nivo" value="false" <?php checked( 'false', $random_start_nivo ); ?>><?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?><br/>
				<span class="description"><?php _e('Start slider on a random slide','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>			
		<tr valign="top">				
			<td scope="row">
				<label><?php _e('Slider Pause on Mouse Hover', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="radio" name="<?php echo $prefix; ?>pauseon_over_nivo" value="true" <?php checked( 'true', $pauseon_over_nivo ); ?>><?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				<input type="radio" name="<?php echo $prefix; ?>pauseon_over_nivo" value="false" <?php checked( 'false', $pauseon_over_nivo ); ?>><?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?><br/>
				<span class="description"><?php _e('Slider will pause when mouse hovers over slider','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
	</tbody>
</table>