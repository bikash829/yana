<?php
include "../config/db_connection.php";
$con = connection();
if (isset($_GET['uid'])){
    $id = $_GET['uid'];
    $sql = "DELETE FROM user_address WHERE user_id_fk=$id";
    $con->query($sql);
    $sql = "DELETE FROM users WHERE id=$id";
    if ($con->query($sql)){
        header("Location:../manage_users.php?success=The user data row has been deleted successfully.");
    }else{
        echo "sorry cant delete".$con->error;
    }
}


?>