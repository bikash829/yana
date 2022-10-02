<?php
$title = "Appointment";
$state = "doctor_appointment";
$banner_poster = "./images/banner/banner3.jpg";

include_once "./layout/head.php";
$banner = "./layout/banner.php";
include_once "./layout/navigation_bar.php";



include "./config/db_connection.php";


// experts information 
$sql = "SELECT `users`.* ,`country`.`name` AS `country_name`, `country`.`phonecode` AS `phone_code`, `additional_info`.`bio`, `additional_info`.`education`, `additional_info`.`working_info`
        FROM `users`
        INNER JOIN `country` ON `users`.`country_id` = `country`.`id`
        INNER JOIN `additional_info` ON `additional_info`.`user_id` = `users`.`id`;
        ";
if($special_user_set = db_connection()->query($sql)){
    $special_user = $special_user_set->fetch_all(MYSQLI_ASSOC);
    
}else{
    $validation = "Technical Error";
}


?>

<main class="main">
    <section class="specialist segment-margin">
        <div class="section-heading">
            <h3 class="section-heading__title">
                Experts And Councilors
            </h3>
            <p class="section-heading__para">
                Green above he cattle god saw day multiply under fill in the cattle fowl a all, living, tree word link available in the service for subdue fruit.
            </p>
        </div>
<!-- councilor list  -->
        <div class="accordion" id="accordionPanelsStayOpenExample">
        <div class="accordion-item">


                <h2 class="accordion-header " id="panelsStayOpen-headingTwo">
                    <button class="accordion-button collapsed accordion-button--custom" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
                        Councilors
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingTwo">
                    <div class="accordion-body">
                        <div class="specialist__card-container">

                            <?php foreach($special_user AS $row){ 
                                if($row['role_id'] == 2 && $row['status'] == 1){

                            ?>
                            <div class="specialist__card">
                                <div class="specialist__img-con">
                                    <img class="specialist__img" src="./images/specialist/sp_1.jpg" alt="">
                                </div>

                                <div class="specialist__info ">
                                    <div class="person">
                                        <h3 class="person__name"><?=$row['f_name'].' '. $row['l_name']?></h3>
                                        <h3 class="person__occu">Proffesion Skills</h3>
                                    </div>
                                    <p class="person__description">
                                        If you are looking at blank cassettes on the web, you may be very confused at the.
                                    </p>

                                    <div class="specialist__links">
                                        <a href="#" title="click here to visit my facebook wall" class="specialist__icon"><i class="fa-brands fa-facebook-f"></i></a>
                                        <a href="#" title="click to follow twitter" class="specialist__icon"><i class="fa-brands fa-twitter"></i></a>
                                        <a href="#" title="click to visit web site" class="specialist__icon"><i class="fa-solid fa-globe"></i></a>
                                        <a href="#" title="click to visit linkdin profile" class="specialist__icon"><i class="fa-brands fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>

                            <?php } }  ?>

                           


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

                        <?php foreach($special_user AS $row){ 
                                // print_r($row);
                                if($row['role_id'] == 3 && $row['status'] == 1){
                                    // print_r($row);?>
                            <div class="specialist__card">
                                <div class="specialist__img-con">
                                    <img class="specialist__img" src="./images/specialist/sp_1.jpg" alt="">
                                </div>

                                <div class="specialist__info ">
                                    <div class="person">
                                        <h3 class="person__name"><?=$row['f_name'].' '. $row['l_name']?></h3>
                                        <h3 class="person__occu">Proffesion Skills</h3>
                                    </div>
                                    <p class="person__description">
                                        If you are looking at blank cassettes on the web, you may be very confused at the.
                                    </p>

                                    <div class="specialist__links">
                                        <a href="#" title="click here to visit my facebook wall" class="specialist__icon"><i class="fa-brands fa-facebook-f"></i></a>
                                        <a href="#" title="click to follow twitter" class="specialist__icon"><i class="fa-brands fa-twitter"></i></a>
                                        <a href="#" title="click to visit web site" class="specialist__icon"><i class="fa-solid fa-globe"></i></a>
                                        <a href="#" title="click to visit linkdin profile" class="specialist__icon"><i class="fa-brands fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                        <?php } } ?>
                           

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