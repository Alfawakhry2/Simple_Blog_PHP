<?php require 'headers/header.php';
require 'db/conn.php'; ?>
<?php
session_start();
if (!isset($_SESSION['user'])) :
    header("location:login.php");
    exit;
endif;
$u_id = $_SESSION['user']['id'];
### select all posts
$posts_query = "SELECT * FROM `posts` WHERE `user_id` =$u_id";
$result = mysqli_query($connection, $posts_query);
$posts = mysqli_fetch_all($result, MYSQLI_ASSOC);

// echo "<pre>";
// print_r($posts);
// echo "</pre>";
// $row_num =mysqli_num_rows($result);

?>
<!-- ***** Preloader Start ***** -->
<!-- <div id="preloader" >
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>   -->
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
                    <li class="nav-item ">
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
<br><br><br><br><br><br>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="section-heading">
                <h2>Your Posts</h2>
                <!-- <a href="products.html">view all products <i class="fa fa-angle-right"></i></a> -->
            </div>
        </div>
        <?php foreach ($posts as $post) : ?>
            <div class="col-md-6">
                <div class="product-item">
                    <a href="#"><img src="<?= "upload_posts_img/" . $post['image'] ?>" alt=""></a>
                    <div class="down-content">
                        <a href="#">
                            <h4><?= $post['title'] ?></h4>
                        </a>
                        <h6>created_at :"<?= $post['created_at'] ?>"</h6>
                        <p><?= $post['body'] ?></p>
                        <form action="viewPost.php" method="POST">
                            <div class="d-flex justify-content-end">
                            <!-- <button name="view" value="View"><a href="viewPost.php?id=<?=$post['id']?>" class="btn btn">view</a></button> -->
                            <input type="hidden" name="id" value="<?=$post['id']?>">
                            <button name="view"  class="btn btn">View</button>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>




<?php require 'headers/footer.php' ?>