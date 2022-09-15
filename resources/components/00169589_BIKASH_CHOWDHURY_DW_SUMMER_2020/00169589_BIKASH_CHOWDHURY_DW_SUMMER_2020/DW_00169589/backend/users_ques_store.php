<?php
include "../config/db_connection.php";
$con = connection();
if (isset($_POST['contact_us'])){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject= $_POST['subject'];
    $messgae = $_POST['message'];

    $sql = "INSERT INTO user_ques (name,e_mail,subject,messeage) VALUES ('$name','$email','$subject','$messgae')";
    if ($con->query($sql)){
        $msg = "Your message was sent, thank you! ";
        header("Location:../contact.php?success=$msg");
    }else{
        echo "there is an error:".$con->error;
    }
}else{
    echo "Error404 Not found.";
}



?>