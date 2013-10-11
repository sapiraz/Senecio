<?php

/**
 * All rights reserved to Senecio 2013
 * @author Raz Sapir <sapiraz@gmail.com>
 */

class Database {
    private $con;
    
    public function __construct($host,$user,$password,$database) {
        //Load settings and connection settings and stuff.
        $this->connect($host,$user,$password,$database);
    }
    public function connect($host,$user,$password,$database){
        @$this->con = new mysqli($host, $user, $password, $database);
        if($this->con->connect_errno){
            echo "Could not connect to database ({$this->con->connect_errno}) - {$this->con->connect_error}.";
        }
        
        
    }
    public function disconnect(){
        if(isset($this->con) && $this->con->connect_errno == 0){
            return $this->con->close();
        } else {
            return false;
        }
    }
    public function query($query){
        if(isset($this->con->connect_errno) && $this->con->connect_errno == 0){
            return $this->con->query($query);
        }
    }
    public function squeak(){
        echo "QUAK";
    }
    
}

?>