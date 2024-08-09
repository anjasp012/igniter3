<!doctype html>
<html lang="en">

<head>
    <?php $this->load->view("_partials/head.php") ?>
    <link rel="stylesheet" href="<?php echo base_url('/assets/adminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?> ">
</head>

<body>

    <form id="modal-form" action="<?php echo base_url('users/update/' . $user['id']) ?>" method="post">
        <div class="form-group">
            <label for="login_name">Login name</label>
            <input type="text" class="form-control" id="login_name" name="login_name" placeholder="Login name" value="<?= $user['login_name'] ?>">
        </div>
        <div class="form-group">
            <label for="full_name">Full name</label>
            <input type="text" class="form-control" id="full_name" name="full_name" placeholder="Full name" value="<?= $user['full_name'] ?>">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Email" value="<?= $user['email'] ?>">
        </div>
        <div class="form-group">
            <label for="password">Password <span class="text-danger"><small>(Kosongkan jika tidak ingin di ubah)</small></span></label>
            <input type="password" class="form-control" name="password" id="password" placeholder="password" value="<?= null ?>">
        </div>
        <div class="form-group">
            <label for="gender">Gender</label>
            <select class="form-control" name="gender" id="gender">
                <option value="<?= null ?>" selected disabled>Jenis Kelamin</option>
                <option value="LAKI-LAKI" <?= $user['gender'] == 'LAKI-LAKI' ? 'selected' : '' ?>>LAKI-LAKI</option>
                <option value="PEREMPUAN" <?= $user['gender'] == 'PEREMPUAN' ? 'selected' : '' ?>>PEREMPUAN</option>
            </select>
        </div>
        <div class="form-group">
            <label for="place_of_birth">Tempat lahir</label>
            <input name="place_of_birth" id="place_of_birth" class="form-control" placeholder="Tempat lahir" value="<?= $user['place_of_birth'] ?>">
        </div>
        <div class="form-group">
            <label for="date_of_birth">Tanggal lahir</label>
            <input type="date" name="date_of_birth" id="date_of_birth" class="form-control" placeholder="Full address" value="<?= $user['date_of_birth'] ?>">
        </div>
        <div class="form-group">
            <label for="full_address">Full adress</label>
            <textarea name="full_address" id="full_address" class="form-control" placeholder="Full address"><?= $user['full_address'] ?></textarea>
        </div>
        <div class="form-group">
            <label for="ip_address">IP Address</label>
            <textarea name="ip_address" id="ip_address" class="form-control" placeholder="IP Address"><?= $user['ip_address'] ?></textarea>
        </div>
        <button id="btn-save" class="btn btn-success" type="submit">Simpan</button>
        <button id="btn-cancel" type="button" class="btn btn-secondary">Batal</button>
        <button id="btn-delete" class="btn btn-danger" type="button">Hapus</button>
    </form>

    <?php $this->load->view("_partials/js.php") ?>
    <script src="<?php echo base_url('/assets/adminLTE/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>

    <script>
        var boolChange = false;

        // Detect changes in form fields
        $('#modal-form input, #modal-form select, #modal-form textarea').on('change', function() {
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
                        window.parent.postMessage('submitModal', '*');
                        $('.btn-save').html(`<i class="fas fa-check"></i>`);
                        $('.btn-save').attr('disabled', true);

                    } else {
                        $('.btn-save').html(`Simpan`);
                    }
                },
            });
        });

        $('#btn-delete').click(function() {
            $('#btn-delete').html(`<div class="spinner-border" style="width: 16px;height: 16px;" role="status"></div>`);
            if (confirm('Are you sure you want to delete?')) {
                boolChange = false;
                $.ajax({
                    url: `<?php echo base_url('users/delete/' . $user['id']); ?>`,
                    dataType: 'json',
                    success: function(response) {
                        window.parent.postMessage('deleteModal', '*');
                    },
                });
            } else{
                $('#btn-delete').html(`Hapus`);
            }
        })
        $('#btn-cancel').click(function() {
            window.parent.postMessage('closeModal', '*');
        })
    </script>

</body>

</html>
