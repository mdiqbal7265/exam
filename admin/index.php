<?php

session_start();
if (isset($_SESSION['email'])) {
    header('location: dashboard.php');
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Amuse Exam | Log in</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="index.php" class="h1"><img src="../assets/img/footer-logo.png" alt=""></a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="" method="post" id="login-form">
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="rem">
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <input type="submit" value="Sign In" class="btn btn-primary btn-block" id="login-btn">
                            <!-- <button type="submit" class="btn btn-primary btn-block">Sign In</button> -->
                            <button class="btn btn-primary btn-block" type="button" id="spinner" style="display: none;">
                                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                <span class="sr-only">Loading...</span>
                            </button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- SweetAlert2 -->
    <script src="assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.min.js"></script>
    <script>
        $(document).ready(function() {

            var Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 5000
            });

            $("#login-btn").click(function(e) {
                e.preventDefault();
                $("#login-btn").hide();
                $("#spinner").show();
                if ($("#email").val() == '' || $("#password").val() == '') {
                    $("#login-btn").show();
                    $("#spinner").hide();
                    Toast.fire({
                        icon: "warning",
                        title: "Email and password field must be required!"
                    });
                } else {
                    $.ajax({
                        type: "POST",
                        url: "../lib/admin.php",
                        data: $("#login-form").serialize() + '&action=admin_login',
                        success: function(response) {
                            $("#login-btn").show();
                            $("#spinner").hide();
                            $("#login-form")[0].reset();
                            if (response == 'login') {
                                Toast.fire({
                                    icon: "success",
                                    title: "Login Successfully. Please wait we will redirect you in dashboard!"
                                });
                                setTimeout(function() {
                                    window.location = "dashboard.php";
                                }, 4000);
                            } else if (response == 'password_not_matched') {
                                Toast.fire({
                                    icon: "error",
                                    title: "password didn't matched. Please try again letter!"
                                });
                            } else if (response == 'data_not_found') {
                                Toast.fire({
                                    icon: "error",
                                    title: "We didn't find your email in our database.!"
                                });
                            }
                            console.log(response);
                        }
                    });
                }

            });
        });
    </script>
</body>

</html>