<?php if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access pages directly.

/**
 *
 * Field: Color Set
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */

if ( ! class_exists( 'SP_WPSP_Framework_Option_color_set' ) ) {
	class SP_WPSP_Framework_Option_color_set extends SP_WPSP_Framework_Options {

		public function __construct( $field, $value = '', $unique = '' ) {
			parent::__construct( $field, $value, $unique );
		}

		public function output() {

			$options = ( ! empty( $this->field['options'] ) ) ? $this->field['options'] : array();

			echo $this->element_before();

			if ( ! empty( $options ) ) {
                echo '<div class="sp_wpspro_color_set_field" data-id="' . $this->field['id'] . '">';
                    foreach( $options as $key => $option ) {

                        $color_value  = ( ! empty( $this->value[$key] ) ) ? $this->value[$key] : '';
                        $default_attr = ( ! empty( $this->field['default'][$key] ) ) ? $this->field['default'][$key] : '';
                        
                        echo sp_wpsp_add_element( array(
                            'pseudo'     => true,
                            'type'       => 'color_picker',
                            'name'       => $this->element_name( '['. $key .']' ),
                            'value'      => $color_value,
                            'default'    => $default_attr,
                            'wrap_class' => 'sp-color-set',
                            'before'     => $option . '<br>',
                        ) );

                    }
                echo '</div>';
			}

			echo '<div class="clear"></div>';

			echo $this->element_after();

		}

	}
}
