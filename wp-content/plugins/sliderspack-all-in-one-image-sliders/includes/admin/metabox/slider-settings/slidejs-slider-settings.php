<?php
/**
 * Handles owlSlider Setting metabox HTML
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
				<label><?php _e('Width', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="number" min="1" step="1" name="<?php echo $prefix; ?>width_js" value="<?php echo wp_spaios_esc_attr($width_js); ?>"> px<br/>
				<span class="description"><?php _e('Width of slider. Eg: 1000','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<td scope="row">
				<label><?php _e('Height', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="number" min="1" step="1" name="<?php echo $prefix; ?>height_js" value="<?php echo wp_spaios_esc_attr($height_js); ?>"> px<br/>
				<span class="description"><?php _e('Height of slider. Eg: 500','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<td scope="row">
				<label><?php _e('Start Slide', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="text"  name="<?php echo $prefix; ?>start_js" value="<?php echo wp_spaios_esc_attr($start_js); ?>"><br/>
				<span class="description"><?php _e('Set the first slide in the slideshow. eg. 5','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<td scope="row">
				<label><?php _e('Effect', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="radio" name="<?php echo $prefix; ?>effect_js" value="slide" <?php checked( 'slide', $effect_js ); ?>><?php _e('Slide', 'sliderspack-all-in-one-image-sliders'); ?>	
				<input type="radio" name="<?php echo $prefix; ?>effect_js" value="fade" <?php checked( 'fade', $effect_js ); ?>><?php _e('Fade', 'sliderspack-all-in-one-image-sliders'); ?>	<br/>						
				<span class="description"><?php _e('Select slide effect. Can be either slide or fade','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<td scope="row">
				<label><?php _e('Autoplay Pause on Hover', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="radio" name="<?php echo $prefix; ?>pauseon_over_js" value="true" <?php checked( 'true', $pauseon_over_js ); ?>><?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>		
				<input type="radio" name="<?php echo $prefix; ?>pauseon_over_js" value="false" <?php checked( 'false', $pauseon_over_js ); ?>><?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?>	<br/>				
				<span class="description"><?php _e('Pause slider on mouse hover','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>				
	</tbody>
</table>