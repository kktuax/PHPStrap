<?php
namespace JasonKaz\FormBuild;

class FormElement implements Validable
{
    protected $Code = "", $Attribs = array(), $Validations = array();

	/**
     * @return boolean
     */
    public function isValid()
    {
    	$value = $this->submitedValue();
    	if($value !== NULL){
    		foreach($this->Validations as $val){
				if(!$val->isValid($value)) return FALSE;
			}
    	}
    	return TRUE;
    }
    
	/**
     * @return string with error message (NULL if no error present)
     */
    public function errorMessage()
    {
    	$value = $this->submitedValue();
    	if($value !== NULL){
			foreach($this->Validations as $val){
				if(!$val->isValid($value)){
					return $val->errorMessage();
				}
			}
    	}
    	return NULL;
    }
    
    protected function submitedValue(){
    	if($this->hasAttrib("name")){
        	if(isset($_POST[$this->getAttrib("name")])){
        		return $_POST[$this->getAttrib("name")];
        	}
    	}
    	return NULL;
    }
    
    /**
     * @return string
     */
    public function render()
    {
        return $this->Code;
    }

    /**
     * @param $DefaultAttribs
     *
     * @return array
     */
    protected function setAttributeDefaults($DefaultAttribs){
        foreach($DefaultAttribs as $k=>$v){
            if (!array_key_exists($k, $this->Attribs)){
                $this->Attribs[$k]=$v;
            }else{
                $this->Attribs[$k].=' '.$v;
            }
        }

        return $this->Attribs;
    }

    /**
     * @param $Attrib
     *
     * @return bool
     */
    protected function hasAttrib($Attrib)
    {
        return isset($this->Attribs[$Attrib]) && $this->Attribs[$Attrib] != "";
    }

    /**
     * @param $Attrib
     *
     * @return mixed
     */
    protected function getAttrib($Attrib)
    {
        return $this->Attribs[$Attrib];
    }

    /**
     * @param $Attrib
     * @param $Value
     */
    protected function setAttrib($Attrib, $Value)
    {
        $this->Attribs[$Attrib] = $Value;
    }

    /**
     * @param $Attrib
     * @param $Value
     */
    protected function addAttrib($Attrib, $Value)
    {
        $this->Attribs[$Attrib] .= " " . $Value;
    }
    
    protected function parseAttribs($Attribs = array())
    {
        $Str = "";

        $Properties = array('disabled', 'readonly', 'multiple', 'checked', 'required', 'autofocus');

        foreach ($Attribs as $key => $val) {
            if (in_array($key, $Properties)) {
                if ($val === true) {
                    $Str .= ' ' . strtolower($key);
                }
            } else {
                $Str .= ' ' . $key . '="' . $val . '"';
            }
        }

        return $Str;
    }
    
}
