<?php
require("conf/db_conn.php");
$id = $_GET['id'];
$query = "SELECT * FROM tb_user where id = '$id'";
$result = mysqli_query($conn, $query);
$row = mysqli_fetch_array($result);
//var_dump($row);
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0">Kelola Data <i class="fas fa-angle-right"></i> Pengguna</h1>
            </div>
        </div>
    </div>
</div>
<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <!-- jQuery validation -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Ubah Data</h3>
                    </div>
                    <!-- form start -->
                    <form id="tambahUser" action="proses/user/proses_ubah_user.php" method="post">
                        <input type="hidden" value="<?= $row['id']; ?>" name="id">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="username">Nama Pengguna</label>
                                <input type="text" name="username" class="form-control" id="username" placeholder="Masukkan nama pengguna..." value="<?= $row['username'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Alamat Email</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="Masukkan email..." value="<?= $row['email'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="no_hp">Nomor Handphone</label>
                                <input type="text" name="no_hp" class="form-control" id="no_hp" placeholder="Masukkan nomor handphone..." value="<?= $row['no_hp'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="password">Kata Sandi</label>
                                <input type="password" name="password" class="form-control" id="password" placeholder="Masukkan kata sandi...">
                            </div>
                            <div class="form-group">
                                <label for="retype_password">Ulangi Kata Sandi</label>
                                <input type="password" name="retype_password" class="form-control" id="retype_password" placeholder="Ketik ulang kata sandi..." disabled>
                            </div>
                            <div class="form-group mb-0">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" name="ubah_password" class="custom-control-input" id="ubah_password" onclick="disablePassword(this)">
                                    <label class="custom-control-label" for="ubah_password">Ubah Kata Sandi</label>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ./content -->

<!-- Include your JavaScript function to disable/enable password fields here -->
<script>
function disablePassword(checkbox) {
    const passwordField = document.getElementById('password');
    const retypePasswordField = document.getElementById('retype_password');
    if (checkbox.checked) {
        passwordField.disabled = false;
        retypePasswordField.disabled = false;
    } else {
        passwordField.disabled = true;
        retypePasswordField.disabled = true;
    }
}
</script>
