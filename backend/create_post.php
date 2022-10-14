<?php 
session_start();
include "../config/db_connection.php";



$validation = true;
$validation_message = [];


if(isset($_POST['post_article'])){ //post 
   

    $user_id  = $_POST['user_id'];
    $post_title = $_POST['post_title'];
    $post_description  = $_POST['post_details'];
    $post_date = date("Y-m-d");



    $sql = "INSERT INTO `forum`(`user_id`,`post_title`,`post_description`,`post_date`) 
            VALUES 
            ($user_id,'$post_title','$post_description','$post_date');";
            

    if(db_connection()->query($sql)){
        $validation_message['create_post_success'] = "Your article has been posted successfully";
        $validation_message['status'] = true;
        $_SESSION['post_alert'] = $validation_message;
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    } else{
        $validation= false;
        $validation_message['error'] = "Technical error";
    }

   
    $validation_message['status'] = false;
    $_SESSION['post_alert'] =  $validation_message;
    header("Location: " . $_SERVER['HTTP_REFERER']);
    exit();
    
}elseif(isset($_POST['btn-comment'])){ //comment

    

    $user_id = $_POST['user_id'];
    $post_id = $_POST['post_id'];
    $comment = $_POST['comment'];
    $date = date('Y-m-d');
   

    $sql = "INSERT INTO `comments`(`user_id`,`forum_id`,`comment`,`comment_date`) VALUES ('$user_id','$post_id','$comment','$date');";


    if($comment = db_connection()->query($sql)){
        $validation_message['comment_succes'] = "Comment posted";
        $validation_message['status'] = true;
        $_SESSION['comment_alert'] = $validation_message;
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();

    }else{
        $validation = false;
        $validation_message['error'] = "Technical error";
    }



}else{
    $validation = false;
    $validation_message['error'] = "You are not supose to be here";
 }
 $validation_message['status'] = false;
 $_SESSION['comment_alert'] = $validation_message;
 header("Location: " . $_SERVER['HTTP_REFERER']);
 exit();
?>