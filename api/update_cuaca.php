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

// Ambil data dari request
$data = json_decode(file_get_contents("php://input"), true);
if (empty($data)) {
    $data = $_POST;
}

// Siapkan parameter untuk update
$params = [
    'id' => $data['id'],
    'status' => $data['status'],
    'suhu' => $data['suhu'],
    'humidity' => $data['humidity'],
    'wind_speed' => $data['wind_speed'],
    'kota' => $data['kota'],
    'lon' => $data['lon'],
    'lat' => $data['lat'],
    'status_img' => $data['status_img']
];

// Lakukan update
if ($cuaca->updateCuaca($params)) {
    echo json_encode([
        'message' => 'Data cuaca berhasil diupdate!',
        'data' => $params
    ]);
} else {
    echo json_encode([
        'message' => 'Gagal mengupdate data cuaca!',
        'data' => null
    ]);
}
?>