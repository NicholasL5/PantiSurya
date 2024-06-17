<?php
session_start();

if (!isset($_COOKIE['user_login']) && !isset($_SESSION['username'])) {
    header("location:login2.php");
    exit();
}

require "utils.php";

$db = new myDB();

$stmt_residents = $db->prepare("SELECT COUNT(*) AS total_residents FROM penduduk");
$stmt_residents->execute();
$total_residents = $stmt_residents->fetch(PDO::FETCH_ASSOC)['total_residents'];
$stmt_unpaid = $db->prepare("SELECT COUNT(*) AS total_unpaid FROM rekam_medis WHERE sudah_bayar = 0");
$stmt_unpaid->execute();
$total_unpaid = $stmt_unpaid->fetch(PDO::FETCH_ASSOC)['total_unpaid'];

$stmt_all_residents = $db->getAllPenduduk();
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
    <link rel="stylesheet" href="layout/styledatasiswa.css">
    <title>Keuangan Obat</title>
</head>
<body>
    <div class="app">
        <div class="dashboard">
            <?php include 'nav.php'?>
            
            <div class="main">
                <div class="pad">
                    <h1>KEUANGAN OBAT</h1>
            
                    <div class="search-bar">
                        <form method="POST" class="d-flex">
                            <input type="text" name="search" placeholder="Search by name" class="form-control me-2">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                    </div>

                    <div class="residents-table">
                        <h3 style="padding: 1rem; padding-left: 0;">Daftar Penduduk</h3>
                        <div class="content">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Keuangan obat</th>
                                        <th>View Laporan Keuangan</th>
                                    
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider">
                                    <?php foreach($residents as $resident): ?>
                                    <tr>
                                        <td><?php echo $resident['nama']; ?></td>
                                        <td><?php echo $db->formatRupiah($resident['keuangan_obat']); ?></td>
                                        <td><button onclick="window.location.href='laporanobat.php?id=<?php echo $resident['id']; ?>'" class="btn btn-primary">View Laporan Keuangan</button></td>
                                        <!-- <td><a href="edit_balance_obat.php?id=<?php echo $resident['id']; ?>" class="btn btn-primary">Edit</a></td> -->
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
