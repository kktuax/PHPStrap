<?php


namespace JasonKaz\FormBuild;


class Textarea extends FormElement implements Validable
{
    public function __construct($Content ='', $Attribs = array(), $Validations = array())
    {
        $this->Attribs = $Attribs;
        $this->Validations = $Validations;
        $this->setAttributeDefaults(array('class' => 'form-control'));

    	$value = $this->submitedValue();
    	if($value !== NULL){
    		$Content = $value;
    	}
        
        $this->Code = '<textara' . $this->parseAttribs($this->Attribs) . '>'.$Content.'</textarea>';
    }
}
