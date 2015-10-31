<?php
namespace PHPStrap;

class Breadcrumb{
	
	private $items = array();

	private $Styles = array();
	
	public function __construct($Styles = array()){
		$this->Styles = array_merge(array('breadcrumb'), $Styles);
	}
	
	public function addItem($Content = "", $Active = FALSE){
		$this->items[] = Util\Html::tag("li", $Content, $this->styles($Active));
	}
	
	private static function styles($Active){
		$styles = array();
		if($Active){
			$styles[] = 'active';
		}
		return $styles;
	}
	
	public function addLink($Content = "", $Href = "#", $Active = FALSE){
		$this->items[] = Util\Html::tag("li", Util\Html::tag("a", $Content, $this->styles($Active), array("href" => $Href)));
	}
	
	/**
     * @return string
     */
	public function __toString(){
    	return Util\Html::tag("ol", implode($this->items), $this->Styles);	
    }
	
}
?>