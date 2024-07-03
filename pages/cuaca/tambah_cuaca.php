<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h1 class="m-0">Kelola Data <i class="fas fa-angle-right"></i> Cuaca</h1>
            </div>
        </div>
    </div>
</div>
<!--/.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-8">
                <!-- jQuery validation -->
                <div class="card card-primary">
                    <div class="card-header">
                        <h3 class="card-title">Tambah Data Cuaca</h3>
                    </div>
                    <!--/.card-header-->
                    <!-- form start -->
                    <form id="tambahData" method="post" action="proses/cuaca/proses_tambah_cuaca.php">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="status">Status Cuaca</label>
                                <input type="text" name="status" class="form-control" id="status" placeholder="Masukan status cuaca...">
                            </div>
                            <div class="form-group">
                                <label for="suhu">Suhu (°C)</label>
                                <input type="number" step="0.1" name="suhu" class="form-control" id="suhu" placeholder="Masukan suhu...">
                            </div>
                            <div class="form-group">
                                <label for="humidity">Humidity (%)</label>
                                <input type="number" step="0.1" name="humidity" class="form-control" id="humidity" placeholder="Masukan humidity...">
                            </div>
                            <div class="form-group">
                                <label for="wind_speed">Wind Speed (km/h)</label>
                                <input type="number" step="0.1" name="wind_speed" class="form-control" id="wind_speed" placeholder="Masukan kecepatan angin...">
                            </div>
                            <div class="form-group">
                                <label for="kota">Kota</label>
                                <input type="text" name="kota" class="form-control" id="kota" placeholder="Masukan nama kota...">
                            </div>
                            <div class="form-group">
                                <label for="lon">Longitude</label>
                                <input type="number" step="0.000001" name="lon" class="form-control" id="lon" placeholder="Masukan longitude...">
                            </div>
                            <div class="form-group">
                                <label for="lat">Latitude</label>
                                <input type="number" step="0.000001" name="lat" class="form-control" id="lat" placeholder="Masukan latitude...">
                            </div>
                            <div class="form-group">
                                <label for="status_img">Link URL Status Image</label>
                                <input type="url" name="status_img" class="form-control" id="status_img" placeholder="Masukan URL status image...">
                            </div>
                        </div>
                        <!--/.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                <!--/.card -->
            </div>
        </div>
        <!--/.row -->
    </div>
    <!--/.container-fluid -->
</div>
<!--/.content -->
