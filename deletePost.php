<?php
require 'db/conn.php';
if(!isset($_GET['id'])){
    header("location:myposts.php");
    exit;
}
if(isset($_GET['id']) && $_SERVER['REQUEST_METHOD'] == 'GET'){
    $id = $_GET['id'];
    $delete_query = "DELETE FROM `posts` WHERE id = ?";
    $prepare = mysqli_prepare($connection , $delete_query) ; 
    mysqli_stmt_bind_param($prepare , 'i' , $id);
    $done = mysqli_stmt_execute($prepare);
    if($done){
        header("location:myposts.php");
        exit;
    }
}



?>