<?php

include_once "./admin-layouts/head.php";
include_once "./admin-layouts/nav.php";

?>

<div id="layoutSidenav">
    <!-- aside  -->

    <?php
    if (isset($_SESSION['admin'])) {
        include_once "./admin-layouts/aside.php";
    } elseif (isset($_SESSION['doctor'])) {
        $dashboard = "./experts_dashboard.php";
        include_once "./admin-layouts/experts_aside.php";
    }elseif(isset($_SESSION['councilor'])){
        $dashboard = "./councilor_dashboard.php";
        include_once "./admin-layouts/experts_aside.php";
    }

    if(isset($_SESSION['admin'])){
        $user_role = 'admin';
    }elseif(isset($_SESSION['doctor'])){
        $user_role = 'doctor';
    }elseif(isset($_SESSION['councilor'])){
        $user_role = 'councilor';
    }

    ?>
    <div id="layoutSidenav_content">
        <section class="segment-margin ">
            <!-- post sectoin  -->
            <div class="community__post community__post--modified post m-4">
            <!-- creating new post section  -->
            
                <div class="post__card post__card--modified">
                    <div class="post__title">
                        <h3 class="post__author fs-4">Create a new post</h3>
                    </div>
                    <div class="p-des">
                        <div class="p-des__article">
                            <form action="../backend/create_post.php" method="POST">

                                <h5 class="fs-4 fw-lighter"><?= $_SESSION[$user_role]['f_name'] . $_SESSION[$user_role]['l_name'] ?></h5>
                                <input type="hidden" name="user_id" value="<?= $_SESSION[$user_role]['id'] ?>">
                                <div class="form-group py-2">

                                    <input type="text" name="post_title" required class="form-control" placeholder="Post Title" maxlength="256">
                                </div>

                                <div class="form-group py-2">

                                    <textarea name="post_details" required class="form-control" rows="3" placeholder="Write Your Post Here"></textarea>
                                </div>

                                <div class="form-group py-2">
                                    <div class="col text-center"><input type="submit" value="Post Now" name="post_article" class="btn btn-primary"></div>

                                </div>
                            </form>
                        </div>

                    </div>
                </div>

            <!-- <div class="row justify-content-center">
                <div class="col-11">
                    <div class="card">
                       <h3>Hello this is a test</h3>
                    </div>
                </div>
            </div> -->
            <!-- end creating new post  -->
            </div>
        </section>





        <!-- footer  -->
        <?php include_once "./admin-layouts/footer.php"; ?>
    </div>
</div>
<!-- script -->
<?php include_once "./admin-layouts/closer.php"; ?>

<?php
include_once "../functionalities/alert.php";
// alert defined on footer before 

if (isset($_SESSION['post_alert'])) {
    $alert_status = alert($_SESSION['post_alert']);
    var_dump($alert_status);
    unset($_SESSION['post_alert']);
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


