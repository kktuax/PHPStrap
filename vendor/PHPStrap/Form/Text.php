<?php
namespace PHPStrap\Form;

class Text extends GeneralInput  implements Validable{
    
	public function __construct($Attribs = array(), $Validations = array()){
        $this->Attribs = $Attribs;
        $this->Validations = $Validations;
        $this->setAttributeDefaults(array('class' => 'form-control'));

        $value = $this->submitedValue();
    	if($value !== NULL){
    		$this->setAttrib('value', $value);
    	}
        
        parent::__construct('text', $this->Attribs);
    }

    public static function withNameAndValue($Name, $Value = '', $Maxlength = 255, $Validations = array()){
    	$FieldValidations = ($Maxlength > 0) ? 
    		array_merge($Validations, array(new Validation\LengthValidation($Maxlength))) :
    		$Validations;
    	return new Text(
			array('name' => $Name, 'maxlength' => $Maxlength, 'value' => $Value),
			$FieldValidations
		);
    }
    
}
