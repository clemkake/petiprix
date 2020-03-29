<?php if ( ! defined( 'ABSPATH' ) ) {
	die; } // Cannot access pages directly.
/**
 *
 * Field: Switcher
 *
 * @since 1.0.0
 * @version 1.0.0
 */
class SP_WPSP_Framework_Option_switcher extends SP_WPSP_Framework_Options {

	public function __construct( $field, $value = '', $unique = '' ) {
		parent::__construct( $field, $value, $unique );
	}

	public function output() {

		echo $this->element_before();
		$label          = ( isset( $this->field['label'] ) ) ? '<div class="sp-text-desc">' . $this->field['label'] . '</div>' : '';
		$on_text        = ( isset( $this->field['on_text'] ) ) ? $this->field['on_text'] : 'on';
		$off_text       = ( isset( $this->field['off_text'] ) ) ? $this->field['off_text'] : 'off';
		echo '<label><input type="checkbox" name="' . $this->element_name() . '" value="1"' . $this->element_class() . $this->element_attributes() . checked( $this->element_value(), 1, false ) . '/><em data-on="' . $on_text . '" data-off="' . $off_text . '"></em><span></span></label>' . $label;
		echo $this->element_after();

	}

}
