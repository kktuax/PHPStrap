<?php

namespace PHPStrap\Form\Validation;

class LambdaValidation extends BaseValidation implements InputValidation{
    
	private $validFunction;
	
	/**
	 * @param string $errormessage
	 * @param callback $validationFunction funcion with an argument (input value) that returns a boolean 
	 * @return void
	 */
	public function __construct($errormessage, $validationFunction){
		$this->validFunction = $validationFunction;
		parent::__construct($errormessage);
	}
	
    /**
     * @param string $inputValue
     * @return boolean
     */
    public function isValid($inputValue){
    	$fun = $this->validFunction;
    	return $fun($inputValue);
    }
    
}
?>