<?php
/**
 * Handles 3d Setting metabox HTML
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
				<label><?php _e('Slide To Show', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
			<input type="number" min="1" step="1" name="<?php echo $prefix; ?>slide_to_show_3d" value="<?php echo wp_spaios_esc_attr($slide_to_show_3d); ?>"><br/>
			<span class="description"><?php _e('Number of slides per view (slides visible at the same time on slider container).','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">					
			<td scope="row">
				<label><?php _e('Slide To Show (640px)', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="number" min="1" step="1" name="<?php echo $prefix; ?>slide_show_ipad_3d" value="<?php echo wp_spaios_esc_attr($slide_show_ipad_3d); ?>"><br/>
				<span class="description"><?php _e('Number of slides per view for screen 640px.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">					
			<td scope="row">
				<label><?php _e('Slide To Show (480px)', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="number" min="1" step="1" name="<?php echo $prefix; ?>slide_show_tablet_3d" value="<?php echo wp_spaios_esc_attr($slide_show_tablet_3d); ?>"><br/>
				<span class="description"><?php _e('Number of slides per view for screen 480px.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">					
			<td scope="row">
				<label><?php _e('Slide To Show (320px)', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="number" min="1" step="1" name="<?php echo $prefix; ?>slide_show_mobile_3d" value="<?php echo wp_spaios_esc_attr($slide_show_mobile_3d); ?>"><br/>
				<span class="description"><?php _e('Number of slides per view for screen 320px.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<td scope="row">
				<label><?php _e('Slide To Scroll', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="number" min="1" step="1" name="<?php echo $prefix; ?>slide_to_scroll_3d" value="<?php echo wp_spaios_esc_attr($slide_to_scroll_3d); ?>"><br/>
				<span class="description"><?php _e('Set numbers of slides to define and enable group sliding. Useful to use with slidesPerView > 1','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>

		<tr valign="top">
			<td scope="row">
				<label><?php _e('Centermode', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="radio" name="<?php echo $prefix; ?>centermode_3d" value="true" <?php checked( 'true', $centermode_3d ); ?>><?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				<input type="radio" name="<?php echo $prefix; ?>centermode_3d" value="false" <?php checked( 'false', $centermode_3d ); ?>><?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?><br/>
				<span class="description"><?php _e('If true, then active slide will be centered, not always on the left side.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>

		<tr valign="top">
			<td scope="row">
				<label><?php _e('Space Between Slides', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="number"  name="<?php echo $prefix; ?>space_between_3d" value="<?php echo wp_spaios_esc_attr($space_between_3d); ?>"><br/>
				<span class="description"><?php _e('Distance between slides in px.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<td scope="row">
				<label><?php _e('Autoplay Stop On Last', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="radio" name="<?php echo $prefix; ?>auto_stop_3d" value="true" <?php checked( 'true', $auto_stop_3d ); ?>><?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				<input type="radio" name="<?php echo $prefix; ?>auto_stop_3d" value="false" <?php checked( 'false', $auto_stop_3d ); ?>><?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?><br/>
				<span class="description"><?php _e('Enable this parameter and autoplay will be stopped when it reaches last slide','sliderspack-all-in-one-image-sliders'); ?></span><br/>
				<span class="wp-spaios-red description"><?php _e('<strong>Note:</strong> This will work when loop is false.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
	</tbody>
</table>

<table class="form-table wp-spaios-sdetails-tbl">
	<tbody>
		<tr valign="top">									
			<td scope="row" colspan="2">
				<h4><?php _e('3D Effect Settings', 'sliderspack-all-in-one-image-sliders') ?></h4>	
		</td>
		</tr>		
		<tr valign="top">									
			<td scope="row">
				<label><?php _e('Depth (Left - Right images scale value )', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="number"  name="<?php echo $prefix; ?>depth" value="<?php echo wp_spaios_esc_attr($depth); ?>"><br/>
				<span class="description"><?php _e('Enter the depth value to scale the left and right images','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<td scope="row">
				<label><?php _e('Image overlap position', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="number"  name="<?php echo $prefix; ?>modifier" value="<?php echo wp_spaios_esc_attr($modifier); ?>"><br/>
				<span class="description"><?php _e('Enter the number value to overlap the image position','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>			
		
	</tbody>
</table><!-- end .wtwp-tstmnl-table -->	