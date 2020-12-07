<?php
session_start();

if($_SESSION['user_id']){
    session_unset();
    session_destroy();
}