<?php
session_start();
require 'utils.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $db = new myDB();

    $id = $_POST['id']; // Get user ID from form data

    // Determine which access field is being updated
    if (isset($_POST['admin_access'])) {
        $success = $db->toggleAccess($id, 'access_admin');
    } elseif (isset($_POST['berita_access'])) {
        $success = $db->toggleAccess($id, 'access_berita');
    } elseif (isset($_POST['keuangan_access'])) {
        $success = $db->toggleAccess($id, 'access_keuangan');
    } elseif (isset($_POST['galeri_access'])) {
        $success = $db->toggleAccess($id, 'access_galeri');
    } else {
        $success = false;
    }

    // Send JSON response to indicate success or failure
    header('Location: dataadmin.php');
    // echo json_encode(['success' => $success, 'newValue' => $success ? 1 : 0]);
    exit;
}
?>
