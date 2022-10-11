<?php
include "../config/db_connection.php";
$con = connection();
if (isset($_GET)){
    $f_id = $_GET['id'];
    $sql = "DELETE FROM user_ques WHERE id= $f_id";
    if ($con->query($sql)){
        $msg = "The content has been deleted successfully";
        header("Location:../users_questions.php");
    }else{
        echo "there is an error:".$con->error;
    }
}



?>