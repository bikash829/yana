<?php
session_start();
include "../functionalities/validation_function.php";
include "../functionalities/data_control.php";
include "../config/db_connection.php";


if (isset($_SESSION['user'])) {
    $user_id = $_SESSION['user']['id'];
} elseif (isset($_SESSION['doctor'])) {
    $user_id = $_SESSION['doctor']['id'];
} elseif (isset($_SESSION['councilor'])) {
    $user_id = $_SESSION['councilor']['id'];
}

// start block for edit doc 
if (isset($_POST['btn-edit_experts'])) {

    unset($_POST['btn-edit_experts']);
    $_POST['btn-edit_user'] = true;
}

// end block for edit doc 
$validation = true;
$validation_message = [];


if (isset($_POST['btn-edit_user'])) {  //edit user info
    unset($_POST['btn-edit_user']);


    $education = $_POST['education_info'];
    $work = $_POST['working_info'];

    unset($_POST['education_info']);
    unset($_POST['working_info']);

    // empty data validation 
    if (empty_data_validation($_POST)) {
        $_POST['education_info'] = $education;
        $_POST['working_info'] = $work;
        //data validation 
        $validation_report = data_validation($_POST);
        if (isset($validation_report['status']) && $validation_report['status']) {
            if ($user_id != "") {
                $validation_report['id'] = $user_id;
            }

            if ($updated_info = update_user($validation_report)) {

                $validation_message['success'] = "your information has been updated successfully.";


                if (isset($updated_info['role_id'])) { //special user update section 
                    if ($updated_info['role_id'] == 2) {
                        $_SESSION['councilor']['f_name'] = $updated_info['first_name'];
                        $_SESSION['councilor']['l_name'] = $updated_info['last_name'];
                        $_SESSION['councilor']['gender'] = $updated_info['gender'];
                        $_SESSION['councilor']['date_of_birth'] = $updated_info['date-of-birth'];
                        $_SESSION['councilor']['addr'] = $updated_info['address'];
                        $_SESSION['councilor']['city'] = $updated_info['city'];
                        $_SESSION['councilor']['zip_code'] = $updated_info['zip_code'];
                        $_SESSION['councilor']['phone_number'] = $updated_info['number'];
                        $_SESSION['councilor']['education_info'] = $updated_info['education_info'];
                        $_SESSION['councilor']['working_info'] = $updated_info['working_info'];

                        //report 
                        $_SESSION['edit_info'] = $validation_message;
                        $_SESSION['edit_info']['status'] = true;
                        header("Location: ../admin/my_profile.php");
                        exit();
                    } elseif ($updated_info['role_id'] == 3) {
                        $_SESSION['doctor']['f_name'] = $updated_info['first_name'];
                        $_SESSION['doctor']['l_name'] = $updated_info['last_name'];
                        $_SESSION['doctor']['gender'] = $updated_info['gender'];
                        $_SESSION['doctor']['date_of_birth'] = $updated_info['date-of-birth'];
                        $_SESSION['doctor']['addr'] = $updated_info['address'];
                        $_SESSION['doctor']['city'] = $updated_info['city'];
                        $_SESSION['doctor']['zip_code'] = $updated_info['zip_code'];
                        $_SESSION['doctor']['phone_number'] = $updated_info['number'];
                        $_SESSION['doctor']['education_info'] = $updated_info['education_info'];
                        $_SESSION['doctor']['working_info'] = $updated_info['working_info'];

                        //report 
                        print_r($validation_message);
                        $_SESSION['edit_info'] = $validation_message;
                        $_SESSION['edit_info']['status'] = true;
                        header("Location: ../admin/my_profile.php");
                        exit();
                    }
                }

                if (isset($_SESSION['user'])) {
                    $_SESSION['user']['f_name'] = $updated_info['first_name'];
                    $_SESSION['user']['l_name'] = $updated_info['last_name'];
                    $_SESSION['user']['gender'] = $updated_info['gender'];
                    $_SESSION['user']['date_of_birth'] = $updated_info['date-of-birth'];
                    $_SESSION['user']['country_id'] = $updated_info['country'];
                    $_SESSION['user']['phone_code'] = $updated_info['phone_code'];
                    $_SESSION['user']['phone_number'] = $updated_info['number'];
                    $_SESSION['user']['addr'] = $updated_info['address'];
                    $_SESSION['user']['city'] = $updated_info['city'];
                    $_SESSION['user']['zip_code'] = $updated_info['zip_code'];
                    $_SESSION['user']['phone_code_id'] = $updated_info['phone-code'];
                    $_SESSION['user']['working_info'] = $updated_info['working_info'];
                    $_SESSION['user']['education_info'] = $updated_info['education_info'];
                    $_SESSION['user']['country_name'] = $updated_info['country_name'];
                    $_SESSION['user']['full_name'] = $updated_info['full_name'];
                    header("Location: ../view_profile.php");
                }
            } else {


                $validation_message['technical_error'] = "technical problem";
                $validation = false;
            }
        } else {
            $validation_message = data_validation($_POST);
            $validation = false;
        }
    } else {
        $validation = false;
        $validation_message['empty_error'] = 'The required field can\'t be empty';
    }


    // checker 
    if ($validation) {
        $validation_message['status'] = true;
        $_SESSION['edit_info'] = $validation_message;
        header("Location: ../view_profile.php");
        exit();
    } else {

        $_SESSION['edit_info'] = $validation_message;
        $_SESSION['edit_info']['status'] = false;
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }
} elseif (isset($_POST['btn_change_pass'])) { //password changing 
    if ($_POST['password'] == $_POST['confirm_pass']) {
        $current_pass = md5($_POST['current_pass']);
        $pass = md5($_POST['password']);


        if ($_SESSION['user']['pass'] == $current_pass) {
            if ($current_pass != $pass) {
                $sql = "UPDATE `users` SET `pass` = '$pass' WHERE `id` = '$user_id'";

                if (db_connection()->query($sql)) {
                    $validation_message['success_pass'] = "Your passwrod has been changed successfully";
                    $_SESSION['user']['pass'] = $pass;
                } else {
                    $validation = false;
                    $validation_message['technical_error_change_pass'] = "Technical error";
                }
            } else {
                $validation = false;
                $validation_message['same_pass'] = "You are using same password please try with new password";
            }
        } else {
            $validation = false;
            $validation_message['wrong_pass'] = "Please insert your valid current password";
        }
    } else {
        $validation = false;
        $validation_message['unmatch_pass'] = "Password didn't match try again.";
    }


    // final result 
    if ($validation) {
        $validation_message['status'] = true;
        $_SESSION['edit_info'] = $validation_message;
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    } else {
        $validation_message['status'] = false;
        $_SESSION['edit_info'] = $validation_message;
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }
} elseif (isset($_POST['btn_change_email'])) {  //email change 


    $email = $_POST['email'];
    $pass = md5($_POST['password']);

    $sql = "SELECT * FROM `users` WHERE `email`='$email'";


    if ((db_connection()->query($sql))->num_rows < 1) {
        if ($_SESSION['user']['pass'] == $pass) {
            $sql = "UPDATE `users` SET `email` = '$email' WHERE `id` = $user_id";
            if (db_connection()->query($sql)) {
                $_SESSION['user']['email'] = $email;
                $validation_message = "Your email has been updated";
            } else {
                $validation = false;
                $validation_message['email_change_technical_error'] = "Technical error";
            }
        } else {
            $validation = false;
            $validation_message['wrong_pass'] = "Please insert your valid current password";
        }
    } else {
        $validation = false;
        $validation_message['duplicate_email'] = "you are using existed email id please use different email id";
    }


    // final result 
    if ($validation) {
        $validation_message['status'] = true;
        $_SESSION['edit_info'] = $validation_message;
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    } else {
        $validation_message['status'] = false;
        $_SESSION['edit_info'] = $validation_message;
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }
} elseif (isset($_POST['btn_change_doc'])) {
    echo "doesn't work";
} elseif (isset($_POST['btn_change_pp'])) { //change profile picture

    if (isset($_FILES['new_pp'])) {
        $profile_photo = $_FILES['new_pp'];

        // print_r($profile_photo);
        // exit();
        $pp_name = $profile_photo['name'];
        $pp_explotion = explode('.', $profile_photo['name']);
        $pp_type = strtolower(end($pp_explotion));
        $pp_error = $profile_photo['error'];
        $pp_size_kb = $profile_photo['size'] / 1024;
        $pp_temp_location = $profile_photo['tmp_name'];

        $allowed_pp_Ext = array('png', 'jpg', 'jpeg', 'gif');



        if (!($pp_size_kb < 1)) {
            if ($pp_error == 0) {
                if (in_array($pp_type, $allowed_pp_Ext)) {
                    // new directory and name 
                    $pp_dir = './uploads/';
                    $pp_new_name = $_SESSION['user']['f_name'] . "_pp" . time() . mt_rand() . ".$pp_type";

                    $new_location = '.' . $pp_dir . $pp_new_name;


                    // database query 
                    $sql = "UPDATE `users` SET `users`.`profile_location` = '$pp_dir', `users`.`profile_photo` = '$pp_new_name' WHERE `users`.`id` = $user_id";

                    if (db_connection()->query($sql)) {
                        move_uploaded_file($pp_temp_location, $new_location);
                        $validation_message['chaged_pp'] = "Your profile photo has been changed successfully";
                        $validation = true;
                        if (isset($_SESSION['user'])) {
                            $_SESSION['user']['profile_location'] = $pp_dir;
                            $_SESSION['user']['profile_photo'] = $pp_new_name;
                        } elseif (isset($_SESSION['doctor'])) {
                            $_SESSION['doctor']['profile_location'] = $pp_dir;
                            $_SESSION['doctor']['profile_photo'] = $pp_new_name;
                        } elseif (isset($_SESSION['councilor'])) {
                            $_SESSION['councilor']['profile_location'] = $pp_dir;
                            $_SESSION['councilor']['profile_photo'] = $pp_new_name;
                        }
                    } else {
                        $validation = false;
                        $validation_message['pp_technical_error'] = "Technical error";
                    }
                } else {
                    $validation = false;
                    $validation_message['pp_error'] =  "The profile picture type is not valid. Please Select an image file.";
                }
            } else {
                $validation = false;
                $validation_message['pp_error'] =  "There is an error by uploading your profile picture.";
            }
        }
    } else {
        $validation = false;
        $validation_message['empty_file'] = "There is no file has been selected yet";
    }


    // final result 
    if ($validation) {
        $validation_message['status'] = true;
        $_SESSION['edit_info'] = $validation_message;
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    } else {

        $validation_message['status'] = false;
        $_SESSION['edit_info'] = $validation_message;
        header("Location: " . $_SERVER["HTTP_REFERER"]);
        exit();
    }
} else {
    echo "hei there";
    header('Location: ../error.php');
}



// include "../functionalities/form-validation.php";
