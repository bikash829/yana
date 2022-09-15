<?php
include "../config/db_connection.php";
$con = connection();

if (isset($_POST['pass_change'])){
    $uid = intval($_POST['uid']);
    $old_pass = md5($_POST['old_pass']);
    $new_pass = $_POST['new_pass'];
    $re_pass = $_POST['re_pass'];

//    echo "id: $uid old_pass : $old_pass new pass : $new_pass re pass : $re_pass ";
//    exit;
    $sql = "SELECT pass FROM users WHERE id = $uid";
    if ($con->query($sql)){
        $password = $con->query($sql)->fetch_assoc();
        if ($old_pass===$password['pass']){
            if ($new_pass===$re_pass){
                $pass = md5($new_pass);
                #Update new password
                $sql = "UPDATE users SET pass = '$pass' WHERE id = $uid";
                if ($con->query($sql)){
                    $msg = "Your password has been changed successfully";
                    header("Location:../profile_view.php?success=$msg");
                }else{
                    echo "erro: ".$con->error;
                }
            }else{
                $msg= "Sorry your new password didn't match please try again.";
                header("Location: " . $_SERVER["HTTP_REFERER"]."?error=$msg");
            }
        }else{
            $msg= "Incorrect password please try again by entering your old valid password";
            header("Location: " . $_SERVER["HTTP_REFERER"]."?error=$msg");
        }

    }else{
        echo "error sql operation:" .$con->error;
    }

}else{
    echo "Error404 Not found";
}

?>