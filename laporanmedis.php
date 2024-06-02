<?php
session_start();
if (!isset($_COOKIE['user_login']) && !isset($_POST['username'])) {
    header("location:login2.php");
}

require "utils.php";

$db = new myDB();

if(isset($_GET['id'])) {
    $penduduk_id = $_GET['id'];

    
    $stmt_records = $db->prepare("SELECT * FROM rekam_medis WHERE penduduk_id = :penduduk_id");
    $stmt_records->execute(['penduduk_id' => $penduduk_id]);
    $records = $stmt_records->fetchAll(PDO::FETCH_ASSOC);

    $stmt_penduduk = $db->prepare("SELECT * FROM penduduk WHERE id = :penduduk_id");
    $stmt_penduduk->execute(['penduduk_id' => $penduduk_id]);
    $penduduk = $stmt_penduduk->fetch(PDO::FETCH_ASSOC);
} else {
    
    header("location:index.php");
    exit;
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
    <title>Medical Records Report</title>
</head>
<body>
    <div class="app">
        <div class="dashboard">
            <?php include 'nav.php'?>
            
            <div class="main">
                <h2>Medical Records of <?php echo $penduduk['nama']; ?></h2>
                <div class="records-table">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Record ID</th>
                                <th>Description</th>
                                <th>Type</th>
                                <th>Medicine</th>
                                <th>Dosage</th>
                                <th>Date of Treatment</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($records as $record): ?>
                            <tr>
                                <td><?php echo $record['pengobatan_id']; ?></td>
                                <td><?php echo $record['deskripsi']; ?></td>
                                <td><?php echo $record['jenis']; ?></td>
                                <td><?php echo $record['obat']; ?></td>
                                <td><?php echo $record['dosis']; ?></td>
                                <td><?php echo $record['tanggal_berobat']; ?></td>
                                <td><?php echo $record['sudah_bayar'] == 0 ? 'Unpaid' : 'Paid'; ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <a href="index.php" class="btn btn-primary">Back to Overview</a>
            </div>
        </div>
    </div>

    <script>
        feather.replace()
    </script>
</body>
</html>