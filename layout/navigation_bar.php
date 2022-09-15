<?php

// page location 
$home = "./index.php";
$doctor_appointment = "./doctor_appointment.php";
$community = "./community.php";
$about = "./about.php";
$contact = "./contact_us.php";
$login = "login.php";
$register = "./register.php";
$doc_reg = "./doc_reg.php";
$councilor_reg = "./councilor_reg.php";



?>


<nav class="mobile-nav">
    <!-- navigation menu bar  -->
    <div class="mobile-nav__close"><i class="fa-solid fa-xmark"></i></div>
</nav>
<!-- ===========header ============= -->
<header class="header">
    <!-- ----nav menu start------ -->
    <nav class="nav nav--font nav--padding">
        <!-- site logo  -->
        <div class="nav__logo-container">
            <a href="<?= $home ?>"><img data-href="<?= $home ?>" class="nav__logo" id="nav__logo" src="./images/logo/logo.png" alt="Logo"></a>
        </div>
        <!-- navigation menu bar  -->
        <ul class="nav__menu">
            <li class="nav__item <?php if (isset($state) && $state == "home") {
                                        echo "active";
                                    } ?>"><a class="nav__link " href="<?= $home ?>">Home</a></li>
            <li class="nav__item <?php if (isset($state) && $state == "doctor_appointment") {
                                        echo "active";
                                    } ?>"><a class="nav__link " href="<?= $home ?>"><a class="nav__link" href="<?= $doctor_appointment ?>">Doctors & Appointment</a></li>
            <li class="nav__item <?php if (isset($state) && $state == "community") {
                                        echo "active";
                                    } ?>"><a class="nav__link " href="<?= $home ?>"><a class="nav__link" href="<?= $community ?>">Community Forum</a></li>
            <li class="nav__item <?php if (isset($state) && $state == "about") {
                                        echo "active";
                                    } ?>"><a class="nav__link " href="<?= $home ?>"><a class="nav__link" href="<?= $about ?>">About</a></li>
            <li class="nav__item <?php if (isset($state) && $state == "contact_us") {
                                        echo "active";
                                    } ?>"><a class="nav__link " href="<?= $home ?>"><a class="nav__link" href="<?= $contact ?>">Contact</a></li>
        </ul>
        <!-- user login registration  -->
        <div class="nav__user user">
            <?php
            if (isset($_SESSION['user']) && $_SESSION['user']['login_status'] == 1) {
            ?>
                <div class="user__logged">
                    <div class="dropdown">
                        <li class="dropdown-toggle dropdown-toggle_custom" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa-regular fa-face-smile"></i> <?= $_SESSION['user']['f_name'] .' ' . $_SESSION['user']['l_name']?>
                        </li>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="./view_profile.php">View Profile</a></li>
                            <li><a class="dropdown-item" href="#">Edit Profile</a></li>
                            <li><a class="dropdown-item" href="#">Somethinge</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="./backend/sign_out.php">Sign Out</a></li>

                        </ul>



                    </div>
                </div>

            <?php
            } else {
            ?>
                <div class="user__unlogged">
                    <a class="user__login  user__login--theme user__login--size button" data-bs-toggle="modal" data-bs-target="#login">Login</a>
                    <a class="user__register user__register--theme user__register--size button" data-bs-toggle="modal" data-bs-target="#register_popup">Register</a>
                </div>

            <?php } ?>









        </div>


        <!-- nav menu button  -->
        <div class="nav__menu-button" id="btnMenu">
            <span class="nav__menu-open"> <i class="fa-solid fa-bars"></i></span>
        </div>
    </nav>
    <!------------- nav menu end ---------- -->

    <?php
    if (isset($banner) && $banner != "") {
        include_once "$banner";
    }

    ?>

</header>
<!-- =================header end ================ -->