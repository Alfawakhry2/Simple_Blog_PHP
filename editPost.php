<?php require 'headers/header.php';
require 'db/conn.php';
?>
<?php
session_start(); 
if(!isset($_SESSION['user'])){
  header("location:login.php");
  exit ; 
}
if(isset($_POST['edit']) && $_SERVER['REQUEST_METHOD']=='POST'){
  $_SESSION['post_id'] = $_POST['id'];
}
$id =$_SESSION['post_id'];
$u_id = $_SESSION['user']['id'];
## we need to select data to put in post inputs
$query = "SELECT * FROM `posts` WHERE id = ?";
$prepare = mysqli_prepare($connection , $query) ; 
mysqli_stmt_bind_param($prepare , 'i' , $id);
mysqli_stmt_execute($prepare);
$result = mysqli_stmt_get_result($prepare); 
$data = mysqli_fetch_array($result ,MYSQLI_ASSOC);

## to update data

if(isset($_POST['update']) && $_SERVER['REQUEST_METHOD']=='POST'){
  $new_title = $_POST['title'];
  $new_body = $_POST['body'];

  $new_image = $_FILES['image']['name'];
  $old_img = $_POST['old_image'];
  // if upload image 
  if($new_image){
    $update_query = "UPDATE `posts` SET title =? , body =? , image = ? , user_id =? WHERE id = $id";
    $prepare = mysqli_prepare($connection , $update_query) ; 
    mysqli_stmt_bind_param($prepare , 'sssi' ,$new_title , $new_body ,$new_image ,$u_id);
    $done = mysqli_stmt_execute($prepare);
    if($done){
      $succ = "Post Updated Successfully" ; 
    }
    // if not upload image 
  }else{
    $new_image = $old_img ;
  }
  $update_query = "UPDATE `posts` SET title =? , body =? , image = ? , user_id =? WHERE id = $id";
  $prepare = mysqli_prepare($connection , $update_query) ; 
  mysqli_stmt_bind_param($prepare , 'sssi' ,$new_title , $new_body ,$new_image ,$u_id);
  $done = mysqli_stmt_execute($prepare);
  if($done){
    $succ = "Post Updated Successfully";
  }
}
// }
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
                <a class="nav-link" href="addPost.php">Add New Post</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">English</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">العربية</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>
 <!-- Page Content -->
 <div class="page-heading products-heading header-text">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="text-content">
              <h4>Edit Post</h4>
              <h2>edit your personal post</h2>
            </div>
          </div>
        </div>
      </div>
    </div>

<div class="container w-50 ">
<div class="d-flex justify-content-center">
    <h3 class="my-5">edit Post</h3>
  </div>
  <form method="POST" action="" enctype="multipart/form-data">
    <div style="color:green; text-align:center"><?= (isset($succ)) ? $succ : '' ?></div>
    <div style="color:red; text-align:center"><?= (isset($fil)) ? $fil : '' ?></div>
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="<?= $data['title'] ?>">
    </div>
    <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        <textarea class="form-control" id="body" name="body" rows="5"><?= $data['body'] ?></textarea>
    </div>
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <!-- Display the current image -->
        <img src="upload_posts_img/<?=$data['image'] ?>" alt="" width="100px" srcset="">
        <input type="file" class="form-control-file" id="image" name="image">
        <input type="hidden" name="old_image" value="<?= $data['image'] ?>">
    </div>
    <button type="submit" class="btn btn-primary" name="update">Submit</button>
</form>

<!-- <div class="mb-3"> 
<label for="body" class="form-label">image</label>
<input type="file" class="form-control-file" id="image" name="image" value="<?="upload_posts_img/".$old_img?>"> 
<input type="hidden" name="old_image" value="<?=$old_img?>"> 
</div> 
<img src="upload_posts_img/<?php echo $data['image']?>" alt="" width="100px" srcset=""> 
<button type="submit" class="btn btn-primary" name="update">Submit</button> 
</form> 
</div> ___ -->

<?php require 'headers/footer.php'?>