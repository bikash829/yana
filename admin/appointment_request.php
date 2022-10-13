<?php

include_once "./admin-layouts/head.php";
include_once "./admin-layouts/nav.php";

// db connection 
include "../config/db_connection.php";


function appointment_request()
{
    $sql = "SELECT users.id as patient_id,concat(users.f_name,' ',users.l_name) AS patient_full_name,users.email as patient_mail,doctor.id as doc_id, concat(doctor.f_name,' ',doctor.l_name) 
            AS doc_full_name , doctor.email as doc_mail ,user_appointment.id AS user_appointment_id,users.phone_number,user_appointment.appointment_id,appointment.ap_date,
            appointment.id as appointment_id,appointment.patient_capacity,appointment.fees
            FROM user_appointment 
            JOIN users ON user_appointment.patient_id = users.id
            JOIN appointment ON user_appointment.appointment_id = appointment.id
            JOIN users doctor ON appointment.doctor_id = doctor.id
            WHERE appointment_status = 2 ORDER BY appointment.ap_date";


    if ($appointmnet_data = db_connection()->query($sql)) {
        $all_request = $appointmnet_data->fetch_all(MYSQLI_ASSOC);
        return $all_request;
    } else {
        return false;
    }
}

?>
<div id="layoutSidenav">
    <!-- aside  -->
    <?php include_once "./admin-layouts/aside.php"; ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Appointment Request</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="<?= $dashboard ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Appointment Request</li>
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
                        All request
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="appointment_req">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Ap ID </th>
                                    <th>Doctor Name</th>
                                    <th>Doctor email</th>
                                    <th>Patient Name</th>
                                    <th>Patient Email</th>
                                    <!-- <th>Experience</th> -->
                                    <th>Date</th>
                                    <th>Capacity</th>
                                    <th>Fees</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Ap ID </th>
                                    <th>Doctor Name</th>
                                    <th>Doctor email</th>
                                    <th>Patient Name</th>
                                   
                                    <th>Patient Email</th>
                                    <!-- <th>Experience</th> -->
                                    <th>Date</th>
                                    <th>Capacity</th>
                                    <th>Fees</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $ap_req = appointment_request();
                                foreach ($ap_req as $row) {
                                ?>

                                    <tr>
                                        <td><?= $row['user_appointment_id'] ?></td>
                                        <td><?= $row['appointment_id'] ?></td>
                                        <td><?= $row['doc_full_name'] ?></td>
                                        <td><?= $row['doc_mail'] ?></td>
                                        <td><?= $row['patient_full_name'] ?></td>
                                        <td><?= $row['patient_mail'] ?></td>
                                        <td><?= $row['ap_date'] ?></td>
                                        <td><?= $row['patient_capacity'] ?></td>
                                        <td><?= $row['fees'] ?></td>


                                        <td>
                                            <div class="dropdown  overflow-visible">
                                                <div class="action">
                                                    <div class="btn-group">
                                                        <button class="action dropdown-toggle action-button" type="button" data-bs-toggle="dropdown" aria-expanded="false">

                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" href="../backend//manage_usr_apointment.php?user_ap=1&user_ap_id=<?= $row['user_appointment_id'] ?>"><i class="fa-solid fa-eye text-success"></i> Accept</a></li>
                                                          
                                                            <li><a class="dropdown-item" href="../backend/manage_usr_apointment.php?user_ap=2&user_ap_id=<?= $row['user_appointment_id'] ?>"><i class="fa-solid fa-ban text-danger"></i> Cancel</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php } ?>
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

<!-- datatable & jquery js  -->
<script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
<script type="text/javascript" src="../vendor/DataTables/datatables.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#appointment_req').DataTable();
    });
</script>

</body>

</html>