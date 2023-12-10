<?php
require_once 'db/conn.php';
require 'validation.php';
if(isset($_SESSION['user'])){
  header("location:profile.php");
  exit; 
}
if(isset($_POST['register']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
    $succ = '';
    #posts
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = md5($_POST['password']);
    $password_conf =md5($_POST['password_conf']);
    ## caues the md5 hasing empty
    $empty_input = md5('');
    #mysql and querys
    $reg_query = "SELECT * FROM `users` WHERE `email` = ?";
    $prepare = mysqli_prepare($connection , $reg_query);
    mysqli_stmt_bind_param($prepare ,'s',$email);
    mysqli_stmt_execute($prepare);
    $result = mysqli_stmt_get_result($prepare);
    $data = mysqli_fetch_array($result);
    $num_row = mysqli_num_rows($result);

    ## validations
    ## check empty fields
    if(check_empty($name) || check_empty($email) || $password == $empty_input || $password_conf == $empty_input ){
      $errorName =    check_empty($name) ; 
      $errorEmail =   check_empty($email) ;
      $errorPass =   '';
      $errorPassConf= "Please Fill Password Inputs";
    ##check other validations
    }else { 
    ##check string 
    if(check_string($name)){
      $errorName = check_string($name) ; 
    }
    elseif(check_email($email)){
      $errorEmail = check_email($email);
    }
    elseif($num_row != 0){
      $errorEmail = "Email Already Exist";
    }elseif($password != $password_conf){
      $errorPassConf = "Passwords are Not Match" ; 
    }else{
        $insert_query = "INSERT INTO `users` (name , email , password , password_conf) Values (? , ? , ? , ?)";
        $insert_pre = mysqli_prepare($connection , $insert_query);
        mysqli_stmt_bind_param($insert_pre , 'ssss' , $name , $email , $password , $password_conf);
        if(mysqli_stmt_execute($insert_pre)):
            header("location:login.php");
            exit;
        endif;
    }
    }
  

    













}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
    <title>Register</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/templatemo-sixteen.css">
    <link rel="stylesheet" href="assets/css/owl.css">
  </head>

<body>
    <!-- ***** Preloader Start ***** -->
    <div id="preloader" >
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- ***** Preloader End ***** -->
    <!-- Header -->
    <header class="padding-0">
      <nav class="navbar navbar-expand-lg">
        <div class="container">
          <a class="navbar-brand" href="index.php"><h2> <em>Blog</em></h2></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">
              <li class="nav-item">
                <a class="nav-link" href="#">English</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">العربية</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="login.php">Login</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>    <br>
    <br>
    <br>
    <br>
    <br>

<section class="vh-100 bg-image"
  style="background-image: url('https://mdbcdn.b-cdn.net/img/Photos/new-templates/search-box/img4.webp');">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px;">
            <div class="card-body p-6">
              <h2 class="text-uppercase text-center mb-5">Create Account</h2>

              <form method="POST">
                <!-- name -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example3cg">Name</label>
                  <input name="name" type="text" id="form3Example3cg" value="<?= (isset($name))?$name:'';?>" class="form-control form-control-lg" />
                  <div style="color:red;"><?= isset($errorName)?$errorName:'';?></div>
                </div>
                <!-- email -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4cg">Email</label>
                  <input name="email" type="email" id="form3Example4cg" value="<?= (isset($email))?$email:'';?>" class="form-control form-control-lg" />
                  <div style="color:red;"><?=(isset($errorEmail))?$errorEmail:'';?></div>
                </div>
                <!-- password -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4cg">Password</label>
                  <input name="password" type="password" id="form3Example4cg" class="form-control form-control-lg" />
                  <div style="color:red;"><?=(isset($errorPass))?$errorPass:'';?></div>
                </div>
                <!-- password conf -->
                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4cg">Password Confirmation</label>
                  <input name="password_conf" type="password" id="form3Example4cg" class="form-control form-control-lg" />
                  <div  style="color:red;"><?=(isset($errorPassConf))?$errorPassConf:'';?></div>
                </div>


                <div class="d-flex justify-content-center">
                  <button type="submit" name="register" 
                    class="btn  btn-white btn-lg gradient-custom-4" >Register
                  </button>
                </div>
                <div style="color:green; text-align:center"><?= (isset($succ))?$succ:''?></div>
                <p class="text-center text-muted mt-5 mb-0">Have Account ? <a href="login.php"
                    class="fw-bold text-body"><u>login</u></a></p>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<?php  require 'headers/footer.php'?>