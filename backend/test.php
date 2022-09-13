<?php

if (isset($_POST)) {
    $file = $_FILES['myFiles'];

    $current_name = $file['name'];
    $file_name_explotion =explode('.',$file['name']);
    $file_type = end($file_name_explotion);
    $file_error = $file['error'];
    $file_size_kb = $file['size']/1024;
    $temp_location = $file['tmp_name'];



    // new directory and name 
    $dir = '../uploads/';
    $file_new_name ="pp" . time().mt_rand() . ".$file_type" ;
    $my_directory = $dir . $file_new_name;
   
    if(move_uploaded_file($temp_location,$my_directory)){
        echo "file has been uploaded successfully";
    }
} else {
    echo "No file";
}
