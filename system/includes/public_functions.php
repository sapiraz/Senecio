<?php

/**
 * All rights reserved to Senecio 2013
 * @author Raz Sapir <sapiraz@gmail.com>
 */

function render_time(){
    if(CALCULATE_RENDER_TIME){
         
        
        $time = microtime() - RENDER_BEGIN;
        
        if(strlen($time) > 5){
            $time = substr($time,0,5);
        }
        if($time <= 0){
            $time = "0.00";
        }
         echo "Rendered in ".$time." seconds.";
    } else {
        return;
    }
}

?>