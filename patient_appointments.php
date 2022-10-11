<?php
$title = "My Appointments";
$state = "My appointments";
$banner_poster = "./images/banner/banner3.jpg";

include_once "./layout/head.php";
$banner = "./layout/banner.php";
include_once "./layout/navigation_bar.php";


include "./config/db_connection.php";
function my_appointments($uid)
{
    //2 -> pending
    //4 -> canceled
    //1 -> active 
    //3 -> past

    $sql = "SELECT appointment.*,user_appointment.appointment_status FROM `user_appointment`
            JOIN appointment ON user_appointment.appointment_id = appointment.id 
            WHERE `user_appointment`.`patient_id` = $uid 
            ;";



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
                <th>Date</th>
                <th>Start At</th>
                <th>End In</th>
                <th>Fee</th>
                <th>Action</th>
                <th>Description</th>
            </thead>
            <tfoot>
                <th>Date</th>
                <th>Start At</th>
                <th>End In</th>
                <th>Fee</th>
                <th>Status</th>
                <th>Description</th>


            </tfoot>
            <tbody>
                <?php

                foreach (my_appointments($_SESSION['user']['id']) as $row) {
                ?>

                    <tr>
                        <td><?= $row['ap_date'] ?></td>
                        <td><?= $row['start_time'] ?></td>
                        <td><?= $row['end_time'] ?></td>
                        <td><?= $row['fees'] ?></td>
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