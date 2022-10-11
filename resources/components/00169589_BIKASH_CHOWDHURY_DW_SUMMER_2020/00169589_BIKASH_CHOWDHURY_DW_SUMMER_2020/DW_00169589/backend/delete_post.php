<?php
include "../config/db_connection.php";
$con = connection();

if ($_GET['pid']){
    $id = $_GET['pid'];
    $sql = "DELETE FROM blog WHERE id = $id";
    if ($con->query($sql)){
        header("Location:../manage_blog.php?success=Your post is deleted successfully.");
    }else{
        echo "There is an error:".$con->error;
    }
}


?>