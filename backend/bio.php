<?php
session_start();
$validation = true;
$validation_message = [];

include "../config/db_connection.php";


if(isset($_POST['btn-bio'])){
    $user_id = $_POST['uid'];
    $info_id = $_POST['info_id'];
    $bio = $_POST['bio'];



    $sql = "UPDATE `additional_info`  SET `bio` = '$bio' WHERE `id` = $info_id";
    
 
    if(db_connection()->query($sql)){
        if(isset($_SESSION['doctor'])){
            $_SESSION['doctor']['bio'] = $bio;

        }elseif(isset($_SESSION['councilor'])){
            $_SESSION['councilor']['bio'] = $bio;
        }

        $bio_update_success = "Your bio has updated successfully.";

    }else{
        $validation = false;
        $validation_message['error_bio_update'] = "Sorry there is some technical issue try again later";
    }


}else{
    $validation= false;
    $validation_message['invalid_request'] = "Invalid request please try again";
}


if($validation){
    header("Location: " . $_SERVER["HTTP_REFERER"] . "?bio_update_success=$bio_update_sucess&bio=$bio");
}else{
    print_r($validation_message);
}

?>