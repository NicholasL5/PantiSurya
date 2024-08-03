<?php
session_start();
require 'utils.php';

$db = new myDB();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $residentId = $_POST['resident_id'];
    $stmt = $db->getPenduduk($residentId);
    $res = $stmt->fetch(PDO::FETCH_ASSOC);

    $fileType = $_POST['file_type'];
    
    $targetDir = "deposit/" . $res['nama'] . "/";

    if (!is_dir($targetDir)) {
        
        mkdir($targetDir, 0777, true);

    }

    $fileName = basename($_FILES["file"]["name"]);
    $fileExtension = pathinfo($fileName, PATHINFO_EXTENSION);
    $path = $res['nama'] . '.' . $fileExtension;
    if ($fileType == "kwitansi"){
        $path = "kwitansi-" . $path;
        $targetFilePath = $targetDir . $path ;
    }else if($fileType == "bukti"){
        $path = "bukti-" . $path;
        $targetFilePath = $targetDir . $path;
    }
    

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
        // Update the correct column based on the file type

        if ($fileType == 'kwitansi') {
            $stmt = $db->prepare("UPDATE penduduk SET kwitansi_path = ? WHERE id = ?");
        } else {
            $stmt = $db->prepare("UPDATE penduduk SET bukti_path = ? WHERE id = ?");
        }
        $stmt->execute([$path, $residentId]);
        
    } else {
        
    }
}
header("Location: keuangan_deposit.php");
?>
