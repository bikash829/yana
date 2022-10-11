<!-- Password change modal -->

<div class="modal fade" id="change_admin_pass" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chnage Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../backend/manage_admin.php" method="POST" class="row g-3 needs-validation">
                    <!-- password section  -->

                    <input type="hidden" name="user_id" value="<?= $_SESSION[$user]['id'] ?>">

                    <div class="input-group has-validation">
                        <input name="current_pass" type="password" class="form-control" minlength="8" placeholder="Current Password" required>
                        <div class="invalid-feedback">
                            Please insert your current password
                        </div>

                    </div>

                    <div class="input-group has-validation">
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
                    </div>

                    <div class="col-12 d-grid">
                        <button name="btn_change_pass" value="change_pass" type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- email change modal -->
<div class="modal fade" id="change_admin_email" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Change Email</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="../backend/manage_admin.php" method="POST" class="row g-3 needs-validation">
                    <!-- email section  -->
                    <input type="hidden" name="user_id" value="<?= $_SESSION[$user]['id'] ?>">
                    <div class="input-group has-validation">
                        <input name="email" type="email" class="form-control" placeholder="Your new email" required>
                        <div class="invalid-feedback">
                            Please insert your email id
                        </div>

                    </div>

                    <div class="input-group has-validation">
                        <input name="password" type="password" class="form-control" placeholder="Your Password" required>
                        <div class="invalid-feedback">
                            Please insert your password here.
                        </div>

                    </div>


                    <div class="col-12 d-grid">
                        <button name="btn_change_email" value="change_email" type="submit" class="btn btn-primary">Change Email</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>