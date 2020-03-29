<?php
if ( ! defined('ABSPATH')) exit;  // if direct access

function wcps_posttype_register() {

    $labels = array(
        'name' => __('WCPS',  'woocommerce-products-slider'),
        'singular_name' => __('WCPS',  'woocommerce-products-slider'),
        'add_new' => __('New WCPS',  'woocommerce-products-slider'),
        'add_new_item' => __('New WCPS', 'woocommerce-products-slider'),
        'edit_item' => __('Edit WCPS', 'woocommerce-products-slider'),
        'new_item' => __('New WCPS', 'woocommerce-products-slider'),
        'view_item' => __('View WCPS', 'woocommerce-products-slider'),
        'search_items' => __('Search WCPS', 'woocommerce-products-slider'),
        'not_found' =>  __('Nothing found', 'woocommerce-products-slider'),
        'not_found_in_trash' => __('Nothing found in Trash', 'woocommerce-products-slider'),
        'parent_item_colon' => ''
    );


    $args = array(
        'labels' => $labels,
        'public' => false,
        'publicly_queryable' => true,
        'show_ui' => true,
        'query_var' => true,
        'menu_icon' => null,
        'rewrite' => true,
        'capability_type' => 'post',
        'hierarchical' => false,
        'menu_position' => null,
        'supports' => array('title'),
        'menu_icon' => 'dashicons-media-spreadsheet',

    );

    register_post_type( 'wcps' , $args );

}

add_action('init', 'wcps_posttype_register');


/**
 * Adds a box to the main column on the Post and Page edit screens.
 */
function meta_boxes_wcps(){

    $screens = array( 'wcps' );
    global $post;
    $post_id = $post->ID;




    foreach ( $screens as $screen ){
        add_meta_box('wcps_metabox',__('WCPS Options', 'woocommerce-products-slider'),'meta_boxes_wcps_input', $screen);
        //add_meta_box('wcps_metabox_side',__('Post Grid Information', 'woocommerce-products-slider'),'meta_boxes_wcps_side', $screen,'side');
        add_meta_box('wcps_metabox_side',__('PickPlugins Product Slider', 'woocommerce-products-slider'),'meta_boxes_wcps_side', $screen,'side');

    }



}
add_action( 'add_meta_boxes', 'meta_boxes_wcps' );





function meta_boxes_wcps_input( $post ) {

    global $post;
    wp_nonce_field( 'meta_boxes_wcps_input', 'meta_boxes_wcps_input_nonce' );

    $post_id = $post->ID;


    $wcps_settings_tab = array();


    $wcps_settings_tab[] = array(
        'id' => 'shortcode',
        'title' => __('<i class="fas fa-laptop-code"></i> Shortcode','woocommerce-products-slider'),
        'priority' => 1,
        'active' => false,
    );


    $wcps_settings_tab[] = array(
        'id' => 'options',
        'title' => __('<i class="fa fa-cogs"></i> Options','woocommerce-products-slider'),
        'priority' => 2,
        'active' => false,
    );

    $wcps_settings_tab[] = array(
        'id' => 'query_product',
        'title' => __('<i class="fas fa-qrcode"></i> Query Product','woocommerce-products-slider'),
        'priority' => 3,
        'active' => true,
    );

    $wcps_settings_tab[] = array(
        'id' => 'style',
        'title' => __('<i class="fas fa-palette"></i> Style','woocommerce-products-slider'),
        'priority' => 4,
        'active' => false,
    );

    $wcps_settings_tab[] = array(
        'id' => 'elements',
        'title' => __('<i class="fa fa-magic"></i> Elements','woocommerce-products-slider'),
        'priority' => 5,
        'active' => false,
    );

    $wcps_settings_tab[] = array(
        'id' => 'custom_scripts',
        'title' => __('<i class="far fa-file-code"></i> Custom CSS','woocommerce-products-slider'),
        'priority' => 6,
        'active' => false,
    );




    $wcps_settings_tabs = apply_filters('wcps_settings_tabs', $wcps_settings_tab);


    $tabs_sorted = array();
    foreach ($wcps_settings_tabs as $page_key => $tab) $tabs_sorted[$page_key] = isset( $tab['priority'] ) ? $tab['priority'] : 0;
    array_multisort($tabs_sorted, SORT_ASC, $wcps_settings_tabs);







    ?>

    <div class="wcps-meta-box">

        <div class="settings-tabs vertical">
            <ul class="tab-navs">
                <?php
                foreach ($wcps_settings_tabs as $tab){
                    $id = $tab['id'];
                    $title = $tab['title'];
                    $active = $tab['active'];
                    $data_visible = isset($tab['data_visible']) ? $tab['data_visible'] : '';
                    $hidden = isset($tab['hidden']) ? $tab['hidden'] : false;
                    ?>
                    <li <?php if(!empty($data_visible)):  ?> data_visible="<?php echo $data_visible; ?>" <?php endif; ?> class="tab-nav <?php if($hidden) echo 'hidden';?> <?php if($active) echo 'active';?>" data-id="<?php echo $id; ?>"><?php echo $title; ?></li>
                    <?php
                }
                ?>
            </ul>
            <?php
            foreach ($wcps_settings_tabs as $tab){
                $id = $tab['id'];
                $title = $tab['title'];
                $active = $tab['active'];


                ?>

                <div class="tab-content <?php if($active) echo 'active';?>" id="<?php echo $id; ?>">
                    <?php
                    do_action('wcps_meta_tab_content_'.$id, $tab, $post_id);
                    ?>
                </div>
                <?php
            }
            ?>
        </div>
        <div class="clear clearfix"></div>

    </div>










    <?php



}



function meta_boxes_wcps_side( $post ) {

    ?>
    <div class="post-grid-meta-box">

        <ul>
            <li>Version: <?php echo wcps_version; ?></li>
            <li>Tested WP: 5.1</li>

        </ul>

        <h3>Documentation</h3>
        <a class="button" href="https://www.pickplugins.com/documentation/woocommerce-products-slider/?ref=dashboard" target="_blank">Documentation</a><p class="description">Before asking, submitting reviews please take a look on our documentation, may help your issue fast.</p>

        <h3>Looking for support?</h3>
        <a class="button" href="https://www.pickplugins.com/forum/?ref=dashboard" target="_blank">Create Ticket</a><p class="description">Its free and you can ask any question about our plugins and get support fast.</p>


        <h3>Provide your feedback</h3>

        <a class="button" href="https://wordpress.org/support/plugin/woocommerce-products-slider/reviews/?filter=5" target="_blank">Submit Reviews</a> <a class="button" href="https://wordpress.org/support/plugin/woocommerce-products-slider/#new-topic-0" target="_blank">Ask wordpress.org</a><p>We spent thousand+ hours to development on this plugin, please submit your reviews wisely.</p><p>If you have any issue with this plugin please submit our forums or contact our support first.</p><p class="description">Your feedback and reviews are most important things to keep our development on track. If you have time please submit us five star <a href="https://wordpress.org/support/plugin/woocommerce-products-slider/reviews/?filter=5"> <span style="color: orange"><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i></span></a> reviews.</p>




        <?php
        $class_wcps_support = new class_wcps_support();

       ?>



        <?php
        $video_tutorials =  $class_wcps_support->faq();
        if(!empty($video_tutorials)):
            ?>
            <div class="faq">
                <h3>FAQ</h3>
                <ul>
                    <?php
                    foreach($video_tutorials as $item){
                        ?>
                        <li class="item">
                            <a target="_blank" href="<?php echo $item['url']; ?>"><i class="fa fa-question"></i> <?php echo $item['title']; ?></a>

                        </li>
                        <?php
                    }

                    ?>
                </ul>
            </div>
        <?php

        endif;
        ?>



        <?php
        $video_tutorials =  $class_wcps_support->video_tutorials();
        if(!empty($video_tutorials)):
            ?>
            <div class="video-tutorials">
                <h3>Video Tutorials</h3>
                <ul>
                <?php
                foreach($video_tutorials as $item){
                    ?>
                    <li class="item">
                        <a target="_blank" href="<?php echo $item['video_url']; ?>"><i class="far fa-dot-circle"></i> <?php echo $item['title']; ?></a>

                    </li>
                    <?php
                }

                ?>
                </ul>
            </div>
            <?php

        endif;
        ?>











    </div>
    <?php

}






/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */



function meta_boxes_wcps_save( $post_id ) {

    /*
     * We need to verify this came from the our screen and with proper authorization,
     * because save_post can be triggered at other times.
     */

    // Check if our nonce is set.
    if ( ! isset( $_POST['meta_boxes_wcps_input_nonce'] ) )
        return $post_id;

    $nonce = $_POST['meta_boxes_wcps_input_nonce'];

    // Verify that the nonce is valid.
    if ( ! wp_verify_nonce( $nonce, 'meta_boxes_wcps_input' ) )
        return $post_id;

    // If this is an autosave, our form has not been submitted, so we don't want to do anything.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return $post_id;



    /* OK, its safe for us to save the data now. */

    // Sanitize user input.
    //$wcps_collapsible = sanitize_text_field( $_POST['wcps_collapsible'] );





    /* OK, its safe for us to save the data now. */

    // Sanitize user input.
    $wcps_bg_img = sanitize_text_field( $_POST['wcps_bg_img'] );
    $wcps_container_padding = sanitize_text_field( $_POST['wcps_container_padding'] );
    $wcps_container_bg_color = sanitize_text_field( $_POST['wcps_container_bg_color'] );

    $wcps_items_bg_color = sanitize_text_field( $_POST['wcps_items_bg_color'] );
    $wcps_items_padding = sanitize_text_field( $_POST['wcps_items_padding'] );

    $wcps_themes = sanitize_text_field( $_POST['wcps_themes'] );




    $wcps_total_items = sanitize_text_field( $_POST['wcps_total_items'] );

    $wcps_total_items_price_format = sanitize_text_field( $_POST['wcps_total_items_price_format'] );

    $wcps_column_number = sanitize_text_field( $_POST['wcps_column_number'] );
    $wcps_column_number_mobile = sanitize_text_field( $_POST['wcps_column_number_mobile'] );
    $wcps_column_number_tablet = sanitize_text_field( $_POST['wcps_column_number_tablet'] );




    if(empty($_POST['wcps_auto_play'])){
        $wcps_auto_play = '';
    }
    else{
        $wcps_auto_play = sanitize_text_field( $_POST['wcps_auto_play'] );
    }

    if(empty($_POST['wcps_auto_play_speed']))
    {
        $wcps_auto_play_speed = 1000;
    }
    else
    {
        $wcps_auto_play_speed = sanitize_text_field( $_POST['wcps_auto_play_speed'] );
    }


    if(empty($_POST['wcps_auto_play_timeout']))
    {
        $wcps_auto_play_timeout = 1200;
    }
    else
    {
        $wcps_auto_play_timeout = sanitize_text_field( $_POST['wcps_auto_play_timeout'] );
    }




    if(empty($_POST['wcps_rewind'])){
        $wcps_rewind = '';
    }
    else{
        $wcps_rewind = sanitize_text_field( $_POST['wcps_rewind'] );
    }

    if(empty($_POST['wcps_loop'])){
        $wcps_loop = '';
    }
    else{
        $wcps_loop = sanitize_text_field( $_POST['wcps_loop'] );
    }


    if(empty($_POST['wcps_slideBy'])){
        $wcps_slideBy = 1;
    }
    else{
        $wcps_slideBy = sanitize_text_field( $_POST['wcps_slideBy'] );
    }


    if(empty($_POST['wcps_center'])){
        $wcps_center = '';
    }
    else{
        $wcps_center = sanitize_text_field( $_POST['wcps_center'] );
    }


    if(empty($_POST['wcps_stop_on_hover']))
    {
        $wcps_stop_on_hover = '';
    }
    else
    {
        $wcps_stop_on_hover = sanitize_text_field( $_POST['wcps_stop_on_hover'] );
    }


    if(empty($_POST['wcps_slider_navigation']))
    {
        $wcps_slider_navigation = '';
    }
    else
    {
        $wcps_slider_navigation = sanitize_text_field( $_POST['wcps_slider_navigation'] );
    }

    $wcps_slider_navigation_position = sanitize_text_field( $_POST['wcps_slider_navigation_position'] );


    $wcps_slide_speed = sanitize_text_field( $_POST['wcps_slide_speed'] );


    if(empty($_POST['wcps_slider_pagination']))
    {
        $wcps_slider_pagination = '';
    }
    else
    {
        $wcps_slider_pagination = sanitize_text_field( $_POST['wcps_slider_pagination'] );
    }



    $wcps_pagination_slide_speed = sanitize_text_field( $_POST['wcps_pagination_slide_speed'] );


    if(empty($_POST['wcps_slider_pagination_count']))
    {
        $wcps_slider_pagination_count = '';
    }
    else
    {
        $wcps_slider_pagination_count = sanitize_text_field( $_POST['wcps_slider_pagination_count'] );
    }



    $wcps_slider_pagination_bg = sanitize_text_field( $_POST['wcps_slider_pagination_bg'] );
    $wcps_slider_pagination_text_color = sanitize_text_field( $_POST['wcps_slider_pagination_text_color'] );

    $wcps_slider_lazy_load = sanitize_text_field( $_POST['wcps_slider_lazy_load'] );


    if(empty($_POST['wcps_slider_touch_drag']))
    {
        $wcps_slider_touch_drag = '';
    }
    else
    {
        $wcps_slider_touch_drag = sanitize_text_field( $_POST['wcps_slider_touch_drag'] );
    }

    if(empty($_POST['wcps_slider_mouse_drag']))
    {
        $wcps_slider_mouse_drag = '';
    }
    else
    {
        $wcps_slider_mouse_drag = sanitize_text_field( $_POST['wcps_slider_mouse_drag'] );
    }

    if(empty($_POST['wcps_slider_rtl']))
    {
        $wcps_slider_rtl = 'false';
    }
    else
    {
        $wcps_slider_rtl = sanitize_text_field( $_POST['wcps_slider_rtl'] );
    }


    if(empty($_POST['wcps_slider_animateout']))
    {
        $wcps_slider_animateout = 'fadeOut';
    }
    else
    {
        $wcps_slider_animateout = sanitize_text_field( $_POST['wcps_slider_animateout'] );
    }

    if(empty($_POST['wcps_slider_animatein']))
    {
        $wcps_slider_animatein = 'flipInX';
    }
    else
    {
        $wcps_slider_animatein = sanitize_text_field( $_POST['wcps_slider_animatein'] );
    }




    if(!empty($_POST['wcps_product_categories'])){
        $wcps_product_categories =  $_POST['wcps_product_categories'] ;
    }
    else{
        $wcps_product_categories = array();
    }


    $wcps_taxonomies = isset($_POST['wcps_taxonomies']) ? stripslashes_deep( $_POST['wcps_taxonomies'] ) : array();



    $wcps_product_featured = sanitize_text_field( $_POST['wcps_product_featured'] );
    $wcps_product_on_sale = sanitize_text_field( $_POST['wcps_product_on_sale'] );

    $wcps_product_ids = sanitize_text_field( $_POST['wcps_product_ids'] );















    if(empty($_POST['wcps_product_ids']))
    {
        $wcps_product_ids = '';
    }
    else
    {
        $wcps_product_ids = sanitize_text_field( $_POST['wcps_product_ids'] );
    }





    //$wcps_cat_display = sanitize_text_field( $_POST['wcps_cat_display'] );
    $wcps_items_cat_font_size = sanitize_text_field( $_POST['wcps_items_cat_font_size'] );
    $wcps_items_cat_text_align = sanitize_text_field( $_POST['wcps_items_cat_text_align'] );
    $wcps_items_cat_font_color = sanitize_text_field( $_POST['wcps_items_cat_font_color'] );
    $wcps_items_cat_separator = sanitize_text_field( $_POST['wcps_items_cat_separator'] );

    //$wcps_featured_display = sanitize_text_field( $_POST['wcps_featured_display'] );
    $wcps_featured_icon_url = sanitize_text_field( $_POST['wcps_featured_icon_url'] );

    //$wcps_sale_display = sanitize_text_field( $_POST['wcps_sale_display'] );
    $wcps_sale_icon_url = sanitize_text_field( $_POST['wcps_sale_icon_url'] );



    //$wcps_ratings_display = sanitize_text_field( $_POST['wcps_ratings_display'] );
    $wcps_ratings_text_align = sanitize_text_field( $_POST['wcps_ratings_text_align'] );
    $wcps_items_ratings_font_size = sanitize_text_field( $_POST['wcps_items_ratings_font_size'] );
    $wcps_items_ratings_color = sanitize_text_field( $_POST['wcps_items_ratings_color'] );

    $wcps_cart_style = sanitize_text_field( $_POST['wcps_cart_style'] );
    //$wcps_cart_display = sanitize_text_field( $_POST['wcps_cart_display'] );
    $wcps_cart_bg = sanitize_text_field( $_POST['wcps_cart_bg'] );

    $wcps_cart_text_color = sanitize_text_field( $_POST['wcps_cart_text_color'] );
    $wcps_cart_text_align = sanitize_text_field( $_POST['wcps_cart_text_align'] );
    $wcps_cart_display_quantity = sanitize_text_field( $_POST['wcps_cart_display_quantity'] );



    $wcps_grid_items = stripslashes_deep( $_POST['wcps_grid_items'] );

    if(!empty($_POST['wcps_grid_items_hide'])){
        $wcps_grid_items_hide = stripslashes_deep( $_POST['wcps_grid_items_hide'] );
    }
    else{
        $wcps_grid_items_hide = array();
    }

    //$wcps_items_title_display = sanitize_text_field( $_POST['wcps_items_title_display'] );
    $wcps_items_title_color = sanitize_text_field( $_POST['wcps_items_title_color'] );
    $wcps_items_title_font_size = sanitize_text_field( $_POST['wcps_items_title_font_size'] );
    $wcps_items_title_text_align = sanitize_text_field( $_POST['wcps_items_title_text_align'] );

    $wcps_items_excerpt_count = sanitize_text_field( $_POST['wcps_items_excerpt_count'] );
    $wcps_items_excerpt_read_more = sanitize_text_field( $_POST['wcps_items_excerpt_read_more'] );
    $wcps_items_excerpt_text_align = sanitize_text_field( $_POST['wcps_items_excerpt_text_align'] );
    $wcps_items_excerpt_font_size = sanitize_text_field( $_POST['wcps_items_excerpt_font_size'] );
    $wcps_items_excerpt_font_color = sanitize_text_field( $_POST['wcps_items_excerpt_font_color'] );

    //$wcps_items_price_display = sanitize_text_field( $_POST['wcps_items_price_display'] );
    $wcps_items_price_color = sanitize_text_field( $_POST['wcps_items_price_color'] );
    $wcps_items_price_font_size = sanitize_text_field( $_POST['wcps_items_price_font_size'] );
    $wcps_items_price_text_align = sanitize_text_field( $_POST['wcps_items_price_text_align'] );

    $wcps_items_tag_font_size = sanitize_text_field( $_POST['wcps_items_tag_font_size'] );
    $wcps_items_tag_text_align = sanitize_text_field( $_POST['wcps_items_tag_text_align'] );
    $wcps_items_tag_font_color = sanitize_text_field( $_POST['wcps_items_tag_font_color'] );

    $wcps_items_thumb_size = sanitize_text_field( $_POST['wcps_items_thumb_size'] );


    $wcps_items_thumb_max_hieght = sanitize_text_field( $_POST['wcps_items_thumb_max_hieght'] );
    $wcps_items_thumb_zoom = sanitize_text_field( $_POST['wcps_items_thumb_zoom'] );

    $wcps_items_empty_thumb = sanitize_text_field( $_POST['wcps_items_empty_thumb'] );
    $wcps_query_order = sanitize_text_field( $_POST['wcps_query_order'] );

    $wcps_query_orderby = stripslashes_deep( $_POST['wcps_query_orderby'] );
    $wcps_sale_count_text = stripslashes_deep( $_POST['wcps_sale_count_text'] );


    $wcps_hide_out_of_stock = sanitize_text_field( $_POST['wcps_hide_out_of_stock'] );
    $wcps_items_thumb_link_target = sanitize_text_field( $_POST['wcps_items_thumb_link_target'] );
    $wcps_items_thumb_lazy_src = sanitize_text_field( $_POST['wcps_items_thumb_lazy_src'] );



    $wcps_ribbon_name = sanitize_text_field( $_POST['wcps_ribbon_name'] );
    $wcps_ribbon_custom = sanitize_text_field( $_POST['wcps_ribbon_custom'] );

    $wcps_items_custom_css = sanitize_text_field( $_POST['wcps_items_custom_css'] );


    // Update the meta field in the database.
    update_post_meta( $post_id, 'wcps_bg_img', $wcps_bg_img );
    update_post_meta( $post_id, 'wcps_container_padding', $wcps_container_padding );
    update_post_meta( $post_id, 'wcps_container_bg_color', $wcps_container_bg_color );

    update_post_meta( $post_id, 'wcps_items_bg_color', $wcps_items_bg_color );
    update_post_meta( $post_id, 'wcps_items_padding', $wcps_items_padding );


    update_post_meta( $post_id, 'wcps_themes', $wcps_themes );


    update_post_meta( $post_id, 'wcps_total_items', $wcps_total_items );

    update_post_meta( $post_id, 'wcps_total_items_price_format', $wcps_total_items_price_format );

    update_post_meta( $post_id, 'wcps_column_number', $wcps_column_number );
    update_post_meta( $post_id, 'wcps_column_number_mobile', $wcps_column_number_mobile );
    update_post_meta( $post_id, 'wcps_column_number_tablet', $wcps_column_number_tablet );


    update_post_meta( $post_id, 'wcps_auto_play', $wcps_auto_play );
    update_post_meta( $post_id, 'wcps_auto_play_speed', $wcps_auto_play_speed );
    update_post_meta( $post_id, 'wcps_auto_play_timeout', $wcps_auto_play_timeout );

    update_post_meta( $post_id, 'wcps_rewind', $wcps_rewind );
    update_post_meta( $post_id, 'wcps_loop', $wcps_loop );
    update_post_meta( $post_id, 'wcps_slideBy', $wcps_slideBy );
    update_post_meta( $post_id, 'wcps_center', $wcps_center );

    update_post_meta( $post_id, 'wcps_stop_on_hover', $wcps_stop_on_hover );
    update_post_meta( $post_id, 'wcps_slider_navigation', $wcps_slider_navigation );
    update_post_meta( $post_id, 'wcps_slider_navigation_position', $wcps_slider_navigation_position );
    update_post_meta( $post_id, 'wcps_slide_speed', $wcps_slide_speed );

    update_post_meta( $post_id, 'wcps_slider_pagination', $wcps_slider_pagination );
    update_post_meta( $post_id, 'wcps_pagination_slide_speed', $wcps_pagination_slide_speed );
    update_post_meta( $post_id, 'wcps_slider_pagination_count', $wcps_slider_pagination_count );

    update_post_meta( $post_id, 'wcps_slider_pagination_bg', $wcps_slider_pagination_bg );
    update_post_meta( $post_id, 'wcps_slider_pagination_text_color', $wcps_slider_pagination_text_color );
    update_post_meta( $post_id, 'wcps_slider_lazy_load', $wcps_slider_lazy_load );

    update_post_meta( $post_id, 'wcps_slider_touch_drag', $wcps_slider_touch_drag );
    update_post_meta( $post_id, 'wcps_slider_mouse_drag', $wcps_slider_mouse_drag );
    update_post_meta( $post_id, 'wcps_slider_rtl', $wcps_slider_rtl );
    update_post_meta( $post_id, 'wcps_slider_animateout', $wcps_slider_animateout );
    update_post_meta( $post_id, 'wcps_slider_animatein', $wcps_slider_animatein );



    update_post_meta( $post_id, 'wcps_product_categories', $wcps_product_categories );
    update_post_meta( $post_id, 'wcps_taxonomies', $wcps_taxonomies );

    update_post_meta( $post_id, 'wcps_product_featured', $wcps_product_featured );
    update_post_meta( $post_id, 'wcps_product_on_sale', $wcps_product_on_sale );
    update_post_meta( $post_id, 'wcps_product_ids', $wcps_product_ids );









    //update_post_meta( $post_id, 'wcps_content_sku', $wcps_content_sku );

    //update_post_meta( $post_id, 'wcps_taxonomy', $wcps_taxonomy );
    //update_post_meta( $post_id, 'wcps_taxonomy_category', $wcps_taxonomy_category );

    update_post_meta( $post_id, 'wcps_product_ids', $wcps_product_ids );

    //update_post_meta( $post_id, 'wcps_cat_display', $wcps_cat_display );
    update_post_meta( $post_id, 'wcps_items_cat_font_size', $wcps_items_cat_font_size );
    update_post_meta( $post_id, 'wcps_items_cat_text_align', $wcps_items_cat_text_align );
    update_post_meta( $post_id, 'wcps_items_cat_font_color', $wcps_items_cat_font_color );
    update_post_meta( $post_id, 'wcps_items_cat_separator', $wcps_items_cat_separator );

    //update_post_meta( $post_id, 'wcps_featured_display', $wcps_featured_display );
    update_post_meta( $post_id, 'wcps_featured_icon_url', $wcps_featured_icon_url );

    //update_post_meta( $post_id, 'wcps_sale_display', $wcps_sale_display );
    update_post_meta( $post_id, 'wcps_sale_icon_url', $wcps_sale_icon_url );


    //update_post_meta( $post_id, 'wcps_ratings_display', $wcps_ratings_display );
    update_post_meta( $post_id, 'wcps_ratings_text_align', $wcps_ratings_text_align );
    update_post_meta( $post_id, 'wcps_items_ratings_font_size', $wcps_items_ratings_font_size );
    update_post_meta( $post_id, 'wcps_items_ratings_color', $wcps_items_ratings_color );

    update_post_meta( $post_id, 'wcps_cart_style', $wcps_cart_style );
    //update_post_meta( $post_id, 'wcps_cart_display', $wcps_cart_display );
    update_post_meta( $post_id, 'wcps_cart_bg', $wcps_cart_bg );

    update_post_meta( $post_id, 'wcps_cart_text_color', $wcps_cart_text_color );
    update_post_meta( $post_id, 'wcps_cart_text_align', $wcps_cart_text_align );
    update_post_meta( $post_id, 'wcps_cart_display_quantity', $wcps_cart_display_quantity );

    update_post_meta( $post_id, 'wcps_grid_items', $wcps_grid_items );
    update_post_meta( $post_id, 'wcps_grid_items_hide', $wcps_grid_items_hide );

    //update_post_meta( $post_id, 'wcps_items_title_display', $wcps_items_title_display );
    update_post_meta( $post_id, 'wcps_items_title_color', $wcps_items_title_color );
    update_post_meta( $post_id, 'wcps_items_title_font_size', $wcps_items_title_font_size );
    update_post_meta( $post_id, 'wcps_items_title_text_align', $wcps_items_title_text_align );

    update_post_meta( $post_id, 'wcps_items_excerpt_count', $wcps_items_excerpt_count );
    update_post_meta( $post_id, 'wcps_items_excerpt_read_more', $wcps_items_excerpt_read_more );
    update_post_meta( $post_id, 'wcps_items_excerpt_text_align', $wcps_items_excerpt_text_align );
    update_post_meta( $post_id, 'wcps_items_excerpt_font_size', $wcps_items_excerpt_font_size );
    update_post_meta( $post_id, 'wcps_items_excerpt_font_color', $wcps_items_excerpt_font_color );

    update_post_meta( $post_id, 'wcps_items_tag_font_size', $wcps_items_tag_font_size );
    update_post_meta( $post_id, 'wcps_items_tag_text_align', $wcps_items_tag_text_align );
    update_post_meta( $post_id, 'wcps_items_tag_font_color', $wcps_items_tag_font_color );

    //update_post_meta( $post_id, 'wcps_items_price_display', $wcps_items_price_display );
    update_post_meta( $post_id, 'wcps_items_price_color', $wcps_items_price_color );
    update_post_meta( $post_id, 'wcps_items_price_font_size', $wcps_items_price_font_size );
    update_post_meta( $post_id, 'wcps_items_price_text_align', $wcps_items_price_text_align );


    update_post_meta( $post_id, 'wcps_items_thumb_link_target', $wcps_items_thumb_link_target );
    update_post_meta( $post_id, 'wcps_items_thumb_lazy_src', $wcps_items_thumb_lazy_src );

    update_post_meta( $post_id, 'wcps_sale_count_text', $wcps_sale_count_text );

    update_post_meta( $post_id, 'wcps_items_thumb_size', $wcps_items_thumb_size );
    update_post_meta( $post_id, 'wcps_items_thumb_max_hieght', $wcps_items_thumb_max_hieght );
    update_post_meta( $post_id, 'wcps_items_thumb_zoom', $wcps_items_thumb_zoom );

    update_post_meta( $post_id, 'wcps_items_empty_thumb', $wcps_items_empty_thumb );
    update_post_meta( $post_id, 'wcps_query_order', $wcps_query_order );
    update_post_meta( $post_id, 'wcps_query_orderby', $wcps_query_orderby );

    update_post_meta( $post_id, 'wcps_hide_out_of_stock', $wcps_hide_out_of_stock );


    update_post_meta( $post_id, 'wcps_ribbon_name', $wcps_ribbon_name );
    update_post_meta( $post_id, 'wcps_ribbon_custom', $wcps_ribbon_custom );

    update_post_meta( $post_id, 'wcps_items_custom_css', $wcps_items_custom_css );



}
add_action( 'save_post', 'meta_boxes_wcps_save' );



