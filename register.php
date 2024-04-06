<?php
    session_start();
    require "connection.php";
    
    if(isset($_POST['register']) ){
        echo "<script>window.alert('same');</script>";
        $username = $_POST['username'];
        $password = $_POST['password'];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "INSERT INTO akun (username, password, role) VALUES (?, ?, ?)";

        $sql = $pdo->prepare($sql);
        $sql->execute([ $username, $hashed_password, 0 ]);

    }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="layout/styleLogin.css">
    <link rel="stylesheet" href="layout/style3.css">

    <script src="https://unpkg.com/feather-icons"></script>
    <title>Perkantas</title>
</head>
<body>
    <div class="container-fluid fullh flex-center">
        <div class="holder">
            <form action="register.php" method="POST">
                <div class="login flex-center">
                    <h1>Masukkan username dan password</h1>
                    <input type="text" name="username" class="form-control" id="loginuser" placeholder="Username">
                    <input type="password" name="password" class="form-control" id="loginpassword" placeholder="Password">
                    <input type="password" name="cpassword" class="form-control" id="loginpassword" placeholder="Confirm Password">
                    <div class="btn-group">
                        <button type="submit" name="register" class="btn btn-primary bg-blue">Register</button>
                        <a type="button" href="login2.php" name="back" class="btn btn-danger bg-blue">Back</a>
                    </div>
                    
                </div>
            </form>
        </div>
    </div>
</body>
</html>