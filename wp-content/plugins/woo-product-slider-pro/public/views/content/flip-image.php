<?php
if ( $attachment_ids && $product_image_flip == 'true' ) {
	$attachment_ids                = array_values( $attachment_ids );
	$wpsp_secondary_image_id       = $attachment_ids['0'];
	$wpsp_secondary_image_url      = wp_get_attachment_image_src( $wpsp_secondary_image_id, $image_sizes );
	$wpsp_secondary_image_full_url = wp_get_attachment_image_src( $wpsp_secondary_image_id, 'full' );

	$wpsp_secondary_image = '';
	if ( ( 'custom' === $image_sizes ) && ( ! empty( $width ) && $wpsp_secondary_image_full_url[1] >= $width ) && ( ! empty( $height ) ) && $wpsp_secondary_image_full_url[2] >= $height ) {
		$wpsp_secondary_image = sp_wpspro_resize( $wpsp_secondary_image_full_url[0], $width, $height, $crop );
	}

	$wpsp_secondary_image_alt       = get_post_meta( $wpsp_secondary_image_id, '_wp_attachment_image_alt', true );
	$the_secondary_image_title_attr = ' title="' . get_the_title( $wpsp_secondary_image_id ) . '"';
	$wpsp_secondary_image_title     = 'true' == $image_title_attr ? $the_secondary_image_title_attr : '';

	$secondary_image_src = ! empty( $wpsp_secondary_image ) ? $wpsp_secondary_image : $wpsp_secondary_image_url[0];
	$secondary_image     = sprintf( '<img src="%1$s" %2$s alt="%3$s" class="wpsp-product-img wpsp-secondary-image">', $secondary_image_src, $wpsp_secondary_image_title, $wpsp_secondary_image_alt );

	$outline .= $secondary_image;
}
