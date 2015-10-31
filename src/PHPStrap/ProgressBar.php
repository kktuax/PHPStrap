<?php
namespace PHPStrap;

class ProgressBar{
	
	private $showLabel;
	private $percentage;
	private $styles;
	private $color = array();
	
	public function __construct($percentage, $showLabel = FALSE){
		$this->percentage = $percentage;
		$this->showLabel = $showLabel;
		$this->styles = array('progress');
	}
	
	public function setColor($AlertType){
		$this->color = array('progress-bar-' . $AlertType);
	}
	
	public function setStriped($Active = TRUE){
		$this->styles[] = 'progress-striped';
		if($Active){
			$this->styles[] = 'active';
		}
	}
	
	public function __toString(){
		$content = $this->percentage . "%";
		if(!$this->showLabel){
			$content = Util\Html::tag("span", $content, array('sr-only'));
		}
		return Util\Html::tag("div",
			Util\Html::tag("div", 
				$content, 
				array_merge(array('progress-bar'), $this->color), 
				array(
					'role' => 'progressbar', 
					'aria-valuemin' => '0', 'aria-valuemax' => '100', 'aria-valuenow' => $this->percentage,
					'style' => 'width: '.$this->percentage.'%',
				)
			),
			$this->styles
		);
    }
    
    public static function activeStriped($percentage, $showLabel = FALSE){
    	$Bar = new ProgressBar($percentage, $showLabel);
    	$Bar->setStriped(TRUE);
    	return $Bar;
    }
    
}
?>