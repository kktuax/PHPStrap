<?php
namespace PHPStrap;

class Table{
	
	private $Contents = array(), $Headers = array(), $Styles, $HeaderColumns;
	
	public function addHeaderRow($Row){
		$this->Headers[] = $Row;
	}
	
	public function addRow($Row){
		$this->Contents[] = $Row;
	}
	
	public function __construct($Content = array(), $HeaderRows = 0, $HeaderColumns = 0, $Styles = array()){
		if(!empty($Content)){
			if($HeaderRows > 0){
				$this->Headers = array_slice($Content, 0, $HeaderRows);
				$this->Contents = array_slice($Content, $HeaderRows);
			}else{
				$this->Contents = $Content;
			}
		}
		$this->HeaderColumns = $HeaderColumns;
		$this->Styles = array_merge(array('table'), $Styles);
	}
	
	public function __toString(){
		$headers = '';
		if(!empty($this->Headers)){
			foreach($this->Headers as $Header){
				$headers .= '<tr><th>' . implode('</th><th>', $Header) . '</th></tr>';
			}
		}
		$content = '';
		if(!empty($this->Contents)){
			foreach($this->Contents as $Content){
				$content .= '<tr>';
				$colh = array_slice($Content, 0, $this->HeaderColumns);
				if(!empty($colh)){
					$content .= '<th>' . implode('</th><th>', $colh) . '</th>';
				}
				$col = array_slice($Content, $this->HeaderColumns);
				$content .= '<td>' . implode('</td><td>', $col) . '</td>';
				$content .= '</tr>';
			}
		}
		return Util\Html::tag("table",
			$headers . $content,
			$this->Styles
		);
    }
    
    public static function hoverTable($Content = array(), $HeaderRows = 0, $HeaderColumns = 0, $Styles = array()){
    	return new Table($Content, $HeaderRows, $HeaderColumns, array_merge(array('table-hover'), $Styles));
    }
    
	public static function stripedTable($Content = array(), $HeaderRows = 0, $HeaderColumns = 0, $Styles = array()){
    	return new Table($Content, $HeaderRows, $HeaderColumns, array_merge(array('table-striped'), $Styles));
    }
    
	public static function borderedTable($Content = array(), $HeaderRows = 0, $HeaderColumns = 0, $Styles = array()){
    	return new Table($Content, $HeaderRows, $HeaderColumns, array_merge(array('table-bordered'), $Styles));
    }
    
	public static function condensedTable($Content = array(), $HeaderRows = 0, $HeaderColumns = 0, $Styles = array()){
    	return new Table($Content, $HeaderRows, $HeaderColumns, array_merge(array('table-condensed'), $Styles));
    }
	
}
?>