<?php
    session_start();

    require "utils.php";

    if(!isset($_COOKIE['user_login']) && !isset($_POST['username'])){
        header("location:login2.php");
    }


    if(isset($_GET["id"])){
        // echo "masuk";
        $id = $_GET["id"];
        $username = $_GET["username"];

        $db = new myDB();
        $res = $db->getPenduduk($id);
        $fetch_data = $res->fetch(PDO::FETCH_OBJ);

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="layout/indexstyle.css">
    <link rel="stylesheet" href="layout/stylelihat.css">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <title>Panti Surya | Lihat Penduduk</title>
</head>
<body>
    <script src="js/penduduk_lihat.js"></script>

    <div class="app">
        <div class="dashboard">
            <?php include 'nav.php'?>
            
            <div class="main">
                <img src="svg/arrow-left.svg" class="back" alt="" onclick="history.back()">
                <div class="profile lr-9">
                    <img src="images/noimg-removebg-preview.png" alt="no-image">
                    <div class="profile-info">
                        <h2><?php echo $username; ?></h2>

                        <button type="button" class="btn btn-outline-primary" id="addPengobatan" data-bs-toggle="modal" data-bs-target="#ModalTambahPengobatan" style="width: 100%;">
                            Tambah Pengobatan
                        </button>
                        
                    </div>
                    
                </div>

                <div class="description lr-9">
                    <h5>Alamat</h5>
                    <p><?php echo $fetch_data->alamat; ?></p>

                    <h5>Email wali</h5>
                    <p><?php echo $fetch_data->email; ?></p>

                    <h5>No telp wali</h5>
                    <p><?php echo $fetch_data->notelp; ?></p>
                    

                    <h5>Pengobatan</h5>
                    <div class="content">
                        <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">no</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Jenis</th>
                            <th scope="col">Obat</th>
                            <th scope="col">Dosis</th>
                            
                            <th scope="col">Tanggal</th>
                            <th scope="col">Sudah bayar</th>
                            </tr>
                        </thead>
                        <tbody id="rekammedis">
                            <tr>
                            <th scope="row">1</th>
                            <td>obat1 </td>
                            <td>Pengobatan</td>
                            <td>panadol</td>
                            <td>1</td>
                            <td>17 juli </td>
                            <td>
                                <input type="checkbox" class="btn-check check-bayar" id="btncheck1" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btncheck1">Sudah</label>
                            </td>
                            </tr>
                            <tr>
                            <th scope="row">2</th>
                            <td>Berobat </td>
                            <td>Ke rumah sakit</td>
                            <td>resep dokter</td>
                            <td>5</td>
                            <td>1 agustus </td>
                            <td>
                                <input type="checkbox" class="btn-check check-bayar" id="btncheck2" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btncheck2">Sudah</label>
                            </td>
                            </tr>
                            <tr>
                            <th scope="row">3</th>
                            <td>obat2 </td>
                            <td>Pengobatan</td>
                            <td>panadol</td>
                            <td>1</td>
                            <td>17 oktober </td>
                            <td>
                                <input type="checkbox" class="btn-check check-bayar" id="btncheck3" autocomplete="off">
                                <label class="btn btn-outline-primary" for="btncheck3">Sudah</label>
                            </td>
                            </tr>
                        </tbody>
                        </table>
                    </div>
                </div>
                
                
            </div>
        </div>
    </div>







    <div class="modal fade" id="ModalTambahPengobatan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="ModalTambahPengobatan">Tambah Pengobatan</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="POST" action="penduduk_proses.php">
                    <div class="mb-3">
                        <label for="desc" class="col-form-label">Deskripsi:</label>
                        <input type="text" class="form-control" id="desc">
                    </div>
                    <div class="mb-3">
                        <label for="jenis_obat" class="col-form-label">Jenis:</label>
                        <input type="text" class="form-control" id="jenis_obat">
                    </div>
                    <div class="mb-3">
                        <label for="nama_obat" class="col-form-label">Nama Obat:</label>
                        <input type="text" class="form-control" id="nama_obat">
                    </div>
                    <div class="mb-3">
                        <label for="dosis" class="col-form-label">Dosis:</label>
                        <input type="text" class="form-control" id="dosis">
                    </div>
                    <div class="mb-3">
                        <label for="tanggal_obat" class="col-form-label">Tanggal:</label>
                        <input type="date" class="form-control" id="tanggal_obat">
                    </div>

                    <div class="mb-3">
                        <input type="checkbox" id="sudahBayarModal" autocomplete="off">
                        <label for="sudahBayarModal">Sudah Bayar</label>
                    </div>
                    
                    
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" id="modal_simpan">Simpan Pengobatan</button>
            </div>
            </div>
        </div>
    </div>
    


    <script>
        feather.replace()
    </script>
</body>
</html>