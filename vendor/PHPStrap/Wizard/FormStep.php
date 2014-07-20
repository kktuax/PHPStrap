<?php

namespace PHPStrap\Wizard;

class FormStep implements Step{
	
	private $Form;
	private $formBuilderFunction;
	private $finishFunction;
	private $id;
	private $next = "";
	
	public function __construct($id, $formBuilderFunction, $finishFunction = NULL){
		$this->id = $id;
		$this->formBuilderFunction = $formBuilderFunction;
		$this->finishFunction = $finishFunction;
	}
	
	public function initialize($previousData){
		$builder = $this->formBuilderFunction;
		$this->Form = $builder($previousData);
		$this->Form->setId($this->id);
	}
	
	public function finish(){
		$response = $this->Form->submitedValues();
		if(!empty($this->finishFunction)){
			$fun = $this->finishFunction;
			$fun($this->Form);
		}
		return $response;
	}
	
	public function canFinish(){
		if(empty($_POST)){
			return NULL;
		}else if(empty($this->Form->submitedValues())){
			return NULL;
		}else{
			return $this->Form->isValid();
		}
	}
	
	public function addNextButton($nextCaption){
		$this->next = \PHPStrap\Pager::nextPager($nextCaption, "javascript:$('#" . $this->id . "').submit();");
	}
	
	public function __toString(){
		return $this->Form . $this->next;
	}
			
}

?>