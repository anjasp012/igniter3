<!doctype html>
<html lang="en">

<head>
    <?php $this->load->view("_partials/head.php") ?>
    <link rel="stylesheet" href="<?php echo base_url('/assets/adminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?> ">
</head>

<body>
    <form action="<?php echo base_url('users/update/' . $user['id']) ?>" method="post">
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
    </form>

    <?php $this->load->view("_partials/js.php") ?>
    <script src="<?php echo base_url('/assets/adminLTE/dist/js/adminlte.js') ?>"></script>
    <script src="<?php echo base_url('/assets/adminLTE/dist/js/demo.js') ?>"></script>
    <script src="<?php echo base_url('/assets/adminLTE/plugins/sweetalert2/sweetalert2.min.js') ?>"></script>

</body>

</html>
