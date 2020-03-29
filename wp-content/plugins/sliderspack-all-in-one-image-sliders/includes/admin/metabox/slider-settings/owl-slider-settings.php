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
				<label><?php _e('Slide To Show', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="number" min="1" step="1" name="<?php echo $prefix; ?>slide_to_show_owl" value="<?php echo wp_spaios_esc_attr($slide_to_show_owl); ?>"><br/>
				<span class="description"><?php _e('The number of slides to be shown.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">					
			<td scope="row">
				<label><?php _e('Slide To Show in iPad', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="number" min="1" step="1" name="<?php echo $prefix; ?>slide_show_ipad_owl" value="<?php echo wp_spaios_esc_attr($slide_show_ipad_owl); ?>"><br/>
				<span class="description"><?php _e('Number of slides per view in iPad.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">					
			<td scope="row">
				<label><?php _e('Slide To Show in Tablet', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="number" min="1" step="1" name="<?php echo $prefix; ?>slide_show_tablet_owl" value="<?php echo wp_spaios_esc_attr($slide_show_tablet_owl); ?>"><br/>
				<span class="description"><?php _e('Number of slides per view in Tablet.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">					
			<td scope="row">
				<label><?php _e('Slide To Show in Mobile', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="number" min="1" step="1" name="<?php echo $prefix; ?>slide_show_mobile_owl" value="<?php echo wp_spaios_esc_attr($slide_show_mobile_owl); ?>"><br/>
				<span class="description"><?php _e('Number of slides per view in Mobile.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<td scope="row">
				<label><?php _e('Slide To Scroll', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="number" min="1" step="1" name="<?php echo $prefix; ?>slide_to_scroll_owl" value="<?php echo wp_spaios_esc_attr($slide_to_scroll_owl); ?>"><br/>
				<span class="description"><?php _e('Set slide to scroll at a time. Useful to use with "Number of Slides to be Shown" > 1','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<td scope="row">
				<label><?php _e('Slide margin', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="text"  name="<?php echo $prefix; ?>slide_margin_owl" value="<?php echo wp_spaios_esc_attr($slide_margin_owl); ?>"><br/>
				<span class="description"><?php _e('Margin between each slide. eg. 5','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<td scope="row">
				<label><?php _e('Left - Right Padding', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="text"  name="<?php echo $prefix; ?>slide_padding_owl" value="<?php echo wp_spaios_esc_attr($slide_padding_owl); ?>"><br/>
				<span class="description"><?php _e('padding from left and right for slider. eg. 30','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<td scope="row">
				<label><?php _e('Start Slide', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="text"  name="<?php echo $prefix; ?>start_slide_owl" value="<?php echo wp_spaios_esc_attr($start_slide_owl); ?>"><br/>
				<span class="description"><?php _e('Starting slide index. eg. 3','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<td scope="row">
				<label><?php _e('Center Mode', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="radio" name="<?php echo $prefix; ?>slide_center_owl" value="true" <?php checked( 'true', $slide_center_owl ); ?>><?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				<input type="radio" name="<?php echo $prefix; ?>slide_center_owl" value="false" <?php checked( 'false', $slide_center_owl ); ?>><?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?><br/>
				<span class="description"><?php _e('Enable center mode for slider','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<td scope="row">
				<label><?php _e('Auto Width Mode', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="radio" name="<?php echo $prefix; ?>slide_autowidth_owl" value="true" <?php checked( 'true', $slide_autowidth_owl ); ?>><?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				<input type="radio" name="<?php echo $prefix; ?>slide_autowidth_owl" value="false" <?php checked( 'false', $slide_autowidth_owl ); ?>><?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?><br/>
				<span class="description"><?php _e('Enable autowidth mode for slider','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>				
		<tr valign="top">
			<td scope="row">
				<label><?php _e('Auto height', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="radio" name="<?php echo $prefix; ?>height_auto_owl" value="true" <?php checked( 'true', $height_auto_owl ); ?>><?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				<input type="radio" name="<?php echo $prefix; ?>height_auto_owl" value="false" <?php checked( 'false', $height_auto_owl ); ?>><?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?><br/>
				<span class="description"><?php _e('Allow height of the slider to animate smoothly.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<td scope="row">
				<label><?php _e('Enable Free Drag Mode', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="radio" name="<?php echo $prefix; ?>slide_freeDrag_owl" value="true" <?php checked( 'true', $slide_freeDrag_owl ); ?>><?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				<input type="radio" name="<?php echo $prefix; ?>slide_freeDrag_owl" value="false" <?php checked( 'false', $slide_freeDrag_owl ); ?>><?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?><br/>
				<span class="description"><?php _e('Enable free drag mode for slider','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<td scope="row">
				<label><?php _e('RTL', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="radio" name="<?php echo $prefix; ?>slide_rtl_owl" value="true" <?php checked( 'true', $slide_rtl_owl ); ?>><?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				<input type="radio" name="<?php echo $prefix; ?>slide_rtl_owl" value="false" <?php checked( 'false', $slide_rtl_owl ); ?>><?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?><br/>
				<span class="description"><?php _e('Include RTL for RTL website','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
	</tbody>
</table>