<?php
namespace PHPStrap;

class TabGroup{
	
	private $Id;
	private $Tabs = array();
	private $Active = NULL;
	
	public function __construct($Id = "tabGroup"){
		$this->Id = $Id;
	}
	
	public function addTab($Id, $Title, $Content, $Active = FALSE){
		$tab = new Tab($Title, $Content, $this->Id . "-" . $Id);
		$this->Tabs[] = $tab;
		if($Active){
			$this->Active = $tab;
		}
	}
	
	private function setDefaultActive(){
		if((!empty($this->Tabs)) AND ($this->Active == NULL)){
 			$this->Active = $this->Tabs[0];
 		}
	}
	
 	public function __toString(){
 		$this->setDefaultActive();
 		$lis = array();
 		$panes = array();
 		foreach($this->Tabs as $Id => $Tab){
 			$lis[] = $Tab->li($this->Active == $Tab);
 			$panes[] = $Tab->pane($this->Active == $Tab);
 		}
 		$html = Util\Html::tag("ul",
			implode($lis), 
			array('nav', 'nav-tabs')
		);
		$html .= Util\Html::tag("div",
			implode($panes), 
			array('tab-content')
		);
		return $html;
    }
	
}

class Tab{

	private $Content, $Id, $Title;
	
	public function __construct($Title, $Content, $Id){
		$this->Title = $Title;
        $this->Content = $Content;
        $this->Id = $Id;
    }
    
	public function getContent(){
    	return $this->Content;
    }
	public function getId(){
    	return $this->Id;
    }
	public function getTitle(){
    	return $this->Title;
    }
    
    public function li($Active = FALSE){
    	$Styles = $Active ? array('active') : array();
    	return Util\Html::tag("li",
    		Util\Html::tag('a', $this->getTitle(), array(), array('href' => '#' . $this->getId(), 'data-toggle' => 'tab')), 
    		$Styles
    	);
    }
    
	public function pane($Active = FALSE){
    	$Styles = $Active ? array('tab-pane', 'active') : array('tab-pane');
    	return Util\Html::tag("div",
    		$this->getContent(), 
    		$Styles,
    		array('id' => $this->getId())
    	);
    }
	
}
?>