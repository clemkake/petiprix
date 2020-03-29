<?php if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access pages directly.
/**
 *
 * Field: Number Set
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class SP_WPSP_Framework_Option_number_set extends SP_WPSP_Framework_Options {

	public function __construct( $field, $value = '', $unique = '' ) {
		parent::__construct( $field, $value, $unique );
	}

	public function output() {

		echo $this->element_before();

		$defaults_value = array(
			'number1'   => '',
			'number2'   => '',
			'number3'   => '',
			'number4'   => '',
			'number5'   => '',
			'title1'    => '',
			'title2'    => '',
			'title3'    => '',
			'title4'    => '',
			'title5'    => '',
			'help1'     => '',
			'help2'     => '',
			'help3'     => '',
			'help4'     => '',
			'help5'     => '',
		);
		$value  = wp_parse_args( $this->element_value(), $defaults_value );
		$title  = wp_parse_args( $this->field['default'], $defaults_value );
		$help   = wp_parse_args( $this->field['default'], $defaults_value );

		if ( isset( $this->field['number1'] ) && $this->field['number1'] == true ) {
			echo sp_wpsp_add_element( array(
				'pseudo'     => true,
				'type'       => 'number',
				'name'       => $this->element_name( '[number1]' ),
				'value'      => $value['number1'],
				'default'    => ( isset( $this->field['default']['number1'] ) ) ? $this->field['default']['number1'] : '',
				'wrap_class' => 'small-input sp-number-set-field',
				'before'     => '<span>' . $title['title1'] . '</span><br>',
				'help'       => $help['help1'],
				'attributes' => array(
					'min' => 1,
					'max' => 30,
				),
			) );
		}
		if ( isset( $this->field['number2'] ) && $this->field['number2'] == true ) {
			echo sp_wpsp_add_element( array(
				'pseudo'     => true,
				'type'       => 'number',
				'name'       => $this->element_name( '[number2]' ),
				'value'      => $value['number2'],
				'default'    => ( isset( $this->field['default']['number2'] ) ) ? $this->field['default']['number2'] : '',
				'wrap_class' => 'small-input sp-number-set-field',
				'before'     => '<span>' . $title['title2'] . '</span><br>',
				'help'       => $help['help2'],
				'attributes' => array(
					'min' => 1,
					'max' => 30,
				),
			) );
		}
		if ( isset( $this->field['number3'] ) && $this->field['number3'] == true ) {
			echo sp_wpsp_add_element( array(
				'pseudo'     => true,
				'type'       => 'number',
				'name'       => $this->element_name( '[number3]' ),
				'value'      => $value['number3'],
				'default'    => ( isset( $this->field['default']['number3'] ) ) ? $this->field['default']['number3'] : '',
				'wrap_class' => 'small-input sp-number-set-field',
				'before'     => '<span>' . $title['title3'] . '</span><br>',
				'help'       => $help['help3'],
				'attributes' => array(
					'min' => 1,
					'max' => 30,
				),
			) );
		}
		if ( isset( $this->field['number4'] ) && $this->field['number4'] == true ) {
			echo sp_wpsp_add_element( array(
				'pseudo'     => true,
				'type'       => 'number',
				'name'       => $this->element_name( '[number4]' ),
				'value'      => $value['number4'],
				'default'    => ( isset( $this->field['default']['number4'] ) ) ? $this->field['default']['number4'] : '',
				'wrap_class' => 'small-input sp-number-set-field',
				'before'     => '<span>' . $title['title4'] . '</span><br>',
				'help'       => $help['help4'],
				'attributes' => array(
					'min' => 1,
					'max' => 30,
				),
			) );
		}
		if ( isset( $this->field['number5'] ) && $this->field['number5'] == true ) {
			echo sp_wpsp_wpsp_add_element( array(
				'pseudo'     => true,
				'type'       => 'number',
				'name'       => $this->element_name( '[number5]' ),
				'value'      => $value['number5'],
				'default'    => ( isset( $this->field['default']['number5'] ) ) ? $this->field['default']['number5'] : '',
				'wrap_class' => 'small-input sp-number-set-field',
				'before'     => '<span>' . $title['title5'] . '</span><br>',
				'help'       => $help['help5'],
				'attributes' => array(
					'min' => 1,
					'max' => 30,
				),
			) );
		}

		echo $this->element_after();

	}

}
