<?php
if ( !defined( 'ABSPATH' ) || !class_exists( 'WC_Widget' ) ) {
    exit;
}

/**
 * List products on sale within countdown
 * @extends  WC_Widget
 */
class WSCD_Widget_Sale_Products extends WC_Widget {

    /**
     * Constructor.
     */
    public function __construct() {
        $this->widget_cssclass = 'woocommerce widget_products wscd_widget_sale_products';
        $this->widget_description = __( 'Display a list of your sale products countdown on your site.', 'woosalescountdown' );
        $this->widget_id = 'wscd_sale_products';
        $this->widget_name = __( 'WooCommerce Sale Products Countdown', 'woosalescountdown' );
        $this->settings = array(
            'title' => array(
                'type' => 'text',
                'std' => __( 'Products', 'woosalescountdown' ),
                'label' => __( 'Title', 'woosalescountdown' )
            ),
            'products' => array(
                'type' => 'products',
                'std' => array(),
                'label' => __( 'Products On Sale', 'woosalescountdown' )
            ),
            'show_title' => array(
                'type' => 'checkbox',
                'std' => 1,
                'label' => __( 'Show title products', 'woosalescountdown' )
            ),
            'show_rating' => array(
                'type' => 'checkbox',
                'std' => 1,
                'label' => __( 'Show rating products', 'woosalescountdown' )
            ),
            'show_price' => array(
                'type' => 'checkbox',
                'std' => 1,
                'label' => __( 'Show price products', 'woosalescountdown' )
            ),
            'show_image' => array(
                'type' => 'checkbox',
                'std' => 1,
                'label' => __( 'Show image products', 'woosalescountdown' )
            ),
            'show_link' => array(
                'type' => 'checkbox',
                'std' => 1,
                'label' => __( 'Linkable products', 'woosalescountdown' )
            ),
            'show_button' => array(
                'type' => 'checkbox',
                'std' => 1,
                'label' => __( 'Show Add To Cart Button', 'woosalescountdown' )
            ),
            'product_image' => array(
                'type' => 'select',
                'std' => 'shop_catalog',
                'options' => array(
                    'shop_catalog' => __( 'Shop Catalog', 'woosalescountdown' ),
                    'shop_single' => __( 'Single Product Image', 'woosalescountdown' ),
                    'shop_thumbnail' => __( 'Shop Thumnail', 'woosalescountdown' )
                ),
                'label' => __( 'Product Image', 'woosalescountdown' )
            )
        );

        parent::__construct();

        /* products field */
        add_action( 'woocommerce_widget_field_products', array( $this, 'products_field' ), 10, 4 );
        add_filter( 'woocommerce_widget_settings_sanitize_option', array( $this, 'update_widget' ), 10, 4 );
    }

    /* products field */

    public function products_field( $key, $value, $setting, $instance ) {
        $class = isset( $setting['class'] ) ? $setting['class'] : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( $key ); ?>"><?php echo $setting['label']; ?></label>
            <select class="widefat <?php echo esc_attr( $class ); ?>" id="<?php echo esc_attr( $this->get_field_id( $key ) ); ?>" name="<?php echo $this->get_field_name( $key ); ?>[]" multiple>
                <?php foreach ( wc_get_product_ids_on_sale() as $product_id ) : ?>
                    <?php if ( get_post_type( $product_id ) !== 'product' ) continue; ?>
                    <option value="<?php echo esc_attr( $product_id ); ?>" <?php echo in_array( $product_id, $value ) ? ' selected' : ''; ?>><?php echo esc_html( get_the_title( $product_id ) ); ?></option>
                <?php endforeach; ?>
            </select>
        </p>
        <?php
    }

    /* update widget */

    public function update_widget( $value, $new_instance, $key, $setting ) {
        if ( $key !== 'products' ) {
            return $value;
        }
        return $new_instance[$key];
    }

    /* get products with args and instance */

    public function get_products( $args = array(), $instance = array() ) {
        $query_args = array(
            'post_type' => 'product',
            'post_status' => 'publish'
        );
        if ( !isset( $instance['products'] ) ) {
            foreach ( wc_get_product_ids_on_sale() as $product_id ) {
                if ( get_post_type( $product_id ) !== 'product' ) {
                    continue;
                }
                $instance['products'][] = $product_id;
            }
        }
        $query_args['post__in'] = $instance['products'];
        return new WP_Query( apply_filters( 'woosalescountdown_products_widget_query_args', $query_args ) );
    }

    /**
     * Output widget.
     *
     * @see WP_Widget
     *
     * @param array $args
     * @param array $instance
     */
    public function widget( $args, $instance ) {
        if ( $this->get_cached_widget( $args ) ) {
            return;
        }

        ob_start();

        /**
         * Remove title
         * Remove price
         * Remove Image
         * Remove link
         * Remove Add To Cart button
         * */
        do_action( 'woosalescountdown_before_widget_sale_product', $args, $instance );

        if ( ( $products = $this->get_products( $args, $instance ) ) && $products->have_posts() ) {
            $this->widget_start( $args, $instance );
            ?>

            <div class="woocommerce ob_widget">

                <?php
                woocommerce_product_loop_start();

                while ( $products->have_posts() ) {
                    $products->the_post();
                    wc_get_template_part( 'content', 'product' );
                }

                woocommerce_product_loop_end();
                ?>

            </div>

            <?php
            $this->widget_end( $args );
        }
        wp_reset_postdata();

        /**
         * Add action title
         * Add action price
         * Add action Image
         * Add action link
         * Add action Add To Cart button
         * */
        do_action( 'woosalescountdown_after_widget_sale_product', $args, $instance );

        echo $this->cache_widget( $args, ob_get_clean() );
    }

}
