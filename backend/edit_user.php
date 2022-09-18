<?php 
session_start();

include "./functionalities/form-validation.php";

if(isset($_POST['btn-edit_user'])){
    $user_id = $_SESSION['user']['id'];

}
?>