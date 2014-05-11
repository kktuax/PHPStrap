<?php
namespace PHPStrap\Form;

class File extends GeneralInput implements Validable
{
    public function __construct($Attribs = array(), $Validations = array())
    {
        $this->Attribs = $Attribs;
        $this->Validations = $Validations;

        parent::__construct('file', $this->Attribs);
    }
    
    public function submitedValue(){
    	if($this->hasAttrib("name")){
    		if(isset($_FILES) AND isset($_FILES[$this->getAttrib("name")])){
    			if($_FILES[$this->getAttrib("name")]['size'] > 0){
    				return $_FILES[$this->getAttrib("name")];
    			}
        	}
    	}
    	return NULL;
    }
    
}
