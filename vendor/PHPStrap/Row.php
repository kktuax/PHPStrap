<?php
namespace PHPStrap;

class Row{
	
	const TOTAL_WIDTH = 12;
	
	private $columns = array();
	
	public function addColumn($Content = "", $Width = NULL){
		$this->columns[] = new Column($Content, $Width);
	}
	
	/**
     * @return string
     */
	public function __toString(){
    	$columns_html = "";
    	$columns_width = 0;
    	foreach($this->columns as $column){
    		$width = $column->getWidth() != NULL ? $column->getWidth() : round(Row::TOTAL_WIDTH / count($this->columns));
    		if(($columns_width + $width) > Row::TOTAL_WIDTH){
    			$width = Row::TOTAL_WIDTH - $columns_width;
    		}
    		$columns_width += $width;
    		$columns_html .= Util\Html::tag("div",
		 		$column->getContent(),
		 		array('col-md-' . $width)
			);
    	}
		return Util\Html::tag("div", $columns_html, array('row'));	
    }
	
}

class Column{

	private $Content, $Width;
	
	public function __construct($Content = "", $Width = NULL){
        $this->Content = $Content;
        $this->Width = $Width;
    }
    
	public function getContent(){
    	return $this->Content;
    }
    
	public function getWidth(){
    	return $this->Width;
    }
	
}

?>