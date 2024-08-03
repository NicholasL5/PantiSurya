<?php
    session_start();
    
    if(!isset($_COOKIE['user_login']) && !isset($_POST['username'])){
        header("location:login2.php");
    }

    include "utils.php";
    $db = new myDB();

    include "utils/resize_image.php";
    define('UPLOAD_DIR','../pantiweb/images/berita/');

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['simpan'])){
            $title = $_POST['judul-berita'];
            $description = $_POST['desc-berita'];
            $date = $_POST['tanggal-berita'];
            // Get the tmp file from server as image
            $image = file_get_contents($_FILES["imageChooser"]["tmp_name"]);

            // Make file with name uniqid().jpg
            $file_name = uniqid().'.png';
            // $foto = 'poster/'.$file_name;
            $file = UPLOAD_DIR.$file_name;
            $success = file_put_contents($file, $image);

            $profilePictureDirectory = $file;

            $image2 = file_get_contents($_FILES["imageChooser2"]["tmp_name"]);

            // Make file with name uniqid().jpg
            $file_name2 = uniqid().'.png';
            // $foto = 'poster/'.$file_name;
            $file2 = UPLOAD_DIR.$file_name2;
            $success2 = file_put_contents($file2, $image2);

            $profilePictureDirectory2 = $file2;

            $image3 = file_get_contents($_FILES["imageChooser3"]["tmp_name"]);

            // Make file with name uniqid().jpg
            $file_name3 = uniqid().'.png';
            // $foto = 'poster/'.$file_name;
            $file3 = UPLOAD_DIR.$file_name3;
            $success3 = file_put_contents($file3, $image3);

            $profilePictureDirectory3 = $file3;

            $image4 = file_get_contents($_FILES["imageChooser4"]["tmp_name"]);

            // Make file with name uniqid().jpg
            $file_name4 = uniqid().'.png';
            // $foto = 'poster/'.$file_name;
            $file4 = UPLOAD_DIR.$file_name4;
            $success4 = file_put_contents($file4, $image4);

            $profilePictureDirectory4 = $file4;

            $image5 = file_get_contents($_FILES["imageChooser5"]["tmp_name"]);

            // Make file with name uniqid().jpg
            $file_name5 = uniqid().'.png';
            // $foto = 'poster/'.$file_name;
            $file5 = UPLOAD_DIR.$file_name5;
            $success5 = file_put_contents($file5, $image5);

            $profilePictureDirectory5 = $file5;

            $db->insertNews($title, $description, $date, $profilePictureDirectory, $profilePictureDirectory2, $profilePictureDirectory3, $profilePictureDirectory4, $profilePictureDirectory5);
            echo "<script>alert('Data behasil disimpan')</script>";
            // header("Location: databerita.php");
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

        #display-image2 {
            width: 300px;
            height: 300px;
            border: 1px solid black;
            background-position: center;
            background-size: cover;
        }

        #display-image3 {
            width: 300px;
            height: 300px;
            border: 1px solid black;
            background-position: center;
            background-size: cover;
        }

        #display-image4 {
            width: 300px;
            height: 300px;
            border: 1px solid black;
            background-position: center;
            background-size: cover;
        }

        #display-image5 {
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
                <div class="pad">
                <h2>Tambah Berita</h2>

                <section>

                <h4>Data Berita</h4>
                <form action="" method="post" enctype="multipart/form-data">

                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Tambahkan foto berita 1
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div class="mb-3">
                                    <label for="imageInput" class="form-label"></label>
                                    <input class="form-control mb-3" type="file" id="image-input" accept="image/jpeg, image/jpg, image/png" name="imageChooser">
                                    <div id="display-image"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
        <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                Tambahkan foto berita 2
            </button>
        </h2>
        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo">
            <div class="accordion-body">
                <div class="mb-3">
                    <label for="imageInput" class="form-label"></label>
                    <input class="form-control mb-3" type="file" id="image-input2" accept="image/jpeg, image/jpg, image/png" name="imageChooser2">
                    <div id="display-image2"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="headingThree">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                Tambahkan foto berita 3
            </button>
        </h2>
        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree">
            <div class="accordion-body">
                <div class="mb-3">
                    <label for="imageInput" class="form-label"></label>
                    <input class="form-control mb-3" type="file" id="image-input3" accept="image/jpeg, image/jpg, image/png" name="imageChooser3">
                    <div id="display-image3"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="headingFour">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                Tambahkan foto berita 4
            </button>
        </h2>
        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour">
            <div class="accordion-body">
                <div class="mb-3">
                    <label for="imageInput" class="form-label"></label>
                    <input class="form-control mb-3" type="file" id="image-input4" accept="image/jpeg, image/jpg, image/png" name="imageChooser4">
                    <div id="display-image4"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="headingFive">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                Tambahkan foto berita 5
            </button>
        </h2>
        <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive">
            <div class="accordion-body">
                <div class="mb-3">
                    <label for="imageInput" class="form-label"></label>
                    <input class="form-control mb-3" type="file" id="image-input5" accept="image/jpeg, image/jpg, image/png" name="imageChooser5">
                    <div id="display-image5"></div>
                </div>
            </div>
        </div>
    </div>

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

  const image_input2 = document.querySelector("#image-input2");
        image_input2.addEventListener("change", function() {
            const reader2 = new FileReader();
            reader2.addEventListener("load", () => {
                const uploaded_image2 = reader2.result;
                document.querySelector("#display-image2").style.backgroundImage = `url(${uploaded_image2})`;
            });
            reader2.readAsDataURL(this.files[0]);
        });

        const image_input3 = document.querySelector("#image-input3");
        image_input3.addEventListener("change", function() {
            const reader3 = new FileReader();
            reader3.addEventListener("load", () => {
                const uploaded_image3 = reader3.result;
                document.querySelector("#display-image3").style.backgroundImage = `url(${uploaded_image3})`;
            });
            reader3.readAsDataURL(this.files[0]);
        });

        const image_input4 = document.querySelector("#image-input4");
        image_input4.addEventListener("change", function() {
            const reader4 = new FileReader();
            reader4.addEventListener("load", () => {
                const uploaded_image4 = reader4.result;
                document.querySelector("#display-image4").style.backgroundImage = `url(${uploaded_image4})`;
            });
            reader4.readAsDataURL(this.files[0]);
        });

        const image_input5 = document.querySelector("#image-input5");
        image_input5.addEventListener("change", function() {
            const reader5 = new FileReader();
            reader5.addEventListener("load", () => {
                const uploaded_image5 = reader5.result;
                document.querySelector("#display-image5").style.backgroundImage = `url(${uploaded_image5})`;
            });
            reader5.readAsDataURL(this.files[0]);
        });
    </script>
</body>
</html>