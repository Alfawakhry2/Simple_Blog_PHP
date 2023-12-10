<?php require 'headers/header.php';
require 'db/conn.php';
session_start();
if (!isset($_SESSION['user'])) :
  header("location:login.php");
  exit;
endif;

#### all posts 
$u_id = $_SESSION['user']['id'];

$posts_query = "SELECT * FROM `posts` WHERE `user_id` =$u_id";
$result = mysqli_query($connection , $posts_query);
$posts = mysqli_fetch_all($result , MYSQLI_ASSOC);
$num_rows = mysqli_num_rows($result);
?>

<!-- ***** Preloader Start ***** -->
<div id="preloader">
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
      <a class="navbar-brand" href="index.php">
        <h2> <em>Blog</em></h2>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link" href="allposts.php">Timeline</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="myposts.php">My Posts</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="addPost.php">Add New Post</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">English</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">العربية</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="logout.php">Logout</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</header>
<br><br><br>
<div>
  <section style="background-color: #eee;">
    <div class="container py-5">
      <div class="row">
        <div class="col">
          <nav aria-label="breadcrumb" class="bg-light rounded-3 p-3 mb-4">
            <ol class="breadcrumb mb-0">
              <li class="breadcrumb-item active" aria-current="page">User Profile</li>
            </ol>
          </nav>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4">
          <div class="card mb-4">
            <div class="card-body text-center">
              <img src="assets/images/profile.jpg" alt="profile photo" class="rounded-circle img-fluid" style="width: 150px;">
              <h5 class="my-3"><?=$_SESSION['user']['name']?></h5>
              <p class="text-muted mb-1">Full Stack Developer</p>
              <p class="text-muted mb-4">Bay Area, San Francisco, CA</p>
              <div class="d-flex justify-content-center mb-2">

                <button type="button" class="btn btn-outline-primary ms-1">Message</button>
              </div>
            </div>
          </div>
          <div class="card mb-4 mb-lg-0">
            <div class="card-body p-0">

            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="card mb-4">
            <div class="card-body">
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Full Name</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?=$_SESSION['user']['name']?></p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Email</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?=$_SESSION['user']['email']?></p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Identification Number</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?=$_SESSION['user']['id']?></p>
                </div>
              </div>
              <hr>
              <div class="row">
                <div class="col-sm-3">
                  <p class="mb-0">Number of Posts</p>
                </div>
                <div class="col-sm-9">
                  <p class="text-muted mb-0"><?= $num_rows?></p>
                </div>
              </div>


            </div>
          </div>
        </div>
      </div>
    </div>
</div>
</section>
</div>


<?php require 'headers/footer.php' ?>