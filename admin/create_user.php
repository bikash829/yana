<?php
include_once "./admin-layouts/head.php";
include_once "./admin-layouts/nav.php";
?>

<div id="layoutSidenav">
    <!-- aside  -->
    <?php include_once "./admin-layouts/aside.php"; ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Create New User</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="<?= $dashboard ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Create User</li>
                </ol>
                <div class="row justify-content-center">
                    <div class="col-md-10 col-xl-8">
                        <div class="card">
                            <section class="segment-margin register-container">
                                <div class="reg-form-container">
                                    <h2 class="reg-form__title card-header">User Form</h2>
                                    <form name="frm_doc" action="#" method="POST" class="row g-3 needs-validation register card-body" novalidate>

                                        <!-- name  -->
                                        <div class="col-md-6">
                                            <label for="first_name" class="form-label">First Name</label>
                                            <input name="first-name" type="text" class="form-control" id="first_name" placeholder="First Name" required>
                                            <div class="invalid-feedback">
                                                Please enter your first name.
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="last_name" class="form-label">Last name</label>
                                            <input name="last-name" type="text" class="form-control" id="last_name" placeholder="Last Name" required>
                                            <div class="invalid-feedback">
                                                Please enter your last name.
                                            </div>
                                        </div>

                                        <!-- email -->
                                        <div class="col-md-6">
                                            <label for="email" class="form-label">Email</label>
                                            <input name="email" type="email" class="form-control" id="email" placeholder="jhondoy@gmail.com" required>
                                            <div class="invalid-feedback">
                                                Please provide your valid email id.
                                            </div>
                                        </div>
                                        <!-- user role  -->
                                        <div class="col-md-6">
                                            <label for="role" class="form-label">Role</label>
                                            <select name="role" class="form-select" id="role" required>
                                                <option disabled selected value="">Choose...</option>
                                                <option value="doctor">Doctor</option>
                                                <option value="councilor">Councilor</option>
                                                <option value="patient">Patient</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please a user role.
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
                                            <input name="date-of-birth" type="date" class="form-control" id="dob" required>
                                            <div class="invalid-feedback">
                                                Please provide a valid date of birth.
                                            </div>
                                        </div>

                                        <!-- password section  -->

                                        <div class="col-md-6">
                                            <label for="password" class="form-label">Password</label>
                                            <div class="input-group has-validation">
                                                <input name="password" type="password" class="form-control" id="password" minlength="8" placeholder="Password" required>
                                                <div class="invalid-feedback">
                                                    Please choose a strong password.
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="confirm_pass" class="form-label">Confirm Password</label>
                                            <div class="input-group has-validation">
                                                <input name="confirm_pass" type="password" class="form-control" id="confirm_pass" placeholder="Confirm Password" required>
                                                <div class="invalid-feedback">
                                                    Password didn't match.
                                                </div>
                                            </div>
                                        </div>



                                        <!-- Contact and country  -->
                                        <div class="col-md-6">
                                            <label for="country" class="form-label">Country</label>
                                            <select name="country" class="form-select" id="country" required>
                                                <option selected disabled value="">Choose...</option>
                                                <option value="counry-name">Bangladesh</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select country.
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <label for="phone-code" class="form-label">Code</label>
                                            <select name="phone-code" class="form-select" id="phone-code" required>
                                                <option value="" selected disabled>Choose...</option>
                                                <option value="phone-code">+880</option>
                                            </select>
                                            <div class="invalid-feedback">
                                                lease select your valid phone code.
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <label for="phone" class="form-label">Phone</label>
                                            <input name="number" type="number" class="form-control" id="phone" placeholder="Optional" required>
                                            <div class="invalid-feedback">
                                                Please provide valid phone number.
                                            </div>
                                        </div>


                                        <!-- address info  -->
                                        <div class="col-md-6">
                                            <label for="address_" class="form-label">Address</label>
                                            <input name="address" type="text" class="form-control" id="address_" aria-describedby="validationServer03Feedback" required>
                                            <div id="validationServer03Feedback" class="invalid-feedback">
                                                Please provide a valid address.
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="city_" class="form-label">City</label>
                                            <select name="city" class="form-select " id="city_" aria-describedby="validationServer04Feedback" required>
                                                <option selected disabled value="">Choose...</option>
                                                <option value="city_name">...</option>
                                            </select>
                                            <div id="validationServer04Feedback" class="invalid-feedback">
                                                Please select your city.
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="zip_" class="form-label">Zip</label>
                                            <input name="zip_code" type="text" class="form-control" id="zip_" required>
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
                                                <textarea name="education_info" class="form-control" id="edu-qualification" style="height: 4rem" placeholder="" required></textarea>
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
                                                <textarea name="working_info" class="form-control" id="work_info" style="height: 4rem" placeholder="" required></textarea>
                                                <label for="work_info">Important</label>

                                                <div class="invalid-feedback">
                                                    Please provide your working info
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 switch-patient">
                                            <label for="documents" class="form-label">Cerificates and others</label>
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

                                        <!-- 
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
                                        </div> -->


                                        <div class="col-12 d-grid">
                                            <button name="btn-doctor" class="btn btn-primary" type="submit">Register Now</button>
                                        </div>
                                    </form>

                                </div>
                            </section>
                        </div>
                    </div>
                </div>

            </div>
        </main>
        <!-- footer  -->

        <?php
        include_once "../form-validation.php";
        include_once "./admin-layouts/footer.php";

        ?>
    </div>
</div>
<!-- script -->
<?php include_once "./admin-layouts/closer.php"; ?>