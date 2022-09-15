<?php
include "../config/db_connection.php";
$con = connection();

if (isset($_POST['post_sender'])){

    echo print_r($_POST)."<br>".print_r($_FILES);
    $header = $con->real_escape_string($_POST['header']);
    $post_article = $con->real_escape_string($_POST['blog_content']);



    $now = new DateTime();
    $date_now = $now->format('Y-m-d H:i:s A');

    #image validation
    /* -------------------------Image upload ------------------*/
    $picture = $_FILES['blog_file'];

    $file_name = $picture['name'];
    $file_type = $picture['type'];
    $tem_location = $picture['tmp_name'];
    $error = $picture['error'];
    $file_size = ($picture['size'] /1024)/1024;


    $nameExplode = explode('.',$file_name);
    $fileExt = strtolower(end($nameExplode));
    #-------------File validation ---------------------
    $allowedExt = array('png','jpg','jpeg','gif');
    if (in_array($fileExt,$allowedExt)){
        if ($error===0){
            if ($file_size < 5){
                $new_file_name = uniqid().time().'.'.$fileExt;
                $file_dir = '../images/blog_image/'.$new_file_name;
                #Deviding file name and extension
                $name_spilt = explode('.',$new_file_name);
                $avatarExt = strtolower(end($name_spilt));
                $avatar_name =explode('.',$new_file_name)[count(explode('.',$new_file_name))-2];

                $sql = "INSERT INTO `blog` 
                (`blog_head`, `blog_details`, `post_date`, `image_name`, `image_ext`) 
                VALUES 
                ('$header ', '$post_article', '$date_now', '$avatar_name', '$avatarExt');";
                if ($con->query($sql)){
                    move_uploaded_file($tem_location,$file_dir);
                    $msg = "Blog post has been uploaded successfully";
                    header("Location:../manage_blog.php?success=$msg");
                }else{
                    echo "There is an error: ".$con->error;
                }

            }else{
                $msg=  " Image must be in between 5mb long max.";
                header("Location:../profile_view.php?success=$msg");
            }
        }else{
            $msg= "There is an error by uploading the file please try again.";
            header("Location:../profile_view.php?success=$msg");
        }
    }else{
        $msg =  "The image format does not allow please try with png,jpg,jpeg or gif format images";
        header("Location:../profile_view.php?success=$msg");
    }
}



?>