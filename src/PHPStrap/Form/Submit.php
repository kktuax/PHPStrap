<?php
namespace PHPStrap\Form;

class Submit extends FormElement
{
	
	private $Text;
	
    public function __construct($Text, $Attribs = array())
    {
        $this->Attribs = $Attribs;
        $this->Text = $Text;
        $this->setAttributeDefaults(array('class' => 'btn btn-default'));
    	$this->Code .= '<button type="submit"' . $this->parseAttribs($this->Attribs) . '>' . $this->Text . '</button>';
    }
    
    public function addHrefButton($Text, $Link, $styles = array()){
    	$this->Code .= " " . \PHPStrap\Util\Html::tag("a",
			$Text, 
    		array_merge(array('btn', 'btn-default'), $styles), 
    		array("href" => $Link)
		); 
    }
    
}