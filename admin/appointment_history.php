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

$user_id = $data['id'];

$sql = "SELECT * FROM `appointment` WHERE `doctor_id` = $user_id";



if ($apointment_set = db_connection()->query($sql)) {
    $appointment_list = $apointment_set->fetch_all(MYSQLI_ASSOC);

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
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Start At</th>
                                    <th>End In</th>
                                    <th>Patient Capacity</th>
                                    <th>Fees</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Date</th>
                                    <th>Start At</th>
                                    <th>End In</th>
                                    <th>Patient Capacity</th>
                                    <th>Fees</th>
                                    <th>Description</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                foreach ($appointment_list as $value) {
                                    // print_r($value);
                                ?>

                                    <tr>
                                        <td><?= $value['id'] ?></td>
                                        <td><?= $value['ap_date'] ?></td>
                                        <td><?= $value['start_time'] . ' ' . $value['l_name'] ?></td>
                                        <td><?= $value['end_time'] ?></td>
                                        <td><?= $value['patient_capacity'] ?></td>
                                        <td><?= $value['fees'] ?></td>
                                        <td><?= $value['description'] ?></td>


                                        <td>
                                        <a class="dropdown-item" href="./view_appointment.php?appointment_id=<?= $value['id'] ?>"><i class="fa-solid fa-eye text-success"></i> view</a>

                                            <!-- <div class="dropdown  overflow-visible">
                                                <div class="action">
                                                    <div class="btn-group">
                                                        <button class="action dropdown-toggle action-button" type="button" data-bs-toggle="dropdown" aria-expanded="false">

                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" href="./view_appointment.php?appointment_id=<?= $value['id'] ?>"><i class="fa-solid fa-eye text-success"></i> view</a></li>
                                                           
                                                            <li><a class="dropdown-item" href="./backend/manage_appointment.php?del_appointment=true&appointment_id=<?= $value['id'] ?>"><i class="fa-solid fa-trash-can text-danger"></i> Delete</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div> -->
                                        </td>
                                    </tr>
                                <?php
                                }

                                ?>
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
<script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
<script src="./js/datatables-simple-demo.js"></script>


</body>

</html>