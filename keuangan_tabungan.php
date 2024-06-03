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
    <title>Keuangan Tabungan</title>
</head>
<body>
    <script src="js/dataTabungan.js"></script>


    <div class="app">
        <div class="dashboard">
            <?php include 'nav.php'?>
            
            <div class="main">
                <h2>KEUANGAN TABUNGAN</h2>
                
                <div class="search-bar">
                    <form method="POST" class="d-flex">
                        <input type="text" name="search" placeholder="Search by name" id="search_by_name" class="form-control me-2">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>

                <div class="residents-table">
                    <h3>All Residents</h3>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Keuangan Tabungan</th>
                                <th>View Laporan Keuangan</th>
                            </tr>
                        </thead>
                        <tbody id="list_tabungan">
                            
                        </tbody>
                    </table>
                </div>

                <?php include 'footer.php'?>
            </div>
        </div>
    </div>
</body>
</html>
