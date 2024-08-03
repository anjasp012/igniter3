<!doctype html>
<html lang="en">

<head>
    <?php $this->load->view("_partials/head.php") ?>
    <link rel="stylesheet" href="<?php echo base_url('/assets/adminLTE/plugins/toastr/toastr.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('/assets/adminLTE/dist/css/custom.css') ?>">
</head>



<body class="hold-transition home-page" style="background: url('<?php echo base_url('/assets/adminLTE/dist/img/blur-background09.jpg') ?>');">
    <header>
        <nav class="navbar navbar-expand navbar-blue-dark bg-blue-dark fixed-top">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?php echo base_url() ?>" class="nav-link"><i class="nav-icon fas fa-home mr-1"></i> Home</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?php echo base_url() ?>login" class="nav-link">Masuk</a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="<?php echo base_url() ?>register" class="nav-link">Register</a>
                </li>
            </ul>
        </nav>
    </header>
    <div class="d-flex flex-column  justify-content-center align-items-center" style="min-height: 100vh;">
        <div class="login-box">
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <form id="form-login">
                        <img src="<?php echo base_url('/assets/adminLTE/dist/img/picture_login.jpg') ?>" width="100%">
                        <p class="text-center mt-2" style="font-size: 14px;color: #333;"><b>Silahkan Login</b></p>

                        <div class="input-group mb-3">
                            <input type="email" id="email" class="form-control" placeholder="Email">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" id="password" class="form-control" placeholder="Password">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-block btn-dark btn-login" style="font-weight: 600;font-size: 14px;background-color: #172554;">
                            MASUK
                        </button>
                        <p class="text-center" style="margin-bottom: 10px;"><small>Belum punya akun? <a href="<?php echo base_url() ?>register" id="daftar-mode">Daftar
                                    sekarang
                                </a>
                            </small>
                        </p>

                        <div class="social-auth-links text-center mb-3">
                            <p>- ATAU -</p>
                            <a href="<?= $google_auth ?>" class="btn btn-block btn-danger">
                                <i class="fab fa-google-plus mr-2"></i> Login dengan Google
                            </a>
                        </div>
                    </form>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
    </div>

    <?php $this->load->view("_partials/js.php") ?>
    <script src="<?php echo base_url('/assets/adminLTE/plugins/toastr/toastr.min.js') ?>"></script>
    <script src="<?php echo base_url('/assets/adminLTE/dist/js/adminlte.js') ?>"></script>
    <script>
        $(document).ready(function() {
            $("#form-login").submit(function(e) {
                e.preventDefault();
                var email = $("#email").val();
                var password = $("#password").val();

                if (email.length == "") {
                    toastr.warning('<div class="toast-title">Peringatan</div><div class="toast-message">Silahkan mengisi Email</div>')

                } else if (password.length == "") {

                    toastr.warning('<div class="toast-title">Peringatan</div><div class="toast-message">Silahkan mengisi Password</div>')

                } else {
                    $('.btn-login').html(`<div class="spinner-border" style="width: 16px;height: 16px;" role="status"></div>`);
                    $.ajax({
                        url: "<?php echo base_url() ?>login/check_auth",
                        type: "POST",
                        data: {
                            "email": email,
                            "password": password
                        },


                        success: function(response) {

                            if (response == "success") {
                                $('.btn-login').html(`<i class="fas fa-check"></i>`);
                                $('.btn-login').attr('disabled', true);
                                toastr.success('<div class="toast-title">Login Berhasil!</div><div class="toast-message">Anda akan di arahkan dalam 3 Detik</div>')
                                setTimeout(function() {
                                    window.location.href = "<?php echo base_url('dashboard') ?>";
                                }, 3000);

                            } else {
                                $('.btn-login').html(`MASUK`);
                                toastr.error('<div class="toast-title">Peringatan</div><div class="toast-message">silahkan coba lagi</div>')
                            }

                        },

                        error: function(response) {
                            toastr.error('<div class="toast-title">Opps</div><div class="toast-message">Server error</div>')
                        }

                    });

                }

            });

        });
    </script>

</body>

</html>
