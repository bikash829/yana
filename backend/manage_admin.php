<?php
$validation = true;
$validation_message = array();

include "../config/db_connection.php";



// password verification function 
function password_verification($data)
{
    $user_id = $data['user_id'];
    $current_pass = md5($data['current_pass']);
    $new_pass = $data['password'];
    $confirmed_pass = $data['confirm_pass'];




    if ($new_pass == $confirmed_pass) {
        $con = db_connection();
        $hassed_pass = md5($new_pass);
        $sql = "SELECT * FROM `users` WHERE `id` = $user_id AND `pass` = '$current_pass'";


        if ($con->query($sql)) {

            $verifying = $con->query($sql);
            if (($verifying->num_rows) > 0) {
                $sql = "UPDATE users SET `pass` = '$hassed_pass'";
                if ($con->query($sql)) {
                    return array('status' => true, 'success' => "Your password has been updated successfully");
                } else {
                    return array('status' => false, 'error' => "Technical error");
                }
            } else {
                return  array('status' => false, 'error' => "Wrong password please enter your old password correctly.");
            }
        } else {
            return array('status' => false, 'error' => "Technical error try again");
        }
    } else {
        return array('status' => false, 'error' => "Please confirm your password correctly");
    }
}


//email change function 
function email_change($data)
{
    $con = db_connection();
    $user_id = $data['user_id'];
    $pass = md5($data['password']);
    $email = $_POST['email'];


    $sql = "SELECT * FROM `users` WHERE `email` = '$email'";


    if ($checked_email = $con->query($sql)) {
        if (($checked_email->num_rows) > 0) {
            return array('status' => false, 'error' => "The email is existed please try different email");
        } else {

            $sql = "SELECT pass FROM users WHERE id = $user_id";
            $user_pass = ($con->query($sql))->fetch_assoc();
        
            if ($user_pass['pass'] == $pass) {
                $sql = "UPDATE users SET `email` = '$email' WHERE id = $user_id;";
                if($con->query($sql)){
                    return array('status' => true, 'sucess' => "Your email has been chnaged successfully.");
                }else{
                    return array('status' => false, 'error' => "Technical error");
                }
            } else {
                return array('status' => false, 'error' => "Your password is wrong, use valid password");
            }
        }
    } else {
        return array('status' => false, 'error' => "Technical error try again");
    }
}



//Data passing
if (isset($_POST['btn_change_pass'])) {
    if (password_verification($_POST)['status']) {
        echo password_verification($_POST)['success'];
    } else {
        echo password_verification($_POST)['error'];
    }
} elseif (isset($_POST['btn_change_email'])) {
    $email_report = email_change($_POST);
    if ($email_report['status']) {
        echo $email_report['success'];
    } else {
        echo $email_report['error'];
    }
} else {
    $validation = false;
    $validation_message['bad_request'] = "Invalid request please try again.";
    print_r($validation_message);
}




// checker 
