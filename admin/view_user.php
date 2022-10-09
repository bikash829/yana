<?php

include_once "./admin-layouts/head.php";
include_once "./admin-layouts/nav.php";



include "../config/db_connection.php";
$validation = true;
$validation_message = [];



if (isset($_GET['view_user'])) {
    $user_id = $_GET['user_id'];



    $sql = "SELECT `users`.*,`users`.phone_code AS `phone_code_id`, `additional_info`.`working_info`,`additional_info`.`education` AS `education_info`, `additional_info`.`document_name` AS `education_proof`,`additional_info`.`document_location` AS `education_proof_location`, `country`.`name` AS `country_name`, `country`.`phonecode` AS `phone_code` FROM `users` 
    INNER JOIN `additional_info` ON `users`.`id` = `additional_info`.`user_id`
    INNER JOIN `country` ON `users`.`country_id` = `country`.`id`
    WHERE `users`.`id` = $user_id;";


    if ($data_set = db_connection()->query($sql)) {
        $data  = $data_set->fetch_assoc();
        if ($data == NULL) {
            $validation = false;
            $validation_message['empty_user'] = "There is no more user exist";
        }
    } else {
        $validation = false;
        $validation_message['error'] = "Technical Error";
    }
} else {
    $validation = false;
    $validation_message['bad_req'] = "You shouldn't be here";
}





?>
<div id="layoutSidenav">
    <!-- aside  -->
    <?php include_once "./admin-layouts/aside.php"; ?>
    <div id="layoutSidenav_content">

        <?php
        if ($validation && $data != NULL) {


            $img_location = '.' . $data['profile_location'] . $data['profile_photo'];
            // $id = $data['id'];
            $address = $data['addr'] . ', ' . $data['city'] . '-' . $data['zip_code'];
        ?>
            <!-- view section  -->

            <main class="main">
                <section class="profile mt-2">

                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-10">
                            <div class="card">
                                <div class="card-header">
                                    <?= $data['f_name'] . $data['l_name'] ?>

                                </div>
                                <div class="card-body position-relative">

                                    <div class=" px-3">
                                        <div class="row g-0 ">

                                            <div class="col-md-4 col-lg-4 align-self-center">

                                                <img src=".<?= $data['profile_location'] . $data['profile_photo'] ?>" class="img-fluid rounded-start" alt="There is no photo uploaded yet">
                                                <!-- <p class="text-center"><a href="#" data-bs-toggle="modal" data-bs-target="#change_pp">Change Photo</a></p> -->
                                            </div>
                                            <div class="col-md-7 col-lg-7 ms-4">
                                                <div class="card-body profile-details">

                                                    <div class="form-group">
                                                        <h5 class="mb-0"><?= ucwords($data['f_name'])  . ' ' .ucwords($data['l_name']) ?></h5>
                                                    </div>
                                                    <div class="form-group pb-3 text-secondary">
                                                        <?= ucwords($data['role']) ?>
                                                    </div>
                                                    <div class="form-group py-2">

                                                        <span><i class="fa-solid fa-envelope"></i><a href="mailto:<?= $data['email'] ?>"><?= $data['email'] ?></a> </span>
                                                        <!-- <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a data-bs-toggle="modal" data-bs-target="#change_email" href="#">change email</a> -->
                                                    </div>
                                                    <div class="form-group py-2">
                                                        <span><i class="fa-solid fa-address-book"></i> <?= $data['phone_code'] . ' ' .  $data['phone_number'] ?></span>
                                                    </div>
                                                    <div class="form-group py-2">
                                                        <span><i class="fa-solid fa-cake-candles"></i> <?= $data['date_of_birth'] ?></span>

                                                    </div>

                                                    <div class="form-group py-2">
                                                        <span> <i class="fa-solid fa-graduation-cap"></i> <?= $data['education_info'] ?></span><br>
                                                        <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a data-bs-toggle="modal" data-bs-target="#education_certificates" href="#">View Document</a></span>
                                                    </div>


                                                    <div class="form-group py-2">
                                                        <span><i class="fa-solid fa-briefcase"></i></span> <?= $data['working_info'] ?>
                                                    </div>

                                                    <div class="form-group py-2">
                                                        <span><i class="fa-solid fa-location-dot"></i> <?= $address ?></span>
                                                    </div>
                                                    <div class="form-group py-2">
                                                        <span><i class="fa-solid fa-flag"></i> <?= $data['country_name'] ?></span>
                                                    </div>


                                                    <!-- <div class="form-group mt-4">
                                                <div class="row gap-2">
                                                    <a class="btn btn-primary col" data-bs-toggle="modal" data-bs-target="#change_password">Change Password</a>
                                                    <a href="./edit_user.php" class="btn btn-primary col">Edit Information </a>
                                                </div>

                                    
                                            </div> -->
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
        } else {
            foreach ($validation_message as $message) {
                echo "<h1 class='text-center'>" . "$message" . "</h1>" . "<br>";
            }
        }
        ?>



        <!-- footer  -->
        <?php include_once "./admin-layouts/footer.php"; ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="js/datatables-simple-demo.js"></script>
</body>

</html>