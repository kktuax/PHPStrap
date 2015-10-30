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
	
	private $styles = array('panel', 'panel-default');
	
	public function addStyle($styleName){
		$this->styles[] = $styleName;
	}
	
	private $bodyStyles = array('panel-body');
	
	public function addBodyStyle($styleName){
		$this->bodyStyles[] = $styleName;
	}
	
	private $headingStyles = array('panel-heading');
	
	public function addHeadingStyle($styleName){
		$this->headingStyles[] = $styleName;
	}
	
 	public function __toString(){
 		$header = !empty($this->Headers) ? 
 			Util\Html::tag("div", implode($this->Headers), $this->headingStyles) : 
 			""
 		; 
 		return Util\Html::tag("div",
			$header . Util\Html::tag("div",
				implode($this->Contents), 
				$this->bodyStyles
			),
			$this->styles
		);
    }
	
}
?>