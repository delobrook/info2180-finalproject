<?php
// check if user has logged in before granting access to script
session_start();
require_once "../databaseconn/db_connection.php";
require_once "issue.php";
require_once "user.php";
require_once "login.php";

$db_conn = new DatabaseConnection();

// handle login requests
if(isset($_GET['email']) && isset($_GET['password'])){
    
    // extract user email and password
    $email = $_GET['email'];
    $password = $_GET['password'];

    //create a login object
    $login = new Login($db_conn);
    //attempt to login in 
    $user = $login->log($email, $password);

    // if login successful create user session with user_id and send home page to client in json
    // else send error msg in json
    if($user){
        $_SESSION["user_id"] = $user['id'];
        echo json_encode(
            array(
                'loggedIn'=> true,
                'message' => file_get_contents("../page-view/home.php")
            )
        ); 
    }
    else{
        echo json_encode(
            array(
                'loggedIn'=> false,
                'message' => "Invalid user credentials "
            )
        );
    }
    
}

// handle request for the home view page
if(isset($_GET['home-view'])){
    
    // if user logged in send page to client else send index page
    if(isset($_SESSION["user_id"])){
        echo json_encode(
            array(
                'loggedIn'=> true,
                'message' => file_get_contents("../page-view/home.php")
            )
        ); 
    }
    else{
        echo json_encode(
            array(
                'loggedIn'=> false,
                'message' => file_get_contents("../mainpage.php")
            )
        );
    }
}

// handle request for available issues
if(isset($_GET['issues']) && isset($_SESSION["user_id"])){
    
    //create issue object to deal with issue requests
    $issue = new Issue($db_conn);
    if($_GET['issues'] === 'all-btn'){
        $issue->getAllIssues();  //return all issues
    }elseif($_GET['issues'] === 'open-btn'){ 
        $issue->getOpenIssues(); //return Open issues
    }elseif($_GET['issues'] === 'my-ticket-btn'){
        $issue->getMyTicketIssues($_SESSION['user_id']); //return current user issues
    }elseif($_GET['issues'] === 'single-issue'){
        $issue->getIssue($_GET['issue-id']); // handle request for a single issue
    }
}

// handle request for add issue page
if(isset($_GET['add_issue'])){
    
    // if user logged in return to client the add issue page
    if(isset($_SESSION['user_id'])){
        $users = new User($db_conn);
        $userList = $users->getAllUsers();
        echo json_encode(
            array(
                'loggedIn'=> true,
                'message' => file_get_contents("../page-    view/new_issue.php"),
                'users' => json_encode($userList)
            )
        ); 
    }else{ // else return the index page
        echo json_encode(
            array(
                'loggedIn'=> false,
                'message' => file_get_contents("../mainpage.php")
            )
        ); 
    }
    
}

// handles request to add new users to the system
if(isset($_GET['new-user'])){
    
    // if user is currently logged in check if user if the admin. Only admin is allowed to
    // add new users to the system
    if(isset($_SESSION['user_id'])){
        if($_SESSION['user_id'] === '1'){
            echo json_encode(
                array(
                    'loggedIn'=> true,
                    'message' => file_get_contents("../page-view/new-user.php")
                )
            ); 
        }else{
            echo json_encode(
                array(
                    'loggedIn'=> true,
                    'message' => "<h1>Take it easy boss you dont have the powers (ADMIN ONLY)</h1>"
                )
            ); 
        } 
    }else{
        echo json_encode(
            array(
                'loggedIn'=> false,
                'message' => file_get_contents("../mainpage.php")
            )
        ); 
    }
    
}

// handles logout requests
if(isset($_GET['logout'])){
    // logout, clear user session and return login page
    session_unset();
    session_destroy();
    echo file_get_contents("../index.php");
}

//This should handle request for to enter a issue into the database
if(isset($_POST['description'])){
    $created_by = 5;
    $issue = new Issue($db_conn);
    $title = $_POST['title'];
    $description = $_POST['description'];
    $type = $_POST['type'];
    $priority = $_POST['priority'];
    $assigned_to = $_POST['assigned_to'];
    $msg = $issue->createIssue($title, $description, $type, $priority, $assigned_to, $created_by);
    echo json_encode(
        array(
            'status'=> true,
            'message' => "rich"
        )
    );
}




