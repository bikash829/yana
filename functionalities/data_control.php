<?php
// =================form validation 
function data_validation($data)
{
    // checker 
    $validation = true;
    $validation_message = [];
    $data['status'] = true;


    // print_r($data);
    // // exit();
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
    if (isset($data['email'])) {
        $email_valid = $data['email'];


        $sql = "SELECT * FROM users WHERE `email` = '$email_valid'";

        if (db_connection()->query($sql)->num_rows < 1) {
            input_test($data['email']);
        } else {
            $validation = false;
            $validation_message['duplicate_email'] =  'The email has already been registered please try with new email';
        }
    }







    // password validation
    if (isset($data['password'])) {
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
    }

    // number validaiton 
    if (!empty($data['number'])) {
        if (numeric_value($data['number']) == 1) {
            $data['number'] = $data['number'];
        } else {
            $validation = false;
            $validation_message['number'] =  numeric_value($data['number']);
        }
    }



    // address filtering 
    $data['address'] = input_test($data['address']);

    $data['city'] = input_test($data['city']);

    $data['zip_code'] = input_test($data['zip_code']);

    // educaton info spliting data 
    if (isset($data['education_info'])) {
        $data['education_info'] = input_test_primary($data['education_info']);
    }

    if (isset($data['working_info'])) {
        $data['working_info'] = input_test_primary($data['working_info']);
    }



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



        if (!($pp_size_kb < 1)) {
            if ($pp_error == 0) {
                if (in_array($pp_type, $allowed_pp_Ext)) {
                    // new directory and name 
                    $pp_dir = './uploads/profile_photo/';
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
                $edu_dir = './uploads/educatoinal_doc/';
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

// ==================optional data validation

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
    if (isset($data['patient_status'])) {
        $patient_status = $data['patient_status'];
    } else {
        $patient_status = 'NULL';
    }

    // $country_id =empty_value($data['country']);
    if (isset($data['country'])) {
        $country_id = empty_value($data['country']);
    } else {
        $country_id = '';
    }

    if (isset($data['phone-code'])) {
        $phone_code = $data['phone-code'];
    } else {
        $phone_code = '';
    }
    $phone_number = $data['number'];
    $addr = $data['address'];
    $city = $data['city'];
    $zip_code = $data['zip_code'];
    // profile photo 
    if (isset($data['profile_photo']['pp'])) {
        $profile_photo = $data['profile_photo']['pp'];
    } else {
        $profile_photo = '';
    }

    if (isset($data['profile_photo']['pp_location'])) {
        $profile_location = $data['profile_photo']['pp_location'];
    } else {
        $profile_location = '';
    }



    $user_role = $data['role'];

    // additional info 
    if (isset($data['education_info'])) {
        $education = $data['education_info'];
    } else {
        $education = '';
    }
    if (isset($data['working_info'])) {
        $working_info = $data['working_info'];
    } else {
        $working_info = '';
    }



    if (isset($data['edu_doc']['edu_doc_name'])) {
        $document_name = $data['edu_doc']['edu_doc_name'];
    } else {
        $document_name = '';
    }
    if (isset($data['edu_doc']['edu_location'])) {
        $document_location = $data['edu_doc']['edu_location'];
    } else {
        $document_location = '';
    }

    // query for users data 
    $sql = "INSERT INTO users(
        f_name, l_name, email, gender, date_of_birth,pass, country_id, phone_code, phone_number, addr, city, zip_code, profile_photo, profile_location, role_id,`status`
    )
    VALUES(
        '$f_name', '$l_name', '$email', '$gender', '$date_of_birth', '$pass', '$country_id', '$phone_code', '$phone_number', '$addr', '$city', '$zip_code', '$profile_photo', '$profile_location',$user_role,$patient_status 
    );";



    if (db_connection()->query($sql)) {
        //query for user table data 
        $sql = "SELECT id FROM users WHERE `email` = '$email' AND `pass` = '$pass'";
        if (db_connection()->query($sql)) {
            if (!empty($data['profile_photo']['pp_temp_location'])) {

                $profile_location = '.' . $profile_location;
                move_uploaded_file($data['profile_photo']['pp_temp_location'], $profile_location . $profile_photo);
            }

            $u_id  = (db_connection()->query($sql))->fetch_assoc()['id'];

            // query for additional info 
            $sql = "INSERT INTO additional_info(
                education, user_id, working_info , document_name, document_location
            )
            VALUES(
                '$education',  $u_id , '$working_info', '$document_name', '$document_location'
            );";

            if (db_connection()->query($sql)) {
                if (!empty($data['edu_doc']['edu_temp_location'])) {
                    $document_location = '.' . $document_location;
                    move_uploaded_file($data['edu_doc']['edu_temp_location'],  $document_location . $document_name);
                }
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


// update user 
function update_user($data)
{

    $f_name = $data['first_name'];
    $l_name = $data['last_name'];
    // $email = $data['email'];
    $gender = $data['gender'];
    $date_of_birth = $data['date-of-birth'];

    // $country_id =empty_value($data['country']);
    if (isset($data['country'])) {
        $country_id = empty_value($data['country']);
    }

    if (isset($data['phone-code'])) {
        $phone_code = $data['phone-code'];
    } else {
        $phone_code = '';
    }
    $phone_number = $data['number'];
    $addr = $data['address'];
    $city = $data['city'];
    $zip_code = $data['zip_code'];



    // additional info 
    if (isset($data['education_info'])) {
        $education = $data['education_info'];
    } else {
        $education = '';
    }
    if (isset($data['working_info'])) {
        $working_info = $data['working_info'];
    } else {
        $working_info = '';
    }
    $user_id = $data['id'];



    if (isset($data['role_id'])) {
        if ($data['role_id'] == 2 || $data['role_id'] == 3) {

            $sql = "START TRANSACTION;
                    UPDATE `users` 
                    SET `f_name`='$f_name', `l_name` = '$l_name', `gender`='$gender', `date_of_birth`='$date_of_birth', `phone_number` = '$phone_number', `addr`='$addr',`city`='$city', `zip_code` = '$zip_code' 
                    WHERE `id`=$user_id;


                    UPDATE `additional_info` 
                    SET `education` = '$education', `working_info` = '$working_info'
                    WHERE `user_id` = '$user_id';

                    COMMIT;";


          
            if (db_connection()->multi_query($sql)) {
                return $data;
            }
        }
    } else { //user update 

        $sql = "START TRANSACTION;
                UPDATE `users` 
                SET `f_name`='$f_name', `l_name` = '$l_name', `gender`='$gender', `date_of_birth`='$date_of_birth',`country_id` = '$country_id', `phone_code` = '$phone_code', `phone_number` = '$phone_number', `addr`='$addr',`city`='$city', `zip_code` = '$zip_code' 
                WHERE `id`=$user_id;


                UPDATE `additional_info` 
                SET `education` = '$education', `working_info` = '$working_info'
                WHERE `user_id` = '$user_id';

                SELECT `country`.`name` AS `country_name` FROM `country` WHERE `country`.`id` = $country_id;
                
                SELECT `country`.`phonecode` AS `phone_code` FROM `country` WHERE `country`.`id` = $phone_code;

                COMMIT;";


        if (db_connection()->multi_query($sql)) {

            // retriving country information 
            // $sql = "SELECT `id` AS `country_id`,`name` AS country_name,(SELECT `id` AS `phone_code_id`,`phonecode` FROM `country` WHERE `id` = $phone_code) AS `phone_code` FROM `country` 
            // WHERE `id` = $country_id;";

            $sql = "SELECT `id` AS `country_id`,`name` AS country_name,(SELECT `id` FROM `country` WHERE `id` = $phone_code) AS `phone_code_id`,(SELECT `phonecode` FROM `country` WHERE `id` = $phone_code) AS `phone_code` FROM `country` 
                    WHERE `id` = $country_id;";


            if ($result = db_connection()->query($sql)) {
                $row = $result->fetch_assoc();


                $data['phone_code'] = $row['phone_code'];
                $data['country_name'] = $row['country_name'];
                $data['phone_code_id'] = $row['phone_code_id'];
                $data['country_id'] = $row['country_id'];
                $data['full_name'] = $f_name . ' ' . $l_name;

                return $data;
            }


            return true;
        } else {
            return false;
        }
    }
}
