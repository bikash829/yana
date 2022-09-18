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
            &Lorem ipsum dolor sit amet consectetur, adipisicing elit.
            Totam rerum ea, beatae dignissimos porro illo quibusdam,
            quae soluta repudiandae neque alias. Vitae iusto cupiditate
            sequi ut maxime dignissimos, laboriosam dolorum mollitia vel
            doloremque quisquam sunt est pariatur nobis amet eum unde
            nulla iure eligendi quas
            officiis deleniti atque maiores magnam.
        </p>
    </section>

    <section class="about-welcome segment-margin">
        <div class="about-welcome__banner-container">
            <div class="about-welcome__banner-wrapper">
                <img class="about-welcome__banner" src="./images/who-we-are.jpg" alt="Welcome">
            </div>
        </div>
        <div class="about-welcome__article">
            <h2 class="about-welcome__title">We are here fore blah blah blah</h2>
            <p class="about-welcome__para">
                &Lorem, ipsum dolor sit amet consectetur adipisicing elit. Cumque voluptatem odio totam illum! Nostrum laboriosam culpa eius beatae delectus excepturi pariatur? Impedit neque id deserunt sit atque aliquid eum, laboriosam ea, ratione praesentium, distinctio in facilis non earum hic! Veniam nihil ullam laudantium quae laboriosam. Fugit, fuga illum commodi dolor eum doloremque iure cupiditate? Natus enim tenetur ullam. Praesentium, tenetur.
            </p>
        </div>
    </section>
</main>

<?php
include_once "./layout/footer.php"
?>