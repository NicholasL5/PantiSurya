<?php
    session_start();

    require "utils.php";

    $db = new myDB();
    $db->delbyIdAdmin([$_POST['delid']]);
    echo "success";
    
?>