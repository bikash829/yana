<?php

use Faker\Provider\ar_SA\Color;

include_once "./admin-layouts/head.php";
if (isset($_SESSION['doctor'])) {
    $user_role = $_SESSION['doctor']['role'];
} elseif (isset($_SESSION['councilor'])) {
    $user_role = $_SESSION['councilor']['role'];
} else {
    $user_role =  "Nothing to print";
}

// link 
$dashboard = "./councilor_dashboard.php";

include_once "./admin-layouts/nav.php";
include "../config/db_connection.php";

$user_id = $_SESSION[$user_role]['id'];


function db_result($sql)
{
    if (db_connection()->query($sql)) {
        return (db_connection()->query($sql))->fetch_all(MYSQLI_ASSOC);
    } else {
        return false;
    }
}

function rating_calculator($data){
    $rating_count = 0;
    $count_user = 0;
    foreach($data as $row){
        $rating_count+= $row['rating_count'];
        ++$count_user;
    }

    if($rating_count > 0){
        return $rating_count / $count_user;
    }

}
$councilor_id = $_SESSION['councilor']['id'];


$feedback_sql = "SELECT feedback.rating_count,`feedback`.`feedback`,CONCAT(users.f_name,' ',users.l_name) AS patient_name,users.email as patient_email,users.date_of_birth
                FROM feedback 
                JOIN users ON feedback.patient_id = users.id 
                WHERE ser_provider_id = $councilor_id ORDER BY feedback.id DESC;";




$feedback_info = db_result($feedback_sql);
$rating_count = rating_calculator($feedback_info);

//active status 
if ($_SESSION['councilor']['status'] == 1) {
    $active_status = "Activated";
    $bg_color = "bg-primary";
    $btn_bg = "bg-danger";
    $btn_txt = "Deactive";
} elseif ($_SESSION['councilor']['status'] == 3) {
    $active_status = "Deactivated";
    $bg_color = "bg-danger";
    $btn_bg = "bg-primary";
    $btn_txt = "Active";
}
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
                    <div class="col-lg-6 col-xl-6 col-md-6">
                        <div class="card <?= $bg_color ?> text-white mb-4">
                            <h4 class="card-header">Account Status</h4>
                            <div class="card-body">
                                <p class="text-center fs-2">
                                    <?= $active_status ?>
                                </p>
                            </div>
                            <div class="card-footer <?= $btn_bg ?> d-flex align-items-center justify-content-between">
                                <a id="btn-active" class="small text-white stretched-link" href="#"><?= $btn_txt ?></a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-6 col-md-6">
                        <div class="card bg-secondary text-white mb-4">
                            <h4 class="card-header">Profile Rating</h4>
                            <div class="card-body">
                                <p class="text-center fs-2">
                                    <?=number_format($rating_count,1)?>
                                </p
                                >
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="./user_feedback.php">View Details</a>
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
                        Recent Feedback
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Patient Name</th>
                                    <th>Email</th>
                                    <th>Age</th>
                                    <th>Rate</th>
                                    <th>Feedback</th>

                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Patient Name</th>
                                    <th>Email</th>
                                    <th>Age</th>
                                    <th>Rate</th>
                                    <th>Feedback</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $count = 1;

                                foreach ($feedback_info as $row) {


                                    if (!empty($feedback_info)) {;
                                ?>


                                        <tr>
                                            <td><?= $count ?></td>
                                            <td><?= $row['patient_name'] ?></td>
                                            <td><?= $row['patient_email'] ?></td>
                                            <td><?= date('Y')- date('Y',strtotime($row['date_of_birth'])) ?></td>
                                            <td><?= $row['rating_count'] ?></td>
                                            <td><?= $row['feedback'] ?></td>
                                        </tr>

                                <?php $count++;
                                    }
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
<!-- script -->
<?php include_once "./admin-layouts/closer.php"; ?>
<!-- alert notification -->
<?php
include_once "../functionalities/alert.php";
if (isset($_SESSION['status_report'])) {
    $alert_status = alert($_SESSION['status_report']);
    unset($_SESSION['status_report']);
} else {
    $alert_status = false;
}
?>


<script type="text/javascript">
    // validation message 
    alertStatus = <?= json_encode($alert_status ?? null) ?>;
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


<script type="text/javascript">
    let btnActive = document.getElementById('btn-active');
    let userId = <?= json_encode($_SESSION['councilor']['id']) ?>;
    let currentStatus = <?= json_encode($_SESSION['councilor']['status']) ?>;
    console.log(btnActive);
    console.log(userId);
    console.log(currentStatus);

    btnActive.addEventListener('click', e => {

        Swal.fire({
            title: 'Are you sure want to <?= json_encode($btn_txt) ?> your account?',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Confirm!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = `../backend/manage_councilor.php?uid=${userId}&current_status=${currentStatus}&active=true`;
            }
        })
    })
</script>