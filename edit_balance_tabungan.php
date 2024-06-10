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
$res = $db->getPenduduk($residentId);
$resident = $res->fetch(PDO::FETCH_ASSOC);
$uang = $db->getJumlahTabungan($residentId);

if (!$resident) {
    header("location:overview.php");
    exit();
}

$alertMessage = '';

// if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addBalance']) && isset($_POST['transaksi'])) {
    
//     if ($_POST['transaksi'] == 0){
//         $mul = 1;
//         $type = "debit";
//     }else{
//         $mul = -1;
//         $type = "kredit";
//     }

//     $jumlah = intval($_POST['addBalance']) * $mul;
//     $db->addDataTabungan($jumlah, $type, $residentId);
//     $db->updateTabunganPenduduk($residentId);
//     header("location: keuangan_tabungan.php");
// }

include "utils/resize_image.php";
define('UPLOAD_DIR','keuangan/tabungan/');
$tagihanId = $_GET["tagihanId"];
$id = $_GET["id"];
// echo $id;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // $id = $_GET["tagihanId"];
    // echo $id;
    // Upload profile picture ke directory lalu get directory name
    // Get the tmp file from server as image
    $image = file_get_contents($_FILES["imageChooser"]["tmp_name"]);

    // Make file with name uniqid().jpg
    $file_name = uniqid().'.jpg';
    // $foto = 'poster/'.$file_name;
    $file = UPLOAD_DIR.$file_name;
    $success = file_put_contents($file, $image);
    // echo var_dump($success);

    //Resize and Compress Image
    list($width, $height, $type) = getimagesize($file);
    $img = resize_image($file, $width, $height, TRUE);
    imagejpeg($img, $file, 90);
    // echo "test";

    $profilePictureDirectory = $file;
    

    $db->insertGambarTabungan($tagihanId, $profilePictureDirectory);
    header("location: laporanTabungan.php?id=$id");

//     // echo "Tes";
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
    <title>Edit Tabungan - <?php echo $resident['nama']; ?></title>

    <style>
        #display-image {
            width: 300px;
            height: 300px;
            border: 1px solid black;
            background-position: center;
            background-size: cover;
        }
    </style>
</head>

<body>
    <div class="app">
        <div class="dashboard">
            <?php include 'nav.php' ?>
            <div class="column" style="margin-left:20px; padding-bottom: 2rem;">
                <h1>Edit Balance - <?php echo $resident['nama']; ?></h1>
                <h4>Jumlah Tabungan Sekarang: Rp.<?php echo $db->formatRupiah($uang['keuangan_tabungan']); ?></h4>
                <form id="balanceForm" method="POST" enctype="multipart/form-data">
                    <!-- <div class="mb-3">
                        <label for="addBalance">Masukkan Jumlah:</label>
                        <input type="number" id="addBalance" name="addBalance" placeholder="Enter amount to add"
                            class="form-control" min="0" step="1000">
                    </div>

                    <div class="mb-3">
                        <label for="" class="col-form-label">Tipe Transaksi:</label>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="transaksi" value=0 id="RadioTransaksi1" checked>
                            <label class="form-check-label" for="RadioTransaksi1">
                                Debit (+)
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="transaksi" value=1 id="RadioTransaksi2">
                            <label class="form-check-label" for="flexRadioDefault2">
                                Kredit (-)
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="addDesc">Masukkan Deskripsi:</label>
                        <textarea class="form-control" id="textareaTabungan" rows="5" name="addDesc" placeholder="Enter your text here..."></textarea>
                        
                    </div> -->

                    <div class="mb-3">
                        <label for="imageInput" class="form-label">

                        Upload Kwitansi
                        </label>
                        <input class="form-control mb-3" type="file" id="image-input"
                            accept="image/jpeg, image/jpg, image/png" name="imageChooser">
                        <div id="display-image"></div>
                        <small id="imageHelp" class="form-text text-muted">Upload bukti transfer (Disarankan gambar 1x1 dan menerima .png/.jpg/.jpeg)</small>
                    </div>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
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
    <script>
        const image_input = document.querySelector("#image-input");
        image_input.addEventListener("change", function() {
            const reader = new FileReader();
            reader.addEventListener("load", () => {
            const uploaded_image = reader.result;
            document.querySelector("#display-image").style.backgroundImage = `url(${uploaded_image})`;
            });
            reader.readAsDataURL(this.files[0]);
        });
    </script>
</html>