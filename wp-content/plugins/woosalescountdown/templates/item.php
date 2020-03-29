<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

global $woosalescountdown;

?>

<div class="<?php echo join( ' ', $classes ); ?>">
	<?php foreach ( $products as $product ) : ?>
		<?php $woosalescountdown->get_template( 'loop/loop.php', array( 'product' => $product, 'options' => $options ) ) ?>
	<?php endforeach; ?>
</div>
