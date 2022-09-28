<?php
session_start();
include_once "../config/db_connection.php";


$validation_message = [];
$validation_message['status'] = true;


if (isset($_POST['btn-login'])) {

    $email = trim($_POST['email']);
    $pass = md5($_POST['pass']);

    $sql = "SELECT `users`.*,`users`.phone_code AS `phone_code_id`, `additional_info`.`working_info`,`additional_info`.`education` AS `education_info`, `additional_info`.`document_name` AS `education_proof`,`additional_info`.`document_location` AS `education_proof_location`, `country`.`name` AS `country_name`, `country`.`phonecode` AS `phone_code` FROM `users` 
    INNER JOIN `additional_info` ON `users`.`id` = `additional_info`.`user_id`
    INNER JOIN `country` ON `users`.`country_id` = `country`.`id`
    WHERE `users`.`email` = '$email';";

    if (db_connection()->query($sql)) {
        $query_status = db_connection()->query($sql);



        if ($query_status->num_rows > 0) {
            $data = $query_status->fetch_assoc();

            if ($data['pass'] == $pass) {

                $_SESSION['user'] = $data;

                // new session data 
                $_SESSION['user']['login_status'] = 1;
                $_SESSION['user']['full_name'] = $_SESSION['user']['f_name'] . ' ' . $_SESSION['user']['l_name'];


                switch ($_SESSION['user']['role_id']) {
                    case 1:
                        $_SESSION['user']['role'] = "admin";
                        break;
                    case 2:
                        $_SESSION['user']['role'] = "councilor";
                        break;
                    case 3:
                        $_SESSION['user']['role'] = "doctor";
                    case 4:
                        $_SESSION['user']['role'] = "patient";

                    default:
                        $_SESSION['user']['role'] = "others";
                }


                $validation_message['login_sucess'] = "You are logged in successfully";
                if (isset($_SERVER["HTTP_REFERER"])) {
                    header("Location: " . $_SERVER["HTTP_REFERER"]);
                }
            } else {
                $validation_message['status'] = false;
                $validation_message['wrong_pass'] = "Incorrect password please try again with valid password";
                
            }
        } else {

            $validation_message['status'] = false;
            $validation_message['not_found'] = "Invalid user id";
        }
    } else {
        $validation_message['status'] = false;
        $validation_message['error_db_connection'] = "Failed to connect to MySQL: " . $mysqli->connect_error;
    }
} elseif (isset($_POST['btn-admin-login'])) {

    $email = trim($_POST['email']);
    $pass = md5($_POST['pass']);
    $sql = "SELECT `email`,`pass`,`role_id` FROM `users` 
            WHERE 
            `email` = '$email';";


    if ($query_status = db_connection()->query($sql)) {
        if ($query_status->num_rows > 0) {

            $data = $query_status->fetch_assoc();
            if($pass == $data['pass']){
                $_SESSION['admin'] = $data;
                switch ($_SESSION['admin']['role_id']) {
                    case 1:
                        $_SESSION['admin']['role'] = "admin";
                        break;
                    case 2:
                        $_SESSION['admin']['role'] = "councilor";
                        break;
                    case 3:
                        $_SESSION['admin']['role'] = "doctor";
                    case 4:
                        $_SESSION['admin']['role'] = "patient";

                    default:
                        $_SESSION['admin']['role'] = "others";
                }
                header("Location: ../admin/dashboard.php");

            }else{
                $validation_message['status'] = false;
                $validation_message['wrong_pass'] = "Incorrect password please try again with valid password";
                
            }
        } else {
            $validation_message['invalid_error'] = "Invalid information";
            $validation_message['status'] = false;
        }
    } else {
        $validation_message['technical_error'] = "Technical error contact with technitian";
        $validation_message['status'] = false;
    }

    
} else {

    $validation_message['status'] = false;
    $validation_message['error_login_req'] = "The login request is not valid";
}


// validation chekup 
if ($validation_message['status']) {
    print_r($validation_message);
} else {

    print_r($validation_message);
}
