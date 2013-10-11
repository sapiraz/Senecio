<?php

/**
 * All rights reserved to Senecio 2013
 * @author Raz Sapir <sapiraz@gmail.com>
 */

	class Site{
		private $name;
		private $template = NULL;
		private $controller;
		private $database;
                private $language;
		public function __construct($lang = DEFAULT_LANGUAGE,$name = DEFAULT_SITE_NAME){
			//Load default template (Defined in Config.php)
                        
                        $this->language = $lang;
                        $this->name = $name;
                        $this->database = new Database(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
                        $this->loadTemplate(DEFAULT_TEMPLATE);
                        
		}
                public function __destruct(){
                        //Site run is terminated! or.. well.. reached it's end :3
                        //Turn off the lights, and stuff
                        $this->database->disconnect();
                }
		public function render(){
			//Tell current controller to render.
                        //Current controller is loaded from within the action method.
                        define("RENDER_BEGIN", microtime());
                        
			$this->controller->render();
                        
			
		}
		public function loadTemplate($theme = DEFAULT_TEMPLATE){
			
			//Load Default Template
			@$json = file_get_contents(TEMPLATES_FOLDER . $theme . "/" . $theme .".template");
			if(!$json){
				$theme = DEFAULT_TEMPLATE;
				@$json = file_get_contents(TEMPLATES_FOLDER . $theme . "/" . $theme .".template");
			}
			if($json){
				$json = json_decode($json,TRUE);
				$json['TEMPLATE_PATH']          = TEMPLATES_FOLDER . $theme . "/" . $this->language . "/";
                                $json['TEMPLATE_PUBLIC_PATH']   = PUBLIC_TEMPLATES_FOLDER . $theme . "/" . $this->language . "/";
                                
				$this->template = new Template($json);
                                if(!file_exists($json['TEMPLATE_PATH'])){
                                    echo "Template failed to load (Template does not support provided language).";
                                }
				return true;
			} else {
				return false;
			}
			
		}
		public function action($act){
			$ext = ".php";
			require_once(CONTROLLER_FOLDER . $act . $ext);
			$classname = "controller".preg_replace("/[^a-zA-Z]/","",$act);
			$this->controller = new $classname($act,$this->database,"en",$this->template,"",$this->name);
			
                        
		}

		
	}

?>