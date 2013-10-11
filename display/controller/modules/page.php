<?php

	class ControllerModulesPage extends Controller {
		
                public function startup() {
                    //We're assuming Subdata was already given to us (Requires id of the page to be displayed)
                    //Check if page provided exists, if so, display the content of the given page in the correct language.
                    $pageQuery = $this->getDatabase()->query("SELECT `id` FROM `pages` WHERE `id` = '{$this->getSubData()}' LIMIT 1");
                    $contentQuery = $this->getDatabase()->query("SELECT `page_title`,`page_content` FROM `pages_content` WHERE `page_id` = '{$this->getSubData()}' AND `lang_code` = '{$this->getLanguage()->getLangCode()}' LIMIT 1");
                    if($pageQuery->num_rows == 1 && $contentQuery->num_rows == 1){
                        //Page was found, fetch data.
                        $pageContent = $contentQuery->fetch_array();
                        $this->data['pageTitle']    = $pageContent['page_title'];
                        $this->data['pageContent']  = $pageContent['page_content'];
                        $this->setTitle($pageContent['page_title']);
                        
                    } else {
                        $this->data['pageTitle']    = $this->getLanguage()->getLangKey("default_title");
                        $this->setTitle($this->getLanguage()->getLangKey("default_title"));
                        $this->data['pageContent']  = $this->getLanguage()->getLangKey("default_content");
                    }
                    
                }
                
		public function render(){
                        echo $this->getSubData();
			if($this->getTemplate())
				$this->output($this->getTemplate()->getTemplate($this->getId()),$this->data);
                        
		}
	}
?>