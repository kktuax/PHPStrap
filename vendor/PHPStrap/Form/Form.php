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
    public function __construct($Action = "", $Method = "POST", $FormType = FormType::Normal, $ErrorMessage = "Plase check the form", $SucessMessage = "Form received successfully", $Attribs = array())
    {
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

    public function setWidths($LabelWidth, $InputWidth)
    {
        $this->LabelWidth = $LabelWidth;
        $this->InputWidth = $InputWidth;
    }
    
    public function setGlobalValidations($Validations = array())
    {
		$this->Validations = $Validations;
    }
    
    public function setSucessMessage($SucessMessage)
    {
    	$this->SucessMessage = $SucessMessage;
    }

    public function setErrorMessage($ErrorMessage)
    {
        $this->ErrorMessage = $ErrorMessage;
    }
    
    /**
     * @return $this
     */
    public function group()
    {
        $Args     = func_get_args();
        $ArgCount = sizeof($Args);
        $Start    = 0;

	    for ($i = $Start; $i < $ArgCount; $i++) {
			$obj = $Args[$i];
			$this->Elements[] = $obj;
			if(get_class($obj) === "PHPStrap\\Form\\File"){
				$this->setAttributeDefaults(array('enctype' => 'multipart/form-data'));	
			}
		}
        
		$lastElement = $Args[$ArgCount-1];
		$errorMessage = $lastElement->errorMessage();
		$errorClass = "";
		$errorLabel = FALSE;
		if($errorMessage !== NULL){
			$errorClass = " has-error";
			$errorLabel = $this->label($errorMessage);
			if($lastElement->hasAttrib("id")) {
	            $errorLabel->setAttrib("for", $lastElement->getAttrib("id"));
	            $errorLabel->setAttrib("class", 'control-label');
	        }
		}
		
		$this->Code .= '<div class="form-group' . $errorClass . '">';
        
    	if ($ArgCount === 2){
			// Add the "for" attribute for inputs if there is only 1 and it has an id
        	if($Args[1]->hasAttrib("id")){
        		$Args[0]->setAttrib("for", $Args[1]->getAttrib("id"));
        	}
        	$this->Code .= $Args[0];
    	}
		
		if ($this->FormType === FormType::Horizontal) {
			$divClass = 'col-sm-' . $this->InputWidth;
			if ($ArgCount === 1) {
				$divClass = (get_class($Args[0]) === "PHPStrap\\Form\\Submit") ? 'col-sm-12' : 'col-sm-offset-' . $this->LabelWidth . ' col-sm-' . $this->InputWidth;
			}
			$this->Code .= '<div class="' . $divClass . '">';
		}
		
        if($errorLabel !== FALSE){
        	$this->Code .= $errorLabel;
        }
        $this->Code .= $lastElement;
        
		if ($this->FormType === FormType::Horizontal) {
			$this->Code .= '</div> ';
		}
		
        $this->Code .= '</div> ';
        
        return $this;
    }

    /**
     * Generates the HTML required for a label
     *
     * @param string $Text
     * @param array  $Attribs
     * @param bool   $ScreenReaderOnly
     *
     * @return Label
     */
    public function label($Text, $Attribs = array(), $ScreenReaderOnly = false)
    {
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
    public function hidden($Inputs = array())
    {
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
    		$code = '<form role="form" action="' . $this->Action . '" method="' . $this->Method . '"';
        	$code .= $this->parseAttribs($this->Attribs) . '>';
    		$code .= $messageCode . $this->Code . "</form>";
    		return $code;
    	}
    }
    
}
