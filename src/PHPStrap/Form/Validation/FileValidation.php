<?php

namespace PHPStrap\Form\Validation;

class FileValidation extends BaseValidation implements InputValidation{
	
	public function __construct($errormessage = "Invalid file")
    {
		parent::__construct($errormessage);
    }
	
	private $validExtensions = array();
	private $invalidExtensionErrormessage;
	
    /**
	 * @param string $invalidExtensionErrormessage
	 * @param array $validExtensions accepted extensions, f.e.: array('gif', 'jpg', 'jpeg', 'png')
	 * @return void
	 */
    public function checkForExtensions($invalidExtensionErrormessage = "Unsuported file extension. Accepted extensions: {0}", $validExtensions = array()){
    	$this->validExtensions = $validExtensions;
    	$this->invalidExtensionErrormessage = $invalidExtensionErrormessage;
    }
    
    private $mandatory = FALSE;
    
	public function makeMandatory(){
		$this->mandatory = TRUE;
	}
    
    private $maxFileSize = NULL;
	private $invalidSizeErrormessage;
	
	/**
	 * @param string $invalidSizeErrormessage
	 * @param array $maxFileSize in bytes, f.e.: 30000 
	 * @return void
	 */
    public function checkForSize($invalidSizeErrormessage = "Max file size: {0}", $maxFileSize = 30000){
    	$this->maxFileSize = $maxFileSize;
    	$this->invalidSizeErrormessage = $invalidSizeErrormessage;
    }
    
    private $validFunctionErrormessage;
	private $validFunction;
	
    public function checkFileWithFunction($errormessage, $validationFunction){
    	$this->validFunctionErrormessage = $errormessage;
    	$this->validFunction = $validationFunction;
    }
    
    /**
     * @param array $inputValue ($_FILES element)
     * @return boolean
     */
    public function isValid($inputValue){
    	if($this->isEmpty($inputValue)) return !$this->mandatory;
    	if($inputValue['error'] != UPLOAD_ERR_OK){
    		return FALSE;
    	}
    	if(!empty($this->validExtensions)){
    		$acepted_extension = FALSE;
    		foreach($this->validExtensions as $valid_extension){
    			if(strpos($inputValue['type'], $valid_extension)){
    				$acepted_extension = TRUE;
    				break;
    			}
    		}
    		if(!$acepted_extension){
    			$this->errormessage = str_replace("{0}", implode(', ', $this->validExtensions), $this->invalidExtensionErrormessage);
    			return FALSE;
    		}
    	}
    	if($this->maxFileSize != NULL){
    		if($inputValue['size'] > $this->maxFileSize){
    			$this->errormessage = str_replace("{0}", $this->formatBytes($this->maxFileSize), $this->invalidSizeErrormessage);
    			return FALSE;
    		}
    	}
    	if($this->validFunction != NULL){
    		$this->errormessage = $this->validFunctionErrormessage;
    		$fun = $this->validFunction;
    		return $fun($inputValue['tmp_name']);
    	}
     	return TRUE;
    }
    
	private function isEmpty($inputValue){
    	if($inputValue == NULL) return TRUE;
    	return $inputValue["size"] == 0;
    }
    
    private function formatBytes($bytes, $precision = 2) { 
	    $units = array('B', 'KB', 'MB', 'GB', 'TB'); 
	    $bytes = max($bytes, 0); 
	    $pow = floor(($bytes ? log($bytes) : 0) / log(1024)); 
	    $pow = min($pow, count($units) - 1); 
		$bytes /= (1 << (10 * $pow)); 
	    return round($bytes, $precision) . ' ' . $units[$pow]; 
	} 
 
}

?>