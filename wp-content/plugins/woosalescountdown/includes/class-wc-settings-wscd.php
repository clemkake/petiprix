<?php
if ( !defined( 'ABSPATH' ) )
    exit; // Exit if accessed directly

if ( !class_exists( 'WC_Settings_WSCD' ) ) :

    /**
     * WC_Settings_NYP
     */
    class WC_Settings_WSCD extends WC_Settings_Page {

        /**
         * Constructor.
         */
        public function __construct() {
            $this->id = 'wscd';
            $this->label = __( 'Sales Countdown', 'woosalescountdown' );

            add_filter( 'woocommerce_settings_tabs_array', array( $this, 'add_settings_page' ), 200 );
            add_action( 'woocommerce_sections_' . $this->id, array( $this, 'output_sections' ) );
            add_action( 'woocommerce_settings_' . $this->id, array( $this, 'output' ) );
            add_action( 'woocommerce_settings_save_' . $this->id, array( $this, 'save' ) );
            /* Single */
            add_action( 'woocommerce_admin_field_countdown_single_position', array( $this, 'countdown_single_position' ) );
            add_action( 'woocommerce_admin_field_countdown_single_element', array( $this, 'countdown_single_element' ) );
            /* Categories */
            add_action( 'woocommerce_admin_field_countdown_categories_element', array( $this, 'countdown_categories_element' ) );
            add_action( 'woocommerce_admin_field_countdown_categories_position', array( $this, 'countdown_categories_position' ) );
        }

        /**
         * Get sections
         *
         * @return array
         */
        public function get_sections() {

            $sections = array(
                'geeral' => __( 'General', 'woosalescountdown' ),
                'product_category' => __( 'List Products', 'woosalescountdown' ),
                'product_detail' => __( 'Single Product', 'woosalescountdown' ),
            );

            return $sections;
        }

        public function output() {
            global $current_section;

            $settings = $this->get_settings( $current_section );

            WC_Admin_Settings::output_fields( $settings );
        }

        public function save() {
            global $current_section;

            $settings = $this->get_settings( $current_section );
            WC_Admin_Settings::save_fields( $settings );
        }

        public function get_settings_product_detail() {
            return
                    array(
                        array(
                            'title' => __( 'Product Detail', 'woosalescountdown' ),
                            'type' => 'title',
                            'desc' => '',
                            'id' => 'wooscd_detail_product'
                        ),
                        array(
                            'title' => __( 'Enable', 'woosalescountdown' ),
                            'id' => 'ob_single_enable',
                            'default' => '1',
                            'type' => 'radio',
                            'desc_tip' => __( 'Enable countdown for single page.', 'woosalescountdown' ),
                            'options' => array(
                                '1' => __( 'Yes', 'woosalescountdown' ),
                                '0' => __( 'No', 'woosalescountdown' )
                            ),
                        ),
                        array(
                            'type' => 'countdown_single_position'
                        ),
                        array(
                            'title' => __( 'Show date text', 'woosalescountdown' ),
                            'id' => 'ob_single_datetext_show',
                            'default' => '1',
                            'type' => 'radio',
                            'desc_tip' => __( 'Show Days, Hours, Mins, Sec.', 'woosalescountdown' ),
                            'options' => array(
                                '1' => __( 'Yes', 'woosalescountdown' ),
                                '0' => __( 'No', 'woosalescountdown' )
                            ),
                        ),
                        array(
                            'type' => 'countdown_single_element'
                        ),
                        array(
                            'type' => 'sectionend',
                            'id' => 'wooscd_detail_product'
                        )
            );
        }

        public function get_settings_product_category() {
            return
                    array(
                        array(
                            'title' => __( 'List Products', 'woosalescountdown' ),
                            'type' => 'title',
                            'desc' => '',
                            'id' => 'wooscd_product_category'
                        ),
                        array(
                            'title' => __( 'Enable', 'woosalescountdown' ),
                            'id' => 'ob_categories_enable',
                            'default' => '1',
                            'type' => 'radio',
                            'desc_tip' => __( 'Enable countdown categories page.', 'woosalescountdown' ),
                            'options' => array(
                                '1' => __( 'Yes', 'woosalescountdown' ),
                                '0' => __( 'No', 'woosalescountdown' )
                            ),
                        ),
                        array(
                            'type' => 'countdown_categories_position'
                        ),
                        array(
                            'title' => __( 'Show date text', 'woosalescountdown' ),
                            'id' => 'ob_categories_datetext_show',
                            'default' => '1',
                            'type' => 'radio',
                            'desc_tip' => __( 'Show Days, Hours, Mins, Sec.', 'woosalescountdown' ),
                            'options' => array(
                                '1' => __( 'Yes', 'woosalescountdown' ),
                                '0' => __( 'No', 'woosalescountdown' )
                            ),
                        ),
                        array(
                            'type' => 'countdown_categories_element'
                        ),
                        array(
                            'type' => 'sectionend',
                            'id' => 'wooscd_product_category'
                        )
            );
        }

        public function get_settings( $current_section = '' ) {
            if ( is_callable( array( $this, 'get_settings_' . $current_section ) ) ) {
                return call_user_func( array( $this, 'get_settings_' . $current_section ) );
            }
            return array(
                array( 'title' => __( 'General Options', 'woosalescountdown' ),
                    'type' => 'title',
                    'desc' => '',
                    'id' => 'product_sale_options' ),
                array(
                    'title' => __( 'Enable Coming Schedule', 'woosalescountdown' ),
                    'id' => 'ob_coming_schedule',
                    'type' => 'checkbox',
                    'desc' => __( 'Enable.', 'woosalescountdown' ),
                    'default' => 'yes'
                ),
                array(
                    'title' => __( 'Use color', 'woosalescountdown' ),
                    'id' => 'ob_use_color',
                    'default' => '1',
                    'type' => 'radio',
                    'desc_tip' => __( 'Please select color for countdown.', 'woosalescountdown' ),
                    'options' => array(
                        '0' => __( 'WooCommerce Frontend Styles', 'woosalescountdown' ),
                        '1' => __( 'Custom below', 'woosalescountdown' )
                    ),
                ),
                array(
                    'title' => __( 'Time color', 'woosalescountdown' ),
                    'id' => 'ob_time_color',
                    'default' => '#000000',
                    'type' => 'text',
                    'class' => 'colorpick',
                    'desc' => __( 'Set color for time on Countdown.', 'woosalescountdown' ),
                ),
                array(
                    'title' => __( 'Background color', 'woosalescountdown' ),
                    'id' => 'ob_background_color',
                    'default' => '#cccccc',
                    'type' => 'text',
                    'class' => 'colorpick',
                    'desc' => __( 'Set background color for time on Countdown.', 'woosalescountdown' ),
                ),
                array(
                    'title' => __( 'Bar Sale color', 'woosalescountdown' ),
                    'id' => 'ob_bar_color',
                    'default' => '#ff0000',
                    'type' => 'text',
                    'class' => 'colorpick',
                    'desc' => __( 'Set bar\'s color what number sales on Countdown bar sale.', 'woosalescountdown' ),
                ),
                array(
                    'title' => __( 'Bar Sale Background color', 'woosalescountdown' ),
                    'id' => 'ob_bg_bar_color',
                    'default' => '#006699',
                    'type' => 'text',
                    'class' => 'colorpick',
                    'desc' => __( 'Set bar\'s background color what number sales on Countdown bar sale.', 'woosalescountdown' ),
                ),
                array(
                    'title' => __( 'Product sale\'s title', 'woosalescountdown' ),
                    'id' => 'ob_title_sale',
                    'default' => 'Sale',
                    'type' => 'text',
                    'desc' => __( 'Title of product what is saling.', 'woosalescountdown' )
                ),
                array(
                    'title' => __( 'Product coming\'s title', 'woosalescountdown' ),
                    'id' => 'ob_title_coming',
                    'default' => 'Comming',
                    'type' => 'text',
                    'desc' => __( 'Title of product what is coming sale.', 'woosalescountdown' )
                ),
                array(
                    'title' => __( 'Bar sale for product variations', 'woosalescountdown' ),
                    'id' => 'ob_bar_sale_variations',
                    'default' => '0',
                    'type' => 'radio',
                    'desc_tip' => __( 'Show product quantity sold with format', 'woosalescountdown' ),
                    'options' => array(
                        '0' => __( 'Private', 'woosalescountdown' ),
                        '1' => __( 'Total variations', 'woosalescountdown' ),
                    ),
                ),
                array(
                    'title' => __( 'Hide product', 'woosalescountdown' ),
                    'id' => 'ob_hide_product',
                    'default' => '0',
                    'type' => 'radio',
                    'desc_tip' => __( 'Product will be hide when time schedule expired.', 'woosalescountdown' ),
                    'options' => array(
                        '0' => __( 'No', 'woosalescountdown' ),
                        'draft' => __( 'Set as Draft', 'woosalescountdown' ),
                        'trash' => __( 'Move to Trash', 'woosalescountdown' )
                    ),
                ),
                array(
                    'title' => __( 'Remove Sale Price', 'woosalescountdown' ),
                    'id' => 'ob_remove_sale_price',
                    'default' => '1',
                    'type' => 'radio',
                    'desc_tip' => __( 'Sale price will be remove when time schedule expired.', 'woosalescountdown' ),
                    'options' => array(
                        '0' => __( 'No', 'woosalescountdown' ),
                        '1' => __( 'Yes', 'woosalescountdown' )
                    ),
                ),
                array(
                    'type' => 'sectionend',
                    'id' => 'product_sale_options'
                )
            );
        }

        public function countdown_single_position() {
            $selected = get_option( 'ob_detail_position', 0 );
            ?>
            <tr valign="top">
                <th scope="row" class="titledesc"><?php _e( 'CountDown position', 'woosalescountdown' ) ?></th>
                <td class="forminp">
                    <ul>
                        <li>
                            <label>
                                <input type="radio" name="ob_detail_position" value="0" <?php checked( $selected, 0 ); ?>/>
                                <?php _e( 'Above tabs area', 'woosales_countdown_position' ); ?>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" name="ob_detail_position" value="1" <?php checked( $selected, 1 ); ?>/>
                                <?php _e( 'Below tabs area', 'woosales_countdown_position' ); ?>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" name="ob_detail_position" value="2" <?php checked( $selected, 2 ); ?>/>
                                <?php _e( 'Above short description', 'woosales_countdown_position' ); ?>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" name="ob_detail_position" value="3" <?php checked( $selected, 3 ); ?>/>
                                <?php _e( 'Below short description', 'woosales_countdown_position' ); ?>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" name="ob_detail_position" value="4" <?php checked( $selected, 4 ); ?>/>
                                <?php _e( 'Above Add to cart', 'woosales_countdown_position' ); ?>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" name="ob_detail_position" value="5" <?php checked( $selected, 5 ); ?>/>
                                <?php _e( 'Below Add to cart', 'woosales_countdown_position' ); ?>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" name="ob_detail_position" value="6" <?php checked( $selected, 6 ); ?>/>
                                <?php _e( 'Above title', 'woosales_countdown_position' ); ?>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" name="ob_detail_position" value="7" <?php checked( $selected, 7 ); ?>/>
                                <?php _e( 'Below title', 'woosales_countdown_position' ); ?>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" name="ob_detail_position" value="8" <?php checked( $selected, 8 ); ?>/>
                                <?php _e( 'Above price', 'woosales_countdown_position' ); ?>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" name="ob_detail_position" value="9" <?php checked( $selected, 9 ); ?>/>
                                <?php _e( 'Below price', 'woosales_countdown_position' ); ?>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" name="ob_detail_position" value="custom" <?php checked( $selected, 'custom' ); ?>/>
                                <?php _e( 'Custom', 'woosales_countdown_position' ); ?>
                                <input type="text" class="regular-input" name="ob_single_element_text" id="ob_single_element_text" value="<?php printf( '%s', get_option( 'ob_single_element_text', '[before-single-product-rating]' ) ) ?>" />
                            </label>
                        </li>
                    </ul>
                </td>
            </tr>
            <?php
        }

        public function countdown_categories_position() {
            $selected = get_option( 'ob_categories_position', 0 );
            ?>
            <tr valign="top">
                <th scope="row" class="titledesc"><?php _e( 'CountDown position', 'woosalescountdown' ) ?></th>
                <td class="forminp">
                    <ul>
                        <li>
                            <label>
                                <input type="radio" name="ob_categories_position" value="0" <?php checked( $selected, 0 ); ?>/>
                                <?php _e( 'Above price', 'woosales_countdown_position' ); ?>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" name="ob_categories_position" value="1" <?php checked( $selected, 1 ); ?>/>
                                <?php _e( 'Above title', 'woosales_countdown_position' ); ?>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" name="ob_categories_position" value="2" <?php checked( $selected, 2 ); ?>/>
                                <?php _e( 'Above Add to Cart', 'woosales_countdown_position' ); ?>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" name="ob_categories_position" value="3" <?php checked( $selected, 3 ); ?>/>
                                <?php _e( 'Below Add to Cart', 'woosales_countdown_position' ); ?>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" name="ob_categories_position" value="4" <?php checked( $selected, 4 ); ?>/>
                                <?php _e( 'Above thumbnail', 'woosales_countdown_position' ); ?>
                            </label>
                        </li>
                        <li>
                            <label>
                                <input type="radio" name="ob_categories_position" value="custom" <?php checked( $selected, 'custom' ); ?>/>
                                <?php _e( 'Custom', 'woosales_countdown_position' ); ?>
                                <input type="text" class="regular-input" name="ob_categories_element_text" id="ob_categories_element_text" value="<?php printf( '%s', get_option( 'ob_categories_element_text' ) ) ?>" />
                            </label>
                        </li>
                    </ul>
                </td>
            </tr>
            <?php
        }

        public function countdown_categories_element() {
            ob_start();
            woosales_elements_display_sortable( 'ob_woosales_categories' );
            echo ob_get_clean();
        }

        public function countdown_single_element() {
            ob_start();
            woosales_elements_display_sortable( 'ob_woosales_single' );
            echo ob_get_clean();
        }

    }

    endif;

return new WC_Settings_WSCD();
