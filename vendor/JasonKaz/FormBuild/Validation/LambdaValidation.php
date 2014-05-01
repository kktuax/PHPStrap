<?php

namespace JasonKaz\FormBuild\Validation;

class LambdaValidation implements InputValidation{
    
	private $errormessage;
	
	private $validFunction;
	
	/**
	 * @param string $errormessage
	 * @param callback $validationFunction funcion with an argument (input value) that returns a boolean 
	 * @return void
	 */
	public function __construct($errormessage, $validationFunction){
		$this->errormessage = $errormessage;
		$this->validFunction = $validationFunction;
	}
	
    /**
     * @param string $inputValue
     * @return boolean
     */
    public function isValid($inputValue){
    	$fun = $this->validFunction;
    	return $fun($inputValue);
    }
    
    /**
     * @return string
     */
    public function errorMessage(){
    	return $this->errormessage;
    }
	
}
?>