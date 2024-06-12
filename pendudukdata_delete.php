<?php
    session_start();

    include "utils.php";

    $db = new myDB();
    $db->delbyId($_POST['delid']);
    echo "success";
?>