<?php
/*
Plugin Name: License Manager - Clients
Plugin URI: http://pickplugins.com
Description: Awesome Question and Answer.
Version: 2.0.1
Text Domain: question-answer
Author: pickplugins
Author URI: http://pickplugins.com
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html
*/

if ( ! defined('ABSPATH')) exit;  // if direct access 


if( ! class_exists( 'class_wcps_support' ) ) {
    class class_wcps_support
    {

        public function __construct()
        {


            //add_action( 'init', array( $this, 'check_plugin_update' ), 12 );

        }

        public function our_plugins()
        {

            $our_plugins = array(
                array(
                    'title' => 'Post Grid',
                    'link' => 'http://www.pickplugins.com/item/post-grid-create-awesome-grid-from-any-post-type-for-wordpress/',
                    'thumb' => 'https://www.pickplugins.com/wp-content/uploads/2015/12/3814-post-grid-thumb-500x262.jpg',
                ),

                array(
                    'title' => 'Woocommerce Products Slider',
                    'link' => 'http://www.pickplugins.com/item/woocommerce-products-slider-for-wordpress/',
                    'thumb' => 'https://www.pickplugins.com/wp-content/uploads/2016/03/4357-woocommerce-products-slider-thumb-500x250.jpg',
                ),

                array(
                    'title' => 'Team Showcase',
                    'link' => 'http://www.pickplugins.com/item/team-responsive-meet-the-team-grid-for-wordpress/',
                    'thumb' => 'https://www.pickplugins.com/wp-content/uploads/2016/06/5145-team-thumb-500x250.jpg',
                ),

                array(
                    'title' => 'Job Board Manager',
                    'link' => 'https://wordpress.org/plugins/job-board-manager/',
                    'thumb' => 'https://www.pickplugins.com/wp-content/uploads/2015/08/3466-job-board-manager-thumb-500x250.png',
                ),

                array(
                    'title' => 'Wishlist for WooCommerce',
                    'link' => 'https://www.pickplugins.com/item/woocommerce-wishlist/',
                    'thumb' => 'https://www.pickplugins.com/wp-content/uploads/2017/10/12047-woocommerce-wishlist.png',
                ),

                array(
                    'title' => 'Breadcrumb',
                    'link' => 'https://www.pickplugins.com/item/breadcrumb-awesome-breadcrumbs-style-navigation-for-wordpress/',
                    'thumb' => 'https://www.pickplugins.com/wp-content/uploads/2016/03/4242-breadcrumb-500x252.png',
                ),

                array(
                    'title' => 'Pricing Table',
                    'link' => 'https://www.pickplugins.com/item/pricing-table/',
                    'thumb' => 'https://www.pickplugins.com/wp-content/uploads/2016/10/7042-pricing-table-thumbnail-500x250.png',
                ),

            );

            return apply_filters('wcps_our_plugins', $our_plugins);


        }


        public function video_tutorials()
        {

            $tutorials = array(
                array(
                    'title' => __('How to install', 'woocommerce-products-slider'),
                    'video_url' => 'https://www.youtube.com/watch?v=q0-OseJrD5I&list=PL2GPPfgLrfWxKBdh3-HNMNm3CmtmCPLQe',
                ),

                array(
                    'title' => __('How to create product slider', 'woocommerce-products-slider'),
                    'video_url' => 'https://www.youtube.com/watch?v=jbRR1WrclLY&list=PL2GPPfgLrfWxKBdh3-HNMNm3CmtmCPLQe',
                ),

                array(
                    'title' => __('Display recent products', 'woocommerce-products-slider'),
                    'video_url' => 'https://www.youtube.com/watch?v=kYx65EeFNCI&list=PL2GPPfgLrfWxKBdh3-HNMNm3CmtmCPLQe&index=4',
                ),

                array(
                    'title' => __('Display featured product', 'woocommerce-products-slider'),
                    'video_url' => 'https://www.youtube.com/watch?v=X9YIsmy14ac&list=PL2GPPfgLrfWxKBdh3-HNMNm3CmtmCPLQe',
                ),
                array(
                    'title' => __('Display on sale product', 'woocommerce-products-slider'),
                    'video_url' => 'https://www.youtube.com/watch?v=_GCuwR2VS9Y&list=PL2GPPfgLrfWxKBdh3-HNMNm3CmtmCPLQe',
                ),

                array(
                    'title' => __('[Pro] Display top rated products', 'woocommerce-products-slider'),
                    'video_url' => 'https://www.youtube.com/watch?v=x9XBfBai5Co&list=PL2GPPfgLrfWxKBdh3-HNMNm3CmtmCPLQe',
                ),

                array(
                    'title' => __('[Pro] Display best selling product', 'woocommerce-products-slider'),
                    'video_url' => 'https://www.youtube.com/watch?v=8tucKT29eAo&list=PL2GPPfgLrfWxKBdh3-HNMNm3CmtmCPLQe',
                ),

                array(
                    'title' => __('Display featured products at first', 'woocommerce-products-slider'),
                    'video_url' => 'https://www.youtube.com/watch?v=QqL5tbzSdl0&list=PL2GPPfgLrfWxKBdh3-HNMNm3CmtmCPLQe',
                ),
                array(
                    'title' => __('Display by product ids', 'woocommerce-products-slider'),
                    'video_url' => 'https://www.youtube.com/watch?v=IgA9qbGzfZQ&list=PL2GPPfgLrfWxKBdh3-HNMNm3CmtmCPLQe',
                ),
                array(
                    'title' => __('Display product randomly', 'woocommerce-products-slider'),
                    'video_url' => 'https://www.youtube.com/watch?v=cH7edQK01E8&list=PL2GPPfgLrfWxKBdh3-HNMNm3CmtmCPLQe',
                ),

                array(
                    'title' => __('Product by categories', 'woocommerce-products-slider'),
                    'video_url' => 'https://www.youtube.com/watch?v=HKAEbeEh9Us&list=PL2GPPfgLrfWxKBdh3-HNMNm3CmtmCPLQe',
                ),

                array(
                    'title' => __('Product by menu order', 'woocommerce-products-slider'),
                    'video_url' => 'https://www.youtube.com/watch?v=jJqn1ZMTYKI&list=PL2GPPfgLrfWxKBdh3-HNMNm3CmtmCPLQe',
                ),
                array(
                    'title' => __('[Pro] Product by SKU', 'woocommerce-products-slider'),
                    'video_url' => 'https://www.youtube.com/watch?v=ZiRYX503Esc&list=PL2GPPfgLrfWxKBdh3-HNMNm3CmtmCPLQe',
                ),
                array(
                    'title' => __('[Pro] Product by attributes', 'woocommerce-products-slider'),
                    'video_url' => 'https://www.youtube.com/watch?v=WK3DpsWG73Q&list=PL2GPPfgLrfWxKBdh3-HNMNm3CmtmCPLQe',
                ),


            );

            return apply_filters('wcps_video_tutorials', $tutorials);


        }


        public function faq()
        {
            $faq = array(
//
//            array(
//                'title'=>__('How to install WooCommerce Products Slider?', 'woocommerce-products-slider'),
//                'url'=>'#',
//            ),
//            array(
//                'title'=>__('How to upgrade premium version  WooCommerce Products Slider?', 'woocommerce-products-slider'),
//                'url'=>'#',
//            ),
//
//            array(
//                'title'=>__('How to Hide out of stock items?', 'woocommerce-products-slider'),
//                'url'=>'#',
//            ),
//
//            array(
//                'title'=>__('Display  Featured product?', 'woocommerce-products-slider'),
//                'url'=>'#',
//            ),
//
//            array(
//                'title'=>__('Display On Sale Product?', 'woocommerce-products-slider'),
//                'url'=>'#',
//            ),
//
//            array(
//                'title'=>__('Display Best selling product?', 'woocommerce-products-slider'),
//                'url'=>'#',
//            ),
//
//            array(
//                'title'=>__('Display top rated products?', 'woocommerce-products-slider'),
//                'url'=>'#',
//            ),
//
//            array(
//                'title'=>__('Display featured product at first?', 'woocommerce-products-slider'),
//                'url'=>'#',
//            ),
//
//            array(
//                'title'=>__('Display by product ids', 'woocommerce-products-slider'),
//                'url'=>'#',
//            ),
//            array(
//                'title'=>__('Display product by SKU', 'woocommerce-products-slider'),
//                'url'=>'#',
//            ),
//            array(
//                'title'=>__('Display up sell & cross sell product.', 'woocommerce-products-slider'),
//                'url'=>'#',
//            ),
//            array(
//                'title'=>__('Display product b meta query.', 'woocommerce-products-slider'),
//                'url'=>'#',
//            ),
//            array(
//                'title'=>__('Display product by attributes.', 'woocommerce-products-slider'),
//                'url'=>'#',
//            ),
//            array(
//                'title'=>__('Display product by categories.', 'woocommerce-products-slider'),
//                'url'=>'#',
//            ),
//            array(
//                'title'=>__('Display recent products.', 'woocommerce-products-slider'),
//                'url'=>'#',
//            ),
//
//            array(
//                'title'=>__('Display product randomly.', 'woocommerce-products-slider'),
//                'url'=>'#',
//            ),
//            array(
//                'title'=>__('Display product by menu order.', 'woocommerce-products-slider'),
//                'url'=>'#',
//            ),
//            array(
//                'title'=>__('Display product by reviews count.', 'woocommerce-products-slider'),
//                'url'=>'#',
//            ),


            );


            return apply_filters('wcps_faq', $faq);


        }


    }
}
