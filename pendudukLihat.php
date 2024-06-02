<?php
session_start();

require "utils.php";

if (!isset($_COOKIE['user_login']) && !isset($_POST['username'])) {
    header("location:login2.php");
}


if (isset($_GET["id"])) {
    // echo "masuk";
    $id = $_GET["id"];
    $username = $_GET["username"];

    $db = new myDB();
    $res = $db->getPenduduk($id);
    $fetch_data = $res->fetch(PDO::FETCH_OBJ);

    $image = $db->getGambarById($id);
    // var_dump($image);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['edit'])) {
        $alamat = $_POST['alamat'];
        $email = $_POST['email'];
        $noTelpon = $_POST['noTelpon'];

        if (isset($_FILES['KTP'])) {
            $uploadDirKTP = 'images/'; // Directory to save the uploaded KTP file
            $uploadFileKTP = $uploadDirKTP . basename($_FILES['KTP']['name']);
            $imageFileTypeKTP = strtolower(pathinfo($uploadFileKTP, PATHINFO_EXTENSION));
            $uploadOkKTP = 1;

            // Check if image file is a actual image or fake image
            $checkKTP = getimagesize($_FILES['KTP']['tmp_name']);
            if ($checkKTP === false) {
                echo "File is not an image.";
                $uploadOkKTP = 0;
            }

            // Check if file already exists
            if (file_exists($uploadFileKTP)) {
                echo "Sorry, file already exists.";
                $uploadOkKTP = 0;
            }

            // Allow certain file formats
            if ($imageFileTypeKTP != 'jpg' && $imageFileTypeKTP != 'png' && $imageFileTypeKTP != 'jpeg') {
                echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
                $uploadOkKTP = 0;
            }

            if ($uploadOkKTP == 1) {
                if (move_uploaded_file($_FILES['KTP']['tmp_name'], $uploadFileKTP)) {
                    // File uploaded successfully, update database
                    $db->updateGambarById($id, 'KTP', $uploadFileKTP);
                } else {
                    echo "Sorry, there was an error uploading your KTP file.";
                }
            }
        }

        if (isset($_FILES['KK'])) {
            $uploadDirKK = 'images/'; // Directory to save the uploaded KK file
            $uploadFileKK = $uploadDirKK . basename($_FILES['KK']['name']);
            $imageFileTypeKK = strtolower(pathinfo($uploadFileKK, PATHINFO_EXTENSION));
            $uploadOkKK = 1;

            // Check if image file is a actual image or fake image
            $checkKK = getimagesize($_FILES['KK']['tmp_name']);
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
                if (move_uploaded_file($_FILES['KK']['tmp_name'], $uploadFileKK)) {
                    // File uploaded successfully, update database
                    $db->updateGambarById($id, 'KK', $uploadFileKK);
                } else {
                    echo "Sorry, there was an error uploading your KK file.";
                }
            }
        }

        if (isset($_FILES['BPJS'])) {
            $uploadDirBPJS = 'images/'; // Directory to save the uploaded BPJS file
            $uploadFileBPJS = $uploadDirBPJS . basename($_FILES['BPJS']['name']);
            $imageFileTypeBPJS = strtolower(pathinfo($uploadFileBPJS, PATHINFO_EXTENSION));
            $uploadOkBPJS = 1;

            // Check if image file is a actual image or fake image
            $checkBPJS = getimagesize($_FILES['BPJS']['tmp_name']);
            if ($checkBPJS === false) {
                echo "File is not an image.";
                $uploadOkBPJS = 0;
            }

            // Check if file already exists
            if (file_exists($uploadFileBPJS)) {
                echo "Sorry, file already exists.";
                $uploadOkBPJS = 0;
            }

            // Allow certain file formats
            if ($imageFileTypeBPJS != 'jpg' && $imageFileTypeBPJS != 'png' && $imageFileTypeBPJS != 'jpeg') {
                echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
                $uploadOkBPJS = 0;
            }

            if ($uploadOkBPJS == 1) {
                if (move_uploaded_file($_FILES['BPJS']['tmp_name'], $uploadFileBPJS)) {
                    // File uploaded successfully, update database
                    $db->updateGambarById($id, 'BPJS', $uploadFileBPJS);
                } else {
                    echo "Sorry, there was an error uploading your BPJS file.";
                }
            }
        }
        // $KTP = $_POST['ktp'];
        // $KK = $_POST['kk'];
        // $BPJS = $_POST['bpjs'];
        $db->editPenduduk($alamat, $email, $noTelpon, $id);
        // $db->editPenduduk($alamat, $email, $noTelpon, $KTP, $KK, $BPJS, $id);
        header("Location: penduduk.php");
    }
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
    <title>Panti Surya | Lihat Penduduk</title>
    <style>
        .profile-picture {
            border-radius: 50%;
            width: 200px;
            height: 200px;
            object-fit: cover;
            object-position: center;
        }

        .fallback-picture {
            display: none;
            border-radius: 50%;
            width: 200px;
            height: 200px;
        }

        .prev-pic {
            width: 200px;
            height: 200px;
            padding: 10px;
        }
    </style>
</head>

<body>
    <script src="js/penduduk_lihat.js"></script>

    <div class="app">
        <div class="dashboard">
            <?php include 'nav.php' ?>

            <div class="main">
                <img src="svg/arrow-left.svg" class="back" alt="" onclick="history.back()">
                <div class="profile lr-9">
                    <img src="<?= htmlspecialchars($image['profile_picture']); ?>" alt="Profile Picture"
                        class="profile-picture" onerror="showFallback(this)">
                    <img src="svg/abstract-user-flat-3.svg" alt="Fallback SVG" class="fallback-picture">
                    <div class="profile-info">
                        <h2><?php echo $username; ?></h2>

                        <button type="button" class="btn btn-outline-primary" id="addPengobatan" data-bs-toggle="modal"
                            data-bs-target="#ModalTambahPengobatan" style="width: 100%;">
                            Tambah Pengobatan
                        </button>

                    </div>

                </div>

                <div class="description lr-9">
                    <h5>Alamat</h5>
                    <p><?php echo $fetch_data->alamat; ?></p>

                    <h5>Email wali</h5>
                    <p><?php echo $fetch_data->email; ?></p>

                    <h5>No telp wali</h5>
                    <p><?php echo $fetch_data->notelp; ?></p>

                    <h5>KTP</h5>
                    <?php
                    $stmt = $db->prepare("SELECT KTP FROM penduduk WHERE id = ?");
                    $stmt->execute([$id]);

                    // Fetch the image data (assuming the image is stored in a column named 'image_column')
                    $imageKTP = $stmt->fetchColumn();

                    // Output the image data
                    echo "<img src='$imageKTP' alt='Image' class='prev-pic'>";
                    ?>

                    <h5>KK</h5>
                    <?php
                    $stmt = $db->prepare("SELECT KK FROM penduduk WHERE id = ?");
                    $stmt->execute([$id]);

                    // Fetch the image data (assuming the image is stored in a column named 'image_column')
                    $imageKK = $stmt->fetchColumn();

                    // Output the image data
                    echo "<img src='$imageKK' alt='Image' class='prev-pic'>";
                    ?>

                    <h5>BPJS</h5>
                    <?php
                    $stmt = $db->prepare("SELECT BPJS FROM penduduk WHERE id = ?");
                    $stmt->execute([$id]);

                    // Fetch the image data (assuming the image is stored in a column named 'image_column')
                    $imageBPJS = $stmt->fetchColumn();

                    // Output the image data
                    echo "<img src='$imageBPJS' alt='Image' class='prev-pic'>";
                    ?>

                    <form action="" method="post" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label for="alamat" class="col-form-label">Alamat:</label>
                            <input type="text" class="form-control" id="alamat" name="alamat"
                                value="<?php echo $fetch_data->alamat; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="col-form-label">Email Wali:</label>
                            <input type="text" class="form-control" id="email" name="email"
                                value="<?php echo $fetch_data->email; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="noTelpon" class="col-form-label">No telp wali:</label>
                            <input type="text" class="form-control" id="noTelpon" name="noTelpon"
                                value="<?php echo $fetch_data->notelp; ?>">
                        </div>

                        <div class="mb-3">
                            <label for="ktp">KTP:</label>
                            <input type="file" class="form-control" id="ktp" name="KTP">
                            <img id="ktp-preview" alt="KTP Preview" class="prev-pic">
                        </div>

                        <div class="mb-3">
                            <label for="kk">KK:</label>
                            <input type="file" class="form-control" id="kk" name="KK">
                            <img id="kk-preview" alt="KK Preview" class="prev-pic">
                        </div>

                        <div class="mb-3">
                            <label for="bpjs">BPJS:</label>
                            <input type="file" class="form-control" id="bpjs" name="BPJS">
                            <img id="bpjs-preview" alt="BPJS Preview" class="prev-pic">
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="penduduk.php" class="btn btn-outline-primary" type="button" id="back">Back</a>
                            <button class="btn btn-primary me-md-2" type="submit" name="edit">Edit</button>
                        </div>
                    </form>

                    <h5>Pengobatan</h5>
                    <div class="content">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">no</th>
                                    <th scope="col">Deskripsi</th>
                                    <th scope="col">Jenis</th>
                                    <th scope="col">Obat</th>
                                    <th scope="col">Dosis</th>

                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Sudah bayar</th>
                                </tr>
                            </thead>
                            <tbody id="rekammedis">
                                <tr>
                                    <th scope="row">1</th>
                                    <td>obat1 </td>
                                    <td>Pengobatan</td>
                                    <td>panadol</td>
                                    <td>1</td>
                                    <td>17 juli </td>
                                    <td>
                                        <input type="checkbox" class="btn-check check-bayar" id="btncheck1"
                                            autocomplete="off">
                                        <label class="btn btn-outline-primary" for="btncheck1">Sudah</label>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">2</th>
                                    <td>Berobat </td>
                                    <td>Ke rumah sakit</td>
                                    <td>resep dokter</td>
                                    <td>5</td>
                                    <td>1 agustus </td>
                                    <td>
                                        <input type="checkbox" class="btn-check check-bayar" id="btncheck2"
                                            autocomplete="off">
                                        <label class="btn btn-outline-primary" for="btncheck2">Sudah</label>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">3</th>
                                    <td>obat2 </td>
                                    <td>Pengobatan</td>
                                    <td>panadol</td>
                                    <td>1</td>
                                    <td>17 oktober </td>
                                    <td>
                                        <input type="checkbox" class="btn-check check-bayar" id="btncheck3"
                                            autocomplete="off">
                                        <label class="btn btn-outline-primary" for="btncheck3">Sudah</label>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <div class="modal fade" id="ModalTambahPengobatan" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalTambahPengobatan">Tambah Pengobatan</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="penduduk_proses.php">
                        <div class="mb-3">
                            <label for="desc" class="col-form-label">Deskripsi:</label>
                            <input type="text" class="form-control" id="desc">
                        </div>
                        <div class="mb-3">
                            <label for="jenis_obat" class="col-form-label">Jenis:</label>
                            <input type="text" class="form-control" id="jenis_obat">
                        </div>
                        <div class="mb-3">
                            <label for="nama_obat" class="col-form-label">Nama Obat:</label>
                            <input type="text" class="form-control" id="nama_obat">
                        </div>
                        <div class="mb-3">
                            <label for="dosis" class="col-form-label">Dosis:</label>
                            <input type="text" class="form-control" id="dosis">
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_obat" class="col-form-label">Tanggal:</label>
                            <input type="date" class="form-control" id="tanggal_obat">
                        </div>

                        <div class="mb-3">
                            <input type="checkbox" id="sudahBayarModal" autocomplete="off">
                            <label for="sudahBayarModal">Sudah Bayar</label>
                        </div>


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="modal_simpan">Simpan Pengobatan</button>
                </div>
            </div>
        </div>
    </div>



    <script>
        function showFallback(img) {
            img.style.display = 'none';
            img.nextElementSibling.style.display = 'block';
        }
        feather.replace()

        document.getElementById('ktp').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById('ktp-preview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('kk').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById('kk-preview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });

        document.getElementById('bpjs').addEventListener('change', function (event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    const preview = document.getElementById('bpjs-preview');
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });

    </script>
</body>

</html>