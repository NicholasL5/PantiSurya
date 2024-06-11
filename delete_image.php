<?php
    session_start();

    require "utils.php";
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    
        $db = new myDB();
        $db->deleteGambar($id);
        
        header("Location: galeri.php");
    exit();
    }
?>