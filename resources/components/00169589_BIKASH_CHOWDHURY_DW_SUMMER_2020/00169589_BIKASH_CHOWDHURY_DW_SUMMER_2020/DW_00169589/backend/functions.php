<?php

#Function for first name and last name
function last_name($name){
    $name_arr = explode(' ', $name);
    $last_name = "";
    for ($i = 0;$i<count($name_arr);$i++){
        if ($i>=1){
            $last_name .= $name_arr[$i].' ';
        }
    }
    return ucwords(trim($last_name));
}
function first_name($name){
    $name_arr = explode(' ', $name);
    return ucwords(trim($name_arr[0]));
}






?>