<?php


namespace JasonKaz\FormBuild;


class Checkbox extends FormElement
{
    public function __construct($Text, $defaultChecked = FALSE, $Inline = FALSE, $Attribs = array())
    {
        $this->Attribs=$Attribs;

        if ($Inline===TRUE){
            $this->Code.='<label class="checkbox-inline"';
        }else{
            $this->Code.='<div class="checkbox"><label';
        }

        $checked = $defaultChecked;
        if($this->hasAttrib("name") && $this->hasAttrib("value")){
        	if(isset($_POST[$this->getAttrib("name")])){
        		$checked = strcmp($_POST[$this->getAttrib("name")], $this->getAttrib("value")) === 0;
        	}
        }
        if($checked === TRUE){
        	$this->setAttrib('checked', TRUE);
        }
        $this->Code.='><input type="checkbox"' . $this->parseAttribs($this->Attribs) . ' /> ' . $Text.'</label>';

        if ($Inline===FALSE){
            $this->Code.='</div> ';
        }

    }
}
