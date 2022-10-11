<?php
session_start();
if(isset($_GET['log_out'])){
    session_unset();
    header("Location:../index.php?success=You are logged out successfully.");
}
else{
    echo "Error404";
}
?>