<?php
    
    session_start();
    if(!isset($_COOKIE['user_login'])){
        header("location:login2.php");
    }

    include "utils.php";
    include "utils/resize_image.php";
    define('UPLOAD_DIR','asset/pp/');

    $db = new myDB();

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['simpan'])){
            $nama = $_POST['nama_penduduk'];
            $alamat = $_POST['alamat_penduduk'];
            $email = $_POST['email_wali'];
            $noTelpon = $_POST['noTelpon'];
            $tanggal_masuk = $_POST['tanggal_masuk'];
            // header("Location: penduduk.php");
            $image = file_get_contents($_FILES["imageChooser"]["tmp_name"]);

            // Make file with name uniqid().jpg
            $file_name = uniqid().'.jpg';
            // $foto = 'poster/'.$file_name;
            $file = UPLOAD_DIR.$file_name;
            $success = file_put_contents($file, $image);
            // echo var_dump($success);

            //Resize and Compress Image
            $img = resize_image($file, 160, 160, TRUE);
            imagejpeg($img, $file, 90);
            // echo "test";

            $profilePictureDirectory = $file;
            
            // $db->insertGambarPenduduk($profilePictureDirectory);
            $db->insertPenduduk($nama, $alamat, $tanggal_masuk, $email, $noTelpon, $profilePictureDirectory);
            echo "<script>alert('Data behasil disimpan')</script>";
            // Move to login page
            header("location: penduduk.php");
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
    <script src="js/datapenduduk.js"></script>




    <div class="app">
        <div class="dashboard">
            <?php include 'nav.php'?>
        
            <div class="main" style="text-align: center;">
                <div class="pad">
                    <h1>Data Penduduk</h1>
                    
                    <div class="table-nav wfull">
                        <form class="d-flex" role="search" action="penduduk.php" method="POST">
                            <input class="form-control me-2" type="search" placeholder="Cari Penduduk" id="search_input" aria-label="Search" style="border: 1px solid rgb(0,0,0,0.5);">
                        </form>

                        <div class="button-group">
                            
                            <a href="pendudukTambah.php" class="btn btn-outline-primary" type="button" id="tambahpenduduk">Tambah Penduduk</a>
                        </div>
                        
                    </div>

                    <div class="content">
                        <table class="table wfull table-hover table-striped" id="pendudukTable">
                            <thead>
                                <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Nomor Induk</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Alamat</th>
                                <!-- <th scope="col">No Telp Wali</th> -->
                                <th scope="col">Uang Deposit</th>
                                
                                <th scope="col">Tanggal Masuk</th>
                                <th scope="col" colspan="2">Action</th>
                                
                                </tr>
                            </thead>
                            <tbody class="table-group-divider" id="list_siswa">
                                
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
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tambah Penduduk Panti</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                        <label for="imageInput" class="form-label"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                        fill="currentColor" class="bi bi-person-bounding-box" viewBox="0 0 16 16">
                        <path
                            d="M1.5 1a.5.5 0 0 0-.5.5v3a.5.5 0 0 1-1 0v-3A1.5 1.5 0 0 1 1.5 0h3a.5.5 0 0 1 0 1h-3zM11 .5a.5.5 0 0 1 .5-.5h3A1.5 1.5 0 0 1 16 1.5v3a.5.5 0 0 1-1 0v-3a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 1-.5-.5zM.5 11a.5.5 0 0 1 .5.5v3a.5.5 0 0 0 .5.5h3a.5.5 0 0 1 0 1h-3A1.5 1.5 0 0 1 0 14.5v-3a.5.5 0 0 1 .5-.5zm15 0a.5.5 0 0 1 .5.5v3a1.5 1.5 0 0 1-1.5 1.5h-3a.5.5 0 0 1 0-1h3a.5.5 0 0 0 .5-.5v-3a.5.5 0 0 1 .5-.5z" />
                        <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1H3zm8-9a3 3 0 1 1-6 0 3 3 0 0 1 6 0z" />
                        </svg> Profile Picture</label>
                        <input class="form-control mb-3" type="file" id="image-input" accept="image/jpeg, image/jpg, image/png"
                            name="imageChooser">
                        <div id="display-image"></div>

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

                            <div class="mb-3">
                                <label for="recipient-name" class="col-form-label">Tanggal Masuk:</label>
                                <input type="date" class="form-control" id="tanggal_masuk" name="tanggal_masuk">
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
    
</body>
</html>