<?php

include '../includes/config.php';

if (isLogin())
{
    $update_session = "UPDATE `login` SET session_login = '' WHERE session_login = ?";
    $update_session = $pdo->prepare($update_session);
    $update_session->execute([ $session_login ]);
    $pdo = null;
}

header('location: login.php');

?>