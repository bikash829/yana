<?php
session_start();
$validation = true;
$validation_message = [];

include "../config/db_connection.php";

if (isset($_GET['user_ap'])) {
    $ap_id = $_GET['user_ap_id'];
    if ($_GET['user_ap'] == 1) { // accept request
        function appointment_accept($id)
        {
            $sql = "UPDATE user_appointment SET appointment_status = 1 WHERE id = $id";
            if (db_connection()->query($sql)) {
                return true;
            } else {
                return false;
            }
        }

        if (appointment_accept($ap_id)) {
            $validation_message['success'] = "Appointment request has been accepted";
        } else {
            $validation = false;
            $validation_message['technical_error'] = "There is some technical error please try again";
        }
    } elseif ($_GET['user_ap'] == 2) {//cancel request
        function appointment_cancel($id)
        {
            $sql = "UPDATE user_appointment SET appointment_status = 4 WHERE id = $id";
            if (db_connection()->query($sql)) {
                return true;
            } else {
                return false;
            }
        }

        if (appointment_cancel($ap_id)) {
            $validation_message['cancel_success'] = "Appointment request has been canceled";
        } else {
            $validation = false;
            $validation_message['technical_error'] = "There is some technical error please try again";
        }
    } else {
        $validation = false;
        $validation_message['bad_req'] = "Invalid request please try again.";
    }
} else { // else 
    $validation = false;
    $validation_message['bad_req'] = "Invalid request please try again";
}

// page redirection 
if ($validation) {
    $validation_message['status'] = true;
    $_SESSION['appointmnet_request'] = $validation_message;
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
} else {
    $validation_message['status'] = false;
    $_SESSION['appointmnet_request'] = $validation_message;
    header("Location: " . $_SERVER["HTTP_REFERER"]);
    exit();
}
