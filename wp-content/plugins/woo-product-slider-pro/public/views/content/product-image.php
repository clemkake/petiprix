<?php
if ( $post_thumbnail_id ) {
	$image_alt            = get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true );
	$the_image_title_attr = ' title="' . get_the_title( $post_thumbnail_id ) . '"';
	$image_title          = 'true' == $image_title_attr ? $the_image_title_attr : '';
	$image_full_url       = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
	$image_url            = wp_get_attachment_image_src( $post_thumbnail_id, $image_sizes );
	$image_resize_url     = '';
	if ( ( 'custom' === $image_sizes ) && ( ! empty( $width ) && $image_full_url[1] >= $width ) && ( ! empty( $height ) ) && $image_full_url[2] >= $height ) {
		$image_resize_url = sp_wpspro_resize( $image_full_url[0], $width, $height, $crop );
	}
	$image_src = ! empty( $image_resize_url ) ? $image_resize_url : $image_url[0];
	$image     = sprintf( '<img src="%1$s" %2$s alt="%3$s" class="wpsp-product-img">', $image_src, $image_title, $image_alt );
}
if ( $placeholder_image && ! $post_thumbnail_id ) {
	/**
	 * Placeholder Image
	 */
	$place_image_alt = esc_html__( 'Placeholder', 'woo-product-slider-pro' );
	if ( ( 'custom' === $image_sizes ) && ( ! empty( $width ) && $placeholder_image['width'] >= $width ) && ( ! empty( $height ) ) && $placeholder_image['height'] >= $height ) {
		$place_image_resize_url = sp_wpspro_resize( $placeholder_image['url'], $width, $height, $crop );
	}
	$place_image_src = ! empty( $place_image_resize_url ) ? $place_image_resize_url : $placeholder_image['url'];
	$place_image     = sprintf( '<img src="%1$s" alt="%2$s" class="wpsp-product-img">', $place_image_src, $place_image_alt );
}
