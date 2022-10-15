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
include "../config/db_connection.php";

$user_id = $_SESSION[$user_role]['id'];


function appointment_history($user_id)
{
    $sql = "SELECT *,(
        SELECT count(*) FROM user_appointment WHERE user_appointment.appointment_id = appointment.id) 
        as total_patients FROM `appointment` WHERE `doctor_id` = $user_id ORDER BY ap_date DESC;";
    
    
    if ($apointment_set = db_connection()->query($sql)) {
        $appointment_list = $apointment_set->fetch_all(MYSQLI_ASSOC);
        return $appointment_list;
    } else {
        return false;
    }
}



function db_result($query){
    if($result = db_connection()->query($query)){
        return $result->fetch_assoc();
    }else{
        return false;
    }

}

$total_patient = "SELECT count(*) as my_patients FROM
(SELECT count(*) FROM user_appointment 
JOIN appointment ON appointment.id = user_appointment.appointment_id
JOIN users doc ON doc.id = appointment.doctor_id
WHERE doc.id = 4 AND user_appointment.appointment_status = 1 GROUP BY user_appointment.patient_id) AS total_patients
";

$appointment_list = appointment_history($user_id);

$total_appointment = count($appointment_list);

$total_patient = db_result($total_patient)['my_patients'];



?>

<div id="layoutSidenav">
    <!-- aside  -->
    <?php include_once "./admin-layouts/experts_aside.php"; ?>
    <div id="layoutSidenav_content">

        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <h4 class="card-header">My Patients</h4>
                            <div class="card-body">
                                <p class="text-center fs-2"><?php if($total_patient < 1){ echo 0;}else{ echo $total_patient;} ?></p>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="./my_patients.php">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="card bg-warning text-white mb-4">
                            <h4 class="card-header">Total Appointments</h4>
                            <div class="card-body">
                                <p class="text-center fs-2"><?= $total_appointment ?></p>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="./total_appointments.php">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                   
                    <div class="col-xl-4 col-lg-4 col-md-6">
                        <div class="card bg-danger text-white mb-4">
                            <h4 class="card-header">Past Appointments</h4>
                            <div class="card-body">
                                <p class="text-center fs-2">10</p>
                            </div>

                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="#">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-area me-1"></i>
                                Area Chart Example
                            </div>
                            <div class="card-body"><canvas id="myAreaChart" width="100%" height="40"></canvas></div>
                        </div>
                    </div>
                    <div class="col-xl-6">
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-chart-bar me-1"></i>
                                Bar Chart Example
                            </div>
                            <div class="card-body"><canvas id="myBarChart" width="100%" height="40"></canvas></div>
                        </div>
                    </div>
                </div>
                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        Recent Appointments
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Date</th>
                                    <th>Start At</th>
                                    <th>End In</th>
                                    <th>Patient Capacity</th>
                                    <th>Seat Left</th>
                                    <th>Fees</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Date</th>
                                    <th>Start At</th>
                                    <th>End In</th>
                                    <th>Patient Capacity</th>
                                    <th>Seat Left</th>
                                    <th>Fees</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $count = 1;
                               
                                foreach ($appointment_list as $row) { 
                                    

                                   if(!empty($appointment_list)){;
                                   ?>
                                    

                                    <tr>
                                        <td><?= $count ?></td>
                                        <td><?= $row['ap_date'] ?></td>
                                        <td><?= $row['start_time'] ?></td>
                                        <td><?= $row['end_time'] ?></td>
                                        <td><?=$row['patient_capacity']?></td>
                                        <td><?=$row['total_patients']?></td>
                                        <td><?= $row['fees'] ?></td>

                                        <td>
                                            <!-- <a class="dropdown-item" href="./view_appointment.php?appointment_id=<?= $value['id'] ?>"><i class="fa-solid fa-eye text-success"></i> view</a> -->

                                            <div class="dropdown  overflow-visible">
                                                <div class="action">
                                                    <div class="btn-group">
                                                        <button class="action dropdown-toggle action-button" type="button" data-bs-toggle="dropdown" aria-expanded="false">

                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" href="./view_appointment.php?appointment_id=<?= $row['id'] ?>"><i class="fa-solid fa-eye text-success"></i> View Appintment</a></li>
                                                            <li><a class="dropdown-item" href="./appointed_patients.php?appointment_id=<?= $row['id'] ?>&view_patients=true"><i class="fa-solid fa-eye text-success"></i> view Patients</a></li>

                                                            <!-- <li><a class="dropdown-item" href="./backend/manage_appointment.php?del_appointment=true&appointment_id=<?= $row['id'] ?>"><i class="fa-solid fa-trash-can text-danger"></i> Delete</a></li> -->
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>

                                <?php $count++;
                                } }?>

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
<!-- script -->
<?php include_once "./admin-layouts/closer.php"; ?>