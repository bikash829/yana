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
                switch ($data['role_id']) {
                    case 1:
                        $data['role'] = "admin";
                        break;
                    case 2:
                        $data['role'] = "councilor";
                        break;
                    case 3:
                        $data['role'] = "doctor";
                        break;
                    case 4:
                        $data['role'] = "patient";
                        break;

                    default:
                        $data['role'] = "others";
                        break;
                }

                if ($data['role_id'] == 4) {  // patient user
                    $_SESSION['user'] = $data;

                    // new session data 
                    $_SESSION['user']['login_status'] = 1;
                    $_SESSION['user']['full_name'] = $_SESSION['user']['f_name'] . ' ' . $_SESSION['user']['l_name'];
                    $validation_message['login_sucess'] = "You are logged in successfully";
                    if (isset($_SERVER["HTTP_REFERER"])) {
                        header("Location: " . $_SERVER["HTTP_REFERER"]);
                    }
                } else {
                    $validation_message['status'] = false;
                    $validation_message['wrong_pass'] = "Incorrect id or password please try again with valid password";
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
} elseif (isset($_POST['btn-admin-login'])) { // Admin login checker

    $email = trim($_POST['email']);
    $pass = md5($_POST['pass']);
    $sql = "SELECT * FROM `users`
            WHERE `email` = '$email';";


    if ($query_status = db_connection()->query($sql)) {
        if ($query_status->num_rows > 0) {

            $data = $query_status->fetch_assoc();
            if ($pass == $data['pass']) {


                // additional information 
                if (!($data['role_id'] == 1)) {
                    $user_id = $data['id'];

                    $sql = "SELECT `users`.* ,`country`.`name` AS `country_name`, `country`.`phonecode` AS `phone_code`, `additional_info`.`bio`, `additional_info`.`education` AS 'education_info', `additional_info`.`working_info`
                            FROM `users`
                            INNER JOIN `country` ON `users`.`country_id` = `country`.`id`
                            INNER JOIN `additional_info` ON `additional_info`.`user_id` = `users`.`id`
                            WHERE `users`.`id` = $user_id;
                            ";

                    if ($user_info = db_connection()->query($sql)) {
                        $data = $user_info->fetch_assoc();
                    }


                    $sql = "SELECT  `social_medium`.`id` AS `medium_id`, `social_medium`.`medium`,`social_user_link`.`link` AS `social_link` 
                            FROM `users`
                            INNER JOIN `social_user_link` ON `social_user_link`.`user_id` = `users`.`id`
                            INNER JOIN  `social_medium` ON `social_medium`.`id`  = `social_user_link`.`medium_id`
                            WHERE `users`.`id` = $user_id;";

                    if ($social_info_set = db_connection()->query($sql)) {
                        $social_info = $social_info_set->fetch_all(MYSQLI_ASSOC);
                        $data['social_info'] = $social_info;
                    }
                }

                // role defining 
                switch ($data['role_id']) {
                    case 1:
                        $data['role'] = "admin";
                        break;
                    case 2:
                        $data['role'] = "councilor";
                        break;
                    case 3:
                        $data['role'] = "doctor";
                        break;
                    case 4:
                        $data['role'] = "patient";
                        break;

                    default:
                        $data['role'] = "others";
                        break;
                }



                //filtering data
                if ($data['role_id'] == 1) { //admin login
                    //data main
                    $_SESSION['admin'] = $data;

                    header("Location: ../admin/dashboard.php");
                } elseif ($data['role_id'] == 2) { //councilor login
                    $_SESSION['councilor'] = $data;
                    header("Location: ../admin/experts_dashboard.php");
                } elseif ($data['role_id'] == 3) { //doctor login
                    $_SESSION['doctor'] = $data;

                    header("Location: ../admin/experts_dashboard.php");
                } else {
                    $validation_message['status'] = false;
                    $validation_message['wrong_pass'] = "Invalid user";
                }
            } else {
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
