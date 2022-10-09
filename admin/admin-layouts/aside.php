<?php
$create_user  = "./create_user.php";
$patient = "./patients.php";
$doctor = "./doctors.php";
$councilor = "./councilors.php";
$all_user = "./all_user.php";
$pending_user = "./pending_user.php";
$blocked_user = "./blocked_user.php";

$appointment_request = "./appointment_request.php";
$active_appointments  = "./active_appointments.php";


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
                <div class="sb-sidenav-menu-heading">User</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-user"></i> </div>
                    Manage Users
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="<?= $create_user ?>"><i class="fa-solid fa-person-circle-plus"></i>&nbsp; Add User</a>
                        <a class="nav-link" href="<?= $pending_user ?>"><i class="fa-solid fa-hourglass-start"></i>&nbsp; Pending User</a>
                        <a class="nav-link" href="<?= $blocked_user ?>"><i class="fa-solid fa-ban"></i>&nbsp; Blocked User</a>
                        <a class="nav-link" href="<?= $doctor ?>"><i class="fa-solid fa-user-doctor"></i> &nbsp; Doctors</a>
                        <a class="nav-link" href="<?= $councilor ?>"><i class="fa-brands fa-teamspeak"></i>&nbsp; Councilors</a>
                        <a class="nav-link" href="<?= $patient ?>"><i class="fa-solid fa-bed"></i>&nbsp; Patients</a>
                        <a class="nav-link" href="<?= $all_user ?>"><i class="fa-solid fa-user"></i>&nbsp; All Users</a>
                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">Appointments</div>
                <a class="nav-link" href="<?= $appointment_request ?>"><i class="fa-solid fa-hourglass-start"></i>&nbsp; Appointment Request</a>
                <a class="nav-link" href="<?= $active_appointments ?>"><i class="fa-regular fa-square-check"></i>&nbsp; Active Appointments</a>

                <div class="sb-sidenav-menu-heading">Community</div>

                <a class="nav-link" href="admin_community.php">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-users-rectangle"></i></div>
                    Community Posts
                </a>
                <a class="nav-link" href="create_post.php">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-circle-plus"></i></div>
                    Create Post
                </a>


                <div class="sb-sidenav-menu-heading">Notifications & Messages</div>

                <a class="nav-link" href="contact_message.php">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-envelope"></i></div>
                    Contact Us Message
                </a>

            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <span><?= ucwords($_SESSION['admin']['role']) ?></span>
        </div>
    </nav>
</div>