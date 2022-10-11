
    if (db_connection()->multi_query($sql)) {

$result = db_connection()->multi_query($sql);
print_r($result);
exit();

$data_set = [];

$data_set['f_name'] = $f_name;
$data_set['l_name'] = $l_name;
$data_set['gender'] = $gender;
$data_set['date_of_birth'] = $date_of_birth;
$data_set['country_id'] = $country_id;
// $data_set['phone_code'] = ;
$data_set['phone_number'] = $phone_number;
$data_set['addr'] = $addr;
$data_set['city'] = $city;
$data_set['zip_code'] = $zip_code;
$data_set['phone_code_id'] = $phone_code;
$data_set['working_info'] = $working_info;
$data_set['education_info'] = $education;
// $data_set['country_name'] = ;
$data_set['full_name'] = $f_name . ' ' . $l_name;


return $data_set;


} else {
return false;
}







$sql = "SELECT `name` AS country_name,(SELECT `phonecode` FROM `country` WHERE `id` = $phone_code) AS `phone_code` FROM `country` 
        WHERE `id` = $country_id";
        if ($result = db_connection()->query($sql)) {
            $row = $result->fetch_assoc();

            $data_set = [];

            $data_set['f_name'] = $f_name;
            $data_set['l_name'] = $l_name;
            $data_set['gender'] = $gender;
            $data_set['date_of_birth'] = $date_of_birth;
            $data_set['country_id'] = $country_id;
            $data_set['phone_code'] = $row['phone_code'];
            $data_set['phone_number'] = $phone_number;
            $data_set['addr'] = $addr;
            $data_set['city'] = $city;
            $data_set['zip_code'] = $zip_code;
            $data_set['phone_code_id'] = $phone_code;
            $data_set['working_info'] = $working_info;
            $data_set['education_info'] = $education;
            $data_set['country_name'] = $row['country_name'];
            $data_set['full_name'] = $f_name . ' ' . $l_name;

            return $data_set;
        }