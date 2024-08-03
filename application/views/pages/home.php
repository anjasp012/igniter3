<!doctype html>
<html lang="en">

<head>
    <?php $this->load->view("_partials/head.php") ?>
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
                    <img src="<?php echo base_url('/assets/adminLTE/dist/img/picture_login.jpg') ?>" width="100%">
                    <p class="text-center mt-2" style="font-size: 14px;color: #333;"><b>Selamat Datang di Situs
                            Pelayanan
                            Antrian Poli
                            Spesialis</b></p>
                    <h3 class="text-center" style="font-size: 24px;color: #333;margin-bottom: 20px;">RUMKIT TK.III
                        BALADHIKA HUSADA</h3>
                    <a href="<?php echo base_url() ?>login" class="btn btn-block btn-dark mb-3" style="font-weight: 600;font-size: 14px;background-color: #172554;">
                        MASUK
                    </a>
                    <a href="<?php echo base_url() ?>register" class="btn btn-block btn-dark" style="font-weight: 600;font-size: 14px;background-color: #172554;">
                        REGISTER
                    </a>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
    </div>

    <?php $this->load->view("_partials/js.php") ?>
    <script>
        $(document).ready(function() {
            $(".btn-login").click(function() {

                var email = $("#email").val();
                var password = $("#password").val();

                if (email.length == "") {
                    toastr.warning('<div class="toast-title">Peringatan</div><div class="toast-message">Silahkan mengisi Email</div>')

                } else if (password.length == "") {

                    toastr.warning('<div class="toast-title">Peringatan</div><div class="toast-message">Silahkan mengisi Password</div>')

                } else {

                    $.ajax({

                        url: "<?php echo base_url() ?>login/check_auth",
                        type: "POST",
                        data: {
                            "email": email,
                            "password": password
                        },

                        success: function(response) {

                            if (response == "success") {

                                toastr.success('<div class="toast-title">Login Berhasil!</div><div class="toast-message">Anda akan di arahkan dalam 3 Detik</div>')
                                setTimeout(function() {
                                    window.location.href = "<?php echo base_url() ?>";
                                }, 3000);

                            } else {

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
