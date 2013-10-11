<?php

	class ControllerModulesNews extends Controller {
		
                public function startup() {
                    //We're assuming Subdata was already given to us (Requires id of the page to be displayed)
                    //Check if page provided exists, if so, display the content of the given page in the correct language.
                    
                    //$pageQuery = $this->getDatabase()->query("SELECT `id` FROM `pages` WHERE `id` = '{$this->getSubData()}' LIMIT 1");
                    //$contentQuery = $this->getDatabase()->query("SELECT `page_title`,`page_content` FROM `pages_content` WHERE `page_id` = '{$this->getSubData()}' AND `lang_code` = '{$this->getLanguage()->getLangCode()}' LIMIT 1");
                    $this->data['pageTitle'] = $this->getLanguage()->getLangKey("default_title");
                    
                    //Some settings for this news module
                    $amount = 10; //Amount of news to list
                    
                    //Collect latest news
                    $newsQuery = $this->getDatabase()->query("SELECT news.id,news.time,news_labels.title FROM news INNER JOIN news_labels ON news_labels.new_id = news.id ORDER BY news.time DESC LIMIT {$amount} ");
                    $this->data['news'] = array();
                    while($row = $newsQuery->fetch_array()){
                        $this->data['news'][] = array("title" => $row['title'],"time" => date("d/m/Y",$row['time']));
                    }
                }
                
		/*public function render(){
                        echo $this->getSubData();
			if($this->getTemplate())
				$this->output($this->getTemplate()->getTemplate($this->getId()),$this->data);
                        
		}*/
	}
?>