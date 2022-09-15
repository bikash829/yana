<?php
session_start();
$title= "Change Password";
$hover_nav = "profile";
include_once "layouts/head.php";
include_once "layouts/nav.php";
$id = $_SESSION['user_info']['id'];
?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-8">
            <div class="card my-5">
                <div class="card-header"><h2>Change password</h2></div>
                <div class="card-body row justify-content-center">
                    <form class="col-12 col-lg-10 col-md-10" method="POST" action="backend/password.php">

                        <input type="hidden" name="uid" value="<?=$id?>" >
                        <div class="form-group">
                            <input type="password" name="old_pass" class="form-control" placeholder="Old Password" required>
                        </div>
                        <div class="form-group">
                            <input type="password" name="new_pass" class="form-control" placeholder="New Password" required>
                        </div>

                        <div class="form-group">
                            <input type="password" name="re_pass" class="form-control " placeholder="Re-type Password" required>
                        </div>

                        <div class="form-group ">
                            <input type="submit" value="Change Password" name="pass_change" class="btn  btn-primary" >
                            <input type="button" onclick="window.location='profile_view.php'" value="Cancel"  class=" btn btn-danger" >
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
include_once "layouts/footer.php";
?>