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

        <main class="main">
            <section class="profile mt-2">

                <div class="row justify-content-center">
                    <div class="col-lg-8 col-10">
                        <div class="card">
                            <div class="card-header">
                                <?= ucwords($data['f_name'])  . ' ' . ucwords($data['l_name'])  ?>

                            </div>
                            <div class="card-body position-relative">

                                <div class=" px-3">
                                    <div class="row  justify-content-center">
                                        <div class="col-12 text-center">

                                            <img src=".<?= $data['profile_location'] . $data['profile_photo'] ?>" class="img-fluid rounded-start" alt="There is no photo uploaded yet">

                                            <!-- <p class="text-center"><a href="#" data-bs-toggle="modal" data-bs-target="#change_pp">Change Photo</a></p> -->
                                        </div>
                                        <button data-bs-toggle="modal" data-bs-target="#change_pp" class="btn col-6 btn-sm my-3 btn-primary">Upload a photo</button>
                                        <div class="col-12">
                                            <div class="card-body profile-details row">

                                                <div class="form-group col-md-6 col-lg-6">
                                                    <h5 class="mb-0"><?= ucwords($data['f_name']) . ' ' . ucwords($data['l_name'])  ?></h5>
                                                </div>
                                                <div class="form-group pb-3 text-secondary ">
                                                    <?= ucwords($data['role']) ?>
                                                </div>
                                                <div class="form-group py-1 col-md-6 col-lg-6">

                                                    <span><i class="fa-solid fa-envelope"></i>&nbsp;&nbsp;<a href="mailto:<?= $data['email'] ?>"><?= $data['email'] ?></a> </span>
                                                    <!-- <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a data-bs-toggle="modal" data-bs-target="#change_email" href="#">change email</a> -->
                                                </div>
                                                <div class="form-group py-1 col-md-6 col-lg-6">
                                                    <span><i class="fa-solid fa-address-book"></i> <?= $data['phone_code'] . ' ' .  $data['phone_number'] ?></span>
                                                </div>
                                                <div class="form-group py-1 col-md-6 col-lg-6">
                                                    <span><i class="fa-solid fa-cake-candles"></i> <?= $data['date_of_birth'] ?></span>

                                                </div>

                                                <div class="form-group py-1 col-md-6 col-lg-6">
                                                    <span><i class="fa-solid fa-cake-candles"></i> <?= ucwords($data['gender'])  ?></span>

                                                </div>

                                                <div class="form-group py-1 col-md-6 col-lg-6">
                                                    <span> <i class="fa-solid fa-graduation-cap"></i> <?= $data['education_info'] ?></span><br>
                                                    <span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a data-bs-toggle="modal" data-bs-target="#education_certificates" href="#">View Document</a></span>
                                                </div>


                                                <div class="form-group py-1 col-md-6 col-lg-6">
                                                    <span><i class="fa-solid fa-briefcase"></i></span> <?= $data['working_info'] ?>
                                                </div>

                                                <div class="form-group py-1 col-md-6 col-lg-6">
                                                    <span><i class="fa-solid fa-location-dot"></i>&nbsp;&nbsp;<?= $data['addr'] . ', ' . $data['city'] . '-' . $data['zip_code'] ?></span>
                                                </div>
                                                <div class="form-group py-1 col-md-6 col-lg-6">
                                                    <span><i class="fa-solid fa-flag"></i> <?= $data['country_name'] ?></span>
                                                </div>

                                                <div class="form-group pt-2 text-center fs-4 col-12">
                                                    About
                                                </div>

                                                <div class="form-group text-center  col-12">
                                                    <?= $data['bio'] ?>
                                                </div>


                                                <!-- <div class="form-group mt-4">
                                                <div class="row gap-2">
                                                    <a class="btn btn-primary col" data-bs-toggle="modal" data-bs-target="#change_password">Change Password</a>
                                                    <a href="./edit_user.php" class="btn btn-primary col">Edit Information </a>
                                                </div>

                                    
                                            </div> -->
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </section>
        </main>


        <!-- footer  -->
        <?php include_once "./admin-layouts/footer.php"; ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>




<?php
include_once "../modals/admin_pass&email.php";
include_once "../functionalities/alert.php";

if (isset($_SESSION['edit_info'])) {
    $alert_status = alert($_SESSION['edit_info']);

    unset($_SESSION['edit_info']);
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