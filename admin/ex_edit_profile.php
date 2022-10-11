<?php
include_once "./admin-layouts/head.php";

if (isset($_SESSION['doctor'])) {
    $user_role = $_SESSION['doctor']['role'];
} elseif (isset($_SESSION['councilor'])) {
    $user_role = $_SESSION['councilor']['role'];
} else {
    $user_role =  "Nothing to print";
}

// link 
$dashboard = "./experts_dashboard.php";

include_once "./admin-layouts/nav.php";

// data 
switch (isset($_SESSION)) {
    case 'doctor':
        $data = $_SESSION['doctor'];
        break;
    case 'councilor':
        $data = $_SESSION['councilor'];
        break;

    default:
        # code...
        break;
}


include "../functionalities/validation_function.php";


?>
<div id="layoutSidenav">
    <!-- aside  -->
    <?php include_once "./admin-layouts/experts_aside.php"; ?>
    <div id="layoutSidenav_content">

        <main class="main">
            <section class="profile mt-2">

                <div class="row justify-content-center">
                    <div class="col-lg-8 col-10">
                        <div class="card">
                            <div class="card-header">
                                <?= $data['f_name'] . $data['l_name'] ?>

                            </div>
                            <div class="card-body position-relative">

                                <div class=" px-3">
                                    <div class="row  justify-content-center">

                                        <div class="col-12">
                                            <form action="../backend/edit_user.php" method="POST" class="row g-3 needs-validation register card-body" novalidate>
                                                <!-- name  -->
                                                <div class="col-md-6">
                                                    <label for="first_name" class="form-label">First Name</label>
                                                    <input name="first_name" value="<?= $data['f_name'] ?>" type="text" class="form-control" id="first_name" placeholder="First Name" required>
                                                    <div class="invalid-feedback">
                                                        Please enter your first name.
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="last_name" class="form-label">Last name</label>
                                                    <input name="last_name" value="<?= $data['l_name'] ?>" type="text" class="form-control" id="last_name" placeholder="Last Name" required>
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
                                                                <input name="gender" value="male" <?php if ($data['gender'] == 'male') {
                                                                                                        echo "checked";
                                                                                                    } ?> type="radio" aria-describedby="genderFeedback" class="form-check-input" id="male" required>
                                                                <label class="form-check-label" for="male">
                                                                    Male
                                                                </label>

                                                            </div>
                                                            <div class="form-check col-4">
                                                                <input name="gender" value="female" <?php if ($data['gender'] == 'female') {
                                                                                                        echo "checked";
                                                                                                    } ?> type="radio" class="form-check-input" id="female">
                                                                <label class="form-check-label" for="female">
                                                                    Female
                                                                </label>
                                                            </div>
                                                            <div class="form-check col-4">
                                                                <input name="gender" value="other" <?php if ($data['gender'] == 'other') {
                                                                                                        echo "checked";
                                                                                                    } ?> type="radio" class="form-check-input" id="other">
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
                                                    <input name="date-of-birth" value="<?= $data['date_of_birth'] ?>" type="date" class="form-control" id="dob" required>
                                                    <div class="invalid-feedback">
                                                        Please provide a valid date of birth.
                                                    </div>
                                                </div>


                                                <!-- Contact and country  -->
                                                <!-- <div class="col-md-6">
                                                    <label for="country" class="form-label">Country</label>
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
                                                </div> -->



                                                <!-- address info  -->
                                                <div class="col-md-12">
                                                    <label for="address_" class="form-label">Address</label>
                                                    <input name="address" value="<?= $data['addr'] ?>" type="text" class="form-control" id="address_" aria-describedby="validationServer03Feedback" required>
                                                    <div id="validationServer03Feedback" class="invalid-feedback">
                                                        Please provide a valid address.
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="city_" class="form-label">City</label>
                                                    <input name="city" type="text" value="<?= $data['city'] ?>" class="form-control" id="city_" required>
                                                    <div id="validationServer05Feedback" class="invalid-feedback">
                                                        Please enter your city name.
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <label for="zip_" class="form-label">Zip</label>
                                                    <input name="zip_code" value="<?= $data['zip_code'] ?>" type="text" class="form-control" id="zip_" required>
                                                    <div id="validationServer05Feedback" class="invalid-feedback">
                                                        Please enter your zip-code.
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                    <label for="phone" class="form-label">Phone Number</label>
                                                    <input name="number" value="<?= $data['phone_number'] ?>" type="number" class="form-control" id="phone" placeholder="Optional" required>
                                                    <div class="invalid-feedback">
                                                        Please provide valid phone number.
                                                    </div>
                                                </div>

                                                <!-- user id  -->
                                                <input type="hidden" name="id" value="<?=$data['id']?>">
                                                <input type="hidden" name="role_id" value="<?=$data['role_id']?>">

                                                <!-- qualifications  -->
                                                <div class="col-md-12 switch-patient">
                                                    <label for="edu" class="form-label">Educational Qualifications</label>

                                                    <p class="help_input" style="color:red">
                                                        Example# (institue1)(institute2)(institute3)
                                                    </p>
                                                    <div class="form-group has-validation form-floating">
                                                        <textarea name="education_info" class="form-control" id="edu-qualification" style="height: 4rem" placeholder="" required><?= $data['education_info'] ?></textarea>
                                                        <label for="edu-qualification">Important</label>

                                                        <div class="invalid-feedback">
                                                            Please provide your educational info
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="col-md-12 switch-patient">
                                                    <label for="edu" class="form-label">Work Places</label>
                                               
                                                    <p class="help_input" style="color:red;">
                                                        Example# (workplace)(otherworkplace)(anotherworkplace)
                                                    </p>

                                                    <div class="form-group has-validation form-floating">
                                                        <textarea name="working_info" class="form-control" id="work_info" style="height: 4rem" placeholder="" required><?= $data['working_info'] ?></textarea>
                                                        <label for="work_info">Important</label>

                                                        <div class="invalid-feedback">
                                                            Please provide your working info
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-12 d-grid">
                                                    <button name="btn-edit_experts" class="btn btn-primary" type="submit">Register Now</button>
                                                </div>
                                            </form>



                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </section>
        </main>


        <!-- footer  -->
        <?php include_once "./admin-layouts/footer.php"; ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="./js/datatables-simple-demo.js"></script>

<?php
include "../functionalities/form-validation.php";
//country code 
include "../config/db_connection.php";
include "../functionalities/country_code_menupulation.php";

?>

<script type="text/javascript">
    // console.log(country);

    country.firstElementChild.removeAttribute("selected");

    for (let data of country){
        // console.log(data.value);
        if(data.value == <?=$data['country_id']?>){
            data.setAttribute("selected","");
        }
    }

</script>

</body>

</html>