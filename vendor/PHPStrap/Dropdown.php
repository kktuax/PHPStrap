<?php

namespace PHPStrap;

class Dropdown{
	
	private $Header, $Items = array();
	private $Type;
	private $Active;
	
	public function __construct($Text, $Active = FALSE, $Type = "link"){
		if($Type == "link"){
			$this->Header = $this->linkHeader($Text);
		}else if($Type == "button"){
			$this->Header = $this->buttonHeader($Text);
		}
		$this->Type = $Type;
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
 		$html = $this->Header . Util\Html::tag("ul", implode($this->Items), array('dropdown-menu'));
 		if($this->Type == 'button'){
 			return Util\Html::tag("div", $html, array('dropdown'));
 		}else{
 			return $html;
 		}
    }
    
    private function linkHeader($Text){
    	return Util\Html::tag("a", 
    		$Text . ' ' . Util\Html::tag("b", '', array('caret')),
    		array('dropdown-toggle'), array('href' => '#', 'data-toggle' => 'dropdown')
    	);
    }

	private function buttonHeader($Text){
		return Util\Html::tag("button", 
			$Text . ' ' . Util\Html::tag("span", '', array('caret')), 
			array('btn', 'btn-default', 'dropdown-toggle'), 
			array('data-toggle' => 'dropdown')
		);
    }
       
}

?>
