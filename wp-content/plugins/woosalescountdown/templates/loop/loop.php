<?php
if ( !defined( 'ABSPATH' ) ) {
    exit();
}

if ( $product['hide_coming'] ) {
    return;
}

global $woosalescountdown;

$class = '';
if ( $product['is_variation'] && $product['variation_id'] ) {
    $class = ' ob_product_avariable_detail ob_product_detail_' . $product['variation_id'];
}
?>

<div class="ob_wrapper ob_product_detail<?php echo esc_attr( $class ) ?>">

    <?php
    do_action( 'woosalescountdown_before_render_loop_product' );
    if ( isset( $options['sort'], $options['enabled'] ) ) {
        foreach ( $options['sort'] as $element ) {
            $enabled = array_key_exists( $element, $options['enabled'] ) && $options['enabled'][$element] == 'on';
            /* before */
            do_action( 'woosalescountdown_before_product_element', $element, $product, $enabled );
            $woosalescountdown->get_template( 'loop/' . $element . '.php', array( 'item' => $product, 'enabled' => $enabled ) );
            /* after */
            do_action( 'woosalescountdown_after_product_element', $element, $product, $enabled );
        }
    }
    do_action( 'woosalescountdown_after_render_loop_product' );
    ?>

</div>
