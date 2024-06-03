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
            echo "tes";
            $title = $_POST['judul-berita'];
            $description = $_POST['desc-berita'];
            $date = $_POST['tanggal-berita'];
            $db->insertNews($title, $description, $date);
            echo "<script>alert('Data behasil disimpan')</script>";
            header("Location: databerita.php");
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "layout/stylejquerynbs5.php" ?>
    
    <link rel="stylesheet" href="layout/indexstyle.css">
    <link rel="stylesheet" href="layout/styledatasiswa.css">

    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <title>Panti Surya | Daftar Penduduk</title>
</head>
<body>
    <script src="js/databerita.js"></script>


    <div class="app">
        <div class="dashboard">
            <?php include 'nav.php'?>
        
            <div class="main" style="text-align: center;">
                <h1>Data Berita</h1>
                
                <div class="table-nav wfull">
                    <form class="d-flex" role="search" action="databerita.php" method="POST">
                        <input class="form-control me-2" type="search" placeholder="Cari Berita" id="search_input" aria-label="Search" style="border: 1px solid rgb(0,0,0,0.5);">
                    </form>

                    <div class="button-group">
                        <button type="button" class="btn btn-outline-primary" id="adduser" data-bs-toggle="modal" data-bs-target="#ModalAddUser">Add Berita</button>
                        <a href="beritaTambah.php" class="btn btn-outline-primary" type="button" id="tambahberita">Tambah Berita</a>
                    </div>
                    
                </div>

                <div class="content">
                    <table class="table wfull table-hover">
                        <thead>
                            <tr>
                            <th scope="col">No.</th>
                            <th scope="col">Judul</th>
                            <th scope="col">Deskripsi</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col" colspan="2">Action</th>
                            
                            </tr>
                        </thead>
                        <tbody class="table-group-divider" id="list_berita">
                            
                        </tbody>
                    </table>
                </div>


                <?php include 'footer.php'?>

            </div>



            <!-- Modal -->
            <div class="modal fade" id="ModalAddUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                <form action="" method="post">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Berita</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="adduser-nama" class="col-form-label">Judul:</label>
                        <input type="text" class="form-control" id="judul-berita" name="judul-berita">
                    </div>

                    <!-- <div class="mb-3">
                        <label for="adduser-nama" class="col-form-label">Deskripsi:</label>
                        <input type="text" class="form-control" id="adduser-nama">
                    </div>

                    <div class="mb-3">
                        <label for="adduser-nama" class="col-form-label">Tanggal:</label>
                        <input type="text" class="form-control" id="adduser-nama">
                    </div> -->
                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Deskripsi:</label>
                        <textarea class="form-control" id="desc-berita" rows="3" name="desc-berita"></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Tanggal:</label>
                        <input type="date" class="form-control" id="tanggal-berita" name="tanggal-berita">
                    </div>
                </div>
                <div class="modal-footer">
                    <!-- <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button> -->
                    <button class="btn btn-primary" style="width: 7rem;" type="submit" name="simpan">Simpan</button>
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