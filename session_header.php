<?php
ob_start();
include 'connect_to_database.php'; //connect the connection page

if(empty($_SESSION)) // if the session not yet started 
ini_set('session.save_path', 'tmp');
   session_start();

if(!isset($_SESSION['username'])) { //if not yet logged in
   header("Location: login.php");// send to login page
   exit;
}  




ob_flush();
?>