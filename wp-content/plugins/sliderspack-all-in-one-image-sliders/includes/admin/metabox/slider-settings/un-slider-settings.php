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
				<label><?php _e('Effect', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<select name="<?php echo $prefix;?>mode_un" class="wp-spaios-select-box">
					<?php
					if( !empty($bxslider_mode_list) ) {
						foreach ($bxslider_mode_list as $key => $value) {
							echo '<option value="'.$key.'" '.selected($mode_un,$key).'>'.$value.'</option>';
						}
					}
					?>
				</select> <br/>						
				<span class="description"><?php _e('Select Effect for UnSlider','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>			
		</tr>
		<tr valign="top">
			<td scope="row">
				<label><?php _e('Auto height', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="radio" name="<?php echo $prefix; ?>height_auto_un" value="true" <?php checked( 'true', $height_auto_un ); ?>><?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				<input type="radio" name="<?php echo $prefix; ?>height_auto_un" value="false" <?php checked( 'false', $height_auto_un ); ?>><?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?><br/>
				<span class="description"><?php _e('Set auto height true or false.','sliderspack-all-in-one-image-sliders'); ?></span><br/>
				<span class="wp-spaios-red description"><?php _e('<strong>Note:</strong> Auto height parameter work with "Horizontal" OR "Fade" effect.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">				
			<td scope="row">
				<label><?php _e('Height', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>						
				<input type="number" min="1" step="1" name="<?php echo $prefix; ?>height_un" value="<?php echo wp_spaios_esc_attr($height_un); ?>"> px<br/>						
				<span class="description"><?php _e('Enter Height for slider.','sliderspack-all-in-one-image-sliders'); ?></span><br/>
			</td>			
		</tr>
	</tbody>
</table>