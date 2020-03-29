<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Field: Upload
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class SP_WPSP_Framework_Option_upload extends SP_WPSP_Framework_Options {

	public function __construct( $field, $value = '', $unique = '' ) {
		parent::__construct( $field, $value, $unique );
	}

	public function output() {

		echo $this->element_before();

		if ( isset( $this->field['settings'] ) ) { extract( $this->field['settings'] ); }

		$upload_type  = ( isset( $upload_type  ) ) ? $upload_type  : 'image';
		$button_title = ( isset( $button_title ) ) ? $button_title : __( 'Upload', 'woo-product-slider-pro' );
		$frame_title  = ( isset( $frame_title  ) ) ? $frame_title  : __( 'Upload', 'woo-product-slider-pro' );
		$insert_title = ( isset( $insert_title ) ) ? $insert_title : __( 'Use Image', 'woo-product-slider-pro' );

		echo '<input type="text" name="' . $this->element_name() . '" value="' . $this->element_value() . '"' . $this->element_class() . $this->element_attributes() . '/>';
		echo '<a href="#" class="button sp-add" data-frame-title="' . $frame_title . '" data-upload-type="'. $upload_type . '" data-insert-title="' . $insert_title . '">' . $button_title . '</a>';

		echo $this->element_after();

	}
}
