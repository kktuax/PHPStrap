<?php
namespace PHPStrap\Form;

final class FormType
{
    const Normal     = 0;
    const Inline     = 1;
    const Horizontal = 2;

    private function _construct()
    {
    }
}

class Form extends FormElement
{
    private $FormType, $LabelWidth = 2, $InputWidth = 10;
    private $Elements = array();
    private $ErrorMessage, $SucessMessage;
    private $Action, $Method;

    /**
     * @param string $Action
     * @param string $Method
     * @param int    $FormType
     * @param array  $Attribs
     *
     */
    public function __construct($Action = "", $Method = "POST", $FormType = FormType::Normal, $ErrorMessage = "Plase check the form", $SucessMessage = "Form received successfully", $Attribs = array()){
        $this->Attribs = $Attribs;
        $this->ErrorMessage = $ErrorMessage;
        $this->SucessMessage = $SucessMessage;
        $this->Action = $Action;
        $this->Method = $Method;
        $this->FormType = $FormType;
        if ($this->FormType === FormType::Horizontal) {
            $this->setAttributeDefaults(array('class' => 'form-horizontal'));
        }
        if ($this->FormType === FormType::Inline) {
            $this->setAttributeDefaults(array('class' => 'form-inline'));
        }
    }

    public function setId($id){
    	$this->setAttrib('id', $id);
    }
    
    public function setWidths($LabelWidth, $InputWidth){
        $this->LabelWidth = $LabelWidth;
        $this->InputWidth = $InputWidth;
    }
    
    public function setGlobalValidations($Validations = array()){
		$this->Validations = $Validations;
    }
    
    public function setSucessMessage($SucessMessage){
    	$this->SucessMessage = $SucessMessage;
    }

    public function setErrorMessage($ErrorMessage){
        $this->ErrorMessage = $ErrorMessage;
    }
    
    public function addFieldWithLabel($Field, $LabelText, $HelpText = ""){
    	if(!empty($HelpText)){
    		try{
    			$Field->withHelpText($HelpText);
    		}catch(Exception $e){
    			error_log("Help text cant be asigned to field of type " . get_class($Field));
    		}
    	}
    	$Label = $this->label($LabelText);
    	if($this->FormType !== FormType::Horizontal) {
    		$Label->setAttrib("class", 'control-label');
    	}
    	if($Field->hasAttrib("id")){
        	$Label->setAttrib("for", $Field->getAttrib("id"));
        }
    	$this->group($Field, $Label);
    }
    
    public function addSubmitButton($submitText = "Submit", $Attribs = array()){
    	$this->group(new Submit($submitText, $Attribs));
    }

    /**
     * @return $this
     */
    public function groupRow($FormElements, $Styles){
    	$groups = array();
    	for($i=0;$i<count($FormElements);$i++){
    		$this->addFormElement($FormElements[$i]);
    		$groups[] = $this->formGroup($FormElements[$i], '', $Styles[$i]);
    	}
    	$this->Code .= \PHPStrap\Util\Html::tag("div", implode($groups), array('row'));
    	return $this;
    }
    
    /**
     * @return $this
     */
    public function group($FormElement, $Label = ''){
		$this->addFormElement($FormElement);
        $this->Code .= $this->formGroup($FormElement, $Label);
		return $this;
    }

 	private function addFormElement($obj){
		$this->Elements[] = $obj;
		if(get_class($obj) === "PHPStrap\\Form\\File"){
			$this->setAttributeDefaults(array('enctype' => 'multipart/form-data'));	
		}
    }
    
    private function formGroup($FormElement, $Label = '', $extraStyles = array()){
    	$errorLabel = $this->errorLabel($FormElement);
		$styles = array_merge(array('form-group'), $extraStyles);
		if(!empty($errorLabel)){
			$styles[] = "has-error";
		}
		$content = $errorLabel . $FormElement;
		if($this->FormType === FormType::Horizontal){
			$content = \PHPStrap\Util\Html::tag("div", $content, $this->horizontalStyles($FormElement, $Label));
		}
		return \PHPStrap\Util\Html::tag("div", $Label . $content, $styles);
    }
    
    private function errorLabel($FormElement){
    	$errorLabel = '';
    	$errorMessage = $FormElement->errorMessage();
		if($errorMessage !== NULL){
			$errorLabel = $this->label($errorMessage, array('class' => 'control-label'));
			if($FormElement->hasAttrib("id")) {
	            $errorLabel->setAttrib("for", $FormElement->getAttrib("id"));
	        }
		}
		return $errorLabel;
    }
    
	private function horizontalStyles($FormElement, $Label){
    	if(empty($Label)) {
    		return (get_class($FormElement) === "PHPStrap\\Form\\Submit") ? 
    			array('col-sm-12') :
    			array('col-sm-offset-' . $this->LabelWidth, ' col-sm-' . $this->InputWidth);
		}else{
			return array('col-sm-' . $this->InputWidth);			
		}
    }
    
    private function label($Text, $Attribs = array(), $ScreenReaderOnly = false){
        return new Label($Text, $Attribs, $ScreenReaderOnly, $this->FormType, $this->LabelWidth);
    }

    /**
     * Defines hidden inputs within the form
     * Can accept a single array to create one input or a multidimensional array to create many inputs
     *
     * @param $Inputs        array        An array of arrays or an associative array that sets the inputs attributes
     *
     * @return Form
     */
    public function hidden($Inputs = array()){
        foreach ($Inputs as $i) {
            if (is_array($i)) {
                $this->Code .= '<input type="hidden"' . $this->parseAttribs($i) . ' />';
            } else {
                $this->Code .= '<input type="hidden"' . $this->parseAttribs($Inputs) . ' />';
                break;
            }
        }

        return $this;
    }
    
    private $validForm = NULL;
    
    public function submitedValues($namePrefix = NULL){
    	$values = array();
    	foreach($this->Elements as $el){
    		$val = $el->submitedValue();
    		if($val !== NULL){
    			$name = $el->getAttrib("name");
    			if(empty($name)){
    				continue;
    			}
    			if((!empty($namePrefix)) AND (!self::startsWith($name, $namePrefix))){
    				continue;
    			}
    			$values[$name] = $val;
    		}
    	}
    	return $values;
    }
    
    private static function startsWith($haystack, $needle){
    	return $needle === "" || strpos($haystack, $needle) === 0;
    }
    
    /**
     * @return boolean|NULL
     */
    public function isValid(){
    	if($this->validForm == NULL){
    		if(!empty($_POST)){
    			$anyValue = FALSE;
    			foreach($this->Elements as $el){
		    		if($el->submitedValue() !== NULL){
		    			$anyValue = TRUE;
		    		}
    			}
    			if($anyValue){
	    			$errors = $this->globalErrors();
		    		$this->validForm = empty($errors);
		    		if($this->validForm){
		    			foreach($this->Elements as $el){
			    			if(!$el->isValid()){
			    				$this->validForm = FALSE;
			    				break;
			    			}
			    		}
		    		}
    			}else{
    				$this->validForm = NULL;
    			}
	    	}else{
	    		$this->validForm = NULL;
	    	}
	    }
    	return $this->validForm;
    }
    
    private function fieldErrors(){
    	$errores = array();
    	foreach($this->Elements as $el){
    		if(!$el->isValid()){
    			$errores[] = $el->errorMessage();
    		}
		}
    	return $errores;
    }
    
    private function globalErrors(){
    	$errores = array();
    	foreach($this->Validations as $val){
			if(!$val->isValid($this)){
				$errores[] = $val->errorMessage();
			}
		}
    	return $errores;
    }
    
    /**
     * @return string
     */
    public function __toString(){
    	$messageCode = '';
    	$validForm = $this->isValid();
    	if($validForm !== NULL){
    		$divClass = $validForm ? 'alert alert-success' : 'alert alert-danger';
    		$divContent = $validForm ? $this->SucessMessage : $this->ErrorMessage;
    		if(!$validForm){
	    		$errors = $this->globalErrors();
	    		if(!empty($errors)){
	    			$divContent.= \PHPStrap\Util\Html::ul($errors);
	    		}
    		}
    		$messageCode .= '<div class="' . $divClass . '">' . $divContent . '</div> ';
    	}
    	if($validForm === TRUE){
    		return $messageCode;
    	}else{
    		$code = "";
    		if(!empty($this->previous_contents)){
    			$code .= implode($this->previous_contents);
    		}
    		$code .= '<form role="form" action="' . $this->Action . '" method="' . $this->Method . '"';
        	$code .= $this->parseAttribs($this->Attribs) . '>';
    		$code .= $messageCode . $this->Code . "</form>";
    		return $code;
    	}
    }
    
	private $previous_contents = array();
	
	public function addPreviousContent($Content){
		$this->previous_contents[] = $Content;
	}
    
}
