<?php
include "proses/koneksi.php";

$conn = new Koneksi();

if (isset($_POST['daftar'])) {
    $username = htmlspecialchars($_POST['tname']);
    $password = md5(htmlspecialchars($_POST['tpass']));

    $abc = $conn->kueri("INSERT INTO `tb_admin`( `username`, `password`) VALUES ('$username','$password')");
    if ($abc == true) {
        $_SESSION['daftar'] = "1";
        header("Location: login.php");
        exit();
    } else {
        $_SESSION['daftar'] = "0";
        header("Location: login.php");
        exit();
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
    <link rel="shortcut icon" href="assets/images/logo/favicon.svg" type="image/x-icon">
    <link rel="shortcut icon" href="assets/images/logo/favicon.png" type="image/png">
</head>

<body>
    <div id="auth">

        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">

                    <h1 class="auth-title">Daftar</h1>
                    <p class="auth-subtitle mb-5">Masukkan data untuk mendaftar.</p>

                    <form method="POST">

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" name="tname" placeholder="Username">
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" name="tpass" placeholder="Password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>

                        <input type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="daftar" value="Daftar">
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class='text-gray-600'>Sudah punya akun? <a href="login.php" class="font-bold">Log
                                in</a>.</p>
                    </div>
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