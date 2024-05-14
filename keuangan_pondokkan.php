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
                <p>Hello, <?php echo isset($_SESSION["username"]) ? $_SESSION["username"] : 'N/A'; ?>👋</p>
                <p style="font-style: italic;">Last Login: <?php echo isset($_SESSION["last_access"]) ? $_SESSION["last_access"] : 'N/A'; ?></p>

                <div class="search-bar">
                    <form method="POST" class="d-flex">
                        <input type="text" name="search" placeholder="Search by name" class="form-control me-2">
                        <button type="submit" class="btn btn-primary">Search</button>
                    </form>
                </div>

                <div class="residents-table">
                    <h3>All Residents</h3>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Keuangan Pondokkan</th>
                                <th>View Laporan Keuangan</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($residents as $resident): ?>
                            <tr>
                                <td><?php echo $resident['nama']; ?></td>
                                <td><?php echo $resident['keuangan_pondokkan']; ?></td>
                                <td><button onclick="window.location.href='laporankeuangan.php?id=<?php echo $resident['id']; ?>'" class="btn btn-primary">View Laporan Keuangan</button></td>
                                <td><a href="edit_balance_pondokkan.php?id=<?php echo $resident['id']; ?>" class="btn btn-primary">Edit</a></td>
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
