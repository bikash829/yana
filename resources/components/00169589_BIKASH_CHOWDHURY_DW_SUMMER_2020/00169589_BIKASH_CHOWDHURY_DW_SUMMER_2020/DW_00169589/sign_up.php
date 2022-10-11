<?php
session_start();
$title = "Sign Up To Air Pollution";

$hover_nav = "sign_up";
include_once "layouts/head.php";
include_once "layouts/nav.php";

if (isset($_SESSION['user_info'])){?>
    <script>
        window.location.replace("index.php");
    </script>

<?php
    exit();
}
?>
<div class="container cus_su_con">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-8">
            <div class="card  cus_card">
                <div class="card-header">
                    <h2>Register</h2>
                </div>
                <!--card body start-->
                <div class="card-body px-4 ">
                    <!-- Form start -->
                    <form id="sign_up_form" action="backend/reg.php" method="POST" enctype="multipart/form-data">
                    <!--user name -->
                    <div class="form-group row">
                        <div class="custom_input col-12 col-sm-6 col-md-6 col-lg-6">
                            <label for="first_name" class="col-form-label">First Name</label>
                            <input type="text" id="first_name" name="first_name" required class="form-control" placeholder="Jhon">
                        </div>
                        <div class="custom_input col-12 col-sm-6 col-md-6 col-lg-6">
                            <label for="last_name" class="col-form-label">Last Name</label>
                            <input type="text" id="last_name" name="last_name" required class="form-control" placeholder="Doy">
                        </div>
                    </div>
                    <!--user name end-->
                    <!--email -->
                    <div class="form-group row">
                        <div class="custom_input col-12">
                            <label for="email_id" class="col-form-label">Email</label>
                            <input type="eamil" id="email_id" name="email" required class="form-control" placeholder="ex#jhondoy@gmail.com">
                        </div>
                    </div>
                    <!--email end-->
                    <!--password -->
                    <div class="form-group row" >
                        <div class="custom_input col-12 col-sm-6 col-md-6 col-lg-6">
                            <label for="password" class="col-form-label">Password</label>
                            <input type="password" id="password"  name="pass" required class="form-control">
                        </div>
                        <div class="custom_input col-12 col-sm-6 col-md-6 col-lg-6">
                            <label for="con_password" class="col-form-label">Confirm Password</label>
                            <input type="password" id="con_password" name="re_pass" required class="form-control">
                        </div>
                    </div>
                    <!--password end-->
                    <!--gender & Date of Birth-->
                    <div class="from-group row">
                        <div class="col-12 col-sm-6 col-md-6 col-lg-6 custom_input">
                            <label for="radio_id" class="col-form-label">Gender</label>
                            <div class="pt-1">
                                <div class="radio_">
                                    <div class="custom-control custom_input  custom-radio custom-control-inline">
                                        <input  type="radio" id="male_" required value="1" name="gender" class="custom-control-input">
                                        <label class="custom-control-label"  for="male_">Male</label>
                                    </div>
                                    <div class="custom-control custom_input custom-radio custom-control-inline">
                                        <input type="radio" id="female_" value="2" name="gender" class="custom-control-input">
                                        <label class="custom-control-label" for="female_">Female</label>
                                    </div>
                                    <div class="custom-control custom_input custom-radio custom-control-inline">
                                        <input type="radio" id="other_" value="3" name="gender" class="custom-control-input">
                                        <label class="custom-control-label" for="other_">Other</label>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="custom_input col-12 col-sm-6 col-md-6 col-lg-6">
                            <label for="date_of" class="col-form-label">Date Of Birth</label>
                            <input type="date" name="dob" required class="datepicker form-control">
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
                                <option value="" selected>Open this select menu</option>
                                <?php foreach ($data as $value){ ?>
                                <option value="<?=$value['id']?>"><?=$value['name']?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="custom_input col-12 col-sm-6 col-md-6 col-lg-6">
                            <label for="city_name" class="col-form-label">City</label>
                            <input type="text" name="city" required class="form-control" placeholder="EX# London">
                        </div>
                    </div>
                    <!--basic info end-->
                    <!--Phone and zip code -->
                    <div class="form-group row">
                        <div class="custom_input col-12 col-sm-6 col-md-6 col-lg-6">
                            <label for="zip_code_id" class="col-form-label">Zip Code</label>
                            <input type="text" name="zip_code" required class="form-control" placeholder="ex# 1200">
                        </div>
                        <div class="custom_input col-12 col-sm-6 col-md-6 col-lg-6">
                            <label for="phone_code" class="col-form-label">Phone Number </label>
                            <div class="">
                                <div class="custom_input">
                                    <input type="number" name="phone" required placeholder="1800XXXXXX" class="form-control">
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--hone and zip code  end-->
                    <!--file upload-->
                    <div class="form-group custom_input">
                        <label for="user_photo">Upload Your Photo</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="inputGroupFileAddon01">Upload</span>
                            </div>
                            <div class="custom-file">
                                <input type="file" name="pro_pic" required class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                <label class="custom-file-label" for="inputGroupFile01">Choose file</label>
                            </div>
                        </div>
                    </div>
                    <!--file upload end-->
                    <!--Checkbox -->
                    <div class="form-group">
                        <div class="custom-control custom_input custom-checkbox mb-3">
                            <input type="checkbox" name="read_and_accept" class="custom-control-input" id="customControlValidation1" required>
                            <label class="custom-control-label" for="customControlValidation1">Check this custom checkbox</label>
                            <div class="invalid-feedback">Example invalid feedback text</div>
                        </div>
                    </div>
                    <!--Checkbox end-->
                    </form>
                <!--Form end-->
                </div>
                <!--card body end-->
                <div class="card-footer px-4">
                    <div class="">
                        <div class="d-flex justify-content-center pb-3">
                            <a class="sign_text" data-toggle="modal" data-target="#login_modal" href="#">Already Have an account</a>
                        </div>
                        <button class="btn btn-block btn-primary" type="submit" form="sign_up_form">
                            <span>Sign Up</span>
                        </button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<?php
include_once "layouts/footer.php";
?>
