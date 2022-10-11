<?php
session_start();

$title = ucwords($_SESSION['user_info']['name']);
$hover_nav = "profile";

$banner_location = 'images/banner/banner_8.jpg';
$banner_heading = "My Details";

include_once "layouts/head.php";
include_once  "layouts/nav.php";
include_once  "layouts/banner.php";



$img_location = $_SESSION['user_info']['user_avater'] . '.' . $_SESSION['user_info']['user_avater_format'];
$id = $_SESSION['user_info']['id'];
if ($_SESSION['user_info']['role'] == 1) {
    $role = "Admin";
} else {
    $role = "General User";
}

?>
<div class="container ">




    <div class="row justify-content-center">
        <div class="col-10 pt-3 pb-3">
            <div class="card ">
                <h3 class="card-header"><i class="fas fa-address-card"></i> <?= ucwords($_SESSION['user_info']['name']) ?></h3>
                <div class="card-body">
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-10 col-md-10">
                            <div class="row pt-3">
                                <!--Profile picture left content -->
                                <div class="col-12 col-md-5 col-lg-5 d-flex col-sm-12">
                                    <div class="profile_pic pt-3">
                                        <img src="images/uploads/<?= $img_location ?>" alt="Loading">

                                    </div>

                                </div>

                                <!-- Right side content -->
                                <div class="col-12 col-md-7 col-lg-7 ml-4 ml-lg-0 ml-md-0 col-sm-12">
                                    <div class="user_details pt-5">
                                        <div class="form-group row">
                                            <div class="col-12 ">
                                                <i class="fas fa-user-cog"></i><span class="pl-1"><?= ucwords($role) ?></span>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-12 ">
                                                <i class="fas fa-user"></i><span class="pl-1"><?= ucwords($_SESSION['user_info']['name']) ?></span>
                                            </div>
                                        </div>

                                        <div class="form-group row ">
                                            <div class="col-12">
                                                <div>
                                                    <i class="fas fa-envelope"></i><span class="pl-1"><?= $_SESSION['user_info']['email_add'] ?></span>
                                                </div>
                                                <div class="pl-4">
                                                    <a href="" data-toggle="modal" data-target="#email_change" class="small">Change Email</a>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group row ">
                                            <div class="col-12">
                                                <i class="fas fa-birthday-cake"></i><span class="pl-1"><?= $_SESSION['user_info']['dob'] ?></span>
                                            </div>
                                        </div>

                                        <div class="form-group row ">

                                            <div class="col-12">
                                                <i class="fas fa-phone"></i> <span class="pl-1"><?= $_SESSION['user_info']['phonecode'] . $_SESSION['user_info']['phone'] ?></span>
                                            </div>
                                        </div>

                                        <div class="form-group row ">
                                            <div class="col-12">
                                                <i class="fas fa-map-marked-alt"></i><span class="pl-1"><?= 'Zip-code: ' . $_SESSION['user_info']['zip_code'] . ', ' . ucfirst($_SESSION['user_info']['city']) . ', ' . ucfirst(strtolower($_SESSION['user_info']['country_name'])) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
                <div class="card-footer">
                    <div class="row justify-content-center">
                        <div class="col-12 col-lg-10 col-md-10">
                            <div class="d-lg-flex d-md-flex">
                                <div class="col-12 form-group d-flex col-md-4 col-lg-4">
                                    <button type="button" data-toggle="modal" data-target="#profile_pic" class="btn btn-block btn-info">Change Picture</button>
                                </div>
                                <div class="col-12 form-group d-flex col-md-4 col-lg-4">
                                    <button onclick="window.location.href = 'edit_profile.php?uid=$id';" class="btn btn-block btn-primary">Edit Info</button>
                                </div>
                                <div class="col-12 form-group d-flex col-md-4 col-lg-4">
                                    <button type="button" id="password_change" onclick="window.location.href = 'change_password.php';" name="pass_change" class="btn btn-block btn-primary">Change Password</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Picture change modal -->

<div class="modal fade" id="profile_pic" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content profile_modal">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Change Profile Picture</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card-body">
                            <!--                            <img class="img-thumbnail mb-2" src="images/uploads/--><? //=$img_location
                                                                                                                    ?>
                            <!--" alt="">-->
                            <form method="POST" id="changepp" action="backend/change_pp.php" enctype="multipart/form-data">
                                <div class="custom-file">
                                    <input type="file" name="profile_change" required class="custom-file-input" id="customFile">
                                    <label class="custom-file-label" for="customFile">Choose Photo</label>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="pp" form="changepp" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>


<!--Email change modal -->
<div class="modal fade" id="email_change" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Change Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card-body">
                            <!--                            <img class="img-thumbnail mb-2" src="images/uploads/--><? //=$img_location
                                                                                                                    ?>
                            <!--" alt="">-->
                            <form method="POST" id="change_email_id" action="backend/change_email.php">
                                <input type="hidden" name="id" value="<?= $id ?>">
                                <div class="form-group">
                                    <label for="email_id" class="col-form-label">New Email</label>
                                    <input type="email" name="new_email" class="form-control" placeholder="Enter new email" required>
                                </div>
                                <div class="form-group">
                                    <label for="email_id" class="col-form-label">Password</label>
                                    <input type="password" name="pass" class="form-control" placeholder="Enter Your Password" required>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" name="email_change" form="change_email_id" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>


<?php
include_once "layouts/footer.php";
?>