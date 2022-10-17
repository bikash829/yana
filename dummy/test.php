<?php 

// $d=strtotime("15:30");
// $e = strtotime("12:00");

// $diff = $e - $d;

// echo "$diff <br>";

// echo date("h:m",$diff);


// $time1 = strtotime('09:00');
// $time2 = strtotime('10:30');
// $difference = abs($time2 - $time1) /  60;

// echo date('H:i',$time1) . '<br>' . $difference . '<br>';


// $perTime  = 90 * 60;
// $time1 = $perTime + $time1; 
// $difference = abs($time2 - $time1) /  60;


// echo date('H:i',$time1) . '<br>' . $difference;



include "../config/db_connection.php";
function my_time($ap_id,$p_id){
    $sql = "SELECT user_appointment.*,appointment.start_time,appointment.end_time,appointment.patient_capacity FROM user_appointment
    JOIN appointment ON appointment.id = user_appointment.appointment_id
    WHERE user_appointment.appointment_id = $ap_id ORDER BY user_appointment.id";


    if($result = db_connection()->query($sql)){
        $data = $result->fetch_all(MYSQLI_ASSOC);
        $start_time = $data[0]['start_time'];
        $end_time =$data[0]['end_time'];
        $capacity =$data[0]['patient_capacity'];

        $total_minutes = abs(strtotime($end_time) - strtotime($start_time)) / 60 ;

        $minutes_per_user = $total_minutes / $capacity;

        $my_time = '';
        $total_seconds_per   = $minutes_per_user * 60;
        $total_seconds   = $total_minutes * 60;
        $formed_start_time = strtotime($start_time);

        foreach($data as $row){


            $formed_start_time+= $total_seconds_per;
            if($row['patient_id'] == $p_id){
                // $row['patient_id'];
                return  date('H:i',$formed_start_time);
            }
            
        }
    }else{
        return false;
    }

}






?>






