<!-- Sign in Modal -->
<div class="modal fade" id="login_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <div class=" bg-transparent">
            <div class="modal-body">
                <div class="d-flex justify-content-center h-100">
                    <!--start content-->
                    <div class="card sign_in_card modal-content">
                        <div class="card-header card_header d-flex">
                            <h3 class="p-2">Sign In</h3>
                            <button type="button" class="close ml-auto p-2" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="card-body">
                            <form action="backend/login.php" method="POST">
                                <div class="input-group form-group">
                                    <div class="input-group-prepend input_group">
                                        <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    </div>
                                    <input type="email" <?=$disable?> name="email" required class="form-control log_input" placeholder="username">

                                </div>
                                <div class="input-group form-group">
                                    <div class="input-group-prepend input_group">
                                        <span class="input-group-text"><i class="fas fa-key"></i></span>
                                    </div>
                                    <input type="password" <?=$disable?> name="pass" required class="form-control log_input" placeholder="password">
                                </div>
                                <div class="form-group text-warning">
                                    <?=$block_message?>
                                </div>
                                <div class="row align-items-center remember">
                                    <input class="log_input" type="checkbox">Remember Me
                                </div>
                                <div class="form-group">
                                    <input type="submit" <?=$disable?> value="Sign In" name='login' class="btn log_input float-right login_btn">
                                </div>
                            </form>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-center links">

                                Don't have an account?<a href="#">Sign Up</a>
                            </div>
                            <div class="d-flex justify-content-center">
                                <a href="#">Forgot your password?</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>