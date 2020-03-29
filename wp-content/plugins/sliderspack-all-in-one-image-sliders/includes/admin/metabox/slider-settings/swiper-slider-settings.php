<?php
/**
 * Handles swpr Setting metabox HTML
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
				<input type="number" min="1" step="1" name="<?php echo $prefix; ?>slide_to_show_swpr" value="<?php echo wp_spaios_esc_attr($slide_to_show_swpr); ?>"><br/>
				<span class="description"><?php _e('Number of slides per view (slides visible at the same time on slider container).','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">					
			<td scope="row">
				<label><?php _e('Slide To Show (640px)', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="number" min="1" step="1" name="<?php echo $prefix; ?>slide_show_ipad_swpr" value="<?php echo wp_spaios_esc_attr($slide_show_ipad_swpr); ?>"><br/>
				<span class="description"><?php _e('Number of slides per view for screen 640px.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">					
			<td scope="row">
				<label><?php _e('Slide To Show (480px)', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="number" min="1" step="1" name="<?php echo $prefix; ?>slide_show_tablet_swpr" value="<?php echo wp_spaios_esc_attr($slide_show_tablet_swpr); ?>"><br/>
				<span class="description"><?php _e('Number of slides per view for screen 480px.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">					
			<td scope="row">
				<label><?php _e('Slide To Show (320px)', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="number" min="1" step="1" name="<?php echo $prefix; ?>slide_show_mobile_swpr" value="<?php echo wp_spaios_esc_attr($slide_show_mobile_swpr); ?>"><br/>
				<span class="description"><?php _e('Number of slides per view for screen 320px.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<td scope="row">
				<label><?php _e('Slide To Scroll', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="number" min="1" step="1" name="<?php echo $prefix; ?>slide_to_scroll_swpr" value="<?php echo wp_spaios_esc_attr($slide_to_scroll_swpr); ?>"><br/>
				<span class="description"><?php _e('Set numbers of slides to define and enable group sliding. Useful to use with slidesPerView > 1','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<td scope="row">
				<label><?php _e('Centermode', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="radio" name="<?php echo $prefix; ?>centermode_swpr" value="true" <?php checked( 'true', $centermode_swpr ); ?>><?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>	
				<input type="radio" name="<?php echo $prefix; ?>centermode_swpr" value="false" <?php checked( 'false', $centermode_swpr ); ?>><?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?>	<br/>
				<span class="description"><?php _e('If true, then active slide will be centered, not always on the left side.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<td scope="row">
				<label><?php _e('Space Between Slides', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="number"  name="<?php echo $prefix; ?>space_between_swpr" value="<?php echo wp_spaios_esc_attr($space_between_swpr); ?>"><br/>
				<span class="description"><?php _e('Distance between slides in px.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">					
			<td scope="row">
				<label><?php _e('Effect', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<select name="<?php echo $prefix; ?>animation_swpr">
					<option value="slide" <?php if($animation_swpr == 'slide'){echo 'selected'; } ?>><?php _e('Slide', 'sliderspack-all-in-one-image-sliders'); ?>	</option>
					<option value="fade" <?php if($animation_swpr == 'fade'){echo 'selected'; } ?>> <?php _e('Fade', 'sliderspack-all-in-one-image-sliders'); ?>	</option>
				</select><br/>
				<span class="description"><?php _e('Could be "slide", "fade"','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>			
		<tr valign="top">
			<td scope="row">
				<label><?php _e( 'Direction', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="radio" name="<?php  echo $prefix; ?>direction_swpr" value="horizontal" <?php checked( 'horizontal', $direction_swpr ); ?>> <?php _e('Horizontal', 'sliderspack-all-in-one-image-sliders'); ?>	
				<input type="radio" name="<?php  echo $prefix; ?>direction_swpr" value="vertical" <?php checked( 'vertical', $direction_swpr ); ?>> <?php _e('Vertical', 'sliderspack-all-in-one-image-sliders'); ?>	<br/>
				<span class="description"><?php _e('Could be "horizontal" or "vertical" (for vertical swpr).','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<td scope="row">
				<label><?php _e('Height', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="number"  class="wp-igsp-slider" name="<?php echo $prefix; ?>height_slider_swpr" value="<?php echo wp_spaios_esc_attr($height_slider_swpr); ?>">px<br/>
				<span class="description"><?php _e('Swiper height (in px). Parameter allows to force Swiper height. Useful only if you initialize Swiper when it is hidden.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<td scope="row">
				<label><?php _e('Auto height', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="radio" name="<?php echo $prefix; ?>height_auto_swiper" value="true" <?php checked( 'true', $height_auto_swiper ); ?>><?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				<input type="radio" name="<?php echo $prefix; ?>height_auto_swiper" value="false" <?php checked( 'false', $height_auto_swiper ); ?>><?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?><br/>
				<span class="description"><?php _e('Allow height of the slider to animate smoothly when direction is horizontal. Note:- Please use Height blank if Auto height is True','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		<tr valign="top">
			<td scope="row">
				<label><?php _e('Autoplay Stop On Last', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</td>
			<td>
				<input type="radio" name="<?php echo $prefix; ?>auto_stop_swpr" value="true" <?php checked( 'true', $auto_stop_swpr ); ?>><?php _e('True', 'sliderspack-all-in-one-image-sliders'); ?>
				<input type="radio" name="<?php echo $prefix; ?>auto_stop_swpr" value="false" <?php checked( 'false', $auto_stop_swpr ); ?>><?php _e('False', 'sliderspack-all-in-one-image-sliders'); ?><br/>
				<span class="description"><?php _e('Enable this parameter and autoplay will be stopped when it reaches last slide','sliderspack-all-in-one-image-sliders'); ?></span><br/>
				<span class="wp-spaios-red description"><?php _e('<strong>Note:</strong> This will work when loop is false.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
	</tbody>
</table>