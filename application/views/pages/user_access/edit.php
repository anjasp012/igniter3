<!doctype html>
<html lang="en">

<head>
    <?php $this->load->view("_partials/head.php") ?>
    <link rel="stylesheet" href="<?php echo base_url('/assets/adminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?> ">
</head>

<body style="background-color: #86C0E6;">

    <form id="modal-form" action="<?php echo base_url('useraccess/update/' . $user_access['system_user_id'] . '/' . $user_access['id']) ?>" method="post">
        <div class="form-group">
            <label for="actor_code">Actor code</label>
            <input type="text" class="form-control" id="actor_code" name="actor_code" placeholder="Actor code" value="<?= $user_access['actor_code'] ?>">
        </div>
        <div class="form-group">
            <label for="allow_access">Allow Access</label>
            <input type="text" class="form-control" name="allow_access" id="allow_access" placeholder="Allow Access" value="<?= $user_access['allow_access'] ?>">
        </div>
        <div class="form-group">
            <label>Expired time</label>
            <div class="input-group date" id="expired_time" data-target-input="nearest">
                <div class="input-group-prepend" data-target="#expired_time" data-toggle="datetimepicker">
                    <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                </div>
                <input type="text" class="form-control datetimepicker-input" data-target="#expired_time" data-toggle="datetimepicker" name="expired_time" value="<?= $user_access['expired_time'] != null ? date('m/d/Y h:i A', strtotime($user_access['expired_time'])) : null ?>">
            </div>
        </div>

        <div class="d-flex justify-content-between">
            <div>
                <button id="btn-save" class="btn btn-success" type="submit">Simpan</button>
                <button id="btn-cancel" type="button" class="btn btn-secondary">Batal</button>

            </div>
            <button id="btn-delete" class="btn btn-danger" type="button">Hapus</button>
        </div>

    </form>

    <?php $this->load->view("_partials/js.php") ?>
    <script src="<?php echo base_url('/assets/adminLTE/plugins/moment/moment.min.js') ?>"></script>
    <script src="<?php echo base_url('/assets/adminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') ?>"></script>

    <script>
        var boolChange = false;

        //Date and time picker
        $('#expired_time').datetimepicker({
            icons: {
                time: 'far fa-clock'
            }
        });

        // Detect changes in form fields
        $('#modal-form input').on('change', function() {
            boolChange = true;
            window.parent.postMessage('formChanged', '*');
        });

        $('#modal-form').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var formData = form.serialize(); // Serialize form data
            $('#btn-save').html(`<div class="spinner-border" style="width: 16px;height: 16px;" role="status"></div>`);
            $.ajax({
                url: form.attr('action'),
                type: 'POST',
                data: formData,
                success: function(response) {
                    var response = JSON.parse(response);

                    if (response.success) {
                        boolChange = false;
                        $('.btn-save').html(`<i class="fas fa-check"></i>`);
                        $('.btn-save').attr('disabled', true);
                        window.location = "<?= base_url('useraccess/index/' . $user_access['system_user_id']) ?>"
                    } else {
                        $('.btn-save').html(`Simpan`);
                    }
                },
            });
        });
        $('#btn-delete').click(function() {
            var deleteModal = function() {
                boolChange = false;
                $('#btn-delete').html(`<div class="spinner-border" style="width: 16px;height: 16px;" role="status"></div>`);
                $.ajax({
                    url: `<?php echo base_url('useraccess/delete/' . $user_access['system_user_id'] . '/' . $user_access['id']); ?>`,
                    dataType: 'json',
                    success: function(response) {
                        window.parent.postMessage('deleteModal', '*');
                    },
                });
                $.fallr.hide();
            };

            $.fallr.show({
                buttons: {
                    button1: {
                        text: 'Yes',
                        danger: true,
                        onclick: deleteModal
                    },
                    button2: {
                        text: 'No'
                    }
                },
                content: '<p>Are you sure you want to delete??</p>',
                icon: 'error',
                position: 'center',
                closeKey: false,
                useOverlay: false
            });
        })
        $('#btn-cancel').click(function() {
            window.parent.postMessage('closeModal', '*');
        })
    </script>
</body>

</html>
