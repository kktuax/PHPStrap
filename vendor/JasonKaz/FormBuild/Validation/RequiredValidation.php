<?php

namespace JasonKaz\FormBuild\Validation;

class RequiredValidation implements InputValidation{
    
	private $errormessage;
	
	public function __construct($errormessage = "Required field")
    {
        $this->errormessage = $errormessage;
    }
    
    /**
     * @param string $inputValue
     * @return boolean
     */
    public function isValid($inputValue){
    	return strlen(trim($inputValue)) > 0;
    }
    
    /**
     * @return string
     */
    public function errorMessage(){
    	return $this->errormessage;
    }
 
}
?>