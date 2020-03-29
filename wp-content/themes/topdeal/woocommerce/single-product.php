<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<?php get_template_part('header'); ?>

<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
	<?php topdeal_breadcrumb_title(); ?>
<?php endif; ?>

<?php 
	$topdeal_single_style = topdeal_options()->getCpanelValue( 'product_single_style' );
	if( empty( $topdeal_single_style ) || $topdeal_single_style == 'default' ){ 
		get_template_part( 'woocommerce/content-single-product' );
	}
	else{
		get_template_part( 'woocommerce/content-single-product-' . $topdeal_single_style );
	}
?>

<?php get_template_part('footer'); ?>
