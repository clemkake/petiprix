<?php
/*
* @Author 		pickplugins
* Copyright: 	2015 pickplugins
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 







add_action('wcps_settings_options', 'wcps_settings_options',10, 2);

if(!function_exists('wcps_settings_options')) {
    function wcps_settings_options($tab){
        $settings_tabs_field = new settings_tabs_field();

        $wcps_track_product_view = get_option('wcps_track_product_view', 'no');
        $wcps_load_script_pages = get_option('wcps_load_script_pages', '');

        ?>
        <div class="section">
            <div class="section-title">Options</div>
            <p class="description section-description">Put license key to get automatic update.</p>

            <?php

            $args = array(
                'id'		=> 'wcps_track_product_view',
                //'parent'		=> '',
                'title'		=> __('Track product View','woocommerce-products-slider'),
                'details'	=> __('You can track view product by set Yes.','woocommerce-products-slider'),
                'type'		=> 'select',
                'value'		=> $wcps_track_product_view,
                'default'		=> 'OR',
                'args'		=> array(
                    'no'=>__('No','woocommerce-products-slider'),
                    'yes'=>__('Yes','woocommerce-products-slider'),



                ),
            );

            $settings_tabs_field->generate_field($args);


            $args = array(
                'id'		=> 'wcps_load_script_pages',
                //'parent'		=> '',
                'title'		=> __('Optimize CSS & Scripts file load by page','woocommerce-products-slider'),
                'details'	=> __('Please use page ids where you using shortcode <code>[wcps id="123"]</code>Use comma separate value. ex: 12,14','woocommerce-products-slider'),
                'type'		=> 'text',
                'value'		=> $wcps_load_script_pages,
                'default'		=> '',
            );

            $settings_tabs_field->generate_field($args);








            ?>

        </div>
            <?php
    }
}















