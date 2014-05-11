<?php

namespace PHPStrap\Form\Validation;

class EmailValidation extends BaseValidation implements InputValidation{
	
	/**
	 * @param string $errormessage 
	 * @return void
	 */
	public function __construct($errormessage){
		parent::__construct($errormessage);
	}
	
    /**
     * @param string $inputValue
     * @return boolean
     */
    public function isValid($inputValue){
    	return filter_var($inputValue, FILTER_VALIDATE_EMAIL) !== FALSE;
    }
    
}
?>