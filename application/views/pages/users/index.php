<!doctype html>
<html lang="en">

<head>
    <?php $this->load->view("_partials/head.php") ?>
    <link rel="stylesheet" href="<?php echo base_url('/assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('/assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('/assets/adminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">
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
                    <div class="row">
                        <div class="col-12">
                            <!-- /.card -->

                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">DataTable with default features</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama lengkap</th>
                                                <th>Email</th>
                                                <th>Jenis kelamin</th>
                                                <th>Alamat lengkap</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($users as $no => $user) : ?>
                                                <tr>
                                                    <td><?= $no + 1 ?></td>
                                                    <td><?= $user['full_name'] ?></td>
                                                    <td><?= $user['email'] ?></td>
                                                    <td><?= $user['gender'] ?></td>
                                                    <td><?= $user['full_address'] ?></td>
                                                    <td>
                                                        <a data-full_name="<?= $user['full_name'] ?>" data-id="<?php echo $user['id'] ?>" class="btn btn-sm btn-info btn-detail">Detail</a>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama lengkap</th>
                                                <th>Email</th>
                                                <th>Jenis kelamin</th>
                                                <th>Alamat lengkap</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </tfoot>
                                    </table>

                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
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
    <script src="<?php echo base_url('/assets/adminLTE/plugins/datatables/jquery.dataTables.min.js') ?>"></script>
    <script src="<?php echo base_url('/assets/adminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') ?>"></script>
    <script src="<?php echo base_url('/assets/adminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js') ?>"></script>
    <script src="<?php echo base_url('/assets/adminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') ?>"></script>
    <script src="<?php echo base_url('/assets/adminLTE/plugins/datatables-buttons/js/dataTables.buttons.min.js') ?>"></script>
    <script src="<?php echo base_url('/assets/adminLTE/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') ?>"></script>
    <script src="<?php echo base_url('/assets/adminLTE/plugins/jszip/jszip.min.js') ?>"></script>
    <script src="<?php echo base_url('/assets/adminLTE/plugins/pdfmake/pdfmake.min.js') ?>"></script>
    <script src="<?php echo base_url('/assets/adminLTE/plugins/pdfmake/vfs_fonts.js') ?>"></script>
    <script src="<?php echo base_url('/assets/adminLTE/plugins/datatables-buttons/js/buttons.html5.min.js') ?>"></script>
    <script src="<?php echo base_url('/assets/adminLTE/plugins/datatables-buttons/js/buttons.print.min.js') ?>"></script>
    <script src="<?php echo base_url('/assets/adminLTE/plugins/datatables-buttons/js/buttons.colVis.min.js') ?>"></script>
    <script src="<?php echo base_url('/assets/adminLTE/dist/js/adminlte.js') ?>"></script>
    <script src="<?php echo base_url('/assets/adminLTE/dist/js/demo.js') ?>"></script>
    <script src="<?php echo base_url('/assets/adminLTE/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>

    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        });
    </script>
    <script src="<?php echo base_url('/assets/js/createModal.js') ?>"></script>
    <script>
        var bool_change = false;
        var id = null;
        var baseUrl = '<?php echo base_url(); ?>';
        $('.btn-detail').click(function(e) {
            e.preventDefault();
            var full_name = $(this).data('full_name');
            id = $(this).data('id');
            var iframe = `<object type="text/html" data="${baseUrl}users/detail/${id}" width="100%" height="99%">No Support</object>`;
            $.createModal({
                title: `Detail user ${full_name}`,
                message: iframe,
                closeButton: false,
                editButton: true,
                scrollable: true
            });
        });
        window.addEventListener('message', function(event) {
            if (event.data === 'formChanged') {
                bool_change = true;
            }
            if (event.data === 'closeModal') {
                if (bool_change) {
                    if (confirm('You have unsaved changes. Are you sure you want to close?')) {
                        bool_change = false; // Reset the flag
                        $('#Modal').modal('hide'); // Close the modal
                    }
                } else {
                    $('#Modal').modal('hide'); // Close the modal if no unsaved changes
                }
            }
            if (event.data === 'deleteModal') {
                if (confirm('Are you sure you want to delete?')) {
                    bool_change = false;
                    id = id;
                    $('#Modal').modal('hide');
                    location.href = `<?php echo base_url('users/delete/'); ?>${id}`;
                }
            }
            if (event.data === 'submitModal') {
                bool_change = false; // Reset the flag
                $('#Modal').modal('hide'); // Close the modal
                location.reload();
            }
        });
    </script>

</body>

</html>
