<?php
require("conf/db_conn.php");
$query = "SELECT * FROM tb_cuaca";
$daftar_cuaca = mysqli_query($conn, $query);
//var_dump($daftar_cuaca);
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0">Data Cuaca</h1>
            </div>
        </div>
    </div>
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Cuaca</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    
                    <div class="table-responsive">
                        <table id="cuaca" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Status</th>
                                    <th>Suhu</th>
                                    <th>Humidity</th>
                                    <th>Wind Speed</th>
                                    <th>Kota</th>
                                    <th>Longitude</th>
                                    <th>Latitude</th>
                                    <th style="text-align: center;">Status Image</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 0; ?>
                                <?php foreach ($daftar_cuaca as $row): ?>
                                <tr>
                                    <td style="text-align: center;"><?= ++$no; ?></td>
                                    <td><?= $row['status']; ?></td>
                                    <td><?= $row['suhu']; ?> °C</td>
                                    <td><?= $row['humidity']; ?> %</td>
                                    <td><?= $row['wind_speed']; ?> km/h</td>
                                    <td><?= $row['kota']; ?></td>
                                    <td><?= $row['lon']; ?></td>
                                    <td><?= $row['lat']; ?></td>
                                    <td style="text-align: center;">
                                        <?php 
                                        $status_img = $row['status_img']; 
                                        if ($status_img == null){
                                            echo "<img src='image/status/default.png' style='width: 80px;' />";
                                        } else {
                                            echo "<img src='$status_img' style='width: 80px;' />";
                                        }
                                        ?>
                                    </td>
                                </tr>
                                <!-- Modal -->
                                <div class="modal fade" id="modal-<?= $row['id']; ?>">
                                    <div class="modal-dialog modal-dialog-scrollable">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Detail Data Cuaca di <?= $row['kota']; ?></h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-sm-12 text-center">
                                                            <?php
                                                            if($status_img == null){
                                                                echo "<img src='image/status/default.png' style='width: 100px;'/>";
                                                            } else{
                                                                echo "<img src='$status_img' style='width: 100px;'/>";
                                                            }
                                                            ?>
                                                        </div>
                                                    </div> <!-- /.row -->
                                                    <div class="row">
                                                        <div class="col-sm-5 col-6">Status</div>
                                                        <div class="col-sm-5 col-6">: <?= $row['status']; ?></div>

                                                        <div class="w-100 d-none d-md-block"></div>
                                                        <div class="col-sm-5 col-6">Suhu</div>
                                                        <div class="col-sm-5 col-6">: <?= $row['suhu']; ?> °C</div>

                                                        <div class="w-100 d-none d-md-block"></div>
                                                        <div class="col-sm-5 col-6">Humidity</div>
                                                        <div class="col-sm-5 col-6">: <?= $row['humidity']; ?> %</div>

                                                        <div class="w-100 d-none d-md-block"></div>
                                                        <div class="col-sm-5 col-6">Wind Speed</div>
                                                        <div class="col-sm-5 col-6">: <?= $row['wind_speed']; ?> km/h</div>

                                                        <div class="w-100 d-none d-md-block"></div>
                                                        <div class="col-sm-5 col-6">Longitude</div>
                                                        <div class="col-sm-5 col-6">: <?= $row['lon']; ?></div>

                                                        <div class="w-100 d-none d-md-block"></div>
                                                        <div class="col-sm-5 col-6">Latitude</div>
                                                        <div class="col-sm-5 col-6">: <?= $row['lat']; ?></div>
                                                    </div> <!-- /.row -->
                                                </div> <!-- /.container -->
                                            </div> <!-- /.modal-body -->
                                        </div> <!-- /.modal-content -->
                                    </div> <!-- /.modal-dialog -->
                                </div> <!-- /.modal -->
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
</div>
<!-- /.content -->
