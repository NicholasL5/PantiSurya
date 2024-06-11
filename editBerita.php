<?php
    session_start();
    if(!isset($_COOKIE['user_login']) && !isset($_POST['username'])){
        header("location:login2.php");
    }

    require "utils.php";

    $db = new myDB();

    include "utils/resize_image.php";
    define('UPLOAD_DIR','../Front-PantiSurya/images/berita/');
    // Fetch all news data from the database
    $news = $db->getAllBerita();

    if(isset($_GET["id"])){
        // echo "masuk";
        $id = $_GET["id"];
        $title = $_GET["title"];
        $newsItem = $db->getBeritaById($id);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['edit'])){
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

            $db->editNews($title, $description, $date, $id, $profilePictureDirectory);
            // echo "tes";
            // echo $title;
            // echo $description;
            // echo $date;
            // $stmt = $db->prepare("UPDATE news SET title = ?, description = ?, date = ? WHERE id = ?");
            // $stmt->execute([$title, $description, $date, $id]);
            // echo "<script>alert('Data behasil diedit')</script>";
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
    <link rel="stylesheet" href="layout/stylelihat.css">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <title>Panti Surya | Lihat Penduduk</title>
    <style>
        #display-image {
            width: 300px;
            height: 300px;
            border: 1px solid black;
            background-position: center;
            background-size: cover;
            <?php 
            $row = $newsItem->fetch(PDO::FETCH_ASSOC);
            if (isset($row['image_path'])): ?>
            background-image: url('<?php echo htmlspecialchars($row['image_path']); ?>');
            <?php endif; ?>
        }
    </style>
</head>
<body>
    <div class="app">
        <div class="dashboard">
            <?php include 'nav.php'?>
            
            <div class="main">
                <div class="pad">
                    <div class="profile lr-9">
                        <!-- <img src="images/noimg-removebg-preview.png" alt="no-image"> -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                        <div class="profile-info">
                            <h2><?php echo $title; ?></h2>
                            
                        </div>
                        
                    </div>

                    <div class="description lr-9">
                    <h5>Foto Berita</h5>
                        <p><?php
                        // $row = $newsItem->fetch(PDO::FETCH_ASSOC);
                        // echo $row['image_path']; 
                        echo '<img src="' . htmlspecialchars($row['image_path']) . '" alt="Foto Berita" style="width: 300px; height: 300px;">';
                    ?></p>

                        <h5>Title</h5>
                        <p><?php
                            echo $row['title']; 
                        ?></p>

                            <h5>Description</h5>
                            <p><?php
                            echo $row['description']; 
                        ?></p>

                            <h5>Date</h5>
                            <p><?php
                            echo $row['date']; 
                        ?></p>
                    
                        <h4>Edit Berita</h4>
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
                        <input type="text" class="form-control" id="judul-berita" name="judul-berita" value="<?php echo htmlspecialchars($row['title']); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Deskripsi:</label>
                        <textarea class="form-control" id="desc-berita" rows="3" name="desc-berita"><?php echo htmlspecialchars($row['description']); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Tanggal:</label>
                        <input type="date" class="form-control" id="tanggal-berita" name="tanggal-berita" value="<?php echo htmlspecialchars($row['date']); ?>">
                    </div>
                    
                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                        <a href="dataBerita.php" class="btn btn-outline-primary" type="button" id="back">Back</a> 
                        <button class="btn btn-primary me-md-2" type="submit" name="edit">Edit</button>             
                    </div>
                    </form>
                    </div>
                    
                    
                </div>
            </div>
        </div>
    </div>
    


    <script>
        feather.replace()

        
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