<?php
include("../../conf/db_conn.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
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
        echo "<script>window.location = '../../index.php?page=ubah_cuaca&id=$id';</script>";
        exit;
    }

    $query = "UPDATE tb_cuaca SET
        status = '$status',
        suhu = '$suhu',
        humidity = '$humidity',
        wind_speed = '$wind_speed',
        kota = '$kota',
        lon = '$lon',
        lat = '$lat',
        status_img = '$status_img'
        WHERE id='$id'";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "<script>alert('Berhasil mengubah data cuaca untuk ". addslashes($kota) ."!');</script>";
        echo "<script>window.location = '../../index.php?page=data_cuaca';</script>";
    } else {
        $error_message = addslashes(mysqli_error($conn));
        echo "<script>alert('Gagal mengubah data cuaca untuk ". addslashes($kota) .", coba cek isian anda! Error: $error_message');</script>";
        echo "<script>window.location = '../../index.php?page=ubah_cuaca&id=$id';</script>";
    }
}
?>
