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

    include "utils/resize_image.php";
    define('UPLOAD_DIR','berita/');

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['simpan'])){
            echo "tes";
            $title = $_POST['judul-berita'];
            $description = $_POST['desc-berita'];
            $date = $_POST['tanggal-berita'];
            // Get the tmp file from server as image
            $image = file_get_contents($_FILES["imageChooser"]["tmp_name"]);

            // Make file with name uniqid().jpg
            $file_name = uniqid().'.jpg';
            // $foto = 'poster/'.$file_name;
            $file = UPLOAD_DIR.$file_name;
            $success = file_put_contents($file, $image);
            // echo var_dump($success);

            //Resize and Compress Image
            list($width, $height, $type) = getimagesize($file);
            $img = resize_image($file, $width, $height, TRUE);
            imagejpeg($img, $file, 90);
            // echo "test";

            $profilePictureDirectory = $file;
            
            $db->insertNews($title, $description, $date, $profilePictureDirectory);
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
    <style>
        #display-image {
            width: 100px;
            height: 100px;
            border: 1px solid black;
            background-position: center;
            background-size: cover;
        }
    </style>
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
                <form action="" method="post" enctype="multipart/form-data">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Berita</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <label for="imageInput" class="form-label"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-images" viewBox="0 0 16 16">
  <path d="M4.502 9a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3"/>
  <path d="M14.002 13a2 2 0 0 1-2 2h-10a2 2 0 0 1-2-2V5A2 2 0 0 1 2 3a2 2 0 0 1 2-2h10a2 2 0 0 1 2 2v8a2 2 0 0 1-1.998 2M14 2H4a1 1 0 0 0-1 1h9.002a2 2 0 0 1 2 2v7A1 1 0 0 0 15 11V3a1 1 0 0 0-1-1M2.002 4a1 1 0 0 0-1 1v8l2.646-2.354a.5.5 0 0 1 .63-.062l2.66 1.773 3.71-3.71a.5.5 0 0 1 .577-.094l1.777 1.947V5a1 1 0 0 0-1-1z"/>
</svg>
                    </svg> Foto Berita</label>
                    <input class="form-control mb-3" type="file" id="image-input" accept="image/jpeg, image/jpg, image/png" name="imageChooser">
                    <div id="display-image"></div>
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
        // untuk image upload yang sekarang
        const image_input = document.querySelector("#image-input");
        image_input.addEventListener("change", function() {
            const reader = new FileReader();
            reader.addEventListener("load", () => {
            const uploaded_image = reader.result;
            document.querySelector("#display-image").style.backgroundImage = `url(${uploaded_image})`;
            });
            reader.readAsDataURL(this.files[0]);
        });
   
        feather.replace();
    </script>


    <script>
        feather.replace();
    </script>
</body>
</html>