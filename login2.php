<?php
    session_start();
    require "connection.php";

    if(isset($_POST['login']) && trim($_POST['username']) != "" && trim($_POST['password']) != ""){
        
        $username = $_POST['username'];
        $password = $_POST['password'];


        $error_val = [];
        $cek_username = "SELECT password, role FROM `akun` WHERE username = ? ";
        $cek_username = $pdo->prepare($cek_username);
        $cek_username->execute([ $username ]);
        $fetch_data = $cek_username->fetch(PDO::FETCH_OBJ);
        
        
        
        if ($cek_username->rowCount() == 0)
            $error_val['username'] = 'Username tidak tersedia.';

        if ($password == '' || ($cek_username->rowCount() > 0 && !password_verify($password, $fetch_data->password)))
            $error_val['password'] = 'Kata sandi yang diketik salah.';

        if (count($error_val) == 0) {
           
            $md5_sess = md5(time().$password);
            
            setcookie('user_login', $md5_sess, time() + (86400 * 2), '/');
            $_SESSION['username'] = $username;
            $_SESSION['role'] = $fetch_data->role;

            header('location: index.php');
        }

        // $c = $error_val['username'];
        // echo "<script>alert($c)</script>";

        
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
    <title>Perkantas</title>
</head>
<body>
    <div class="container-fluid fullh flex-center">
        <div class="holder">
            <form action="login2.php" method="POST">
                <div class="login flex-center">
                    <h1>Login to your account</h1>
                    <input type="text" name="username" class="form-control" id="loginuser" placeholder="Username">
                    <input type="password" name="password" class="form-control" id="loginpassword" placeholder="Password">
                    <button type="submit" name="login" class="btn btn-primary bg-blue">Login</button>
                </div>
            </form>
            

            <div class="signup flex-center">
                <h1>New Here?</h1>
                <p>Enter your personal details and join with us</p>
                <button class="btn btn-primary bg-gray"><a href="register.php" style="color: white; text-decoration: none;">Sign up</a></button>
            </div>
        </div>
    </div>
</body>
</html>