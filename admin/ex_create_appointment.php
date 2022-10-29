<?php

include_once "./admin-layouts/head.php";

if (isset($_SESSION['doctor'])) {
    $user_role = ucwords($_SESSION['doctor']['role']);
    $session_name  = 'doctor';
} elseif (isset($_SESSION['councilor'])) {
    $user_role = ucwords($_SESSION['councilor']['role']);
    $session_name  = 'councilor';
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


include_once "../config/db_connection.php";
function medium_list()
{
    $sql = "SELECT * FROM social_medium";

    if ($medium_raw = db_connection()->query($sql)) {
        $medium_list = $medium_raw->fetch_all(MYSQLI_ASSOC);
        return $medium_list;
    } else {
        return false;
    }
}


?>
<div id="layoutSidenav">
    <!-- aside  -->
    <?php include_once "./admin-layouts/experts_aside.php"; ?>
    <div id="layoutSidenav_content">

        <main>
            <div class="row justify-content-center">
                <div class="col-md-10 col-lg-10 m-3 ">
                    <div class="card ">
                        <h4 class="card-header">Create Appoingtment</h4>
                        <div class="card-body">
                            <form id='create_appointment' action="../backend/create_apointment.php" method="POST" class="row g-3 needs-validation" novalidate>
                                <div class="col-12 text-center">
                                    <h3><label for="time" class="">Set Time</label></h3>
                                </div>
                                <div class="col-md-4">
                                    <label for="apointment-date" class="form-label">Apointment Date</label>
                                    <input name="apointment-date" type="date" class="form-control" id="apointment-date" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <label for="start_at" class="form-label">Start At</label>
                                    <input name="ap-start-at" type="time" class="form-control" id="start_at" max="23:00" min="00:00" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="validationCustom02" class="form-label">End In</label>
                                    <input name="ap-end-in" type="time" class="form-control" max="23:59:59" min="00:00" required>
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                </div>




                                <div class="col-md-6">
                                    <label for="capacity" class="form-label">Capacity</label>
                                    <input name="patient-capacity" type="number" min="1" class="form-control" id="capacity" required>
                                    <div class="invalid-feedback">
                                        Please set maximum capacity of your appointment
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="fee" class="form-label">Fee</label>
                                    <input name="ap-fee" type="number" min="1" class="form-control" id="fee" required>
                                    <div class="invalid-feedback">
                                        Assign your fee
                                    </div>
                                </div>








                                <div class="col-12">
                                    <label for="validationTextarea" class="form-label">Appoinment Description</label>
                                    <textarea name="ap-description" class="form-control" id="validationTextarea" placeholder="Required Description" required></textarea>
                                    <div class="invalid-feedback">
                                        Please enter the appointment description for the patients.
                                    </div>
                                </div>


                                <div class="col-12">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                                        <label class="form-check-label" for="invalidCheck">
                                            Agree to terms and conditions
                                        </label>
                                        <div class="invalid-feedback">
                                            You must agree before submitting.
                                        </div>
                                    </div>
                                </div>
                                <!-- //user id  -->
                                <input type="hidden" name="user_id" value="<?= $data['id'] ?>">
                                <input type="hidden" name="btn-create-apointment" ?>
                                <div class="col-12">
                                    <button id="btn-create-appointment" type="submit" class="btn btn-primary">Create</button>
                                </div>
                            </form>

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


<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function() {
        'use strict'

        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.querySelectorAll('.needs-validation')

        // Loop over them and prevent submission
        Array.prototype.slice.call(forms)
            .forEach(function(form) {


                form.addEventListener('submit', function(event) {

                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()

                    } else {

                        event.preventDefault();

                        Swal.fire({
                            title: 'Are you sure?',
                            text: "You won't be able to revert this!",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#3085d6',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Yes, Confrim!'
                        }).then((result) => {
                            if (result.isConfirmed) {


                                form.submit();
                            }
                        })

                    }

                    form.classList.add('was-validated')

                }, false)
            })
    })()




    let ageGuard = document.getElementById('apointment-date');
    let currentDate = new Date();
    let initialMonth = currentDate.getMonth() + 1;
    let currentDay, currentMonth, currentYear;
    currentDay = currentDate.getDate() < 10 ? `0${currentDate.getDate()}` : currentDate.getDate();
    currentMonth = initialMonth < 10 ? `0${initialMonth}` : initialMonth;
    currentYear = currentDate.getFullYear();

    let minYear = `${currentYear-10}-${currentMonth}-${currentDay}`;

    let today = `${currentYear}-${currentMonth}-${currentDay}`;


    ageGuard.min = today;
</script>


<!-- notification view  -->

<?php
include "../functionalities/alert.php";

if (isset($_SESSION['appointment_create'])) {
    $alert_status = alert($_SESSION['appointment_create']);
    unset($_SESSION['appointment_create']);
} else {
    $alert_status = false;
}


?>

<script type="text/javascript">
    // validation message 
    console.log(<?= json_encode($alert_status) ?>);
    alertStatus = <?= json_encode($alert_status ?? null) ?>;
    console.log(alertStatus)
    if (alertStatus) {
        Swal.fire({
            position: 'top-end',
            icon: alertStatus.status,
            title: alertStatus.message,
            showConfirmButton: false,
            timer: 1500
        })
    }
</script>

</body>

</html>