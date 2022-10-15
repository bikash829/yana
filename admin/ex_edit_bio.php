<?php
include_once "./admin-layouts/head.php";

if (isset($_SESSION['doctor'])) {
    $user_role = ucwords($_SESSION['doctor']['role']);
} elseif (isset($_SESSION['councilor'])) {
    $user_role = ucwords($_SESSION['councilor']['role']);
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
include_once "./admin-layouts/nav.php";





?>
<div id="layoutSidenav">
    <!-- aside  -->
    <?php include_once "./admin-layouts/experts_aside.php"; ?>
    <div id="layoutSidenav_content">

        <main>
            <div class="row justify-content-center">
                <div class="col-10 m-3">
                    <div class="card">
                        <h4 class="card-header">My Bio</h4>
                        <div class="card-body">
                            <div id="show_bio">
                                <textarea name="bio" disabled class="form-control" style="height: 50vh;"><?= $data['bio'] ?></textarea>

                                <input type="submit" id="btn-view" value="Edit" name="btn-bio" class="btn d-grid gap-2 col-6 mx-auto  btn-primary mt-2">
                            </div>
                            <form action="../backend/bio.php" method="POST" id="edit_bio">
                                <textarea name="bio" required class="form-control" style="height: 50vh;"><?= $data['bio'] ?></textarea>
                                <input type="hidden" name="uid" value="<?= $data['id'] ?>">
                                <input type="hidden" name="info_id" value="<?= $data['info_id'] ?>">
                                <div class="form-group text-end mt-2">
                                    <input type="submit" value="Save" name="btn-bio" class="btn btn-primary ">
                                    <input type="button" id="btn-cancel-bio" value="cancel" class="btn btn-secondary ">
                                </div>
                            </form>
                        </div>
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



<script type="text/javascript">
    let bioView = document.getElementById("show_bio");
    let bioEdit = document.getElementById("edit_bio");
    let bioBtnView = document.getElementById('btn-view');

    bioBtnView.addEventListener('click', (e) => {
        bioView.style.display = 'none';
        bioEdit.style.display = "block";
    });

    let bioCancel = document.getElementById("btn-cancel-bio");

    bioCancel.addEventListener('click', (e) => {
        bioView.style.display = 'block';
        bioEdit.style.display = 'none';
    });
</script>


<?php
include_once "../functionalities/alert.php";

if (isset($_SESSION['edit_bio'])) {
    $alert_status = alert($_SESSION['edit_bio']);

    unset($_SESSION['edit_bio']);
} else {
    $alert_status = false;
}


?>

<script type="text/javascript">
    // validation message 
    console.log(<?= json_encode($alert_status) ?>);
    alertStatus = <?= json_encode($alert_status ?? null) ?>;
    console.log(alertStatus)
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
</body>

</html>