<?php 
namespace PHPStrap\Form\Validation;

class BaseValidation{
    
	protected $errormessage;
	
	/**
	 * @param string $errormessage 
	 * @return void
	 */
	public function __construct($errormessage){
		$this->errormessage = $errormessage;
	}
	
	/**
     * @return string
     */
    public function errorMessage(){
    	return $this->errormessage;
    }
	
}
?>