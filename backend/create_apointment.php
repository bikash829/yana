<?php 
session_start();
$validation = true;
$validation_message = [];

include "../config/db_connection.php";

if(isset($_POST['btn-create-apointment'])){

    $doctor_id = $_POST['user_id'];
    $ap_date  = $_POST['apointment-date'];
    $start_time = $_POST['ap-start-at'];
    $end_time = $_POST['ap-end-in'];
    $patient_capacity = $_POST['patient-capacity'];
    $fees = $_POST['ap-fee'];
    $description = $_POST['ap-description'];

    $sql = "INSERT INTO `appointment`(`doctor_id`,`start_time`,`end_time`,`ap_date`,`patient_capacity`,`fees`,`description`) 
            VALUES 
            ('$doctor_id','$start_time','$end_time','$ap_date','$patient_capacity','$fees','$description')";


    if(db_connection()->query($sql)){
        $validation_message['success'] = "Apointment Has been created successfully.";
        
    }else{
        $validation = false;
        $validation_message['error'] = "Technical error contact with developer";
    }

    
}else{
    $validation= false;
    $validation_message['bad_request']= "Invalid request please try again.";
}


// validation checker
if($validation){
    $_SESSION['appointment_create'] = $validation_message;
    $_SESSION['appointment_create']['status'] = true;
    header("Location: ../admin/appointment_history.php");

}else{
    header("Location: ../../error.php");
}
