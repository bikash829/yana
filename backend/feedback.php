<?php

use Illuminate\Support\Arr;

session_start();

include_once "../config/db_connection.php";
function feedback($sql){
    if(db_connection()->query($sql)){
        return true;
    }else{
        return false;
    }
    
}



if(isset($_POST['btn-feedback'])){
    $rating = $_POST['ratings'];
    $feedback = $_POST['feedback'];
    $user_id = $_POST['user_id'];
    $councilor_id = $_POST['councilor_id'];

    $result = feedback("INSERT INTO feedback (`rating_count`,`feedback`,`patient_id`,`ser_provider_id`) VALUES ($rating,'$feedback',$user_id,$councilor_id);");

    if($result){
        $validation_message = array('status'=>true,'message'=>"Your feedback has been sent successfully");
        $_SESSION['user_feedback'] = $validation_message;
        header("Location: ../doctor_appointment.php");
        exit();
    }else{
        $validation_message = array('status'=>false,'message'=>"Feedback sent faild");
        $_SESSION['user_feedback'] = $validation_message;
        header("Location: ../doctor_appointment.php");
        exit();
    }

}else{
    header("Location: ../error.php");
}











?>