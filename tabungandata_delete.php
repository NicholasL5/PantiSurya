<?php
    session_start();

    include "utils.php";

    $db = new myDB();
    $db->delTabunganDatabyId($_POST['penid'], $_POST['delid']);
    
    echo "success";
?>