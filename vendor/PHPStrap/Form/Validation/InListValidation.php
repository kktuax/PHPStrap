<?php

namespace PHPStrap\Form\Validation;

class InListValidation extends BaseValidation implements InputValidation{
    
	private $validValues;
	
	/**
	 * @param string $errormessage
	 * @param array $validValues
	 * @return void
	 */
	public function __construct($errormessage = "Invalid value", $validValues = array())
    {
        $this->validValues = $validValues;
        parent::__construct($errormessage);
    }
    
    /**
     * @param string $inputValue
     * @return boolean
     */
    public function isValid($inputValue){
     	return in_array($inputValue, $this->validValues, false);
    }
    
}
?>