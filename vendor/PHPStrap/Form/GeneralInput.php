<?php
namespace PHPStrap\Form;

/**
 * Creates a general input using the following HTML:
 *    <input type="[input type]" />
 */
class GeneralInput extends FormElement{
	
    protected function __construct($Type, $Attribs = array())    {
        $this->Attribs = $Attribs;
        $this->Type = $Type;
    }
    
    private $Type, $Help = NULL, $previousElements = array();
    
    public function withHelpText($Help){
    	$this->Help = $Help;
    }
    
	public function withPreviousElement($previousElement){
    	$this->previousElements[] = $previousElement;
    }
    
    /**
     * @return string
     */
    public function __toString(){
    	$code = implode($this->previousElements);
    	$code .= '<input type="' . $this->Type . '"' . $this->parseAttribs($this->Attribs) . ' />';
    	if($this->Help != NULL){
    		$code .= \PHPStrap\Util\Html::tag("span", $this->Help, array('help-block'));
    	}
    	return $code;
    }
    
}

