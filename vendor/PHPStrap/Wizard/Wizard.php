<?php

namespace PHPStrap\Wizard;

class Wizard{
	
	private $nextCaption;
	
	public function __construct($steps, $nextCaption = "Next"){
		$this->steps = $steps;
		$this->nextCaption = $nextCaption;
		$this->initSteps();
		$this->processSteps();
	}
	
	private function activeStep(){
		$lastStep = $this->lastStep();
		if(!empty($lastStep)){
			$nextPost = 1 + array_search($lastStep, $this->steps);
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
	
	private function lastStep(){
		foreach($this->steps as $Step){
			if($Step->isValid()){
				return $Step;
			}
		}
		return NULL;
	}
	
	private function progress(){
		$activeStep = $this->activeStep();
		$lastStep = $this->lastStep();
		if(!empty($lastStep)){
			if($activeStep != $lastStep){
				return round(100 * array_search($activeStep, $this->steps) / count($this->steps));
			}else{
				return 100;
			}
		}else{
			return 0;
		}
	}
	
	private function initSteps(){
		$data = array();
		foreach($this->steps as $Step){
			$Step->initialize($data);
			if($Step->isValid()){
				$data = array_merge($data, $Step->finish());
			}
		}
	}
	
	private function processSteps(){
		$activeStep = $this->activeStep();
		$lastStep = $this->lastStep();
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