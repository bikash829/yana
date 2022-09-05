<?php
$title = "Contact US";
$state = "contact_us";
$banner_title = "Get In Touch";
$banner_poster = "./images/banner/banner3.jpg";


include_once "./layout/head.php";
$banner = "./layout/banner.php";
include_once "./layout/navigation_bar.php";
?>

<main class="main">
    <section class="contact segment-margin">
        <div class="contact__card">
            <!-- <img src="" alt="" class="contact__icon"> -->
            <h2 class="contact__icon"><i class="fa-solid fa-map-location-dot"></i></h2>
            <h3 class="contact__title">something is </h3>
            <p class="contact__info">Dhaka, Dhanmondi</p>
        </div>
        <div class="contact__card">
            <h2 class="contact__icon"><i class="fa-solid fa-phone-volume"></i></h2>
            <h3 class="contact__title">something is </h3>
            <p class="contact__info">0815454444</p>
        </div>
        <div class="contact__card">
            <h2 class="contact__icon"><i class="fa-solid fa-envelope"></i></h2>
            <h3 class="contact__title">something is </h3>
            <p class="contact__info">mayeshafahmida@gmail.com</p>
        </div>
    </section>

    <!-- contact form  -->
    <section class="contact-frm segment-margin">
        <div class="contact-frm__artcle-con">
            <h2 class="contact-frm__artcle-title">Feel Free To Message Us</h2>
            <p class="contact-frm__artcle">&Lorem ipsum, dolor sit amet consectetur adipisicing elit. Ipsam rem
                dolorem magnam corrupti odit, at repudiandae cum labore alias reprehenderit
                dolore esse, sint commodi fugit quod officia architecto perspiciatis officiis?
                Sunt rem tempora ad, perspiciatis tempore, molestias
                maxime iure autem, sint voluptatem quo odit aperiam est ut. Ab, aperiam a.</p>

        </div>
        <div class="contact-form ">
            <form action="#" method="GET">
                <div class="contact-form__block c-block">
                    <input class="input c-block__name" type="text" placeholder="First Name" name="fName">
                    <input class="input c-block__name" type="text" placeholder="Last Name" name="lName">
                </div>
                <div class="contact-form__block c-block">
                    <input class="input c-block__email" type="email" placeholder="Email" name="email">
                </div>
                <div class="contact-form__block c-block">
                    <textarea class="input c-block__comment" name="comment" placeholder="Leave Your Comments"></textarea>
                </div>

                <div class="contact-form__block c-block">
                    <input type="submit" class="button c-block__button" value="Send">
                </div>


            </form>


        </div>

    </section>
</main>





<?php
include_once "./layout/footer.php"
?>