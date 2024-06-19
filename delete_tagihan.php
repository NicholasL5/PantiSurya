<?php
session_start();
require 'utils.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
        $idPondokkan = $_POST['id'];

        try {
            $db = new myDB();
            $pondokkan = $db->getTagihanPondokkan($idPondokkan);
            $db->updatePondokkanHapus($pondokkan['tagihan'], $pondokkan['penduduk_id']);
            $db->deleteTagihanPondokkan($idPondokkan);

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
