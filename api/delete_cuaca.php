<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

Header('Access-Control-Allow-Origin: *');
Header('Content-Type: application/json');
Header('Access-Control-Allow-Method: DELETE');

include_once('conf/db_config.php');
include_once('model/cuaca.php');

$database = new Database();
$db = $database->connect();
$cuaca = new Cuaca($db);

if (isset($_GET['id'])) {
    $data_cuaca = $cuaca->readCuacaById($_GET['id']);
    $list_data = [];
    
    if ($data_cuaca->rowCount()) {
        $row = $data_cuaca->fetch(PDO::FETCH_OBJ);
        $path_dir = "../image/status/";
        $target_file = $path_dir . $row->status_img;
        
        if (file_exists($target_file)) {
            unlink($target_file);
        }
        
        if ($cuaca->deleteCuaca($_GET['id'])) {
            echo json_encode(['message' => 'Berhasil menghapus data cuaca!', 'data' => $row]);
        } else {
            echo json_encode(['message' => 'Data cuaca tidak ditemukan!', 'data' => null]);
        }
    }
}
?>
