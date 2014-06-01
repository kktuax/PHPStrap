<?php

namespace PHPStrap;

class Dropdown{
	
	private $Text, $Items = array();
	
	private $Active;
	
	public function __construct($Text, $Active = FALSE){
		$this->Text = $Text;
		$this->Active = $Active;
	}
	
	public function addItem($Content = ""){
		$this->Items[] = Util\Html::tag("li", $Content);
	}
	
	public function addHeader($Content = ""){
		$this->Items[] = Util\Html::tag("li", $Content, array('dropdown-header'));
	}
	
	public function addDivider(){
		$this->Items[] = Util\Html::tag("li", '', array('divider'));
	}
	
 	public function __toString(){
        return Util\Html::tag("li", 
        	$this->header() . Util\Html::tag("ul", implode($this->Items), array('dropdown-menu')), 
        	$this->Active ? 
        		array('dropdown', 'active') : 
        		array('dropdown')
        );
    }
    
    private function header(){
    	return Util\Html::tag("a", 
    		$this->Text . ' ' . Util\Html::tag("b", '', array('caret')),
    		array('dropdown-toggle'), array('href' => '#', 'data-toggle' => 'dropdown')
    	);
    }
	
}

?>
