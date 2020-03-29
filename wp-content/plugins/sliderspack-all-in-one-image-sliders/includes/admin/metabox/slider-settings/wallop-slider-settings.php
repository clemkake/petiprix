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
				<select name="<?php echo $prefix;?>mode_wallop" class="wp-spaios-select-box">
					<?php
					if( !empty($wallopslider_mode_list) ) {
						foreach ($wallopslider_mode_list as $key => $value) {
							echo '<option value="'.$key.'" '.selected($mode_wallop,$key).'>'.$value.'</option>';
						}
					}
					?>
				</select> <br/>						
				<span class="description"><?php _e('Select Effect','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>			
		</tr>
					
	</tbody>
</table>