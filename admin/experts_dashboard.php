<?php
include_once "./admin-layouts/head.php";

if (isset($_SESSION['doctor'])) {
    $user_role = ucwords($_SESSION['doctor']['role']);
} elseif (isset($_SESSION['councilor'])) {
    $user_role = ucwords($_SESSION['councilor']['role']);
} else {
    $user_role =  "Nothing to print";
}

// link 
$dashboard = "./experts_dashboard.php";

include_once "./admin-layouts/nav.php";
include "../config/db_connection.php";
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
                    <div class="col-xl-3 col-md-6">
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
                    <div class="col-xl-3 col-md-6">
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
                    <div class="col-xl-3 col-md-6">
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
                    <div class="col-xl-3 col-md-6">
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
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email Id</th>
                                    <th>Country</th>
                                    <th>Born In</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Email id</th>
                                    <th>Country</th>
                                    <th>Born In</th>
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
                                            <td><?= $row['date_of_birth'] ?></td>
                                            <td><?= $row['role'] ?></td>
                                            <td>
                                                <div class="dropdown  overflow-visible">
                                                    <div class="action">
                                                        <div class="btn-group">
                                                            <button class="action dropdown-toggle action-button" type="button" data-bs-toggle="dropdown" aria-expanded="false">

                                                            </button>
                                                            <ul class="dropdown-menu">
                                                                <li><a class="dropdown-item" href="./view_user.php?view_user=true&user_id=<?= $row['id'] ?>"><i class="fa-solid fa-eye text-success"></i> view</a></li>
                                                                <?php if ($row['role_id'] == 2 || $row['role_id'] == 3) { ?>
                                                                    <li><a class="dropdown-item" href="../backend/manage_user.php?block=true&user_id=<?= $row['id'] ?>"><i class="fa-solid fa-user-lock text-primary"></i> block</a></li>
                                                                <?php } ?>
                                                                <li><a class="dropdown-item" href="../backend/manage_user.php?del_user=true&user_id=<?= $row['id'] ?>"><i class="fa-solid fa-trash-can text-danger"></i> Delete</a></li>
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