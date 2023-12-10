<?php
require 'headers/header.php';
require 'db/conn.php'; 
?>
<?php 
session_start() ;
// if(!isset($_SESSION['user'])):
//   header("location:login.php");
//   exit;
// endif;

## very very important to intialize session
if(isset($_POST['view'])){
$_SESSION['id'] = $_POST['id'];
}
$id = $_SESSION['id'];
$query = "SELECT * FROM `posts` WHERE id = ?";
$prepare = mysqli_prepare($connection , $query) ; 
mysqli_stmt_bind_param($prepare , 'i' , $id);
mysqli_stmt_execute($prepare);
$result = mysqli_stmt_get_result($prepare); 
$data = mysqli_fetch_array($result ,MYSQLI_ASSOC);



?>
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
                <a class="nav-link" href="profile.php">Home</a>
              </li> 
              <li class="nav-item">
                <a class="nav-link" href="allposts.php">Timeline</a>
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

    <!-- Page Content -->
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>new Post</h4>
              <h2>add new personal post</h2>
            </div>
          </div>
        </div>
      </div>


    <div class="best-features about-features">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="section-heading">
              <h2>Post Page</h2>
            </div>
          </div>
          <div class="col-md-8">
            <div class="right-image">
              <img src="<?="upload_posts_img/".$data['image'];?>">
            </div>
          </div>
          <div class="col-md-4">
            <div class="left-content">
              <h4><?=$data['title']?></h4>
              <p><?= $data['body']?></p>
              <br><br><br><br>
              <?php if(isset($_SESSION['user'])):?>
              <div class="d-flex justify-content-center">
                <form action="editPost.php" method="POST">
                  <input type="hidden" name="id" value="<?=$data['id']?>">
                  <button class="btn btn-success mr-3" name="edit">Edit Post</button>
                </form>
                  <a href="deletePost.php?id=<?=$data['id']?>" class="btn btn-danger mr-3">Delete Post</a>
              </div>
              <?php endif;?>
            </div>
          </div>
        </div>
      </div>
</div>

<?php require 'headers/footer.php'?>
