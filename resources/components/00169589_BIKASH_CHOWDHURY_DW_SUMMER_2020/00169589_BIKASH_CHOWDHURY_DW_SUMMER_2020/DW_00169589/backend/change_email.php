<?php
session_start();
include "../config/db_connection.php";
$con = connection();
if (isset($_POST['email_change'])){
    $uid = intval($_POST['id']);
    $email = $_POST['new_email'];
    $pass = md5($_POST['pass']);

    $sql = "SELECT pass,email_add FROM users WHERE id = $uid";
    if ($con->query($sql)){
        $data_set = $con->query($sql)->fetch_assoc();
        if ($pass==$data_set['pass']){
            $sql = "SELECT email_add FROM users WHERE email_add = '$email'";
            if ($con->query($sql)){
                if ($con->query($sql)->num_rows<1){
                    $sql = "UPDATE users SET email_add = '$email' WHERE id = $uid";
                    if ($con->query($sql)){
                        $_SESSION['user_info']['email_add'] = $email;
                        $msg =  "Email has been changed successfully";
                        header("Location:../profile_view.php?success=$msg");
                        exit;
                    }else{
                        echo "sorry fetal error".$con->error;
                    }
                }else{
                    $msg= "Sorry the email has already been used please try with unique email address.";
                    header("Location:../profile_view.php?success=$msg");
                }
            }else{
                echo "fetal error".$con->error;
            }
        }else{

            header("Location:../profile_view.php?success=invalid password please try with valid password");
        }
    }else{
        echo "error".$con->error;
    }

}else{
    echo "";
}

?>