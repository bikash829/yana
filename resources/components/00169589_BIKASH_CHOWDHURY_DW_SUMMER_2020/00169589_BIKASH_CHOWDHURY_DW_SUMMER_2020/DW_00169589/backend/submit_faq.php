<?php
include "../config/db_connection.php";
$con = connection();

if(isset($_POST['crate_fq'])){
    $header = $_POST['header'];
    $message = $_POST['message'];

    $sql = "INSERT INTO user_faq (header,subject) VALUES ('$header','$message')";
    if ($con->query($sql)){
        $msg = "Successfully uploaded";
        header("Location:../create_faq.php?success=$msg");
    }else{
        echo "there is an error".$con->error;
    }

}



?>