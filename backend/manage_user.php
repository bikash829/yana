<?php
session_start();
include "../config/db_connection.php";


$validation = true;
$validation_message = [];



if (isset($_GET)) {

    if (isset($_GET['req'])) { //unblock and pending user
        $user_id = $_GET['user_id'];


        $sql = "UPDATE `users` SET `status` = 1 WHERE `users`.`id` = $user_id;";
        if (db_connection()->query($sql)) {
            $validation_message['accept_success'] = "The user request has been accepted successfully";
            $validation_message['status'] = true;
            if (isset($_GET['blocked'])) {
                $validation_message['accept_success'] = "The user is unblocked";
            }
            $_SESSION['manage_user'] = $validation_message;
            header("Location:" . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            $validation = false;
            $validation_message['technical_error'] = "Technical error contact with developer";
        }
    } elseif (isset($_GET['block'])) {  //block user 


        $user_id = $_GET['user_id'];

        $sql = "UPDATE `users` SET `status` = 2 WHERE `users`.`id` = $user_id;";
        if (db_connection()->query($sql)) {
            $validation_message['block_warning'] = "The user has been blocked";
            $validation_message['status'] = true;
            $_SESSION['manage_user'] = $validation_message;
            header("Location:" . $_SERVER['HTTP_REFERER']);
            exit();
        } else {
            $validation = false;
            $validation_message['technical_error'] = "Technical error contact with developer";
        }
    } elseif (isset($_GET['del_user'])) { //delete user 
        $user_id = $_GET['user_id'];

        $sql = "DELETE FROM `additional_info` WHERE `user_id` = $user_id;";
        if (db_connection()->query($sql)) {
            $sql = "DELETE FROM `users` WHERE `id` = $user_id;";
            if (db_connection()->query($sql)) {
                $validation_message['delete_warning'] = "The user record has been deleted successfully";
                $validation_message['status'] = true;
                $_SESSION['manage_user'] = $validation_message;
                header("Location:" . $_SERVER['HTTP_REFERER']);
                exit();
            }
        } else {
            $validation = false;
            $validation_message['technical_error'] = "Technical error contact with developer";
        }
    } else {
        $validation = false;
        $validation_message['invalid_req'] = "Invalid request";
    }
} else {
    $validation = false;
    $validation_message['bad_req'] = "you shouldn't be here pleas try again";
}

if (!$validation) {
    $validation_message['status'] = false;
    $_SESSION['manage_user'] = $validation_message;
    header("Location:" . $_SERVER['HTTP_REFERER']);
    exit();
}
