<?php
include "../functionalities/validation_function.php";
include "../functionalities/data_control.php";
include "../config/db_connection.php";

$validation = true;
$validation_message = [];

if(isset($_POST['btn-contact'])){
    if(empty_data_validation($_POST)){

        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $email_id = $_POST['contact_email'];
        $comment = $_POST['comment'];

        if(alphabetic_velue($first_name,'first name') == 1 ){
            true;
        }else{
            $validation = false;
            $validation_message['name_error'] = alphabetic_velue($first_name,'first name');
        }

        if($error = alphabetic_velue($last_name,'last name') == 1 ){
            true;
        }else{
            $validation = false;
            $validation_message['name_error'] = $error;
        }

        if($validation){
            $sql = "INSERT INTO `contact_us`(`f_name`,`l_name`,`comment`,`email`) VALUES 
                    ('$first_name', '$last_name', '$comment' ,'$email_id');";

            
            if(db_connection()->query($sql)){
                $validation_message['contact_success'] = "Your message has been sent successfully";
            }else{
                $validation = false;
                $validation_message['technical_error'] = "Technical error please try with valid information";
            }


        }


    }else{
        $validation = false;
        $validation_message['empty_contact_us'] = "The required field shouldn't be empty";
    }


    //final checker 
    if($validation){
        print_r($validation_message);
    }else{
        print_r($validation_message);
    }

}else{
    $validation_message = "Bad request please try again";
    header("Location: ../error.php");
}
