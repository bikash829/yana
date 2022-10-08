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

include "../config/db_connection.php";

function my_patients($doc_id){
    $sql = "SELECT concat(p.f_name,' ',p.l_name) AS full_name,p.id AS patient_id, p.email, p.phone_code as phone_code_id, p.phone_number, 
            country.name AS country_name, country.phonecode AS phone_code, appointment.id AS appointment_id, appointment.ap_date 
            FROM user_appointment 
            JOIN appointment ON user_appointment.appointment_id = appointment.id
            JOIN users p ON user_appointment.patient_id = p.id
            JOIN country ON p.country_id = country.id
            JOIN country phone ON p.phone_code = phone.id
            WHERE doctor_id = 17 GROUP BY user_appointment.patient_id
            ORDER BY ap_date DESC;";
    
    if($patients_set = db_connection()->query($sql)){
        $patient_list = $patients_set->fetch_all(MYSQLI_ASSOC);
        return $patient_list;
    }else{
        return false;
    }

}

$patient_list = my_patients($_SESSION[$user_role]['id']);

?>
<div id="layoutSidenav">
    <!-- aside  -->
    <?php include_once "./admin-layouts/experts_aside.php"; ?>
    <div id="layoutSidenav_content">

        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">My Patients</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="<?= $dashboard ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Patients</li>
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
                        My Patients
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>sr. no</th>
                                    <th>ap_id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact No</th>
                                    <th>Appointment Date</th>
                                    <th>Country</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>sr. no</th>
                                    <th>ap_id</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Contact No</th>
                                    <th>Appointment Date</th>
                                    <th>Country</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                $count = 1;
                                foreach ($patient_list as $value) {
                                    
                                ?>

                                    <tr>
                                        <td><?= $count ?></td>
                                        <td><?= $value['appointment_id'] ?></td>
                                        <td><?= $value['full_name'] ?></td>
                                        <td><?= $value['email'] ?></td>
                                        <td><?= $value['phone_code'] . $value['phone_number'] ?></td>
                                        <td><?= $value['ap_date'] ?></td>
                                        <td><?= $value['country_name'] ?></td>


                                        <td>
                                            <!-- <a class="dropdown-item" href="./view_appointment.php?appointment_id=<?= $value['id'] ?>"><i class="fa-solid fa-eye text-success"></i> view</a> -->

                                            <div class="dropdown  overflow-visible">
                                                <div class="action">
                                                    <div class="btn-group">
                                                        <button class="action dropdown-toggle action-button" type="button" data-bs-toggle="dropdown" aria-expanded="false">

                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" href="./view_appointment.php?appointment_id=<?= $value['appointment_id'] ?>"><i class="fa-solid fa-eye text-success"></i> View Appintment</a></li>
                                                            <li><a class="dropdown-item" href="./view_patients.php?view_user=ture&user_id=<?= $value['patient_id'] ?>&view_patients=true"><i class="fa-solid fa-eye text-success"></i> view Patients</a></li>

                                                            <!-- <li><a class="dropdown-item" href="./backend/manage_appointment.php?del_appointment=true&appointment_id=<?= $value['id'] ?>"><i class="fa-solid fa-trash-can text-danger"></i> Delete</a></li> -->
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php $count = 1; } ?>
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