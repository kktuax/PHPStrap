<?php


namespace PHPStrap\Form;


class Textarea extends FormElement implements Validable
{
	
	private $Content;
	
    public function __construct($Content = '', $Attribs = array(), $Validations = array())
    {
        $this->Attribs = $Attribs;
        $this->Validations = $Validations;
        $this->setAttributeDefaults(array('class' => 'form-control'));

    	$value = $this->submitedValue();
    	if($value !== NULL){
    		$Content = $value;
    	}
        $this->Content = $Content;
    }
    
    /**
     * @return string
     */
    public function render(){
    	return '<textarea' . $this->parseAttribs($this->Attribs) . '>'.$this->Content.'</textarea>';
    }
    
}
