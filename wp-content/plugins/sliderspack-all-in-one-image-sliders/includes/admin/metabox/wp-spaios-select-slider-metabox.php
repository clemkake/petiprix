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
$slider_type_list 	= wp_spaios_slider_type();

// Getting saved values
$slider_type 	= get_post_meta( $post->ID, $prefix.'slider_type', true );
?>
<div class="wp-spaios-mb-tabs-wrp">
	<div id="wp-spaios-sdetails" class="wp-spaios-sdetails wp-spaios-carousel">
		<table class="form-table wp-spaios-sdetails-tbl">
			<tbody>		
				<tr valign="top">
					<td scope="row">
						<label for="slider-type"><?php _e('Select Slider Type', 'sliderspack-all-in-one-image-sliders'); ?></label>
					</td>
					<td class="row-meta">
						<select name="<?php echo $prefix;?>slider_type" class="wp-spaios-select-box" id="slider-type">
							<?php
							if( !empty($slider_type_list) ) {
								foreach ($slider_type_list as $key => $value) {
									echo '<option value="'.$key.'" '.selected($slider_type,$key,false).'>'.$value.'</option>';
								}
							}
							?>
						</select>
						<br/>
						<em><?php _e('SlidersPack - 10 type of sliders. Select any one out of 10 that you like and want to use on your WordPress website :)', 'sliderspack-all-in-one-image-sliders'); ?></em>
					</td>			
				</tr>		

			</tbody>
		</table><!-- end .wp-spaios-post-sett-tbl -->
	</div>
</div>