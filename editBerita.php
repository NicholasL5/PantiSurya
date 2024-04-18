<?php
    session_start();
    if(!isset($_COOKIE['user_login']) && !isset($_POST['username'])){
        header("location:login2.php");
    }

    require "utils.php";

    $db = new myDB();

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
            $db->editNews($title, $description, $date, $id);
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="layout/indexstyle.css">
    <link rel="stylesheet" href="layout/stylelihat.css">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <title>Panti Surya | Lihat Penduduk</title>
</head>
<body>
    <div class="app">
        <div class="dashboard">
            <?php include 'nav.php'?>
            
            <div class="main">
                <div class="profile lr-9">
                    <!-- <img src="images/noimg-removebg-preview.png" alt="no-image"> -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-book"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"></path><path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"></path></svg>
                    <div class="profile-info">
                        <h2><?php echo $title; ?></h2>
                        
                    </div>
                    
                </div>

                <div class="description lr-9">
                    <h5>Title</h5>
                    <p><?php
        $row = $newsItem->fetch(PDO::FETCH_ASSOC);
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
                <form action="" method="post">
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
    


    <script>
        feather.replace()
    </script>
</body>
</html>