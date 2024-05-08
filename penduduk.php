<?php
    
    session_start();
    if(!isset($_COOKIE['user_login'])){
        header("location:login2.php");
    }


    // require 'utils.php';

    // $query = "SELECT * FROM siswa";
    // $res = $pdo->query($query);

    // $db = new myDB();
    // $res = $db->getAllPenduduk();
    include "utils.php";
    $db = new myDB();

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['simpan'])){
            $nama = $_POST['nama_penduduk'];
            $alamat = $_POST['alamat_penduduk'];
            $email = $_POST['email_wali'];
            $noTelpon = $_POST['noTelpon'];
            $pengobatan= $_POST['tanggal_pengobatan'];
            $db->insertPenduduk($nama, $alamat, $pengobatan, $email, $noTelpon);
            echo "<script>alert('Data behasil disimpan')</script>";
            header("Location: penduduk.php");
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="layout/indexstyle.css">
    <link rel="stylesheet" href="layout/styledatasiswa.css">

    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <title>Panti Surya | Daftar Penduduk</title>
</head>
<body>
    <script src="js/datapenduduk.js"></script>




    <div class="app">
        <div class="dashboard">
            <?php include 'nav.php'?>
        
            <div class="main" style="text-align: center;">
                <h1>Data Penduduk</h1>
                
                <div class="table-nav wfull">
                    <form class="d-flex" role="search" action="penduduk.php" method="POST">
                        <input class="form-control me-2" type="search" placeholder="Cari Penduduk" id="search_input" aria-label="Search" style="border: 1px solid rgb(0,0,0,0.5);">
                    </form>

                    <div class="button-group">
                        <button type="button" class="btn btn-outline-primary" id="adduser" data-bs-toggle="modal" data-bs-target="#ModalAddUser">Add User</button>
                        <a href="pendudukTambah.php" class="btn btn-outline-primary" type="button" id="tambahpenduduk">Tambah Penduduk</a>
                    </div>
                    
                </div>

                <div class="content">
                    <table class="table wfull table-hover">
                        <thead>
                            <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Alamat</th>
                            
                            <th scope="col">Email Wali</th>
                            <th scope="col">No Telp Wali</th>
                            <th scope="col">Pengobatan Terakhir</th>
                            <th scope="col" colspan="2">Action</th>
                            
                            </tr>
                        </thead>
                        <tbody class="table-group-divider" id="list_siswa">
                            
                        </tbody>
                    </table>
                </div>
            </div>



            <!-- Modal -->
            <div class="modal fade" id="ModalAddUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <form action="" method="post">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Penduduk Panti</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="adduser-nama" class="col-form-label">Nama:</label>
                        <input type="text" class="form-control" id="nama_penduduk" name="nama_penduduk">
                    </div>

                    <div class="mb-3">
                        <label for="adduser-nama" class="col-form-label">Alamat:</label>
                        <input type="text" class="form-control" id="alamat_penduduk" name="alamat_penduduk">
                    </div>

                    <div class="mb-3">
                        <label for="adduser-nama" class="col-form-label">Email Wali:</label>
                        <input type="text" class="form-control" id="email_wali" name="email_wali">
                    </div>

                    <div class="mb-3">
                        <label for="adduser-nama" class="col-form-label">No Telp Wali:</label>
                        <input type="text" class="form-control" id="noTelpon" name="noTelpon">
                    </div>

                    <!-- <div class="mb-3">
                        <label for="adduser-nama" class="col-form-label">Pengobatan Terakhir:</label>
                        <input type="text" class="form-control" id="adduser-nama">
                    </div> -->

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Pengobatan Terakhir:</label>
                        <input type="date" class="form-control" id="tanggal_pengobatan" name="tanggal_pengobatan">
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button> -->
                    <button type="submit" name="simpan" class="btn btn-primary" style="width: 7rem;">Simpan</button>
                </div>
                </form> 
                </div>
            </div>
            </div>
        </div>
    </div>
    



    <script>
        feather.replace();
    </script>
</body>
</html>