<?php

namespace PHPStrap\Wizard;

class Wizard{
	
	private $nextCaption;
	
	public function __construct($steps, $nextCaption = "Next"){
		$this->steps = $steps;
		$this->nextCaption = $nextCaption;
		$this->initSteps();
		$this->addNavigation();
	}
	
	private function activeStep(){
		$lastFinishedStep = NULL;
		foreach($this->steps as $Step){
			$canFinish = $Step->canFinish();
			if($canFinish !== NULL){
				if($canFinish === FALSE){
					return $Step;
				}else{
					$lastFinishedStep = $Step;
				}
			}
		}
		if(!empty($lastFinishedStep)){
			$nextPost = 1 + array_search($lastFinishedStep, $this->steps);
			if($nextPost == count($this->steps)){
				return $this->finalStep();
			}else{
				return $this->steps[$nextPost];
			}
		}else{
			return $this->steps[0];
		}
	}
	
	private function finalStep(){
		return $this->steps[count($this->steps)-1];
	}
	
	private function progress(){
		$activeStep = $this->activeStep();
		if(($activeStep == $this->finalStep()) && ($activeStep->canFinish() === TRUE)){
			return 100;
		}else{
			return round(100 * array_search($activeStep, $this->steps) / count($this->steps));
		}
	}
	
	private function initSteps(){
		$data = array();
		foreach($this->steps as $Step){
			$Step->initialize($data);
			if($Step->canFinish()){
				$data = array_merge($data, $Step->finish());
			}else{
				break;
			}
		}
	}
	
	private function addNavigation(){
		$activeStep = $this->activeStep();
		if($activeStep != $this->finalStep()){
			$activeStep->addNextButton($this->nextCaption);
		}
	}
	
	public function __toString(){
		$result = "";
		$result .= new \PHPStrap\ProgressBar($this->progress());
		$result .= $this->activeStep();
		return $result;
	}
	
}

?>