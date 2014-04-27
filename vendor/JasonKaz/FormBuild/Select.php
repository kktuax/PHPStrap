<?php


namespace JasonKaz\FormBuild;


class Select extends FormElement implements Validable
{
    public function __construct($Options = array(), $SelectedOption = null, $Attribs = array(), $Validations = array())
    {
        $this->Attribs = $Attribs;
        $this->Validations = $Validations;
        $this->setAttributeDefaults(array('class' => 'form-control'));

        $this->Code .= '<select';
        $this->Code .= $this->parseAttribs($this->Attribs);
        $this->Code .= '>';

    	$value = $this->submitedValue();
    	if($value !== NULL){
    		$SelectedOption = $value;
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
