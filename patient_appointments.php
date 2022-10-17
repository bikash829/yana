<?php
$title = "My Appointments";
$state = "My appointments";
$banner_poster = "./images/banner/banner3.jpg";

include_once "./layout/head.php";
$banner = "./layout/banner.php";
include_once "./layout/navigation_bar.php";


include "./config/db_connection.php";

if(!isset($_SESSION['user'])){
    header("Location: ./index.php");
}

function my_appointments($uid)
{
    //2 -> pending
    //4 -> canceled
    //1 -> active 
    //3 -> past

    $sql = "SELECT
            appointment.*,
            user_appointment.appointment_status,
            CONCAT(DOC.f_name,' ',DOC.l_name) AS doc_name,
            DOC.email,
                (SELECT count(*) FROM user_appointment 
                WHERE appointment.id = user_appointment.appointment_id) AS total_doc_user
            FROM `user_appointment`
                JOIN appointment ON user_appointment.appointment_id = appointment.id
                JOIN users DOC ON appointment.doctor_id = DOC.id
            WHERE
                `user_appointment`.`patient_id` = $uid;
            ";



    if ($collection = db_connection()->query($sql)) {
        $data = $collection->fetch_all(MYSQLI_ASSOC);
        return $data;
    } else {
        return false;
    }
}

?>

<main class="main">
    <section class="segment-margin-side">
        <h3 class="text-center">My appointments</h3>

        <table class="table table-striped" id="my_appointments">
            <thead>
                <th>Doctor</th>
                <th>Email</th>
                <th>Date</th>
                <th>Start At</th>
                <th>End In</th>
                <th>Fees</th>
                <th>Time</th>
                <th>Action</th>
                <th>Total Patient</th>
                <th>Description</th>
            </thead>
            <tfoot>
                <th>Doctor</th>
                <th>Email</th>
                <th>Date</th>
                <th>Start At</th>
                <th>End In</th>
                <th>Fees</th>
                <th>Time</th>
                <th>Action</th>
                <th>Total Patient</th>
                <th>Description</th>


            </tfoot>
            <tbody>
                <?php

                // timing calculator 
                function minutes_peruser($start_time, $end_time, $capacity)
                {
                    $total_minutes = (abs(strtotime($start_time) - strtotime($end_time)) / 60);
                    $minutes_per_user = $total_minutes / $capacity;

                    return $minutes_per_user;
                }


                // timing function 
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
                
                    
                        $total_seconds_per   = $minutes_per_user * 60;
                        $total_seconds   = $total_minutes * 60;
                        $formed_start_time = strtotime($start_time);
                
                        foreach($data as $row){
                            $time_from = $formed_start_time;
                            $formed_start_time+= $total_seconds_per;

                            
                            if($row['patient_id'] == $p_id){
                                // $row['patient_id'];
                                return  date('H:i',$time_from).' - '.  date('H:i',$formed_start_time);
                            }
                            
                        }
                    }else{
                        return false;
                    }
                
                }

             

                foreach (my_appointments($_SESSION['user']['id']) as $row) {
                    $ap_id = $row['id']; 
                    $my_id = $_SESSION['user']['id'];

                    $my_time = my_time($ap_id,$my_id);

                ?>

                    <tr>
                        <td><?= ucwords($row['doc_name'])  ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['ap_date'] ?></td>
                        <td><?= $row['start_time'] ?></td>
                        <td><?= $row['end_time'] ?></td>
                        <td><?= $row['fees'] ?></td>
                        <td><?= $my_time ?></td>
                        <!-- <td><?= round(minutes_peruser($row['start_time'],$row['end_time'],$row['patient_capacity']))?> Minutes</td> -->
                        <?php if ($row['appointment_status'] == 2) { ?>
                            <td>
                                <p class="">Pending</p>
                            </td>

                        <?php } elseif ($row['appointment_status'] == 4) { ?>

                            <td>
                                <p class="text-danger">Canceled</p>
                            </td>
                        <?php } elseif ($row['appointment_status'] == 1) { ?>
                            <td><span class="text-success"><i class="fa-solid fa-user-check"></i>Booked</span></td>
                        <?php } elseif ($row['appointment_status'] == 3) { ?>
                            <td>
                                <p class="text-secondar">Past</p>
                            </td>
                        <?php  } else { ?>
                            <td><a class="btn btn-sm btn-primary" href="./backend/appointment_booking.php?appointment_id=<?= $row['id'] ?>&uid=<?= $_SESSION['user']['id'] ?>">Booking</a></td>
                        <?php } ?>

                        <td><?= $row['total_doc_user'] ?></td>
                        <td><?= $row['description'] ?></td>
                    </tr>
                <?php
                }

                ?>


            </tbody>
        </table>




    </section>

</main>


<?php
include_once "./layout/footer.php"
?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#my_appointments').DataTable();
    });

    var table = $('#my_appointments').DataTable();

    var data = table
        .column(0)
        .data()
        .sort()
        .reverse();
</script>