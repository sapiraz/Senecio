<?php
	class ControllerGeneralHome extends Controller {
                public function startup() {
                    $this->setTitle($this->getTitle() . " - Home");
                    $this->addHeader();
                    $this->addFooter();
                    $this->data['centerContent'] = array();
                    $this->data['leftContent'] = array();
                    $this->data['rightContent'] = array();
                    
                    $myChilds = $this->getDatabase()->query("SELECT * FROM `modules` WHERE `parent` = '".$this->getId()."' OR `parent` = 'all' ORDER BY `sort` ASC");
                    while($row = $myChilds->fetch_array()){
                        $child = $this->addChild($row['module'],$row['subdata']);
                        $pos = "";
                        switch($row['position']){
                            case 'center':
                                $pos = 'centerContent';
                                break;
                            case 'left':
                                $pos = 'leftContent';
                                break;
                            case 'right':
                                $pos = 'rightContent';
                                break;
                            default:
                                $pos = 'centerContent';
                        }
                        array_push($this->data[$pos], $child->output($child->getTemplate()->getTemplate($child->getId()),NULL,FALSE));
                            
                    }
                        
                        
                }
		public function render(){
                        
			if($this->getHeader()){
				$this->getHeader()->render();
			}
			if($this->getTemplate())
				$this->output($this->getTemplate()->getTemplate($this->getId()),$this->data);
                        
			if($this->getFooter()){
				$this->getFooter()->render();
			}
			
		}
	}
?>