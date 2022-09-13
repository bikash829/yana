<?php
include "../config/db_connection.php";
include "./validation_function.php";
include "./essential_function.php";


// ==============================testing field=============================
// if(isset($_POST)){
//     print_r($_POST);

// }

// exit();

// $_POST = array(
//     'first_name' => 'Mayesha',
//     'last-name' => 'Fahmida',
//     'email' => 'mayeshafahmida90@gmail.com',
//     'gender' => 'male',
//     'date-of-birth' => '2022-08-02',
//     'password' => 'fffffffff',
//     'confirm_pass' => 'fffffffff',
//     'country' => 3,
//     'phone-code' => '+88',
//     'number' => '010245577',
//     'address' => 'mohammadpur',
//     'city' => 'Dhaka',
//     'zip_code' => '1207',
//     'education_info' => '[ed somewhere] [ed someplace] [ed some destination]',
//     'working_info' => '[somewhere] [someplace] [some destination]',
//     'xp_info_doc' => 'Screenshot (1).png',
//     'pp' => 'Screenshot (1).png',
//     'user_role' => 2,
//     'btn-councilor' => 'frm-councilor'
// );

// ================================end testing field =========================
//validation report flag
$validation = true;
$validation_message = [];





if (isset($test['btn-doctor'])) { // Doctor validation
    echo "Hello  doctor";
    print_r($_POST);
} elseif (isset($_POST['btn-councilor'])) { // councilor validation

    // optional data 
    $pp = $_POST['pp'];
    unset($_POST['pp']);
    $working_info  = $_POST['working_info'];
    unset($_POST['working_info']);

    // data filtering 
    if (empty_data_validation($_POST)) { //empty value guard
        // re-set optional data 
        $_POST['pp'] = $pp;
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

// =====================================empty session =================








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



// ================querys functions 
function save_councilor($data)
{

    $f_name = $data['first_name'];
    $l_name = $data['last_name'];
    $email = $data['email'];
    $gender = $data['gender'];
    $date_of_birth = $data['date-of-birth'];
    $pass = $data['password'];
    $confirm_pass = $data['confirm_pass'];
    $country_id = $data['country'];
    $phone_code = $data['phone-code'];
    $phone_number = $data['number'];
    $addr = $data['address'];
    $city = $data['city'];
    $zip_code = $data['zip_code'];

    $profile_photo = $data['pp'];

    $profile_location = "storage/pp/";
    $user_role = $data['user_role'];

    // additional info 
    $education = $data['education_info'];
    $working_info = $data['working_info'];
    $document_name = $data['xp_info_doc'];
    $document_location = "storage/document/";


    // query for users data 
    $sql = "INSERT INTO users(
        f_name, l_name, email, gender, date_of_birth,pass, country_id, phone_code, phone_number, addr, city, zip_code, profile_photo, profile_location, role_id
    )
    VALUES(
        '$f_name', '$l_name', '$email', '$gender', '$date_of_birth', '$pass', '$country_id', '$phone_code', '$phone_number', '$addr', '$city', '$zip_code', '$profile_photo', '$profile_location',$user_role 
    );";

    if (db_connection()->query($sql)) {

        $sql = "SELECT id FROM users WHERE `email` = '$email' AND `pass` = '$pass'";
        if (db_connection()->query($sql)) {
            $u_id  = (db_connection()->query($sql))->fetch_assoc()['id'];

            // query for additional info 
            $sql = "INSERT INTO additional_info(
                education, user_id, working_info , document_name, document_location
            )
            VALUES(
                '$education',  $u_id , '$working_info', '$document_name', '$document_location'
            );";

            if (db_connection()->query($sql)) {
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
