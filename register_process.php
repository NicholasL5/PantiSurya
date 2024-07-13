<?php
session_start();
require "utils.php";

$db = new myDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    // Example validation and registration logic
    if ($password === $cpassword) {
        // Assume registration is successful
        try{
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $db->addUser($username, $hashed_password, 0);
            $response['success'] = true;
            $response['message'] = 'Registration berhasil!';

        }catch(PDOException $e){
            $response['success'] = false;
            $response['message'] = 'Masalah pada database';
        }
        
    } else {
        $response['success'] = false;
        $response['message'] = 'Passwords Berbeda';
    }
} else {
    $response['success'] = false;
    $response['message'] = 'Invalid request method!';
}

echo json_encode($response);

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