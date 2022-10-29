<?php
session_start();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Login - SB Admin</title>
    <link href="css/styles.css" rel="stylesheet" />
    <link rel="stylesheet" href="../vendor/bootstrap-5.2.0-dist/css/bootstrap.min.css">
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

    <!-- sweet alert  -->
    <script src="../vendor/alert/dist/sweetalert2.all.min.js"></script>

</head>

<body class="bg-primary">
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5">
                            <div class="card shadow-lg border-0 rounded-lg mt-5">
                                <div class="card-header">
                                    <h3 class="text-center font-weight-light my-4">Login</h3>
                                </div>
                                <div class="card-body">
                                    <form method="POST" action="../backend/login.php">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="email" id="inputEmail" type="email" placeholder="name@example.com" />
                                            <label for="inputEmail">Email address</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" name="pass" id="inputPassword" type="password" placeholder="Password" />
                                            <label for="inputPassword">Password</label>
                                        </div>
                                        <div class="form-check mb-3">
                                            <input class="form-check-input" name="remember" id="inputRememberPassword" type="checkbox" value="" />
                                            <label class="form-check-label" for="inputRememberPassword">Remember Password</label>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <a class="small" href="password.php">Forgot Password?</a>
                                            <button class="btn btn-primary" name="btn-admin-login">Login</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center py-3">
                                    <div class="small"><a href="#" data-bs-toggle="modal" data-bs-target="#register_popup_admin">Need an account? Sign up!</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Your Website 2022</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <?php
    include "../modals/register_modal.php";

    ?>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script> -->
    <script src="../vendor/bootstrap-5.2.0-dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>

    <?php

    if (isset($_SESSION['login_status'])) {
        $login_status = $_SESSION['login_status'];
        unset($_SESSION['login_status']);
        if (!($login_status['status'])) {
            unset($login_status['status']);
            $message = '';
            foreach ($login_status as $text) {
                $message .= $text;
            }
            $login_status = json_encode(array('message' => $message, 'status' => 'error'));
        } else {
            echo "something bad happend";
        }
    }


    ?>

    <script type="text/javascript">
        // let login_status = <?php if (isset($login_status)) {
                                    echo $login_status;
                                } else {
                                    echo 0;
                                } ?>

        // console.log(login_status)
        const php_msg = <?php if (isset($login_status)) {
                            echo $login_status;
                        } ?>;

        let login_status = php_msg ? php_msg : null;

        if (login_status != null) {
            Swal.fire({
                position: 'top-end',
                icon: login_status['status'],
                title: login_status['message'],
                showConfirmButton: false,
                timer: 3000
            })
        }
    </script>



    <!-- popup alert  -->
    <?php
    include "../functionalities/alert.php";


    if (isset($_SESSION['change_admin_pass'])) {
        $alert_status = alert($_SESSION['change_admin_pass']);
        unset($_SESSION['change_admin_pass']);
    }elseif(isset($_SESSION['email_changed'])){
        $alert_status = alert($_SESSION['email_changed']);
        unset($_SESSION['email_changed']);
    } else {
        $alert_status = false;
    }
    ?>

    <script type="text/javascript">
        // validation message 
        alertStatus = <?= json_encode($alert_status ?? null) ?>;
        if (alertStatus) {
            Swal.fire({
                position: 'top-end',
                icon: alertStatus.status,
                title: alertStatus.message,
                showConfirmButton: false,
                timer: 2500
            })
        }
    </script>
</body>

</html>