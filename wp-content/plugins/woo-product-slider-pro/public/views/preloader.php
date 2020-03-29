<?php
if ( 'true' == $grid_pagination && 'ajax_number' == $grid_pagination_type && 'grid' == $layout_preset || 'true' == $wpspro_preloader ) {
	$preloader_style = ( 'true' == $wpspro_preloader ) ? '' : 'display: none;';
	$preloader_image = SP_WPSPRO_URL . 'admin/assets/images/preloader.gif';
	if ( ! empty( $preloader_image ) ) {
		$outline .= '<div class="wpspro-preloader" id="wpspro-preloader-' . $post_id . '" style="' . $preloader_style . '"><img src=" ' . $preloader_image . ' "/></div>';
	}
}
