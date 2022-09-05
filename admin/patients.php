<?php

include_once "./admin-layouts/head.php";
include_once "./admin-layouts/nav.php";

?>
<div id="layoutSidenav">
    <!-- aside  -->
    <?php include_once "./admin-layouts/aside.php"; ?>
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4">
                <h1 class="mt-4">All Patients</h1>
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
                        Patient List
                    </div>
                    <div class="card-body">
                        <table id="datatablesSimple">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Occupation</th>
                                    <th>Age</th>
                                    <th>Contact No</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Occupation</th>
                                    <th>Age</th>
                                    <th>Contact No</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <tr>
                                    <td>Tiger Nixon</td>
                                    <td>Tiger Nixon</td>
                                    <td>System Architect</td>
                                    <td>Edinburgh</td>
                                    <td>61</td>
                                    <td>
                                        <div class="dropdown  overflow-visible">
                                            <div class="action">
                                                <div class="btn-group">
                                                    <button class="action dropdown-toggle action-button" type="button" data-bs-toggle="dropdown" aria-expanded="false">

                                                    </button>
                                                    <ul class="dropdown-menu">
                                                        <li><a class="dropdown-item" href="#"><i class="fa-solid fa-eye text-success"></i> view</a></li>
                                                        <li><a class="dropdown-item" href="#"><i class="fa-solid fa-user-lock text-primary"></i> block</a></li>
                                                        <li><a class="dropdown-item" href="#"><i class="fa-solid fa-trash-can text-danger"></i> Delete</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>

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
<script src="js/datatables-simple-demo.js"></script>
</body>

</html>