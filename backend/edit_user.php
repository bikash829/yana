<?php
session_start();
include "../functionalities/validation_function.php";
include "../functionalities/data_control.php";
include "../config/db_connection.php";


if (isset($_POST['btn-edit_user'])) {

    $validaiton = true;
    $validation_message = [];
    $user_id = $_SESSION['user']['id'];

    unset($_POST['btn-edit_user']);

    // empty data validation 
    if (empty_data_validation($_POST)) {
        //data validation 
        $validation_report = data_validation($_POST);
        if (isset($validation_report['status']) && $validation_report['status']) {
            $validation_report['id'] = $user_id;




            if ($updated_info = update_user($validation_report)) {

                $validation_message['success'] = "your information has been updated successfully.";

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
            } else {
                $validation_message['technical_error'] = "technical problem";
                $validation = false;
            }
        } else {
            echo "Data validation : *************";
            $validation = false;
            $validation_message = data_validation($_POST);
        }
    } else {
        $validation = false;
        $validation_message['empty_error'] = 'The required field can\'t be empty';
    }


    // checker 
    if ($validaiton) {
        print_r($validation_message);
    } else {
        print_r($validation_message);
    }
}

include "../functionalities/form-validation.php";