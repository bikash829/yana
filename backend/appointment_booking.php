<?php
$validaiton = true;
$validation_message = [];

include "../config/db_connection.php";

if (isset($_GET['appointment_id']) && isset($_GET['uid'])) {
    if (empty($_GET['uid'])) {
        
        $validaiton= false;
        $validation_message['user_id_empty'] = "you must logged in before making any appointment";
    } else {
        $appointment_id = $_GET['appointment_id'];
        $user_id = $_GET['uid'];


        $sql = "INSERT INTO `user_appointment`(`patient_id`,`appointment_id`,`appointment_status`)
            VALUES ($user_id,$appointment_id,2);";



        if (db_connection()->query($sql)) {
            $validaiton_message['success'] = "Your request has been sent successfully please payment if you didn't pay for the appointment yet to confirm your appoinment";
        } else {
            $validation = false;
            $validation_message['technical_error'] = "There is some technical issues please contact with our staff";
        }
    }
} else {
    $validation = false;
    $validation_message['bad_request'] = "Bad request try again";
}



//request finalization 
if ($validaiton) {
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
} else {
    print_r($validation_message);
    exit();
}
