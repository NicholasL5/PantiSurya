<?php
    session_start();

    require "utils.php";

    $db = new myDB();
    $db->delbyIdBerita([$_POST['delid']]);
    echo "success";
    
?>