<?php
include 'proses/koneksi.php';
session_start();



$conn = new Koneksi();

$tampil = $conn->kueri("SELECT * FROM `tb_arsipadopsi`");

// $datkos = $conn->kueri("SELECT skpa, final WHERE skpa = null or final = null ");
// $data = $conn->hasil_data($datkos);



//----------------------Hapus------------------------------------------------------

if (isset($_POST['delete'])) {
    $id = $_POST['delete'];
    $unlink = $conn->kueri("SELECT * FROM `tb_arsipadopsi` WHERE id_adopsi = '$id'");
    $data = $conn->hasil_data($unlink);
    $final = $data['final'];
    $skpa = $data['skpa'];
    unlink($final);
    unlink($skpa);
    $dlt = $conn->kueri("DELETE FROM tb_arsipadopsi WHERE id_adopsi = '$id' ");
    if ($dlt == true) {



        $_SESSION['hapus'] = "1";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        $_SESSION['hapus'] = "0";
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
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
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>Data Cota</h3>
                            <p class="text-subtitle text-muted">
                                Masukkan data "cota" dengan benar
                            </p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="index.php">Dashboard</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">
                                        Data Cota
                                    </li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <!-- Basic Tables start -->
                <section class="section">
                    <div class="card">
                        <div class="card-header">Data Cota</div>
                        <div class="btn-tambah p-3">
                            <a href="tambahdatacota.php" class="btn btn-primary">Tambah
                                Data Cota</a>
                        </div>

                        <?php
                        if (isset($_SESSION['hapus'])) {
                            if ($_SESSION['hapus'] == 1) {
                                echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                        <strong>Data Cota Berhasil Dihapus !
                                                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>';
                                unset($_SESSION['hapus']);
                            } elseif ($_SESSION['hapus'] == 0) {
                                echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                        <strong>Data Cota Gagal Dihapus!
                                                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>';
                                unset($_SESSION['hapus']);
                            }
                        }
                        ?>

                        <div class="card-body">

                            <table class="table" id="table1">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kab/Kota</th>
                                        <th>Cota L</th>
                                        <th>Cota P</th>
                                        <th>CAA</th>
                                        <th>Tahun</th>
                                        <th>SKPA</th>
                                        <th>Final</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $no = 1192;
                                    foreach ($tampil as $data) { ?>
                                        <tr>
                                            <td><?= $no++ ?></td>
                                            <td><?= $data['kota'] ?></td>
                                            <td><?= $data['cotal'] ?></td>
                                            <td><?= $data['cotap'] ?></td>
                                            <td><?= $data['anak'] ?></td>
                                            <td><?= $data['tahun'] ?></td>
                                            <td>
                                                <?php
                                                if ($data['skpa'] == null) { ?>
                                                    <a href="#" onclick="alert('File Kosong !')" class="btn btn-success btn-sm"><i class="bi bi-download"></i></a>

                                                <?php } else {
                                                ?>
                                                    <a href="<?= $data['skpa'] ?>" class="btn btn-primary btn-sm" target="_blank"><i class="bi bi-download"></i></a>
                                                <?php } ?>
                                            </td>

                                            <td>
                                                <?php
                                                if ($data['final'] == null) { ?>
                                                    <a href="#" onclick="alert('File Kosong !')" class="btn btn-success btn-sm"><i class="bi bi-download"></i></a>

                                                <?php } else {
                                                ?>
                                                    <a href="<?= $data['final'] ?>" class="btn btn-primary btn-sm" target="_blank"><i class="bi bi-download"></i></a>
                                                <?php } ?>
                                            </td>
                                            <td>
                                                <a href="editdatacota.php?id=<?= $data['id_adopsi'] ?> " class="btn btn-warning btn-sm"><i class="bi bi-pencil"></i></a>
                                                <?php echo '<button type="button" data-bs-toggle="modal" class="btn btn-danger btn-sm" data-bs-target="#hapus' . $data['id_adopsi'] . '"><i class="bi bi-trash"></i></button>'; ?>
                                            </td>
                                        </tr>


                                        <!-- modal-hapus -->
                                        <?php echo '<div class="modal fade" id="hapus' . $data['id_adopsi'] . '" tabindex="-1"  
            aria-labelledby="exampleModalLabel" aria-hidden="true">'; ?>
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Hapus Data Barang</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <center>
                                                        <h4>Apakah anda ingin hapus data</h4>
                                                        <h4>tersebut ?</h4>
                                                    </center>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                                                    <form action="" method="POST">
                                                        <?php echo '<button type="submit" class="btn btn-primary" name="delete" value="' . $data['id_adopsi'] . ' " ">Hapus</button>'; ?>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                        </div>
                        <!-- end-modal-hapus -->

                    <?php } ?>
                    </tbody>
                    </table>
                    </div>
            </div>
            </section>
            <!-- Basic Tables end -->
        </div>



        <?php include_once "menu/footer.php" ?>

    </div>
    </div>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/app.js"></script>

    <script src="assets/extensions/jquery/jquery.min.js"></script>
    <script src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>
    <script src="assets/js/pages/datatables.js"></script>


</body>


</html>