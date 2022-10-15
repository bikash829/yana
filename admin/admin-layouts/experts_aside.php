<?php
$create_appointment  = "./ex_create_appointment.php";
$next_appointment = "./appointment_history.php";

if (isset($_SESSION['admin'])) {
    $user = 'admin';
} elseif (isset($_SESSION['councilor'])) {
    $user = 'councilor';
} elseif (isset($_SESSION['doctor'])) {
    $user = 'doctor';
}


?>

<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="<?= $dashboard ?>">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <!-- apointment section  -->
                <?php
                if (isset($_SESSION['doctor'])) {

                ?>
                    <div class="sb-sidenav-menu-heading">User</div>
                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i> </div>
                        Appointments
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="<?= $create_appointment ?>"><i class="fa-solid fa-person-circle-plus"></i>&nbsp; Create Appoint</a>
                            <a class="nav-link" href="<?= $next_appointment ?>"><i class="fa-solid fa-hourglass-start"></i>&nbsp; History</a>

                        </nav>
                    </div>
                <?php
                }
                ?>

                <div class="sb-sidenav-menu-heading"> Interface</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Profile
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">

                        <a class="nav-link" href="my_profile.php">My Profile</a>
                        <a class="nav-link" href="ex_edit_profile.php">Edit Profile</a>
                        <a class="nav-link" href="ex_edit_bio.php">Edit Bio</a>
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#change_admin_pass">Change Password</a>
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#change_admin_email">Change Email</a>

                    </nav>
                </div>

                <!-- //notification and messges  -->
                <div class="sb-sidenav-menu-heading">Notifications & Messages</div>
                <a class="nav-link" href="admin_community.php">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-users-rectangle"></i></div>
                    Community Posts
                </a>
                <a class="nav-link" href="create_post.php">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-circle-plus"></i></div>
                    Create Post
                </a>

                <?php
                if ($user == 'councilor') {
                ?>


                    <div class="sb-sidenav-menu-heading">User Feedback</div>
                    <a class="nav-link" href="user_feedback.php">
                        <div class="sb-nav-link-icon"><i class="fa-solid fa-medal"></i></div>
                        User Feedback
                    </a>
                <?php } else {  ?>
                    <a class="nav-link" href="my_patients.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                        Total Patients
                    </a>

                <?php } ?>





            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <span>
                <?php
                if (isset($_SESSION['doctor'])) {
                    echo "Doctor";
                } elseif (isset($_SESSION['councilor'])) {
                    echo "Councilor";
                }
                ?>
            </span>
        </div>
    </nav>
</div>


<?php
include "../modals/admin_pass&email.php";


?>


<!-- popup alert  -->
<?php
include_once "../functionalities/alert.php";


if (isset($_SESSION['change_admin_pass'])) {
    $alert_status = alert($_SESSION['change_admin_pass']);
    unset($_SESSION['change_admin_pass']);
} elseif (isset($_SESSION['email_changed'])) {
    $alert_status = alert($_SESSION['email_changed']);
    unset($_SESSION['email_changed']);
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