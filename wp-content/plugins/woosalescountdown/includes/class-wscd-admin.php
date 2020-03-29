<?php
/**
 * Admin setting class
 *
 * @author  Andy ha
 * @package wpbriz.com
 */
if ( !class_exists( 'WSCD_Admin' ) ) {

    /**
     * Admin class.
     * The class manage all the admin behaviors.
     *
     * @since 1.0.0
     */
    class WSCD_Admin {

        public function __construct() {
            /* setting */
            add_filter( 'woocommerce_get_settings_pages', array( __CLASS__, 'add_settings_page' ) );
            add_action( 'woocommerce_update_options_wscd', array( $this, 'save_setting' ) );
            /* product and order */
            // add_action( 'woocommerce_order_items_table', array( $this, 'woo_update_sale' ) );
            /* simple product */
            add_action( 'woocommerce_product_options_general_product_data', array( $this, 'woo_add_custom_general_fields' ) );
            add_action( 'woocommerce_process_product_meta', array( $this, 'woo_add_custom_general_fields_save' ) );

            /* variable product */
            add_action( 'woocommerce_product_after_variable_attributes', array( $this, 'woo_add_custom_product_variable' ), 10, 3 );
            add_action( 'woocommerce_save_product_variation', array( $this, 'woo_add_custom_product_variable_save' ), 10, 2 );
			add_action( 'woocommerce_bulk_edit_variations', array( $this, 'woocommerce_bulk_edit_variations_callback'), 10, 4);

            /* sync product variable */
            add_action( 'woocommerce_save_product_variation', array( $this, 'woo_add_custom_product_variable_sync' ), 20, 2 );
            add_action( 'woocommerce_variable_product_bulk_edit_actions', array( $this, 'bulk_variable_options' ) );
            add_action( 'woocommerce_order_status_changed', array( $this, 'woo_sale_update_quantity_sale' ) );

            /* Add setting in Product edit */
            add_filter( 'product_type_options', array( $this, 'product_type_options' ) );
            add_filter( 'plugin_action_links_' . basename( WSCD_DIR ) . '/' . basename( __FILE__ ), array( $this, 'settings_link' ) );
            add_action( 'manage_product_posts_columns', array( $this, 'product_columns' ) );
            add_action( 'manage_product_posts_custom_column', array( $this, 'product_column_content' ), 10, 2 );
        }

        static function add_settings_page( $settings ) {
            $settings[] = include_once( "class-wc-settings-wscd.php" );
            return $settings;
        }

        /**
         * Update sale
         */
        public function woo_update_sale( $order ) {
            global $woosalescountdown;
            $order_id = $order->id;
            $order = new WC_Order( $order_id );

            $items = $order->get_items();

            foreach ( $items as $item ) {
                if ( $item['variation_id'] == 0 ) {
                    $time_from = get_post_meta( $item['product_id'], '_sale_price_dates_from', true );
                    $time_end = get_post_meta( $item['product_id'], '_sale_price_dates_to', true );
                    $_woosale_from_time = get_post_meta( $item['product_id'], '_woosale_from_time', true );

                    if ( !$time_from || !$time_end ) {
                        continue;
                    }
                    if ( $_woosale_from_time != '' ) {
                        $time_from = woosales_add_specified_time( $time_from, $_woosale_from_time );
                    }
                    $current_time = strtotime( current_time( 'Y-m-d G:i:s' ) );
                    if ( $time_from > $current_time ) {
                        continue;
                    }

                    $woocommerce_quantity_sale = get_post_meta( $item['product_id'], '_quantity_sale', true );
                    $woocommerce_quantity_discount = get_post_meta( $item['product_id'], '_quantity_discount', true );
                    $woocommerce_quantity_sale += $item['qty'];
                    if ( $order->post_status == 'wc-completed' ) {
                        update_post_meta( $item['product_id'], '_quantity_sale', esc_attr( $woocommerce_quantity_sale ) );
                    }
                    if ( $woocommerce_quantity_discount <= $woocommerce_quantity_sale && $woocommerce_quantity_discount ) {

                        $woocommerce_regular_price = get_post_meta( $item['product_id'], '_regular_price', true );
                        delete_post_meta( $item['product_id'], '_sale_price' );
                        delete_post_meta( $item['product_id'], '_sale_price_dates_from' );
                        delete_post_meta( $item['product_id'], '_sale_price_dates_to' );
                        delete_post_meta( $item['product_id'], '_woosale_from_time', '' );
                        delete_post_meta( $item['product_id'], '_woosale_to_time', '' );
                        update_post_meta( $item['product_id'], '_price', esc_attr( $woocommerce_regular_price ) );
                    }
                } else {
                    $time_from = get_post_meta( $item['variation_id'], '_sale_price_dates_from', true );
                    $time_end = get_post_meta( $item['variation_id'], '_sale_price_dates_to', true );
                    $_woosale_from_time = get_post_meta( $item['variation_id'], '_woosale_from_time', true );

                    if ( !$time_from || !$time_end ) {
                        continue;
                    }
                    if ( $_woosale_from_time != '' ) {
                        $time_from = woosales_add_specified_time( $time_from, $_woosale_from_time );
                    }
                    $current_time = strtotime( current_time( 'Y-m-d G:i:s' ) );
                    if ( $time_from > $current_time ) {
                        continue;
                    }

                    $woocommerce_quantity_sale = woosale_get_product_quantity_sale($item['variation_id']);// get_post_meta( $item['variation_id'], '_quantity_sale', true );
                    $woocommerce_quantity_discount = woosale_get_product_quantity_discount($item['variation_id']);// get_post_meta( $item['variation_id'], '_quantity_discount', true );
                    $woocommerce_quantity_sale += $item['qty'];
                    if ( $order->post_status == 'wc-completed' ) {
                        update_post_meta( $item['variation_id'], '_quantity_sale', esc_attr( $woocommerce_quantity_sale ) );
                    }
                    if ( $woocommerce_quantity_discount <= $woocommerce_quantity_sale && $woocommerce_quantity_discount ) {

                        $woocommerce_regular_price = get_post_meta( $item['variation_id'], '_regular_price', true );
                        delete_post_meta( $item['variation_id'], '_sale_price' );
                        delete_post_meta( $item['variation_id'], '_sale_price_dates_from' );
                        delete_post_meta( $item['variation_id'], '_sale_price_dates_to' );
                        delete_post_meta( $item['variation_id'], '_woosale_from_time', '' );
                        delete_post_meta( $item['variation_id'], '_woosale_to_time', '' );
                        update_post_meta( $item['variation_id'], '_price', esc_attr( $woocommerce_regular_price ) );
                    }
                }
            }
        }

        /**
         * Function save Custom field
         *
         * @param $post_id
         */
        public function woo_add_custom_general_fields_save( $post_id ) {
//            if ( isset( $_POST['product-type'] ) ) {
//                if ( $_POST['product-type'] != 'simple' && $_POST['product-type'] != 'variable' ) {
//                    return;
//                }
//            } else {
//                return;
//            }
            // Text Field
            if ( isset( $_POST['_quantity_sale'] ) ) {
                $woocommerce_quantity_sale = $_POST['_quantity_sale'];
                if ( !empty( $woocommerce_quantity_sale ) ) {
                    update_post_meta( $post_id, '_quantity_sale', is_string( $woocommerce_quantity_sale ) ? esc_attr( $woocommerce_quantity_sale ) : $woocommerce_quantity_sale  );
                } else {
                    update_post_meta( $post_id, '_quantity_sale', 0 );
                }
            }
            if ( isset( $_POST['_quantity_discount'] ) ) {
                $woocommerce_quantity_discount = $_POST['_quantity_discount'];
                if ( !$woocommerce_quantity_discount ) {
                    $woocommerce_quantity_discount = $_POST['_stock'];
                }
                if ( !empty( $woocommerce_quantity_discount ) ) {
                    update_post_meta( $post_id, '_quantity_discount', is_string( $woocommerce_quantity_sale ) ? esc_attr( $woocommerce_quantity_discount ) : $woocommerce_quantity_sale  );
                } else {
                    update_post_meta( $post_id, '_quantity_discount', 0 );
                }
            }
            if ( isset( $_POST['_turn_off_countdown'] ) ) {
                $_turn_off_countdown = $_POST['_turn_off_countdown'];
                if ( !empty( $_turn_off_countdown ) ) {
                    update_post_meta( $post_id, '_turn_off_countdown', 'yes' );
                } else {
                    update_post_meta( $post_id, '_turn_off_countdown', '' );
                }
            } else {
                update_post_meta( $post_id, '_turn_off_countdown', '' );
            }
            if ( isset( $_POST['_hide_only_countdown'] ) ) {
                $hide_only_countdown = $_POST['_hide_only_countdown'];
                if ( !empty( $hide_only_countdown ) ) {
                    update_post_meta( $post_id, '_hide_only_countdown', 'yes' );
                } else {
                    update_post_meta( $post_id, '_hide_only_countdown', '' );
                }
            } else {
                update_post_meta( $post_id, '_hide_only_countdown', '' );
            }
            if ( isset( $_POST['_hide_only_salebar'] ) ) {
                $hide_only_salebar = $_POST['_hide_only_salebar'];
                if ( !empty( $hide_only_salebar ) ) {
                    update_post_meta( $post_id, '_hide_only_salebar', 'yes' );
                } else {
                    update_post_meta( $post_id, '_hide_only_salebar', '' );
                }
            } else {
                update_post_meta( $post_id, '_hide_only_salebar', '' );
            }
            /* Save specified time */
            if ( isset( $_POST['_woosale_from_time'] ) ) {
                $_woosale_from_time = $_POST['_woosale_from_time'];
                if ( !empty( $_woosale_from_time ) ) {
                    update_post_meta( $post_id, '_woosale_from_time', is_string( $_woosale_from_time ) ? esc_attr( $_woosale_from_time ) : $_woosale_from_time  );
                } else {
                    update_post_meta( $post_id, '_woosale_from_time', '' );
                }
            }
            if ( isset( $_POST['_woosale_to_time'] ) ) {
                $_woosale_to_time = $_POST['_woosale_to_time'];
                if ( !empty( $_woosale_to_time ) ) {
                    update_post_meta( $post_id, '_woosale_to_time', is_string( $_woosale_to_time ) ? esc_attr( $_woosale_to_time ) : $_woosale_to_time  );
                } else {
                    update_post_meta( $post_id, '_woosale_to_time', '' );
                }
            }
        }

        /* Custom field */

        public function woo_add_custom_general_fields() {

            global $post;
            $_product = wc_get_product( $post->ID );
            if ( in_array( woosale_get_product_type($_product), array( 'variable' ) ) ) {
                return;
            }
            $_woosale_from_time = woosale_get_from_time( $_product );
            $_woosale_to_time = woosale_get_to_time( $_product );
            // Display Custom Field Value
            echo '<div class="options_group thim-countdown-options" style="display: none;">';

            woocommerce_wp_text_input(
                    array(
                        'id' => '_woosale_from_time',
                        'label' => __( 'Sale start time', 'woosalescountdown' ),
                        'placeholder' => '',
                        'desc_tip' => 'true',
                        'description' => __( 'Enter the Specified start time of your sales with format <strong>H:i:s</strong>.', 'woosalescountdown' ),
                        'value' => $_woosale_from_time ? $_woosale_from_time : ''
                    )
            );
            woocommerce_wp_text_input(
                    array(
                        'id' => '_woosale_to_time',
                        'label' => __( 'Sale end time', 'woosalescountdown' ),
                        'placeholder' => '',
                        'desc_tip' => 'true',
                        'description' => __( 'Enter the Specified end time of your sales with format <strong>H:i:s</strong>.', 'woosalescountdown' ),
                        'value' => $_woosale_to_time ? $_woosale_to_time : ''
                    )
            );

            woocommerce_wp_text_input(
                    array(
                        'id' => '_quantity_discount',
                        'label' => __( 'Total product discount', 'woosalescountdown' ),
                        'placeholder' => '',
                        'desc_tip' => 'true',
                        'description' => __( 'Enter the TOTAL Sale product.', 'woosalescountdown' ),
                        'default' => '0'
                    )
            );
            woocommerce_wp_text_input(
                    array(
                        'id' => '_quantity_sale',
                        'label' => __( 'Total sold quantity', 'woosalescountdown' ),
                        'placeholder' => '',
                        'desc_tip' => 'true',
                        'description' => __( 'Quantity sale of this product is sold.', 'woosalescountdown' )
                    )
            );
            echo '</div>';
        }

        /* Custom field in product variable */

        //$loop = 0;
        public function woo_add_custom_product_variable( $loop, $data, $variation ) {
			if ( $variation ) {
				if ( trim( woosale_get_product_type($variation->ID) ) != 'variation' ) {
					return;
				}
			}

            $_quantity_discount = woosale_get_product_quantity_discount( $variation->ID );
            $_quantity_sale = woosale_get_product_quantity_sale($variation->ID);
            $_woosale_from_time = woosale_get_from_time($variation->ID);
            $_woosale_to_time = woosale_get_to_time($variation->ID);

            // Display Custom Field Value
            echo '<tr class="options_group"><td>';
            woocommerce_wp_text_input(
                    array(
                        'id' => '_woosale_from_time[' . $loop . ']',
                        'label' => __( 'Sale start time', 'woosalescountdown' ),
                        'placeholder' => '',
                        'desc_tip' => 'true',
                        'description' => __( 'Enter the Specified start time of your sales with format <strong>H:i:s</strong>.', 'woosalescountdown' ),
                        'value' => $_woosale_from_time ? $_woosale_from_time : ''
                    )
            );
            woocommerce_wp_text_input(
                    array(
                        'id' => '_woosale_to_time[' . $loop . ']',
                        'label' => __( 'Sale end time', 'woosalescountdown' ),
                        'placeholder' => '',
                        'desc_tip' => 'true',
                        'description' => __( 'Enter the Specified end time of your sales with format <strong>H:i:s</strong>.', 'woosalescountdown' ),
                        'value' => $_woosale_to_time ? $_woosale_to_time : ''
                    )
            );
            // Text Field
            @woocommerce_wp_text_input(
                            array(
                                'id' => '_quantity_discount[' . $loop . ']',
                                'label' => __( 'Total product discount', 'woosalescountdown' ),
                                'placeholder' => '',
                                'desc_tip' => 'true',
                                'description' => __( 'Enter the TOTAL Sale product.', 'woosalescountdown' ),
                                'value' => $_quantity_discount ? $_quantity_discount : 0
                            )
            );
            @woocommerce_wp_text_input(
                            array(
                                'id' => '_quantity_sale[' . $loop . ']',
                                'label' => __( 'Total sold quantity', 'woosalescountdown' ),
                                'placeholder' => '',
                                'desc_tip' => 'true',
                                'description' => __( 'Quantity sale of this product is sold.', 'woosalescountdown' ),
                                'value' => $_quantity_sale ? $_quantity_sale : 0
                            )
            );
            echo '</td></tr>';
            //$loop++;
        }

        /**
         * Function save custom field in product variable
         *
         * @param $variation_id POST ID
         */
        public function woo_add_custom_product_variable_save( $variation_id, $i ) {
            if ( isset( $_POST['_quantity_sale'] ) ) {
                $woocommerce_quantity_sale = $_POST['_quantity_sale'];
            } else {
                $woocommerce_quantity_sale = array();
            }
            if ( isset( $_POST['_quantity_discount'] ) ) {
                $woocommerce_quantity_discount = $_POST['_quantity_discount'];
            } else {
                $woocommerce_quantity_discount = array();
            }
            if ( isset( $_POST['_woosale_from_time'] ) ) {
                $_woosale_from_time = $_POST['_woosale_from_time'];
            } else {
                $_woosale_from_time = array();
            }
            if ( isset( $_POST['_woosale_to_time'] ) ) {
                $_woosale_to_time = $_POST['_woosale_to_time'];
            } else {
                $_woosale_to_time = array();
            }
			
			// update data
			if ( !empty( $woocommerce_quantity_sale[$i] ) ) {
				update_post_meta( $variation_id, '_quantity_sale', esc_attr( $woocommerce_quantity_sale[$i] ) );
			} else {
				update_post_meta( $variation_id, '_quantity_sale', 0 );
			}

			if ( !$woocommerce_quantity_discount ) {
				$woocommerce_quantity_discount = $_POST['_stock'];
			}
			if ( !empty( $woocommerce_quantity_discount[$i] ) ) {
				update_post_meta( $variation_id, '_quantity_discount', esc_attr( $woocommerce_quantity_discount[$i] ) );
			} else {
				update_post_meta( $variation_id, '_quantity_discount', 0 );
			}
			/* Save specified time */
			if ( !empty( $_woosale_from_time[$i] ) ) {
				update_post_meta( $variation_id, '_woosale_from_time', esc_attr( $_woosale_from_time[$i] ) );
			} else {
				update_post_meta( $variation_id, '_woosale_from_time', '' );
			}
			if ( !empty( $_woosale_to_time[$i] ) ) {
				update_post_meta( $variation_id, '_woosale_to_time', esc_attr( $_woosale_to_time[$i] ) );
			} else {
				update_post_meta( $variation_id, '_woosale_to_time', '' );
			}
            /* add schedule */
            woosalescountdown_add_schedule( $variation_id );
        }

        public function woo_add_custom_product_variable_sync( $variation_id, $i ) {
            $sync_variation_date_key = isset( $_POST['woosales_sync_variation'] ) ? absint( $_POST['woosales_sync_variation'] ) : '';
            if ( $sync_variation_date_key === '' ) {
                return;
            }
            if ( isset( $_POST['variable_post_id'] ) ) {
                // Text Field
                $variable_post_ids = $_POST['variable_post_id'];
            } else {
                $variable_post_ids = array();
            }
            $variation_syn_id = isset( $variable_post_ids[$sync_variation_date_key] ) ? absint( $variable_post_ids[$sync_variation_date_key] ) : '';
            if ( $variation_syn_id === '' || $variation_syn_id == $variation_id ) {
                return;
            }

            $date_from = get_post_meta( $variation_syn_id, '_sale_price_dates_from', true );
            $date_end = get_post_meta( $variation_syn_id, '_sale_price_dates_to', true );
            $time_from = get_post_meta( $variation_syn_id, '_woosale_from_time', true );
            $time_end = get_post_meta( $variation_syn_id, '_woosale_to_time', true );

            update_post_meta( $variation_id, '_sale_price_dates_from', $date_from );
            update_post_meta( $variation_id, '_sale_price_dates_to', $date_end );
            update_post_meta( $variation_id, '_woosale_from_time', $time_from );
            update_post_meta( $variation_id, '_woosale_to_time', $time_end );

            /* add schedule */
            woosalescountdown_add_schedule( $variation_id );
        }

        /**
         * Update quantity of sales when changing the status of orders to completed.
         */
        public function woo_sale_update_quantity_sale( $order_id ) {
            $order = new WC_Order( $order_id );
            $order_stt = $order->get_status();
            if ( $order_stt == 'completed' ) {
                return $this->woo_update_sale( $order );
            }
        }

        public function product_columns( $cols ) {
            $cols['schedule'] = __( 'Schedule', 'woosalescountdown' );
            return $cols;
        }

        public function product_column_content( $col, $id ) {
            if ( $col == 'schedule' ) {
                if ( woosales_has_countdown( $id ) ) {
                    $dates = $this->get_product_schedule_dates( $id );
                    if ( $dates === false ) {
                        _e( '-', 'woosalescountdown' );
                    } else {
                        if ( $dates['from'] && $dates['to'] ) {
                            $tip = sprintf( __( 'From %s to %s', 'woosalescountdown' ), woosale_format_date_time( $dates['from'] ), woosale_format_date_time( $dates['to'] ) );
                        } elseif ( $dates['from'] ) {
                            $tip = sprintf( __( 'From %s', 'woosalescountdown' ), woosale_format_date_time( $dates['from'] ) );
                        } elseif ( $dates['to'] ) {
                            $tip = sprintf( __( 'To %s', 'woosalescountdown' ), woosale_format_date_time( $dates['to'] ) );
                        }
                        echo '<div class="thim-row-countdown-schedule">';
                        echo '<span class="dashicons dashicons-clock tips" data-tip="' . esc_attr( $tip ) . '"></span>';
                        echo '</div>';
                    }
                }
            }
        }

        public function get_product_schedule_dates( $product_id = 0, $field = '' ) {
            if ( !$product_id ) {
                $product_id = get_the_ID();
            }
            if ( get_post_type( $product_id ) != 'product' ) {
                return false;
            }

            $product = wc_get_product( $product_id );
            $date_from 	= woosale_get_date_on_sale_from( $product );//$product->sale_price_dates_from;
            $date_to 	= woosale_get_date_on_sale_to( $product );//$product->sale_price_dates_to;
            $time_from = '';
            $time_to = '';
            if ( !$date_from && !$date_to ) {
                return false;
            }
            if ( $date_from ) {
                $time_from = woosale_get_from_time($product);//$product->woosale_from_time;
                if ( $time_from != '' ) {
                    $date_from = woosales_add_specified_time( $date_from, $time_from );
                }
            }
            if ( $date_to ) {
                $time_to = woosale_get_to_time($product);//$product->woosale_to_time;
                if ( $time_to != '' ) {
                    $date_to = woosales_add_specified_time( $date_to, $time_to );
                }
            }

            $dates = array( 'from' => $date_from, 'to' => $date_to, 'time_from' => $time_from, 'time_to' => $time_to );
            if ( $field && array_key_exists( $field, $dates ) ) {
                return $dates[$field];
            }
            return $dates;
        }

        /**
         * Add bulk option in product variable
         */
        public function bulk_variable_options() {
            ?>
            <optgroup label="<?php esc_attr_e( 'Sales Countdown', 'woosalescountdown' ); ?>">
                <option value="variable_sale_price_dates_from" data-desc="<?php echo esc_attr(__( 'Start date : YYYY-MM-DD', 'woosalescountdown' )); ?>"><?php _e( 'Start date', 'woosalescountdown' ); ?></option>
                <option value="variable_sale_price_dates_to" data-desc="<?php echo esc_attr(__( 'End date : YYYY-MM-DD', 'woosalescountdown' )); ?>"><?php _e( 'End date', 'woosalescountdown' ); ?></option>
                <option value="_quantity_discount" data-desc="<?php echo esc_attr(__( 'Total product discount', 'woosalescountdown' )); ?>"><?php _e( 'Total product discount', 'woosalescountdown' ); ?></option>
                <option value="_quantity_sale" data-desc="<?php echo esc_attr(__( 'Sold', 'woosalescountdown' )); ?>"><?php _e( 'Sold', 'woosalescountdown' ); ?></option>
				<option value="_woosale_from_time" data-desc="<?php echo esc_attr(__( 'Start time', 'woosalescountdown' )); ?>"><?php _e( 'Start time', 'woosalescountdown' ); ?></option>
                <option value="_woosale_to_time" data-desc="<?php echo esc_attr(__( 'End time', 'woosalescountdown' )); ?>"><?php _e( 'End time', 'woosalescountdown' ); ?></option>
            </optgroup>
            <?php
        }
		
		/**
		 * Process save 
		 */
		public function woocommerce_bulk_edit_variations_callback($bulk_action, $data, $product_id, $variations){
			if( !$variations || empty($variations) || !isset( $data['value']) ) {
				return;
			}

			if( 'variable_sale_price_dates_from' == $bulk_action ) {
				$value = esc_attr($data['value']);
				$date_from     = (string) $value ? wc_clean( $value ) : '';
				foreach( $variations as $variation_id ) {
					update_post_meta( $variation_id, '_sale_price_dates_from', $date_from ? strtotime( $date_from ) : '' );
				}
			}

			if( 'variable_sale_price_dates_to' == $bulk_action ) {
				$value = esc_attr($data['value']);
				$date_to = (string) $value ? wc_clean( $value ) : '';
				foreach( $variations as $variation_id ) {
					update_post_meta( $variation_id, '_sale_price_dates_to', $date_to ? strtotime( $date_to ) : '' );
				}
				return;
			}
			
			if( '_quantity_discount' == $bulk_action ) {
				$value = intval($data['value']);
				foreach( $variations as $variation_id ) {
					update_post_meta( $variation_id, '_quantity_discount', esc_attr( $value ) );
				}
				return;
			}
			if( '_quantity_sale' == $bulk_action ) {
				$value = intval($data['value']);
				foreach( $variations as $variation_id ) {
					update_post_meta( $variation_id, '_quantity_sale', esc_attr( $value ) );
				}
				return;
			}
			if( '_woosale_from_time' == $bulk_action ) {
				$value = $data['value'];
				foreach( $variations as $variation_id ) {
					update_post_meta( $variation_id, '_woosale_from_time', esc_attr( $value ) );
				}
				return;
			}
			if( '_woosale_to_time' == $bulk_action ) {
				$value = $data['value'];
				foreach( $variations as $variation_id ) {
					update_post_meta( $variation_id, '_woosale_to_time', esc_attr( $value ) );
				}
				return;
			}
		}

        /**
         * add turn off countdown in each product
         *
         * @param $options
         *
         * @return array
         */
        public function product_type_options( $options ) {
            $product_type_options = array(
                'turn_off_countdown' => array(
                    'id' => '_turn_off_countdown',
                    'wrapper_class' => 'show_if_simple show_if_variable',
                    'label' => __( 'Hide all countdown and sale bar', 'woosalescountdown' ),
                    'description' => __( 'Hide countdown on this product.', 'woosalescountdown' ),
                    'default' => 'no'
                ),
                'hide_only_countdown' => array(
                    'id' => '_hide_only_countdown',
                    'wrapper_class' => 'show_if_simple show_if_variable',
                    'label' => __( 'Hide only countdown', 'woosalescountdown' ),
                    'description' => __( 'Hide only countdown on product sale. ', 'woosalescountdown' ),
                    'default' => 'no'
                ),
                'hide_only_salebar' => array(
                    'id' => '_hide_only_salebar',
                    'wrapper_class' => 'show_if_simple show_if_variable',
                    'label' => __( 'Hide only Sale Bar', 'woosalescountdown' ),
                    'description' => __( 'Hide only Sale Bar on product sale.', 'woosalescountdown' ),
                    'default' => 'no'
                )
            );

            $options = array_merge( $options, $product_type_options );

            return $options;
        }

        /* save setting */

        public function save_setting() {
            if ( isset( $_POST['ob_detail_position'] ) ) {
                update_option( 'ob_detail_position', $_POST['ob_detail_position'] );
            }
            if ( isset( $_POST['ob_single_element_text'] ) ) {
                update_option( 'ob_single_element_text', $_POST['ob_single_element_text'] );
            }
            if ( isset( $_POST['ob_woosales_categories'] ) ) {
                update_option( 'ob_woosales_categories', $_POST['ob_woosales_categories'] );
            }

            if ( isset( $_POST['ob_woosales_single'] ) ) {
                update_option( 'ob_woosales_single', $_POST['ob_woosales_single'] );
            }
            if ( isset( $_POST['ob_categories_position'] ) ) {
                update_option( 'ob_categories_position', $_POST['ob_categories_position'] );
            }
//             if('ob_categories_position')
        }

    }

}
return new WSCD_Admin();
