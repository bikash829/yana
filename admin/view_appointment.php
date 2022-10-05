<?php

include_once "./admin-layouts/head.php";

if (isset($_SESSION['doctor'])) {
    $user_role = ucwords($_SESSION['doctor']['role']);
} elseif (isset($_SESSION['councilor'])) {
    $user_role = ucwords($_SESSION['councilor']['role']);
} else {
    $user_role =  "Nothing to print";
}


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

include "../config/db_connection.php";

if(isset($_GET['appointment_id'])){
    $appointment_id = $_GET['appointment_id'];
}

$sql = "SELECT * FROM `appointment` WHERE `id` = $appointment_id";



if ($apointment_set = db_connection()->query($sql)) {
    $appointment = $apointment_set->fetch_assoc();
}
?>
<div id="layoutSidenav">
    <!-- aside  -->
    <?php include_once "./admin-layouts/experts_aside.php"; ?>
    <div id="layoutSidenav_content">

        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Appointment Details</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="<?= $dashboard ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Appointment</li>
                </ol>
              
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Appointment Details
                    </div>
                    <div class="card-body row g-3">

                        <div class="col-md-4">
                            <label for="apointment-date" class="form-label">Apointment Date</label>
                            <input  disabled name="apointment-date" type="date" class="form-control" value="<?=$appointment['ap_date']?>" id="apointment-date" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="validationCustom02" class="form-label">Start At</label>
                            <input  disabled name="ap-start-at" type="time" class="form-control" id="validationCustom02" value="<?=$appointment['start_time']?>" max="23:00" min="00:00" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>

                        <div class="col-md-4">
                            <label for="validationCustom02" class="form-label">End In</label>
                            <input  disabled name="ap-end-in" type="time" class="form-control" id="validationCustom02" value="<?=$appointment['end_time']?>" max="23:59:59" min="00:00" required>
                            <div class="valid-feedback">
                                Looks good!
                            </div>
                        </div>




                        <div class="col-md-6">
                            <label for="validationCustom03" class="form-label">Capacity</label>
                            <input  disabled name="patient-capacity" value="<?=$appointment['patient_capacity']?>" type="number" class="form-control" id="validationCustom03" required>
                            <div class="invalid-feedback">
                                Please provide a valid city.
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="validationCustom03" class="form-label">Fee</label>
                            <input  disabled name="ap-fee" type="number" value="<?=$appointment['fees']?>" class="form-control" id="validationCustom03" required>
                            <div class="invalid-feedback">
                                Please provide a valid city.
                            </div>
                        </div>

                        <div class="col-12">
                            <label for="validationTextarea" class="form-label">Appoinment Description</label>
                            <textarea   disabled name="ap-description" class="form-control" id="validationTextarea" placeholder="Required example textarea" required><?=$appointment['description']?></textarea>
                            <div class="invalid-feedback">
                                Please enter a message in the textarea.
                            </div>
                        </div>


                        <!-- //user id  -->
                        <!-- <input type="hidden" name="user_id" value="<?= $data['id'] ?>">-->
                        <div class="col-12 text-end">
                            <button name="btn-create-apointment" class="btn btn-primary" type="submit">Change Appointment</button>
                        </div> 

                    </div>
                </div>
            </div>
        </main>





        <!-- footer  -->
        <?php include_once "./admin-layouts/footer.php"; ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="./js/datatables-simple-demo.js"></script>


</body>

</html>