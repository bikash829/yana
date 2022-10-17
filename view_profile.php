<?php
//session_start();

$title = "Profile";
$state = "register";


include_once "./layout/head.php";

$banner_title = "Hi, " . ucwords($_SESSION['user']['f_name']);
$banner_poster = "./images/banner/banner3.jpg";


$banner = "./layout/banner.php";
include_once "./layout/navigation_bar.php";
include "./config/db_connection.php";


if (isset($_SESSION['user'])) {
    $img_location = $_SESSION['user']['profile_location'] . $_SESSION['user']['profile_photo'];
    $id = $_SESSION['user']['id'];
    $address = $_SESSION['user']['addr'] . ', ' . $_SESSION['user']['city'] . '-' . $_SESSION['user']['zip_code'];
} else {
    header("Location: ./index.php");
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

                        <div class=" px-3">
                            <div class="row g-0 ">

                                <div class="col-md-4 col-lg-4 align-self-center">

                                    <img src="<?= $_SESSION['user']['profile_location'] . $_SESSION['user']['profile_photo'] ?>" class="img-fluid rounded-start" alt="...">
                                    <p class="text-center"><a href="#" data-bs-toggle="modal" data-bs-target="#change_pp">Change Photo</a></p>
                                </div>
                                <div class="col-md-7 col-lg-7 ms-4">
                                    <div class="card-body profile-details">

                                        <div class="form-group">
                                            <h5 class="mb-0"><?= ucwords($_SESSION['user']['full_name'] ) ?></h5>
                                        </div>
                                        <div class="form-group pb-3 text-secondary">
                                            <?= ucwords($_SESSION['user']['role']) ?>
                                        </div>
                                        <div class="form-group py-2">

                                            <span><i class="fa-solid fa-envelope"></i> <?= $_SESSION['user']['email'] ?></span>
                                            <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a data-bs-toggle="modal" data-bs-target="#change_email" href="#">change email</a>
                                        </div>
                                        <div class="form-group py-2">
                                            <span><i class="fa-solid fa-address-book"></i> <?= $_SESSION['user']['phone_code'] . ' ' .  $_SESSION['user']['phone_number'] ?></span>
                                        </div>
                                        <div class="form-group py-2">
                                            <span><i class="fa-solid fa-cake-candles"></i> <?= $_SESSION['user']['date_of_birth'] ?></span>

                                        </div>

                                        <div class="form-group py-2">
                                            <span> <i class="fa-solid fa-graduation-cap"></i> <?= $_SESSION['user']['education_info'] ?></span><br>
                                            <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a data-bs-toggle="modal" data-bs-target="#education_certificates" href="#">View Document</a></span>
                                        </div>


                                        <div class="form-group py-2">
                                            <span><i class="fa-solid fa-briefcase"></i></span> <?= $_SESSION['user']['working_info'] ?>
                                        </div>

                                        <div class="form-group py-2">
                                            <span><i class="fa-solid fa-location-dot"></i> <?= $address ?></span>
                                        </div>
                                        <div class="form-group py-2">
                                            <span><i class="fa-solid fa-flag"></i> <?= $_SESSION['user']['country_name'] ?></span>
                                        </div>


                                        <div class="form-group mt-4">
                                            <div class="row gap-2">
                                                <a class="btn btn-primary col" data-bs-toggle="modal" data-bs-target="#change_password">Change Password</a>
                                                <a href="./edit_user.php" class="btn btn-primary col">Edit Information </a>
                                            </div>

                                            <!--                                            <li></li>-->
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
// include_once "./functionalities/form-validation.php";
include_once "./modals/view_profile_modal.php";


include "./functionalities/form-validation.php";
include_once "./layout/footer.php";

?>


<?php 
include_once "./functionalities/alert.php";


if (isset($_SESSION['edit_info'])) {
    // var_dump($_SESSION['edit_info']);
    $alert_status = alert($_SESSION['edit_info']);
    unset($_SESSION['edit_info']);
} else {
    $alert_status = false;
}


?>

<script type="text/javascript">
    // validation message 
    console.log(<?=json_encode($alert_status)?>);
    alertStatus = <?= json_encode($alert_status ?? null) ?>;
    console.log(alertStatus)
    if (alertStatus) {
        Swal.fire({
            position: 'top-end',
            icon: alertStatus.status,
            title: alertStatus.message,
            showConfirmButton: false,
            timer: 4000
        })
    }


</script>
