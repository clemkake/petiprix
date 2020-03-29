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

$check_post_gallery 		= get_post_meta( $post->ID, $prefix.'check_post_gallery', true );
$check_post_gallery 		= (!empty($check_post_gallery)) 	? $check_post_gallery 		: 'gallery' ;

//taxonomy Support
$include_category 			= get_post_meta( $post->ID, $prefix.'include_category', true );

$gallery_imgs 				= get_post_meta( $post->ID, $prefix.'gallery_id', true );
$no_img_cls					= !empty($gallery_imgs) 			? 'wp-spaios-hide' 			: '';

// ACF Field Name
$acf_field_name 			= get_post_meta( $post->ID, $prefix.'acf_field_name', true );
$acf_field_name 			= !empty($acf_field_name) 			? $acf_field_name 			: '';
?>

<table class="form-table wp-spaios-post-sett-table">
	<tbody>
		<!--Select Gallery Image or Post Type Image-->
		<tr valign="top">
			<th scope="row">
				<label><?php _e('Select Type', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td class="row-meta">
				<input type="radio" id="spaios-gallery" name="<?php echo $prefix; ?>check_post_gallery" value="gallery" <?php checked( 'gallery', $check_post_gallery ); ?>><label for="spaios-gallery"><?php _e('Select Gallery Image','sliderspack-all-in-one-image-sliders'); ?></label>&nbsp;&nbsp;&nbsp;
				<input type="radio" id="spaios-post" name="<?php echo $prefix; ?>check_post_gallery" value="post" <?php checked( 'post', $check_post_gallery ); ?>><label for="spaios-post"><?php _e('WordPress Posts','sliderspack-all-in-one-image-sliders'); ?></label>&nbsp;&nbsp;&nbsp;
				<?php if( !class_exists('acf') ) {
					echo '<br>';
				} else { ?>
					<input type="radio" id="spaios-acf-gallery" name="<?php echo $prefix; ?>check_post_gallery" value="acf-gallery" <?php checked( 'acf-gallery', $check_post_gallery ); ?>><label for="spaios-acf-gallery"><?php _e('ACF Gallery','sliderspack-all-in-one-image-sliders'); ?></label><br/>
				<?php } ?>
				<span class="description"><?php _e('Enable Gallery images, WordPress default posts OR ACF Gallery.','sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>
		
		<!--Add Gallery Image-->
		<tr valign="top" class="wp-spaios-gallery-media-image">
			<th scope="row">
				<label for="wp-spaios-gallery-imgs"><?php _e('Choose Gallery Images', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<button type="button" class="button button-secondary wp-spaios-img-uploader" id="wp-spaios-gallery-imgs" data-multiple="true" data-button-text="<?php _e('Add to Gallery', 'sliderspack-all-in-one-image-sliders'); ?>" data-title="<?php _e('Add Images to Gallery', 'sliderspack-all-in-one-image-sliders'); ?>"><i class="dashicons dashicons-format-gallery"></i> <?php _e('Gallery Images', 'sliderspack-all-in-one-image-sliders'); ?></button>
				<button type="button" class="button button-secondary wp-spaios-del-gallery-imgs"><i class="dashicons dashicons-trash"></i> <?php _e('Remove Gallery Images', 'sliderspack-all-in-one-image-sliders'); ?></button><br/>
				
				<div class="wp-spaios-gallery-imgs-prev wp-spaios-imgs-preview wp-spaios-gallery-imgs-wrp">
					<?php if( !empty($gallery_imgs) ) {
						foreach ($gallery_imgs as $img_key => $img_data) {

							$attachment_url 		= wp_get_attachment_thumb_url( $img_data );
							$attachment_edit_link	= get_edit_post_link( $img_data );
					?>
							<div class="wp-spaios-img-wrp">
								<div class="wp-spaios-img-tools">
									<span class="wp-spaios-tool-icon wp-spaios-edit-img dashicons dashicons-edit" title="<?php _e('Edit Image in Popup', 'sliderspack-all-in-one-image-sliders'); ?>"></span>
									<a href="<?php echo $attachment_edit_link; ?>" target="_blank" title="<?php _e('Edit Image', 'sliderspack-all-in-one-image-sliders'); ?>"><span class="wp-spaios-tool-icon wp-spaios-edit-attachment dashicons dashicons-visibility"></span></a>
									<span class="wp-spaios-tool-icon wp-spaios-del-tool wp-spaios-del-img dashicons dashicons-no" title="<?php _e('Remove Image', 'sliderspack-all-in-one-image-sliders'); ?>"></span>
								</div>
								<img class="wp-spaios-img" src="<?php echo $attachment_url; ?>" alt="" />
								<input type="hidden" class="wp-spaios-attachment-no" name="wp_spaios_img[]" value="<?php echo $img_data; ?>" />
							</div><!-- end .wp-spaios-img-wrp -->
					<?php }
					} ?>
					
					<p class="wp-spaios-img-placeholder <?php echo $no_img_cls; ?>"><?php _e('No Gallery Images', 'sliderspack-all-in-one-image-sliders'); ?></p>

				</div><!-- end .wp-spaios-imgs-preview -->
				<span class="description"><?php _e('Choose your desired images for gallery. Hold Ctrl key to select multiple images at a time.', 'sliderspack-all-in-one-image-sliders'); ?></span>
			</td>
		</tr>

		<!--Post Type Support Dropdown-->
		<tr valign="top" class="wp-spaios-posttype-settings">
			<th scope="row">
				<label for="select-post-type"><?php _e('Post Type', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td class="row-meta">
				<?php _e('WordPress Posts', 'sliderspack-all-in-one-image-sliders'); ?>
			</td>
		</tr>
		<tr valign="top" class="wp-spaios-posttype-settings">
			<th scope="row">
				<label><?php _e('Include Category', 'sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td>
				<input type="text" name="<?php echo $prefix; ?>include_category" value="<?php echo wp_spaios_esc_attr($include_category); ?>"><br/>
				<span class="description"> <?php _e( 'Enter category id to display categories wise.You can pass multiple ids with comma seperated.', 'sliderspack-all-in-one-image-sliders' ) ?></span>
			</td>
		</tr>
		
		<!-- ACF Gallery Support -->
		<tr valign="top" class="wp-spaios-acf-gallery">
			<th scope="row">
				<label for="wp-spaios-gallery-field"><?php _e('Gallery Type','sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td class="row-meta">
				<?php _e('ACF Gallery', 'sliderspack-all-in-one-image-sliders'); ?>				
			</td>
		</tr>
		<tr valign="top" class="wp-spaios-acf-gallery">
			<th scope="row">
				<label for="wp-spaios-gallery-field"><?php _e('ACF Field','sliderspack-all-in-one-image-sliders'); ?></label>
			</th>
			<td class="row-meta">
				<input type="text" name="<?php echo $prefix; ?>acf_field_name" value="<?php echo wp_spaios_esc_attr($acf_field_name); ?>"><br/>
				<span class="description"> <?php _e( 'Enter ACF Field to disply acf slider from the ACF. Ex: acf_images', 'sliderspack-all-in-one-image-sliders' ) ?></span>
			</td>
		</tr>
	</tbody>
</table><!-- end .wtwp-tstmnl-table -->