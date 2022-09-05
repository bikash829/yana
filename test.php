

<?php
include "./backend/validation_function.php";
$data = '[blah first][blah second][blah third]';
function data_spilator($data)
{

    $spilited_data = [];

    $data = trim($data);
    $data = explode(']', $data);

    for ($i = 0; $i < count($data); $i++) {
        $value = $data[$i];
        if (empty($value)) {
            continue;
        } else {
            $position = strpos($value, '[');

            $value = str_split($value);
            unset($value[$position]);
            $value = implode($value);
            array_push($spilited_data, $value);
        }
    }
    return $spilited_data;
}


$result = data_spilator($data);

// for ($i = 0; $i < count($result); $i++) {
//     echo $result[$i] . '<br>';
// }



$test_POST = array(
    'first-name' => 'Mayesha',
    'last-name' => 'Fahmi588585da',
    'email' => 'mayeshafahmida90@gmail.com',
    'gender' => 'male',
    'date-of-birth' => '2022-08-02',
    'password' => 'fffffffff',
    'confirm_pass' => 'ffffffffff',
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


$validation_result = data_validation($test_POST);


print_r($validation_result);



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


    if (alphabetic_velue($data['first-name'])) {
        input_test($data['first-name']);
    } else {
        $validation = false;
        $validation_message['first-name'] =  alphabetic_velue($data['frist-name']);
    }
    if (alphabetic_velue($data['last-name'])) {
        input_test($data['last-name']);
    } else {
        $validation = false;
        $validation_message['last-name'] =  alphabetic_velue($data['last-name']);
    }

    input_test($data['email']);

    // password validation
    if (min_len($data['password'], 8)) {
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
    if (numeric_value($data['number'])) {
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
        return $validation_message;
    }
}




?>