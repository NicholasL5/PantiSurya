<?php
session_start();

if (!isset($_COOKIE['user_login']) && !isset($_SESSION['username'])) {
    header("location:login2.php");
    exit();
}

require "utils.php";

$db = new myDB();


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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="layout/indexstyle.css">
    <title>Keuangan Pondokkan</title>
</head>
<body>
    <div class="app">
        <div class="dashboard">
            <?php include 'nav.php'?>
            
            <div class="main">
                <h2>KEUANGAN PONDOKKAN</h2>
                <div class="search-bar">
                    <form method="POST" class="d-flex">
                        <input type="text" name="search" placeholder="Search by name" class="form-control me-2">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>

                <div class="residents-table">
                    <h3>Daftar Penduduk</h3>
                    <table class="table table-striped" id="tabelPondokan">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Keuangan Pondokkan</th>
                                <th>Lihat Laporan Keuangan</th>
                                
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($residents as $resident): ?>
                            <tr>
                                <td><?php echo $resident['nama']; ?></td>
                                <td><?php echo $resident['keuangan_pondokkan']; ?></td>
                                <td><button onclick="window.location.href='laporanPondokkan.php?id=<?php echo $resident['id']; ?>'" class="btn btn-primary">View Laporan Keuangan</button></td>
                                
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
