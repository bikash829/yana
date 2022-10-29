<?php

$title = "About";
$state = "about";
$banner_title = "who we are?";
$banner_poster = "./images/banner/banner3.jpg";

include_once "./layout/head.php";
$banner = "./layout/banner.php";
include_once "./layout/navigation_bar.php";
?>

<main class="main">
    <section class="about segment-margin">
        <h3 class="about-who">who we are!</h3>
        <p class="about-ans">
            We're an online counseling platform. We have counselors avaiable 24/7 and we have psychiatrists. Talk to our counselors anytime you need help or book an appointment with a doctor.
        </p>
    </section>

    <section class="about-welcome segment-margin">
        <div class="about-welcome__banner-container">
            <div class="about-welcome__banner-wrapper">
                <img class="about-welcome__banner" src="./images/divpics/hope.jpg" alt="Welcome">
            </div>
        </div>
        <div class="about-welcome__article">
            <h2 class="about-welcome__title">We are Here for You</h2>
            <p class="about-welcome__para">
                Welcome to YANA. We're an online platform providing mental health care service. Contact us for any queries and remember hope is just a call away.
            </p>
        </div>
    </section>
</main>

<?php
include_once "./layout/footer.php"
?>