<?php
//session_start();
$title = "YANA";
$state = "home";

include_once "./layout/head.php";
$banner = "./layout/hero.php";
include_once "./layout/navigation_bar.php";



?>

<!-- =========main============== -->
<main class="main">
  <!-- ----------service section -----------  -->
  <section class="service segment-margin">
    <!-- service card  -->
    <div class="service__card-container ">
      <div class="service__card s-card">
        <div class="s-card__icon-container">
          <img class="s-card__icon" src="./images/divpics/doctor.png" alt="Loading">
        </div>
        <h3 class="s-card__heading">Talk to Doctors</h3>
        <p class="s-card__para">Need to talk to a psychiatrist? Make an appointment and get treatment from home!</p>
      </div>

      <div class="service__card s-card">
        <div class="s-card__icon-container">
          <img class="s-card__icon" src="./images/divpics/counselor.png" alt="Loading">
        </div>
        <h3 class="s-card__heading">Talk to Counselors</h3>
        <p class="s-card__para">Feeling alone, depreesed or anxious? Don't worry we're available for you 24/7</p>
      </div>

      <div class="service__card s-card">
        <div class="s-card__icon-container">
          <img class="s-card__icon" src="./images/divpics/comfortable.jpg" alt="Loading">
        </div>
        <h3 class="s-card__heading">Comfortable Place</h3>
        <p class="s-card__para">There's no shame in getting help. We're here to welcome you anytime</p>
      </div>

      <div class="service__card s-card">
        <div class="s-card__icon-container">
          <img class="s-card__icon" src="./images/divpics/safe.png" alt="Loading">
        </div>
        <h3 class="s-card__heading">Safe Space</h3>
        <p class="s-card__para">Share your problems in a safe space with full confidentiality</p>
      </div>


    </div>

    <!-- service welcome  -->
    <div class="service__welcome welcome">
      <div class="welcome__banner-container">
        <img class="welcome__banner" src="./images/img/service__baner.png" alt="Loading">
      </div>

      <div class="welcome__article">
        <h2 class="welcome__header">Welcome To Our Vicinity</h2>
        <div class="welcome__para-container">
          <p class="welcome__para">
            We welcome you to join us anytime. We're here to help whenever you need.
          </p>
          <p class="welcome__para">
            We provide professional mental health care service and general counseling. Become a member of our community and let us grow together.
          </p>
        </div>

        <!-- <button class="welcome__button button button-large">Learn More</button> -->
      </div>
    </div>
  </section>
  <!-- ---------------service end ----------- -->

  <!-- ------------patient review------------ -->
  <section class="patient-review segment-margin">
    <div class="patient-review__heading-container section-heading ">
      <h2 class="section-heading__title">Patients are saying</h2>
      <p class="section-heading__para">
        We're a family and we grow by helping each other
      </p>
    </div>

    <div class="patient-review__details">
      <div class="patient-review__card patient-say">
        <div class="pateint-say__img-con">
          <img class="pateint-say__img" src="./images/img/pp.jpg" alt="Loading">
        </div>
        <div class="patient-say__info person">
          <h3 class="person__name">daren jhonson</h3>
          <h4 class="person__occu">Hp Specialist</h4>
          <p class="person__description">
            Elementum libero hac leo integer. Risus hac road parturient feugiat. Litora cursus hendrerit bib elit Tempus inceptos posuere metus.
          </p>
        </div>

      </div>

      <div class="patient-review__card patient-say">
        <div class="pateint-say__img-con">
          <img class="pateint-say__img" src="./images/img/pp.jpg" alt="Loading">
        </div>

        <div class="patient-say__info person">
          <h3 class="person__name">daren jhonson</h3>
          <h4 class="person__occu">Hp Specialist</h4>
          <p class="person__description">
            Elementum libero hac leo integer. Risus hac road parturient feugiat. Litora cursus hendrerit bib elit Tempus inceptos posuere metus.
          </p>
        </div>
      </div>
    </div>

    <div class="paitent-review__appointment appointment">
      <div class="appointment__background-border"></div>

      <div class="appointment__form-container">
        <form action="./upcomming_appointment.php" method="POST" class="appointment__form">
          <h3 class="appointment__title">Appointment Now</h3>
          <div class="form-col">
            <input class="appointment__input input" type="text" name="name" placeholder="Your Name">
          </div>
          <div class="form-col">
            <input class="appointment__input input" type="email" name="email" placeholder="Your Email">

          </div>
          <div class="form-col">
            <input class="appointment__input input" type="date" name="ap_date">

          </div>
          <div class="form-col">
            <textarea class="appointment__text input" name="ap_message" placeholder="Your Message"></textarea>

          </div>
          <div class="form-col text-center">
            <input type="submit" value="APPOINTMENT NOW" name="ap_submit" class="button appointment__button">

          </div>
        </form>
      </div>
    </div>
  </section>

  <!-- ------------end patient review------------- -->

  <!-- -------------our specialist--------------- -->
  <?php
  include_once "./config/db_connection.php";

  function doctors()
  {
    $sql = "SELECT users.*, CONCAT(users.f_name,' ',users.l_name) as full_name,country.name AS country_name, phone_info.phonecode AS user_phone_code, additional_info.* 
            FROM users 
            JOIN country ON users.country_id = country.id 
            JOIN country phone_info ON users.phone_code = phone_info.id 
            JOIN additional_info ON users.id = additional_info.user_id 
            WHERE role_id = 3 
            AND users.status = 1;";

    if ($result = db_connection()->query($sql)) {
      $fetechd_data = $result->fetch_all(MYSQLI_ASSOC);
      return $fetechd_data;
    } else {
      return false;
    }
  }

  $doctors = doctors();

  ?>


  <section class="specialist segment-margin">
    <div class="section-heading">
      <h3 class="section-heading__title">
        Our Specialists
      </h3>
      <p class="section-heading__para">
        Book an Appointment and Meet Our Specialists Online
      </p>
    </div>

    <div class="specialist__card-container">
      <?php foreach ($doctors as $doctor) { ?>
        <div class="specialist__card">
          <div class="specialist__img-con">
            <img class="specialist__img" src="<?php if (empty($doctor['profile_location'])) {
                                                echo "./images/profile_pic/blank-profile-picturepng.png";
                                              } else {
                                                echo $doctor['profile_location'] . $doctor['profile_photo'];
                                              } ?>" alt="">
          </div>

          <div class="specialist__info ">
            <div class="person">
              <h3 class="person__name"><?= ucwords($doctor['full_name']) ?></h3>
              <h3 class="person__occu"><?= $doctor['education'] ?></h3>
            </div>
            <p class="person__description">
              <?= $doctor['bio'] ?>
            </p>

            <div class="specialist__links">
              <a href="#" title="click here to visit my facebook wall" class="specialist__icon"><i class="fa-brands fa-facebook-f"></i></a>
              <a href="#" title="click to follow twitter" class="specialist__icon"><i class="fa-brands fa-twitter"></i></a>
              <a href="#" title="click to visit web site" class="specialist__icon"><i class="fa-solid fa-globe"></i></a>
              <a href="#" title="click to visit linkdin profile" class="specialist__icon"><i class="fa-brands fa-linkedin-in"></i></a>
            </div>
          </div>
        </div>

      <?php } ?>



    </div>

  </section>
  <!-- ------------our specialist end------------ -->
  <!-- ------------emmergency hotline----------- -->
  <section class="emmergency segment-margin">
    <div class="emmergency__content">
      <h2 class="section-heading__title">Emmergency Hotline</h2>
      <h2 class="emmergency__contact">+8801725485465</h2>
      <p class="section-heading__para section-heading__para--emmergency-font">We provide 24/7 customer support. Please feel free to contact us
        for emergency case.</p>
    </div>

  </section>
  <!-- ------------end emmergency hotline-------------- -->

  <!-- ----------recent news ------------  -->
  <section class="news segment-margin">
    <div class="news__heading section-heading">
      <h2 class="section-heading__title">Recent medical news</h2>
      <p class="section-heading__para">
        Green above he cattle god saw day multiply under fill in the cattle fowl a all, living, tree word link available in the service for subdue fruit.
      </p>
    </div>

    <div class="news__card-container">
      <div class="news-card">
        <div class="news-card__img-con">
          <img class="news-card__img" src="./images/recent-news/news1.jpg.webp" alt="Loading">
          <span class="news-card__date">22 July 2022</span>
        </div>
        <div class="news-card__description-con">
          <h2 class="news-card__title">
            chip to model coeliac disease
          </h2>
          <p class="news-card__description">
            Elementum libero hac leo integer. Risus hac part duriw feugiat litora cursus hendrerit bibendum per person on elit.Tempus inceptos posuere me.
          </p>
          <a class="news-card__extend-btn" href="#">read more <i class="move fa-solid fa-right-long"></i></a>
        </div>
      </div>

      <div class="news-card">
        <div class="news-card__img-con">
          <img class="news-card__img" src="./images/recent-news/news1.jpg.webp" alt="Loading">
          <span class="news-card__date">22 July 2022</span>
        </div>
        <div class="news-card__description-con">
          <h2 class="news-card__title">
            chip to model coeliac disease
          </h2>
          <p class="news-card__description">
            Elementum libero hac leo integer. Risus hac part duriw feugiat litora cursus hendrerit bibendum per person on elit.Tempus inceptos posuere me.
          </p>
          <a class="news-card__extend-btn" href="#">read more <i class="move fa-solid fa-right-long"></i></a>
        </div>
      </div>

      <div class="news-card">
        <div class="news-card__img-con">
          <img class="news-card__img" src="./images/recent-news/news1.jpg.webp" alt="Loading">
          <span class="news-card__date">22 July 2022</span>
        </div>
        <div class="news-card__description-con">
          <h2 class="news-card__title">
            chip to model coeliac disease
          </h2>
          <p class="news-card__description">
            Elementum libero hac leo integer. Risus hac part duriw feugiat litora cursus hendrerit bibendum per person on elit.Tempus inceptos posuere me.
          </p>
          <a class="news-card__extend-btn" href="#">read more <i class="move fa-solid fa-right-long"></i></a>
        </div>
      </div>

      <div class="news-card">
        <div class="news-card__img-con">
          <img class="news-card__img" src="./images/recent-news/news1.jpg.webp" alt="Loading">
          <span class="news-card__date">22 July 2022</span>
        </div>
        <div class="news-card__description-con">
          <h2 class="news-card__title">
            chip to model coeliac disease
          </h2>
          <p class="news-card__description">
            Elementum libero hac leo integer. Risus hac part duriw feugiat litora cursus hendrerit bibendum per person on elit.Tempus inceptos posuere me.
          </p>
          <a class="news-card__extend-btn" href="#">read more <i class="move fa-solid fa-right-long"></i></a>
        </div>
      </div>
    </div>
  </section>
  <!-- -----------end news-------------  -->
</main>


<?php
include_once "./layout/footer.php"
?>