<?php
session_start();
$title = "Air Pollution";
$hover_nav = "blog";

$banner_location = 'images/banner/banner_2.png';
$banner_heading = "All Post";

include_once "layouts/head.php";
include_once "layouts/nav.php";
include_once "layouts/banner.php";
include "config/db_connection.php";
$con = connection();

$sql = "SELECT * FROM blog";
$blog_data_set = $con->query($sql);
?>

		
    <section class="ftco-section">
      <div class="container">
        <div class="row">
          <div class="col ftco-animate">
              <!-------Blog Content ----------->
              <?php foreach($blog_data_set as $row){
                  //Zipping paragraph
                  $explode_blog = explode(' ',$row['blog_details']);
                  $count = 0;
                  $short_blog = "";
                  $date = date($row['post_date']);
                  foreach ($explode_blog as $value){
                      $count++;
                      if ($count<=60){
                          $short_blog .= $value.' ';
                      }
                  }
                  //file accessing
                  $file_location = "images/blog_image/".$row['image_name'].'.'.$row['image_ext']

                  ?>
              <div class="blog-entry align-self-stretch">
                  <h1 class="heading"><?=$row['blog_head']?></h1>
                  <a href="blog-single.php?bid=<?=$row['id']?>" class="block-20 rounded img-2" style="background-image: url('<?=$file_location?>');">
                  </a>
                  <div class="text mt-3">
                      <div class="meta mb-2">
                          <div><a href="#"><?=$date?></a></div>
                      </div>
                      <h3 class="heading"><a href="#"><?=$row['blog_head']?></a></h3>
                      <p><?=$short_blog.'.....'?></p>
                      <p><a href="blog-single.php?bid=<?=$row['id']?>" class="btn btn-primary">Read more</a></p>
                  </div>
              </div>
              <?php } ?>

          </div> <!-- .col-md-8 -->

        </div>
      </div>
    </section> <!-- .section -->

<?php
include_once "layouts/footer.php";
?>
