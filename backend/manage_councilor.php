<?php
session_start();
function user_status($user_id, $status)
{
    include_once "../config/db_connection.php";
    $sql  = "UPDATE users SET `status`=$status WHERE id = $user_id";

    if (db_connection()->query($sql)) {
        return true;
    } else {
        return false;
    }
}

if (isset($_GET['active'])) {

    $user_id = $_GET['uid'];
    $current_status = $_GET['current_status'];
    switch ($current_status) {
        case 3:
            $status = 1;
            break;
        case 1:
            $status = 3;
        default:
            # code...
            break;
    }

    $message = [];
    $status_report = user_status($user_id, $status);
    if ($status_report) {
        if ($status == 3) {
            $message['success'] = "Your account is deactive now";
            $_SESSION['councilor']['status'] = 3;
        } elseif ($status = 1) {
            $message['message'] = "Your account is active now";
            $_SESSION['councilor']['status'] = 1;
        }

        $message['status'] = true;
        $_SESSION['status_report'] = $message;
        header("Location: ../admin/councilor_dashboard.php");
        exit();
    } else {
        $message['status'] = false;
        $message['error'] = "Technical error";
        $_SESSION['status_report'] = $message;
        header("Location: ../admin/councilor_dashboard.php");
        exit();
    }
} else {
    header("Location: ../error.php");
}
