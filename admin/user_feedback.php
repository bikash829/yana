<?php
include_once "./admin-layouts/head.php";

if (isset($_SESSION['doctor'])) {
    $user_role = $_SESSION['doctor']['role'];
} elseif (isset($_SESSION['councilor'])) {
    $user_role = $_SESSION['councilor']['role'];
} else {
    $user_role =  "Nothing to print";
}



// data 
switch (isset($_SESSION)) {
    case isset($_SESSION['doctor']):
        $data = $_SESSION['doctor'];
        $dashboard = "./experts_dashboard.php";
        break;
    case isset($_SESSION['councilor']):
        $data = $_SESSION['councilor'];
        $dashboard = "./councilor_dashboard.php";
        break;

    default:
        # code...
        break;
}



// link 
include_once "./admin-layouts/nav.php";


// db connection 
include "../config/db_connection.php";

function db_result($sql)
{
    if (db_connection()->query($sql)) {
        return (db_connection()->query($sql))->fetch_all(MYSQLI_ASSOC);
    } else {
        return false;
    }
}

$councilor_id = $_SESSION['councilor']['id'];
$feedback_sql = "SELECT feedback.rating_count,`feedback`.`feedback`,CONCAT(users.f_name,' ',users.l_name) AS patient_name,users.email as patient_email,users.date_of_birth
                FROM feedback 
                JOIN users ON feedback.patient_id = users.id 
                WHERE ser_provider_id = $councilor_id ORDER BY feedback.id DESC;";

$feedback_info = db_result($feedback_sql);


?>
<div id="layoutSidenav">
    <!-- aside  -->
    <?php include_once "./admin-layouts/experts_aside.php"; ?>
    <div id="layoutSidenav_content">

        <main class="main">
            <div class="container-fluid px-4">
                <h1 class="mt-4">User Feedback</h1>
                <ol class="breadcrumb mb-4">
                    <li class="breadcrumb-item"><a href="<?= $dashboard ?>">Dashboard</a></li>
                    <li class="breadcrumb-item active">Tables</li>
                </ol>

                <table class="display" id="feedback">
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
                                    <td><?= date('Y') - date('Y', strtotime($row['date_of_birth'])) ?></td>
                                    <td><?= $row['rating_count'] ?></td>
                                    <td><?= $row['feedback'] ?></td>
                                </tr>

                        <?php $count++;
                            }
                        } ?>
                    </tbody>
                </table>

            </div>
        </main>


        <!-- footer  -->
        <?php include_once "./admin-layouts/footer.php"; ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
<script src="../vendor/DataTables/datatables.min.js"></script>

<script type="text/javascript">
    // datatable 
    $(document).ready(function() {
        $('#feedback').DataTable();
    });
</script>
</body>

</html>