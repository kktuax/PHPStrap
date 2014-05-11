<?php

namespace PHPStrap;

class Accordion{

	private $numberOfPanels = 0;
	private $Code = "";
	private $Id;
	
	public function __construct($Id = "accordion"){
    	$this->Id = $Id;
    }
	
	public function addPanel($Title, $Content, $Opened = FALSE){
		$this->numberOfPanels = $this->numberOfPanels + 1;
		$panelClasses = array('panel-collapse', 'collapse');
		if($Opened){
			$panelClasses[] = 'in';
		}
		$panelTitle = Util\Html::tag("div",
			Util\Html::tag("h4", 
				Util\Html::tag("a", $Title, array(), array('data-toggle' => 'collapse', 'data-parent' => '#' . $this->Id, 'href' => '#collapse' . $this->numberOfPanels)),
				array('panel-title')), 	
			array('panel-heading')
		);
		$panelContent = Util\Html::tag("div", 
			Util\Html::tag("div", 
				$Content,
				array('panel-body')
			), $panelClasses, 
			array('id' => 'collapse' . $this->numberOfPanels)
		);
		$this->Code .= Util\Html::tag("div", 
			$panelTitle . $panelContent, 
			array('panel', 'panel-default')
		); 
		return $this;
	}
	
 	/**
     * @return string
     */
	public function __toString(){
    	return Util\Html::tag("div",
			$this->Code, 
			array('panel-group'), array("id" => $this->Id)
		); 
    }
	
}

?>