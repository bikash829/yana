<?php
$title = "Profile";

include_once "./layout/head.php";

// $banner_title = "Hi, " . ucwords($_SESSION['user']['f_name']);
$banner_poster = "./images/banner/banner3.jpg";


$banner = "./layout/banner.php";
include_once "./layout/navigation_bar.php";
include "./config/db_connection.php";


$patient_id = $_SESSION['user']['id'];



//user data 

if (isset($_GET['id_'])) {
    $user_id = $_GET['id_'];

    function next_appointment($uid)
    {
        $user_id = $uid;
        $sql = "SELECT * FROM appointment WHERE doctor_id = $user_id";
        $next_appointment = [];



        if ($appointmnet_data = db_connection()->query($sql)) {
            $appointment_list = $appointmnet_data->fetch_all(MYSQLI_ASSOC);

            foreach ($appointment_list as $row) {

                $diff = floor((time() - strtotime($row['ap_date'])) / (60 * 60 * 24));
                if ($diff < 0) {
                    array_push($next_appointment, $row);
                }
            }

            return $next_appointment;
        }
    }



    $next_appointment = next_appointment($user_id);
    $sql = "SELECT `users`.* ,`country`.`name` AS `country_name`, `country`.`phonecode` AS `phone_code`, `additional_info`.`bio`,`additional_info`.`id` AS `info_id` , `additional_info`.`education` AS 'education_info', `additional_info`.`working_info`
            FROM `users`
            INNER JOIN `country` ON `users`.`country_id` = `country`.`id`
            INNER JOIN `additional_info` ON `additional_info`.`user_id` = `users`.`id`
            WHERE `users`.`id` = $user_id;
            ";

    if ($user_info = db_connection()->query($sql)) {
        $data = $user_info->fetch_assoc();
    }
    // role defining 
    switch ($data['role_id']) {
        case 1:
            $data['role'] = "admin";
            break;
        case 2:
            $data['role'] = "councilor";
            break;
        case 3:
            $data['role'] = "doctor";
            break;
        case 4:
            $data['role'] = "patient";
            break;

        default:
            $data['role'] = "others";
            break;
    }



    $sql = "SELECT  `social_medium`.`id` AS `medium_id`, `social_medium`.`medium`,`social_user_link`.`link` AS `social_link` 
            FROM `users`
            INNER JOIN `social_user_link` ON `social_user_link`.`user_id` = `users`.`id`
            INNER JOIN  `social_medium` ON `social_medium`.`id`  = `social_user_link`.`medium_id`
            WHERE `users`.`id` = $user_id;";


    if ($social_info_set = db_connection()->query($sql)) {
        $social_info = $social_info_set->fetch_all(MYSQLI_ASSOC);

        $data['social_info'] = $social_info;
    }
} else {
    $validation_message   = "Invalid request";
    print_r($validation_message);
    exit();
}


// appointment data 

?>


<main class="main">
    <section class="profile my-5">

        <!-- appointment for doctor  -->
        <?php if ($data['role'] == 'doctor') { ?>
            <div class="row justify-content-center mb-4">
                <div class="col-lg-10 col-12 d-grid gap-2">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#make_appointment" class="btn btn-primary">Make An Appointment</button>

                </div>
            </div>
        <?php } ?>

        <div class="row justify-content-center">
            <div class="col-lg-10 col-12">
                <div class="card">
                    <div class="card-header">
                        <?= ucwords($data['f_name'] . ' ' . $data['l_name']) ?>

                    </div>
                    <div class="card-body position-relative">

                        <div class=" px-3">
                            <div class="row  justify-content-center">
                                <div class="col-12 ">
                                    <div style="width: 15rem;" class="text-center m-auto">
                                        <img src="<?= $data['profile_location'] . $data['profile_photo'] ?>" class="img-fluid rounded-start" alt="There is no photo uploaded yet">

                                    </div>


                                    <!-- <p class="text-center"><a href="#" data-bs-toggle="modal" data-bs-target="#change_pp">Change Photo</a></p> -->
                                </div>
                                <div class="col-12">
                                    <div class="card-body profile-details">

                                        <div class="personal_info row my-2">

                                            <div class="form-group col-md-6 col-lg-6">
                                                <h4 class="mb-0"><?= ucwords($data['f_name'] . ' ' . $data['l_name'])  ?></h4>
                                            </div>
                                            <div class="form-group pb-3 text-secondary ">
                                                <?= ucwords($data['role']) ?>
                                            </div>

                                            <h5 class="form-group">Personal Info</h5>

                                            <div class="form-group py-1 col-md-6 col-lg-6">
                                                <span><i class="fa-solid fa-cake-candles"></i> <?= $data['date_of_birth'] ?></span>

                                            </div>

                                            <div class="form-group py-1 col-md-6 col-lg-6">
                                                <span><i class="fa-solid fa-cake-candles"></i> <?= $data['gender'] ?></span>

                                            </div>

                                            <div class="form-group py-1 col-md-6 col-lg-6">
                                                <span> <i class="fa-solid fa-graduation-cap"></i> <?= $data['education_info'] ?></span><br>
                                                <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a data-bs-toggle="modal" data-bs-target="#education_certificates" href="#">View Document</a></span>
                                            </div>


                                            <div class="form-group py-1 col-md-6 col-lg-6">
                                                <span><i class="fa-solid fa-briefcase"></i></span> <?= $data['working_info'] ?>
                                            </div>

                                            <div class="form-group py-1 col-md-6 col-lg-6">
                                                <span><i class="fa-solid fa-location-dot"></i><?= $data['addr'] . ', ' . $data['city'] . '-' . $data['zip_code'] ?></span>
                                            </div>
                                            <div class="form-group py-1 col-md-6 col-lg-6">
                                                <span><i class="fa-solid fa-flag"></i> <?= $data['country_name'] ?></span>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <!-- contact info  -->
                                            <div class="contact-info col-md-4 col-lg-4 row my-4">
                                                <h5>Contact Info</h5>
                                                <div class="form-group py-1 col-12">

                                                    <span><i class="fa-solid fa-envelope"></i><a href="mailto:<?= $data['email'] ?>"><?= $data['email'] ?></a> </span>
                                                    <!-- <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a data-bs-toggle="modal" data-bs-target="#change_email" href="#">change email</a> -->
                                                </div>
                                                <div class="form-group py-1 col-12">
                                                    <span><i class="fa-solid fa-address-book"></i> <?= $data['phone_code'] . ' ' .  $data['phone_number'] ?></span>
                                                </div>

                                            </div>
                                            <!-- social link  -->
                                            <div class="contact-info col-md-8 col-lg-8 row my-4">
                                                <h5>Social & others</h5>

                                                <?php
                                                foreach ($data['social_info'] as $value) {

                                                ?>

                                                    <div class="form-group py-1 col-12">

                                                        <span><?= $value['medium'] ?>: <a href="#"><?= $value['social_link'] ?></a> </span>

                                                    </div>

                                                <?php
                                                }
                                                ?>
                                            </div>
                                            

                                        </div>

                                        <!-- about bio -->
                                        <div class="form-group row my-4">
                                            <h5 class="">About</h5>
                                            <div class="form-group  col-12">
                                                <?= $data['bio'] ?>
                                            </div>
                                        </div>



                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <?php if ($data['role'] == 'doctor') { ?>
            <div class="row justify-content-center mt-4">
                <div class="col-lg-10 col-12 d-grid gap-2">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#make_appointment" class="btn btn-primary">Make An Appointment</button>

                </div>
            </div>
        <?php } ?>


    </section>
</main>

<?php
// include_once "./functionalities/form-validation.php";
// include_once "./modals/view_profile_modal.php";


include "./functionalities/form-validation.php";
include_once "./layout/footer.php";
include_once "./modals/appointment_modal.php";
?>
<script type="text/javascript">
    $(document).ready(function() {
        $('#appointment_table').DataTable();
    });
</script>