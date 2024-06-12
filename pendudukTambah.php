<?php
    session_start();

    

    if(!isset($_COOKIE['user_login']) && !isset($_POST['username'])){
        header("location:login2.php");
    }

    require "utils.php";

    function validateFields($fields) {
        $errors = [];
    
        foreach ($fields as $field => $value) {
            if (!isset($value) || empty($value)) {
                $errors[] = $field;
            }
        }
    
        return $errors;
    }

    $flag = false;

    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        if (!isset($_POST["buttonsimpan"])) return;

        $requiredFields = [
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
            $nama = $_POST["namapenghuni"];
            $tempatlahir = $_POST["tempatlahir"];
            $agama = $_POST["flexRadioDefault"];
            $tanggallahir = $_POST["tanggallahir"];
            $tempattinggal = $_POST["tempattinggal"];
            $deposit = $_POST["deposit"];

            // Process the data (e.g., save to the database)
            $db = new myDB();
            $db->addPenduduk($nama, $tempattinggal, $tempatlahir, $agama, $tanggallahir, $deposit);
            $lastid = $db->returnLastID();
           

            echo "<script>alert('Data has been saved successfully. LastID:'".$lastid."');</script>" ;
        } else {
            // Handle the case where required fields are missing
            echo "The following fields are required and missing: " . implode(", ", $errors);
        }

        $requiredFields2 = [
            "namawali1" => $_POST["wali1"],
            "pekerjaanwali1" => $_POST["pekerjaanwali1"],
            "radiowali1" => $_POST["radiowali1"],
            "statushubungan" => $_POST["statushubungan"],
            "notelpwali1" => $_POST["notelpwali1"],
            "alamatwali1" => $_POST["alamatwali1"]
        ];

        $errors2 = validateFields($requiredFields2);

        if (empty($errors2)) {
            $nama = $_POST["wali1"];
            $pekerjaanwali1 = $_POST["pekerjaanwali1"];
            $agama = $_POST["radiowali1"];
            $hubungan = $_POST["statushubungan"];
            $notelp = $_POST["notelpwali1"];
            $alamat = $_POST["alamatwali1"];

            $db->addWali($lastid, $nama, $alamat, $agama, $notelp, $pekerjaanwali1, $hubungan);
            echo "<script>alert('Data wali has been saved successfully');</script>" ;
        }else{
            echo "The following fields are required and missing: " . implode(", ", $errors2);
        }


        $requiredFields3 = [
            "namawali2" => $_POST["wali2"],
            "pekerjaanwali2" => $_POST["pekerjaanwali2"],
            "radiowali2" => $_POST["radiowali2"],
            "hubunganwali2" => $_POST["hubunganwali2"],
            "notelpwali2" => $_POST["notelpwali2"],
            "alamatwali2" => $_POST["alamatwali2"]
        ];

        $errors3 = validateFields($requiredFields2);

        if (empty($errors3)) {
            $nama = $_POST["wali2"];
            $pekerjaanwali2 = $_POST["pekerjaanwali2"];
            $agama = $_POST["radiowali2"];
            $hubungan = $_POST["hubunganwali2"];
            $notelp = $_POST["notelpwali2"];
            $alamat = $_POST["alamatwali2"];

            $db->addWali($lastid, $nama, $alamat, $agama, $notelp, $pekerjaanwali2, $hubungan);
            echo "<script>alert('Data wali has been saved successfully');</script>" ;
        }else{
            echo "The following fields are required and missing: " . implode(", ", $errors3);
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
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

    <link rel="stylesheet" href="layout/styleTambah.css">
    <title>Panti Surya | Tambah Penduduk</title>
</head>
<body>
    <div class="app">
        <div class="dashboard">
            <?php include 'nav.php'?>
            <div class="main">
                <div class="pad">
                    <h2>Tambah Penduduk</h2>

                    <form action="pendudukTambah.php" method="POST" enctype="multipart/form-data">
                        <section class="pad-l-12">
                            <h4>Data Penduduk</h4>

                            <div class="mb-3 mb3-flex-col">
                                <div style="flex: 1;">
                                <label for="recipient-name" class="col-form-label">Nama Penghuni:</label>
                                <input type="text" class="form-control" name="namapenghuni">
                                </div>
                                
                                <div style="flex: 1;">   
                                <label for="recipient-name" class="col-form-label">Tempat Lahir:</label>
                                <input type="text" class="form-control" name="tempatlahir">
                                </div>
                                
                            </div>

                            <div class="mb-3 mb3-flex-col" >
                                <div class="mb-3" style="flex: 1;">
                                    <label for="recipient-name" class="col-form-label">Agama:</label>
                                    <div class="mb3-flex-col">
                                        <div>
                                            <div class="form-check">
                                                <input class="form-check-input" value="Kristen" type="radio" name="flexRadioDefault" id="flexRadioDefault1">
                                                <label class="form-check-label" for="flexRadioDefault1">
                                                    Kristen
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" value="Katolik" type="radio" name="flexRadioDefault" id="flexRadioDefault2">
                                                <label class="form-check-label" for="flexRadioDefault2">
                                                    Katolik
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" value="Islam" type="radio" name="flexRadioDefault" id="flexRadioDefault3">
                                                <label class="form-check-label" for="flexRadioDefault3">
                                                    Islam
                                                </label>
                                            </div>
                                        </div>

                                        <div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="Buddha" name="flexRadioDefault" id="flexRadioDefault4">
                                                <label class="form-check-label" for="flexRadioDefault4">
                                                    Buddha
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="Hindu" name="flexRadioDefault" id="flexRadioDefault5">
                                                <label class="form-check-label" for="flexRadioDefault5">
                                                    Hindu
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" value="Kong Hu Chu" name="flexRadioDefault" id="flexRadioDefault6" >
                                                <label class="form-check-label" for="flexRadioDefault6">
                                                    Kong Hu Cu
                                                </label>
                                            </div>
                                            
                                        </div>

                                        <div>
                                            <div class="form-check">
                                                <input class="form-check-input" value="Lainnya" type="radio" name="flexRadioDefault" id="flexRadioDefault6" >
                                                <label class="form-check-label" for="flexRadioDefault6">
                                                    Lainnya
                                                </label>
                                            </div>
                                        </div>
                                        
                                    </div>

                                </div>

                                <div style="flex: 1; display:flex; flex-direction: column;">

                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Tanggal Lahir:</label>
                                        <input type="date" class="form-control" id="tanggallahir" name="tanggallahir">
                                    </div>

                                    <div class="mb-3">
                                        <label for="recipient-name" class="col-form-label">Alamat Saat ini:</label>
                                        <input type="text" class="form-control" name="tempattinggal" id="recipient-name">
                                    </div>
                                </div>
                                
                            </div>
                            
                            <div class="mb-3 mb3-flex-col">
                                <div class="mb-3" style="flex:1;">
                                    
                                </div>
                                <div class="mb-3" style="flex:1;">
                                    <label for="deposit">Deposit:</label>
                                    <input type="number" id="deposit" name="deposit" placeholder="Masukkan Nilai Deposit"
                                        class="form-control" min="0" step="1">
                                </div>
                                
                            </div>
                        </section>



                        <section class="pad-l-12">
                        <h4>Data Penanggung Jawab 1 (wali 1)</h4>

                        <div class="mb-3 mb3-flex-col">
                            <div style="flex: 1;">
                                <label for="recipient-name" class="col-form-label">Nama Penanggung Jawab 1:</label>
                                <input type="text" class="form-control" name="wali1">
                            </div>
                            
                            <div style="flex: 1;">   
                                <label for="recipient-name" class="col-form-label">Alamat saat ini:</label>
                                <input type="text" class="form-control" name="alamatwali1">
                            </div>
                            
                        </div>

                        <div class="mb-3 mb3-flex-col" >
                            <div style="flex: 1;">
                                <label for="recipient-name" class="col-form-label">Agama:</label>
                                <div class="mb3-flex-col">
                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" value="Kristen" type="radio" name="radiowali1" id="radiowali11">
                                            <label class="form-check-label" for="radiowali11">
                                                Kristen 
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" value="Katolik" type="radio" name="radiowali1" id="radiowali12">
                                            <label class="form-check-label" for="radiowali12">
                                                Katolik
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" value="Islam" type="radio" name="radiowali1" id="radiowali13">
                                            <label class="form-check-label" for="radiowali13">
                                                Islam
                                            </label>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" value="Buddha" type="radio" name="radiowali1" id="radiowali14">
                                            <label class="form-check-label" for="radiowali14">
                                                Buddha
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" value="Hindu" type="radio" name="radiowali1" id="radiowali15">
                                            <label class="form-check-label" for="radiowali15">
                                                Hindu
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" value="Kong Hu Chu" type="radio" name="radiowali1" id="radiowali16" >
                                            <label class="form-check-label" for="radiowali16">
                                                Kong Hu Cu
                                            </label>
                                        </div>
                                        
                                    </div>

                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" value="lainnya" type="radio" name="radiowali1" id="radiowali17" >
                                            <label class="form-check-label" for="radiowali17">
                                                Lainnya
                                            </label>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                
                                
                            </div>

                            <div style="flex: 1; display:flex; flex-direction: column;">
                                <div>
                                    <label for="recipient-name" class="col-form-label">Pekerjaan:</label>
                                    <input type="text" class="form-control" id="pekerjaanwali1" name="pekerjaanwali1">
                                </div>

                                <div>
                                    <label for="recipient-name" class="col-form-label">Status Hubungan keluarga:</label>
                                    <input type="text" class="form-control" id="recipient-name" name="statushubungan">
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="mb-3 mb3-flex-col">
                            <div style="flex:1;">
                                
                            </div>
                            <div style="flex:1;">
                                <label for="addBalance" class="col-form-label">No Telpon:</label>
                                <input type="text" class="form-control" name="notelpwali1" id="notelpwali1">
                            </div>
                            
                        </div>
                        </section>


                        

                        <section class="pad-l-12">
                        <h4>Data Penanggung Jawab 2 (wali 2)</h4>

                        <div class="mb-3 mb3-flex-col">
                            <div style="flex: 1;">
                                <label for="recipient-name" class="col-form-label">Nama Penanggung Jawab 2:</label>
                                <input type="text" class="form-control" name="wali2">
                            </div>
                            
                            <div style="flex: 1;">   
                                <label for="recipient-name" class="col-form-label">Alamat saat ini:</label>
                                <input type="text" class="form-control" name="alamatwali2">
                            </div>
                            
                        </div>

                        <div class="mb-3 mb3-flex-col" >
                            <div style="flex: 1;">
                                <label for="recipient-name" class="col-form-label">Agama:</label>
                                <div class="mb3-flex-col">
                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" value="Kristen" type="radio" name="radiowali2" id="radiowali21">
                                            <label class="form-check-label" for="radiowali21">
                                                Kristen
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" value="Katolik" type="radio" name="radiowali2" id="radiowali22">
                                            <label class="form-check-label" for="radiowali22">
                                                Katolik
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" value="Islam" type="radio" name="radiowali2" id="radiowali23">
                                            <label class="form-check-label" for="radiowali23">
                                                Islam
                                            </label>
                                        </div>
                                    </div>

                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" value="Buddha" type="radio" name="radiowali2" id="radiowali24">
                                            <label class="form-check-label" for="radiowali24">
                                                Buddha
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" value="Hindu" type="radio" name="radiowali2" id="radiowali25">
                                            <label class="form-check-label" for="radiowali25">
                                                Hindu
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" value="Kong Hu Chu" type="radio" name="radiowali2" id="radiowali26" >
                                            <label class="form-check-label" for="radiowali26">
                                                Kong Hu Cu
                                            </label>
                                        </div>
                                        
                                    </div>

                                    <div>
                                        <div class="form-check">
                                            <input class="form-check-input" value="lainnya" type="radio" name="radiowali2" id="radiowali27" >
                                            <label class="form-check-label" for="radiowali27">
                                                Lainnya
                                            </label>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                
                                
                            </div>

                            <div style="flex: 1; display:flex; flex-direction: column;">

                                <div>
                                    <label for="recipient-name" class="col-form-label">Pekerjaan:</label>
                                    <input type="text" class="form-control" id="pekerjaanwali2" name="pekerjaanwali2">
                                </div>

                                <div>
                                    <label for="recipient-name" class="col-form-label">Status Hubungan keluarga:</label>
                                    <input type="text" class="form-control" id="recipient-name" name="hubunganwali2">
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="mb-3 mb3-flex-col">
                            <div style="flex:1;">
   
                            </div>
                            <div style="flex:1;">
                                <label for="addBalance" class="col-form-label">No Telpon:</label>
                                <input type="text" class="form-control" id="recipient-name" name="notelpwali2">
                            </div>
                            
                        </div>
                        </section>
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="penduduk.php" class="btn btn-danger" type="button" id="back">Cancel</a>
                            <button class="btn btn-primary me-md-2" name="buttonsimpan" type="submit">Simpan</button>
                        
                        </div>
                
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