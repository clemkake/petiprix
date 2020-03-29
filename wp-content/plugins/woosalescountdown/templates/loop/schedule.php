<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}

if ( ! $enabled ) { return; }

?>

<h5 class="schedule_text"><?php printf( '%s', woosale_format_date_time( $item['woosale_start'] ) . __( ' to ', 'woosalescountdown' ) . woosale_format_date_time( $item['woosale_end'] ) ) ?></h5>