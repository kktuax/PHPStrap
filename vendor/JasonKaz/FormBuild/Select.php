<?php


namespace JasonKaz\FormBuild;


class Select extends FormElement
{
    public function __construct($Options = array(), $SelectedOption = null, $Attribs = array())
    {
        $this->Attribs = $Attribs;
        $this->setAttributeDefaults(array('class' => 'form-control'));

        $this->Code .= '<select';
        $this->Code .= $this->parseAttribs($this->Attribs);
        $this->Code .= '>';

        if($this->hasAttrib("name")){
        	if(isset($_POST[$this->getAttrib("name")])){
        		$SelectedOption = $_POST[$this->getAttrib("name")];
        	}
        }
        
        //Convert $SelectedOption to array if necessary
        if (!is_array($SelectedOption)) {
            $SelectedOption = (array)$SelectedOption;
        }

        foreach ($Options as $key => $val) {
            $this->Code .= '<option value="' . $key . '"';

            if (in_array($key, $SelectedOption, false)) {
                $this->Code .= ' selected';
            }

            $this->Code .= '>' . $val . '</option>';
        }

        $this->Code .= '</select>';
    }
}
