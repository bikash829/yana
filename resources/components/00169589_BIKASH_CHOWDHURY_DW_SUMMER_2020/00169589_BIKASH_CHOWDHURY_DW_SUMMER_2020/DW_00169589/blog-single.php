<?php
session_start();
$title = "Air Pollution";

$banner_location = 'images/banner/banner_5.jpg';
$banner_heading = "Blog details";

include_once "layouts/head.php";
include_once "layouts/nav.php";
include_once "layouts/banner.php";


//database connection
include "config/db_connection.php";
$con = connection();

if (isset($_GET['bid'])){
    $bid = $_GET['bid'];
    $sql = "SELECT * FROM blog WHERE id = $bid";
    $row = $con->query($sql)->fetch_assoc();

    $file_location = "images/blog_image/".$row['image_name'].'.'.$row['image_ext'];
}

?>
    <section class="ftco-section pt-3 ftco-degree-bg">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-10 col-12 col-lg-10 ftco-animate">
              <h1 class="mb-3"><?=$row['blog_head']?></h1>
              <p><img src="<?=$file_location?>" alt="" class="img-fluid"></p>
              <h5><?=$row['post_date']?></h5>
              <p><?=$row['blog_details']?></p>
          </div> <!-- .col-md-8 -->
        </div>
      </div>
    </section> <!-- .section -->

<?php
include_once "layouts/footer.php";
?>
