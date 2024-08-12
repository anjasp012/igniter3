<script src="<?php echo base_url('/assets/adminLTE/plugins/jquery/jquery.min.js') ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('/assets/adminLTE/plugins/jquery-ui/jquery-ui.min.js') ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<script src="<?php echo base_url('/assets/adminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

<script src="<?php echo base_url('/assets/fallr-js/js/jquery-fallr-2.0.1.min.js') ?>"></script>
<script>
    $('#logout').on('click', function(event) {
        event.preventDefault();

        var logout = function() {
            window.location.href = '<?= base_url('logout') ?>';
            $.fallr.hide();
        };

        $.fallr.show({
            buttons: {
                button1: {
                    text: 'Yes',
                    danger: true,
                    onclick: logout
                },
                button2: {
                    text: 'Cancel'
                }
            },
            content: '<p>Are you sure you want to log out?</p>',
            icon: 'error',
            position: 'center',
            closeKey: false,
            useOverlay: false
        });

    });
</script>
