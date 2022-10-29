<?php

include_once "./admin-layouts/head.php";
include_once "./admin-layouts/nav.php";

// db connection 
include "../config/db_connection.php";

$validation = true;
$validation_message = [];

//query 
$sql = "SELECT `users`.*, `additional_info`.education AS education_info, `additional_info`.`working_info`,`additional_info`.document_location,`additional_info`.`document_name`, `additional_info`.`bio`
FROM `users` 
JOIN `additional_info` ON `users`.id = additional_info.user_id
WHERE `status` IS NULL;";

if ($dataList =  db_connection()->query($sql)) {
    $user_stack = $dataList->fetch_all(MYSQLI_ASSOC);
} else {
    $validation = false;
    $validation_message['error_tech'] = "Technical error try again";
}


// validation checker
if ($validation) {
    true;
} else {
    header("Location: ../error.php");
}

?>
<div id="layoutSidenav">
    <!-- aside  -->
    <?php include_once "./admin-layouts/aside.php"; ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">Pending user</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="<?= $dashboard ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Tables</li>
                </ol>

                <div class="card mb-4">
                    <div class="card-header">
                        <i class="fas fa-table me-1"></i>
                        User List
                    </div>
                    <div class="card-body ">
                        <table id="pending_user" class="display">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>email</th>
                                    <th>Efficiency</th>
                                    <th>Age</th>
                                    <th>Experience</th>
                                    <th>Contact</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Gender</th>
                                    <th>email</th>
                                    <th>Efficiency</th>
                                    <th>Age</th>
                                    <th>Experience</th>
                                    <th>Contact</th>
                                    <th>Status</th>

                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                foreach ($user_stack as $value) {
                                    // print_r($value);

                                    switch ($value['role_id']) {
                                        case 1:
                                            $value['role'] = 'admin';
                                            break;

                                        case 2:
                                            $value['role'] = 'councilor';
                                            break;
                                        case 3:
                                            $value['role'] = 'doctor';
                                            break;
                                        case 4:
                                            $value['role'] = 'patient';
                                            break;
                                        default:
                                            $value['role'] = 'other';
                                            break;
                                    }
                                ?>

                                    <tr>
                                        <td><?= $value['id'] ?></td>
                                        <td><?= $value['f_name'] . ' ' . $value['l_name'] ?></td>
                                        <td><?= $value['gender'] ?></td>
                                        <td><?= $value['email'] ?></td>
                                        <td><?= $value['education_info'] ?></td>
                                        <td><?= date('Y') - date('Y', strtotime($value['date_of_birth'])) ?></td>
                                        <td><?= $value['working_info'] ?></td>
                                        <td><?= $value['phone_code'] . $value['phone_number'] ?></td>

                                        <?php
                                        $req_info = array('type' => 'req', 'uid' => $value['id']);


                                        ?>
                                        <!-- <td><a href="../backend/manage_user.php?req=true&user_id=<?= $value['id'] ?>" class="btn btn-sm btn-primary">Accept</a></td> -->
                                        <td><?= ucwords($value['role']) ?></td>

                                        <td>
                                            <div class="dropdown  overflow-visible">
                                                <div class="action">
                                                    <div class="btn-group">
                                                        <button class="action dropdown-toggle action-button" type="button" data-bs-toggle="dropdown" aria-expanded="false">

                                                        </button>
                                                        <ul class="dropdown-menu">
                                                            <li><a class="dropdown-item" href="./view_user.php?view_user=true&user_id=<?= $value['id'] ?>"><i class="fa-solid fa-eye text-success"></i> view</a></li>
                                                            <li><button name="btn-accept" class="dropdown-item" value="../backend/manage_user.php?req=true&user_id=<?= $value['id'] ?>"><i class="fa-solid fa-circle-check text-success"></i> Accept</button></li>
                                                            <li><button name="btn-delete" class="dropdown-item" value="../backend/manage_user.php?del_user=true&user_id=<?= $value['id'] ?>"><i class="fa-solid fa-trash-can text-danger"></i> Delete</button></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
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



<script type="text/javascript" src="../vendor/DataTables/datatables.min.js"></script>
<!-- <script type="text/javascript" src="../vendor/DataTables/dataTables.responsive.min.js"></script> -->


<!-- alert notification -->
<?php
include_once "../functionalities/alert.php";



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

    //datatable
    $(document).ready(function() {
        $('#pending_user').DataTable({
            responsive: true
        });
    });



    let btnAccept = document.querySelectorAll("[name='btn-accept']");
    let btnDelete = document.querySelectorAll("[name='btn-delete']");

    console.log(btnAccept);


    // block user 
    for (let item of btnAccept) {
        item.addEventListener('click', e => {
            // con.log('hello');
            Swal.fire({
                title: 'Are you sure want to accept the user?',
                text: "You won't be able to revert this!",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, Confirm!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = (e.target).value;
                }
            })
        })
    }

    //delete user 
    for (let item of btnDelete) {
        item.addEventListener('click', e => {
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
                    window.location.href = (e.target).value;
                }
            })
        })
    }
</script>





</body>

</html>