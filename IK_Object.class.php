<?php
if(!defined("INTERNETKASSA_PSPID"))
	throw new Exception("`INTERNETKASSA_PSPID` is not set!");
if(!defined("INTERNETKASSA_ENVIROMENT"))
	throw new Exception("`INTERNETKASSA_ENVIROMENT` is not set!");
if(!defined("INTERNETKASSA_SECRET"))
	throw new Exception("`INTERNETKASSA_SECRET` is not set!");


class IK_Object {
	
	public $strict = true;

	public function __set($name, $value) {
    	$method = "set_$name";
    	
    	if (in_array($method, $this->methods())) {
    		return $this->$method($value);
    	}
    	
    	if (array_key_exists("_$name", $this->vars())) {
    		$method = "_$name";
    		return $this->$method = $value;
    	}
    	
    	if ($this->strict == true) {
    		throw new Exception("Kan $name niet vinden... bestaat het wel?");
    	}
    }
    
    public function __get($name) {
    	$method = "get_$name";
    	
	    if (in_array($method, $this->methods())) {
    		return $this->$method();
    	}
    	
    	if (array_key_exists("_$name", $this->vars())) {
    		$method = "_$name";
    		return $this->$method;
    	}
    	
    	if ($this->strict == true) {
    		throw new Exception("Kan $name niet vinden... bestaat het wel?");
    	}
    }
    
    private function vars() {
    	return get_object_vars($this);
    }
    
    public function public_vars() {
    	$vars = $this->vars();
    	
    	return array_diff_key($vars, $this->private_vars());
    }
    
    private function private_vars() {
    	$vars = $this->vars();
    	$private_vars = array();
    	
    	foreach ($vars as $name => $value) {
    		if (substr($name, 0, 1) != '_') {
    			continue;
    		}
    		
    		$private_vars[$name] = $value;
    	}

    	return $private_vars;
    }
    
    private function methods() {
    	return get_class_methods(get_class($this));
    }
}

?>
