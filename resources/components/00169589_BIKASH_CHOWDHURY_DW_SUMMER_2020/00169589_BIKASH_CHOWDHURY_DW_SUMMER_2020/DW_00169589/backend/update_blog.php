<?php
include "../config/db_connection.php";
$con = connection();

if (isset($_POST['edit_blog'])){
    $errors = array();

    $blog_id = $_POST['blog_id'];
    $heading = $_POST['header'];
    $description = trim($_POST['blog_content']);

    //blog image
    /* -------------------------Image upload ------------------*/
    $picture = $_FILES['blog_file'];

    $file_name = $picture['name'];
    $file_type = $picture['type'];
    $tem_location = $picture['tmp_name'];
    $error = $picture['error'];
    $file_size = ($picture['size'] /1024)/1024;

    $sql_file_name  = "";
    $sql_file_ext = "";

    if ($file_size>0){

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

                    $sql_file_name  = ",image_name='$avatar_name'";
                    $sql_file_ext = ",image_ext='$avatarExt'";
                    move_uploaded_file($tem_location,$file_dir);

                }else{
                    $msg = " Image must be in between 5mb long max.";
                    header("Location: " . $_SERVER["HTTP_REFERER"]."?error=$msg");

                }
            }else{
                $msg= "There is an error by uploading the file please try again.";
                header("Location: " . $_SERVER["HTTP_REFERER"]."?error=$msg");

            }
        }else{
            $msg= "The image format does not allow please try with png,jpg,jpeg or gif format images";
            header("Location: " . $_SERVER["HTTP_REFERER"]."?error=$msg");

        }


    }
    $sql = "UPDATE blog SET blog_head='$heading', blog_details='$description' $sql_file_name $sql_file_ext WHERE id=$blog_id;";
    if ($con->query($sql)){
        header("Location:../manage_blog.php?success=Blog Post is updated successfully");
    }else{
        echo "Sorry there is an error:".$con->error;
    }

}

?>