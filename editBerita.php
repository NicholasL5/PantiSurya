<?php
    session_start();
    if(!isset($_COOKIE['user_login']) && !isset($_POST['username'])){
        header("location:login2.php");
    }

    require "utils.php";

    $db = new myDB();

    include "utils/resize_image.php";
    define('UPLOAD_DIR','../pantiweb/images/berita/');
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

            $db->editNews($title, $description, $date, $id, $profilePictureDirectory, $profilePictureDirectory2, $profilePictureDirectory3, $profilePictureDirectory4, $profilePictureDirectory5);
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
                    <div class="profile lr-9">
                        <!-- <img src="images/noimg-removebg-preview.png" alt="no-image"> -->
                        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                        <div class="profile-info">
                            <h2><?php echo $title; ?></h2>
                            
                        </div>
                        
                    </div>

                    <div class="description lr-9">
                    <h5>Foto Berita 1</h5>
                        <p><?php
                        echo '<img src="' . htmlspecialchars($row['image_path']) . '" alt="Foto Berita" style="width: 300px; height: 300px;">';
                    ?></p>

<h5>Foto Berita 2</h5>
                        <p><?php
                        echo '<img src="' . htmlspecialchars($row['image_path2']) . '" alt="Foto Berita" style="width: 300px; height: 300px;">';
                    ?></p>

<h5>Foto Berita 3</h5>
                        <p><?php
                        echo '<img src="' . htmlspecialchars($row['image_path3']) . '" alt="Foto Berita" style="width: 300px; height: 300px;">';
                    ?></p>

<h5>Foto Berita 4</h5>
                        <p><?php
                        echo '<img src="' . htmlspecialchars($row['image_path4']) . '" alt="Foto Berita" style="width: 300px; height: 300px;">';
                    ?></p>

<h5>Foto Berita 5</h5>
                        <p><?php
                        echo '<img src="' . htmlspecialchars($row['image_path5']) . '" alt="Foto Berita" style="width: 300px; height: 300px;">';
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
                        </div>

                        <div class="mb-3">
                            <label for="imageInput" class="form-label">

                                </svg>Tambahkan foto berita 2</label>
                            <input class="form-control mb-3" type="file" id="image-input"
                                accept="image/jpeg, image/jpg, image/png" name="imageChooser2">
                            <div id="display-image2"></div>
                        </div>

                        <div class="mb-3">
                            <label for="imageInput" class="form-label">

                                </svg>Tambahkan foto berita 3</label>
                            <input class="form-control mb-3" type="file" id="image-input"
                                accept="image/jpeg, image/jpg, image/png" name="imageChooser3">
                            <div id="display-image3"></div>
                        </div>

                        <div class="mb-3">
                            <label for="imageInput" class="form-label">

                                </svg>Tambahkan foto berita 4</label>
                            <input class="form-control mb-3" type="file" id="image-input"
                                accept="image/jpeg, image/jpg, image/png" name="imageChooser4">
                            <div id="display-image4"></div>
                        </div>

                        <div class="mb-3">
                            <label for="imageInput" class="form-label">

                                </svg>Tambahkan foto berita 5</label>
                            <input class="form-control mb-3" type="file" id="image-input"
                                accept="image/jpeg, image/jpg, image/png" name="imageChooser5">
                            <div id="display-image5"></div>
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