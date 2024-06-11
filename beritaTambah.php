<?php
    session_start();
    
    if(!isset($_COOKIE['user_login']) && !isset($_POST['username'])){
        header("location:login2.php");
    }

    include "utils.php";
    $db = new myDB();

    include "utils/resize_image.php";
    define('UPLOAD_DIR','../Front-PantiSurya/images/berita/');

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['simpan'])){
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
            

            // $db->insertGambarPondokkan($tagihanId, $profilePictureDirectory);   
            $db->insertNews($title, $description, $date, $profilePictureDirectory);
            // echo "tes";
            // echo $title;
            // echo $description;
            // echo $date;
            // $stmt = $db->prepare("INSERT INTO news (title, description, date) VALUES (?, ?, ?)");
            // $stmt->execute([$title, $description, $date]);
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
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

    <link rel="stylesheet" href="layout/styleTambah.css">
    <title>Panti Surya | Tambah Berita</title>
    <style>
        #display-image {
            width: 300px;
            height: 300px;
            border: 1px solid black;
            background-position: center;
            background-size: cover;
        }
    </style>
</head>
<body>
    <div class="app">
        <div class="dashboard">
            <?php include 'nav.php'?>
            
            <div class="main">
                <h2>Tambah Berita</h2>

                <section>

                <h4>Data Berita</h4>
                <form action="" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                        <label for="imageInput" class="form-label">

                            </svg>Tambahkan foto berita</label>
                        <input class="form-control mb-3" type="file" id="image-input"
                            accept="image/jpeg, image/jpg, image/png" name="imageChooser">
                        <div id="display-image"></div>
                        <!-- <small id="imageHelp" class="form-text text-muted">Upload bukti transfer (Disarankan gambar 1x1 dan menerima .png/.jpg/.jpeg)</small> -->
                    </div>

                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Judul Berita:</label>
                    <input type="text" class="form-control" id="judul-berita" name="judul-berita">
                </div>

                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Deskripsi:</label>
                    <textarea class="form-control" id="desc-berita" rows="3" name="desc-berita"></textarea>
                </div>

                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">Tanggal:</label>
                    <input type="date" class="form-control" id="tanggal-berita" name="tanggal-berita">
                </div>
                
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <a href="dataBerita.php" class="btn btn-outline-primary" type="button" id="back">Back</a> 
                    <button class="btn btn-primary me-md-2" type="submit" name="simpan">Simpan</button>             
                </div>
                </form>
                

                </section>
            </div>
        </div>
    </div>
    


    <script>
        feather.replace()
    </script>

<script>
        const image_input = document.querySelector("#image-input");
  image_input.addEventListener("change", function() {
    const reader = new FileReader();
    reader.addEventListener("load", () => {
      const uploaded_image = reader.result;
      document.querySelector("#display-image").style.backgroundImage = `url(${uploaded_image})`;
    });
    reader.readAsDataURL(this.files[0]);
  });
    </script>
</body>
</html>