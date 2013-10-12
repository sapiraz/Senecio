<?php

/**
 * All rights reserved to Senecio 2013
 * @author Raz Sapir <sapiraz@gmail.com>
 */

class Navigator {
    //Lets take care of the site navigation and all that.
    private $act;
    public function __construct() {
        $act = isset($_GET['act']) ? $_GET['act'] : "";
        $act = preg_match_all("/(\w+\/\w+)/", $act) ? $act : DEFAULT_CONTROLLER;
        $this->setAct($act);
        
    }
    public function setAct($act){
        $this->act = $act;
    }
    public function getAct(){
        return $this->act;
    }
    public function __destruct(){
        
    }
}

?>
