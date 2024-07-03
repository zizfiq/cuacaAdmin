<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

Header('Access-Control-Allow-Origin: *');
Header('Content-Type: application/json');
Header('Access-Control-Allow-Method: PUT');

include_once('conf/db_config.php');
include_once('model/cuaca.php');

$database = new Database();
$db = $database->connect();
$cuaca = new Cuaca($db);

const TARGET_DIR = '../image/status/';
const ALLOWED_EXT = array('png', 'jpg', 'jpeg', 'gif');
const MAX_FILE_SIZE = 512000;

function checkImage($image, $remove_image) {
    $filename = $_FILES[$image]['name'];
    $ukuran = $_FILES[$image]['size'];
    $tmp_file = $_FILES[$image]['tmp_name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    $target_file = TARGET_DIR . basename($filename);

    if ($_FILES[$image]['error'] !== UPLOAD_ERR_OK) {
        return ["Tidak ada file yang diupload atau error!"];
    }

    $image = getimagesize($tmp_file);
    if (!$image) {
        return ["File yang diupload bukan image!"];
    }

    if (file_exists($target_file)) {
        return ["File yang diupload sudah ada, silahkan ganti nama file!"];
    }

    if ($ukuran > MAX_FILE_SIZE) {
        return ["File yang diupload melebihi 512kb!"];
    }

    if (!in_array($ext, ALLOWED_EXT)) {
        return ["Ekstensi file yang diupload tidak diperbolehkan (upload hanya .png | .jpg | .jpeg | .gif)!"];
    }

    if (move_uploaded_file($tmp_file, $target_file)) {
        $remove_file = TARGET_DIR . $remove_image;
        if (file_exists($remove_file)) {
            unlink($remove_file);
        }
        return ["OK"];
    } else {
        return ["Gagal mengupload file! $target_file"];
    }
}

if (count($_POST) && isset($_POST['status_img'])) {
    $remove_image = $_POST['status_img'];
    $file_image = 'image';
    $result = checkImage($file_image, $remove_image);
    if ($result == "OK") {
        echo json_encode(['message'=>$result,'data'=>null]);
    } else {
        $params = [
            'id' => $_POST['id'],
            'status' => $_POST['status'],
            'suhu' => $_POST['suhu'],
            'humidity' => $_POST['humidity'],
            'wind_speed' => $_POST['wind_speed'],
            'kota' => $_POST['kota'],
            'lon' => $_POST['lon'],
            'lat' => $_POST['lat'],
            'status_img' => $_FILES[$file_image]['name']
        ];

        if ($cuaca->updateCuaca($params)) {
            echo json_encode(['message' => 'Data cuaca berhasil diupdate!', 'data' => $params]);
        }
    }
} else {
    $params = [
        'id' => $_POST['id'],
        'status' => $_POST['status'],
        'suhu' => $_POST['suhu'],
        'humidity' => $_POST['humidity'],
        'wind_speed' => $_POST['wind_speed'],
        'kota' => $_POST['kota'],
        'lon' => $_POST['lon'],
        'lat' => $_POST['lat'],
    ];

    if ($cuaca->updateCuaca($params)) {
        echo json_encode(['message' => 'Data cuaca berhasil diupdate!', 'data' => $params]);
    }
}
?>
