<?php
include_once "./admin-layouts/head.php";
include_once "./admin-layouts/nav.php";

// db connection 
include "../config/db_connection.php";
// function for view patients data 
function patients_info($ap_id)
{
    $sql = "SELECT users.id, concat(users.f_name,' ',users.l_name) AS full_name, users.email, users.phone_code as phone_code_id,country.phonecode, users.phone_number,users.gender,users.date_of_birth,country.name as country_name, 
            concat(users.addr,',',users.city,'-',users.zip_code) as `address`
            FROM appointment
            JOIN user_appointment ON appointment.id = user_appointment.appointment_id
            JOIN users ON user_appointment.patient_id = users.id
            JOIN country ON users.country_id = country.id
            JOIN country con_ph ON users.phone_code = con_ph.id
            WHERE appointment.id = $ap_id AND user_appointment.appointment_status = 1";


    if ($user_info_set = db_connection()->query($sql)) {
        $user_info = $user_info_set->fetch_all(MYSQLI_ASSOC);
        return $user_info;
    } else {
        return false;
    }
}






if (isset($_GET['view_patients']) && isset($_GET['appointment_id'])) {
    if (!empty($_GET['appointment_id'])) {
        $patients_info = patients_info($_GET['appointment_id']);
    }
}



?>
<div id="layoutSidenav">
    <!-- aside  -->
    <?php
    if (isset($_SESSION['admin'])) {
        include_once "./admin-layouts/aside.php";
    } elseif (isset($_SESSION['doctor']) || isset($_SESSION['councilor'])) {
        $dashboard = "./experts_dashboard.php";
        include_once "./admin-layouts/experts_aside.php";
    }
?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Patients</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="<?= $dashboard ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Patients</li>
                </ol>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        User List
                    </div>
                    <div class="card-body">
                        <table class="table table-striped" id="all_patients">
                            <thead>
                                <tr>
                                    <th>Sr no.</th>
                                    <th>ID</th>
                                    <th>Patient Name</th>
                                    <th>Email</th>
                                    <th>Date Of Birth</th>
                                    <th>Gender</th>
                                    <th>Contact No</th>
                                    <th>Country</th>
                                    <th>Address</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Sr no.</th>
                                    <th>ID</th>
                                    <th>Patient Name</th>
                                    <th>Email</th>
                                    <th>Date Of Birth</th>
                                    <th>Gender</th>
                                    <th>Contact No</th>
                                    <th>Country</th>
                                    <th>Address</th>
                                    <!-- <th>Action</th> -->
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $count = 1; foreach ($patients_info as $row) { ?>
                                    <tr>
                                        <td><?= $count ?></td>
                                        <td><?= $row['id'] ?></td>
                                        <td><?= $row['full_name'] ?></td>
                                        <td><?= $row['email'] ?></td>
                                        <td><?= $row['date_of_birth'] ?></td>
                                        <td><?= $row['gender'] ?></td>
                                        <td><?= $row['phonecode'] . $row['phone_number'] ?></td>
                                        <td><?= $row['country_name'] ?></td>
                                        <td><?= $row['address'] ?></td>
                                        

                                        <!-- <td>
                                            <div class="dropdown  overflow-visible">
                                                <div class="action">
                                                    <div class="btn-group">
                                                        <button class="action dropdown-toggle action-button" type="button" data-bs-toggle="dropdown" aria-expanded="false">

                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" href="./appointed_patients.php?view_patients=true&user_id=<?= $row['id'] ?>"><i class="fa-solid fa-eye text-success"></i> view patients</a></li>

                                                            <li><a class="dropdown-item" href="./view_user.php?view_user=true&user_id=<?= $row['doctor_id'] ?>"><i class="fa-solid fa-eye text-socondary"></i> View Doctor</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>  -->
                                    </tr>
                                <?php $count++; } ?>

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
        $('#all_patients').DataTable();
    });
</script>
</body>

</html>