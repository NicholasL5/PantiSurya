<?php
session_start();



if (!isset($_COOKIE['user_login']) && !isset($_POST['username'])) {
    header("location:login2.php");
}

require "utils.php";

function validateFields($fields){
    $errors = [];

    foreach ($fields as $field => $value) {
        if (!isset($value) || empty($value)) {
            $errors[] = $field;
        }
    }

    return $errors;
}

function processWali($waliData, $lastid, $db) {
    $errors = validateFields($waliData);
    if (empty($errors)) {
        $db->addWali($lastid, $waliData["namawali"], $waliData["alamatwali"], $waliData["radiowali"], 
                      $waliData["notelpwali"], $waliData["pekerjaanwali"], $waliData["statushubungan"]);
        echo "<script>alert('Data wali has been saved successfully');</script>";
    } 
}

$flag = false;

if ($_SERVER['REQUEST_METHOD'] == "POST") {


    if (!isset($_POST["buttonsimpan"]))
        return;


    $requiredFields = [
        "nomorinduk" => $_POST["nomorinduk"],
        "namapenghuni" => $_POST["namapenghuni"],
        "tempatlahir" => $_POST["tempatlahir"],
        "flexRadioDefault" => $_POST["flexRadioDefault"],
        "tanggallahir" => $_POST["tanggallahir"],
        "tempattinggal" => $_POST["tempattinggal"],
        "deposit" => $_POST["deposit"]
    ];

    $errors = validateFields($requiredFields);

    if (empty($errors)) {
        // All required fields are set and not empty
        $noinduk = $_POST["nomorinduk"];
        $nama = $_POST["namapenghuni"];
        $tempatlahir = $_POST["tempatlahir"];
        $agama = $_POST["flexRadioDefault"];
        $tanggallahir = $_POST["tanggallahir"];
        $tempattinggal = $_POST["tempattinggal"];
        $deposit = $_POST["deposit"];

        // Process the data
        $db = new myDB();
        $db->addPenduduk($noinduk, $nama, $tempattinggal, $tempatlahir, $agama, $tanggallahir, $deposit);
        $lastid = $db->returnLastID();


        echo "<script>alert('Data has been saved successfully. LastID:'" . $lastid . "');</script>";
    } else {
        // Handle the case where required fields are missing
        echo "The following fields are required and missing: " . implode(", ", $errors);
    }


    $requiredFieldsWali1 = [
        "namawali" => $_POST["wali1"],
        "pekerjaanwali" => $_POST["pekerjaanwali1"],
        "radiowali" => isset($_POST["radiowali1"])?:"",
        "statushubungan" => $_POST["statushubunganwali1"],
        "notelpwali" => $_POST["notelpwali1"],
        "alamatwali" => $_POST["alamatwali1"]
    ];

    $requiredFieldsWali2 = [
        "namawali" => $_POST["wali2"],
        "pekerjaanwali" => $_POST["pekerjaanwali2"],
        "radiowali" => isset($_POST["radiowali2"])?:"",
        "statushubungan" => $_POST["statushubunganwali2"],
        "notelpwali" => $_POST["notelpwali2"],
        "alamatwali" => $_POST["alamatwali2"]
    ];

    $requiredFieldsWali3 = [
        "namawali" => $_POST["wali3"],
        "pekerjaanwali" => $_POST["pekerjaanwali3"],
        "radiowali" => isset($_POST["radiowali3"])?:"",
        "statushubungan" => $_POST["statushubunganwali3"],
        "notelpwali" => $_POST["notelpwali3"],
        "alamatwali" => $_POST["alamatwali3"]
    ];

    $requiredFieldsWali4 = [
        "namawali" => $_POST["wali4"],
        "pekerjaanwali" => $_POST["pekerjaanwali4"],
        "radiowali" => isset($_POST["radiowali4"])?:"",
        "statushubungan" => $_POST["statushubunganwali4"],
        "notelpwali" => $_POST["notelpwali4"],
        "alamatwali" => $_POST["alamatwali4"]
    ];

    $requiredFieldsWali5 = [
        "namawali" => $_POST["wali5"],
        "pekerjaanwali" => $_POST["pekerjaanwali5"],
        "radiowali" => isset($_POST["radiowali5"])?:"",
        "statushubungan" => $_POST["statushubunganwali5"],
        "notelpwali" => $_POST["notelpwali5"],
        "alamatwali" => $_POST["alamatwali5"]
    ];


    processWali($requiredFieldsWali1, $lastid, $db);
    processWali($requiredFieldsWali2, $lastid, $db);
    processWali($requiredFieldsWali3, $lastid, $db);
    processWali($requiredFieldsWali4, $lastid, $db);
    processWali($requiredFieldsWali5, $lastid, $db);



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

    <link rel="stylesheet" href="layout/styleTambah.css">
    <title>Panti Surya | Tambah Penduduk</title>
</head>

<body>
    <!-- <script>
        $(document).ready(function(){

            $('#submitform').on('click', function(event){
                event.preventDefault();

                Swal.fire({
                    title: "Yakin tambah penduduk?",
                    icon: "question",
                    text: "Penduduk akan dimasukkan ke database",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Simpan!"
                }).then((result) => {
                    if(result.isConfirmed){
                        // If the user confirms, submit the form programmatically
                        document.getElementById("pendudukForm").submit();
                    }
                });
            });

            
        
        });
    </script> -->


    <div class="app">
        <div class="dashboard">
            <?php include 'nav.php' ?>
            <div class="main">
                <div class="pad">
                    <h1 style="margin-bottom: 3rem;">Tambah Penduduk</h1>

                    <form id="pendudukForm" action="pendudukTambah.php" method="POST" enctype="multipart/form-data">

                        <div class="accordion" id="accordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapseOne" aria-expanded="true"
                                        aria-controls="collapseOne">Data Penduduk</button>
                                </h2>

                                <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <section class="pad-l-12">
                                            <h4>Data Penduduk</h4>
                                            <div class="mb-3 mb3-flex-col">
                                                <div style="flex: 1;">
                                                    <label for="recipient-name" class="col-form-label">Nomor
                                                        Induk:</label>
                                                    <input type="text" class="form-control" name="nomorinduk"
                                                        required>
                                                </div>

                                                <div style="flex: 1;">
                                                    <label for="recipient-name" class="col-form-label">Nama
                                                        Penghuni:</label>
                                                    <input type="text" class="form-control" name="namapenghuni"
                                                        required>
                                                </div>

                                            </div>

                                            <div class="mb-3 mb3-flex-col">
                                                <div style="flex: 1;">
                                                    <label for="recipient-name" class="col-form-label">Tempat
                                                        Lahir:</label>
                                                    <input type="text" class="form-control" name="tempatlahir" required>
                                                </div>

                                                <div style="flex: 1;">
                                                    <label for="recipient-name" class="col-form-label">Tanggal
                                                        Lahir:</label>
                                                    <input type="date" class="form-control" id="tanggallahir"
                                                        name="tanggallahir" required>
                                                </div>

                                            </div>

                                            <div class="mb-3 mb3-flex-col">
                                                <div class="mb-3" style="flex: 1;">
                                                    <label for="recipient-name" class="col-form-label">Agama:</label>
                                                    <div class="mb3-flex-col">
                                                        <div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" value="Kristen"
                                                                    type="radio" name="flexRadioDefault"
                                                                    id="flexRadioDefault1" required>
                                                                <label class="form-check-label" for="flexRadioDefault1">
                                                                    Kristen
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" value="Katolik"
                                                                    type="radio" name="flexRadioDefault"
                                                                    id="flexRadioDefault2" required>
                                                                <label class="form-check-label" for="flexRadioDefault2">
                                                                    Katolik
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" value="Islam"
                                                                    type="radio" name="flexRadioDefault"
                                                                    id="flexRadioDefault3" required>
                                                                <label class="form-check-label" for="flexRadioDefault3">
                                                                    Islam
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    value="Buddha" name="flexRadioDefault"
                                                                    id="flexRadioDefault4" required>
                                                                <label class="form-check-label" for="flexRadioDefault4">
                                                                    Buddha
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    value="Hindu" name="flexRadioDefault"
                                                                    id="flexRadioDefault5" required>
                                                                <label class="form-check-label" for="flexRadioDefault5">
                                                                    Hindu
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio"
                                                                    value="Kong Hu Chu" name="flexRadioDefault"
                                                                    id="flexRadioDefault6" required>
                                                                <label class="form-check-label" for="flexRadioDefault6">
                                                                    Kong Hu Cu
                                                                </label>
                                                            </div>

                                                        </div>

                                                    </div>

                                                </div>

                                                <div style="flex: 1; display:flex; flex-direction: column;">

                                                    <div class="mb-3">
                                                        <label for="recipient-name" class="col-form-label">Alamat Saat
                                                            ini:</label>
                                                        <input type="text" class="form-control" name="tempattinggal"
                                                            id="recipient-name" required>
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="deposit">Deposit:</label>
                                                        <input type="number" id="deposit" name="deposit"
                                                            placeholder="Masukkan Nilai Deposit" class="form-control"
                                                            min="0" step="1" required>
                                                    </div>
                                                </div>

                                            </div>

                                        
                                        </section>
                                    </div>
                                </div>
                            </div>

                            <?php for ($i = 1; $i <= 5; $i++): ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#collapse<?php echo $i; ?>" aria-expanded="false"
                                        aria-controls="collapse<?php echo $i; ?>">Data Penanggung Jawab <?php echo $i; ?> (wali <?php echo $i; ?>)</button>
                                </h2>
                                <div id="collapse<?php echo $i; ?>" class="accordion-collapse collapse"
                                    data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <section class="pad-l-12">
                                            <h4>Data Penanggung Jawab <?php echo $i; ?> (wali <?php echo $i; ?>)</h4>

                                            <div class="mb-3 mb3-flex-col">
                                                <div style="flex: 1;">
                                                    <label for="recipient-name" class="col-form-label">Nama Penanggung
                                                        Jawab
                                                        <?php echo $i; ?>:</label>
                                                    <input type="text" class="form-control" name="wali<?php echo $i; ?>">
                                                </div>

                                                <div style="flex: 1;">
                                                    <label for="recipient-name" class="col-form-label">Alamat saat
                                                        ini:</label>
                                                    <input type="text" class="form-control" name="alamatwali<?php echo $i; ?>">
                                                </div>

                                            </div>

                                            <div class="mb-3 mb3-flex-col">
                                                <div style="flex: 1;">
                                                    <label for="recipient-name" class="col-form-label">Agama:</label>
                                                    <div class="mb3-flex-col">
                                                        <div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" value="Kristen"
                                                                    type="radio" name="radiowali<?php echo $i; ?>" id="radiowali<?php echo $i; ?>1">
                                                                <label class="form-check-label" for="radiowali<?php echo $i; ?>1">
                                                                    Kristen
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" value="Katolik"
                                                                    type="radio" name="radiowali<?php echo $i; ?>" id="radiowali<?php echo $i; ?>2">
                                                                <label class="form-check-label" for="radiowali<?php echo $i; ?>2">
                                                                    Katolik
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" value="Islam"
                                                                    type="radio" name="radiowali<?php echo $i; ?>" id="radiowali<?php echo $i; ?>3">
                                                                <label class="form-check-label" for="radiowali<?php echo $i; ?>3">
                                                                    Islam
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" value="Buddha"
                                                                    type="radio" name="radiowali<?php echo $i; ?>" id="radiowali<?php echo $i; ?>4">
                                                                <label class="form-check-label" for="radiowali<?php echo $i; ?>4">
                                                                    Buddha
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" value="Hindu"
                                                                    type="radio" name="radiowali<?php echo $i; ?>" id="radiowali<?php echo $i; ?>5">
                                                                <label class="form-check-label" for="radiowali<?php echo $i; ?>5">
                                                                    Hindu
                                                                </label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" value="Kong Hu Chu"
                                                                    type="radio" name="radiowali<?php echo $i; ?>" id="radiowali<?php echo $i; ?>6">
                                                                <label class="form-check-label" for="radiowali<?php echo $i; ?>6">
                                                                    Kong Hu Cu
                                                                </label>
                                                            </div>

                                                        </div>

                                                    </div>
                                                </div>

                                                <div style="flex: 1; display:flex; flex-direction: column;">
                                                    <div>
                                                        <label for="recipient-name"
                                                            class="col-form-label">Pekerjaan:</label>
                                                        <input type="text" class="form-control" id="pekerjaanwali<?php echo $i; ?>"
                                                            name="pekerjaanwali<?php echo $i; ?>">
                                                    </div>

                                                    <div>
                                                        <label for="recipient-name" class="col-form-label">Status
                                                            Hubungan
                                                            keluarga:</label>
                                                        <input type="text" class="form-control" id="recipient-name"
                                                            name="statushubunganwali<?php echo $i; ?>">
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="mb-3 mb3-flex-col">
                                                <div style="flex:1;">

                                                </div>
                                                <div style="flex:1;">
                                                    <label for="addBalance" class="col-form-label">No Telpon:</label>
                                                    <input type="text" class="form-control" name="notelpwali<?php echo $i; ?>"
                                                        id="notelpwali<?php echo $i; ?>">
                                                </div>

                                            </div>
                                        </section>
                                    </div>

                                </div>
                            </div>
                            <?php endfor; ?>
                        </div>

                        <!-- <div style="display:flex;flex-direction: row;justify-content: space-between;"> -->
                            <!-- <div class="d-grid gap-2 d-md-flex justify-content-md-end pt-3">
                                <button class="btn btn-light me-md-2" style="border: 1px solid #8a8e91;" id="tambahwali" name="tambahaccordion">Tambah Wali</button>
                            </div> -->
                            
                            <div class="d-grid gap-2 d-md-flex justify-content-md-end pt-3">
                                <a href="penduduk.php" class="btn btn-danger" type="button" id="back">Cancel</a>
                                <button class="btn btn-primary me-md-2" name="buttonsimpan" id="submitform" type="submit">Simpan</button>
                            </div>
                        <!-- </div> -->

                        

                    </form>
                </div>
            </div>


        </div>
    </div>



    <script>
        feather.replace()
    </script>
</body>

</html>