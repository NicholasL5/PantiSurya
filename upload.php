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
    $targetFilePath = $targetDir . $fileName;

    if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFilePath)) {
        // Update the correct column based on the file type
        if ($fileType == 'kwitansi') {
            $stmt = $db->prepare("UPDATE penduduk SET kwitansi_path = ? WHERE id = ?");
        } else {
            $stmt = $db->prepare("UPDATE penduduk SET bukti_path = ? WHERE id = ?");
        }
        $stmt->execute([$fileName, $residentId]);
        echo "The file " . htmlspecialchars($fileName) . " has been uploaded.";
        header("location:keuangan_deposit.php");
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
?>
