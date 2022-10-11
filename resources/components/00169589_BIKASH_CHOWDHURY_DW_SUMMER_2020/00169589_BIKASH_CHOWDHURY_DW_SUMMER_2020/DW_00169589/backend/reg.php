
<?php
session_start();
    include "../config/db_connection.php";
    $con = connection();
# -----------Form validation -------------------------------
if (isset($_POST)){
    $error_count = 0;
    /* Form Post */
    #-----------checking alphabetical error-----------------------------
    if(ctype_alpha(trim($_POST['first_name'])) && ctype_alpha(trim($_POST['last_name']))){
        $name =strtolower(trim($_POST['first_name'])." ". trim($_POST['last_name']));
    }else{
        $error =  "Please type your name with alphabetical later";
        $error_count++;
        $errors['name']="$error";
    }

    #------------------check duplicate email-----------------------
    $temp_email = $_POST['email'];
    $sql = "SELECT email_add FROM users WHERE email_add = '$temp_email'";
    $emails = $con->query($sql);
    if ($emails->num_rows>0){
        $error= "The email has already used. Try with another new email";
        $error_count++;
        $errors['email']="$error";
    }else{
        $email = $_POST['email'];
    }

    #----------------Password validation -------------------
    if ($_POST['pass'] === $_POST['re_pass']){
        $pass = md5($_POST['pass']);
    }else{
        $error= ("Invalid input, password does not mach ");
        $error_count++;
        $errors['password']="$error";
    }

    $gender = $_POST['gender'];
    # ---------------------------date validation ------------------------
    /*
    $current_year= date('Y');
    $usr_year = date('Y', strtotime($_POST['dob']));
    */
    $birthdate = new DateTime($_POST['dob']);
    $today     = new DateTime();
    $interval  = $today->diff($birthdate);
    if ($interval->days < 5840){
        $error= "Sorry! you are under 16 years old be mature first";
        $error_count++;
        $errors['date']="$error";
    }else{
        $age = $interval->days;
        if ($interval->days >54750 ){
            $error = "Your age is logically invalid please enter valid data";
            $errors['date']="$error";
            $error_count++;
        }else{
            $dob = $_POST['dob'];
        }
    }

    $country = $_POST['country'];
    #-----------checking alphabetical error---------------------
    if (ctype_alpha($_POST['city'])){
        $city = strtolower($_POST['city']);
    }else{
        $error = "Enter valid city name";
        $error_count++;
        $errors['email']="$error";
    }

    $zip_code = strtoupper($_POST['zip_code']);
    $phone = $_POST['phone'];
    $role = 2;

    /* -------------------------Image upload ------------------*/
    $picture = $_FILES['pro_pic'];

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
                $file_dir = '../images/uploads/'.$new_file_name;
                #Deviding file name and extension
                $name_spilt = explode('.',$new_file_name);
                $avatarExt = strtolower(end($name_spilt));
                $avatar_name =explode('.',$new_file_name)[count(explode('.',$new_file_name))-2];

            }else{
                echo " Sorry the file size out of image is so big ";
                $errors['image']="$error";
                $error_count++;
            }
        }else{
            $error= "There is an error by uploading the file please try again.";
            $error_count++;
            $errors['image']="$error";
        }
    }else{
        $error = "The file type doest allow try with image";
        $error_count++;
        $errors['image']="$error";
    }

    # checking errors
    if ($error_count > 0){
        header("Location:../sign_up.php?error_reg=" . urlencode(serialize($errors)));

    }else{
        #---------------database query--------------------

        #-----------------------query for input user data------------------------------
        $sql_users ="INSERT INTO `users`
                (`name`, `email_add`, `pass`, `gender`, `dob`,`phone`, `role`, `user_avater`, `user_avater_format`)
                VALUES
                ('$name', '$email', '$pass', '$gender', '$dob','$phone', '$role', '$avatar_name', '$avatarExt')";

        # ----------------------query for address info data----------------------------
        $sql_add_info = "INSERT INTO `adrees_info` (`zip_code`, `city`, `country_id`) VALUES ('$zip_code', '$city', '$country');";

        /*------------Function for user id and address id------------------*/
        function retrieve_id($mail,$zip_cd,$city,$country_id,$connection){
            $sql_user = "SELECT users.id AS user_id FROM users WHERE users.email_add = '$mail';";
            #------------------------retrieve user id--------------------
            if ($connection->query($sql_user)){
                $data = $connection->query($sql_user)->fetch_assoc();
                $data = $data['user_id'];
            }else{
                $msg =  "Sorry  user id does not retrieve..";
            }

            #-----------------Sql for particular address id----------------------
            $sql_add = "SELECT adrees_info.id AS add_id FROM adrees_info WHERE adrees_info.zip_code = '$zip_cd' AND adrees_info.city = '$city' AND adrees_info.country_id = $country_id;";
            if ($connection->query($sql_add)){
                $data2 = $connection->query($sql_add)->fetch_assoc();
                $data2 = $data2['add_id'];
            }else{
                $msg2 =  "It doesn't work";
            }

            return array("user_id"=> "$data", "add_id"=>"$data2");
        }
        #end function


        # checking duplicate address to skip value storing
        $sql_check = "SELECT * FROM adrees_info WHERE adrees_info.zip_code = '$zip_code' AND adrees_info.city = '$city' AND adrees_info.country_id = $country";
        $check = $con->query($sql_check);
        if ($check->num_rows==0){
            $con->query($sql_add_info);
        }

        #-----------------Sql for users data storing -----------------
        if($con->query($sql_users)){
            #-----------------file uploading------------------
            move_uploaded_file($tem_location,$file_dir);

            /*---------Sql for user address table for create relation with users to address-------------------*/
            $fk_ids =  retrieve_id($email,$zip_code,$city,$country,connection());
            $user_id = $fk_ids['user_id'];
            $add_id = $fk_ids['add_id'];
            $sql_user_add = "INSERT INTO `user_address` (`user_id_fk`, `address_id_fk`) VALUES ('$user_id', '$add_id');";
            if ($con->query($sql_user_add)){
                #login automicaly
                $sql = "SELECT users.*,adrees_info.id AS add_id, adrees_info.zip_code, adrees_info.city,adrees_info.country_id,country.name AS country_name,country.phonecode
                FROM users
                left join user_address on user_address.user_id_fk = users.id
                 left join adrees_info on adrees_info.id = user_address.address_id_fk
                left join country on country.id = adrees_info.country_id
                where users.id = $user_id;";
                #-----------------User data----------------------
                $user_info = $con->query($sql);
                $_SESSION['user_info'] = $user_info->fetch_assoc();
                #end login
                $reg_success =  "Registration successfully done...";
                header("Location: ../index.php?success=$reg_success");
            }else{
                echo "Technical error check code...";
            }
        }else{
            echo "It't code error";
        }
    }

} else{
    echo "Input error get out from here...";
}

?>