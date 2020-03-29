<?php
/**
 * This is to plugin help page.
 *
 * @package woo-product-slider-pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

class WPSPRO_Help {

	private static $_instance;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'help_page' ), 100 );
	}

	public static function getInstance() {
		if ( ! self::$_instance ) {
			self::$_instance = new WPSPRO_Help();
		}

		return self::$_instance;
	}

	/**
	 * Add SubMenu Page
	 */
	function help_page() {
		add_submenu_page( 'edit.php?post_type=sp_wpsp_shortcodes', __( 'Product Slider Pro for WooCommerce Help', 'woo-product-slider-pro' ), __( 'Help', 'woo-product-slider-pro' ), 'manage_options', 'wpspro_help', array( $this, 'help_page_callback' ) );
	}

	/**
	 * Help Page Callback
	 */
	public function help_page_callback() {
		?>
		<div class="wrap about-wrap sp-wpsp-help">
			<h1><?php _e( 'Welcome to Product Slider Pro for WooCommerce!', 'woo-product-slider-pro' ); ?></h1>
			<p class="about-text">
			<?php
			_e( 'Thank you for installing Product Slider Pro for WooCommerce! You\'re now running the most popular WooCommerce Product Slider Premium plugin. This video playlist will help you get started with the plugin.', 'woo-product-slider-pro' );
			?>
				</p>
			<div class="wp-badge"></div>

			<hr>

			<div class="headline-feature feature-video">
				<iframe width="560" height="315" src="https://www.youtube.com/embed/flyRCb5lTcI?list=PLoUb-7uG-5jNQ086fi9a6yWzYfCpcmnJ3" frameborder="0" allowfullscreen></iframe>
			</div>

			<hr>

			<div class="feature-section three-col">
				<div class="col">
					<div class="sp-wpsp-feature sp-wpsp-text-center">
						<i class="sp-font fa fa-life-ring"></i>
						<h3>Need any Assistance?</h3>
						<p>Our Expert Support Team is always ready to help you out promptly.</p>
						<a href="https://shapedplugin.com/support/" target="_blank" class="button button-primary">Contact Support</a>
					</div>
				</div>
				<div class="col">
					<div class="sp-wpsp-feature sp-wpsp-text-center">
						<i class="sp-font fa fa-file-text" aria-hidden="true"></i>
						<h3>Looking for Documentation?</h3>
						<p>We have detailed documentation on every aspects of Product Slider Pro.</p>
						<a href="https://shapedplugin.com/docs/woocommerce-product-slider-pro/" target="_blank" class="button
					button-primary">Documentation</a>
					</div>
				</div>
				<div class="col">
					<div class="sp-wpsp-feature sp-wpsp-text-center">
						<i class="sp-font fa fa-thumbs-up" aria-hidden="true"></i>
						<h3>Like This Plugin?</h3>
						<p>If you like Product Slider Pro, please leave us a 5 star rating.</p>
						<a href="https://shapedplugin.com/plugin/woocommerce-product-slider-pro/#reviews" target="_blank" class="button button-primary">Rate the Plugin</a>
					</div>
				</div>
			</div>

			<hr>

			<div class="plugin-section">
				<div class="sp-plugin-section-title">
					<h2>Take your website beyond the typical with more premium plugins!</h2>
					<h4>Some more premium plugins are ready to make your website awesome.</h4>
				</div>
				<div class="three-col">
					<div class="col">
						<div class="sp-wpsp-plugin">
							<img src="https://shapedplugin.com/wp-content/uploads/edd/2019/08/WooCommerce-Category-Slider-360x210.png" alt="Category Slider Pro for WooCommerce">
							<div class="sp-wpsp-plugin-content">
								<h3>Category Slider Pro for WooCommerce</h3>
								<p>Category Slider Pro for WooCommerce offers you to showcase your WooCommerce products categories aesthetically.</p>
								<a href="https://shapedplugin.com/plugin/woocommerce-category-slider-pro/" class="button">View Details</a>
							</div>
						</div>
					</div>

					<div class="col">
						<div class="sp-wpsp-plugin">
							<img src="https://shapedplugin.com/wp-content/uploads/edd/2019/02/woocommerce-quick-view-pro-360x210.png" alt="Quick View Pro for WooCommerce">
							<div class="sp-wpsp-plugin-content">
								<h3>Quick View Pro for WooCommerce</h3>
								<p>Quick View Pro for WooCommerce allows your customers to quickly view product information in nice Popup without opening the product page.</p>
								<a href="https://shapedplugin.com/plugin/woocommerce-quick-view-pro/" class="button">View Details</a>
							</div>
						</div>
					</div>

					<div class="col">
						<div class="sp-wpsp-plugin">
							<img src="https://shapedplugin.com/wp-content/uploads/edd/2019/08/wp-team-pro-360x210.jpg" alt="WP Team Pro">
							<div class="sp-wpsp-plugin-content">
								<h3>WP Team Pro</h3>
								<p>The most versatile and industry leading WordPress team showcase plugin built to create and manage team members showcases with excellent design and multiple options.</p>
								<a href="https://shapedplugin.com/plugin/wp-team-pro/" class="button">View Details</a>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
		<?php
	}

}
