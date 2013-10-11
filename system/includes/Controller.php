<?php

/**
 * All rights reserved to Senecio 2013
 * @author Raz Sapir <sapiraz@gmail.com>
 */

class Controller {
	private $children = array();
	private $header;
	private $footer;
	private $template;
	private $id;
        private $database;
        private $language;
        private $subdata;
        
	public $data = array();
        
	function __construct($id,$db,$lang,$template,$subdata = "",$title = ""){
		$this->id = $id;
		$this->title = $title;
                $this->language = new Language($lang);
                $this->language->loadKeys(PUBLIC_LANGUAGES_FOLDER . $lang . "/" . $id . ".php");
                $this->database = $db;
                $this->subdata = $subdata;
                $this->setTemplate($template);
                $this->startup();
	}
        public function startup(){
            //Function to run right after the constructor.
            //To be rewritten
        }
	public function render(){
		//Default render method
                if($this->getTemplate()){
                        $this->output($this->getTemplate()->getTemplate($this->getId()),$this->data);
                }
	}
	public function addChild($child,$subdata = ""){
		$ext = ".php";
                if(!class_exists($child)){
                    require_once(CONTROLLER_FOLDER . $child . $ext);
                }
		$className = "controller".preg_replace("/[^a-zA-Z]/","",$child);
                $newChild = new $className($child,$this->database,$this->language->getLangCode(),$this->getTemplate(),$subdata,$this->getTitle());
                $newChild->setTemplate($this->template);
		array_push($this->children,array( $child , $newChild ));
                return $newChild;
		
	}
	public function getChildren(){
		return $this->children;
	}
	public function renderChildren(){
		foreach($this->children as $child){
			$child[1]->render();
		}
	}
	public function renderChild($name){
		foreach($this->children as $child){
			if($child[0] == $name){
				$child[1]->render();
			}
		}
	}
	public function addHeader(){
		require_once(CONTROLLER_FOLDER . "modules/header.php");
		$this->header = new ControllerModulesHeader("modules/header",$this->database,$this->language->getLangCode(),$this->getTemplate(),"",$this->getTitle());
		$this->header->setTemplate($this->template);
	}
	public function getHeader(){
		return $this->header;
	}
	
	public function addFooter(){
		require_once(CONTROLLER_FOLDER . "modules/footer.php");
		$this->footer = new ControllerModulesFooter("modules/footer",$this->database,"",$this->language->getLangCode(),$this->getTemplate());
		$this->footer->setTemplate($this->template);
	}
	public function getFooter(){
		return $this->footer;
	}
	public function setTemplate($template){
                
		$this->template = $template;
                
	}
	public function getTemplate(){
		if($this->template)
			return $this->template;
                
		return false;
	}
	public function getId(){
		return $this->id;
	}
	public function getTitle(){
		return $this->title;
	}
	public function setTitle($title){
		$this->title = $title;
	}
	public function output($tplpath,$vars = NULL,$display = TRUE){
		//Displaying the template to the client.
                if($vars == NULL && !is_array($vars)){
                    $vars = $this->data;
                }
                if($this->getId() == "modules/topnav"){
                    echo "GOTCHA";
                }
                
		//Taking all the data needed first and turning it into simple variables
		foreach($vars as $var => $val){
			${$var} = $val;
		}
		if(file_exists($tplpath)){
                    ob_start();
                    @include($tplpath);
                    $content = ob_get_contents();
                    ob_end_clean();
                    if($display){
                        echo $content;
                    } else {
                        return $content;
                    }
                        
		}
		
	}
        public function getDatabase(){
            
            return $this->database;
        }
        public function getLanguage(){
            return $this->language;
        }
        public function getSubData(){
            return $this->subdata;            
        }
}

?>