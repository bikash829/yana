<?php
$title = "Doctor Register";
$state = "register";
$banner_title = "Register Now";
$banner_poster = "./images/banner/banner3.jpg";


include_once "./layout/head.php";
$banner = "./layout/banner.php";
include_once "./layout/navigation_bar.php";
include "./config/db_connection.php";
?>

<main class="main">
    <!-- <section class="segment-margin">
        <div class="section-heading">
            <h3 class="section-heading__title">
                Please Give Your information to let us help you.
            </h3>

        </div>
    </section> -->
    <section class="segment-margin register-container">
        <div class="reg-form-container">
            <h2 class="reg-form__title">Doctor Registration Form</h2>
            <form name="frm_doc" action="./backend/reg.php" method="POST" enctype="multipart/form-data"  class="row g-3 needs-validation register" novalidate>

                <!-- name  -->
                <div class="col-md-6">
                    <label for="first_name" class="form-label">First Name<span class="badge_ text-danger"><i class="fa-solid fa-star-of-life"></i></span><span class="mendatory">*</span></label>
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


                <!-- gender  -->
                <div class="col-md-6">
                    <div class="gender-container">
                        <label for="gender" class="form-label">Gender<span class="badge_ text-danger"><i class="fa-solid fa-star-of-life"></i></span></label>
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
                    <label for="doc_dob" class="form-label">Date Of Birth<span class="badge_ text-danger"><i class="fa-solid fa-star-of-life"></i></span></label>
                    <input name="date-of-birth" max="2014-12-31" type="date" class="form-control" id="doc_dob" required>
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
                    <label for="phone" class="form-label">Phone<span class="badge_ text-danger"><i class="fa-solid fa-star-of-life"></i></span></label>
                    <input name="number" type="number" class="form-control" id="phone" placeholder="Optional" required>
                    <div class="invalid-feedback">
                        Please provide valid phone number.
                    </div>
                </div>


                <!-- address info  -->
                <div class="col-md-6">
                    <label for="address_" class="form-label">Address<span class="badge_ text-danger"><i class="fa-solid fa-star-of-life"></i></span></label>
                    <input name="address" type="text" class="form-control" id="address_" aria-describedby="validationServer03Feedback" required>
                    <div id="validationServer03Feedback" class="invalid-feedback">
                        Please provide a valid address.
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="city_" class="form-label">City<span class="badge_ text-danger"><i class="fa-solid fa-star-of-life"></i></span></label>
                    <input name="city" type="text" class="form-control" id="city_" required>
                    <div id="validationServer05Feedback" class="invalid-feedback">
                        Please enter your city name.
                    </div>
                </div>
                <div class="col-md-3">
                    <label for="zip_" class="form-label">Zip<span class="badge_ text-danger"><i class="fa-solid fa-star-of-life"></i></span></label>
                    <input name="zip_code" type="text" class="form-control" id="zip_" required>
                    <div id="validationServer05Feedback" class="invalid-feedback">
                        Please enter your zip-code.
                    </div>
                </div>



                <!-- qualifications  -->
                <div class="col-md-12">
                    <label for="edu" class="form-label">Educational Qualifications</label>
                    <button type="button" class="badge button btn-help" title="Click here for the instraction">
                        <span data-bs-toggle="tooltip" data-bs-placement="right">?</span>
                    </button>
                    <p class="help_input">
                        Example# (institue1)(institute2)(institute3)
                    </p>
                    <div class="form-group has-validation form-floating">
                        <textarea name="education_info" class="form-control" id="edu-qualification" style="height: 4rem" placeholder="" required></textarea>
                        <label for="edu-qualification">Important</label>

                        <div class="invalid-feedback">
                            Please provide your educational info
                        </div>
                    </div>
                </div>



                <div class="col-md-12">
                    <label for="edu" class="form-label">Work Places</label>
                    <button title="Click here for the instraction" type="button" class="badge button btn-help" data-bs-toggle="popover" data-bs-title="Popover title" data-bs-content="And here's some amazing content. It's very engaging. Right?">
                        ?
                    </button>
                    <p class="help_input">
                        Example# (workplace)(otherworkplace)(anotherworkplace)
                    </p>

                    <div class="form-group has-validation form-floating">
                        <textarea name="working_info" class="form-control" id="work_info" style="height: 4rem" placeholder="" required></textarea>
                        <label for="work_info">Important</label>

                        <div class="invalid-feedback">
                            Please provide your working info
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="documents" class="form-label">Cerificates and others<span class="badge_ text-danger"><i class="fa-solid fa-star-of-life"></i></span></label>
                    <input name="xp_info_doc" type="file" class="form-control" id="documents" placeholder="upload pdf file only" required>
                    <div class="invalid-feedback">
                        Please provide your valid educational and other working doccuments in a single pdf.
                    </div>
                </div>

                <div class="col-md-6">
                    <label for="documents" class="form-label">Profile Photo</label>
                    <input name="pp" type="file" class="form-control" id="documents" placeholder="Upload your photo">
                    <div class="invalid-feedback">
                        Provide a photo for patients
                    </div>
                </div>
                <!--================user role==================-->
                <!-- <input type="hidden" name="user_role" value="3"> -->



                <div class="col-12">
                    <div class="form-check m-auto">
                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                        <label class="form-check-label" for="invalidCheck">
                            Agree to terms and conditions
                        </label>
                        <div class="invalid-feedback">
                            You must agree before submitting.
                        </div>
                    </div>
                </div>


                <div class="col-12 d-grid">
                    <button name="btn-doctor" value="reg_doctor" class="btn btn-primary" type="submit">Register Now</button>
                </div>
            </form>
        </div>
    </section>
</main>

<?php
include_once "./form-validation.php";
include_once "./layout/footer.php";
include "./functionalities/country_code_menupulation.php";
?>

<script>
    let ageGuard = document.getElementById('doc_dob');
    let currentDate = new Date();

    let currentDay, currentMonth, currentYear;
    currentDay = currentDate.getDay() < 10 ? `0${currentDate.getDay()}` : currentDate.getDay();
    currentMonth = currentDate.getMonth() < 10 ? `0${currentDate.getMonth()}` : currentDate.getMonth();
    currentYear = currentDate.getFullYear();

    let minYear = `${currentYear-30}-${currentMonth}-${currentDay}`;

    ageGuard.max = minYear;
</script>