<?php
namespace PHPStrap;

class ListGroup{
	
	private $items = array();
	
	public function addItem($Content = "", $Active = FALSE){
		$this->items[] = Util\Html::tag("li", $Content, $this->styles($Active));
	}
	
	private static function styles($Active){
		$styles = array('list-group-item');
		if($Active){
			$styles[] = 'active';
		}
		return $styles;
	}
	
	public function addParagraphWithHeader($Header = "", $Text = "", $Href = "#", $Active = FALSE){
		$this->addLink(
			Util\Html::tag("h4", $Header, array('list-group-item-heading')) .
			Util\Html::tag("p", $Text, array('list-group-item-text')), 
			$Href, $Active
		);
	}
	
	public function addLink($Content = "", $Href = "#", $Active = FALSE){
		$this->items[] = Util\Html::tag("a", $Content, $this->styles($Active), array("href" => $Href));
	}
	
	/**
     * @return string
     */
	public function __toString(){
    	return Util\Html::tag("ul", implode($this->items), array('list-group'));	
    }
	
}
?>