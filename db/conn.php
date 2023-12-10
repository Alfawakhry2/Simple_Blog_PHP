<?php 
define('SERVER_NAME', 'localhost');
define('USER_NAME' , 'root');
define('PASSWORD' , '');
define('DATABASE_NAME' , 'blog');

$connection = mysqli_connect(SERVER_NAME , USER_NAME , PASSWORD , DATABASE_NAME);



// $query = "SELECT * FROM `users`";
// $res = mysqli_query($connection , $query);
// $data = mysqli_fetch_all($res , MYSQLI_ASSOC);

// echo "<pre>";
// print_r($data);
// echo "</pre>";


?>