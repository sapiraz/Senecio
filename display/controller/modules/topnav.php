<?php

	class ControllerModulesTopnav extends Controller {
		public function startup(){
                        
                        //Select pages from the database
                        $pagesresult = $this->getDatabase()->query("SELECT * FROM `topnav_pages`");
                        //Select links to be displayed on the navigation
                        $linksresult = $this->getDatabase()->query("SELECT * FROM `topnav_links`");
                        
                        $this->data['buttons'] = array();
                               
                        //Fetch pages
                        while($row = $pagesresult->fetch_array()){
                            $button = $this->getDatabase()->query("SELECT page_id,lang_code,page_title,page_content FROM `pages_content` WHERE `page_id` = '{$row['page_id']}' AND `lang_code` = '".$this->getLanguage()->getLangCode()."'");
                            $button = $button->fetch_array();
                            
                            $this->data['buttons'][] = array("title"=>"{$button['page_title']}","href" => "?act=general/page&amp;p={$row['id']}", "sort" => "{$row['sort']}");
                        }
                        
                        //Fetch links
                        while($row = $linksresult->fetch_array()){
                            //Get the actual label for this button from the database in the current used lang
                            $button = $this->getDatabase()->query("SELECT `title` FROM `topnav_links_labels` WHERE `link_id` = '{$row['id']}' AND `lang_code` = '".$this->getLanguage()->getLangCode()."' LIMIT 1");
                            if($button->num_rows == 1){
                                $button = $button->fetch_array()['title'];
                                $this->data['buttons'][] = array("title" => "{$button}", "href" => $row['href'], "sort" => $row['sort']);
                            }
                            
                        }
                        
                        
                        //Sort the buttons according to the sort mentioned before.
                        //The sort function checks for values, and if the value returned is positive the items are being swapped.
                        usort($this->data['buttons'],function($a,$b){
                            return intval($a['sort']) - intval($b['sort']);
                        });
                        
                }
		public function render(){
			
			if($this->getTemplate())
				$this->output($this->getTemplate()->getTemplate($this->getId()),$this->data);
                        
		}
	}
?>