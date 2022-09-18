<?php
include "../config/db_connection.php";
include "../functionalities/validation_function.php";
include "../functionalities/essential_function.php";
include "../functionalities/data_control.php";



//++++++++++++++++++++++validation report flag
$validation = true;
$validation_message = [];

// =====================================empty registration session =================

if (isset($_POST['btn-doctor'])) { // Doctor validation
    // data filtering 

    if (empty_data_validation($_POST)) { //empty value guard

        //data validation 
        $validation_report = data_validation($_POST);
        if (isset($validation_report['status']) && $validation_report['status']) {
            $validation_report['role'] = 3;

            if (save_councilor($validation_report)) {
                $validation_message['success'] = "Doc Your account has been created successfully.";
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
        $validation_message['empty_checker'] = "You must give every required information";
        $validation  = false;
        exit();
    }


    // =======end doctor registration 
} elseif (isset($_POST['btn-councilor'])) { // councilor validation
   
    // optional data 
    $working_info  = $_POST['working_info'];
    unset($_POST['working_info']);

    // data filtering 
    if (empty_data_validation($_POST)) { //empty value guard
        // re-set optional data 
        $_POST['working_info'] = $working_info;

        //data validation 
        $validation_report = data_validation($_POST);
        if (isset($validation_report['status']) && $validation_report['status']) {
            $validation_report['role'] = 2;

            if (save_councilor($validation_report)) {
                $validation_message['success'] = "Your account has been created successfully.";
            } else {
                $validation_message['technical_error'] = "technical problem";
                $validation = false;
            }
        } else {

            $validation = false;
            $validation_message = data_validation($_POST);
        }
    } else {
        $validation_message['empty_checker'] = "You must give every required information";
        $validation  = false;
        exit();
    }
} elseif (isset($_POST['btn_patient'])) { // =======strat patient registration 

    // optional data 
    $contact_no = $_POST['number'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $zip_code = $_POST['zip_code'];


    unset($_POST['number']);
    unset($_POST['address']);
    unset($_POST['city']);
    unset($_POST['zip_code']);


    // data filtering 
    if (empty_data_validation($_POST)) { //empty value guard
        // re-set optional data 

        $_POST['number'] = $contact_no;
        $_POST['address'] = $address;
        $_POST['city'] = $city;
        $_POST['zip_code'] = $zip_code;

        //data validation 
        $validation_report = data_validation($_POST);
        if (isset($validation_report['status']) && $validation_report['status']) {
            $validation_report['role'] = 4;

            if (save_councilor($validation_report)) {
                $validation_message['success'] = "Your account has been created successfully.";
            } else {
                $validation_message['technical_error'] = "technical problem";
                $validation = false;
            }
        } else {
            $validation = false;
            $validation_message = data_validation($_POST);
        }
    } else {
        $validation_message['empty_checker'] = "You must give every required information";
        $validation  = false;
    }




    // ==================================end doctor registration 
} else {
    $validation = false;
    $validation_message['wrong_form'] = "The form request is invalid";
}

// =====================================empty registration session =================


// validation checkup 
if ($validation) {
    print_r($validation_message);
} else {
    print_r($validation_message);
}


