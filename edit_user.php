<?php
//session_start();
$title = "Edit Information";
$state = "edit";
// $banner_title = "write your won post here";
$banner_poster = "./images/banner/banner3.jpg";

include_once "./layout/head.php";

if(isset($_SESSION['user'])){
    true;
}else{
    header("Location: ./index.php");

}

$banner = "./layout/banner.php";
include_once "./layout/navigation_bar.php";

include_once "./config/db_connection.php";



?>


<main class="main">
    <section class="profile my-5">
        <div class="row justify-content-center">
            <div class="col-md-10 col-xl-8">
                <div class="card">

                    <h2 class="reg-form__title card-header">Edit Personal Info</h2>
                    <form action="./backend/edit_user.php" method="POST" class="row g-3 needs-validation register card-body" novalidate>

                        <!-- name  -->
                        <div class="col-md-6">
                            <label for="first_name" class="form-label">First Name</label>
                            <input name="first_name" value="<?= $_SESSION['user']['f_name'] ?>" type="text" class="form-control" id="first_name" placeholder="First Name" required>
                            <div class="invalid-feedback">
                                Please enter your first name.
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label for="last_name" class="form-label">Last name</label>
                            <input name="last_name" value="<?= $_SESSION['user']['l_name'] ?>" type="text" class="form-control" id="last_name" placeholder="Last Name" required>
                            <div class="invalid-feedback">
                                Please enter your last name.
                            </div>
                        </div>

                        <!-- gender  -->
                        <div class="col-md-6">
                            <div class="gender-container">
                                <label for="gender" class="form-label">Gender</label>
                                <div class="row ms-0" id="gender-validation-message">
                                    <div class="form-check col-4">
                                        <input name="gender" value="male" type="radio" aria-describedby="genderFeedback" class="form-check-input" id="male" required>
                                        <label class="form-check-label" for="male">
                                            Male
                                        </label>

                                    </div>
                                    <div class="form-check col-4">
                                        <input name="gender" value="female" type="radio" class="form-check-input" id="female">
                                        <label class="form-check-label" for="female">
                                            Female
                                        </label>
                                    </div>
                                    <div class="form-check col-4">
                                        <input name="gender" value="other" type="radio" class="form-check-input" id="other">
                                        <label class="form-check-label" for="other">
                                            Other
                                        </label>
                                    </div>
                                </div>
                                <div id="genderFeedback" class="invalid-feedback">
                                    Please select your gender.
                                </div>

                            </div>

                        </div>

                        <!-- date of birth  -->
                        <div class="col-md-6">
                            <label for="dob" class="form-label">Date Of Birth</label>
                            <input name="date-of-birth" value="<?= $_SESSION['user']['date_of_birth'] ?>" type="date" class="form-control" id="dob" required>
                            <div class="invalid-feedback">
                                Please provide a valid date of birth.
                            </div>
                        </div>


                        <!-- Contact and country  -->
                        <div class="col-md-6">
                            <label for="country" class="form-label">Country<span class="badge_ text-danger"><i class="fa-solid fa-star-of-life"></i></span></label>
                            <select name="country" class="form-select" id="country" required>
                                <option selected disabled value="">Choose...</option>

                            </select>
                            <div class="invalid-feedback">
                                Please select country.
                            </div>
                        </div>

                        <div class="col-md-2">
                            <label for="phone-code" class="form-label">Code<span class="badge_ text-danger"><i class="fa-solid fa-star-of-life"></i></span></label>
                            <select name="phone-code" class="form-select" id="phone-code" required>
                                <option value="" selected disabled>Choose...</option>

                            </select>
                            <div class="invalid-feedback">
                                lease select your valid phone code.
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="phone" class="form-label">Phone Number</label>
                            <input name="number" value="<?= $_SESSION['user']['phone_number'] ?>" type="number" class="form-control" id="phone" placeholder="Optional" required>
                            <div class="invalid-feedback">
                                Please provide valid phone number.
                            </div>
                        </div>


                        <!-- address info  -->
                        <div class="col-md-6">
                            <label for="address_" class="form-label">Address</label>
                            <input name="address" value="<?= $_SESSION['user']['addr'] ?>" type="text" class="form-control" id="address_" aria-describedby="validationServer03Feedback" required>
                            <div id="validationServer03Feedback" class="invalid-feedback">
                                Please provide a valid address.
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="city_" class="form-label">City<span class="badge_ text-danger"><i class="fa-solid fa-star-of-life"></i></span></label>
                            <input name="city" type="text" value="<?= $_SESSION['user']['city'] ?>" class="form-control" id="city_" required>
                            <div id="validationServer05Feedback" class="invalid-feedback">
                                Please enter your city name.
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label for="zip_" class="form-label">Zip</label>
                            <input name="zip_code" value="<?= $_SESSION['user']['zip_code'] ?>" type="text" class="form-control" id="zip_" required>
                            <div id="validationServer05Feedback" class="invalid-feedback">
                                Please enter your zip-code.
                            </div>
                        </div>



                        <!-- qualifications  -->
                        <div class="col-md-12 switch-patient">
                            <label for="edu" class="form-label">Educational Qualifications</label>
                            <!-- <button type="button" class="badge button btn-help" title="Click here for the instraction">
                                        <span data-bs-toggle="tooltip" data-bs-placement="right">?</span>
                                    </button> -->
                            <p class="help_input" style="color:red">
                                Example# (institue1)(institute2)(institute3)
                            </p>
                            <div class="form-group has-validation form-floating">
                                <textarea name="education_info" class="form-control" id="edu-qualification" style="height: 4rem" placeholder="" required><?= $_SESSION['user']['education_info'] ?></textarea>
                                <label for="edu-qualification">Important</label>

                                <div class="invalid-feedback">
                                    Please provide your educational info
                                </div>
                            </div>
                        </div>



                        <div class="col-md-12 switch-patient">
                            <label for="edu" class="form-label">Work Places</label>
                            <!-- <button title="Click here for the instraction" type="button" class="badge button btn-help" data-bs-toggle="popover" data-bs-title="Popover title" data-bs-content="And here's some amazing content. It's very engaging. Right?">
                                        ?
                                    </button> -->
                            <p class="help_input" style="color:red;">
                                Example# (workplace)(otherworkplace)(anotherworkplace)
                            </p>

                            <div class="form-group has-validation form-floating">
                                <textarea name="working_info" class="form-control" id="work_info" style="height: 4rem" placeholder="" required><?= $_SESSION['user']['working_info'] ?></textarea>
                                <label for="work_info">Important</label>

                                <div class="invalid-feedback">
                                    Please provide your working info
                                </div>
                            </div>
                        </div>


                        <div class="col-12 d-grid">
                            <button name="btn-edit_user" class="btn btn-primary" type="submit">Register Now</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </section>
</main>




<?php

include_once "./layout/footer.php";
include "./functionalities/country_code_menupulation.php";
?>

<script>
    // script for country and phone code 
    country.firstElementChild.removeAttribute('selected');
    phoneCode.firstElementChild.removeAttribute('selected');

    let userCountry = <?= $_SESSION['user']['country_id'] ?>;
    let userPhoneCode = <?= $_SESSION['user']['phone_code_id'] ?>;
    // let count = 1;
    console.log(userCountry);

    for (let row of country) {
        if (row.value == userCountry) {
            row.setAttribute('selected', '');
        }

    }

    for (let row of phoneCode) {
        if (row.value == userPhoneCode) {
            row.setAttribute('selected', '');
        }
    }


    // script for gender selection 
    let Usergender = "<?= $_SESSION['user']['gender'] ?>";
    let userGenderList = (document.getElementById('gender-validation-message')).children;

    for (let row of userGenderList) {

        if ((row.children[0]).value == Usergender) {
            (row.children[0]).setAttribute('checked','');

        }
        
    }
</script>


<?php 
include_once "./functionalities/alert.php";


if (isset($_SESSION['edit_info'])) {
    // var_dump($_SESSION['edit_info']);
    $alert_status = alert($_SESSION['edit_info']);
    unset($_SESSION['edit_info']);
} else {
    $alert_status = false;
}


?>

<script type="text/javascript">
    // validation message 
    console.log(<?=json_encode($alert_status)?>);
    alertStatus = <?= json_encode($alert_status ?? null) ?>;
    console.log(alertStatus)
    if (alertStatus) {
        Swal.fire({
            position: 'top-end',
            icon: alertStatus.status,
            title: alertStatus.message,
            showConfirmButton: false,
            timer: 4000
        })
    }


</script>
