<?php
$title = "Appointment";
$state = "doctor_appointment";
$banner_title = "";
$banner_poster = "./images/banner/banner3.jpg";

include_once "./layout/head.php";
$banner = "./layout/banner.php";
include_once "./layout/navigation_bar.php";



include "./config/db_connection.php";


function rating_calculator($id)
{
    $councilor_id = $id;

    $sql = "SELECT AVG(rating_count) AS rating  FROM feedback WHERE ser_provider_id = $councilor_id;";

    if ($rating_set = db_connection()->query($sql)) {
        if ($rating_set->num_rows > 0) {
            return number_format(($rating_set->fetch_assoc())['rating'], 1);
        } else {
            return 0;
        }
    } else {
        return false;
    }
}





// experts information 
$sql = "SELECT `users`.* ,`country`.`name` AS `country_name`, `country`.`phonecode` AS `phone_code`, `additional_info`.`bio`, 
        `additional_info`.`education`, `additional_info`.`working_info`,`additional_info`.`professional_skills`
        FROM `users`
        INNER JOIN `country` ON `users`.`country_id` = `country`.`id`
        INNER JOIN `additional_info` ON `additional_info`.`user_id` = `users`.`id`
        WHERE `users`.`status` = 1;
        ";
if ($special_user_set = db_connection()->query($sql)) {
    $special_user = $special_user_set->fetch_all(MYSQLI_ASSOC);
} else {
    $validation = "Technical Error";
}

// social links 


?>

<main class="main">
    <section class="specialist segment-margin-side">
        <div class="d-grid gap-2 mb-4"><a href="./upcomming_appointment.php" class="btn btn-lg btn-primary">Upcomming Appointments</a></div>
        <div class="section-heading">
            <h3 class="section-heading__title">
                Experts And Councilors
            </h3>
        </div>

        <div class="accordion" id="accordionPanelsStayOpenExample">
            <!--\\\\\\\\\\\\\\\\\\ councilor list  ////////////////-->
            <div class="accordion-item">
                <h2 class="accordion-header " id="panelsStayOpen-headingTwo">
                    <button class="accordion-button collapsed accordion-button--custom" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                        Councilors
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                    <div class="accordion-body">
                        <div class="specialist__card-container">

                            <?php foreach ($special_user as $row) {
                                if ($row['role_id'] == 2 && $row['status'] == 1) {

                                    if (!empty($row['profile_photo'])) {
                                        $pp_location = $row['profile_location'] . $row['profile_photo'];
                                    } else {
                                        $pp_location = "./images/profile_pic/blank-profile-picturepng.png";
                                    }

                                    $user_id = $row['id'];
                                    $sql = "SELECT  `social_medium`.`id` AS `medium_id`, `social_medium`.`medium`,`social_user_link`.`link` AS `social_link` 
                                            FROM `users`
                                            INNER JOIN `social_user_link` ON `social_user_link`.`user_id` = `users`.`id`
                                            INNER JOIN  `social_medium` ON `social_medium`.`id`  = `social_user_link`.`medium_id`
                                            WHERE `users`.`id` = $user_id;";


                                    if ($social_info_set = db_connection()->query($sql)) {
                                        $social_info = $social_info_set->fetch_all(MYSQLI_ASSOC);
                                    } else {
                                        $validation  = "Technical error contact with developer";
                                    }
                            ?>

                                    <div class="specialist__card">
                                        <div class="specialist__img-con">
                                            <img class="specialist__img" src="<?= $pp_location ?>" alt="">
                                        </div>

                                        <div class="specialist__info ">
                                            <input type="hidden" id='user_id' value="<?= $row['id'] ?>">
                                            <div class="person">
                                                <h3 class="person__name"><?= $row['f_name'] . ' ' . $row['l_name'] ?></h3>
                                                <h3 class="person__occu"><?= $row['education'] ?></h3>
                                            </div>
                                            <p class="person__description">
                                                <?= $row['bio'] ?>
                                            </p>

                                            <div class="specialist__links">
                                                <?php
                                                if (!empty($social_info)) {


                                                    foreach ($social_info as $social_row) {
                                                        $fb_count = 0;
                                                        if ($social_row['medium_id'] == 1 && $fb_count < 1) {
                                                            $fb_count++;
                                                ?>
                                                            <a href="<?= $social_row['social_link'] ?>" title="click here to visit my facebook wall" class="specialist__icon"><i class="fa-brands fa-facebook"></i></a>
                                                        <?php
                                                        }
                                                        $tw_count = 0;
                                                        if ($social_row['medium_id'] == 6 && $tw_count < 1) {
                                                            $tw_count++;
                                                        ?>
                                                            <a href="<?= $social_row['social_link'] ?>" title="click to follow twitter" class="specialist__icon"><i class="fa-brands fa-square-twitter"></i></a>

                                                        <?php
                                                        }
                                                        $web_count = 0;
                                                        if ($social_row['medium_id'] == 3 && $web_count < 1) {
                                                            $web_count++;
                                                        ?>
                                                            <a href="<?= $social_row['social_link'] ?>" title="click to visit web site" class="specialist__icon"><i class="fa-solid fa-globe"></i></a>
                                                        <?php
                                                        }
                                                        $lnkdn_count = 0;
                                                        if ($social_row['medium_id'] == 4  && $lnkdn_count < 1) {
                                                            $lnkdn_count++;
                                                        ?>
                                                            <a href="<?= $social_row['social_link'] ?>" title="click to visit linkdin profile" class="specialist__icon"><i class="fa-brands fa-linkedin"></i></a>

                                                <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </div>
                                            <div class="text-warning">Rating : <?= rating_calculator($row['id']) ?></div>
                                        </div>
                                        <button name="btn-councilor" value="" class="specialist_view">View Info</button>
                                    </div>

                            <?php }
                            }  ?>




                        </div>

                    </div>
                </div>
            </div>

            <!-- doctor list  -->
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button accordion-button--custom" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                        Doctors
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-headingOne">
                    <div class="accordion-body">
                        <div class="specialist__card-container">

                            <?php foreach ($special_user as $row) {

                                if (!empty($row['profile_photo'])) {
                                    $pp_location = $row['profile_location'] . $row['profile_photo'];
                                } else {
                                    $pp_location = "./images/profile_pic/blank-profile-picturepng.png";
                                }

                                // print_r($row);
                                if ($row['role_id'] == 3 && $row['status'] == 1) {
                                    $user_id = $row['id'];
                                    $sql = "SELECT  `users`.`id`,`social_medium`.`id` AS `medium_id`, `social_medium`.`medium`,`social_user_link`.`link` AS `social_link` 
                                            FROM `users`
                                            INNER JOIN `social_user_link` ON `social_user_link`.`user_id` = `users`.`id`
                                            INNER JOIN  `social_medium` ON `social_medium`.`id`  = `social_user_link`.`medium_id`
                                            WHERE `users`.`id` = $user_id;";


                                    if ($social_info_set = db_connection()->query($sql)) {
                                        $social_info = $social_info_set->fetch_all(MYSQLI_ASSOC);
                                    } else {
                                        $validation  = "Technical error contact with developer";
                                    }
                            ?>
                                    <div class="specialist__card">
                                        <div class="specialist__img-con">
                                            <img class="specialist__img" src="<?= $pp_location ?>" alt="">
                                        </div>

                                        <div class="specialist__info ">
                                            <input type="hidden" id='user_id' value="<?= $row['id'] ?>">
                                            <div class="person">
                                                <h3 class="person__name">Dr. <?= $row['f_name'] . ' ' . $row['l_name'] ?></h3>
                                                <h3 class="person__occu"><?= $row['education'] ?></h3>
                                            </div>
                                            <p class="person__description">
                                                <?= $row['bio'] ?>
                                            </p>

                                            <div class="specialist__links">
                                                <?php
                                                if (!empty($social_info)) {


                                                    foreach ($social_info as $social_row) {



                                                        $fb_count = 0;
                                                        if ($social_row['medium_id'] == 1 && $fb_count < 1) {
                                                            $fb_count++;
                                                ?>
                                                            <a href="<?= $social_row['social_link'] ?>" title="click here to visit my facebook wall" class="specialist__icon"><i class="fa-brands fa-facebook"></i></a>
                                                        <?php
                                                        }
                                                        $tw_count = 0;
                                                        if ($social_row['medium_id'] == 6 && $tw_count < 1) {
                                                            $tw_count++;
                                                        ?>
                                                            <a href="<?= $social_row['social_link'] ?>" title="click to follow twitter" class="specialist__icon"><i class="fa-brands fa-square-twitter"></i></a>

                                                        <?php
                                                        }
                                                        $web_count = 0;
                                                        if ($social_row['medium_id'] == 3 && $web_count < 1) {
                                                            $web_count++;
                                                        ?>
                                                            <a href="<?= $social_row['social_link'] ?>" title="click to visit web site" class="specialist__icon"><i class="fa-solid fa-globe"></i></a>
                                                        <?php
                                                        }
                                                        $lnkdn_count = 0;
                                                        if ($social_row['medium_id'] == 4  && $lnkdn_count < 1) {
                                                            $lnkdn_count++;

                                                        ?>
                                                            <a href="<?= $social_row['social_link'] ?>" title="click to visit linkdin profile" class="specialist__icon"><i class="fa-brands fa-linkedin"></i></a>

                                                <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <button id="specialist_view" class="specialist_view">View Info</button>
                                    </div>
                            <?php }
                            } ?>


                        </div>

                    </div>
                </div>
            </div>



        </div>
    </section>
</main>

<?php
include_once "./layout/footer.php"
?>

<script type="text/javascript">
    let specialistCard = document.querySelectorAll(".specialist__card");
    let btnCouncilor = document.querySelectorAll("[name='btn-councilor']");

    // login checker 
    let loginCheck = <?= json_encode(isset($_SESSION['user'])) ?> ?? false;



    // cards for specialist 
    for (let card of specialistCard) {
        let viewSpecialist = card.lastElementChild;
        let user_id = card.getElementsByTagName('input').user_id;
        card.addEventListener("mouseover", (e) => {
            viewSpecialist.style.display = 'block';
        });
        card.addEventListener("mouseout", (e) => {
            viewSpecialist.style.display = 'none';
        });


        viewSpecialist.addEventListener('click', (e) => {
            if ((e.target).name == 'btn-councilor') {
                if (loginCheck) {
                    window.location = './super_user_profile.php?id =' + user_id.value;
                } else {
                    Swal.fire(
                        'Login?',
                        'Please login first to contact with councilor free',
                        'warning'
                    )
                }

            } else {
                window.location = './super_user_profile.php?id =' + user_id.value;
            }

        });
    }
</script>



<!-- alert notification -->
<?php
include "./functionalities/alert.php";


if (isset($_SESSION['user_feedback'])) {
    $alert_status = alert($_SESSION['user_feedback']);
    unset($_SESSION['user_feedback']);
} else {
    $alert_status = false;
}
?>


<script type="text/javascript">
    // validation message 
    alertStatus = <?= json_encode($alert_status ?? null) ?>;
    if (alertStatus) {
        Swal.fire({
            position: 'top-end',
            icon: alertStatus.status,
            title: alertStatus.message,
            showConfirmButton: false,
            timer: 2500
        })
    }
</script>