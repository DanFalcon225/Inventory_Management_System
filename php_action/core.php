<?php 
require_once 'db_connect.php';

session_start();

//echo $_SESSION['userId'];

if(!$_SESSION['userId']){

    header('location: http://localhost/daniilss18019262_project/index.php');

}

?>