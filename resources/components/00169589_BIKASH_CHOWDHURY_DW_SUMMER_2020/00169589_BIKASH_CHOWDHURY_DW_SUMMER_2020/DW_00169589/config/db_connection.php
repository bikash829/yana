<?php
define("DB",'DW_00169589');
function connection(){
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    return new mysqli($host,$user,$pass,DB);
}
?>