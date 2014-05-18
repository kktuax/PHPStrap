<?php
namespace PHPStrap;

class ListGroup{
	
	private $items = array();
	
	public function addItem($Content = ""){
		$this->items[] = Util\Html::tag("li", $Content, array('list-group-item'));
	}
	
	public function addParagraphWithHeader($Header = "", $Text = "", $Href = "#", $Active = FALSE){
		$this->addLink(
			Util\Html::tag("h4", $Header, array('list-group-item-heading')) .
			Util\Html::tag("p", $Text, array('list-group-item-text')), 
			$Href, $Active
		);
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