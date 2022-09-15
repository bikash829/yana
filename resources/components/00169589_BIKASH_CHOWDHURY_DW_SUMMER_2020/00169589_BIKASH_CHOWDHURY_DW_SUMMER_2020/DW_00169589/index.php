<?php
session_start();
$title = "Air Pollution";
$hover_nav = "home";
include_once "layouts/head.php";
include_once  "layouts/nav.php";
$contact_link = 'contact.php';

//Database connection
include_once "config/db_connection.php";
$con = connection();

?>


<!--my video -->
<div class="jumbotron p-0">
        <div class="lead">
            <video  class=" " width="100%"  autoplay muted loop id="myVideo">
                <source src="videos/background_video.mp4" type="video/mp4">
                Your browser does not support HTML5 video.
            </video>
        </div>
    <?php if (isset($_SESSION['user_info']['city'])){ ?>
    <div class="carousel-caption d-none d-md-block">
        <h1 class="display-2 text-primary"><?=ucwords($_SESSION['user_info']['city'])?></h1>
        <h1>City</h1>
    </div>
    <?php } ?>
    </div>

<section class="ftco-section ftco-services">
    <div class="container">
       <div class="row">
       <?php
       $sql = "SELECT * FROM blog;";
       $blog_data_set = $con->query($sql);

       if ($blog_data_set->num_rows >= 3){
           $store_for_post = array();
           $count = 0 ;
           foreach ($blog_data_set as $row){
               $count++;
               if ($count<=3){
                   array_push($store_for_post,$row);
                   if ($count==3){
                       foreach ($store_for_post as $item){
                           $explode_blog = explode(' ',$item['blog_details']);
                           $count_p = 0;
                           $short_blog = "";
                           $date = date($row['post_date']);
                           foreach ($explode_blog as $value){
                               $count_p++;
                               if ($count_p<=20){
                                   $short_blog .= $value.' ';
                               }
                           }

                           $file_location = "images/blog_image/".$item['image_name'].'.'.$item['image_ext'];
                           ?>

                <div class="col-md-4 d-flex services align-self-stretch px-4 ftco-animate">
                    <div class="d-block services-wrap text-center">
                        <div class="img" style="background-image: url(<?=$file_location?>);"></div>
                        <div class="media-body p-2 mt-3">
                            <h6 class="heading"><?=$item['blog_head']?></h6>
                            <p class="small"><?=$short_blog?></p>
                            <p><a href="blog-single.php?bid=<?=$item['id']?>" class="btn btn-primary btn-outline-primary">Read more</a></p>
                        </div>
                    </div>
                </div>

                    <?php
                }
            }
        }
    }
} ?>
            </div>
        </div>
    </section>

<section class="ftco-section ftco-no-pt ftco-no-pb bg-light">
			<div class="container">
				<div class="row no-gutters">
					<div class="col-md-5 p-md-5 img img-2 mt-5 mt-md-0" style="background-image: url(images/other_images/global-warming-18616-1548326701.jpg);">
					</div>
					<div class="col-md-7 wrap-about py-4 py-md-5 ftco-animate">
	          <div class="heading-section mb-5">
	          	<div class="pl-md-5">
		          	<span class="subheading mb-2">Welcome to Air Pollution Prevention Community.</span>
		            <h2 class="mb-2">Did you know? What is air pollution and how its effecting the earth environment ?</h2>
	            </div>
	          </div>
	          <div class="pl-md-5">
							<p>Air pollution occurs when harmful or excessive quantities of substances are introduced into Earth's atmosphere. Sources of air pollution include gases (such as ammonia, carbon monoxide, sulfur dioxide, nitrous oxides, methane and chlorofluorocarbons), particulates (both organic and inorganic), and biological molecules. It may cause diseases, allergies and even death to humans; it may also cause harm to other living organisms such as animals and food crops, and may damage the natural or built environment. Both human activity and natural processes can generate air pollution. </p>
							<p>Air pollution is a significant risk factor for a number of pollution-related diseases, including respiratory infections, heart disease, COPD, stroke and lung cancer.[1] The human health effects of poor air quality are far reaching, but principally affect the body's respiratory system and the cardiovascular system. Individual reactions to air pollutants depend on the type of pollutant a person is exposed to, the degree of exposure, and the individual's health status and genetics.[2] Indoor air pollution and poor urban air quality are listed as two of the world's worst toxic pollution problems in the 2008 Blacksmith Institute World's Worst Polluted Places report.[3] Outdoor air pollution alone causes 2.1[4][5] to 4.21 million deaths annually.[1][6] Overall, air pollution causes the deaths of around 7 million people worldwide each year, and is the world's largest single environmental health risk.</p>
						</div>
					</div>
				</div>
			</div>
		</section>

<!--Rss feed-->
<section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center pb-5 mb-3">
                <div class="col-md-7 heading-section text-center ftco-animate">
                    <h1>Air Pollution Rss Feed Updates</h1>
                </div>
            </div>

            <div class="row">
                <?php $update_air = simplexml_load_file("http://feeds.enviroflash.info/rss/realtime/162.xml"); ?>
                <div class="col-md-6  ftco-animate">
                    <div class="blog-entry text-center align-self-stretch">
                        <h3><?=$update_air->channel->title?></h3>
                        <div><?=$update_air->channel->pubDate?></div>
                        <div><a href="#"><?=$update_air->channel->link?></a></div>
                        <p><?=$update_air->channel->description?></p>
                        <?php foreach ($update_air->channel->item as $row){ ?>
                            <h2 class="text-center"><?=$row->title?></h2>
                            <div class="row justify-content-center"><?=$row->description?></div>
                        <?php } ?>
                    </div>
                </div>

                <?php $update_air = simplexml_load_file("http://feeds.enviroflash.info/rss/realtime/13.xml"); ?>
                <div class="col-md-6 d-flex ftco-animate">
                    <div class="blog-entry text-center align-self-stretch">
                        <h3><?=$update_air->channel->title?></h3>
                        <div><?=$update_air->channel->pubDate?></div>
                        <div><a href="#"><?=$update_air->channel->link?></a></div>
                        <p><?=$update_air->channel->description?></p>
                        <?php foreach ($update_air->channel->item as $row){ ?>
                            <h2 class="text-center"><?=$row->title?></h2>
                            <div class="row justify-content-center"><?=$row->description?></div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

<section class="ftco-section ftco-no-pb bg-light">

      <div class="container">
          <div class="row justify-content-center pb-5 mb-3">
              <div class="col-md-7 heading-section text-center ftco-animate">

                  <h1>Articles of Air Pollution</h1>
              </div>
          </div>
        <div class="row ftco-animate">
          <div class="col-md-12">
          	<div class="carousel-stories owl-carousel">


                <?php
                $sql = "SELECT * FROM blog;";
                $blog_data = $con->query($sql);

                foreach ($blog_data as $row){
                    $explode_blog = explode(' ',$row['blog_details']);
                    $count_p = 0;
                    $short_blog = "";
                    foreach ($explode_blog as $value){
                        $count_p++;
                        if ($count_p<=130){
                            $short_blog .= $value.' ';
                        }
                    }

                    $file_location = "images/blog_image/".$row['image_name'].'.'.$row['image_ext'];

                ?>
                <div class="item">



                    <div class="row justify-content-center">
                        <div class="col-md-11">
                            <div class="stories-wrap d-md-flex">
                                <div class="img" style="background-image: url(<?=$file_location?>);"></div>
                                <div class="text p-4 py-xl-5 px-xl-5 d-flex align-items-center">
                                    <div class="desc w-100">
                                        <h3><?=$row['blog_head']?></h3>
                                        <p><?=$row['post_date']?></p>
                                        <p><?=$short_blog?>..............</p>

                                        <button type="button" onclick="window.location.href='blog-single.php?bid=<?=$row['id']?>'" class="btn btn-primary">Read more</button>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

            </div>
          </div>
        </div>
      </div>


    </section>

<!--image gallery-->
<section class="ftco-section testimony-section bg-light">
        <div class="container">
            <div class="row justify-content-center pb-5 mb-3">
                <div class="col-md-7 heading-section text-center ftco-animate">

                    <h1>Images Of Polluting Air And Environment</h1>
                </div>
            </div>
            <div class="row ftco-animate">
                <div class="col-md-12">
                    <div class="carousel-testimony owl-carousel">
                        <div class="item">
                            <img src="images/image_gallery/Air-pollution.jpg" alt="Loading">
                        </div>
                        <div class="item">
                            <img src="images/image_gallery/air-pollution.png" alt="Loading">
                        </div>
                        <div class="item">
                            <img src="images/image_gallery/bg_1.jpg" alt="Loading">
                        </div>

                        <div class="item">
                            <img src="images/image_gallery/f-d edfd0750b76937ce1c2c0b4210.jpg" alt="Loading">
                        </div>
                        <div class="item">
                            <img src="images/image_gallery/image.php.jpg" alt="Loading">
                        </div>
                        <div class="item">
                            <img src="images/image_gallery/image1.jpg" alt="Loading">
                        </div>
                        <div class="item">
                            <img src="images/image_gallery/Pollution-skies-Mexico-City.jpg" alt="Loading">
                        </div>

                        <div class="item">
                            <img src="images/image_gallery/6666b8c064c2b76dc709e57c7d2aae12.jpg" alt="Loading">
                        </div>
                        <div class="item">
                            <img src="images/image_gallery/180228160139-air-pollution-asia-4-exlarge-169.jpg" alt="Loading">
                        </div>
                        <div class="item">
                            <img src="images/image_gallery/CarPollutionInsideCar.jpg" alt="Loading">
                        </div>
                        <div class="item">
                            <img src="images/image_gallery/file72b25wdpykn1f1okjb7k-1544470633.jpg" alt="Loading">
                        </div>
                        <div class="item">
                            <img src="images/image_gallery/photo.jpg" alt="Loading">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php
include_once "layouts/footer.php";
?>