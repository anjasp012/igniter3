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
        <div class="form-group">
            <label for="allow_access">Allow Access</label>
            <input type="text" class="form-control" name="allow_access" id="allow_access" placeholder="Allow Access" value="<?= $user_access['allow_access'] ?>" readonly>
        </div>
        <div class="form-group">
            <label>Expired time</label>
            <input type="text" class="form-control" name="expired_time" value="<?= $user_access['expired_time'] != null ? date('m/d/Y h:i A', strtotime($user_access['expired_time'])) : null ?>" readonly>
        </div>
        <a href="<?= base_url('useraccess/edit/' . $user_access['system_user_id'] . '/' . $user_access['id']) ?>" class="btn btn-warning">Edit</a>
    </form>

    <?php $this->load->view("_partials/js.php") ?>
</body>

</html>
