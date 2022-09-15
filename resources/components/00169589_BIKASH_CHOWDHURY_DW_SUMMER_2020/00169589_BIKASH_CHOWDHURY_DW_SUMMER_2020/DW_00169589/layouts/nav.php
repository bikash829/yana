<?php
//Temporary block
$disable = '';
$block_message = '';
if (isset($_SESSION['locked'])){
    $difference = time()-$_SESSION['locked'];
    if ($difference>60*10){
        session_unset();
        $disable ='';
    }
}

if (isset($_SESSION['attempt'])){
    if ($_SESSION['attempt']>2){
        $disable = 'disabled';
        $block_message = "<p>Too many login attempt has been blocked for 10 minutes</p>";

    }
}




//if (isset($_GET['']))
$alert_success = "";
        function alert_pop($msg,$event_name){
            return  $event_name."=\"alert('$msg')\"";
        }

if (isset($_GET['login_success'])) {
    $alert_success =  alert_pop($_GET['login_success'], "onload");
}
if (isset($_GET['success'])) {
    $alert_success =  alert_pop($_GET['success'], "onload");
}

?>
<body <?=$alert_success?>>

<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">


    <div class="container">
        <a class="navbar-brand" href="index.php">Air<span>Pollution</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="fa fa-bars"></span> Menu
        </button>
        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav m-auto">
                <!-- Dynamic code for active nav item -->
               <?php
               /*
                    switch ($hover_nav){
                        case "home":
                            $home = "active";
                            break;
                        case "about":
                            $about = "active";
                            break;
                        case "services":
                            $services = "active";
                            break;
                        case "story":
                            $story = "active";
                            break;
                        case "blog":
                            $blog = "active";
                            break;
                        case "contact":
                            $contact= "active";
                            break;
                        case "join":
                            $sing_in = "active";
                            $sing_up = "active";
                            break;
                        default:
                            $home = "active";
                            break;
                    }
               */
               ?>
                <li class="nav-item  <?php if ($hover_nav == "home") {echo "active";}?> "><a href="index.php" class="nav-link text-white">Home</a></li>
                <li class="nav-item <?php if ($hover_nav=="blog"){echo "active";}?>"><a href="blog.php" class="nav-link text-white">Blog Post</a></li>
                <li class="nav-item <?php if ($hover_nav=="contact"){echo "active";}?>"><a href="contact.php" class="nav-link text-white">Contact</a></li>

            </ul>

            <ul class="navbar-nav ml-auto">
                <!-- Admin controller -->
                <?php
                if (isset($_SESSION['user_info']['role'])){
                    if ($_SESSION['user_info']['role']==1){
                        ?>
                        <li class="nav-item <?php if ($hover_nav=="Manage"){echo "active";}?> dropdown"><a href="#" class="nav-link dropdown-toggle text-white" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Manage</a>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a class="dropdown-item p-3" href="manage_users.php">Manage Users</a></li>
                                <li><a class="dropdown-item p-3"  href="manage_blog.php">Blog Post</a></li>
                                <li><a class="dropdown-item p-3"  href="create_faq.php">Manage Faq</a></li>
                                <li><a class="dropdown-item p-3" href="users_questions.php">User Questions</a></li>
                            </ul>
                        </li>
                    <?php }} ?>
                <!-- End admin controller -->
                <!--user profile dropdown-->
                <?php
                if (isset($_SESSION['user_info']['email_add'])){
                    ?>
                    <li class="nav-item <?php if ($hover_nav=="profile"){echo "active";}?> dropdown"><a href="#" class="nav-link dropdown-toggle text-white" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Profile</a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item p-3"  href="profile_view.php">View Profile</a></li>
                            <li><a class="dropdown-item p-3" href="backend/logout.php?log_out">Logout</a></li>
                        </ul>
                    </li>
                <?php }else{ ?>
                    <!--End user sign in and sign up interface-->
                    <li class="nav-item"> <a class=" nav-link text-white" data-toggle="modal" data-target="#login_modal" href="#">Sign In</a></li>
                    <li data-toggle="tooltip" data-placement="bottom" title="Join us to get free home pollution testing kit" class="nav-item <?php if ($hover_nav=="sign_up"){echo "active";}?>"><a href="sign_up.php" class="nav-link text-white">Sign Up</a></li>
                <?php } ?>
                <!--End Join us dropdown menu-->
            </ul>
        </div>

    </div>

</nav>
<!--bootstrap Alert-->
<?php if (isset($_GET['error'])){ ?>
<div class="row justify-content-end " >
    <div class="alert alert-danger position-absolute mt-3 mr-4 alert-dismissible fade show " style="z-index: 1" id="error"  role="alert">
        <h4 class="alert-heading">Error Alert!!!</h4>
        <strong></strong> <?=$_GET['error']?><br>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
</div>
<?php } ?>


<?php if (isset($_GET['error_reg'])){
    $error_messages= unserialize(urldecode($_GET['error_reg']));
    ?>
    <div class="row justify-content-end " >
        <div class="alert alert-danger position-absolute mt-3 mr-4 alert-dismissible fade show " style="z-index: 1" id="error"  role="alert">
            <h4 class="alert-heading">Error Alert!!!</h4>
            <?php foreach ($error_messages as $error){ ?>
            <strong></strong> <?=$error?><br>
            <?php } ?>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>
<?php } ?>


<?php
include_once "sign_in.php";
?>