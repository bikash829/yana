<?php
session_start();

$title = "Profile";
$state = "register";

$banner_title = "Hi, " . ucwords($_SESSION['user']['f_name']);
$banner_poster = "./images/banner/banner3.jpg";


include_once "./layout/head.php";
$banner = "./layout/banner.php";
include_once "./layout/navigation_bar.php";
include "./config/db_connection.php";


if(isset($_SESSION['user'])){
    $img_location = $_SESSION['user']['profile_location'] . $_SESSION['user']['profile_photo'];
    $id = $_SESSION['user']['id'];
    $address = $_SESSION['user']['addr'] . ', ' . $_SESSION['user']['city'] . '-' . $_SESSION['user']['zip_code'];

}


?>

<main class="main">
    <section class="profile segment-margin">

        <div class="row justify-content-center">
            <div class="col-lg-8 col-10">
                <div class="card">
                    <div class="card-header">
                        <?= $_SESSION['user']['full_name'] ?>
                    </div>
                    <div class="card-body position-relative">
                        <div class="position-absolute top-0 end-0">
                            <button class="button profile__button-size">Edit Info</button>
                        </div>
                        <div class=" px-3">
                            <div class="row g-0 ">

                                <div class="col-md-4 align-self-center">
                                    <img src="./uploads/profile_photo/Rebecca_pp16632382521876569849.png" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-7 ms-4">
                                    <div class="card-body profile-details">

                                        <div class="form-group">
                                            <h5 class="mb-0"><?= $_SESSION['user']['full_name'] ?></h5>
                                        </div>
                                        <div class="form-group pb-3 text-secondary" >
                                             <?= ucwords($_SESSION['user']['role']) ?>
                                        </div>
                                        <div class="form-group py-2">
                                            <span><i class="fa-regular fa-envelope"></i> <?= $_SESSION['user']['email'] ?></span>
                                        </div>
                                        <div class="form-group py-2">
                                            <span><i class="fa-regular fa-address-book"></i> <?= $_SESSION['user']['phone_number'] ?></span>
                                        </div>
                                        <div class="form-group py-2">
                                            <span><i class="fa-solid fa-cake-candles"></i> <?= $_SESSION['user']['date_of_birth'] ?></span>

                                        </div>

                                        <div class="form-group py-2">
                                            <span> <i class="fa-solid fa-graduation-cap"></i> Education Qualifications</span>
                                        </div>

                                        <div class="form-group py-2">
                                            <span><i class="fa-solid fa-briefcase"></i> work info</span>
                                        </div>

                                        <div class="form-group py-2">
                                            <span><i class="fa-solid fa-location-dot"></i> <?= $address ?></span>
                                        </div>
                                        <div class="form-group py-2">
                                            <span><i class="fa-regular fa-flag"></i> <?= $_SESSION['user']['country_id'] ?></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>



    </section>
</main>

<?php
include_once "./layout/footer.php";
?>