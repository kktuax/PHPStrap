<?php

namespace PHPStrap\Form\Validation;

class NumericValidation extends BaseValidation implements InputValidation{
    
	public function __construct($errormessage = "Field must be numeric")
    {
        parent::__construct($errormessage);
    }
    
    /**
     * @param string $inputValue
     * @return boolean
     */
    public function isValid($inputValue){
    	return is_numeric(trim($inputValue));
    }
 
}
?>