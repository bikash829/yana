<?php
include "../config/db_connection.php";
include "./validation_function.php";
include "./essential_function.php";


// ==============================testing field=============================
$test_POST = array(
    'first_name' => 'Mayesha',
    'last-name' => 'Fahmida',
    'email' => 'mayeshafahmida90@gmail.com',
    'gender' => 'male',
    'date-of-birth' => '2022-08-02',
    'password' => 'fffffffff',
    'confirm_pass' => 'fffffffff',
    'country' => 3,
    'phone-code' => '+88',
    'number' => '10245577',
    'address' => 'mohammadpur',
    'city' => 'Dhaka',
    'zip_code' => '1207',
    'education_info' => '[ed somewhere] [ed someplace] [ed some destination]',
    'working_info' => '[somewhere] [someplace] [some destination]',
    'xp_info_doc' => 'Screenshot (1).png',
    'pp' => 'Screenshot (1).png',
    'user_role' => 2,
    'btn-councilor' => 'frm-councilor'
);





// ================================end testing field =========================

$validation = true;
$validation_message = [];

// print_r($test_POST);
// exit();

if (isset($test['btn-doctor'])) {
    echo "Hello  doctor";
    print_r($test_POST);
} elseif (isset($test_POST['btn-councilor'])) {

    // optional data 
    $pp = $test_POST['pp'];
    unset($test_POST['pp']);
    $working_info  = $test_POST['working_info'];
    unset($test_POST['working_info']);

    // $test_POST['first-name'] = "";


    if (empty_data_validation($test_POST)) {
        // re-set optional data 
        $test_POST['pp'] = $pp;
        $test_POST['working_info'] = $working_info;

        //data validation 
        $validation_report = data_validation($test_POST);
        if (isset($validation_report['status'])) {
            echo "your data has been validated and it's clean now data validation <br>";
            print_r(data_validation($test_POST));
        } else {
            echo "wrong";
            print_r(data_validation($test_POST));
        }
    } else {
        echo "You must give every required information";
        exit();
    }


    // empty data validaiton 
    //  $result = empty_data_validation($test_POST);

    //  print_r($result);
    //  var_dump($result);
    //  exit();






    // $result = save_councilor($test_POST);
    // print_r($result);

} elseif (isset($test_POST['btn-patient'])) {
    /*
    unset($test_POST['pp']);
    unset($test_POST['xp_info_doc']);
    unset($test_POST['working_info']);
    */
    echo "Hello patient";
    print_r($test_POST);
} else {
    $validation = false;
    $validation_message['wrong_form'] = "The form request is invalid";
}

// =====================================empty session =================








// validation checkup 
if ($validation) {
    echo "Hei  everthing is super  clean";
} else {
    print_r($validation_message);
}






function filter_empty_value($data)
{
}

function councilorReg($data)
{
}

function patientReg($data)
{
}


// form validation 
function data_validation($data)
{
    // $f_name = $data['first-name'];
    // $l_name = $data['last-name'];
    // $email = $data['email'];
    // $gender = $data['gender'];
    // $date_of_birth = $data['date-of-birth'];
    // $pass = $data['password'];
    // $confirm_pass = $data['confirm_pass'];
    // $country_id = $data['country'];
    // $phone_code = $data['phone-code'];
    // $phone_number = $data['number'];
    // $addr = $data['address'];
    // $city = $data['city'];
    // $zip_code = $data['zip_code'];

    // $profile_photo = $data['pp'];

    // $profile_location = "storage/pp/";
    // $user_role = $data['user_role'];

    // // ===============additional info 
    // $education = $data['education_info'];
    // $working_info = $data['working_info'];
    // $document_name = $data['xp_info_doc'];
    // $document_location = "storage/document/";

    // checker 
    $validation = true;
    $validation_message = [];
    $data['status'] = true;


    // first name 

    $first_name_validation = alphabetic_velue($data['first_name'],'first name');
    if ( $first_name_validation == 1) {
        $data['first_name'] = input_test($data['first_name']);
    } else {
        $validation = false;
        $validation_message['first_name'] =  $first_name_validation;
    }

    $last_name_validation = alphabetic_velue($data['last-name'],'last name');
    if ($last_name_validation == 1) {
        $data['last-name'] = input_test($data['last-name']);
    } else {
        $validation = false;
        $validation_message['last-name'] =  $last_name_validation;
    }

    input_test($data['email']);

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
        $data['status'] = false;
        return $validation_message;
    }
}




// empty data validation  
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



// querys functions 
function save_councilor($data)
{
    $f_name = $data['first-name'];
    $l_name = $data['last-name'];
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

    // query for additional info 
    $sql .= "INSERT INTO additional_info(
        education, workiing_place, document_name, document_location
    )
    VALUES(
        '$education', '$working_info', '$document_name', '$document_location'
    );";


    // echo $sql;
    // exit();


    // query for link user info 
    // $sql .= "INSERT INTO additional_info_link(
    //     `user_id`, `info_id`
    // )
    // VALUES(
    //     $user_id, $info_id
    // );";


    if (db_connection()->multi_query($sql) === TRUE) {
        return "Your data has been inserted successfully";
    } else {
        return "Insert councilor  query error check it properly";
    }
}








// print_r($validation_message);
