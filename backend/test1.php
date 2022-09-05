<?php
include "./validation_function.php";
$test_POST = array(
    'first-name' => 'Mayesha',
    'last-name' => 'Fahmi588585da',
    'email' => 'mayeshafahmida90@gmail.com',
    'gender' => 'male',
    'date-of-birth' => '2022-08-02',
    'password' => 'fffffffff',
    'confirm_pass' => 'fffffffff',
    'country' => 3,
    'phone-code' => '+88',
    'number' => 'kaofjasofasoffs',
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



$validation = true;
$validation_message = [];


if (alphabetic_velue($test_POST['first-name']) == 1) {
    input_test($test_POST['first-name']);
} else {
    $validation = false;
    $validation_message['first-name'] =  alphabetic_velue($test_POST['first-name']);
}
if (alphabetic_velue($test_POST['last-name']) == 1) {
    input_test($test_POST['last-name']);
} else {
    $validation = false;
    $validation_message['last-name'] =  alphabetic_velue($test_POST['last-name']);
}

// input_test($test_POST['email']);

// // password validation
// if (min_len($test_POST['password'], 8) == 1) {
//     if ($test_POST['password'] == $test_POST['confirm_pass']) {
//         $test_POST['password'] = md5($test_POST['password']);
//     } else {
//         $validation = false;
//         $validation_message['password'] =  "Password didn't match";
//     }
// } else {
//     $validation = false;
//     $validation_message['password'] =  min_len($test_POST['password'], 8);
// }

// // number validaiton 
// if (numeric_value($test_POST['number']) == 1) {
//     $test_POST['number'] = $test_POST['number'];
// } else {
//     $validation = false;
//     $validation_message['number'] =  numeric_value($test_POST['number']);
// }

// // address filtering 
// $test_POST['address'] = input_test($test_POST['address']);

// $test_POST['city'] = input_test($test_POST['city']);

// $test_POST['zip_code'] = input_test($test_POST['zip_code']);

// // educaton info spliting test_POST 
// $test_POST['education_info'] = input_test_primary($test_POST['education_info']);

// $test_POST['working_info'] = input_test_primary($test_POST['working_info']);

if ($validation) {
    print_r($test_POST);
} else {
    print_r($validation_message);
}
