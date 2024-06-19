<?php
session_start();
require 'utils.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
        $idObat = $_POST['id'];
        
        // Log the received ID to ensure it is being passed correctly
        error_log("Received ID: " . $idObat);

        try {
            $db = new myDB();
            $obat = $db->getTagihanObat($idObat);
            $db->updateObatHapus($obat['tagihan'], $obat['penduduk_id']);
            $db->deleteTagihanObat($idObat);
            echo "success";
        } catch (PDOException $e) {
            error_log("Error: " . $e->getMessage()); // Log the error
            echo "error";
        }
    } else {
        echo "error";
    }
} else {
    echo "error";
}
?>
