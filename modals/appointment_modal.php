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

    // print_r($sql);
    // exit();



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
                <table class="table table-striped" id="appointment_table">
                    <thead>
                        <th>Date</th>
                        <th>Start At</th>
                        <th>End In</th>
                        <th>Seat left</th>
                        <th>Fee</th>
                        <th>Action</th>
                        <th>Description</th>
                    </thead>
                    <tfoot>
                        <th>Date</th>
                        <th>Start At</th>
                        <th>End In</th>
                        <th>Seat left</th>
                        <th>Fee</th>
                        <th>Action</th>
                        <th>Description</th>


                    </tfoot>
                    <tbody>
                        <?php
                        foreach ($next_appointment as $row) {
                            $appointment_id = $row['id'];

                            $appointmnet_status = appointment_status($patient_id, $appointment_id);
                        ?>

                            <tr>
                                <td><?= $row['ap_date'] ?></td>
                                <td><?= $row['start_time'] ?></td>
                                <td><?= $row['end_time'] ?></td>
                                <td><?= $row['patient_capacity'] ?></td>
                                <td><?= $row['fees'] ?></td>
                                <?php if ($appointmnet_status['appointment_status'] == 2) { ?>
                                    <td>
                                        <p class="">Pending</p>
                                    </td>

                                <?php } elseif ($appointmnet_status['appointment_status'] == 4) { ?>

                                    <td>
                                        <p class="text-danger">Canceled</p>
                                    </td>
                                <?php } elseif ($appointmnet_status['appointment_status'] == 1) { ?>
                                    <td><span class="text-success"><i class="fa-solid fa-user-check"></i>Booked</span></td>
                                <?php } elseif ($appointmnet_status['appointment_status'] == 3) { ?>
                                    <td>
                                        <p class="text-secondar">Past</p>
                                    </td>
                                <?php  } else { ?>
                                    <td><a class="btn btn-sm btn-primary" href="./backend/appointment_booking.php?appointment_id=<?= $row['id'] ?>&uid=<?= $_SESSION['user']['id'] ?>">Booking</a></td>
                                <?php } ?>

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