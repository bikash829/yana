<?php
$title = "My Appointments";
$state = "My appointments";
$banner_poster = "./images/banner/banner3.jpg";

include_once "./layout/head.php";
$banner = "./layout/banner.php";
include_once "./layout/navigation_bar.php";


include "./config/db_connection.php";
$user_id = $_SESSION['user']['id'] ?? null;

// var_dump($user_id);
// exit();

//upcomming appointments
function upcomming_appointments()
{
    $sql = "SELECT `appointment`.*, `users`.id as doctor_id , concat(`users`.f_name,' ',`users`.l_name) AS full_name,
    (SELECT count(*) FROM user_appointment WHERE user_appointment.appointment_id = appointment.id AND user_appointment.appointment_status = 1) 
    AS total_patients  
    FROM appointment 
    JOIN users ON appointment.doctor_id = users.id 
    WHERE `users`.`status` = 1
    ORDER BY appointment.ap_date";
    $upcomming_appointments = [];



    if ($appointmnet_data = db_connection()->query($sql)) {
        $appointment_list = $appointmnet_data->fetch_all(MYSQLI_ASSOC);

        foreach ($appointment_list as $row) {

            $diff = floor((time() - strtotime($row['ap_date'])) / (60 * 60 * 24));
            if ($diff < 0) {
                array_push($upcomming_appointments, $row);
            }
        }

        return $upcomming_appointments;
    }
}


//user appointmetns
function appointment_status($uid, $ap_id)
{
    //1 -> active 
    //2 -> pending
    //3 -> past
    //4 -> canceled

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



?>

<main class="main">
    <section class="segment-margin-side">
        <h3 class="text-center mb-4">Upcomming Appointments</h3>

        <table class="table table-striped" id="my_appointments">
            <thead>
                <th>Sr No.</th>
                <th>Doctor Name</th>
                <th>Date</th>
                <th>Start At</th>
                <th>End In</th>
                <th>Fee</th>
                <th>Capacity</th>
                <th>Seat left</th>
                <th>Status</th>
                <th>Description</th>
            </thead>
            <tfoot>
                <th>Sr No.</th>
                <th>Doctor Name</th>
                <th>Date</th>
                <th>Start At</th>
                <th>End In</th>
                <th>Fee</th>
                <th>Capacity</th>
                <th>Seat Left</th>
                <th>Status</th>
                <th>Description</th>


            </tfoot>
            <tbody>
                <?php
                $count = 1;
                foreach (upcomming_appointments() as $row) {
                ?>

                    <tr>
                        <td><?= $count ?></td>
                        <td><?= ucwords($row['full_name'])  ?></td>
                        <td><?= $row['ap_date'] ?></td>
                        <td><?= $row['start_time'] ?></td>
                        <td><?= $row['end_time'] ?></td>
                        <td><?= $row['fees'] ?></td>
                        <td><?= $row['patient_capacity'] ?></td>
                        <td><?= $row['total_patients'] ?></td>
                        <?php
                        if ($row['total_patients'] >= $row['patient_capacity']) { ?>
                            <td>
                                <p class="text-danger">All Booked</p>
                            </td>


                            <?php    } else {
                            if (isset($_SESSION['user'])) {
                               
                                    $appointment_status = appointment_status($_SESSION['user']['id'], $row['id']);

                                    if (empty($appointment_status)) {
                                        $appointment_status['appointment_status'] = "";
                                    }
                                ?>
                                    <?php if ($appointment_status['appointment_status'] == 2) { ?>
                                        <td>
                                            <p class="">Pending</p>
                                        </td>

                                    <?php } elseif ($appointment_status['appointment_status'] == 4) { ?>

                                        <td>
                                            <p class="text-danger">Canceled</p>
                                        </td>
                                    <?php } elseif ($appointment_status['appointment_status'] == 1) { ?>
                                        <td><span class="text-success"><i class="fa-solid fa-user-check"></i>Booked</span></td>
                                    <?php } elseif ($appointment_status['appointment_status'] == 3) { ?>
                                        <td>
                                            <p class="text-secondar">Past</p>
                                        </td>
                                    <?php  } else { ?>
                                        <td><button value="<?= $row['id'] ?>" class="btn btn-sm btn-primary booking" href="#">Booking</button></td>
                                <?php 
                                } ?>

                            <?php
                            } else {
                            ?>
                                <td><button value="<?= $row['id'] ?>" class="btn btn-sm btn-primary booking" href="#">Booking</button></td>

                        <?php
                            }
                        }
                        ?>



                        <td><?= $row['description'] ?></td>
                    </tr>
                <?php
                    $count++;
                }

                ?>
            </tbody>
        </table>
    </section>
</main>
<?php
include_once "./layout/footer.php";

include "./functionalities/alert.php";

if (isset($_SESSION['booking_status'])) {
    $alert_status = alert($_SESSION['booking_status']);
    unset($_SESSION['booking_status']);
} else {
    $alert_status = false;
}

?>

<script type="text/javascript">
    // confirmation message 
    let alertStatus = <?= json_encode($alert_status) ?>;
    if (alertStatus) {
        Swal.fire({

            title: alertStatus.status,
            text: alertStatus.message,
            icon: alertStatus.status

        })
    }



    // warning section 
    let booking = document.querySelectorAll('.booking');

    let userId = <?= json_encode($user_id) ?> ?? false;

    // if(userId != null)
    if (userId) { //logged on user
        for (let element of booking) {
            element.addEventListener('click', (e) => {
                let appointmentId = e.target.value;

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Confirm!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = `./backend/appointment_booking.php?appointment_id=${appointmentId}&uid=${userId}`;
                    }
                })
            });
        }
        console.log("You are logged on");
    } else { // for guest user
        for (let element of booking) {
            element.addEventListener('click', (e) => {
                let appointmentId = e.target.value;
                Swal.fire({
                    icon: 'warning',
                    title: 'Please login to book an appointment'
                })
            });
        }
        console.log('you should login first');
    }

    //data table 
    $(document).ready(function() {
        $('#my_appointments').DataTable();
    });
</script>