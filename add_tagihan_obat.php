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
    $nomor = $_POST['nomor'];
    $deskripsi_obat = $_POST["deskripsi-obat"];
    $jenis_obat = $_POST["jenis-obat"];
    $obat = $_POST["obat"];
    $dosis = $_POST["dosis"];
    $tagihan = $_POST["tagihan"];
    $tanggal_berobat = $_POST["tanggal-berobat"];

    //  $jenis_obat, $obat, $dosis, 
    $db->updateObat($tagihan, $residentId);
    $db->tambahObat($nomor, $residentId, $deskripsi_obat, $tagihan, $tanggal_berobat);

    header("location: keuangan_obat.php");
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
                <form method="POST">

                    <div class="mb-3">
                        <label for="nomor" class="form-label">No.</label>
                        <input type="text" class="form-control" placeholder="" id="nomor" name="nomor">
                    </div>  

                    <div class="mb-3">
                        <label for="deskripsi-obat" class="form-label">Deskripsi</label>
                        <input type="text" class="form-control" placeholder="Masukkan deskripsi" id="deskripsi-obat" name="deskripsi-obat">
                    </div>
                    <!-- <div class="mb-3">
                        <label for="obat" class="form-label">Obat</label>
                        <input type="text" class="form-control" placeholder="Masukkan obat" id="obat" name="obat">
                    </div>
                    <div class="mb-3">
                        <label for="dosis">Dosis:</label>
                        <input type="number" id="dosis" name="dosis" placeholder="Masukkan dosis obatnya" class="form-control" min="0" step="1">
                    </div> -->

                    <div class="mb-3">
                        <label for="tagihan">Jumlah Tagihan:</label>
                        <input type="number" id="tagihan" name="tagihan" placeholder="Masukkan jumlah tagihan"
                            class="form-control" min="0" step="1">
                    </div>

                    <div class="mb-3">
                        <label for="tanggal-berobat" class="col-form-label">Tanggal:</label>
                        <input type="date" class="form-control" id="tanggal-berobat" name="tanggal-berobat">
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