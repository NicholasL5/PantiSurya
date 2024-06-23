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


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['edit'])) {
        $id = $_GET["id"];
        $residentId = $_GET['id'];
        $stmt = $db->getPenduduk($residentId);
        $res = $stmt->fetch(PDO::FETCH_ASSOC);


        
        $targetDir = "deposit/" . $res['nama'] . "/";

        if (isset($_FILES['kwitansi']) && $_FILES['kwitansi']['error'] != UPLOAD_ERR_NO_FILE) {
            $basename = basename($_FILES['kwitansi']['name']);
            $uploadFile = $targetDir . $basename;

            $imageFileTypeKTP = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
            $uploadOkKTP = 1;

            // Check if image file is a actual image or fake image
            $checkKTP = getimagesize($_FILES['kwitansi']['tmp_name']);
            if ($checkKTP === false) {
                echo "File is not an image.";
                $uploadOkKTP = 0;
            }

            // Check if file already exists
            if (file_exists($uploadFile)) {
                echo "Sorry, file already exists.";
                $uploadOkKTP = 0;
            }

            // Allow certain file formats
            if ($imageFileTypeKTP != 'jpg' && $imageFileTypeKTP != 'png' && $imageFileTypeKTP != 'jpeg') {
                echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
                $uploadOkKTP = 0;
            }

            if ($uploadOkKTP == 1) {
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                if (move_uploaded_file($_FILES['kwitansi']['tmp_name'], $uploadFile)) {
                    // File uploaded successfully, update database
                    $db->updateBuktiKwitansi($id, $basename);
                } else {
                    echo "Sorry, there was an error uploading your KTP file.";
                }
            }
        }

        if (isset($_FILES['deposit']) && $_FILES['deposit']['error'] != UPLOAD_ERR_NO_FILE) {
            $basename = basename($_FILES['deposit']['name']);
            $uploadFileKK = $targetDir . $basename;
            $imageFileTypeKK = strtolower(pathinfo($uploadFileKK, PATHINFO_EXTENSION));
            $uploadOkKK = 1;

            // Check if image file is a actual image or fake image
            $checkKK = getimagesize($_FILES['deposit']['tmp_name']);
            if ($checkKK === false) {
                echo "File is not an image.";
                $uploadOkKK = 0;
            }

            // Check if file already exists
            if (file_exists($uploadFileKK)) {
                echo "Sorry, file already exists.";
                $uploadOkKK = 0;
            }

            // Allow certain file formats
            if ($imageFileTypeKK != 'jpg' && $imageFileTypeKK != 'png' && $imageFileTypeKK != 'jpeg') {
                echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
                $uploadOkKK = 0;
            }

            if ($uploadOkKK == 1) {
                if (!is_dir($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                if (move_uploaded_file($_FILES['deposit']['tmp_name'], $uploadFileKK)) {
                    // File uploaded successfully, update database
                    $db->updateBuktiDeposit($id, $basename);
                } else {
                    echo "Sorry, there was an error uploading your KK file.";
                }
            }
        }
    }

    header("location:keuanganDeposit.php");
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

        .prev-pic {
            width: 200px;
            height: 200px;
            padding: 10px;
        }
    </style>
</head>

<body>
    <div class="app">
        <div class="dashboard">
            <?php include 'nav.php' ?>
            <div class="column" style="margin-left:20px; padding-bottom: 2rem;">
                <h1>Edit Bukti Deposit - <?php echo $resident['nama']; ?></h1>
                <form id="laporanDeposit.php" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="kwitansi">Kwitansi:</label>
                        <input type="file" class="form-control" id="kwitansi" name="kwitansi" >
                           
                        <img id="kwitansi-preview" alt="Bukti kwitansi" class="prev-pic" src="deposit/<?php echo $resident['nama'] ?>/<?php echo $resident['kwitansi_path'] ?>">

                    </div>

                    <div class="mb-3">
                        <label for="deposit">Deposit:</label>
                        <input type="file" class="form-control" id="deposit" name="deposit" >
                         
                        <img id="deposit-preview" alt="Bukti deposit" class="prev-pic" src="deposit/<?php echo $resident['nama'] ?>/<?php echo $resident['bukti_path'] ?>">
                        
                    </div>

                    <button type="submit" name="edit" class="btn btn-primary">Simpan Perubahan</button>
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
            document.getElementById('kwitansi').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById('kwitansi-preview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('deposit').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById('deposit-preview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });



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