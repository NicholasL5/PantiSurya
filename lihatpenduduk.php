<?php
    session_start();
    if(!isset($_COOKIE['user_login']) && !isset($_POST['username'])){
        header("location:login2.php");
    }


    if(isset($_GET["id"])){
        // echo "masuk";
        $id = $_GET["id"];
        $username = $_GET["username"];
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="layout/indexstyle.css">
    <link rel="stylesheet" href="layout/stylelihat.css">
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <title>Document</title>
</head>
<body>
    <div class="app">
        <div class="dashboard">
            <?php include 'nav.php'?>
            
            <div class="main">
                <div class="profile">
                    <img src="images/noimg-removebg-preview.png" alt="no-image">
                    <h2><?php echo $username; ?></h2>
                </div>

                <div class="description" style="padding: 150px;">
                    <h5>Alamat</h5>
                    <p>Jl. abc</p>

                    <h5>Email wali</h5>
                    <p>asdfajsdlfk@gmail.com</p>

                    <h5>No telp wali</h5>
                    <p>09991239990</p>
                    

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
                        <tbody>
                            <tr>
                            <th scope="row">1</th>
                            <td>obat1 </td>
                            <td>Pengobatan</td>
                            <td>panadol</td>
                            <td>1</td>
                            <td>17 juli </td>
                            <td>
                                <input type="checkbox" class="btn-check" id="btncheck1" autocomplete="off" checked>
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
                                <input type="checkbox" class="btn-check" id="btncheck2" autocomplete="off" checked>
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
                                <input type="checkbox" class="btn-check" id="btncheck3" autocomplete="off">
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
    


    <script>
        feather.replace()
    </script>
</body>
</html>