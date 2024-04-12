<?php
    session_start();

    require "utils.php";

    $db = new myDB();
    $db->delbyId([$_POST['delid']]);
    echo "success";
?>