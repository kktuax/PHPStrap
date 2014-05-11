<?php
namespace PHPStrap;

class Icon{
	
	private $Icon;
	
	public function __construct($Icon){
		$this->Icon = $Icon;
	}
	
 	public function __toString(){
        return Util\Html::tag("span", '', array('glyphicon', 'glyphicon-' . $this->Icon));
    }
	
    public static function button($Icon, $Content = '', $Href = "#", $styles = array()){
    	return Util\Html::tag("a",
    		Util\Html::tag("button", new Icon($Icon) . ' ' . $Content, array_merge(array('btn', 'btn-default'), $styles)), 
    		array(), array("href" => $Href));
    	return Util\Html::tag("span", '', array('glyphicon', 'glyphicon-' . $this->Icon));
    }
    
}
?>