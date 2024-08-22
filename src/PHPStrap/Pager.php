<?php
namespace PHPStrap;

class Pager{
	
	private $Items = array(), $Styles;
	
	public function __construct($Styles = array()){
		$this->Styles = array_merge(array('pager'), $Styles);
	}
	
	public function addItem($Content = "", $Href = "#", $Disabled = FALSE){
		$this->addStyledItem($Content, $Href, $this->styles(array(), $Disabled));
	}
	
	public function addPreviousItem($Content = "", $Href = "#", $Disabled = FALSE){
		$this->addStyledItem('&larr; ' . $Content, $Href, $this->styles(array('previous'), $Disabled));
	}
	
	public function addNextItem($Content = "", $Href = "#", $Disabled = FALSE){
		$this->addStyledItem($Content . ' &rarr;', $Href, $this->styles(array('next'), $Disabled));
	}
	
	private function addStyledItem($Content = "", $Href = "#", $Styles = array()){
		$this->Items[] = Util\Html::tag("li", 
			Util\Html::tag("a", $Content, array(), array("href" => $Href)), 
			$Styles
		); 
	}
	
	private static function styles($Styles = array(), $Disabled = FALSE){
		$styles = $Styles;
		if($Disabled){
			$styles[] = 'disabled';
		}
		return $styles;
	}
	
 	public function __toString(){
 		return Util\Html::tag("ul",
			implode("\n", $this->Items), 
			$this->Styles
		);
    }
    
    public static function previousPager($Content = "", $Href = "#", $Disabled = FALSE){
    	$pager = new Pager();
    	$pager->addPreviousItem($Content, $Href, $Disabled);
    	return $pager;
    }
    
	public static function nextPager($Content = "", $Href = "#", $Disabled = FALSE){
    	$pager = new Pager();
    	$pager->addNextItem($Content, $Href, $Disabled);
    	return $pager;
    }
    
}
?>