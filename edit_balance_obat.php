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

$alertMessage = '';

include "utils/resize_image.php";
define('UPLOAD_DIR','keuangan/obat/');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $tagihanId = $_POST['tagihan'];
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
    

    $db->insertGambarObat($tagihanId, $profilePictureDirectory);
     // Retrieve the sum of tagihan amounts where status is 0
     $stmt_tagihan = $db->prepare("SELECT SUM(tagihan) AS total_tagihan FROM rekam_medis WHERE sudah_bayar = 0 and penduduk_id = $residentId");
     $stmt_tagihan->execute();
     $totalTagihan = $stmt_tagihan->fetch(PDO::FETCH_ASSOC)['total_tagihan'];
 
     // Update the balance in the database
     $stmt_update_balance = $db->prepare("UPDATE penduduk SET keuangan_obat = :totalTagihan WHERE id = :residentId");
     $stmt_update_balance->execute(['totalTagihan' => $totalTagihan, 'residentId' => $residentId]);
 
    header("location: keuangan_obat.php");

    // echo "Tes";
}
$res = $db->searchObatUnpaid("", $_GET['id']);

// Initialize options string
$options = '';
$defaultTagihanId = isset($_GET['tagihanId']) ? $_GET['tagihanId'] : null; // Define a default tagihan ID

if ($res->rowCount() > 0) {
    $isFirstOption = true; // Variable to track the first option
    while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
        // Check if there's a default tagihan ID and if the current tagihan ID matches it
        $selected = ($defaultTagihanId !== null && $row['pengobatan_id'] == $defaultTagihanId) ? 'selected' : '';
        // Append the option with the selected attribute if it matches the default tagihan ID
        $options .= '<option value="' . $row['pengobatan_id'] . '" ' . $selected . '>' . $row['tagihan'] . '</option>';
        $isFirstOption = false; // Set to false after the first iteration
    }
} else {
    // No data found message
    $options = '<option>No data found</option>';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="layout/indexstyle.css">
    <link rel="stylesheet" href="layout/stylelihat.css">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <title>Edit Balance - <?php echo $resident['nama']; ?></title>

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
            <div class="column" style="margin-left:20px">
                <h1>Edit Balance - <?php echo $resident['nama']; ?></h1>
                <form id="balanceForm" method="POST" enctype="multipart/form-data">
                    <h4>Select Tagihan</h4>
                    <select class="form-select" name="tagihan" aria-label="Default select example" style="margin-bottom:10px">
                        <option selected>Open this select menu</option>
                        <?php echo $options; ?>
                    </select>

                    <div class="mb-3">
                        <label for="imageInput" class="form-label">

                            </svg> <h5>Upload Kwitansi</h5></label>
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