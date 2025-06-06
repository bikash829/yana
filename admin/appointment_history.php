<?php

include_once "./admin-layouts/head.php";

if (isset($_SESSION['doctor'])) {
    $user_role = $_SESSION['doctor']['role'];
} elseif (isset($_SESSION['councilor'])) {
    $user_role = $_SESSION['councilor']['role'];
} else {
    $user_role =  "Nothing to print";
}

//changing layouts
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

$user_id = $data['id'];

function my_appointment($user_id)
{
    $sql = "SELECT appointment.*,(
        SELECT count(*) FROM user_appointment WHERE user_appointment.appointment_id = appointment.id AND user_appointment.appointment_status = 1) 
        AS total_patients 
        FROM appointment 
        WHERE doctor_id = $user_id  ORDER BY ap_date DESC;";

    if ($raw_appointment = db_connection()->query($sql)) {
        $appointments = $raw_appointment->fetch_all(MYSQLI_ASSOC);
        return $appointments;
    }
}

if (isset($_SESSION['doctor'])) {
    $doctor_id = $_SESSION[$user_role]['id'];
    $appointment_list = my_appointment($doctor_id);
}



?>
<div id="layoutSidenav">
    <!-- aside  -->
    <?php include_once "./admin-layouts/experts_aside.php"; ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">All Appointment</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="<?= $dashboard ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Tables</li>
                </ol>
                <!-- <div class="card mb-4">
                    <div class="card-body">
                        DataTables is a third party plugin that is used to generate the demo table below. For more information about DataTables, please visit the
                        <a target="_blank" href="https://datatables.net/">official DataTables documentation</a>
                        .
                    </div>
                </div> -->
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        All Appointment
                    </div>
                    <div class="card-body">
                        <table id="appointment_history" class="display">



                            <thead>
                                <tr>
                                    <th>sr. no</th>
                                    <th>ap_id</th>
                                    <th>Date</th>
                                    <th>Start At</th>
                                    <th>End In</th>
                                    <th>Capacity</th>
                                    <th>Patient Count</th>
                                    <th>Fees</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>sr. no</th>
                                    <th>ap_id</th>
                                    <th>Date</th>
                                    <th>Start At</th>
                                    <th>End In</th>
                                    <th>Capacity</th>
                                    <th>Patient Count</th>
                                    <th>Fees</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $count = 1;
                                foreach ($appointment_list as $value) {
                                ?>

                                    <tr>
                                        <td><?= $count ?></td>
                                        <td><?= $value['id'] ?></td>
                                        <td><?= $value['ap_date'] ?></td>
                                        <td><?= $value['start_time'] ?></td>
                                        <td><?= $value['end_time'] ?></td>
                                        <td><?= $value['patient_capacity'] ?></td>
                                        <td><?= $value['total_patients'] ?></td>
                                        <td><?= $value['fees'] ?></td>
                                        <!-- <td><?= $value['country_name'] ?></td> -->

                                        <td>
                                            <!-- <a class="dropdown-item" href="./view_appointment.php?appointment_id=<?= $value['id'] ?>"><i class="fa-solid fa-eye text-success"></i> view</a> -->

                                            <div class="dropdown  overflow-visible">
                                                <div class="action">
                                                    <div class="btn-group">
                                                        <button class="action dropdown-toggle action-button" type="button" data-bs-toggle="dropdown" aria-expanded="false">

                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" href="./view_appointment.php?appointment_id=<?= $value['id'] ?>"><i class="fa-solid fa-eye text-success"></i> View Appintment</a></li>
                                                            <li><a class="dropdown-item" href="./appointed_patients.php?appointment_id=<?= $value['id'] ?>&view_patients=true"><i class="fa-solid fa-eye text-success"></i> view Patients</a></li>

                                                            <!-- <li><a class="dropdown-item" href="./backend/manage_appointment.php?del_appointment=true&appointment_id=<?= $value['id'] ?>"><i class="fa-solid fa-trash-can text-danger"></i> Delete</a></li> -->
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php $count += 1;
                                } ?>
                            </tbody>

                        </table>
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

<script src="../vendor/DataTables/datatables.min.js"></script>




<?php
include_once "../functionalities/alert.php";


if (isset($_SESSION['appointment_create'])) {
    $alert_status = alert($_SESSION['appointment_create']);

    unset($_SESSION['appointment_create']);
} else {
    $alert_status = false;
}


?>

<script type="text/javascript">
    // datatable 
    $(document).ready(function() {
        $('#appointment_history').DataTable();
    });


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
            timer: 2500
        })
    }
</script>

</body>

</html>