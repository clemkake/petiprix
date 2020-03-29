<?php
if (! defined('ABSPATH')) {
    exit();
}

function woosale_get_product_type( $product ) {
	$product_id = is_object($product)?$product->get_id():$product;
	if(!is_object($product)){
		$product = woosale_get_product($product_id);
	}
	return $product->get_type();
}

function woosale_get_product($product_id){
	return wc_get_product($product_id);
}

function woosale_get_date_on_sale_from( $product ) {
	$product_id = is_object($product)?$product->get_id():$product;
	return intval(get_post_meta( $product_id , '_sale_price_dates_from', true ));
}

function woosale_get_date_on_sale_to( $product ) {
	$product_id = is_object($product)?$product->get_id():$product;
	return intval(get_post_meta( $product_id, '_sale_price_dates_to', true ));
}

function woosale_get_from_time( $product ){
	$product_id = is_object($product)?$product->get_id():$product;
	return get_post_meta( $product_id, '_woosale_from_time', true );
}

function woosale_get_to_time( $product ){
	$product_id = is_object($product)?$product->get_id():$product;
	return get_post_meta( $product_id, '_woosale_to_time', true );
}

function woosale_get_product_id( $product ){
	return $product->get_id();
}

function woosale_get_turn_off_countdown( $product ) {
	$product_id = is_object($product)?$product->get_id():$product;
	return get_post_meta( $product_id, '_turn_off_countdown', true );
}

function woosale_get_product_stock( $product ) {
	if( woosale_is_woo3() ) {
		return $product->get_stock_status();
	} else {
		return $product->stock;
	}
}

function woosale_get_product_manage_stock( $product ){
	if( woosale_is_woo3() ) {
		return $product->get_manage_stock();
	} else {
		return $product->manage_stock;
	}
}

function woosale_get_product_quantity_discount( $product ) {
	$product_id = is_object($product) ? $product->get_id() : $product;
	return get_post_meta( $product_id, '_quantity_discount', true );
}

function woosale_get_product_quantity_sale($product) {
	$product_id = is_object($product)?$product->get_id():$product;
	return get_post_meta( $product_id, '_quantity_sale', true );
}


function woosale_get_wcml_duplicate_of_variation($product){
	return get_post_meta( $product->get_id(), '_wcml_duplicate_of_variation', true );
}

function woosale_get_product_hide_only_salebar($product){
	return get_post_meta( $product->get_id(), '_hide_only_salebar', true );
}

function woosale_get_product_hide_only_countdown($product){
	return get_post_meta( $product->get_id(), '_hide_only_countdown', true );
}

if ( !function_exists('woosale_is_woo3') ) {
	function woosale_is_woo3(){
		global $woocommerce;
		if ( !$woocommerce || version_compare( $woocommerce->version, '3.0.0', '>=' ) ) {
			return true;
		} else {
			return false;
		}
	}
}
# - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - #
if ( !function_exists( 'woosale_format_date_time' ) ) {

	function woosale_format_date_time ($time = '')
	{
		if (! $time) {
			$time = current_time('timestamp');
		}
		if (! is_numeric($time)) {
			$time = strtotime($time);
		}
		
		$format = get_option('date_format', 'Y-m-d') . ' ' .
				 get_option('time_format', 'H:i:s');
		return apply_filters('woosale_format_date_time',
				date_i18n($format, $time), $format, $time);
	}

}

if ( !function_exists( 'woosale_single_is_enabled' ) ) {

    function woosale_single_is_enabled() {
        $check_showon = get_option( 'ob_single_enable', 1 );
        return $check_showon == 1;
    }

}

if ( !function_exists( 'woosale_categories_is_enabled' ) ) {

    function woosale_categories_is_enabled() {
        $check_showon = get_option( 'ob_categories_enable', 1 );
        return $check_showon == 1;
    }

}

add_action( 'the_post', 'woosales_setup_product', 999 );
if ( !function_exists( 'woosales_setup_product' ) ) {

	function woosales_setup_product() {
		global $product, $post;
		$current_time = strtotime( current_time( 'mysql', true ) );
		$is_woo3 = woosale_is_woo3();
		if ( $post->post_type !== 'product' || ! $product ) {
			return;
		}
		if ( $product->get_type() === 'variable' ) {
			$variations = $product->get_available_variations();
			$product->woosale_start = array();
			$product->woosale_end = array();
			foreach ( $variations as $variable ) {
				$id = $variable['variation_id'];
				$variable = woosale_get_product( $id ); // $product->get_child( $id );
				$date_start = woosale_get_date_on_sale_from( $variable ); // $variable->sale_price_dates_from;
				$time_start = woosale_get_from_time( $variable ); // $variable->woosale_from_time;
				$date_end = woosale_get_date_on_sale_to( $variable ); // $variable->sale_price_dates_to;
				$time_end = woosale_get_to_time( $variable );//$variable->woosale_to_time;
				$args = array(
						'date_start' => $date_start,
						'time_start' => $time_start,
						'date_end' => $date_end,
						'time_end' => $time_end
				);
				$woosale_start = $woosale_end = '';
				if ( $date_start ) {
					$woosale_start = $date_start;
					if ( $time_start ) {
						$woosale_start = woosales_add_specified_time( $woosale_start, $time_start );
					}
				}
				$woosale_start = apply_filters( 'woosales_setup_product_woosale_start', $woosale_start, $product, $args );
				$product->woosale_start[$id] = $woosale_start;
					/* end */
				if ( $date_end ) {
					$woosale_end = $date_end;
					if ( $time_end ) {
						$woosale_end = woosales_add_specified_time( $woosale_end, $time_end );
					}
				}
				$woosale_end = apply_filters( 'woosales_setup_product_woosale_end', $woosale_end, $product, $args );
				$product->woosale_end[$id] = $woosale_end;
			}
		} else {
			$date_start = woosale_get_date_on_sale_from( $product );
			$time_start = woosale_get_from_time( $product );
			$date_end = woosale_get_date_on_sale_to( $product );
			$time_end = woosale_get_to_time( $product );
			$product->woosale_start = $product->woosale_end = null;
			$args = array(
					'current_time' => current_time('Y-m-d H:i:s', true),
					'date_start' => $date_start,
					'time_start' => $time_start,
					'date_end' => $date_end,
					'time_end' => $time_end
			);
			$woosale_start = $woosale_end = '';
			if ( $date_start ) {
				$woosale_start = $date_start;
				if ( $time_start ) {
					$woosale_start = woosales_add_specified_time( $woosale_start, $time_start );
				}
			}
			$woosale_start = apply_filters( 'woosales_setup_product_woosale_start', $woosale_start, $product, $args );
			$product->woosale_start = $woosale_start;
			/* end */
			if ( $date_end ) {
				$woosale_end = $date_end;
				if ( $time_end ) {
					$woosale_end = woosales_add_specified_time( $woosale_end, $time_end ); 
				}
			}
			$woosale_end = apply_filters( 'woosales_setup_product_woosale_end', $woosale_end, $product, $args );
			$product->woosale_end = $woosale_end;
		}
	}

}

if ( !function_exists( 'woosales_has_countdown' ) ) {

    function woosales_has_countdown( $id = null ) {
        if ( !$id ) {
            $id = get_the_ID();
        }
        if ( !$id ) {
            return false;
        }
        $product = wc_get_product( $id );

        /* turn off countdown */
        $_turn_off_countdown = woosale_get_turn_off_countdown( $product );
        if ( $_turn_off_countdown ) {
            return;
        }
		
        $results = array();
        if ( $product->get_type() === 'variable' ) {
            $_product_variables = $product->get_available_variations();
            $current_time = current_time( 'timestamp', true );
            foreach ( $_product_variables as $variable ) {
                $variable = woosale_get_product($variable['variation_id']);//$product->get_child( $variable['variation_id'] );
                $date_from = woosale_get_date_on_sale_from( $variable );//$variable->sale_price_dates_from;
                $date_end = woosale_get_date_on_sale_to( $variable );//$variable->sale_price_dates_to;
                $_woosale_from_time = woosale_get_from_time( $variable );//$variable->woosale_from_time;
                $_woosale_to_time = woosale_get_to_time( $variable );//$variable->woosale_to_time;
                
                if ( $date_from && $_woosale_from_time != '' ) {
                    $date_from = woosales_add_specified_time( $date_from, $_woosale_from_time );
                }
                if ( $date_end && $_woosale_to_time != '' ) {
                    $date_end = woosales_add_specified_time( $date_end, $_woosale_to_time );
                }

                if ( $current_time >= $date_end ) {
                    continue;
                }
                $results = array( 'from' => $date_from, 'to' => $date_end );
                break;
            }
        } else {
            $date_from 	=  woosale_get_date_on_sale_from( $product );//$product->sale_price_dates_from;
            $date_to 	= woosale_get_date_on_sale_to( $product );//$product->sale_price_dates_to;
            if ( $date_from ) {
                $time_from = woosale_get_from_time( $product );//$product->woosale_from_time;
                if ( $time_from != '' ) {
                    $date_from = woosales_add_specified_time( $date_from, $time_from );
                }
            }
            if ( $date_to ) {
                $time_to = woosale_get_to_time( $product );//$product->woosale_to_time;
                if ( $time_to != '' ) {
                    $date_to = woosales_add_specified_time( $date_to, $time_to );
                }
            }

            $results = array( 'from' => $date_from, 'to' => $date_to );
        }
        return $results;
    }

}

if ( !function_exists( 'woosales_add_specified_time' ) ) {

	function woosales_add_specified_time( $date = '', $time = '' ) {
		if ( ! $date ) {
			$date = current_time( 'timestamp', true );
		}
		if ( is_string( $date ) ) {
			$date = strtotime( $date );
		}
		$timestamp = $date;
		if ( $time ) {
			$time_timestamp = strtotime( $time, 0 );
			$timestamp += $time_timestamp;
		}
		return $timestamp;
	}

}

if ( !function_exists( 'woosales_setup_product_countdown' ) ) {

    function woosales_setup_product_countdown( $single = true ) {
        global $product;
        $product_id 		= woosale_get_product_id( $product );
        $turn_off_countdown = woosale_get_turn_off_countdown( $product );
        $products 			= array();

        if ( !$product_id || $turn_off_countdown ) {
            return $products;
        }

        $hide_datetext = $single ? get_option( 'ob_single_datetext_show', 1 ) : get_option( 'ob_categories_datetext_show', 1 );
        $hide_datetext = $hide_datetext == 0;
        $current_time = current_time( 'timestamp', true );

        if ( woosale_get_product_type($product) === 'variable' ) {
            $total_discount = $total_sold = 0;
            foreach ( $product->get_available_variations() as $variable ) {
                $product_variation = woosale_get_product( $variable['variation_id'] ); //$product->get_child( $variable['variation_id'] );
                if ( $wpml_id = woosale_get_wcml_duplicate_of_variation($product_variation)){;//$product_variation->wcml_duplicate_of_variation ) {
                    $product_variation = wc_get_product( $wpml_id );
                }

                $time_from = isset( $product->woosale_start[$variable['variation_id']] ) ? $product->woosale_start[$variable['variation_id']] : null;
                $time_end = isset( $product->woosale_end[$variable['variation_id']] ) ? $product->woosale_end[$variable['variation_id']] : null;
                $discount = woosale_get_product_quantity_discount($product_variation);//$product_variation->quantity_discount;
                $sale = woosale_get_product_quantity_sale($product_variation);//absint( $product_variation->quantity_sale );
                $stock = woosale_get_product_stock($product_variation);//$product_variation->stock;
                $_manage_stock = woosale_get_product_manage_stock($product_variation);//$product_variation->manage_stock;

                if ( $_manage_stock ) {
                    if ( trim( $_manage_stock ) == 'yes' ) {
                        if ( $stock < 1 ) {
                            $discount = 0;
                        }
                    }
                }

                if ( !$sale ) {
                    $sale = 0;
                }

                if ( (!$time_from && !$time_end ) || ( $time_from && !$time_end && $time_from < $current_time ) || ( $time_end && !$time_from && $time_end < $current_time ) ) {
                    continue;
                }

                $per_sale = 0;
                if ( $discount > 0 && $sale <= $discount ) {
                    $per_sale = absint( $sale / $discount * 100 );
                }

                $total_discount += absint( $discount );
                $total_sold += absint( $sale );

                $products[] = array(
                    'hide_datetext' => $hide_datetext ? 0 : 1,
                    'current_time' => $current_time,
                    'woosale_start' => $time_from,
                    'woosale_end' => $time_end,
                    'hide_coming' => ( $current_time < $time_from ) && get_option( 'ob_coming_schedule', 'yes' ) !== 'yes',
                    'sale' => $sale,
                    'discount' => $discount,
                    'per_sale' => $per_sale,
                    'is_variation' => true,
                    'variation_id' => $variable['variation_id']
                );
            }

            if ( get_option( 'ob_bar_sale_variations', 0 ) ) {
                $per_sale = 0;
                if ( $total_sold < $total_discount ) {
                    $per_sale = absint( $total_sold / $total_discount * 100 );
                }
                foreach ( $products as $k => $product_k ) {
                    $products[$k]['discount'] = $total_discount;
                    $products[$k]['sale'] = $total_sold;
                    $products[$k]['per_sale'] = $per_sale;
                }
            }
            if ( !$single ) {
                return $products;
            }
        } else {
            $time_from 	= $product->woosale_start;
            $time_end 	= $product->woosale_end;
            $discount 	= woosale_get_product_quantity_discount($product);//$product->quantity_discount);
            $sale 		= woosale_get_product_quantity_sale($product);//absint( $product->quantity_sale );
            $stock 		= woosale_get_product_stock($product);//$product->stock;
            $_manage_stock = woosale_get_product_manage_stock($product);//$product->manage_stock;
            if ( $_manage_stock ) {
                if ( trim( $_manage_stock ) == 'yes' ) {
                    if ( $stock < 1 ) {
                        $discount = 0;
                    }
                }
            }

            if ( !$sale ) {
                $sale = 0;
            }

            if ( (!$time_from && !$time_end ) || ( $time_from && !$time_end && $time_from < $current_time ) || ( $time_end && !$time_from && $time_end < $current_time ) ) {
                return $products;
            }

            $per_sale = 0;
            if ( $discount > 0 && $sale <= $discount ) {
                $per_sale = absint( $sale / $discount * 100 );
            }

            $products[] = array(
                'hide_datetext' => $hide_datetext ? 0 : 1,
                'current_time' => $current_time,
                'woosale_start' => $time_from,
                'woosale_end' => $time_end,
                'hide_coming' => ( $current_time < $time_from ) && get_option( 'ob_coming_schedule', 'yes' ) !== 'yes',
                'sale' => $sale,
                'discount' => $discount,
                'per_sale' => $per_sale,
                'is_variation' => false,
                'variation_id' => false
            );
        }
        return apply_filters( 'woosales_setup_product_countdown', $products );
    }

}

if ( !function_exists( 'woosales_elements_display' ) ) {

    function woosales_elements_display( $sort = array() ) {
        $elements = $default = apply_filters( 'woosales_elements_display', array(
            'title' => array(
                'sort' => '',
                'name' => __( 'Title', 'woosalescountdown' ),
                'desc' => __( 'Status of countdown. Eg: Coming or Sale.', 'woosalescountdown' ),
                'id' => 'title',
                'status' => '',
                'callback' => 'woosales_display_title'
            ),
            'schedule' => array(
                'sort' => '',
                'name' => __( 'Schedule', 'woosalescountdown' ),
                'desc' => __( 'Schedule time start to time end.', 'woosalescountdown' ),
                'id' => 'schedule',
                'status' => '',
                'callback' => 'woosales_display_schedule'
            ),
            'sale-bar' => array(
                'sort' => '',
                'name' => __( 'Sale Bar', 'woosalescountdown' ),
                'desc' => __( 'Quantity sold and quantity discount.', 'woosalescountdown' ),
                'id' => 'salebar',
                'status' => '',
                'callback' => 'woosales_display_sale_bar'
            ),
            'countdown' => array(
                'sort' => '',
                'name' => __( 'Countdown', 'woosalescountdown' ),
                'desc' => __( 'Countdown.', 'woosalescountdown' ),
                'id' => 'countdown',
                'status' => '',
                'callback' => 'woosales_display_countdown'
            ),
                ) );

        if ( $sort ) {
            $elements = array();
            foreach ( $sort as $s ) {
                if ( array_key_exists( $s, $default ) ) {
                    $elements[$s] = $default[$s];
                }
            }
        }
        return $elements;
    }

}

if ( !function_exists( 'woosales_elements_display_sortable' ) ) {

    function woosales_elements_display_sortable( $option_name = '' ) {
        $options = get_option( $option_name, array( 'sort' => array(), 'enabled' => array(
                'title' => 'on', 'schedule' => 'on', 'sale-bar' => 'on', 'countdown' => 'on'
            ) ) );
        $enabled = isset( $options['enabled'] ) ? $options['enabled'] : array();
        ?>
        <tr valign="top">
            <th scope="row" class="titledesc"><?php _e( 'CountDown Element Display Order', 'woosalescountdown' ) ?></th>
            <td class="forminp">
                <table class="wc_gateways woosales_table widefat" cellspacing="0">
                    <thead>
                        <tr>
                            <?php
                            $columns = apply_filters( 'woosalescountdown_element_order_columns', array(
                                'sort' => '',
                                'name' => __( 'Element', 'woocommerce' ),
                                'desc' => __( 'Description', 'woocommerce' ),
                                'status' => __( 'Enabled', 'woocommerce' )
                                    ) );

                            foreach ( $columns as $key => $column ) {
                                echo '<th class="' . esc_attr( $key ) . '">' . esc_html( $column ) . '</th>';
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ( woosales_elements_display( $options['sort'] ) as $id => $section ) {

                            echo '<tr>';

                            foreach ( $section as $key => $column ) {
                                switch ( $key ) {

                                    case 'sort' :
                                        echo '<td width="1%" class="sort">
											<input type="hidden" name="' . esc_attr( $option_name ) . '[sort][]" value="' . esc_attr( $id ) . '" />
										</td>';
                                        break;

                                    case 'name' :
                                        echo '<td class="name">' . esc_html( $column ) . '</td>';
                                        break;

                                    case 'desc' :
                                        echo '<td class="desc"><p class="desc">' . esc_html( $column ) . '</p></td>';
                                        break;

                                    case 'status' :
                                        echo '<td class="status">
										<label>
											<input type="checkbox" name="' . esc_attr( $option_name ) . '[enabled][' . esc_attr( $id ) . ']" class="checkbox" ' . ( array_key_exists( $id, $enabled ) ? ' checked' : '' ) . ' />
											<div class="woosales_switch ' . ( array_key_exists( $id, $enabled ) ? ' on' : '' ) . '"></div>
										</label>
										</td>';
                                        break;

                                    default :
                                        do_action( 'woocommerce_payment_gateways_setting_column_' . $key, $section );
                                        break;
                                }
                            }

                            echo '</tr>';
                        }
                        ?>
                    </tbody>
                </table>
            </td>
        </tr>
        <?php
    }

}

if ( !function_exists( 'woosalescountdown_add_schedule' ) ) {
    /* add schedule update product */
    function woosalescountdown_add_schedule( $product_id = null ) {
        if ( !$product_id ) {
            return;
        }
        $product	= wc_get_product( $product_id );
        $start_time = woosales_add_specified_time( woosale_get_date_on_sale_from($product), woosale_get_from_time($product) );
        $end_time	= woosales_add_specified_time( woosale_get_date_on_sale_to($product), woosale_get_to_time($product) );
        /* add schedule function */
        wp_clear_scheduled_hook( 'woosalescountdown_schedule_update_quantity_product', array( $product_id, $start_time, $end_time ) );
        wp_schedule_single_event( $end_time, 'woosalescountdown_schedule_update_quantity_product', array( $product_id, $start_time, $end_time ) );
        do_action( 'woosalescountdown_add_schedule', $product_id );
    }

}

add_action( 'woosalescountdown_schedule_update_quantity_product', 'woosalecountdown_update_schedule_product', 10, 3 );
if ( !function_exists( 'woosalecountdown_update_schedule_product' ) ) {
    /* schedule action */
    function woosalecountdown_update_schedule_product( $product_id = null, $start_time = '', $end_time = '' ) {
        $status = get_option( 'ob_hide_product', 0 );
        if ( !$product_id || !$end_time ) {
            return;
        }

        $product		= wc_get_product( $product_id );
        $start_time		= woosales_add_specified_time( woosale_get_date_on_sale_from($product), woosale_get_from_time($product) );
        $end_time		= woosales_add_specified_time( woosale_get_date_on_sale_to($product), woosale_get_to_time($product) );
        $current_time	= current_time( 'timestamp' );

        /* update status */
        if ( $status ) {
            wp_update_post( array( 'ID' => $product_id, 'post_status' => $status ) );
        }

//        $remove_sale_price = get_option( 'ob_remove_sale_price', 0 );
        /* remove sale price */
//        if ( $remove_sale_price ) {
//            update_post_meta( $product_id, '_sale_price', '' );
//            update_post_meta( $product_id, '_sale_price_dates_from', '' );
//            update_post_meta( $product_id, '_sale_price_dates_to', '' );
//            update_post_meta( $product_id, '_woosale_from_time', '' );
//            update_post_meta( $product_id, '_woosale_to_time', '' );
//        }
    }

}

add_action( 'woosalescountdown_before_widget_sale_product', 'woosales_widget_hook_remove_element', 10, 2 );
if ( !function_exists( 'woosales_widget_hook_remove_element' ) ) {

    function woosales_widget_hook_remove_element( $args, $instance ) {
        $GLOBALS['woosales_widget_instance'] = $instance;
        if ( isset( $instance['show_link'] ) && !$instance['show_link'] ) {
            remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
            remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
        }
        if ( isset( $instance['show_title'] ) && !$instance['show_title'] ) {
            remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
        }
        if ( isset( $instance['show_rating'] ) && !$instance['show_rating'] ) {
            remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
        }
        if ( isset( $instance['show_price'] ) && !$instance['show_price'] ) {
            remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
        }
        if ( isset( $instance['show_image'] ) && !$instance['show_image'] ) {
            remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
        }
        if ( isset( $instance['show_image'], $instance['product_image'] ) && $instance['show_image'] ) {
            remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
            do_action( 'woosalescountdown_widget_image_size', $instance );
        }
        if ( isset( $instance['show_button'] ) && !$instance['show_button'] ) {
            remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
        }
    }
}

add_action( 'woosalescountdown_after_widget_sale_product', 'woosales_widget_hook_add_element', 10, 2 );
if ( !function_exists( 'woosales_widget_hook_add_element' ) ) {

    function woosales_widget_hook_add_element( $args, $instance ) {
        global $woosales_widget_instance;
        $woosales_widget_instance = null;
        if ( isset( $instance['show_link'] ) && !$instance['show_link'] ) {
            add_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
            add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
        }
        if ( isset( $instance['show_title'] ) && !$instance['show_title'] ) {
            add_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
        }
        if ( isset( $instance['show_rating'] ) && !$instance['show_rating'] ) {
            add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
        }
        if ( isset( $instance['show_price'] ) && !$instance['show_price'] ) {
            add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
        }
        if ( isset( $instance['product_image'] ) ) {
            remove_action( 'woosalescountdown_widget_image_size', 'woosales_widget_image_size', 10 );
        }
        if ( isset( $instance['show_image'] ) && !$instance['show_image'] ) {
            add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
        }
        if ( isset( $instance['show_button'] ) && !$instance['show_button'] ) {
            add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
        }
    }

}

add_action( 'woosalescountdown_widget_image_size', 'woosales_widget_image_size', 10 );
if ( !function_exists( 'woosales_widget_image_size' ) ) {

    function woosales_widget_image_size( $instance ) {
        if ( isset( $instance['product_image'] ) ) {
            add_action( 'woocommerce_before_shop_loop_item_title', 'woosale_template_loop_product_thumbnail', 10 );
        }
    }

}

function woosale_template_loop_product_thumbnail() {
	global $woosales_widget_instance;
	if ( isset( $woosales_widget_instance['product_image'] ) ) {
		echo woocommerce_get_product_thumbnail( $woosales_widget_instance['product_image'] );
	}
}

if ( ! function_exists( 'woosales_get_timezone_string' ) ) {

	function woosales_get_timezone_string() {
		$tzstring = get_option( 'timezone_string' );
		$gmt_offset = get_option( 'gmt_offset' );
		if ( ! $tzstring ) {
			$timezones = timezone_identifiers_list();
			foreach ( $timezones as $key => $zone ) {
				$origin_dtz = new DateTimeZone( $zone );
				$origin_dt = new DateTime( 'now', $origin_dtz );
				$offset = $origin_dtz->getOffset( $origin_dt ) / 3600;
				if ( $offset == $gmt_offset ) {
					$tzstring = $zone;
				}
			}
		}
		return $tzstring;
	}
}


if( !function_exists( 'woosales_woocommerce_product_is_on_sale' ) ) {
	function woosales_woocommerce_product_is_on_sale( $on_sale, $product = null ) {
		$product_type = $product->get_type();
		if( $product_type == 'variable' ) {
			$_product_variables = $product->get_available_variations();
			$current_time = current_time( 'timestamp', true );
			foreach ( $_product_variables as $variable ) {
				$variable = woosale_get_product($variable['variation_id']);//$product->get_child( $variable['variation_id'] );
				$date_from = woosale_get_date_on_sale_from( $variable );//$variable->sale_price_dates_from;
				$date_end = woosale_get_date_on_sale_to( $variable );//$variable->sale_price_dates_to;
				$_woosale_from_time = woosale_get_from_time( $variable );//$variable->woosale_from_time;
				$_woosale_to_time = woosale_get_to_time( $variable );//$variable->woosale_to_time;
				
				if ( $date_from && $_woosale_from_time != '' ) {
					$date_from = woosales_add_specified_time( $date_from, $_woosale_from_time );
				}
				if ( $date_end && $_woosale_to_time != '' ) {
					$date_end = woosales_add_specified_time( $date_end, $_woosale_to_time );
				}
				
				if ( $current_time >= $date_end ) {
					continue;
				}
				$on_sale = true;
				break;
			}
			return $on_sale;
		}

		$_woosale_from_time		= woosale_get_from_time( $product );
		$_woosale_to_time		= woosale_get_to_time( $product );
		$_sale_price_dates_from = woosale_get_date_on_sale_from( $product );
		$_sale_price_dates_to	= woosale_get_date_on_sale_to( $product );

		$sale_price		= $product->get_sale_price();
		$regular_price	= $product->get_regular_price();
		if( !woosale_is_woo3() ) {
			$on_sale = $regular_price > $sale_price;
		}
		if( !$_sale_price_dates_from && !$_sale_price_dates_to ) {
			return $on_sale;
		}

		$time_from 	= woosales_add_specified_time( $_sale_price_dates_from, $_woosale_from_time );
		$time_to 	= woosales_add_specified_time( $_sale_price_dates_to, $_woosale_to_time );

		$now = current_time( 'timestamp', true );
		if( $now < $time_from || $now > $time_to ) {
			$on_sale = false;
		}  elseif( $now >= $time_from && $now < $time_to ) {
			$on_sale = true;
		}
		return $on_sale;
	}
}


function wscd_filter_woocommerce_product_get_price( $price, $product, $x = null, $y = NULL ) {
	$product_type = woosale_get_product_type( $product );
	$is_on_sale = woosales_woocommerce_product_is_on_sale( false, $product );
	if ( ! $is_on_sale ) {
		return $price;
	}
	if ( 'variable' === $product_type ) {
		return $price;
	} elseif ( 'variation' === $product_type ) {
		if ( $is_on_sale ) {
			$price = $product->get_sale_price();
		} else {
			$price = $product->get_regular_price();
		}
		return $price;
	}
	if ( $is_on_sale ) {
		$price = $product->get_sale_price();
	} else {
		$price = $product->get_regular_price();
	}
	return $price;
}

// woocommerce_variation_prices_price
function wscd_filter_callback_woocommerce_variation_prices_price( $price, $variation, $product ) {
	$is_sale = woosales_woocommerce_product_is_on_sale(false, $variation);
	if( $is_sale ) {
		$price = $variation->get_sale_price();
	}
	return $price;
}


// add_filter('woocommerce_product_variation_get_date_on_sale_to', 'wscd_filter_callback_woocommerce_product_variation_get_date_on_sale_to', 10, 2);
// add_filter('woocommerce_product_get_date_on_sale_to', 'wscd_filter_callback_woocommerce_product_variation_get_date_on_sale_to', 10, 2);
function wscd_filter_callback_woocommerce_product_variation_get_date_on_sale_to( $value, $product ) {
	if( is_object( $value ) && isset($value->date) && !is_admin()) {
		$to_time 	= woosale_get_to_time( $product );
		if($to_time){
			$date_str 		= date( 'Y-m-d H:i:s', woosales_add_specified_time( $value->date, $to_time ) );
			$value->date 	= $date_str;
		}
	}
	return $value;
}

// add_filter('woocommerce_product_variation_get_date_on_sale_from', 'wscd_filter_callback_woocommerce_product_variation_get_date_on_sale_from', 10, 2);
// add_filter('woocommerce_product_get_date_on_sale_from', 'wscd_filter_callback_woocommerce_product_variation_get_date_on_sale_from', 10, 2);
function wscd_filter_callback_woocommerce_product_variation_get_date_on_sale_from( $value, $product ) {
	if( is_object( $value ) && isset($value->date) && !is_admin()) {
		$from_time 	= woosale_get_from_time( $product );
		if($from_time){
			$date_str 		= date( 'Y-m-d H:i:s', woosales_add_specified_time( $value->date, $from_time ));
			$value->date 	= $date_str;
		}
	}
	return $value;
}


add_action( 'updated_postmeta', 'wscd_filter_callback_updated_postmeta', 10, 4 );
function wscd_filter_callback_updated_postmeta( $meta_id, $object_id, $meta_key, $meta_value ) {
	$post_type = get_post_type( $object_id );
	if( 'product' == $post_type && $meta_key == '_quantity_sale' ) {
		$languages = apply_filters( 'wpml_active_languages',array());
		$current_language= apply_filters( 'wpml_current_language', NULL );
		if( !empty($languages) ) {
			foreach ( $languages as $key=>$lang ) {
				$post_id = apply_filters( 'wpml_object_id', $object_id, 'post', true, $key );
				if( $post_id ){
					$value = get_post_meta($post_id, $meta_key, true);
					if( $meta_value != $value ) {
						update_post_meta($post_id, $meta_key, $meta_value);
					}
				}
			}
		}
	}
}