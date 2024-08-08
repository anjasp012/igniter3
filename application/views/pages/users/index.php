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
                                    <div class="d-flex justify-content-between w-100">
                                        <h3 class="card-title">Lists user</h3>
                                        <div class="btn btn-dark btn-sm" id="reload"> <i class="far fa-circle mr-1"></i>Reload</div>
                                    </div>
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

    <script src="<?php echo base_url('/assets/js/createModal.js') ?>"></script>
    <script>
        // let table;
        $(document).ready(function() {
            table = $('#example1').DataTable({
                "responsive": true,
                "processing": true,
                "serverSide": true,
                "lengthChange": true,
                "ordering": true,
                "searching": true,
                "autoWidth": false,
                "info": true,
                "order": [],

                "ajax": {
                    "url": "<?php echo base_url('users/data_table'); ?>",
                    "type": "POST"
                },

                "columnDefs": [{
                    "targets": [0],
                    "orderable": false,
                    "className": 'text-center',
                }],

                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
            });

            $('#reload').on('click', function() {
                table.ajax.reload(); // Memuat ulang data dari server
            });


            var bool_change = false;
            var id = null;
            var baseUrl = '<?php echo base_url(); ?>';
            $(document).on('click', '.btn-detail', function(e) {
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
                        table.ajax.reload();
                    }
                }
                if (event.data === 'submitModal') {
                    bool_change = false; // Reset the flag
                    $('#Modal').modal('hide'); // Close the modal
                    table.ajax.reload();
                }
            });
        });
    </script>

</body>

</html>
