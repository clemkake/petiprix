<?php if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK SETTINGS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$settings = array(
	'menu_title'      => __( 'Settings', 'woo-product-slider-pro' ),
	'menu_parent'     => 'edit.php?post_type=sp_wpsp_shortcodes',
	'menu_type'       => 'submenu', // menu, submenu, options, theme, etc.
	'menu_slug'       => 'wpspro_settings',
	'ajax_save'       => true,
	'show_reset_all'  => false,
	'framework_title' => __( 'Product Slider Pro for WooCommerce', 'woo-product-slider-pro' ),
);

// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// FRAMEWORK OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options = array();

// ------------------------------
// Advanced Settings             -
// ------------------------------
$options[] = array(
	'name'   => 'advanced_settings',
	'title'  => __( 'Advanced Settings', 'woo-product-slider-pro' ),
	'icon'   => 'fa fa-cogs',
	'fields' => array(

		array(
			'id'         => 'google_fonts',
			'type'       => 'switcher',
			'title'      => __( 'Google Fonts', 'woo-product-slider-pro' ),
			'desc'       => __( 'Enqueue/Dequeue Google fonts.', 'woo-product-slider-pro' ),
			'wrap_class' => 'wpspro-enqueue-dequue',
			'off_text'   => __( 'Enqueue', 'woo-product-slider-pro' ),
			'on_text'    => __( 'Dequeue', 'woo-product-slider-pro' ),
			'default'    => false,
		),
		array(
			'id'      => 'no_products_found',
			'type'    => 'text',
			'title'   => __( 'No Products Found', 'woo-product-slider-pro' ),
			'desc'    => __( 'Type no products found text.', 'woo-product-slider-pro' ),
			'default' => 'No products found',
		),
		array(
			'id'      => 'wpspro_enqueue_css_heading',
			'type'    => 'subheading',
			'content' => __( 'Enqueue/Dequeue CSS', 'woo-product-slider-pro' ),
		),
		array(
			'id'         => 'wpsp_font_awesome',
			'type'       => 'switcher',
			'title'      => __( 'FontAwesome CSS', 'woo-product-slider-pro' ),
			'desc'       => __( 'Enqueue/Dequeue FontAwesome for front-end.', 'woo-product-slider-pro' ),
			'wrap_class' => 'wpspro-enqueue-dequue',
			'off_text'   => __( 'Enqueue', 'woo-product-slider-pro' ),
			'on_text'    => __( 'Dequeue', 'woo-product-slider-pro' ),
			'default'    => false,
		),
		array(
			'id'         => 'wpsp_slick_css',
			'type'       => 'switcher',
			'title'      => __( 'Slick CSS', 'woo-product-slider-pro' ),
			'desc'       => __( 'Enqueue/Dequeue Slick CSS.', 'woo-product-slider-pro' ),
			'wrap_class' => 'wpspro-enqueue-dequue',
			'off_text'   => __( 'Enqueue', 'woo-product-slider-pro' ),
			'on_text'    => __( 'Dequeue', 'woo-product-slider-pro' ),
			'default'    => false,
		),
		array(
			'id'         => 'wpsp_magnific_popup_css',
			'type'       => 'switcher',
			'title'      => __( 'Magnific Popup CSS', 'woo-product-slider-pro' ),
			'desc'       => __( 'Enqueue/Dequeue Magnific popup CSS.', 'woo-product-slider-pro' ),
			'wrap_class' => 'wpspro-enqueue-dequue',
			'off_text'   => __( 'Enqueue', 'woo-product-slider-pro' ),
			'on_text'    => __( 'Dequeue', 'woo-product-slider-pro' ),
			'default'    => false,
		),
		array(
			'id'      => 'wpspro_enqueue_js_heading',
			'type'    => 'subheading',
			'content' => __( 'Enqueue/Dequeue JS', 'woo-product-slider-pro' ),
		),
		array(
			'id'         => 'wpsp_slick_js',
			'type'       => 'switcher',
			'title'      => __( 'Slick JS', 'woo-product-slider-pro' ),
			'desc'       => __( 'Enqueue/Dequeue Slick JS.', 'woo-product-slider-pro' ),
			'wrap_class' => 'wpspro-enqueue-dequue',
			'off_text'   => __( 'Enqueue', 'woo-product-slider-pro' ),
			'on_text'    => __( 'Dequeue', 'woo-product-slider-pro' ),
			'default'    => false,
		),
		array(
			'id'         => 'wpsp_magnific_popup_js',
			'type'       => 'switcher',
			'title'      => __( 'Magnific Popup JS', 'woo-product-slider-pro' ),
			'desc'       => __( 'Enqueue/Dequeue Magnific popup JS.', 'woo-product-slider-pro' ),
			'wrap_class' => 'wpspro-enqueue-dequue',
			'off_text'   => __( 'Enqueue', 'woo-product-slider-pro' ),
			'on_text'    => __( 'Dequeue', 'woo-product-slider-pro' ),
			'default'    => false,
		),
	),
);

// ------------------------------
// Upsells Products             -
// ------------------------------
$options[] = array(
	'name'   => 'upsells_products_section',
	'title'  => __( 'Upsells Products', 'woo-product-slider-pro' ),
	'icon'   => 'fa fa-rocket',
	'fields' => array(

		array(
			'id'         => 'wpsp_upsells_products_hide',
			'type'       => 'switcher',
			'title'      => __( 'Default Upsells Products', 'woo-product-slider-pro' ),
			'desc'       => __( 'Show/Hide default upsells products.', 'woo-product-slider-pro' ),
			'wrap_class' => 'wpspro-show-hide',
			'off_text'   => __( 'Show', 'woo-product-slider-pro' ),
			'on_text'    => __( 'Hide', 'woo-product-slider-pro' ),
			'default'    => false,
		),
		array(
			'id'         => 'wpsp_upsells_products_shortcode',
			'type'       => 'select',
			'title'      => __( 'Select Upsells Products Shortcode', 'woo-product-slider-pro' ),
			'desc'       => __( 'Select your generated shortcode to display as the upsells products.', 'woo-product-slider-pro' ),
			'options'    => 'shortcode_list',
			'query_args' => array(
				'post_type'      => 'sp_wpsp_shortcodes',
				'orderby'        => 'post_date',
				'order'          => 'DESC',
				'posts_per_page' => 100,
			),
			'default'    => 'none',
			'class'      => 'chosen',
		),

	),
);

// ------------------------------
// Related Products             -
// ------------------------------
$options[] = array(
	'name'   => 'related_products_section',
	'title'  => __( 'Related Products', 'woo-product-slider-pro' ),
	'icon'   => 'fa fa-share-alt',
	'fields' => array(

		array(
			'id'         => 'wpsp_related_products_hide',
			'type'       => 'switcher',
			'title'      => __( 'Default Related Products', 'woo-product-slider-pro' ),
			'desc'       => __( 'Show/Hide default related products.', 'woo-product-slider-pro' ),
			'wrap_class' => 'wpspro-show-hide',
			'off_text'   => __( 'Show', 'woo-product-slider-pro' ),
			'on_text'    => __( 'Hide', 'woo-product-slider-pro' ),
			'default'    => false,
		),
		array(
			'id'         => 'wpsp_related_products_shortcode',
			'type'       => 'select',
			'title'      => __( 'Select Related Products Shortcode', 'woo-product-slider-pro' ),
			'desc'       => __( 'Select your generated shortcode to display as the related products.', 'woo-product-slider-pro' ),
			'options'    => 'shortcode_list',
			'query_args' => array(
				'post_type'      => 'sp_wpsp_shortcodes',
				'orderby'        => 'post_date',
				'order'          => 'DESC',
				'posts_per_page' => 100,
			),
			'default'    => 'none',
			'class'      => 'chosen',
		),

	),
);

// ------------------------------
// Responsive Settings          -
// ------------------------------
$options[] = array(
	'name'   => 'responsive_settings_section',
	'title'  => __( 'Responsive Settings', 'woo-product-slider-pro' ),
	'icon'   => 'fa fa-tablet',
	'fields' => array(

		array(
			'id'      => 'wpspro_screen_sizes_setting',
			'type'    => 'number_set',
			'title'   => __( 'Maximum Screen Sizes', 'woo-product-slider-pro' ),
			'desc'    => __( 'Set maximum width for different devices in pixels.', 'woo-product-slider-pro' ),
			'default' => array(
				'number1' => '1100',
				'title1'  => __( 'Small Desktop', 'woo-product-slider-pro' ),
				'help1'   => __( 'Default value for small desktop is 1100px.', 'woo-product-slider-pro' ),
				'number2' => '990',
				'title2'  => __( 'Tablet', 'woo-product-slider-pro' ),
				'help2'   => __( 'Default value for tablet is 990px.', 'woo-product-slider-pro' ),
				'number3' => '650',
				'title3'  => __( 'Mobile', 'woo-product-slider-pro' ),
				'help3'   => __( 'Default value for mobile is 650px.', 'woo-product-slider-pro' ),
			),
			'number1' => true,
			'number2' => true,
			'number3' => true,
		),

	),
);

// ------------------------------
// Custom CSS                   -
// ------------------------------
$options[] = array(
	'name'   => 'custom_css_section',
	'title'  => __( 'Custom CSS', 'woo-product-slider-pro' ),
	'icon'   => 'fa fa-css3',
	'fields' => array(

		array(
			'id'    => 'wpsp_custom_css',
			'type'  => 'textarea',
			'title' => __( 'Custom CSS', 'woo-product-slider-pro' ),
			'desc'  => __( 'Type your css.', 'woo-product-slider-pro' ),
		),

	),
);


SP_WPSP_Framework::instance( $settings, $options );
