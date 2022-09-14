<?php
include "../config/db_connection.php";
include "./validation_function.php";
include "./essential_function.php";



//++++++++++++++++++++++validation report flag
$validation = true;
$validation_message = [];



// =====================================empty registration session =================

if (isset($test['btn-doctor'])) { // Doctor validation
    echo "Hello  doctor";
    print_r($_POST);
} elseif (isset($_POST['btn-councilor'])) { // councilor validation

    // optional data 
    $working_info  = $_POST['working_info'];
    unset($_POST['working_info']);

    // data filtering 
    if (empty_data_validation($_POST)) { //empty value guard
        // re-set optional data 
        $_POST['working_info'] = $working_info;

        //data validation 
        $validation_report = data_validation($_POST);
        if (isset($validation_report['status']) && $validation_report['status']) {

            if (save_councilor($validation_report)) {
                $validation_message['success'] = "Your account has been created successfully.";
            } else {
                $validation_message['technical_error'] = "technical problem";
                $validation = false;
            }
        } else {
            echo "Data validation : *************";
            $validation = false;
            $validation_message = data_validation($_POST);
        }
    } else {
        $validation_message['empty_checker'] = "You must give every required information";
        $validation  = false;
        exit();
    }
} elseif (isset($_POST['btn-patient'])) {
    /*
    unset($_POST['pp']);
    unset($_POST['xp_info_doc']);
    unset($_POST['working_info']);
    */
    echo "Hello patient";
    print_r($_POST);
} else {
    $validation = false;
    $validation_message['wrong_form'] = "The form request is invalid";
}

// =====================================empty registration session =================


// validation checkup 
if ($validation) {
    print_r($validation_message);
} else {
    print_r($validation_message);
}



// =================form validation 
function data_validation($data)
{
    // checker 
    $validation = true;
    $validation_message = [];
    $data['status'] = true;

    // first name 

    $first_name_validation = alphabetic_velue($data['first_name'], 'first name');
    if ($first_name_validation == 1) {
        $data['first_name'] = input_test($data['first_name']);
    } else {
        $validation = false;
        $validation_message['first_name'] =  $first_name_validation;
    }

    $last_name_validation = alphabetic_velue($data['last_name'], 'last name');
    if ($last_name_validation == 1) {
        $data['last_name'] = input_test($data['last_name']);
    } else {
        $validation = false;
        $validation_message['last_name'] =  $last_name_validation;
    }


    // email validation 
    $email_valid = $data['email'];
    $sql = "SELECT * FROM users WHERE `email` = '$email_valid'";
    if (db_connection()->query($sql)->num_rows < 1) {
        input_test($data['email']);
    } else {
        $validation = false;
        $validation_message['duplicate_email'] =  'The email has already been registered please try with new email';
    }



    // password validation
    if (min_len($data['password'], 8) == 1) {

        if ($data['password'] == $data['confirm_pass']) {
            $data['password'] = md5($data['password']);
        } else {
            $validation = false;
            $validation_message['password'] =  "Password didn't match";
        }
    } else {
        $validation = false;
        $validation_message['password'] =  min_len($data['password'], 8);
    }

    // number validaiton 
    if (numeric_value($data['number']) == 1) {
        $data['number'] = $data['number'];
    } else {
        $validation = false;
        $validation_message['number'] =  numeric_value($data['number']);
    }


    // address filtering 
    $data['address'] = input_test($data['address']);

    $data['city'] = input_test($data['city']);

    $data['zip_code'] = input_test($data['zip_code']);

    // educaton info spliting data 
    $data['education_info'] = input_test_primary($data['education_info']);

    $data['working_info'] = input_test_primary($data['working_info']);


    // files attatchment 
    if (isset($_FILES['pp'])) {
        $profile_photo = $_FILES['pp'];
        $pp_name = $profile_photo['name'];
        $pp_explotion = explode('.', $profile_photo['name']);
        $pp_type = strtolower(end($pp_explotion));
        $pp_error = $profile_photo['error'];
        $pp_size_kb = $profile_photo['size'] / 1024;
        $pp_temp_location = $profile_photo['tmp_name'];

        $allowed_pp_Ext = array('png', 'jpg', 'jpeg', 'gif');
        if ($pp_error == 0) {
            if (in_array($pp_type, $allowed_pp_Ext)) {
                // new directory and name 
                $pp_dir = '../uploads/profile_photo/';
                $pp_new_name = $data['first_name'] . "_pp" . time() . mt_rand() . ".$pp_type";
                $data['profile_photo'] = array(
                    'pp' => $pp_new_name,
                    'pp_location' => $pp_dir,
                    'pp_temp_location' => $pp_temp_location
                );
            } else {
                $validation = false;
                $validation_message['pp_error'] =  "The profile picture type is not valid. Please Select an image file.";
            }
        } else {
            $validation = false;
            $validation_message['pp_error'] =  "There is an error by uploading your profile picture.";
        }
    }

    if (isset($_FILES['xp_info_doc'])) {
        $edu_attachment = $_FILES['xp_info_doc'];

        $edu_name = $edu_attachment['name'];
        $edu_explotion = explode('.', $edu_attachment['name']);
        $edu_type = strtolower(end($edu_explotion));
        $edu_error = $edu_attachment['error'];
        $edu_size_kb = $edu_attachment['size'] / 1024;
        $edu_temp_location = $edu_attachment['tmp_name'];





        if ($edu_error == 0) {
            $allowed_edu_doc = array('docx', 'doc', 'pdf');
            if (in_array($edu_type, $allowed_edu_doc)) {
                // new directory and name 
                $edu_dir = '../uploads/educatoinal_doc/';
                $edu_new_name = $data['first_name'] . "_edu" . time() . mt_rand() . ".$edu_type";

                $data['edu_doc'] = array(
                    'edu_doc_name' => $edu_new_name,
                    'edu_location' => $edu_dir,
                    'edu_temp_location' => $edu_temp_location
                );
            } else {
                $validation = false;
                $validation_message['edu_error'] =  "The file should be an pdf or word doccument.";
            }
        } else {
            $validation = false;
            $validation_message['edu_error'] =  "There is an error by uploading educational documents please try again.";
        }
    }


    // validation status 
    if ($validation) {
        return $data;
    } else {
        $data = $validation_message;
        $data['status'] = false;
        return $data;
    }
}

// ===========================empty data validation  
function empty_data_validation($data)
{
    foreach ($data as $key => $value) {
        if ($value == "") {
            return false;
            break;
        }
    }
    return true;
}



// ============================ querys functions 
function save_councilor($data)
{

    $f_name = $data['first_name'];
    $l_name = $data['last_name'];
    $email = $data['email'];
    $gender = $data['gender'];
    $date_of_birth = $data['date-of-birth'];
    $pass = $data['password'];
    $country_id = $data['country'];
    $phone_code = $data['phone-code'];
    $phone_number = $data['number'];
    $addr = $data['address'];
    $city = $data['city'];
    $zip_code = $data['zip_code'];
    // profile photo 
    $profile_photo = $data['profile_photo']['pp'];
    $profile_location = $data['profile_photo']['pp_location'];

    $user_role = $data['user_role'];

    // additional info 
    $education = $data['education_info'];
    $working_info = $data['working_info'];


    $document_name = $data['edu_doc']['edu_doc_name'];
    $document_location = $data['edu_doc']['edu_location'];


    // query for users data 
    $sql = "INSERT INTO users(
        f_name, l_name, email, gender, date_of_birth,pass, country_id, phone_code, phone_number, addr, city, zip_code, profile_photo, profile_location, role_id
    )
    VALUES(
        '$f_name', '$l_name', '$email', '$gender', '$date_of_birth', '$pass', '$country_id', '$phone_code', '$phone_number', '$addr', '$city', '$zip_code', '$profile_photo', '$profile_location',$user_role 
    );";

    if (db_connection()->query($sql)) {
        //query for user table data 
        $sql = "SELECT id FROM users WHERE `email` = '$email' AND `pass` = '$pass'";
        if (db_connection()->query($sql)) {
            move_uploaded_file($data['profile_photo']['pp_temp_location'], $profile_location . $profile_photo);

            $u_id  = (db_connection()->query($sql))->fetch_assoc()['id'];

            // query for additional info 
            $sql = "INSERT INTO additional_info(
                education, user_id, working_info , document_name, document_location
            )
            VALUES(
                '$education',  $u_id , '$working_info', '$document_name', '$document_location'
            );";

            if (db_connection()->query($sql)) {
                move_uploaded_file($data['edu_doc']['edu_temp_location'],  $document_location . $document_name);
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    } else {
        return false;
    }
}
