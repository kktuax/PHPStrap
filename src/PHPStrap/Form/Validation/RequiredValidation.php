<?php

namespace PHPStrap\Form\Validation;

class RequiredValidation extends BaseValidation implements InputValidation{
    
	public function __construct($errormessage = "Required field")
    {
        parent::__construct($errormessage);
    }
    
    /**
     * @param string $inputValue
     * @return boolean
     */
    public function isValid($inputValue){
    	return strlen(trim($inputValue)) > 0;
    }
 
}
?>