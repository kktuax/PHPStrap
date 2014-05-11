<?php
namespace PHPStrap;

class Panel{
	
	private $Contents, $Headers;
	
	public function __construct($Content = ""){
		$this->Contents = array($Content);
		$this->Headers = array();
	}
	
	public function addContent($Content){
		$this->Contents[] = $Content;
	}
	
	public function addHeader($Content){
		$this->Headers[] = $Content;
	}
	
 	public function __toString(){
 		$header = !empty($this->Headers) ? 
 			Util\Html::tag("div", implode($this->Headers), array('panel-heading')) : 
 			""
 		; 
 		return Util\Html::tag("div",
			$header . Util\Html::tag("div",
				implode($this->Contents), 
				array('panel-body')
			),
			array('panel', 'panel-default')
		);
    }
	
}
?>