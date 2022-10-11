<?php
include "../config/db_connection.php";

function active_appointment()
{
    $sql = "SELECT appointment.*,concat(users.f_name,' ',users.l_name) as full_name, users.email,users.phone_number 
    FROM appointment
    JOIN users ON appointment.doctor_id = users.id";
    // $active_appointments = array();

    // if ($all_appointments_set = db_connection()->query($sql)) {
    //     $all_appointments = $all_appointments_set->fetch_all(MYSQLI_ASSOC);
    //     foreach ($all_appointments as $row) {

    //         $diff = floor((time() - strtotime($row['ap_date'])) / (60 * 60 * 24));

    //         if ($diff < 0) {
    //             array_push($active_appointments, $row);

    //         }

    //     }

    //     return $active_appointments;
    // } else {
    //     return false;
    // }
}


function patients_info($ap_id)
{
    $sql = "SELECT concat(users.f_name,' ',users.l_name) AS full_name, users.email, users.phone_code as phone_code_id,country.phonecode, users.phone_number,users.gender,users.date_of_birth,country.name as country_name, 
            concat(users.addr,',',users.city,'-',users.zip_code) as `address`
            FROM appointment
            JOIN user_appointment ON appointment.id = user_appointment.appointment_id
            JOIN users ON user_appointment.patient_id = users.id
            JOIN country ON users.country_id = country.id
            JOIN country con_ph ON users.phone_code = con_ph.id
            WHERE appointment.id = $ap_id";


    if ($user_info_set = db_connection()->query($sql)) {
        $user_info = $user_info_set->fetch_assoc();
        return $user_info;
        
    }else{
        return false;
    }
}



print_r(patients_info(4));


// (SELECT users.f_name as doc_f_name,users.l_name as doc_lname FROM appointment JOIN users ON appointment.doctor_id = users.id WHERE appointment.id = user_appointment.appointment_id)