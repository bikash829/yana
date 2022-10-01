SET FOREIGN_KEY_CHECKS=0;
DELETE FROM `users` WHERE id = 6;
DELETE FROM `additional_info` WHERE `user_id` = 6;

UPDATE `users

UPDATE `users` SET `status` = '1' WHERE `users`.`id` = 6; 



    
<main class="main">
    <section class="profile mt-2">

        <div class="row justify-content-center">
            <div class="col-lg-8 col-10">
                <div class="card">
                    <div class="card-header">
                        <?= $data['f_name'].$data['l_name'] ?>
                       
                    </div>
                    <div class="card-body position-relative">

                        <div class=" px-3">
                            <div class="row g-0 ">

                                <div class="col-md-4 col-lg-4 align-self-center">

                                    <img src="<?= $data['profile_location'] . $data['profile_photo'] ?>" class="img-fluid rounded-start" alt="...">
                                    <p class="text-center"><a href="#" data-bs-toggle="modal" data-bs-target="#change_pp">Change Photo</a></p>
                                </div>
                                <div class="col-md-7 col-lg-7 ms-4">
                                    <div class="card-body profile-details">

                                        <div class="form-group">
                                            <h5 class="mb-0"><?= $data['f_name'].$data['l_name'] ?></h5>
                                        </div>
                                        <div class="form-group pb-3 text-secondary">
                                            <?= ucwords($data['role']) ?>
                                        </div>
                                        <div class="form-group py-2">

                                            <span><i class="fa-solid fa-envelope"></i> <?= $data['email'] ?></span>
                                            <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a data-bs-toggle="modal" data-bs-target="#change_email" href="#">change email</a>
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