<?php
session_start();
include_once "../config/db_connection.php";


$validation_message = [];
$validation_message['stats'] = true;


$POST = array(
    'email' => 'mayesha@gmail.com',
    'password' => "3028879ab8d5c87dc023049fa5bb5c1a",
);

$email = "chowdhurybikash73@yahoo.com";
$password = "3028879ab8d5c87dc023049fa5bb5c1a";

if (isset($_POST['btn-login'])) {
    
    $email = $_POST['email'];
    $pass= md5($_POST['pass']);

    $sql = "SELECT * FROM users WHERE `email` = '$email'";
    $query_status = db_connection()->query($sql);
    if ($query_status->num_rows > 0) {
        $data = $query_status->fetch_assoc();
        if($data['pass'] == $pass){
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
          
        }else{
            $validation_message['stats'] = false;
            $validation_message['wrong_pass'] = "Incorrect password please try again with valid password";
        }
    }

} else {
    $validation_message['stats'] = false;
    $validation_message['error_login_req'] = "The login request is not valid";
}


// validation chekup 
if ($validation_message['stats']) {
    print_r($validation_message);
} else {

    print_r($validation_message);
}
