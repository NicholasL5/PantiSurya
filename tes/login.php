<?php
include '../includes/config.php';

// if (isLogin()) {
//     header('location: dashboard.php');
//     exit;
// }

if (isset($_POST['login'])) {
    $username = $_POST['username']; 
    $password = $_POST['password'];

    $error_val = [];
    $cek_username = "SELECT password FROM `login` WHERE username = ? AND deleted_at IS NULL";
    $cek_username = $pdo->prepare($cek_username);
    $cek_username->execute([ $username ]);
    $fetch_data = $cek_username->fetch(PDO::FETCH_OBJ);

    if ($cek_username->rowCount() == 0)
        $error_val['username'] = 'Username tidak tersedia.';

    if ($password == '' || ($cek_username->rowCount() > 0 && !password_verify($password, $fetch_data->password)))
        $error_val['password'] = 'Kata sandi yang diketik salah.';

    if (count($error_val) == 0) {
        $md5_sess = md5(time().$password);
        $update_session = "UPDATE `login` SET session_login = ?, last_login = ? WHERE username = ? AND deleted_at IS NULL";
        $update_session = $pdo->prepare($update_session);
        $update_session->execute([ $md5_sess, date('Y-m-d H:i:s', time()), $username]);

        setcookie('user_login', $md5_sess, time() + (86400 * 2), '/');
        header('location: dashboard.php');
    }
}

$title = 'Login';
include './includes/__head.php';
?>

<div class="container">
    <div class="login-form">
        <div class="content">
            <div class="text-center">
                <img src="../assets/img/logo-surya.png" class="logo" />
            </div>
            <form method="post">
                <div class="mb-3">
                    <!-- Change 'email' to 'username' for the input field -->
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username" class="form-control<?=isset($error_val['username']) ? ' is-invalid' : ''?>" placeholder="Username">
                    
                    <?php if (isset($error_val['username'])): ?>
                        <div class="invalid-feedback"><?=$error_val['username']?></div>
                    <?php endif ?>
                </div>

                <div class="mb-3">
                    <label for="kata_sandi" class="form-label">Kata Sandi</label>
                    <input type="password" name="password" id="kata_sandi" class="form-control<?=isset($error_val['password']) ? ' is-invalid' : ''?>" placeholder="Kata Sandi">
                    <?php if (isset($error_val['password'])): ?>
                        <div class="invalid-feedback"><?=$error_val['password']?></div>
                    <?php endif ?>
                </div>

                <div class="d-grid">
                    <button class="btn btn-primary" name="login">Masuk</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $pdo = null ?>