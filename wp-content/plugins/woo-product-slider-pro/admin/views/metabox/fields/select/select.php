<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access pages directly.
/**
 *
 * Field: Select
 *
 * @since 1.0.0
 * @version 1.0.0
 */
class SP_WPSP_Framework_Option_select extends SP_WPSP_Framework_Options {

	public function __construct( $field, $value = '', $unique = '' ) {
		parent::__construct( $field, $value, $unique );
	}

	public function output() {

		echo $this->element_before();

		if ( isset( $this->field['options'] ) ) {

			$options          = $this->field['options'];
			$class            = $this->element_class();
			$options          = ( is_array( $options ) ) ? $options : array_filter( $this->element_data( $options ) );
			$extra_name       = ( isset( $this->field['attributes']['multiple'] ) ) ? '[]' : '';
			$placeholder      = ( isset( $this->field['attributes']['placeholder'] ) ) ? $this->field['attributes']['placeholder'] : '';
			$placeholder_data = ( isset( $this->field['attributes']['placeholder'] ) ) ? 'data-placeholder="' . $placeholder . '"' : '';
			$chosen_rtl       = ( is_rtl() && strpos( $class, 'chosen' ) ) ? 'chosen-rtl' : '';
			$fieldid          = ( isset( $this->field['id'] ) ? $this->field['id'] : '' );
			$fieldid_data     = ( isset( $this->field['id'] ) ) ? 'id="sp_' . $fieldid . '"' : '';

			echo '<select ' . $placeholder_data . ' ' . $fieldid_data . ' name="' . $this->element_name( $extra_name ) . '"' . $this->element_class( $chosen_rtl ) . $this->element_attributes() . '>';

			echo ( isset( $this->field['default_option'] ) ) ? '<option value="">' . $this->field['default_option'] . '</option>' : '';

			if ( ! empty( $options ) ) {
				foreach ( $options as $key => $value ) {
					echo '<option value="' . $key . '" ' . $this->checked( $this->element_value(), $key, 'selected' ) . '>' . $value . '</option>';
				}
			}

			echo '</select>';

		}

		echo $this->element_after();

	}

}
