<?php
session_start();
if(!isset($_SESSION['email'])){
  echo '<script>alert("Anda harus login terlebih dahulu!"); 
  window.location.href="pages/user/login.php"</script>';
}else{
  if (session_status() == PHP_SESSION_NONE) { 
    session_start();
  }
}

$request_uri = $_SERVER['REQUEST_URI']; 
if(strpos($request_uri, '&') !== false) {
    $request_uri= substr($request_uri, 0, strpos($request_uri, '&'));
}
$adder = '/cuaca/';
$beranda = array($adder, $adder. 'index.php', $adder.'index.php?page=beranda');
$cuaca_active = array(
    $adder.'index.php?page=data_cuaca', 
    $adder.'index.php?page=tambah_cuaca', 
    $adder. 'index.php?page=ubah_cuaca',
);

$user_active= array( 
    $adder.'index.php?page=data_user',
    $adder.'index.php?page=tambah_user', 
    $adder. 'index.php?page=ubah_user',
);

$kelola_data = array_merge($cuaca_active, $user_active);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Cuaca</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="dist/css/adminlte.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <!-- Date Picker Tempusdominus Bootstrap4 -->
    <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
    <!-- Summernote -->
    <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="dist/css/custom.css">

    <!-- Hapus increase/decrease value on input type number -->
    <style>
        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fa fa-bars"></i></a>
            </li>
        </ul>
        <!-- Right navbar links -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                    <i class="fas fa-expand-arrows-alt"></i>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <!-- Brand Logo -->
        <a class="brand-link">
            <img src="image/polbeng.png" alt="Logo Polbeng" class="brand-image img-circle elevation-3" style="opacity: .8">
            <span class="brand-text font-weight-light">Cuaca App</span>
        </a>
        <!-- Sidebar -->
        <div class="sidebar">
            <!-- Sidebar user panel (optional) -->
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <img src="image/fiqri.jpg" class="img-circle elevation-2" alt="User Image">
                </div>
                <div class="info">
                    <a class="d-block"><?=$_SESSION['username']?></a>
                </div>
            </div>
            <!-- Sidebar Menu -->
            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                    <li class="nav-item">
                        <a href="index.php?page=beranda" class="nav-link <?= (in_array($request_uri, $beranda) ? 'active' : ''); ?>">
                            <i class="nav-icon fas fa-home"></i>
                            <p>Beranda</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-briefcase"></i>
                            <p>
                                Kelola Data
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if($_SESSION['role']=='Admin'){?>
                            <li class="nav-item">
                                <a href="index.php?page=data_user" class="nav-link <?= (in_array($request_uri, $user_active) ? 'active' : ''); ?>">
                                    <i class="far fa-user nav-icon"></i>
                                    <p>Pengguna</p>
                                </a>
                            </li>
                            <?php } ?>
                            <li class="nav-item">
                                <a href="index.php?page=data_cuaca" class="nav-link <?= (in_array($request_uri, $cuaca_active) ? 'active' : ''); ?>">
                                    <i class="fas fa-cloud-sun nav-icon"></i>
                                    <p>Data Cuaca</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="proses/user/proses_logout.php" class="nav-link">
                            <i class="nav-icon fas fa-sign-out-alt"></i>
                            <p>Logout</p>
                        </a>
                    </li>
                </ul>
            </nav>
            <!-- /.sidebar-menu -->
        </div>
        <!-- /.sidebar -->
    </aside>
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <?php include "conf/page.php";?>
    </div>
    <!-- /.content-wrapper -->
    <!-- Main Footer -->
    <footer class="main-footer">
        <!-- To the right -->
        <div class="float-right d-none d-sm-inline">
            Developed By: Fiqri Abdul Aziz
        </div>
        <!-- Default to the left -->
        <strong>Copyright &copy; 2023</strong> Admin LTE
    </footer>
</div>
<!-- /.wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- DataTables & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<!-- Moment -->
<script src="plugins/moment/moment.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- jQuery Validation -->
<script src="plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="plugins/jquery-validation/additional-methods.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- bs-custom-file-input -->
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>

<!-- Page specific script -->
<script>
    $(function () {
        // Data table cuaca
        $('#cuaca').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

        // Data table user
        $('#user').DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

        // Validasi form tambahUser
        $('#tambahUser').validate({
            rules: {
                username: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                no_hp: {
                    required: true,
                    rangelength: [10, 16]
                },
                password: {
                    required: true,
                    rangelength: [6, 25]
                },
                retype_password: {
                    required: true,
                    equalTo: '#password'
                }
            },
            messages: {
                username: {
                    required: "Masukkan username",
                    minlength: "Username minimal 3 karakter"
                },
                email: {
                    required: "Masukkan email",
                    email: "Masukkan email yang valid"
                },
                no_hp: {
                    required: "Masukkan nomor handphone",
                    rangelength: "Nomor handphone harus diantara 10-16 digit"
                },
                password: {
                    required: "Masukkan password",
                    rangelength: "Password harus diantara 6-25 karakter"
                },
                retype_password: {
                    required: "Masukkan password kembali",
                    equalTo: "Password tidak sama"
                }
            }
        });

        // Validasi form ubahUser
        $('#ubahUser').validate({
            rules: {
                username: {
                    required: true,
                    minlength: 3
                },
                email: {
                    required: true,
                    email: true
                },
                no_hp: {
                    required: true,
                    rangelength: [10, 16]
                }
            },
            messages: {
                username: {
                    required: "Masukkan username",
                    minlength: "Username minimal 3 karakter"
                },
                email: {
                    required: "Masukkan email",
                    email: "Masukkan email yang valid"
                },
                no_hp: {
                    required: "Masukkan nomor handphone",
                    rangelength: "Nomor handphone harus diantara 10-16 digit"
                }
            }
        });

        // Validasi form tambahCuaca
        $('#tambahCuaca').validate({
            rules: {
                hari: {
                    required: true
                },
                suhu: {
                    required: true,
                    number: true,
                    range: [-100, 100]
                },
                kelembapan: {
                    required: true,
                    number: true,
                    range: [0, 100]
                },
                kecepatan_angin: {
                    required: true,
                    number: true,
                    range: [0, 300]
                }
            },
            messages: {
                hari: {
                    required: "Pilih hari"
                },
                suhu: {
                    required: "Masukkan suhu",
                    number: "Suhu harus berupa angka",
                    range: "Suhu harus diantara -100 sampai 100"
                },
                kelembapan: {
                    required: "Masukkan kelembapan",
                    number: "Kelembapan harus berupa angka",
                    range: "Kelembapan harus diantara 0 sampai 100"
                },
                kecepatan_angin: {
                    required: "Masukkan kecepatan angin",
                    number: "Kecepatan angin harus berupa angka",
                    range: "Kecepatan angin harus diantara 0 sampai 300"
                }
            }
        });

        // Validasi form ubahCuaca
        $('#ubahCuaca').validate({
            rules: {
                hari: {
                    required: true
                },
                suhu: {
                    required: true,
                    number: true,
                    range: [-100, 100]
                },
                kelembapan: {
                    required: true,
                    number: true,
                    range: [0, 100]
                },
                kecepatan_angin: {
                    required: true,
                    number: true,
                    range: [0, 300]
                }
            },
            messages: {
                hari: {
                    required: "Pilih hari"
                },
                suhu: {
                    required: "Masukkan suhu",
                    number: "Suhu harus berupa angka",
                    range: "Suhu harus diantara -100 sampai 100"
                },
                kelembapan: {
                    required: "Masukkan kelembapan",
                    number: "Kelembapan harus berupa angka",
                    range: "Kelembapan harus diantara 0 sampai 100"
                },
                kecepatan_angin: {
                    required: "Masukkan kecepatan angin",
                    number: "Kecepatan angin harus berupa angka",
                    range: "Kecepatan angin harus diantara 0 sampai 300"
                }
            }
        });

        // Summernote
        $('#summernote').summernote({
            height: 200
        });

        // Bs-custom-file-input
        bsCustomFileInput.init();
    });
</script>
</body>
</html>
