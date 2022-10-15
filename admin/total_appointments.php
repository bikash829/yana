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
        $user_role = 'doctor';
        break;
    case 'councilor':
        $data = $_SESSION['councilor'];
        $user_role = 'councilor';
        break;

    default:
        # code...
        break;
}

include_once "../config/db_connection.php";



function my_appointment($user_id){
    $sql = "SELECT appointment.*,(
        SELECT count(*) FROM user_appointment WHERE user_appointment.appointment_id = appointment.id) 
        AS total_patients 
        FROM appointment 
        WHERE doctor_id = $user_id ORDER BY ap_date DESC;";

    if($raw_appointment = db_connection()->query($sql)){
        $appointments = $raw_appointment->fetch_all(MYSQLI_ASSOC);
        return $appointments;
    }
}

if (isset($_SESSION['doctor'])) {
    $doctor_id = $_SESSION[$user_role]['id'];   
    $appointments = my_appointment($doctor_id);
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

                <table id="view_appointment" class="display">
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
                        foreach ($appointments as $value) {
                        ?>

                            <tr>
                                <td><?= $count ?></td>
                                <td><?= $value['id'] ?></td>
                                <td><?= $value['ap_date'] ?></td>
                                <td><?= $value['start_time'] ?></td>
                                <td><?= $value['end_time'] ?></td>
                                <td><?= $value['patient_capacity']?></td>
                                <td><?=  $value['total_patients'] ?></td>
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
        </main>





        <!-- footer  -->
        <?php include_once "./admin-layouts/footer.php"; ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>

<!-- datatable & jquery js  -->
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script type="text/javascript" src="../vendor/DataTables/datatables.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#view_appointment').DataTable();
    });
</script>

</body>

</html>