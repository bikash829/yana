<?php
include_once "./admin-layouts/head.php";
include_once "./admin-layouts/nav.php";

// db connection 
include "../config/db_connection.php";

function appointment_request()
{
    $sql = "SELECT users.id as patient_id,concat(users.f_name,' ',users.l_name) AS patient_full_name,doctor.id as doc_id, concat(doctor.f_name,' ',doctor.l_name) 
            AS doc_full_name , users.email,user_appointment.id AS user_appointment_id,users.phone_number,user_appointment.appointment_id,appointment.ap_date,appointment.patient_capacity,appointment.fees
            FROM user_appointment 
            JOIN users ON user_appointment.patient_id = users.id
            JOIN appointment ON user_appointment.appointment_id = appointment.id
            JOIN users doctor ON appointment.doctor_id = doctor.id
            WHERE appointment_status = 2";


    if ($appointmnet_data = db_connection()->query($sql)) {
        $all_request = $appointmnet_data->fetch_all(MYSQLI_ASSOC);
        return $all_request;
    }
}


// active appointments
function active_appointment()
{
    $sql = "SELECT appointment.*,concat(users.f_name,' ',users.l_name) as full_name, users.email,users.phone_number 
    FROM appointment
    JOIN users ON appointment.doctor_id = users.id";
    $active_appointments = array();

    if ($all_appointments_set = db_connection()->query($sql)) {
        $all_appointments = $all_appointments_set->fetch_all(MYSQLI_ASSOC);
        foreach ($all_appointments as $row) {

            $diff = floor((time() - strtotime($row['ap_date'])) / (60 * 60 * 24));

            if ($diff < 0) {
                array_push($active_appointments, $row);
            }
        }

        return $active_appointments;
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
                <h1 class="mt-4">All user</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="<?= $dashboard ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Tables</li>
                </ol>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        User List
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="appointment_req">
                            <thead>
                                <tr>
                                <th>ID</th>
                                    <th>Doctor Name</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th>Start At</th>
                                    <th>End In</th>
                                    <th>Capacity</th>
                                    <th>Fees</th>
                                    <th>Total Booked</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Doctor Name</th>
                                    <th>Email</th>
                                    <th>Date</th>
                                    <th>Start At</th>
                                    <th>End In</th>
                                    <th>Capacity</th>
                                    <th>Fees</th>
                                    <th>Total Booked</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                foreach (active_appointment() as $row) {
                                ?>

                                    <tr>
                                        <td><?= $row['id'] ?></td>
                                        <td><?= $row['full_name']  ?></td>
                                        <td><?= $row['email'] ?></td>
                                        <td><?= $row['ap_date'] ?></td>
                                        <td><?= $row['start_time'] ?></td>

                                        <td><?= $row['end_time'] ?></td>
                                        <td><?= $row['patient_capacity']  ?></td>
                                        <td><?= $row['fees'] ?></td>
                                        <td><?= $row['role'] ?></td>

                                        <td>
                                            <div class="dropdown  overflow-visible">
                                                <div class="action">
                                                    <div class="btn-group">
                                                        <button class="action dropdown-toggle action-button" type="button" data-bs-toggle="dropdown" aria-expanded="false">

                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" href="./appointed_patients.php?view_patients=true&appointment_id=<?= $row['id'] ?>"><i class="fa-solid fa-eye text-success"></i> view patients</a></li>
                                                            
                                                            <li><a class="dropdown-item" href="./view_user.php?view_user=true&user_id=<?= $row['doctor_id'] ?>"><i class="fa-solid fa-eye text-socondary"></i> View Doctor</a></li>
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