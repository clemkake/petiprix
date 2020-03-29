<?php
/**
 *  Woo Product Slider Pro Widget
 */
function woo_product_slider_pro_widget() {
	register_widget( 'woo_product_slider_pro_widget_content' );
}

add_action( 'widgets_init', 'woo_product_slider_pro_widget' );

class woo_product_slider_pro_widget_content extends WP_Widget {

	function __construct() {
		parent::__construct(
			'woo_product_slider_pro_widget_content', __( 'Product Slider Pro for WooCommerce', 'woo-product-slider-pro' ),
			array(
				'description' => __( 'Display WooCommerce Product Slider.', 'woo-product-slider-pro' ),
			)
		);
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		extract( $args );

		$title        = apply_filters( 'widget_title', esc_attr( $instance['title'] ) );
		$shortcode_id = isset( $instance['shortcode_id'] ) ? absint( $instance['shortcode_id'] ) : 0;

		if ( ! $shortcode_id ) {
			return;
		}

		echo $args['before_widget'];

		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		echo do_shortcode( '[woo-product-slider-pro id=' . $shortcode_id . ']' );
		echo $args['after_widget'];
	}


	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		$shortcodes   = $this->shortcodes_list();
		$shortcode_id = ! empty( $instance['shortcode_id'] ) ? absint( $instance['shortcode_id'] ) : null;
		$title        = ! empty( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';

		if ( count( $shortcodes ) > 0 ) {

			echo sprintf( '<p><label for="%1$s">%2$s</label>', $this->get_field_id( 'title' ), __( 'Title:', 'woo-product-slider-pro' ) );
			echo sprintf( '<input type="text" class="widefat" id="%1$s" name="%2$s" value="%3$s" /></p>', $this->get_field_id( 'title' ), $this->get_field_name( 'title' ), $title );

			echo sprintf( '<p><label>%s</label>', __( 'Shortcode:', 'woo-product-slider-pro' ) );
			echo sprintf( '<select class="widefat" name="%s">', $this->get_field_name( 'shortcode_id' ) );
			foreach ( $shortcodes as $shortcode ) {
				$selected = $shortcode->id == $shortcode_id ? 'selected="selected"' : '';
				echo sprintf(
					'<option value="%1$d" %3$s>%2$s</option>',
					$shortcode->id,
					$shortcode->title,
					$selected
				);
			}
			echo '</select></p>';

		} else {
			echo sprintf(
				'<p>%1$s <a href="' . admin_url( 'post-new.php?post_type=sp_wpsp_shortcodes' ) . '">%3$s</a> %2$s</p>',
				__( 'You did not generate any slider yet.', 'woo-product-slider-pro' ),
				__( 'to generate a new slider now.', 'woo-product-slider-pro' ),
				__( 'click here', 'woo-product-slider-pro' )
			);
		}
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		$instance                 = array();
		$instance['title']        = sanitize_text_field( $new_instance['title'] );
		$instance['shortcode_id'] = absint( $new_instance['shortcode_id'] );

		return $instance;
	}

	private function shortcodes_list() {
		$shortcodes = get_posts(
			array(
				'post_type'   => 'sp_wpsp_shortcodes',
				'post_status' => 'publish',
			)
		);

		if ( count( $shortcodes ) < 1 ) {
			return array();
		}

		return array_map(
			function ( $shortcode ) {
					return (object) array(
						'id'    => absint( $shortcode->ID ),
						'title' => esc_html( $shortcode->post_title ),
					);
			}, $shortcodes
		);
	}

}
