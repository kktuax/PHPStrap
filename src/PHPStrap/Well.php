<?php
namespace PHPStrap;

class Well{
	
	private $Content, $Styles;
	
	public function __construct($Content = "", $Styles = array()){
		$this->Content = $Content;
		$this->Styles = array_merge(array('well'), $Styles);
	}
	
 	public function __toString(){
 		return Util\Html::tag("div",
			$this->Content, 
			$this->Styles
		);
    }
    
    public static function smallWell($Content = ""){
    	return new Well($Content, array('well-sm'));
    }
    
    public static function bigWell($Content = ""){
    	return new Well($Content, array('well-lg'));
    }
	
}
?>