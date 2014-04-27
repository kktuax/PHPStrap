<?php
namespace JasonKaz\FormBuild;

class Text extends GeneralInput
{
    public function __construct($Attribs = array())
    {
        $this->Attribs = $Attribs;
        $this->setAttributeDefaults(array('class' => 'form-control'));

    	if($this->hasAttrib("name")){
        	if(isset($_POST[$this->getAttrib("name")])){
        		$this->setAttrib('value', $_POST[$this->getAttrib("name")]);
        	}
        }
        
        parent::__construct('text', $this->Attribs);
    }
}
