<?php

include_once "./admin-layouts/head.php";
include_once "./admin-layouts/nav.php";

// db connection 
$validation = true;
$validation_message = [];

//query 
$status = 1;
include "./users_query.php";

// print_r($sql);
// exit();
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
                <h1 class="mt-4">All user</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="<?= $dashboard ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Tables</li>
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
                        User List
                    </div>
                    <div class="card-body">
                        <table id="users" class="display">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Efficiency</th>
                                    <th>Age</th>
                                    <!-- <th>Experience</th> -->
                                    <th>Contact</th>
                                    <th>Role</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Gender</th>
                                    <th>Efficiency</th>
                                    <th>Age</th>
                                    <!-- <th>Experience</th> -->
                                    <th>Contact</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php
                                foreach($user_stack AS $value){
                                    // print_r($value);

                                    switch ($value['role_id']) {
                                        case 1 :
                                            $value['role'] = 'admin';
                                            break;
                                        
                                        case 2 :
                                            $value['role'] = 'councilor';
                                            break;
                                        case 3 :
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
                                    <td><?= $value['email'] ?></td>
                                    <td><?= $value['gender'] ?></td>
                                    <td><?= $value['education_info'] ?></td>
                                    <td><?= date('Y') - date('Y', strtotime($value['date_of_birth'])) ?></td>
                                    <!-- <td><?= $value['working_info'] ?></td> -->
                                    <td><?= $value['phone_code']. $value['phone_number'] ?></td>
                                    <td><?=ucwords($value['role'])?></td>
                                    
                                    <td>
                                        <div class="dropdown  overflow-visible">
                                            <div class="action">
                                                <div class="btn-group">
                                                    <button class="action dropdown-toggle action-button" type="button" data-bs-toggle="dropdown" aria-expanded="false">

                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="./view_user.php?view_user=true&user_id=<?=$value['id']?>"><i class="fa-solid fa-eye text-success"></i> view</a></li>
                                                        <?php if($value['role_id'] == 2 || $value['role_id'] == 3){ ?>
                                                        <li><button name="btn-block" class="dropdown-item" value="../backend/manage_user.php?block=true&user_id=<?=$value['id']?>"><i class="fa-solid fa-user-lock text-primary"></i> block</button></li>
                                                        <?php }?>
                                                        <li><button name="btn-delete" class="dropdown-item" value="../backend/manage_user.php?del_user=true&user_id=<?=$value['id']?>"><i class="fa-solid fa-trash-can text-danger"></i> Delete</button></li>
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

<script src="../vendor/DataTables/datatables.min.js"></script>


<script>
    $(document).ready(function() {
        $('#users').DataTable();
    });



    let btnBlock = document.querySelectorAll("[name='btn-block']");
    let btnDelete = document.querySelectorAll("[name='btn-delete']");

    // block user 
    for (let item of btnBlock) {
        item.addEventListener('click', e => {
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