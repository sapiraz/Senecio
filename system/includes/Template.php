<?php

/**
 * All rights reserved to Senecio 2013
 * @author Raz Sapir <sapiraz@gmail.com>
 */

class Template {

	private $templateInfo = array();
	
	function __construct($vars){
	
		$this->templateInfo['TEMPLATE_PATH']            = $vars['TEMPLATE_PATH'];
                $this->templateInfo['TEMPLATE_PUBLIC_PATH'] 	= $vars['TEMPLATE_PUBLIC_PATH'];
		$this->templateInfo['TEMPLATE_ID']              = $vars['TEMPLATE_ID'];
		$this->templateInfo['TEMPLATE_AUTHOR']          = $vars['TEMPLATE_AUTHOR'];
		
	}
	function getInfo(){
		return $this->templateInfo;
	}
	function getTemplate($act){
		$ext = ".tp";
		
		if(file_exists($this->templateInfo['TEMPLATE_PATH'] . $act . $ext)){
			return $this->templateInfo['TEMPLATE_PATH'] . $act . $ext;
		} else {
			return false;
		}
	}

	
}

?>