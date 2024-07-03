<?php
include("../../conf/db_conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $status = $_POST['status'];
    $suhu = $_POST['suhu'];
    $humidity = $_POST['humidity'];
    $wind_speed = $_POST['wind_speed'];
    $kota = $_POST['kota'];
    $lon = $_POST['lon'];
    $lat = $_POST['lat'];
    $status_img = $_POST['status_img'];

    // Validasi URL status image
    if (!filter_var($status_img, FILTER_VALIDATE_URL)) {
        echo "<script>alert('URL gambar status cuaca tidak valid!');</script>";
        echo "<script>window.location = '../../index.php?page=tambah_cuaca';</script>";
        exit;
    }

    $query = "INSERT INTO tb_cuaca 
        SET status = '$status', 
            suhu = '$suhu', 
            humidity = '$humidity', 
            wind_speed = '$wind_speed', 
            kota = '$kota', 
            lon = '$lon', 
            lat = '$lat', 
            status_img = '$status_img'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>alert('Berhasil menambahkan data cuaca untuk $kota!');</script>";
        echo "<script>window.location = '../../index.php?page=data_cuaca';</script>";
    } else {
        echo "<script>alert('Gagal menambahkan data cuaca untuk $kota, coba cek isian anda!');</script>";
        echo "<script>window.location = '../../index.php?page=tambah_cuaca';</script>";
    }
}
?>
