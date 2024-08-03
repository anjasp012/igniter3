<!doctype html>
<html lang="en">

<head>
    <?php $this->load->view("_partials/head.php") ?>
    <link rel="stylesheet" href="<?php echo base_url('/assets/adminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?> ">
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">

        <!-- Preloader -->
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="<?php echo base_url('/assets/adminLTE/dist/img/AdminLTELogo.png') ?>" alt="AdminLTELogo" height="60" width="60">
        </div>

        <?php $this->load->view("_partials/navbar.php") ?>
        <?php $this->load->view("_partials/sidebar.php") ?>


        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Users</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="<?= base_url('dashboard') ?>">Dashboard</a></li>
                                <li class="breadcrumb-item active">Users</li>
                            </ol>
                        </div>
                    </div>
                </div><!-- /.container-fluid -->
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <form action="<?= base_url('users') ?>" method="post" class="row">
                        <div class="col-md-9">
                            <!-- /.card -->

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Edit User</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="ouname">Ouname</label>
                                                <input type="text" class="form-control" id="ouname" placeholder="ouname" value="<?= $user['ouname'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="oucode">oucode</label>
                                                <input type="text" class="form-control" id="oucode" placeholder="oucode" value="<?= $user['oucode'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cluster_id">cluster_id</label>
                                                <input type="text" class="form-control" id="cluster_id" placeholder="cluster_id" value="<?= $user['cluster_id'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="login_name">login_name</label>
                                                <input type="text" class="form-control" id="login_name" placeholder="login_name" value="<?= $user['login_name'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="first_name">First name</label>
                                                <input type="text" class="form-control" id="first_name" placeholder="first_name" value="<?= $user['first_name'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="last_name">Last name</label>
                                                <input type="text" class="form-control" id="last_name" placeholder="last_name" value="<?= $user['last_name'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="full_name">Full name</label>
                                                <input type="text" class="form-control" id="full_name" placeholder="full_name" value="<?= $user['full_name'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="gender">Gender</label>
                                                <select name="gender" id="gender" class="form-control">
                                                    <option value="<?= null ?>" selected disabled>choose gender</option>
                                                    <option value="male">Male</option>
                                                    <option value="female">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="email">Email</label>
                                                <input type="email" class="form-control" id="email" placeholder="Email" value="<?= $user['email'] ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="password">Password <small class="text-danger">(leave the password blank if you don't want to change it)</small></label>
                                                <input type="password" class="form-control" id="password" placeholder="password" value="<?= null ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="full_address">Full address</label>
                                                <textarea name="full_address" id="full_address" class="form-control" placeholder="Full address"><?= $user['full_address'] ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        <div class="col-md-3">
                            <div class="card">
                                <div class="card-header">Actions</div>
                                <div class="card-body">
                                    <a class="btn btn-secondary btn-block mb-2" href="<?php echo base_url('users'); ?>"><i class="fas fa-arrow-left"></i> Cancel</a>
                                    <a href="#" class="btn btn-danger btn-delete btn-block mb-2" data-url="<?php echo base_url('users/delete/' . $user['id']); ?>"><i class="fas fa-trash"></i> Delete</a>
                                    <button class="btn btn-primary btn-block"><i class="fas fa-edit"></i> Save</button>
                                </div>
                            </div>
                        </div>
                        <!-- /.col -->
                    </form>
                    <!-- /.row -->
                </div>
                <!-- /.container-fluid -->
            </section>
            <!-- /.content -->
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            <div class="float-right d-none d-sm-block">
                <b>Version</b> 3.2.0
            </div>
            <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights
            reserved.
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <?php $this->load->view("_partials/js.php") ?>
    <script src="<?php echo base_url('/assets/adminLTE/dist/js/adminlte.js') ?>"></script>
    <script src="<?php echo base_url('/assets/adminLTE/dist/js/demo.js') ?>"></script>
    <script src="<?php echo base_url('/assets/adminLTE/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>
    <script>
        $('.btn-delete').on('click', function(e) {
            e.preventDefault(); // Prevent the default link behavior

            var url = $(this).data('url'); // Get the URL from the data-url attribute

            // Show SweetAlert confirmation
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'No, cancel!'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Redirect to the URL to perform the deletion
                    window.location.href = url;
                }
            });
        });
    </script>

</body>

</html>
