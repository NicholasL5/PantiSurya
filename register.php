<?php
session_start();
require "utils.php";

$db = new myDB();

if (isset($_POST['register'])) {
    echo "<script>window.alert('same');</script>";
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    $db->addUser($username, $hashed_password, 0);
    header('Location: dataadmin.php');
    // $sql = "INSERT INTO akun (username, password, role) VALUES (?, ?, ?)";

    // $sql = $pdo->prepare($sql);
    // $sql->execute([ $username, $hashed_password, 0 ]);

}

// if (isset($_POST['register'])) {
//     echo "<script>window.alert('same');</script>";
//     $username = $_POST['username'];
//     $password = $_POST['password'];
//     $hashed_password = password_hash($password, PASSWORD_DEFAULT);

//     $access_overview = isset($_POST['access_overview']) ? 1 : 0;
//     $access_berita = isset($_POST['access_berita']) ? 1 : 0;
//     $access_data_penghuni = isset($_POST['access_data_penghuni']) ? 1 : 0;
//     $access_keuangan = isset($_POST['access_keuangan']) ? 1 : 0;
//     $access_galeri = isset($_POST['access_galeri']) ? 1 : 0;

//     $db->addUser($username, $hashed_password, 0, $access_overview, $access_berita, $access_data_penghuni, $access_keuangan, $access_galeri);
//     header('Location: login2.php');
// }

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="layout/styleLogin.css">
    <link rel="stylesheet" href="layout/style3.css">

    <script src="https://unpkg.com/feather-icons"></script>
    <title>Panti Surya</title>
</head>

<body>
    <div class="container-fluid fullh flex-center">
        <div class="holder2">
            <form action="register.php" method="POST">
                <div class="login2 flex-center">
                    <h1>Masukkan username dan password</h1>
                    <input type="text" name="username" class="form-control" id="loginuser" placeholder="Username">
                    <input type="password" name="password" class="form-control" id="loginpassword" placeholder="Password">
                    <input type="password" name="cpassword" class="form-control" id="loginpassword" placeholder="Confirm Password">
                    <!-- <p>Akses Role</p>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="access_overview" value="1" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Overview</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="access_berita" value="1" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Berita</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="access_data_penghuni" value="1" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Data Penghuni</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="access_keuangan" value="1" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Keuangan</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="access_galeri" value="1" id="flexCheckDefault">
                        <label class="form-check-label" for="flexCheckDefault">Galeri</label>
                    </div> -->
                    <div class="btn-group">
                        <button type="submit" name="register" class="btn btn-primary bg-blue">Register</button>
                        <a type="button" href="index.php" name="back" class="btn btn-danger bg-blue">Back</a>
                    </div>

                </div>
            </form>
        </div>
    </div>
</body>

</html>