<?php

namespace PHPStrap\Wizard;

interface Step{
	
	/**
	 * @param array $previousData
	 * @return void
	 */
	public function initialize($previousData);
	
	/**
	 * @return boolean
	 */
	public function isValid();
	
	/**
	 * @return array data
	 */
	public function finish();
	
	public function addNextButton($nextCaption);
	
	
}

?>