<?php
session_start();

if (!isset($_COOKIE['user_login']) && !isset($_SESSION['username'])) {
    header("location:login2.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("location:overview.php");
    exit();
}

require "utils.php";

$db = new myDB();

$residentId = $_GET['id'];

$stmt_resident = $db->prepare("SELECT * FROM penduduk WHERE id = :residentId");
$stmt_resident->execute(['residentId' => $residentId]);
$resident = $stmt_resident->fetch(PDO::FETCH_ASSOC);

if (!$resident) {
    header("location:overview.php");
    exit();
}

include "utils/resize_image.php";
define('UPLOAD_DIR', 'keuangan/pondokkan/');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // $tagihan = $_POST["addBalance"];
    // $ruangan = $_
    $ruanganData = $_POST["ruanganData"];
    list($tagihan, $ruangan) = explode('|', $ruanganData);
    $tagihan_date = $_POST["tanggal-pondokkan"];
    echo $tagihan_date;

    $db->updatePondokkan($tagihan, $residentId);
    $db->tambahPondokkan($residentId, $tagihan, $ruangan, $tagihan_date);

    header("location: keuangan_pondokkan.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php include "layout/stylejquerynbs5.php" ?>
    <link rel="stylesheet" href="layout/indexstyle.css">
    <link rel="stylesheet" href="layout/stylelihat.css">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <title>Buat Tagihan - <?php echo $resident['nama']; ?></title>
</head>

<body>
    <div class="app">
        <div class="dashboard">
            <?php include 'nav.php' ?>
            <div class="column" style="margin-left:20px">
                <h1>Buat Tagihan - <?php echo $resident['nama']; ?></h1>
                <form id="balanceForm" method="POST">
                    <!-- <div>
                        <label for="addBalance">Add Balance:</label>
                        <input type="number" id="addBalance" name="addBalance" placeholder="Enter amount to add"
                            class="form-control" min="0" step="1">
                    </div> -->

                    <select class="form-select" aria-label="Default select example" name="ruanganData">
                        <option selected>Pilih Jenis Ruangan dan Jumlah Tagihan</option>
                        <option value="5250000|Ruangan Betesda">Ruangan Betesda Rp 5.250.000</option>
                        <option value="2000000|Ruangan Anggrek">Ruangan Anggrek Rp 2.000.000</option>
                        <option value="1600000|Ruangan Seruni">Ruangan Seruni Rp 1.600.000</option>
                        <option value="1250000|Ruangan Mawar">Ruangan Mawar Rp 1.250.000</option>
                        <option value="1250000|Ruangan Melati">Ruangan Melati Rp 1.250.000</option>
                        <option value="1250000|Ruangan Anyelir">Ruangan Anyelir Rp 1.250.000</option>
                        <option value="1250000|Ruangan Dahlia">Ruangan Dahlia Rp 1.250.000</option>
                    </select>

                    <!-- <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Centered dropdown
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">Ruangan Betesda Rp 5.250.000</a></li>
                            <li><a class="dropdown-item" href="#">Ruangan Anggrek Rp 2.000.00</a></li>
                            <li><a class="dropdown-item" href="#">Ruangan Seruni Rp 1.600.00</a></li>
                            <li><a class="dropdown-item" href="#">Ruangan Mawar Rp 1.250.000</a></li>
                            <li><a class="dropdown-item" href="#">Ruangan Melati Rp 1.250.000</a></li>
                            <li><a class="dropdown-item" href="#">Ruangan Anyelir Rp 1.250.000</a></li>
                            <li><a class="dropdown-item" href="#">Ruangan Dahlia Rp 1.250.000</a></li>
                        </ul>
                    </div> -->

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Tanggal:</label>
                        <input type="date" class="form-control" id="tanggal-pondokkan" name="tanggal-pondokkan">
                    </div>

                    <button type="submit" class="btn btn-primary" style="margin-top:10px">Save Changes</button>
                </form>
            </div>

            <?php if (!empty($alertMessage)) : ?>
                <div>
                    <script>
                        alert("<?php echo $alertMessage; ?>");
                        window.location.href = "keuangan_pondokkan.php";
                    </script>
                </div>
            <?php endif; ?>

        </div>
    </div>
</body>

</html>