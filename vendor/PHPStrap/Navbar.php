<?php
namespace PHPStrap;

class Navbar{
	
	private $Header;
	private $Form = '';
	private $Items = array();
	private $ItemsRight = array();
		
	public function __construct($Brand, $Href = '#'){
    	$icon = Util\Html::tag("span", '', array('icon-bar'));
    	$this->Header = Util\Html::tag("div",
    		Util\Html::tag("button", 
    			$icon . $icon . $icon, 
    			array('navbar-toggle'), 
    			array('type' => 'button', 'data-toggle' => 'collapse', 'data-target' => '.navbar-responsive-collapse')
    		) .
	    	Util\Html::tag("a", 
	    		$Brand,
	    		array('navbar-brand'), array('href' => $Href)
	    	), 
    		array('navbar-header') 
    	);
    }
	
    public function addItem($Content = "", $Href = "#", $Active = FALSE){
		$this->Items[] = $this->createItem($Content, $Href, $Active);
	}
	
	public function addDropdown($Dropdown, $Active){
		$this->Items[] = Util\Html::tag("li", $Dropdown, 
			$Active ? 
        		array('dropdown', 'active') : 
        		array('dropdown')
        );
	}
	
	public function addRightItem($Content = "", $Href = "#", $Active = FALSE){
		$this->ItemsRight[] = $this->createItem($Content, $Href, $Active);
	}
	
	public function addRightContent($Content){
		$this->ItemsRight[] = $Content;
	}
	
	private function createItem($Content, $Href, $Active){
    	$link = Util\Html::tag("a", $Content, array(), array('href' => $Href));
		$styles = $Active ? array('active') : array();
		return Util\Html::tag("li", $link, $styles);
    }
    
	public function withSearchForm($action, $placeholder = "Search", $parameterName = 'q', $location = 'left'){
		$value = isset($_GET[$parameterName]) ? $_GET[$parameterName] : '';
		$this->Form = Util\Html::tag("form", 
			Util\Html::tag("input",
				'',
				array('form-control', 'col-lg-8'),
				array('type' => 'text', 'name' => $parameterName, 'id' => 'search-box-query', 'value' => $value, 'placeholder' => $placeholder)
			), 
			array('navbar-form', 'navbar-' . $location),
			array('action' => $action, 'method' => 'get', 'id' => 'search-box')
		);
	}
    
	private function items(){
		if(!empty($this->Items)){
			return Util\Html::tag("ul",
				implode($this->Items),
				array('nav', 'navbar-nav')
			);
		}else{
			return '';
		}
	}
	
	private function itemsRight(){
		if(!empty($this->ItemsRight)){
			return Util\Html::tag("ul",
				implode($this->ItemsRight),
				array('nav', 'navbar-nav', 'navbar-right')
			);
		}else{
			return '';
		}
	}
	
 	public function __toString(){
        return Util\Html::tag("div", 
        	Util\Html::tag("div",
        		$this->Header . 
        		Util\Html::tag("div",
        			$this->items() . $this->Form . $this->itemsRight(), 
        			array('navbar-collapse', 'collapse', 'navbar-responsive-collapse')
        		), 
        		array('container')
        	), 
        	array('navbar', 'navbar-default', 'navbar-fixed-top')
        );
    }
   
}

?>