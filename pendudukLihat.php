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

    $res2 = $db->getWali($id);
    $fetch_wali = $res2->fetchAll(PDO::FETCH_ASSOC);

    $image = $db->getGambarById($id);
    
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['edit'])) {
        $id = $_GET["id"];

        if (isset($_FILES['KTP']) && $_FILES['KTP']['error'] != UPLOAD_ERR_NO_FILE) {
            $uploadFileKTP = $uploadDirKTP . basename($_FILES['KTP']['name']);
            echo $uploadFileKTP;
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

        if (isset($_FILES['KK']) && $_FILES['KK']['error'] != UPLOAD_ERR_NO_FILE) {
            
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

        if (isset($_FILES['BPJS']) && $_FILES['BPJS']['error'] != UPLOAD_ERR_NO_FILE) {
            
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

        function validateFields($fields){
            $errors = [];
        
            foreach ($fields as $field => $value) {
                if (!isset($value) || empty($value)) {
                    $errors[] = $field;
                }
            }
        
            return $errors;
        }
        
        function processWali($waliData, $db, $idx) {
            $errors = validateFields($waliData);
            if (empty($errors)) {
                // try{
                    $numwali = $db->getWali($_GET['id']);
                    $waliarr = $numwali->fetchAll(PDO::FETCH_ASSOC);
                    if(empty($waliarr[$idx-1])){
                        $db->addWali($_GET['id'], $waliData["namawali"], $waliData["alamatwali"], $waliData["agamawali"], 
                                    $waliData["notelpwali"], $waliData["pekerjaanwali"], $waliData["statushubungan"]);
                    }else{
                        $db->editWali($waliData["namawali"], $waliData["alamatwali"], $waliData["agamawali"], 
                                    $waliData["notelpwali"], $waliData["pekerjaanwali"], $waliData["statushubungan"], 
                                    $_GET['id'], $waliarr[$idx-1]['wali_id']);

                    }

                    

                    // $_SESSION['alert'] = "success";
                    // $_SESSION["errormsg"] = "Data berhasil disimpan";          
                // }catch(Exception $e){
                    // $_SESSION['alert'] = "fail";
                    // $_SESSION["errormsg"] = $e->getMessage();
                // };
                
            }
        }

        $requiredFields = [
            "nomorinduk" => $_POST["noinduk"],
            "namapenghuni" => $_POST["nama"],
            "tempatlahir" => $_POST["tempatlahir"],
            "agama" => $_POST["agama"],
            "tanggallahir" => $_POST["tanggallahir"],
            "alamat" => $_POST["alamat"],
            "deposit" => $_POST["deposit"],
            "tanggalmasuk" => $_POST["tanggalmasuk"]
        ];
    
        $errors = validateFields($requiredFields);
    
        if (empty($errors)) {
            // All required fields are set and not empty
            $noinduk = $_POST["noinduk"];
            $nama = $_POST["nama"];
            $tempatlahir = $_POST["tempatlahir"];
            $agama = $_POST["agama"];
            $tanggallahir = $_POST["tanggallahir"];
            $alamat = $_POST["alamat"];
            $deposit = $_POST["deposit"];
            $tanggalmasuk = $_POST["tanggalmasuk"];

            // Process the data
            $db = new myDB();
            try{
                $db->editPenduduk($noinduk, $nama, $alamat, $tempatlahir, $agama, $tanggallahir, $deposit, $tanggalmasuk, $id);

                $_SESSION['alert'] = "success";
                $_SESSION["errormsg"] = "Data berhasil disimpan";
            }catch(Exception $e){
                $_SESSION['alert'] = "fail";
                $_SESSION["errormsg"] = $e->getMessage();
            }
        }    

        for ($i = 1; $i <= 5; $i++) {
            $waliData = [
                "namawali" => $_POST["namawali$i"],
                "pekerjaanwali" => $_POST["pekerjaanwali$i"],
                "agamawali" => $_POST["agamawali$i"],
                "statushubungan" => $_POST["hubunganwali$i"],
                "notelpwali" => $_POST["no_telpwali$i"],
                "alamatwali" => $_POST["alamatwali$i"]
            ];
            processWali($waliData, $db, $i);
        }

        header("Location: penduduk.php");
        exit();
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
    <link rel="stylesheet" href="layout/styleEdit.css">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <title>Panti Surya | Lihat Penghuni</title>
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

        .mb-3 input:disabled{
            background-color: white;

        }
    </style>
</head>

<body>
    <script src="js/penduduk_lihat.js"></script>
    

    <div class="app">
        <div class="dashboard">
            <?php include 'nav.php' ?>

            

            <div class="main">
                
                <div class="pad">
                    <h1>Edit Profile</h1>


                    <div class="profile-edit" style="padding: 2rem;">
                        <div class="profile">
                            <p >Foto:</p>
                            <img src="<?= htmlspecialchars($image['profile_picture']); ?>" alt="Profile Picture"
                                class="profile-picture" onerror="showFallback(this)">
                            <img src="svg/abstract-user-flat-3.svg" alt="Fallback SVG" class="fallback-picture">
                            <button type="button" class="btn btn-primary view">Edit Foto</button>

                        </div>

                        <div class="description lr-9">
                            <div class="tab-container">
                                <div class="tab tab-active" data-target="personal">Data diri</div>
                                <div class="tab" data-target="kartu">Kartu</div>
                                <div class="tab" data-target="wali1"> Wali 1</div>
                                <div class="tab" data-target="wali2"> Wali 2</div>
                                <div class="tab" data-target="wali3"> Wali 3</div>
                                <div class="tab" data-target="wali4"> Wali 4</div>
                                <div class="tab" data-target="wali5"> Wali 5</div>

                            </div>

                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="tab-content tab-content-active" id="personal">
                                <div class="mb-3">
                                    <label for="nama" class="col-form-label">Nomor Induk:</label>
                                    <input type="text" class="form-control" id="noinduk" name="noinduk"
                                        value="<?php echo $fetch_data->nomor_induk; ?>">
                                </div>
                                <div class="mb-3">
                                    <label for="nama" class="col-form-label">Nama:</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        value="<?php echo $fetch_data->nama; ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="alamat" class="col-form-label">Alamat:</label>
                                    <input type="text" class="form-control" id="alamat" name="alamat"
                                        value="<?php echo $fetch_data->alamat; ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="agama" class="col-form-label">Agama:</label>
                                    <input type="text" class="form-control" id="agama" name="agama"
                                        value="<?php echo $fetch_data->agama; ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="tempatlahir" class="col-form-label">Tempat Lahir:</label>
                                    <input type="text" class="form-control" id="tempatlahir" name="tempatlahir"
                                        value="<?php echo $fetch_data->tempat_lahir; ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="tanggallahir" class="col-form-label">Tanggal Lahir:</label>
                                    <input type="date" class="form-control" id="tanggallahir" name="tanggallahir"
                                        value="<?php echo $fetch_data->tanggal_lahir; ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="deposit" class="col-form-label">Deposit:</label>
                                    <input type="number" min="0" step="1" class="form-control" id="deposit" name="deposit"
                                        value="<?php echo $fetch_data->deposit; ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="tanggalmasuk" class="col-form-label">Tanggal Masuk:</label>
                                    <input type="date" class="form-control" id="tanggalmasuk" name="tanggalmasuk"
                                        value="<?php echo $fetch_data->tanggal_masuk; ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="noTelpon" class="row-form-label">No telp wali:</label>
                                    <input type="text" class="form-control" id="notelpwali" name=""
                                        value="<?php echo !empty($fetch_wali[0]['no_telp'])?$fetch_wali[0]['no_telp']:"-"; ?>" disabled>
                                    
                                </div>

                            </div>
                            

                            <div class="tab-content" id="kartu">
                                <div class="mb-3">
                                    <label for="ktp">KTP:</label>
                                    <input type="file" class="form-control" id="ktp" name="KTP" >
                                    <img id="ktp-preview" alt="KTP Preview" class="prev-pic" src="<?php echo $fetch_data->KTP; ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="kk">KK:</label>
                                    <input type="file" class="form-control" id="kk" name="KK">
                                    <img id="kk-preview" alt="KK Preview" class="prev-pic" src="<?php echo $fetch_data->KK; ?>">
                                </div>

                                <div class="mb-3">
                                    <label for="bpjs">BPJS:</label>
                                    <input type="file" class="form-control" id="bpjs" name="BPJS">
                                    <img id="bpjs-preview" alt="BPJS Preview" class="prev-pic" src="<?php echo $fetch_data->BPJS; ?>">
                                </div>
                            </div>
                            
                            
                            <?php
                            $waliFields = [
                                "nama" => "Nama Wali",
                                "alamat" => "Alamat",
                                "agama" => "Agama",
                                "no_telp" => "No telp wali",
                                "pekerjaan" => "Pekerjaan wali",
                                "hubungan" => "Hubungan wali"
                            ];

                            for ($index = 1; $index <= 5; $index++) {
                                $wali = isset($fetch_wali[$index - 1]) ? $fetch_wali[$index - 1] : [];
                                echo "<div class='tab-content' id='wali{$index}'>";
                                foreach ($waliFields as $field => $label) {
                                    $value = !empty($wali[$field]) ? $wali[$field] : "";
                                    echo "<div class='mb-3'>";
                                    echo "<label for='{$field}wali{$index}' class='col-form-label'>{$label}:</label>";
                                    echo "<input type='text' class='form-control' id='{$field}wali{$index}' name='{$field}wali{$index}' value='{$value}'>";

                                    echo "</div>";
                                }

                                echo 
                                "
                                <div class='mb-3' style='display:flex;justify-content:flex-end;'>
                                <button type='button' class='btn btn-danger del' style='margin:0px;z-index: index 10;'>Delete</button>
                                </div>";
                                echo "</div>";
                            }
                            ?>

                            <div class="view d-grid gap-2 d-md-flex justify-content-md-end">
                                <a href="penduduk.php" class="btn btn-danger" type="button" id="back">Cancel</a>
                                <button class="btn btn-primary me-md-2" type="submit" name="edit">Save</button>
                            </div>
                        </form>

                        
                        <h5>Pengobatan</h5>
                        <a href="laporanobat.php?id=<?php echo $id ?>"><button type="button" class="btn btn-primary view">Lihat Rekam Medis</button></a>
                    </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    



    <script>
        function showFallback(img) {
            img.style.display = 'none';
            img.nextElementSibling.style.display = 'block';
        }
        feather.replace();

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


        const tabs = document.querySelectorAll('.tab');
        const contents = document.querySelectorAll('.tab-content');

        tabs.forEach(tab => {
            tab.addEventListener('click', () => {
                tabs.forEach(t => t.classList.remove('tab-active'));
                tab.classList.add('tab-active');

                contents.forEach(content => content.classList.remove('tab-content-active'));
                document.getElementById(tab.dataset.target).classList.add('tab-content-active');
            });
        });

    </script>
</body>

</html>