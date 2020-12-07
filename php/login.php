<?php
require_once "../databaseconn/db_connection.php";

class Login{
    public $db_conn;

    public function __construct($db_conn){
        $this->db_conn = $db_conn;
    }

    public function log($email, $password){
        $email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
        $user = $this->db_conn->login($email, $password);
        return $user;
    }

    public function createIssue($title, $description, $type, $priority, $assigned_to, $created_by){
        //1. sanitize

        //2. insert into db
        $this->db_conn->insertIssue($title, $description, $type, $priority, $assigned_to, $created_by);
    }
}
?>