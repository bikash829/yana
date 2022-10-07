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
            <form action="./backend/contact_us.php" method="POST">
                <div class="contact-form__block c-block">
                    <input class="input c-block__name" type="text" placeholder="First Name" name="first_name" required>
                    <input class="input c-block__name" type="text" placeholder="Last Name" name="last_name" required>
                </div>
                <div class="contact-form__block c-block">
                    <input class="input c-block__email" type="email" placeholder="Email" name="contact_email" required>
                </div>
                <div class="contact-form__block c-block">
                    <textarea class="input c-block__comment" name="comment" required placeholder="Leave Your Comments"></textarea>
                </div>

                <div class="contact-form__block c-block">
                    <input name="btn-contact" type="submit" class="button c-block__button" value="Send">
                </div>


            </form>


        </div>

    </section>
</main>





<?php
include_once "./layout/footer.php"
?>


<script>
    let fristName, lastName, emailId;
    let elementNodes = document.querySelectorAll("input");
    // lastName = document.querySelector("name='l_name'");
    for (let value of elementNodes) {
        // if (value.name == 'first_name') {
        //     console.log(value);

        // }
        switch (value.name) {
            case 'first_name':
                // console.log(value);
                value.setAttribute("value","<?= $_SESSION['user']['f_name'] ?>");
                // value.setAttribute("disabled","");
                break;
            case 'last_name':
                value.setAttribute("value","<?= $_SESSION['user']['l_name'] ?>");
                break;
            case 'contact_email':
                value.setAttribute("value","<?= $_SESSION['user']['email'] ?>");
            default:
                break;
        }
        // console.log(value);
    }

    // console.log(fristName);
    // console.log(lastName);
</script>