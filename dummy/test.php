<?php
include "../config/db_connection.php";

function appointment_status($uid,$ap_id)
{
    //2 -> pending
    //0 -> canceled
    //1 -> active 
    //3 -> past

    $sql = "SELECT user_appointment.*,users.f_name AS pf_name, users.l_name as pl_name, users.id as p_id,
            appointment.id as appointment_id,users.email as p_email
            FROM user_appointment
            JOIN users ON user_appointment.patient_id = users.id
            JOIN appointment ON user_appointment.appointment_id = appointment.id
            WHERE user_appointment.patient_id = $uid 
            AND user_appointment.appointment_id = $ap_id
            ;";



    if ($collection = db_connection()->query($sql)) {
        $data = $collection->fetch_assoc();
        return $data;
    } else {
        return false;
    }
}



print_r(appointment_status(19,4));






// print_r(appointment_list());