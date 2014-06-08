<?php
namespace PHPStrap;

class Thumbnail{
	
	private $Caption, $Img, $Href;
	
	public function __construct($Img = "", $Href = "#", $CaptionTitle = "", $Caption = ""){
		$this->Caption = $this->caption($CaptionTitle, $Caption);
		$this->Img = $Img;
		$this->Href = $Href;
	}
	
	private function caption($CaptionTitle = "", $Caption = ""){
		if((!empty($CaptionTitle)) OR !empty($Caption)){
			$html = '';
			if(!empty($CaptionTitle)){
				$html .= Util\Html::tag("h3", $CaptionTitle, array('text-center'));
			}
			if(!empty($Caption)){
				if(is_array($Caption)){
					foreach($Caption as $ec){
						$html .= Util\Html::tag("p", $ec, array('text-center'));
					}
				}else{
					$html .= Util\Html::tag("p", $Caption, array('text-center'));
				}
			}
			return Util\Html::tag("div", $html, array('caption'));
		}else{
			return '';
		}
	}
	
 	public function __toString(){
 		return Util\Html::tag("a",
			$this->Img . $this->Caption, 
			array('thumbnail'),
			array('href' => $this->Href)
		);
    }
    
    public static function row($Thumbnails = array()){
    	$html = '';
    	foreach(array_chunk($Thumbnails, 4) as $Chunk){
    		$PThumbnails = array_map(function($Thumbnail){
	    		 return Util\Html::tag("div", $Thumbnail, array('col-xs-6', 'col-md-3'));
	    	}, $Chunk);
	    	$html .= Util\Html::tag("div",
	    		implode($PThumbnails), 
				array('row')
			);
    	}
    	return $html;
    }
	
}
?>