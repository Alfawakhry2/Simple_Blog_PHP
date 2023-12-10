<?php 
require 'db/conn.php';
require 'validation.php';
session_start();
if(isset($_SESSION['user'])){
  header("location:profile.php");
  exit;
}
if(isset($_POST['login']) && $_SERVER['REQUEST_METHOD'] == 'POST'){
  $email = htmlspecialchars(trim($_POST['email']));
  $password = md5($_POST['password']);
  $check_query = "SELECT * FROM `users` WHERE `email` = ? AND `password` =? ";
  $prepare = mysqli_prepare($connection , $check_query) ; 
    mysqli_stmt_bind_param($prepare , 'ss' , $email , $password);
    mysqli_stmt_execute($prepare);
    $result = mysqli_stmt_get_result($prepare); 
    $data = mysqli_fetch_array($result , MYSQLI_ASSOC);
    $row_num = mysqli_num_rows($result);
    if(check_empty($email) || check_empty($password)){
      $mess = "Please Type Email and Password";
    }else{    
      if(check_email($email)){
      $errorEmail = check_email($email) ; 
    }elseif($row_num > 0){
      $_SESSION['user'] = $data ; 
      header("location:profile.php");
    }else{
      $mess =  "Email Or Password Incorrect" ;
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
    <title>Blog</title>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!--

    TemplateMo 546 Sixteen Clothing

    https://templatemo.com/tm-546-sixteen-clothing

    -->

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
                <a class="nav-link" href="register.php">Create new account</a>
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
              <h2 class="text-uppercase text-center mb-5">Sign In</h2>

              <form method="POST">

                <div class="form-outline mb-4">
                    <label class="form-label" for="form3Example3cg">Email</label>
                  <input name="email" type="text" value="<?=(isset($email))?$email:'';?>" id="form3Example3cg" class="form-control form-control-lg" />
                  <div  style="color:red;"><?= (isset($errorEmail))?$errorEmail:'';?></div>
                </div>

                <div class="form-outline mb-4">
                  <label class="form-label" for="form3Example4cg">Password</label>
                  <input name="password" type="password" id="form3Example4cg" class="form-control form-control-lg" />
                  <div  style="color:red;"></div>

                </div>



                <div class="d-flex justify-content-center">
                  <button type="submit" name="login" 
                    class="btn  btn-white btn-lg gradient-custom-4" >Login
                  </button>
                </div>
                <div style="color:red; text-align:center"><?= (isset($mess))?$mess:''?></div>
                <p class="text-center text-muted mt-5 mb-0">Create new Account ? <a href="register.php"
                    class="fw-bold text-body"><u>Register</u></a></p>
              </form>

            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<?php  require 'headers/footer.php'?>