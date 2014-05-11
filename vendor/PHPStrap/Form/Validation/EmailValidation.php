<?php

namespace PHPStrap\Form\Validation;

class EmailValidation implements InputValidation{
    
	private $errormessage;
	
	/**
	 * @param string $errormessage
	 * @param callback $validationFunction funcion with an argument (input value) that returns a boolean 
	 * @return void
	 */
	public function __construct($errormessage){
		$this->errormessage = $errormessage;
	}
	
    /**
     * @param string $inputValue
     * @return boolean
     */
    public function isValid($inputValue){
    	return filter_var($inputValue, FILTER_VALIDATE_EMAIL) !== FALSE;
    }
    
    /**
     * @return string
     */
    public function errorMessage(){
    	return $this->errormessage;
    }
	
}
?>