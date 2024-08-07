<?php
session_start();

if (!isset($_COOKIE['user_login']) && !isset($_SESSION['username'])) {
    header("location:login2.php");
    exit();
}

require 'utils.php';

$db = new myDB();
$stmt_all_residents = $db->getAllPenduduk();
$residents = $stmt_all_residents->fetchAll(PDO::FETCH_ASSOC);

// Search
$search_results = null;
if(isset($_POST['search'])) {
    $search_name = $_POST['search'];

    $stmt_search = $db->search($search_name);
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
    <title>Keuangan Pondokkan</title>
</head>
<body>
    <script src="js/dataPondokan.js"></script>

    <div class="app">
        <div class="dashboard">
            <?php include 'nav.php'?>
            
            <div class="main">
            <?php include 'nav2.php' ?>
                <div class="pad">

                
                    <h1>KEUANGAN PONDOKKAN</h1>
                    <div class="search-bar">
                        <form method="POST" class="d-flex">
                            <input type="text" name="search" placeholder="Search by name" id="search_by_name" class="form-control me-2">
                            <button type="submit" class="btn btn-primary">Search</button>
                        </form>
                    </div>

                    <div class="residents-table">
                        <h3 style="padding: 1rem; padding-left: 0;">Daftar Penduduk</h3>
                        <div class="content">
                            <table class="table table-hover table-striped" id="tabelPondokan">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Tagihan Keuangan Pondokkan</th>
                                        <th>Lihat Laporan Keuangan</th>
                                        
                                    </tr>
                                </thead>
                                <tbody class="table-group-divider" id="tabelPondokanBody">
                                    <?php if (empty($residents)){?>
                                    <tr><td colspan="3">No data found</td></tr>
                                    <?php };?>
                                    <?php foreach($residents as $resident): ?>
                                    <tr>
                                        <td><?php echo $resident['nama']; ?></td>
                                        <td><?php echo $db->formatRupiah($resident['keuangan_pondokkan']); ?></td>
                                        <td><button onclick="window.location.href='laporanPondokkan.php?id=<?php echo $resident['id']; ?>'" class="btn btn-primary">View Laporan Tabungan</button></td>
                                        <!-- <td><a href="edit_balance_obat.php?id=<?php echo $resident['id']; ?>" class="btn btn-primary">Edit</a></td> -->
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        
                    </div>

                    <?php include 'footer.php'?>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('mybtn').addEventListener('click', function() {
            var holder = document.querySelector('.holder');
            holder.classList.toggle('open');
        });
    </script>
</body>
</html>
