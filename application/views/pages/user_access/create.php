<!doctype html>
<html lang="en">

<head>
    <?php $this->load->view("_partials/head.php") ?>
    <link rel="stylesheet" href="<?php echo base_url('/assets/adminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?> ">
</head>

<body style="background-color: #86C0E6;">

    <form id="modal-form" action="<?php echo base_url('useraccess/store/' . $system_user_id) ?>" method="post">
        <div class="form-group">
            <label for="actor_code">Actor code</label>
            <input type="text" class="form-control" id="actor_code" name="actor_code" placeholder="Actor code">
        </div>
        <div class="form-group">
            <label for="allow_access">Allow Access</label>
            <input type="text" class="form-control" name="allow_access" id="allow_access" placeholder="Allow Access">
        </div>
        <div class="form-group">
            <label for="expired_time">Expired time</label>
            <input type="date" class="form-control" name="expired_time" id="expired_time" placeholder="Expired time">
        </div>
        </div>
        <button id="btn-save" class="btn btn-success" type="submit">Simpan</button>
        <button id="btn-cancel" type="button" class="btn btn-secondary">Batal</button>
    </form>

    <?php $this->load->view("_partials/js.php") ?>
    <script>
        var boolChange = false;

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
                        window.location = "<?= base_url('useraccess/index/' . $system_user_id) ?>"
                    } else {
                        $('.btn-save').html(`Simpan`);
                    }
                },
            });
        });
        $('#btn-cancel').click(function() {
            window.parent.postMessage('closeModal', '*');
        })
    </script>
</body>

</html>
