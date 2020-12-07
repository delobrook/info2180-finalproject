<?php

class User{

    private $db_conn;
    
    public function __construct($db_conn){
        $this->db_conn = $db_conn;
    }
    public function getAllUsers(){
        return $this->db_conn->getAllUsers();
    }
}