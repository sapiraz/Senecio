<?php

/**
 * All rights reserved to Senecio 2013
 * @author Raz Sapir <sapiraz@gmail.com>
 */

/*To be used inside of controllers to request for language keys etc'*/

class Language {
    private $lang_code;
    private $lang_keys;
    public function __construct($lang_code,$lang_keys = array()) {
        $this->lang_code = $lang_code;
        $this->lang_keys = $lang_keys;
    }
    public function loadKeys($path){
        //Path should be path to a language php file that holds an array with keys for the language to hold.
        if(file_exists($path)){
            
            @include_once($path);
            //After including, $lang should be set and should be an array, if that's true, we'll assign it to our lang_keys var
            if(isset($lang) && is_array($lang)){
                
                $this->lang_keys = $lang;
            }
        }
    }
    public function getLangCode(){
        return $this->lang_code;
    }
    public function getLangKey($key){
        if(isset($this->lang_keys) && is_array($this->lang_keys) && isset($this->lang_keys["{$key}"])){
            
            return $this->lang_keys["{$key}"];
        } else {
            return "";
        }
    }
}


?>