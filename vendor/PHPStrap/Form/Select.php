<?php
namespace PHPStrap\Form;

class Select extends FormElement implements Validable{
	
	private $Options;
	private $SelectedOption;
	 	
    public function __construct($Options = array(), $SelectedOption = NULL, $Attribs = array(), $Validations = array()){
        $this->Attribs = $Attribs;
        $this->Validations = $Validations;
        $this->setAttributeDefaults(array('class' => 'form-control'));
        $this->Options = $Options;
        $this->SelectedOption = $SelectedOption;       
	}
	
	/**
	 * @param String $name of the input form element
	 * @param array $Options array (keys will act as data and values will be displayed) 
	 * @param String $SelectedOption
	 * @param array $validOptions allowed select keys (if absent, all will be valid options) 
	 * @return unknown_type
	 */
	public static function withNameAndOptions($name, $Options, $SelectedOption = NULL, $validOptions = NULL){
		if(empty($validOptions)){
			$validOptions = array_keys($Options);
		}
		return new Select(
			$Options, $SelectedOption, 
			array('name' => $name), 
			array(new Validation\InListValidation("Required field", $validOptions))
		);
	}
	
	/**
	 * @param String $name of the input form element
	 * @param array $Options vector array (keys and values are the same) 
	 * @param String $SelectedOption
	 * @param array $validOptions allowed select keys (if absent, all will be valid options)
	 * @return unknown_type
	 */
	public static function withNameAndSimpleOptions($name, $Options, $SelectedOption = NULL, $validOptions = NULL){
		if(empty($validOptions)){
			$validOptions = $Options;
		}
		return new Select(
			array_combine($Options, $Options), $SelectedOption, 
			array('name' => $name), 
			array(new Validation\InListValidation("Required field", $validOptions))
		);
	}
	
	/**
     * @return string
     */
    public function __toString(){
    	$code = '<select';
        $code .= $this->parseAttribs($this->Attribs);
        $code .= '>';

    	$value = $this->submitedValue();
    	if($value !== NULL){
    		$this->SelectedOption = $value;
    	}
        
        //Convert $SelectedOption to array if necessary
        if (!is_array($this->SelectedOption)) {
            $this->SelectedOption = (array)$this->SelectedOption;
        }

        foreach ($this->Options as $key => $val) {
            $code .= '<option value="' . $key . '"';
            if (in_array($key, $this->SelectedOption, false)) {
                $code .= ' selected="selected"';
            }
            $code .= '>' . $val . '</option>';
        }

        $code .= '</select>';
    	$code .= $this->helpTextSpan();
        return $code;
    }
	
}
