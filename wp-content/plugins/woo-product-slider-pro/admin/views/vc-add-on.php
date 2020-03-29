<?php

// Visual Composer.
if ( class_exists( 'WPBakeryVisualComposerAbstract' ) ) {

	class SP_WPSPRO_VC_Element {

		/**
		 * SP_WPSPRO_VC_Element constructor.
		 */
		public function __construct() {
			add_action( 'init', array( $this, 'wpsp_product_slider_vc' ) );
		}

		// ShortCode List
		private function shortcodes_list() {
			$shortcodes = get_posts(
				array(
					'post_type'   => 'sp_wpsp_shortcodes',
					'post_status' => 'publish',
				)
			);

			if ( count( $shortcodes ) < 1 ) {
				return array();
			}

			$result = array();

			foreach ( $shortcodes as $shortcode ) {
				$result[ esc_html( $shortcode->post_title ) ] = $shortcode->ID;
			}

			return $result;
		}

		/**
		 * Integrate with visual composer
		 */
		public function wpsp_product_slider_vc() {
			// Check if Visual Composer is installed
			if ( ! defined( 'WPB_VC_VERSION' ) ) {
				return;
			}

			vc_map(
				array(
					'name'        => esc_html__( 'Product Slider Pro for WooCommerce', 'woo-product-slider-pro' ),
					'base'        => 'woo-product-slider-pro',
					'icon'        => 'icon-woo-product-slider-pro',
					'class'       => '',
					'description' => esc_html__( 'Display WooCommerce Product Slider.', 'woo-product-slider-pro' ),
					'category'    => esc_html__( 'ShapedPlugin', 'woo-product-slider-pro' ),
					'params'      => array(

						array(
							'type'        => 'dropdown',
							'heading'     => esc_html__( 'Shortcode:', 'woo-product-slider-pro' ),
							'description' => esc_html__( 'Select a shortcode.', 'woo-product-slider-pro' ),
							'param_name'  => 'id',
							'value'       => $this->shortcodes_list(),
						),
					),

				)
			);

		}
	}

	new SP_WPSPRO_VC_Element();
}
