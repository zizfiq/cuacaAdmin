<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Cuaca {
    public $id;
    public $status;
    public $suhu;
    public $humidity;
    public $wind_speed;
    public $kota;
    public $lon;
    public $lat;
    public $status_img;

    private $connection;
    private $table = 'tb_cuaca';

    public function __construct($db) {
        $this->connection = $db;
    }

    public function home() {
        return "Selamat Datang di API Cuaca versi 1.0!";
    }

    public function readCuaca() {
        // kueri untuk membaca data dari tabel
        $query = 'SELECT * FROM ' . $this->table . ' ORDER BY id DESC';
        $data = $this->connection->prepare($query);
        $data->execute();
        return $data;
    }

    public function readCuacaById($_id) {
        $this->id = $_id;
        // kueri untuk membaca data dari tabel
        $query = 'SELECT * FROM ' . $this->table . ' WHERE id=?';
        $data = $this->connection->prepare($query);
        $data->bindValue(1, $this->id, PDO::PARAM_INT);
        $data->execute();
        return $data;
    }

    public function createCuaca($params) {
        try {
            // memberikan nilai
            $this->status = $params['status'];
            $this->suhu = $params['suhu'];
            $this->humidity = $params['humidity'];
            $this->wind_speed = $params['wind_speed'];
            $this->kota = $params['kota'];
            $this->lon = $params['lon'];
            $this->lat = $params['lat'];
            $this->status_img = isset($params['status_img']) ? $params['status_img'] : NULL;

            // kueri untuk memasukkan data ke dalam tabel
            $query = "INSERT INTO " . $this->table . " SET
                      status = :status,
                      suhu = :suhu,
                      humidity = :humidity,
                      wind_speed = :wind_speed,
                      kota = :kota,
                      lon = :lon,
                      lat = :lat,
                      status_img = :status_img";

            $data = $this->connection->prepare($query);
            $data->bindValue(':status', $this->status);
            $data->bindValue(':suhu', $this->suhu);
            $data->bindValue(':humidity', $this->humidity);
            $data->bindValue(':wind_speed', $this->wind_speed);
            $data->bindValue(':kota', $this->kota);
            $data->bindValue(':lon', $this->lon);
            $data->bindValue(':lat', $this->lat);
            $data->bindValue(':status_img', $this->status_img);

            if ($data->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function updateCuaca($params) {
        try {
            // memberikan nilai
            $this->id = $params['id'];
            $this->status = $params['status'];
            $this->suhu = $params['suhu'];
            $this->humidity = $params['humidity'];
            $this->wind_speed = $params['wind_speed'];
            $this->kota = $params['kota'];
            $this->lon = $params['lon'];
            $this->lat = $params['lat'];
            $this->status_img = isset($params['status_img']) ? $params['status_img'] : NULL;

            // kueri untuk memperbarui seluruh field data
            $query = "UPDATE " . $this->table . " SET
                      status = :status,
                      suhu = :suhu,
                      humidity = :humidity,
                      wind_speed = :wind_speed,
                      kota = :kota,
                      lon = :lon,
                      lat = :lat,
                      status_img = :status_img
                      WHERE id = :id";

            $data = $this->connection->prepare($query);
            $data->bindValue(':id', $this->id);
            $data->bindValue(':status', $this->status);
            $data->bindValue(':suhu', $this->suhu);
            $data->bindValue(':humidity', $this->humidity);
            $data->bindValue(':wind_speed', $this->wind_speed);
            $data->bindValue(':kota', $this->kota);
            $data->bindValue(':lon', $this->lon);
            $data->bindValue(':lat', $this->lat);
            $data->bindValue(':status_img', $this->status_img);

            if ($data->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function deleteCuaca($id) {
        try {
            // memberikan nilai
            $this->id = $id;
            // kueri untuk menghapus data
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';
            $data = $this->connection->prepare($query);
            $data->bindValue(':id', $this->id);

            if ($data->execute()) {
                return true;
            }
            return false;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>
