<?php
if ( $slider_title == 'true' ) {
	if ( $slider_title_link ) {
		$outline .= '<a href="' . esc_url( $slider_title_link ) . '">';
	}
	$outline .= '<h2 class="sp-woo-product-slider-pro-section-title">' . get_the_title( $post_id ) . '</h2>';
	if ( $slider_title_link ) {
		$outline .= '</a>';
	}
}
