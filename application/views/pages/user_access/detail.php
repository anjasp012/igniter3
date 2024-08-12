<!doctype html>
<html lang="en">

<head>
    <?php $this->load->view("_partials/head.php") ?>
    <link rel="stylesheet" href="<?php echo base_url('/assets/adminLTE/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') ?> ">
</head>

<body style="background-color: #86C0E6;">
    <form method="post">
        <div class="form-group">
            <label for="actor_code">Actor code</label>
            <input type="text" class="form-control" id="actor_code" name="actor_code" placeholder="Actor code" disabled value="<?= $user_access['actor_code'] ?>">
        </div>
        <a href="<?= base_url('access/edit/' . $user_access['system_user_id'] . '/' . $user_access['id']) ?>" class="btn btn-warning">Edit</a>
    </form>

    <?php $this->load->view("_partials/js.php") ?>
</body>

</html>
