<?php
namespace JasonKaz\FormBuild;

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
    private $ErrorMessage = "Plase check the form", $SucessMessage = "Form received successfully";

    /**
     * @param string $Action
     * @param string $Method
     * @param int    $FormType
     * @param array  $Attribs
     *
     * @return $this
     */
    public function init($Action = "#", $Method = "POST", $FormType = FormType::Normal, $Attribs = array())
    {
        $this->Attribs = $Attribs;
        $this->Code    = '<form role="form" action="' . $Action . '" method="' . $Method . '"';

        $this->FormType = $FormType;

        if ($this->FormType === FormType::Horizontal) {
            $this->setAttributeDefaults(array('class' => 'form-horizontal'));
        }

        if ($this->FormType === FormType::Inline) {
            $this->setAttributeDefaults(array('class' => 'form-inline'));
        }

        $this->Code .= $this->parseAttribs($this->Attribs) . '>';

        return $this;
    }

    /**
     * @param $LabelWidth
     * @param $InputWidth
     */
    public function setWidths($LabelWidth, $InputWidth)
    {
        $this->LabelWidth = $LabelWidth;
        $this->InputWidth = $InputWidth;
    }
    
	/**
     * @param $LabelWidth
     * @param $InputWidth
     */
    public function setMessages($ErrorMessage, $SucessMessage)
    {
        $this->ErrorMessage = $ErrorMessage;
    	$this->SucessMessage = $SucessMessage;
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
        	$this->Code .= $Args[0]->render();
    	}
		
		if ($this->FormType === FormType::Horizontal) {
			$divClass = 'col-sm-' . $this->InputWidth;
			if ($ArgCount === 1) {
				$divClass = (get_class($Args[0]) === "JasonKaz\\FormBuild\\Submit") ? 'col-sm-12' : 'col-sm-offset-' . $this->LabelWidth . ' col-sm-' . $this->InputWidth;
			}
			$this->Code .= '<div class="' . $divClass . '">';
		}
		
        if($errorLabel !== FALSE){
        	$this->Code .= $errorLabel->render();
        }
        $this->Code .= $lastElement->render();
        
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
    
    /**
     * @return boolean|NULL
     */
    public function isValid(){
    	if(!empty($_POST)){
    		foreach($this->Elements as $el){
    			if(!$el->isValid()){
    				return FALSE;
    			}
    		}
    		return TRUE;
    	}
    	return NULL;
    }
    
    /**
     * @return string
     */
    public function render()
    {
    	$messageCode = '';
    	$validForm = $this->isValid();
    	if($validForm !== NULL){
    		$divClass = $validForm ? 'alert alert-success' : 'alert alert-danger';
    		$divContent = $validForm ? $this->SucessMessage : $this->ErrorMessage;
        	$messageCode .= '<div class="' . $divClass . '">' . $divContent . '</div> ';
    	}
    	if($validForm === TRUE){
    		return $messageCode;
    	}else{
    		return $messageCode . $this->Code;
    	}
    }
    
}
