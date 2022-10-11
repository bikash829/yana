<?php
session_start();
$title = "Edit Profile";
//$hover_nav = "profile";
include_once "layouts/head.php";
include_once "layouts/nav.php";
//echo print_r($_SESSION['user_info']);


include "config/db_connection.php";
$uid =  $_GET['uid'];

$con = connection();


$sql = "SELECT users.*,adrees_info.id AS add_id, adrees_info.zip_code, adrees_info.city,adrees_info.country_id,country.name AS country_name,country.phonecode
                    FROM users
                    left join user_address on user_address.user_id_fk = users.id
                    left join adrees_info on adrees_info.id = user_address.address_id_fk
                    left join country on country.id = adrees_info.country_id
                    WHERE users.id=$uid;";

if ($con->query($sql)){
    $data_set = $con->query($sql)->fetch_assoc();

}else{
    echo "No data found.";
}

include "backend/functions.php";


$male= null;
$female= null;
$others = null;
if ($data_set['gender']==1){
    $male = "checked";
}elseif($data_set['gender']==2){
    $female = "checked";
}elseif ($data_set['gender']==3){
    $others = "checked";
}

//echo print_r($_SESSION['user_info']);

?>
<div class="container">
    <div class="row justify-content-center">
        <div class="card mt-3 mb-4">
            <h3 class="card-header">Hello</h3>
            <div class="card-body px-4 ">
                <!-- Form start -->
                <form id="update_form" action="backend/update_users_byadmin.php" method="POST" >
                    <!--user id-->
                    <input type="hidden" name="user_id" value="<?=$uid?>">
                    <!--user name -->
                    <div class="form-group row">
                        <div class="custom_input col-12 col-sm-6 col-md-6 col-lg-6">
                            <label for="first_name" class="col-form-label">First Name</label>
                            <input type="text" id="first_name" name="first_name" value="<?=first_name($data_set['name'])?>" required class="form-control" placeholder="Jhon">
                        </div>
                        <div class="custom_input col-12 col-sm-6 col-md-6 col-lg-6">
                            <label for="last_name" class="col-form-label">Last Name</label>
                            <input type="text" id="last_name" name="last_name" value="<?=last_name($data_set['name'])?>" required class="form-control" placeholder="Doy">
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
                            <input type="date" name="dob" value="<?=$data_set['dob']?>" required class="datepicker form-control">
                        </div>
                    </div>
                    <!--gender & Date of Birth end-->
                    <!--basic info -->
                    <?php

                    $sql = "SELECT * FROM country";
                    $data = $con->query($sql);
                    ?>
                    <div class="form-group row">
                        <div class="custom_input col-12 col-sm-6 col-md-6 col-lg-6">
                            <label for="country_name" class="col-form-label">Country</label>
                            <select id="" required name="country" class="custom-select ">

                                <option value="<?=$data_set['country_id']?>" selected><?=$data_set['country_name']?></option>
                                <?php foreach ($data as $value){ ?>
                                    <option value="<?=$value['id']?>"><?=$value['name']?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="custom_input col-12 col-sm-6 col-md-6 col-lg-6">
                            <label for="city_name" class="col-form-label">City</label>
                            <input type="text" name="city" value="<?=ucwords($data_set['city'])?>" required class="form-control" placeholder="EX# London">
                        </div>
                    </div>
                    <!--basic info end-->
                    <!--Phone and zip code -->
                    <div class="form-group row">
                        <div class="custom_input col-12 col-sm-6 col-md-6 col-lg-6">
                            <label for="zip_code_id" class="col-form-label">Zip Code</label>
                            <input type="text" name="zip_code" value="<?=$data_set['zip_code']?>" required class="form-control" placeholder="ex# 1200">
                        </div>
                        <div class="custom_input col-12 col-sm-6 col-md-6 col-lg-6">
                            <label for="phone_code" class="col-form-label">Phone Number </label>
                            <div class="row">
                                <div class="col-4">
                                    <select id="" name="phone_code"  required  class="custom-select ">

                                        <option value="<?=$data_set['phonecode']?>" selected><?=$data_set['phonecode']?></i> </option>
                                        <?php foreach ($data as $value){ ?>
                                            <option value="<?=$value['phonecode']?>"><?=$value['phonecode']?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="custom_input col-8">
                                    <input type="number" name="phone" value="<?=$data_set['phone']?>" required placeholder="1800XXXXXX" class="form-control">
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
                        <button class="btn btn-danger  col-5 float-right" onclick="location.href='manage_users.php'">Cancel</button>
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
