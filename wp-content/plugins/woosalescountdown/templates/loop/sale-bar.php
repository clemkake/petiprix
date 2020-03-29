<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

global $product;
if ( ! $enabled || woosale_get_product_hide_only_salebar($product) === 'yes' ) {
	return;
}
?>

<span><?php printf( '%s/%s' . __( ' sold', 'woosalescountdown' ), $item['sale'], $item['discount'] ) ?></span>
<div class="ob_discount">
	<div class="ob_sale" style="width:<?php echo esc_attr( $item['per_sale'] ) ?>%"></div>
</div>
