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
    <title>Keuangan Tabungan</title>
</head>
<body>

    <!-- <script src="js/dataTabungan.js"></script> -->
    <script>
        $(document).ready(function(){
            <?php if ($_SESSION["tesswal"]){ ?>
                myalert("Berhasil!", "Berhasil edit tabungan", "success");

            <?php }else{ ?>
                myalert("Error!", "Ada masalah dalam menambah tabungan", "error");

            <?php }; unset($_SESSION['tesswal']); ?>    
            
            function myalert(titles, texts, icons){
                Swal.fire({
                    title: titles,
                    text: texts,
                    icon: icons
                });
            }

            

        });
    </script>

    <div class="app">
        <div class="dashboard">
            <?php include 'nav.php'?>
            
            <div class="main">
                <div class="pad">
                <h1>KEUANGAN TABUNGAN</h1>
                
                <div class="search-bar">
                    <form method="POST" class="d-flex">
                        <input type="text" name="search" placeholder="Search by name" id="search_by_name" class="form-control me-2">
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
                                    <th>Keuangan Tabungan</th>
                                    <th>View Laporan Keuangan</th>
                                </tr>
                            </thead>
                            <tbody class="table-group-divider" id="list_tabungan">
                                <?php if (empty($residents)){?>
                                <tr><td colspan="3">No data found</td></tr>
                                <?php };?>
                                <?php foreach($residents as $resident): ?>
                                <tr>
                                    <td><?php echo $resident['nama']; ?></td>
                                    <td><?php echo $db->formatRupiah($resident['keuangan_tabungan']); ?></td>
                                    <td><button onclick="window.location.href='laporanTabungan.php?id=<?php echo $resident['id']; ?>'" class="btn btn-primary">View Laporan Tabungan</button></td>
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
</body>
</html>
