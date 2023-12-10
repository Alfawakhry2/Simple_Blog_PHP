<?php
session_start();
$user = $_SESSION['user'];
if(!isset($_SESSION['user'])){
    header("location:login.php");
    exit;
}

if(isset($user)):
    session_unset();
    header("location:login.php");
    exit;
endif;

?>