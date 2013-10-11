<?php

/**
 * All rights reserved to Senecio 2013
 * @author Raz Sapir <sapiraz@gmail.com>
 */

	class ControllerModulesHeader extends Controller {
		public function startup() {
                        $this->data['title'] = $this->getTitle();
                        
			$this->data['stylesheet'] = $this->getTemplate()->getInfo()['TEMPLATE_PUBLIC_PATH'] . "style/" . "stylesheet.css";

                        $navbar = $this->addChild("modules/topnav");
                        $this->data['navbar'] = $this->output($this->getTemplate()->getTemplate($navbar->getId()),$navbar->data,FALSE);
                }
		/*public function render(){
  
                        
			if($this->getTemplate()){
				$this->output($this->getTemplate()->getTemplate($this->getId()),$this->data);
                        }
                        

		}*/
	}
?>