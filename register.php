<?php
$title = "Register";
$state = "register";
$banner_title = "Register Now";
$banner_poster = "./images/banner/banner3.jpg";


include_once "./layout/head.php";
$banner = "./layout/banner.php";
include_once "./layout/navigation_bar.php";
include "./config/db_connection.php";
?>

<main class="main">
    <section class="segment-margin register-container">
        <div class="reg-form-container">
            <h2 class="reg-form__title">Registration Form</h2>

            <form name="frm_patient" action="./backend/reg.php" method="POST" enctype="multipart/form-data" class="row g-3 needs-validation register" novalidate>
                <!-- name      -->
                <div class="col-md-6">
                    <label for="first_name" class="form-label">First Name<span class="badge_ text-danger"><i class="fa-solid fa-star-of-life"></i></span> </label>
                    <input name="first_name" type="text" class="form-control" id="first_name" placeholder="First Name" required>
                    <div class="invalid-feedback">
                        Please enter your first name.
                    </div>
                </div>


                <div class="col-md-6">
                    <label for="last_name" class="form-label">Last name<span class="badge_ text-danger"><i class="fa-solid fa-star-of-life"></i></span></label>
                    <input name="last_name" type="text" class="form-control" id="last_name" placeholder="Last Name" required>
                    <div class="invalid-feedback">
                        Please enter your last name.
                    </div>
                </div>

                <!-- email -->
                <div class="col-md-12">
                    <label for="email" class="form-label">Email<span class="badge_ text-danger"><i class="fa-solid fa-star-of-life"></i></span></label>
                    <input name="email" type="email" class="form-control" id="email" placeholder="jhondoy@gmail.com" required>
                    <div class="invalid-feedback">
                        Please provide your valid email id.
                    </div>
                </div>
                <div class="invalid-feedback">More example invalid feedback text</div>


                <!-- gender  -->
                <div class="col-md-6">
                    <div class="gender-container">
                        <label for="gender" class="form-label">Gender<span class="badge_ text-danger"><i class="fa-solid fa-star-of-life"></i></span></label>
                        <div class="row ms-0" id="gender-validation-message">
                            <div class="form-check col-4">
                                <input name="gender" value="male" type="radio" class="form-check-input" id="male" required>
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

                        <div id="gender-validation" class="invalid-feedback">
                            Please select your gender.
                        </div>
                    </div>

                </div>


                <!-- date of birth  -->
                <div class="col-md-6">
                    <label for="user_dob" class="form-label">Date Of Birth<span class="badge_ text-danger"><i class="fa-solid fa-star-of-life"></i></span></label>
                    <input name="date-of-birth" type="date" class="form-control" id="user_dob" required>
                    <div class="invalid-feedback">
                        Please provide a valid date of birth.
                    </div>
                </div>


                <!-- password section  -->
                <div class="col-md-6">
                    <label for="password" class="form-label">Password<span class="badge_ text-danger"><i class="fa-solid fa-star-of-life"></i></span></label>
                    <div class="input-group has-validation">
                        <input name="password" type="password" class="form-control" id="password" minlength="8" placeholder="Password" required>
                        <div class="invalid-feedback">
                            Please choose a strong password.
                        </div>

                    </div>
                </div>
                <div class="col-md-6">
                    <label for="confirm_pass" class="form-label">Confirm Password<span class="badge_ text-danger"><i class="fa-solid fa-star-of-life"></i></span></label>
                    <div class="input-group has-validation">
                        <input name="confirm_pass" type="password" class="form-control" id="confirm_pass" placeholder="Confirm Password" required>
                        <div class="invalid-feedback">
                            Password didn't match.
                        </div>
                    </div>
                </div>

                <!-- Contact and country  -->
                <div class="col-md-6">
                    <label for="country" class="form-label">Country<span class="badge_ text-danger"><i class="fa-solid fa-star-of-life"></i></span></label>
                    <select name="country" class="form-select" id="country" required>
                        <option value="" selected disabled>Choose...</option>
                        <option value="country-name">Bangladesh</option>
                    </select>
                    <div class="invalid-feedback">
                        Please select your country.
                    </div>
                </div>

                <div class="col-md-2">
                    <label for="phone-code" class="form-label">Code</label>
                    <select name="phone-code" class="form-select" id="phone-code">
                        <option value="" selected disabled>Choose...</option>
                    </select>
                    <div class="invalid-feedback">
                        lease select your valid phone code.
                    </div>
                </div>

                <div class="col-md-4">
                    <label for="phone" class="form-label">Phone</label>
                    <input name="number" type="number" class="form-control" id="phone" placeholder="Optional">
                    <div class="invalid-feedback">
                        Please provide valid phone number.
                    </div>
                </div>

                <!-- address info  -->
                <div class="col-md-6">
                    <label for="address_" class="form-label">Address</label>
                    <input name="address" type="text" class="form-control" id="address_" placeholder="Optional" aria-describedby="validationServer03Feedback">
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        Please provide a valid address.
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="city_" class="form-label">City</label>
                    <input name="city" type="text" class="form-control" placeholder="Optional" id="city_">
                    <div id="validationServer05Feedback" class="invalid-feedback">
                        Please enter your city name.
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="zip_" class="form-label">Zip</label>
                    <input name="zip_code" type="text" class="form-control" placeholder="Optional" id="zip_">
                    <div id="validationServer05Feedback" class="invalid-feedback">
                        Please enter your zip-code.
                    </div>
                </div>


                <!-- <input type="hidden" name="user_role" value="4"> -->




                <div class="col-12">
                    <div class="form-check m-auto">
                        <input class="form-check-input" id="invalidCheck" type="checkbox" value="" required>
                        <label class="form-check-label" for="invalidCheck">
                            Agree to terms and conditions
                        </label>
                        <div class="invalid-feedback">
                            You must agree before submitting.
                        </div>
                    </div>
                </div>
                <div class="col-12 d-grid">
                    <button name="btn_patient" value="reg_patient" type="submit" class="btn btn-primary">Register Now</button>
                </div>
            </form>

        </div>

    </section>
</main>

<script>
    let ageGuard = document.getElementById('user_dob');
    let currentDate = new Date();
    
    let currentDay, currentMonth, currentYear;
    currentDay = currentDate.getDay() < 10 ? `0${currentDate.getDay()}` : currentDate.getDay();
    currentMonth = currentDate.getMonth() < 10 ? `0${currentDate.getMonth()}` : currentDate.getMonth();
    currentYear = currentDate.getFullYear();

    let minYear = `${currentYear-10}-${currentMonth}-${currentDay}`;

    ageGuard.max = minYear;
    
</script>
<?php
include_once "./form-validation.php";
include_once "./layout/footer.php";

include "./functionalities/country_code_menupulation.php";
?>