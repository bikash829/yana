<!-- Password change modal -->
<div class="modal fade" id="make_appointment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Make An Appointment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <!-- password section  -->
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

                        ?>

                            <tr>
                                <td><?=$row['ap_date']?></td>
                                <td><?=$row['start_time']?></td>
                                <td><?=$row['end_time']?></td>
                                <td><?=$row['patient_capacity']?></td>
                                <td><?=$row['fees']?></td>
                                <td><a class="btn btn-sm btn-primary" href="./backend/appointment_booking.php?appointment_id=<?=$row['id']?>&uid=<?=$_SESSION['user']['id']?>">Booking</a></td>
                                <td><?=$row['description']?></td>
                            </tr>
                        <?php
                        }

                        ?>


                    </tbody>
                </table>




                <!-- <div class="input-group has-validation">
                        <input name="password" type="password" class="form-control" id="password" minlength="8" placeholder="Password" required>
                        <div class="invalid-feedback">
                            Please choose a strong password.
                        </div>

                    </div>

                    <div class="input-group has-validation">
                        <input name="confirm_pass" type="password" class="form-control" id="confirm_pass" placeholder="Confirm Password" required>
                        <div class="invalid-feedback">
                            Password didn't match.
                        </div>
                    </div> -->


                </form>
            </div>
        </div>
    </div>
</div>