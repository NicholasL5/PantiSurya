<?php
session_start();

if (!isset($_SESSION['user_login']) && !isset($_POST['username'])) {
    header("location:login2.php");
}

require "utils.php";

$db = new myDB();
$total_residents = 0;
$total_residents = $db->getCountPenduduk();


$stmt_unpaid = $db->prepare("SELECT COUNT(*) AS total_unpaid FROM rekam_medis WHERE sudah_bayar = 0");
$stmt_unpaid->execute();
$total_unpaid = $stmt_unpaid->fetch(PDO::FETCH_ASSOC)['total_unpaid'];
$stmt_all_residents = $db->prepare("SELECT * FROM penduduk");
$stmt_all_residents->execute();
$residents = $stmt_all_residents->fetchAll(PDO::FETCH_ASSOC);

// Search
$search_results = null;
if(isset($_POST['search'])) {
    $search_name = $_POST['search'];
    $stmt_search = $db->prepare("SELECT * FROM penduduk WHERE nama LIKE :name");
    $stmt_search->execute(['name' => '%' . $search_name . '%']);
    $residents = $stmt_search->fetchAll(PDO::FETCH_ASSOC);
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
    <title>Overview</title>
    <style>
      
        .search-bar {
            margin-bottom: 20px;
        }
        .search-input {
            width: 70%; 
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .search-button {
            padding: 10px 20px;
            border-radius: 5px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
        .search-button:hover {
            background-color: #0056b3;
        }
        .resident-table {
            width: 100%;
            border-collapse: collapse;
        }
        .resident-table th, .resident-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .resident-table th {
            background-color: #f2f2f2;
        }

        .overview-info{
           margin-bottom: 2rem;
        }

        .card{
            border-radius: 15px;
        }

        
    </style>
</head>
<body>
    <div class="app">
        <div class="dashboard">
            <?php include 'nav.php'?>
            <div class="main">
                <div class="pad">

                    <h1>Overview</h1>
                    <p>Hello, <?php echo isset($_SESSION["username"]) ? $_SESSION["username"] : 'N/A'; ?>👋</p>
                    <p style="font-style: italic;">Last Login: <?php echo isset($_SESSION["last_access"]) ? $_SESSION["last_access"] : 'N/A'; ?></p>
                    
                    <div class="overview-info row justify-content-between">
                        <div class="col">
                            <div class="card text-bg-primary">
                                <div class="row g-0">
                                    
                                    <div class="col">
                                        <div class="card-body">
                                            <h5 class="card-title">Jumlah penduduk</h5>
                                            <p class="card-text"><?php echo $total_residents ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card text-bg-danger">
                                <div class="row g-0">
                                    
                                    <div class="col">
                                        <div class="card-body">
                                            <h5 class="card-title">Pondokkan belum bayar</h5>
                                            <p class="card-text"><?php echo $total_unpaid ?></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card text-bg-success">
                                <div class="row g-0">
                                
                                    <div class="col">
                                        <div class="card-body">
                                            <h5 class="card-title">Pondokkan sudah bayar</h5>
                                            <p class="card-text">24</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        
                    </div>

                    <div class="search-bar">
                        <form method="POST">
                            <input type="text" name="search" placeholder="Search by name" class="search-input">
                            <button type="submit" class="search-button">Search</button>
                        </form>
                    </div>

                    <div class="residents-table">
                        <h3>All Residents</h3>
                        <table class="resident-table">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col" colspan="2" style="width: 60%;">Pilih Aksi </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                foreach($residents as $resident){
                                    echo
                                    '
                                    <tr>
                                    <td>'. $resident["nama"] .'</td>
                                    <td>
                                        <div class="dropdown">
                                        <button class="btn btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                            Pilih Menu
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="laporanobat.php?id='.$resident["id"].'">Lihat pengobatan</a></li>
                                            <li><a class="dropdown-item" href="laporanTabungan.php?id='.$resident["id"].'">Lihat tabungan</a></li>
                                            <li><a class="dropdown-item" href="laporanPondokkan.php?id='.$resident["id"].'">Lihat pondokkan</a></li>
                                        </ul>
                                        </div>
                                    </td>
                                    </tr>
                                    ';
                                }
                                    
                                ?>
                                
                                
                            </tbody>
                        </table>
                    </div>
                    
                    <?php include 'footer.php'?>
                </div>
            </div>
        </div>
        
    </div>

    <script>
        feather.replace()
    </script>
</body>
</html>
