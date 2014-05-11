<?php
namespace PHPStrap;

class ListGroup{
	
	private $items = array();
	
	public function addItem($Content = ""){
		$this->items[] = Util\Html::tag("li", $Content, array('list-group-item'));
	}
	
	public function addLink($Content = "", $Href = "#", $Active = FALSE){
		$styles = array('list-group-item');
		if($Active){
			$styles[] = 'active';
		}
		$this->items[] = Util\Html::tag("a", $Content, $styles, array("href" => $Href));
	}
	
	/**
     * @return string
     */
	public function __toString(){
    	return Util\Html::tag("ul", implode($this->items), array('list-group'));	
    }
	
}
?>