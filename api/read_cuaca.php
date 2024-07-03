<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

Header('Access-Control-Allow-Origin: *');
Header('Content-Type: application/json');
Header('Access-Control-Allow-Method: GET');

include_once('conf/db_config.php');
include_once('model/cuaca.php');

$database = new Database();
$db = $database->connect();
$cuaca = new Cuaca($db);

if (isset($_GET['id'])) {
    $data = $cuaca->readCuacaById($_GET['id']);
    if ($data->rowCount()) {
        $list_data = [];
        while ($row = $data->fetch(PDO::FETCH_OBJ)) {
            $list_data = [
                'id' => $row->id,
                'status' => $row->status,
                'suhu' => $row->suhu,
                'humidity' => $row->humidity,
                'wind_speed' => $row->wind_speed,
                'kota' => $row->kota,
                'lon' => $row->lon,
                'lat' => $row->lat,
                'status_img' => $row->status_img
            ];
        }
        echo json_encode(['message' => 'Data cuaca berhasil ditemukan!', 'data' => $list_data]);
    } else {
        echo json_encode(['message' => 'Data cuaca yang dicari tidak ada!', 'data' => null]);
    }
} else {
    $data = $cuaca->readCuaca();
    if ($data->rowCount()) {
        $list_data = [];
        while ($row = $data->fetch(PDO::FETCH_OBJ)) {
            $item = array(
                'id' => $row->id,
                'status' => $row->status,
                'suhu' => $row->suhu,
                'humidity' => $row->humidity,
                'wind_speed' => $row->wind_speed,
                'kota' => $row->kota,
                'lon' => $row->lon,
                'lat' => $row->lat,
                'status_img' => $row->status_img
            );
            array_push($list_data, $item);
        }
        echo json_encode(['message' => 'Data cuaca berhasil diambil!', 'data' => $list_data]);
    } else {
        echo json_encode(['message' => 'Data cuaca tidak berhasil diambil!', 'data' => null]);
    }
}
?>
