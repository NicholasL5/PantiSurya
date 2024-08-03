<?php
session_start();
require 'utils.php';

$db = new myDB();

$residentId = $_GET['id'] ?? null;
if (!$residentId) {
    header("location:overview.php");
    exit();
}

$stmt = $db->getPenduduk($residentId);
$resident = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$resident) {
    header("location:overview.php");
    exit();
}

$alertMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['edit'])) {
    $targetDir = "deposit/" . $resident['nama'] . "/";

    if (isset($_FILES['kwitansi']) && $_FILES['kwitansi']['error'] != UPLOAD_ERR_NO_FILE) {
        $fileExtension = pathinfo(basename($_FILES['kwitansi']['name']), PATHINFO_EXTENSION);
        $basename = "kwitansi-" . $resident['nama'] . '.' . $fileExtension;
        $uploadFile = $targetDir . $basename;

        $imageFileTypeKTP = strtolower($fileExtension);
        $uploadOkKTP = 1;

        $checkKTP = getimagesize($_FILES['kwitansi']['tmp_name']);
        if ($checkKTP === false) {
            $alertMessage = "File is not an image.";
            $uploadOkKTP = 0;
        }

        if (!in_array($imageFileTypeKTP, ['jpg', 'png', 'jpeg'])) {
            $alertMessage = "Sorry, only JPG, JPEG, & PNG files are allowed.";
            $uploadOkKTP = 0;
        }

        if ($uploadOkKTP == 1) {
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            if (move_uploaded_file($_FILES['kwitansi']['tmp_name'], $uploadFile)) {
                $db->updateBuktiKwitansi($residentId, $basename);
                $alertMessage = "Kwitansi uploaded successfully.";
            } else {
                $alertMessage = "Sorry, there was an error uploading your kwitansi.";
            }
        }
    }

    if (isset($_FILES['deposit']) && $_FILES['deposit']['error'] != UPLOAD_ERR_NO_FILE) {
        $fileExtension = pathinfo(basename($_FILES['deposit']['name']), PATHINFO_EXTENSION);
        $basename = "bukti-" . $resident['nama'] . '.' . $fileExtension;
        $uploadFile = $targetDir . $basename;

        $imageFileTypeKK = strtolower($fileExtension);
        $uploadOkKK = 1;

        $checkKK = getimagesize($_FILES['deposit']['tmp_name']);
        if ($checkKK === false) {
            $alertMessage = "File is not an image.";
            $uploadOkKK = 0;
        }

        if (!in_array($imageFileTypeKK, ['jpg', 'png', 'jpeg'])) {
            $alertMessage = "Sorry, only JPG, JPEG, & PNG files are allowed.";
            $uploadOkKK = 0;
        }

        if ($uploadOkKK == 1) {
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            if (move_uploaded_file($_FILES['deposit']['tmp_name'], $uploadFile)) {
                $db->updateBuktiDeposit($residentId, $basename);
                $alertMessage = "Deposit uploaded successfully.";
            } else {
                $alertMessage = "Sorry, there was an error uploading your deposit.";
            }
        }
    }
    $_SESSION['alertmsg'] = $alertMessage;
    // if ($alertMessage) {
    //     echo "alert($alertMessage)";
    // } 
    header("Location:keuangan_deposit.php");
    
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
            <div class="main">
            <?php include 'nav2.php' ?>
                <div class="pad" style="padding-left: 0;padding-top:0;">
                <div class="column" style="padding-bottom: 2rem;">
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
                        <button type="button" onclick="window.location.href='keuangan_deposit.php'" name="edit" class="btn btn-danger">Kembali</button>
                    </form>
                </div>
                </div>
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
    <script>
        document.getElementById('mybtn').addEventListener('click', function() {
            var holder = document.querySelector('.holder');
            holder.classList.toggle('open');
        });
    </script>
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