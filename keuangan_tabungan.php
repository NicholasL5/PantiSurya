<?php
session_start();

if (!isset($_COOKIE['user_login']) && !isset($_SESSION['username'])) {
    header("location:login2.php");
    exit();
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
    <script src="js/dataTabungan.js"></script>


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
