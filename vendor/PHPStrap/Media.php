<?php

namespace PHPStrap;

class Media{
	
	private $Heading;
	private $Content;
	private $Img, $ImgHref;
	private $type;
	private $styles = array('media');
	
	public function addStyle($styleName){
		$this->styles[] = $styleName;
	}
	
	public function __construct($Heading, $Content, $Img, $ImgHref = "#", $type = "list"){
		$this->Heading = $Heading;
		$this->Content = $Content;
		$this->Img = $Img;
		$this->ImgHref = $ImgHref;
		$this->type = $type;
	}
	
	public function __toString(){
 		return Util\Html::tag($this->type == "list" ? "li" : "div", 
 			$this->imageLink() . $this->body(), 
 			$this->styles
 		);
    }
    
    private function imageLink(){
    	return Util\Html::tag("a", $this->Img, array('pull-left'), array('href' => $this->ImgHref));
    }
    
	public static function image($src, $alt = '', $extraStyles = array()){
		return Util\Html::tag("img", '', array_merge(array('media-object'), $extraStyles), array('src' => $src, 'alt' => $alt));
	}
	
	private function body(){
		return Util\Html::tag("div",
			Util\Html::tag("h4", $this->Heading, array('media-heading')) . $this->Content, 
			array('media-body')
		);
	}
       
}

?>
