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
    
    public function addHrefButton($Text, $Link){
    	$this->Code .= " " . \PHPStrap\Util\Html::tag("a",
			$Text, array('btn', 'btn-default'), array("href" => $Link)
		); 
    }
    
}