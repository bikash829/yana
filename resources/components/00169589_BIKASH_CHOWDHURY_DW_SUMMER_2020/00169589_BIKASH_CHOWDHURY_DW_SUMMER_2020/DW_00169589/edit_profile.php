<?php
session_start();
$title = "Edit Profile";
//$hover_nav = "profile";
include_once "layouts/head.php";
include_once "layouts/nav.php";
//echo print_r($_SESSION['user_info']);

include "backend/functions.php";


$male= null;
$female= null;
$others = null;
if ($_SESSION['user_info']['gender']==1){
    $male = "checked";
}elseif($_SESSION['user_info']['gender']==2){
    $female = "checked";
}elseif ($_SESSION['user_info']['gender']==3){
    $others = "checked";
}

//echo print_r($_SESSION['user_info']);

?>
<div class="container">
    <div class="row justify-content-center">
        <div class="card mt-3 mb-4">
            <h3 class="card-header"><?=ucwords($_SESSION['user_info']['name'])?></h3>
            <div class="card-body px-4 ">
                <!-- Form start -->
                <form id="update_form" action="backend/update.php" method="POST" >
                    <!--user name -->
                    <div class="form-group row">
                        <div class="custom_input col-12 col-sm-6 col-md-6 col-lg-6">
                            <label for="first_name" class="col-form-label">First Name</label>
                            <input type="text" id="first_name" name="first_name" value="<?=first_name($_SESSION['user_info']['name'])?>" required class="form-control" placeholder="Jhon">
                        </div>
                        <div class="custom_input col-12 col-sm-6 col-md-6 col-lg-6">
                            <label for="last_name" class="col-form-label">Last Name</label>
                            <input type="text" id="last_name" name="last_name" value="<?=last_name($_SESSION['user_info']['name'])?>" required class="form-control" placeholder="Doy">
                        </div>
                    </div>
                    <!--user name end-->
                    <!--email -->
<!--                    <div class="form-group row">-->
<!--                        <div class="custom_input col-12">-->
<!--                            <label for="email_id" class="col-form-label">Email</label>-->
<!--                            <input type="eamil" id="email_id" name="email" hidden value="--><?//=$_SESSION['user_info']['email_add']?><!--" required class="form-control" placeholder="ex#jhondoy@gmail.com">-->
<!--                        </div>-->
<!--                    </div>-->
                    <!--email end-->
                    <!--Gender ----->
                    <div class="from-group row">
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6 custom_input">
                            <label for="radio_id" class="col-form-label">Gender</label>
                            <div class="pt-1">
                                <div class="radio_">
                                    <div class="custom-control custom_input  custom-radio custom-control-inline">
                                        <input  type="radio" <?=$male?> id="male_" required value="1" name="gender" class="custom-control-input">
                                        <label class="custom-control-label"  for="male_">Male</label>
                                    </div>
                                    <div class="custom-control custom_input custom-radio custom-control-inline">
                                        <input type="radio" <?=$female?> id="female_" value="2" name="gender" class="custom-control-input">
                                        <label class="custom-control-label" for="female_">Female</label>
                                    </div>
                                    <div class="custom-control custom_input custom-radio custom-control-inline">
                                        <input type="radio"  <?=$others?> id="other_" value="3" name="gender" class="custom-control-input">
                                        <label class="custom-control-label" for="other_">Other</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="custom_input col-12 col-sm-6 col-md-6 col-lg-6">
                            <label for="date_of" class="col-form-label">Date Of Birth</label>
                            <input type="date" name="dob" value="<?=$_SESSION['user_info']['dob']?>" required class="datepicker form-control">
                        </div>
                    </div>
                    <!--gender & Date of Birth end-->
                    <!--basic info -->
                    <?php
                    include_once "config/db_connection.php";
                    $con = connection();
                    $sql = "SELECT * FROM country";
                    $data = $con->query($sql);
                    ?>
                    <div class="form-group row">
                        <div class="custom_input col-12 col-sm-6 col-md-6 col-lg-6">
                            <label for="country_name" class="col-form-label">Country</label>
                            <select id="" required name="country" class="custom-select ">

                                <option value="<?=$_SESSION['user_info']['country_id']?>" selected><?=$_SESSION['user_info']['country_name']?></option>
                                <?php foreach ($data as $value){ ?>
                                    <option value="<?=$value['id']?>"><?=$value['name']?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="custom_input col-12 col-sm-6 col-md-6 col-lg-6">
                            <label for="city_name" class="col-form-label">City</label>
                            <input type="text" name="city" value="<?=ucwords($_SESSION['user_info']['city'])?>" required class="form-control" placeholder="EX# London">
                        </div>
                    </div>
                    <!--basic info end-->
                    <!--Phone and zip code -->
                    <div class="form-group row">
                        <div class="custom_input col-12 col-sm-6 col-md-6 col-lg-6">
                            <label for="zip_code_id" class="col-form-label">Zip Code</label>
                            <input type="text" name="zip_code" value="<?=$_SESSION['user_info']['zip_code']?>" required class="form-control" placeholder="ex# 1200">
                        </div>
                        <div class="custom_input col-12 col-sm-6 col-md-6 col-lg-6">
                            <label for="phone_code" class="col-form-label">Phone Number </label>
                            <div class="">

                                <div class="custom_input">
                                    <input type="number" name="phone" value="<?=$_SESSION['user_info']['phone']?>" required placeholder="1800XXXXXX" class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--hone and zip code  end-->

                    <!--Checkbox -->
                    <div class="form-group">
                        <div class="custom-control custom_input custom-checkbox mb-3">
                            <input type="checkbox" name="read_and_accept" class="custom-control-input" id="customControlValidation1" required>
                            <label class="custom-control-label" for="customControlValidation1">Are you sure want to change your information! if yes check the box else press cancel button.</label>
                            <div class="invalid-feedback">Example invalid feedback text</div>
                        </div>
                    </div>
                    <!--Checkbox end-->
                    <!-- Button start---->

                </form>
                <!--Form end-->
                <div class="form-group row">
                    <div class="col-6">

                    </div>
                    <div class="col-6">
                        <button class="btn btn-primary col-6" name="btn_update" form="update_form">Update Info</button>
                        <button class="btn btn-danger  col-5 float-right" onclick="location.href='profile_view.php'">Cancel</button>
                    </div>
                </div>

                <!-- Button end -->
            </div>
        </div>

    </div>
</div>



<?php
include_once "layouts/footer.php";
?>
