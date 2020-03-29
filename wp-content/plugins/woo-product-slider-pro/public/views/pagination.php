<?php
/**
 * Pagination.
 *
 * @link       https://shapedplugin.com/
 * @since      2.5.0
 *
 * @package    Woo_Product_Slider_Pro
 * @subpackage Woo_Product_Slider_Pro/public/views
 */

$pagination_class = ( 'ajax_number' == $grid_pagination_type ) ? 'wpspro-ajax-num-pagination' : '';
if ( $que->max_num_pages > 1 && 'true' == $grid_pagination && 'grid' == $layout_preset ) {

	if ( 'load_more_scroll' == $grid_pagination_type || 'load_more_btn' == $grid_pagination_type ) {
		$grid_pagination_data = '<div class="wpspro-pagination hidden ' . $grid_pagination_alignment . '">';
		if ( is_front_page() ) {
			$paged_format = '?page' . $post_id . '=%#%';
			$paged_query  = 'page' . $post_id;
		} else {
			$paged_format = '?paged' . $post_id . '=%#%';
			$paged_query  = 'paged' . $post_id;
		}
		$args                  = array(
			'format'    => $paged_format,
			'total'     => $que->max_num_pages,
			'current'   => isset( $_GET[ "$paged_query" ] ) ? $_GET[ "$paged_query" ] : 1,
			'prev_next' => true,
			'type'      => 'array',
			'next_text' => '<i class="fa fa-angle-right"></i>',
			'prev_text' => '<i class="fa fa-angle-left"></i>',
		);
		$items                 = paginate_links( $args );
		$pagination            = "<ul>\n\t<li>";
		$pagination           .= join( "</li>\n\t<li>", $items );
		$pagination           .= "</li>\n</ul>\n";
		$grid_pagination_data .= $pagination;
		$grid_pagination_data .= '</div>';
		$grid_pagination_data .= '<div class="page-load-status ' . $grid_pagination_alignment . '">
            <p class="loader-ellips infinite-scroll-request">
                <span class="loader-ellips__dot"></span>
                <span class="loader-ellips__dot"></span>
                <span class="loader-ellips__dot"></span>
                <span class="loader-ellips__dot"></span>
            </p>
            <p class="infinite-scroll-last">End of content</p>
            <p class="infinite-scroll-error">No more pages to load</p>
        </div>';
		$grid_pagination_data .= '<div class="wpspro-item-load-more ' . $grid_pagination_alignment . '">
            <span>' . $grid_load_more_text . '</span>
        </div>';
	} else {
		$grid_pagination_data = '<div class="wpspro-pagination ' . $pagination_class . ' ' . $grid_pagination_alignment . '">';
		if ( is_front_page() ) {
			$paged_format = '?page' . $post_id . '=%#%';
			$paged_query  = 'page' . $post_id;
		} else {
			$paged_format = '?paged' . $post_id . '=%#%';
			$paged_query  = 'paged' . $post_id;
		}
		$args                  = array(
			'format'    => $paged_format,
			'total'     => $que->max_num_pages,
			'current'   => isset( $_GET[ "$paged_query" ] ) ? $_GET[ "$paged_query" ] : 1,
			'prev_next' => true,
			'type'      => 'array',
			'next_text' => '<i class="fa fa-angle-right"></i>',
			'prev_text' => '<i class="fa fa-angle-left"></i>',
		);
		$items                 = paginate_links( $args );
		$pagination            = "<ul>\n\t<li>";
		$pagination           .= join( "</li>\n\t<li>", $items );
		$pagination           .= "</li>\n</ul>\n";
		$grid_pagination_data .= $pagination;
		$grid_pagination_data .= '</div>';
	}
	$outline .= $grid_pagination_data;

}
