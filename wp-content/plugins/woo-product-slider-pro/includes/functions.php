<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Review Text
 *
 * @param $text
 *
 * @return string
 */
function sp_wpsp_review_text( $text ) {
	$screen = get_current_screen();
	if ( 'sp_wpsp_shortcodes' == get_post_type() || $screen->id == 'sp_wpsp_shortcodes_page_wpspro_help' || $screen->id == 'sp_wpsp_shortcodes_page_wpspro_license' || $screen->id == 'sp_wpsp_shortcodes_page_wpspro_settings' ) {
		$url  = 'https://shapedplugin.com/plugin/woocommerce-product-slider-pro/#reviews';
		$text = sprintf( __( 'If you like <strong>Product Slider Pro for WooCommerce</strong> please leave us a <a href="%s" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> rating. Your Review is very important to us as it helps us to grow more. ', 'woo-product-slider-pro' ), $url );
	}

	return $text;
}

add_filter( 'admin_footer_text', 'sp_wpsp_review_text', 1, 2 );

/**
 * Set view count for a product
 */
function sp_wpsp_set_view_count( $post_id ) {
	$count_key = 'sp_wpsp_product_view_count';
	$count     = get_post_meta( $post_id, $count_key, true );
	if ( $count == '' ) {
		delete_post_meta( $post_id, $count_key );
		update_post_meta( $post_id, $count_key, '1' );
	} else {
		$count ++;
		update_post_meta( $post_id, $count_key, (string) $count );
	}
}

/**
 * Set view counts for all products once viewed
 */
function sp_wpsp_set_products_view_count() {
	global $woocommerce, $product;

	if ( $woocommerce->version >= '3.0' ) {
		$product_id = $product->get_id();
	} else {
		$product_id = $product->id;
	}
	sp_wpsp_set_view_count( $product_id );
}

add_action( 'woocommerce_after_single_product', 'sp_wpsp_set_products_view_count' );

/**
 * Post update messages for WPSP Shortcode
 */
function sp_wpsp_change_default_post_update_message( $message ) {
	$screen = get_current_screen();
	if ( 'sp_wpsp_shortcodes' == $screen->post_type ) {
		$message['post'][1]  = $title = esc_html__( 'Shortcode updated.', 'woo-product-slider-pro' );
		$message['post'][4]  = $title = esc_html__( 'Shortcode updated.', 'woo-product-slider-pro' );
		$message['post'][6]  = $title = esc_html__( 'Shortcode published.', 'woo-product-slider-pro' );
		$message['post'][8]  = $title = esc_html__( 'Shortcode submitted.', 'woo-product-slider-pro' );
		$message['post'][10] = $title = esc_html__( 'Shortcode draft updated.', 'woo-product-slider-pro' );
	}

	return $message;
}

add_filter( 'post_updated_messages', 'sp_wpsp_change_default_post_update_message' );

/**
 * Update recent product info
 */
function wpspro_recent_product_info_update() {

	global $post;
	if ( get_post_type( $post->ID ) == 'product' ) {
		update_post_meta( $post->ID, 'wpspro_recent_view_time', date( 'Y-m-d h:i:s' ) );
	}

}
add_action( 'woocommerce_after_single_product_summary', 'wpspro_recent_product_info_update' );


/**
 * Shortcode converter function
 */
function woo_product_slider_pro( $id ) {
	echo do_shortcode( '[woo-product-slider-pro id="' . $id . '"]' );
}

/**
 * Function creates product slider duplicate as a draft.
 */
function sp_wpspro_duplicate_shortcode() {
	global $wpdb;
	if ( ! ( isset( $_GET['post'] ) || isset( $_POST['post'] ) || ( isset( $_REQUEST['action'] ) && 'sp_wpspro_duplicate_shortcode' == $_REQUEST['action'] ) ) ) {
		wp_die( __( 'No shortcode to duplicate has been supplied!', 'woo-product-slider-pro' ) );
	}

	/*
	 * Nonce verification
	 */
	if ( ! isset( $_GET['sp_wpspro_duplicate_nonce'] ) || ! wp_verify_nonce( $_GET['sp_wpspro_duplicate_nonce'], basename( __FILE__ ) ) ) {
		return;
	}

	/*
	 * Get the original shortcode id
	 */
	$post_id = ( isset( $_GET['post'] ) ? absint( $_GET['post'] ) : absint( $_POST['post'] ) );
	/*
	 * and all the original shortcode data then
	 */
	$post = get_post( $post_id );

	$current_user    = wp_get_current_user();
	$new_post_author = $current_user->ID;

	/*
	 * if shortcode data exists, create the shortcode duplicate
	 */
	if ( isset( $post ) && $post != null ) {

		/*
		 * new shortcode data array
		 */
		$args = array(
			'comment_status' => $post->comment_status,
			'ping_status'    => $post->ping_status,
			'post_author'    => $new_post_author,
			'post_content'   => $post->post_content,
			'post_excerpt'   => $post->post_excerpt,
			'post_name'      => $post->post_name,
			'post_parent'    => $post->post_parent,
			'post_password'  => $post->post_password,
			'post_status'    => 'draft',
			'post_title'     => $post->post_title,
			'post_type'      => $post->post_type,
			'to_ping'        => $post->to_ping,
			'menu_order'     => $post->menu_order,
		);

		/*
		 * insert the shortcode by wp_insert_post() function
		 */
		$new_post_id = wp_insert_post( $args );

		/*
		 * get all current post terms ad set them to the new post draft
		 */
		$taxonomies = get_object_taxonomies( $post->post_type ); // returns array of taxonomy names for post type, ex array("category", "post_tag");
		foreach ( $taxonomies as $taxonomy ) {
			$post_terms = wp_get_object_terms( $post_id, $taxonomy, array( 'fields' => 'slugs' ) );
			wp_set_object_terms( $new_post_id, $post_terms, $taxonomy, false );
		}

		/*
		 * duplicate all post meta just in two SQL queries
		 */
		$post_meta_infos = $wpdb->get_results( "SELECT meta_key, meta_value FROM $wpdb->postmeta WHERE post_id=$post_id" );
		if ( count( $post_meta_infos ) != 0 ) {
			$sql_query = "INSERT INTO $wpdb->postmeta (post_id, meta_key, meta_value) ";
			foreach ( $post_meta_infos as $meta_info ) {
				$meta_key = $meta_info->meta_key;
				if ( $meta_key == '_wp_old_slug' ) {
					continue;
				}
				$meta_value      = addslashes( $meta_info->meta_value );
				$sql_query_sel[] = "SELECT $new_post_id, '$meta_key', '$meta_value'";
			}
			$sql_query .= implode( ' UNION ALL ', $sql_query_sel );
			$wpdb->query( $sql_query );
		}

		/*
		 * finally, redirect to the edit post screen for the new draft
		 */
		wp_redirect( admin_url( 'edit.php?post_type=' . $post->post_type ) );

		exit;
	} else {
		wp_die( __( 'Shortcode creation failed, could not find original post: ', 'woo-product-slider-pro' ) . $post_id );
	}
}
add_action( 'admin_action_sp_wpspro_duplicate_shortcode', 'sp_wpspro_duplicate_shortcode' );

/*
 * Add the duplicate link to action list for post_row_actions
 */
function sp_wpspro_duplicate_shortcode_link( $actions, $post ) {
	if ( current_user_can( 'edit_posts' ) && $post->post_type == 'sp_wpsp_shortcodes' ) {
		$actions['duplicate'] = '<a href="' . wp_nonce_url( 'admin.php?action=sp_wpspro_duplicate_shortcode&post=' . $post->ID, basename( __FILE__ ), 'sp_wpspro_duplicate_nonce' ) . '" rel="permalink">' . __( 'Duplicate', 'woo-product-slider-pro' ) . '</a>';
	}
	return $actions;
}
add_filter( 'post_row_actions', 'sp_wpspro_duplicate_shortcode_link', 10, 2 );
