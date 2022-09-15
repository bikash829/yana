<?php
session_start();
include "../config/db_connection.php";
$con = connection();

if (isset($_POST['pp'])){
    echo print_r($_FILES);
    /* -------------------------Image upload ------------------*/
    $picture = $_FILES['profile_change'];
    $error_count  = 0;
    $file_name = $picture['name'];
    $file_type = $picture['type'];
    $tem_location = $picture['tmp_name'];
    $error = $picture['error'];
    $file_size = ($picture['size'] /1024)/1024;
//    echo "$file_name | $file_type | $tem_location | $error | $file_size";
//    exit;
    $nameExplode = explode('.',$file_name);
    $fileExt = strtolower(end($nameExplode));
    #-------------File validation ---------------------
    $allowedExt = array('png','jpg','jpeg','gif');
    if (in_array($fileExt,$allowedExt)){
        if ($error===0){
            if ($file_size < 5){
                $new_file_name = uniqid().time().'.'.$fileExt;
                #generated new file name
                $file_dir = '../images/uploads/'.$new_file_name;

                #Deviding file name and extension
                $name_spilt = explode('.',$new_file_name);
                $avatarExt = strtolower(end($name_spilt));
                $avatar_name =explode('.',$new_file_name)[count(explode('.',$new_file_name))-2];


                # old image
                $old_img_name = $_SESSION['user_info']['user_avater'];
                $old_img_ext = $_SESSION['user_info']['user_avater_format'];
                $user_id = $_SESSION['user_info']['id'];


                $sql = "UPDATE users SET user_avater = '$avatar_name', user_avater_format='$avatarExt' WHERE id = $user_id";
                if($con->query($sql) === TRUE){
                    unlink('../images/uploads/'.$old_img_name.'.'.$old_img_ext);
                    move_uploaded_file($tem_location,$file_dir);

                    $msg =  "Your profile picture has been change successfully";
                    #update session data
                    $_SESSION['user_info']['user_avater'] = $avatar_name;
                    $_SESSION['user_info']['user_avater_format'] = $avatarExt;

                    #Redirect page
                    header("Location: ../profile_view.php?success=$msg");
                }


            }else{
                $msg=  "Image file size must be in between 5mb max..";
                header("Location:../profile_view.php?success=$msg");
            }
        }else{
            $msg= "There is an error by uploading the file please try again.";
            header("Location:../profile_view.php?success=$msg");
        }
    }else{
        $msg= "The file type should be jpg,jpeg,png or gif format only";
        header("Location:../profile_view.php?success=$msg");
    }

}else{
    echo "Error404";
}



?>