<?php

namespace JasonKaz\FormBuild\Validation;

class InListValidation implements InputValidation{
    
	private $errormessage, $validValues;
	
	/**
	 * @param string $errormessage
	 * @param array $validValues
	 * @return void
	 */
	public function __construct($errormessage = "Invalid value", $validValues = array())
    {
        $this->errormessage = $errormessage;
        $this->validValues = $validValues;
    }
    
    /**
     * @param string $inputValue
     * @return boolean
     */
    public function isValid($inputValue){
     	return in_array($inputValue, $this->validValues, false);
    }
    
    /**
     * @return string
     */
    public function errorMessage(){
    	return $this->errormessage;
    }
 
}
?>