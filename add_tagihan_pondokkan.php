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
    $tagihan = $_POST["addBalance"];
    $tagihan_date = $_POST["tanggal-pondokkan"];
    echo $tagihan_date;

    $db->updatePondokkan($tagihan, $residentId);
    $db->tambahPondokkan($residentId, $tagihan, $tagihan_date);

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
                    <div>
                        <label for="addBalance">Add Balance:</label>
                        <input type="number" id="addBalance" name="addBalance" placeholder="Enter amount to add"
                            class="form-control" min="0" step="1">
                    </div>

                    <div class="mb-3">
                        <label for="recipient-name" class="col-form-label">Tanggal:</label>
                        <input type="date" class="form-control" id="tanggal-pondokkan" name="tanggal-pondokkan">
                    </div>

                    <button type="submit" class="btn btn-primary" style="margin-top:10px">Save Changes</button>
                </form>
            </div>

            <?php if (!empty($alertMessage)): ?>
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