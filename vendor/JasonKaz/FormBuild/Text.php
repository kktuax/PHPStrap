<?php
namespace JasonKaz\FormBuild;

class Text extends GeneralInput  implements Validable
{
    public function __construct($Attribs = array(), $Validations = array())
    {
        $this->Attribs = $Attribs;
        $this->Validations = $Validations;
        $this->setAttributeDefaults(array('class' => 'form-control'));

        $value = $this->submitedValue();
    	if($value !== NULL){
    		$this->setAttrib('value', $value);
    	}
        
        parent::__construct('text', $this->Attribs);
    }
}
