<?php
if ( $sale_ribbon == 'true' ) {
	if ( $product->is_on_sale() ) {
		$outline .= '<div class="sale_text" title="' . $sale_ribbon_text . '">' . $sale_ribbon_text . '</div>';
	}
}
