<?php
session_start();
include "proses/koneksi.php";
$kon = new Koneksi();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve the input values
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    if (empty($_POST['username']) || empty(md5($_POST['password']))) {
        $error = 'Masukan Username and Password.';
    } else {
        $abc = $kon->kueri("SELECT * FROM tb_admin WHERE username='$username' AND password= '$password' ");
        $user = $kon->hasil_data($abc);
        if (!$user) {
            $error = 'Invalid Username atau Password.';
        } else {
            // Check if the password matches the hshed password stored in the database
            if (($password == $user['password'])) {
                // Passwords match, so create a session for the user and redirect to a secured page
                $_SESSION['admin_id'] = $user['id_admin'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['password'] = $user['password'];
                header('Location: index.php');
                exit;
            } elseif ($password != $user['password']) {
                // Passwords do not match, so display an error message
                $error = 'Invalid Username atau Password.';
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ResosCota</title>
    <link rel="stylesheet" href="assets/css/main/app.css">
    <link rel="stylesheet" href="assets/css/pages/auth.css">
    <link rel="shortcut icon" href="assets/images/logo/logo.jpg" type="image/jpg">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">

                    <h1 class="auth-title">Masuk.</h1>
                    <p class="auth-subtitle mb-5">Masukkan Username & Password Dengan Benar</p>

                    <form method="POST">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" name="username" class="form-control form-control-xl"
                                placeholder="Username">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="password" class="form-control form-control-xl"
                                placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Masuk</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>

    </div>
</body>

</html>