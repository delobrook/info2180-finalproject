<?php

class DatabaseConnection{

    private $handler;

    public function __construct(){

        //establish connection with database when called on object
        try{
            $this->handler = new PDO('mysql:host=localhost;dbname=finalproject', 'root', '');
            $this->handler->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }catch(PDOException $e){

        }
    }

    //returns an assoc arr of a valid user or  if given user not valid false 
    public function login($email, $password){
        $query = $this->handler->query("SELECT * FROM users where email='$email' and password='$password'");
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if($result){
            return $result;
        }
        else{
            return false;
        }
    }
    // insert a new user into the database
    public function insertUser($first_name, $last_name, $password, $email){

    }

    // public function insertIssue($title, $description, $type, $priority, $assigned_to, $created_by){
    //     $stm = 'INSERT 
    //                 INTO issues 
    //                         (title, 
    //                         `description`, 
    //                         `type`, 
    //                         priority,
    //                         `status`, 
    //                         assigned_to, 
    //                         created_by,
    //                         created, 
    //                         `updates`)
    //                 VALUES (
    //                         :title, 
    //                         :`description`,   
    //                         :`type`, 
    //                         :priority,
    //                         'OPEN',
    //                         :assigned_to,
    //                         :created_by,
    //                         NOW(),
    //                         NOW()
    //                         )';
    //                         $n = 5;
    //     $query = $this->handler->prepare($stm);
    //     $query->bindParam(':title', $title );
    //     $query->bindParam(':description', $description);
    //     $query->bindParam(':type', $type);
    //     $query->bindParam(':priority', $priority);
    //     $query->bindParam(':assigned_to', $n);
    //     $query->bindParam(':created_by', $n);
    //     //  = $query->execute(array(
    //     //     ':title' => $title, 
    //     //     ':description' => $description,   
    //     //     ':type' => $type, 
    //     //     ':priority' => $priority,
    //     //     ':status' => "OPEN",
    //     //     ':assigned_to' => $assigned_to,
    //     //     ':created_by' => $created_by,
    //     //     ':created' => 'NOW()',
    //     //     ':updates' => 'NOW()'
    //     // )); 
    //     $msg = $query->execute();
    //     return msg;
    // }

    //return associative array with all issues
    public function getAllIssues(){
        // echo "reached here";
        $query = $this->handler->query("SELECT issues.id, firstname, lastname, type, status, description, title, created, assigned_to FROM issues JOIN users ON issues.assigned_to=users.id");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if($result){
            return $result;
        }
        else{
            return false;
        }
    }

    public function getOpenIssues(){
        // echo "reached here";
        $query = $this->handler->query("SELECT issues.id, firstname, lastname, type, status, description, title, created, assigned_to FROM issues JOIN users ON issues.assigned_to=users.id
                                        WHERE status='OPEN'");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if($result){
            return $result;
        }
        else{
            return false;
        }
    }

    public function getMyTicketIssues($user_id){
        // returns the all of current user's issues
        $query = $this->handler->query("SELECT issues.id, firstname, lastname, type, status, description, title, created, assigned_to FROM issues JOIN users ON issues.assigned_to=users.id 
                                        where assigned_to=$user_id");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if($result){
            return $result;
        }
        else{
            return false;
        }
    }

    //return associative array with issue of given id
    public function getIssue($id){
        $query = $this->handler->query("SELECT issues.id, firstname, lastname, type, status, description, title, created, assigned_to, created_by, updates, priority FROM issues JOIN users ON issues.assigned_to=users.id 
                                        WHERE issues.id=$id");
        $result = $query->fetch(PDO::FETCH_ASSOC);
        if($result){
            return $result;
        }
        else{
            return false;
        }
    }

    public function getAllUsers(){
        
        $query = $this->handler->query("SELECT id, firstname, lastname FROM users");
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
        if($result){
            return $result;
        }
        else{
            return false;
        }
    }
}


?>