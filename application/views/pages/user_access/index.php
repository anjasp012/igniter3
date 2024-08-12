<!doctype html>
<html lang="en">

<head>
    <?php $this->load->view("_partials/head.php") ?>
    <link rel="stylesheet" href="<?php echo base_url('/assets/adminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('/assets/adminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('/assets/adminLTE/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?php echo base_url('/assets/adminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?> ">
    <style>
        #fallr-wrapper{
            z-index: 9999 !important;
        }
    </style>
</head>

<body style="background-color: #86C0E6;">
    <div class="d-flex justify-content-end mb-3">
        <a href="<?= base_url('useraccess/create/'.$system_user_id) ?>" class="btn btn-primary btn-sm mr-2">Add Access</a>
        <div class="btn btn-dark btn-sm" id="reload"> <i class="far fa-circle mr-1"></i>Reload</div>
    </div>
    <table id="useraccess" class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Access_code</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tfoot>
            <tr>
                <th>No</th>
                <th>Access_code</th>
                <th>Aksi</th>
            </tr>
        </tfoot>
    </table>
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

    <script>
        $('.content-wrapper').ready(function() {
            tableReload = $('#reload');
            table = $('#useraccess').DataTable({
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
                    "url": "<?php echo base_url('useraccess/data_table/'. $system_user_id); ?>",
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

            table.on('xhr', function(e, settings, json, xhr) {
                tableReload.html(`<i class="far fa-circle mr-1"></i>Reload`);
            });

            tableReload.on('click', function() {
                table.ajax.reload(); // Memuat ulang data dari server
                $(this).html(`<div class="spinner-border" style="width: 16px;height: 16px;" role="status"></div>`);
            });


        });
    </script>
</body>

</html>
