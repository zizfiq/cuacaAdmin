<?php
include("../../conf/db_conn.php");
const TARGET_DIR = "../../image/status/";

if($_SERVER["REQUEST_METHOD"] == "GET"){
    $id = $_GET['id'];
    $query = "SELECT * FROM tb_cuaca WHERE id = '$id'";
    $result = mysqli_query($conn, $query);
    if($result){
        $row = mysqli_fetch_array($result);
        $kota = $row['kota'];
        $target_file = TARGET_DIR . $row['status_img'];
        if (file_exists($target_file)) {
            unlink($target_file);
        }
        
        $query = "DELETE FROM tb_cuaca WHERE id='$id'";
        $deleteResult = mysqli_query($conn, $query);
        
        if ($deleteResult){
            echo "<script> alert('Berhasil menghapus data cuaca untuk $kota.'); </script>";
            echo "<script> window.location = '../../index.php?page=data_cuaca'; </script>";
        } else {
            echo "<script> alert('Gagal menghapus data cuaca untuk $kota, terjadi kesalahan.'); </script>";
        }
    } else {
        echo "<script> alert('Gagal menghapus, data tidak ditemukan.'); </script>";
        echo "<script> window.location = '../../index.php?page=data_cuaca'; </script>";
    }
}
?>
