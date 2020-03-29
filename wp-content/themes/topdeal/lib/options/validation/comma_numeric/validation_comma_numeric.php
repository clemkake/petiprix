<?php
class Topdeal_Validation_comma_numeric extends Topdeal_Options{	
	
	/**
	 * Field Constructor.
	 *
	 * Required - must call the parent constructor, then assign field and value to vars, and obviously call the render field function
	 *
	 * @since Topdeal_Options 1.0
	*/
	function __construct($field, $value, $current){
		
		parent::__construct();
		$this->field = $field;
		$this->field['msg'] = (isset($this->field['msg']))?$this->field['msg']:esc_html__('You must provide a comma seperated list of numerical values for this option.', 'topdeal');
		$this->value = $value;
		$this->current = $current;
		$this->validate();
		
	}//function
	
	
	
	/**
	 * Field Render Function.
	 *
	 * Takes the vars and outputs the HTML for the field in the settings
	 *
	 * @since Topdeal_Options 1.0
	*/
	function validate(){
		
		$this->value = str_replace(' ', '', $this->value);
		
		if(!is_numeric(str_replace(',', '',$this->value))){
			$this->value = (isset($this->current))?$this->current:'';
			$this->error = $this->field;
		}
		
	}//function
	
}//class
?>