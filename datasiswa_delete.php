<?php
    session_start();

    require "connection.php";

    $query = "DELETE FROM siswa WHERE id=?";
    $res = $pdo->prepare($query);
    $res->execute([$_POST['delid']]);
    echo "success";
?>