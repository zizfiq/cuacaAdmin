<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

Header('Access-Control-Allow-Origin: *');
Header('Content-Type: application/json');
Header('Access-Control-Allow-Method: POST');

include_once('conf/db_config.php');
include_once('model/cuaca.php');

$database = new Database();
$db = $database->connect();
$cuaca = new Cuaca($db);

const TARGET_DIR = '../image/status/';
const ALLOWED_EXT = array('png', 'jpg', 'jpeg', 'gif');
const MAX_FILE_SIZE = 512000;

function checkImage($image) {
    $filename = $_FILES[$image]['name'];
    $ukuran = $_FILES[$image]['size'];
    $tmp_file = $_FILES[$image]['tmp_name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    
    // Append a unique identifier to the filename
    $unique_filename = pathinfo($filename, PATHINFO_FILENAME) . '_' . uniqid() . '.' . $ext;
    $target_file = TARGET_DIR . $unique_filename;

    if ($_FILES[$image]['error'] != UPLOAD_ERR_OK) {
        return ["Tidak ada file yang diupload atau error!"];
    }

    $image_size = getimagesize($tmp_file);
    if (!$image_size) {
        return ["File yang diupload bukan image!"];
    }

    if ($ukuran > MAX_FILE_SIZE) {
        return ["File yang diupload melebihi 512kb!"];
    }

    if (!in_array($ext, ALLOWED_EXT)) {
        return ["Ekstensi file yang diupload tidak diperbolehkan (upload hanya .png | .jpg | .jpeg | .gif)!"];
    }

    if (move_uploaded_file($tmp_file, $target_file)) {
        return ["OK", $unique_filename];
    } else {
        return ["Gagal mengupload file! $target_file"];
    }
}

if (count($_POST)) {
    $file_image = 'status_img';
    $result = checkImage($file_image);
    if ($result[0] == "OK") {
        $unique_filename = $result[1];
        $params = [
            'status' => $_POST['status'],
            'suhu' => $_POST['suhu'],
            'humidity' => $_POST['humidity'],
            'wind_speed' => $_POST['wind_speed'],
            'kota' => $_POST['kota'],
            'lon' => $_POST['lon'],
            'lat' => $_POST['lat'],
            'status_img' => $unique_filename
        ];

        if ($cuaca->createCuaca($params)) {
            echo json_encode(['message' => 'Data cuaca berhasil ditambahkan!', 'data' => $params]);
        } else {
            echo json_encode(['message' => 'Data cuaca gagal ditambahkan!', 'data' => null]);
        }
    } else {
        echo json_encode(['message' => $result[0], 'data' => null]);
    }
} else {
    echo json_encode(['message' => 'Tidak ada data yang dikirim!', 'data' => null]);
}
?>
