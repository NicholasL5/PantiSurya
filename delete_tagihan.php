<?php
session_start();
require 'utils.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['id'])) {
        $idPondokkan = $_POST['id'];
        
        // Log the received ID to ensure it is being passed correctly
        error_log("Received ID: " . $idPondokkan);

        try {
            $db = new myDB();
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
