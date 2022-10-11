<?php
include "../config/db_connection.php";
$con = connection();
if (isset($_GET)){
    $f_id = $_GET['id'];
    $sql = "DELETE FROM user_faq WHERE id= $f_id";
    if ($con->query($sql)){
        $msg = "The content has been deleted successfully";
        header("Location:../edit_faq.php?success=$msg");
    }else{
        echo "there is an error:".$con->error;

    }
}



?>