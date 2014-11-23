<?php
namespace PHPStrap;

class PageHeader{
	
	private $Title, $Subtitle, $Styles, $SubtitleStyles;
	
	public function __construct($Title = "", $Subtitle = "", $Styles = array(), $SubtitleStyles = array()){
		$this->Title = $Title;
		$this->Subtitle = $Subtitle;
		$this->SubtitleStyles = $SubtitleStyles;
		$this->Styles = array_merge(array('page-header'), $Styles);
	}
	
 	public function __toString(){
 		$elements = array($this->Title);
 		if(!empty($this->Subtitle)){
 			$elements[] = Util\Html::tag("small", $this->Subtitle, $this->SubtitleStyles);
 		}
 		return Util\Html::tag("div",
			Util\Html::tag("h1",implode(" ", $elements)), 
			$this->Styles
		);
    }
    
}
?>