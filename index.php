<?php
session_start();
if (!isset($_SESSION["admin_id"])) {
    header("Location: login.php");
    exit;
}
include_once "proses/koneksi.php";
$conn = new Koneksi();
$totaldata = $conn->kueri("SELECT * FROM tb_arsipadopsi ");
$total = $conn->jumlah_data($totaldata);
$countEmptyFields = 0;
$countFields = 0;

foreach ($totaldata as $row) {
    if (($row['skpa'] == "") || ($row['final'] == "")) {
        $countEmptyFields++;
    } else
    if (($row['skpa'] != "") && ($row['final'] != "")) {
        $countFields++;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include_once "menu/header.php" ?>

<body>
    <div id="app">
        <?php include_once "menu/sidebar.php" ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>Selamat Datang Di Resos Cota</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div
                                                class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                <div class="stats-icon purple mb-2">
                                                    <center><i style="margin-top:-30px"
                                                            class="bi bi-graph-down-arrow"></i></center>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">Jumlah Data yang Sudah Lengkap</h6>
                                                <h6 class="font-extrabold mb-0"><?= $countFields ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div
                                                class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                <div class="stats-icon green mb-2">
                                                    <center><i style="margin-top:-30px"
                                                            class="bi bi-graph-up-arrow"></i></center>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">Jumlah Data yang Belum Lengkap</h6>
                                                <h6 class="font-extrabold mb-0"><?= $countEmptyFields ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div
                                                class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                <div class="stats-icon red mb-2">
                                                    <center><i style="margin-top:-30px"
                                                            class="bi bi-clipboard-data-fill"></i></center>
                                                </div>
                                            </div>
                                            <div class=" col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">Total Keseluruhan Data</h6>
                                                <h6 class="font-extrabold mb-0"><?= $total ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section class="row">
                    <div class="col-12 col-lg-9">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Data Cota</h4>
                                    </div>
                                    <div class="card-body">
                                        <center><img src="assets/images/dad.png" style="width:70%"></center>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-12 col-lg-3">
                        <div class="card">
                            <div class="card-body py-1 px-1">
                                <div class="d-flex align-items-center">
                                    <div class="wrapper col-12 col-lg-3">
                                        <header>
                                            <p class="current-date"></p>
                                            <div class="icons">
                                                <span id="prev" class="material-symbols-rounded">chevron_left</span>
                                                <span id="next" class="material-symbols-rounded">chevron_right</span>
                                            </div>
                                        </header>
                                        <div class="calendar">
                                            <ul class="weeks">
                                                <li>Mi</li>
                                                <li>Se</li>
                                                <li>Se</li>
                                                <li>Ra</li>
                                                <li>Ka</li>
                                                <li>Ju</li>
                                                <li>Sa</li>
                                            </ul>
                                            <ul class="days"></ul>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </section>
            </div>

            <?php include_once "menu/footer.php" ?>
        </div>
    </div>


    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>

    <!-- Need: Apexcharts -->
    <script src="assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>

    <!-- kalender -->
    <script src="assets/js/kalender.js"></script>


</body>

</html>