<?php
namespace PHPStrap;

class Alert{
	
	private $Contents, $Type;
	
	public function __construct($Content = "", $Type = NULL){
		$this->Contents = array($Content);
		$this->Type = $Type;
	}
	
	public function addContent($Content){
		$this->Contents[] = $Content;
	}
	
 	public function __toString(){
 		$styles = array('alert');
 		if($this->Type != NULL){
 			$styles[] = 'alert-' . $this->Type;
 		}
 		return Util\Html::tag("div",
			implode($this->Contents), 
			$styles
		);
    }
    
    public static function paragraph($Content = "", $Type = NULL){
    	return new Alert(Util\Html::tag("p", $Content), $Type);
    }
    
	public static function leadParagraph($leadContent = "", $Content = "", $Type = NULL){
    	$a = new Alert('', $Type);
    	if(!empty($leadContent)){
    		$a->addContent(Util\Html::tag("p", $leadContent, array('lead')));
    	}
    	if(!empty($Content)){
    		$a->addContent(Util\Html::tag("p", $Content));
    	}
    	return $a;
    }
	
}
?>