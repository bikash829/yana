<?php
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
<div class="modal fade" id="make_appointment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Make An Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!-- booking section  -->
                <table class="table table-striped nowrap" id="appointment_table">
                    <thead>
                        <th>Date</th>
                        <th>Start At</th>
                        <th>End In</th>
                        <th>Capacity</th>
                        <th>Seat left</th>
                        <th>Patient Time</th>
                        <th>Fee</th>
                        <th>Action</th>
                        <th>Description</th>
                    </thead>
                    <tfoot>
                        <th>Date</th>
                        <th>Start At</th>
                        <th>End In</th>
                        <th>Capacity</th>
                        <th>Seat left</th>
                        <th>Patient Time</th>
                        <th>Fee</th>
                        <th>Action</th>
                        <th>Description</th>


                    </tfoot>
                    <tbody>
                        <?php
                        // print_r($next_appointment);
                        // exit();
                        foreach ($next_appointment as $row) {
                            $appointment_id = $row['id'];
                            $total_minutes = (abs(strtotime($row['start_time']) - strtotime($row['end_time'])) / 60);
                            $minutes_per_user = $total_minutes / $row['patient_capacity'];

                            $appointmnet_status = appointment_status($patient_id, $appointment_id);
                        ?>

                            <tr>
                                <td><?= $row['ap_date'] ?></td>
                                <td><?= $row['start_time'] ?></td>
                                <td><?= $row['end_time'] ?></td>
                                <td><?= $row['patient_capacity'] ?></td>
                                <td><?= $row['patient_capacity'] - $row['total_patients'] ?></td>
                                <td><?= round($minutes_per_user)?> Minutes</td>
                                <td><?= $row['fees'] ?></td>
                                <?php
                                if ($row['total_patients'] >= $row['patient_capacity']) { ?>
                                    <td>
                                        <p class="">All booked</p>
                                    </td>

                                    <?php  } else {
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
                                        <?php }
                                        ?>

                                    <?php } else { ?>
                                        <td><button value="<?= $row['id'] ?>" class="btn btn-sm btn-primary booking" href="#">Booking</button></td>

                                <?php }
                                } ?>

                                <td><?= $row['description'] ?></td>
                            </tr>
                        <?php
                        }

                        ?>


                    </tbody>
                </table>



                </form>
            </div>
        </div>
    </div>
</div>

<?php
$user_id = $_SESSION['user']['id'] ?? null;

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

    if (userId) { //logged on user
        for (let element of booking) {
            console.log(element)
            element.addEventListener('click', (e) => {
                let appointmentId = e.target.value;


                console.log(appointmentId)

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
            })
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
</script>