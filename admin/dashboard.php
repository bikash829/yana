<?php




include_once "./admin-layouts/head.php";
$user_rode = "Admin";
include_once "./admin-layouts/nav.php";
include "../config/db_connection.php";



if (isset($_SESSION['admin'])) {

    $sql = "SELECT `users`.*,`country`.`name` AS `country_name` FROM `users` 
            JOIN `country` ON `country`.`id` = `users`.`country_id`
            WHERE `status` = 1";

    if ($user_stack = db_connection()->query($sql)) {
        $active_user_list = $user_stack->fetch_all(MYSQLI_ASSOC);

        $total_doc = 0;
        $total_patient = 0;
        $total_councilor = 0;

        foreach ($active_user_list as $row) {
            switch ($row['role_id']) {
                case '2':

                    $total_councilor++;
                    break;
                case '3':
                    $total_doc++;
                    break;
                case '4':
                    $total_patient++;
                    break;
                default:
                    # code...
                    break;
            }
        }
    }


    // pending users 
    $sql_inactive = "SELECT * FROM `users` WHERE `status` IS NULL";
    if ($data = db_connection()->query($sql_inactive)) {
        $user_request = $data->fetch_all(MYSQLI_ASSOC);
        $total_request = 0;
        foreach ($user_request as $row) {
            $total_request++;
        }
    }
} else {
    header("Location: ./index.php");
}
?>
<div id="layoutSidenav">
    <!-- aside  -->
    <?php include_once "./admin-layouts/aside.php"; ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Admin Dashboard</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item active">Admin Dashboard</li>
                </ol>
                <div class="row">
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="card bg-primary text-white mb-4">
                            <h4 class="card-header">Total Doctors</h4>
                            <div class="card-body">
                                <p class="text-center fs-2"><?= $total_doc ?></p>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="./doctors.php">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="card bg-warning text-white mb-4">
                            <h4 class="card-header">Total Councilors</h4>
                            <div class="card-body">
                                <p class="text-center fs-2"><?= $total_councilor ?></p>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="./councilors.php">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="card bg-success text-white mb-4">
                            <h4 class="card-header">Total Patients</h4>
                            <div class="card-body">
                                <p class="text-center fs-2"><?= $total_patient ?></p>
                            </div>
                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="./patients.php">View Details</a>
                                <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-6">
                        <div class="card bg-danger text-white mb-4">
                            <h4 class="card-header">Pending Request</h4>
                            <div class="card-body">
                                <p class="text-center fs-2"><?= $total_request ?></p>
                            </div>

                            <div class="card-footer d-flex align-items-center justify-content-between">
                                <a class="small text-white stretched-link" href="./pending_user.php">View Details</a>
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
                        Registerd Doctors And Councilors
                    </div>
                    <div class="card-body">
                        <table class="display nowrap" id="registered_users">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email Id</th>
                                    <th>Country</th>
                                    <th>Age</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Email id</th>
                                    <th>Country</th>
                                    <th>Age</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                foreach ($active_user_list as $row) {
                                    // print_r($active_user_list);
                                    // exit();

                                    switch ($row['role_id']) {
                                        case 1:
                                            $row['role'] = "admin";
                                            break;
                                        case 2:
                                            $row['role'] = "councilor";
                                            break;
                                        case 3:
                                            $row['role'] = "doctor";
                                            break;
                                        case 4:
                                            $row['role'] = "patient";
                                            break;

                                        default:
                                            $row['role'] = "others";
                                            break;
                                    }

                                    if ($row['role_id'] == 2 || $row['role_id'] == 3) {


                                ?>

                                        <tr>
                                            <td><?= $row['f_name'] . ' ' . $row['l_name'] ?></td>
                                            <td><?= $row['email'] ?></td>
                                            <td><?= $row['country_name'] ?></td>
                                            <td><?= date('Y') - date('Y', strtotime($row['date_of_birth']) ) ?></td>
                                            <td><?= ucwords($row['role'])  ?></td>
                                            <td>
                                                <div class="dropdown  overflow-visible">
                                                    <div class="action">
                                                        <div class="btn-group">
                                                            <button class="action dropdown-toggle action-button" type="button" data-bs-toggle="dropdown" aria-expanded="false">

                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="dropdown-item" href="./view_user.php?view_user=true&user_id=<?= $row['id'] ?>"><i class="fa-solid fa-eye text-success"></i> view</a></li>
                                                                <?php if ($row['role_id'] == 2 || $row['role_id'] == 3) { ?>
                                                                    <li><button class="dropdown-item" name="btn-block" value="../backend/manage_user.php?block=true&user_id=<?= $row['id'] ?>"><i class="fa-solid fa-user-lock text-primary"></i> block</button></li>
                                                                <?php } ?>
                                                                <li><button class="dropdown-item" name="btn-delete" value="../backend/manage_user.php?del_user=true&user_id=<?= $row['id'] ?>"><i class="fa-solid fa-trash-can text-danger"></i> Delete</button></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            </td>
                                        </tr>

                                <?php
                                    }
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
<!-- script -->
<?php include_once "./admin-layouts/closer.php"; ?>

<!-- alert notification -->
<?php
include "../functionalities/alert.php";


if (isset($_SESSION['manage_user'])) {
    $alert_status = alert($_SESSION['manage_user']);
    unset($_SESSION['manage_user']);
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


    let btnBlock, btnDelete;
    btnBlock = document.querySelectorAll('[name="btn-block"]');
    btnDelete = document.querySelectorAll('[name="btn-delete"]');


    // block users 
    btnBlock.forEach(item => {
        item.addEventListener('click', event => {
            Swal.fire({
                title: 'Are you sure want to block the user?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Confirm!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // console.log((event.target).value);
                    window.location.href = (event.target).value;
                }
            })

        })
    });


    // delete users 
    btnDelete.forEach(item => {
        item.addEventListener('click', event => {
            Swal.fire({
                title: 'Are you sure want to delete the user?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Confirm!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // console.log((event.target).value);
                    window.location.href = (event.target).value;
                }
            })
        })
    });
</script>


<!-- datatable  -->
<script>
    $(document).ready(function() {
        $('#registered_users').DataTable();
    });
</script>