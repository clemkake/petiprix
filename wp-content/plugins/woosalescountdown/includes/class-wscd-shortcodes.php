<?php

if ( !defined( 'ABSPATH' ) ) {
    exit();
}

class WSCD_Shortcodes {
    /* init shortcodes */

    public static function init() {
        $shortcodes = array(
            'product_sale',
            'product_sale_countdown'
        );

        foreach ( $shortcodes as $shortcode ) {
            add_shortcode( $shortcode, array( __CLASS__, $shortcode ) );
        }
    }

    /**
     * product sales
     * WC_Shortcodes::products woocommerce
     * */
    public static function product_sale( $atts, $content = null ) {
        global $woosalescountdown;
        $atts = shortcode_atts( array(
            'columns' => '4',
            'orderby' => 'title',
            'order' => 'asc',
            'id' => '',
            'skus' => ''
                ), $atts );

        if ( $atts['id'] ) {
            $atts['ids'] = $atts['id'];
            return WC_Shortcodes::products( $atts );
        }
    }

    /* single countdown without any information */

    public static function product_sale_countdown( $atts, $content = null ) {
        global $woosalescountdown;
        $atts = shortcode_atts( array(
            'id' => '',
            'variable_id' => ''
                ), $atts );
        return $woosalescountdown->get_template_content( 'shortcode-product-sale-countdown.php', $atts );
    }

}
