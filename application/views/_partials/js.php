<script src="<?php echo base_url('/assets/adminLTE/plugins/jquery/jquery.min.js') ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('/assets/adminLTE/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="<?php echo base_url('/assets/adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<script>
    $('#logout').on('click', function(event) {
        event.preventDefault();
        if (confirm('Are you sure you want to log out?')) {
            window.location.href = '<?= base_url('logout') ?>';
        }
    });
</script>
