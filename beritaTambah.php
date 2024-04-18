<?php
    session_start();
    
    if(!isset($_COOKIE['user_login']) && !isset($_POST['username'])){
        header("location:login2.php");
    }

    include "utils.php";
    $db = new myDB();

    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        if (isset($_POST['simpan'])){
            $title = $_POST['judul-berita'];
            $description = $_POST['desc-berita'];
            $date = $_POST['tanggal-berita'];
            $db->insertNews($title, $description, $date);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="layout/indexstyle.css">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

    <link rel="stylesheet" href="layout/styleTambah.css">
    <title>Panti Surya | Tambah Berita</title>
</head>
<body>
    <div class="app">
        <div class="dashboard">
            <?php include 'nav.php'?>
            
            <div class="main">
                <h2>Tambah Berita</h2>

                <section>

                <h4>Data Berita</h4>
                <form action="" method="post">
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
</body>
</html>