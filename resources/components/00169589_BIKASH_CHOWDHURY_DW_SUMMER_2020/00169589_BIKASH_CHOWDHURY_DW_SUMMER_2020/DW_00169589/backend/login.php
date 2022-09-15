<?php
session_start();
include "../config/db_connection.php";
$con = connection();

if (isset($_POST['login'])){
    $e_mail = strtolower($_POST['email']);
    $pass = md5($_POST['pass']);

    $sql = "SELECT * FROM users WHERE email_add = '$e_mail';";
    $data_set = $con->query($sql);
    if ($data_set->num_rows == 1){
        $user = $data_set->fetch_assoc();
        #-------------Password checking------------------
        if ($user['pass']===$pass){
            $user_id = $user['id'];
            $sql = "SELECT users.*,adrees_info.id AS add_id, adrees_info.zip_code, adrees_info.city,adrees_info.country_id,country.name AS country_name,country.phonecode
                    FROM users
                    left join user_address on user_address.user_id_fk = users.id
                    left join adrees_info on adrees_info.id = user_address.address_id_fk
                    left join country on country.id = adrees_info.country_id
                    where users.id = $user_id;";

            #-----------------User data----------------------
            $user_info = $con->query($sql);
            $_SESSION['user_info'] = $user_info->fetch_assoc();
            $msg= "Login Successfully";
            //header("Location:../index.php?error_pass=$login_success");
            header('Location: ' . $_SERVER['HTTP_REFERER'].'?login_success='.$msg);
        }else{

            //Login attempt
            $_SESSION['attempt']++;
            $left_attempt = 3 - $_SESSION['attempt'];
            $msg ="Incorrect Login password you have remain $left_attempt attempt left to login your account.";
            if ($_SESSION['attempt']>2){
                $_SESSION['locked'] = time();
                $msg ="Too many wrong attempt, you are temporary blocked for 10 minutes.";

            }
            header("Location: " . $_SERVER["HTTP_REFERER"]."?error=$msg");
        }
    }else{
        $msg= "Incorrect email, Please try with valid email or sign up now";
        header("Location: " . $_SERVER["HTTP_REFERER"]."?error=$msg");
    }
}
else{
    echo "";
}


?>