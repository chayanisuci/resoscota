<?php

session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

include 'proses/koneksi.php';

$conn = new Koneksi();
if (isset($_POST['simpan'])) {
    $kota = htmlspecialchars($_POST['kota']);
    $cotal = htmlspecialchars($_POST['cotal']);
    $cotap = htmlspecialchars($_POST['cotap']);
    $anak = htmlspecialchars($_POST['anak']);
    $tahun = htmlspecialchars($_POST['tahun']);
    // $skpa = htmlspecialchars($_POST['skpa']);
    // $final = htmlspecialchars($_POST['final']);



    $random    = rand(10, 1000);
    $targetSk = "skpa/"; // Direktori tempat menyimpan file yang diupload
    $name =  basename($_FILES["skpa"]["name"]);
    if ($name == '') {
        $targetSkpa = '';
    } else {
        $targetSkpa = $targetSk . $random . "_" .  basename($_FILES["skpa"]["name"]); // Path lengkap file yang diupload

    }
    $uploadDone = 1;
    $fileType = strtolower(pathinfo($targetSkpa, PATHINFO_EXTENSION));

    // Periksa apakah file yang diupload adalah file PDF
    if ($fileType != "pdf") {
        echo "Maaf, hanya file PDF yang diperbolehkan.";
        $uploadDone = 0;
    }

    // Periksa apakah file sudah ada di server
    if (file_exists($targetSkpa)) {
        echo "Maaf, file sudah ada di server.";
        $uploadDone = 0;
    }

    // Batasi ukuran file yang diupload (misalnya, maksimal 5MB)
    // $maxFileSize = 5 * 1024 * 1024; // 5 MB
    // if ($_FILES["skpa"]["size"] > $maxFileSize) {
    //     echo "Maaf, ukuran file terlalu besar. Maksimal 5MB.";
    //     $uploadDone = 0;
    // }

    // Jika semua kondisi terpenuhi, lakukan upload file
    if ($uploadDone == 1) {
        if (move_uploaded_file($_FILES["skpa"]["tmp_name"], $targetSkpa)) {
            echo "File PDF berhasil diupload.";
        } else {
            echo "Maaf, terjadi kesalahan saat mengupload file.";
        }
    }
    $random1    = rand(10, 9090);
    $targetDir = "final/"; // Direktori tempat menyimpan file yang diupload

    $name2 =  basename($_FILES["final"]["name"]);
    if ($name2 == '') {
        $targetFIle = '';
    } else {
        $targetFile = $targetDir . $random1 . "_" . basename($_FILES["final"]["name"]); // Path lengkap file yang diupload

    }

    $uploadOk = 1;
    $fileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Periksa apakah file yang diupload adalah file PDF
    if ($fileType != "pdf") {
        echo "Maaf, hanya file PDF yang diperbolehkan.";
        $uploadOk = 0;
    }

    // Periksa apakah file sudah ada di server
    if (file_exists($targetFile)) {
        echo "Maaf, file sudah ada di server.";
        $uploadOk = 0;
    }

    // Batasi ukuran file yang diupload (misalnya, maksimal 5MB)
    // $maxFileSize = 5 * 1024 * 1024; // 5 MB
    // if ($_FILES["final"]["size"] > $maxFileSize) {
    //     echo "Maaf, ukuran file terlalu besar. Maksimal 5MB.";
    //     $uploadOk = 0;
    // }

    // Jika semua kondisi terpenuhi, lakukan upload file
    if ($uploadOk == 1) {
        if (move_uploaded_file($_FILES["final"]["tmp_name"], $targetFile)) {
            echo "File PDF berhasil diupload.";
        } else {
            echo "Maaf, terjadi kesalahan saat mengupload file.";
        }
    }


    $insert = $conn->kueri("INSERT INTO `tb_arsipadopsi`(`kota`, `cotal`, `cotap`, `anak`, `tahun`, `skpa`, `final`)
  VALUES ('$kota','$cotal','$cotap','$anak','$tahun','$targetSkpa','$targetFile')");
    if ($insert == true) {
        $_SESSION['insert'] = "1";
        header("Location: datacota.php");
        exit();
    } else {
        $_SESSION['insert'] = "0";
        header("Location: datacota.php");
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
                <h3>Data Cota</h3>
            </div>
            <div class="page-content">
                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Input Data Cota</h4>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <?php
                                if (isset($_SESSION['simpah'])) {
                                    if ($_SESSION['simpan'] == 1) {
                                        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
                                                        <strong>Data Cota Berhasil Ditambahkan !
                                                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>';

                                        unset($_SESSION['simpan']);
                                    } elseif ($_SESSION['simpan'] == 0) {
                                        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                                                        <strong>Data Cota Gagal Ditambahkan !
                                                         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                                    </div>';
                                        unset($_SESSION['simpan']);
                                    }
                                }
                                ?>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="basicInput">Masukkan Kota Asal </label>
                                            <select class="form-select" name="kota" aria-label="Default select example">
                                                <option selected>Pilih Kabupaten / Kota</option>
                                                <option value="Kabupaten Bangkalan">Kabupaten Bangkalan</option>
                                                <option value="Kabupaten Banyuwangi">Kabupaten Banyuwangi</option>
                                                <option value="Kabupaten Blitar">Kabupaten Blitar</option>
                                                <option value="Kabupaten Bojonegoro">Kabupaten Bojonegoro</option>
                                                <option value="Kabupaten Bondowoso">Kabupaten Bondowoso</option>
                                                <option value="Kabupaten Gresik">Kabupaten Gresik</option>
                                                <option value="Kabupaten Jember">Kabupaten Jember</option>
                                                <option value="Kabupaten Kediri">Kabupaten Kediri</option>
                                                <option value="Kabupaten Jombang">Kabupaten Jombang</option>
                                                <option value="Kabupaten Lamongan">Kabupaten Lamongan</option>
                                                <option value="Kabupaten Lumajang">Kabupaten Lumajang</option>
                                                <option value="Kabupaten Madiun">Kabupaten Madiun</option>
                                                <option value="Kabupaten Magetan">Kabupaten Magetan</option>
                                                <option value="Kabupaten Malang">Kabupaten Malang</option>
                                                <option value="Kabupaten Mojokerto">Kabupaten Mojokerto</option>
                                                <option value="Kabupaten Nganjuk">Kabupaten Nganjuk</option>
                                                <option value="Kabupaten Ngawi">Kabupaten Ngawi</option>
                                                <option value="Kabupaten Pacitan">Kabupaten Pacitan</option>
                                                <option value="Kabupaten Pamekasan">Kabupaten Pamekasan</option>
                                                <option value="Kabupaten Pasuruan">Kabupaten Pasuruan</option>
                                                <option value="Kabupaten Ponorogo">Kabupaten Ponorogo</option>
                                                <option value="Kabupaten Probolinggo">Kabupaten Probolinggo</option>
                                                <option value="Kabupaten Sampang">Kabupaten Sampang</option>
                                                <option value="Kabupaten Sidoarjo">Kabupaten Sidoarjo</option>
                                                <option value="Kabupaten Situbondo">Kabupaten Situbondo</option>
                                                <option value="Kabupaten Sumenep">Kabupaten Sumenep</option>
                                                <option value="Kabupaten Trenggalek">Kabupaten Trenggalek</option>
                                                <option value="Kabupaten Tuban">Kabupaten Tuban</option>
                                                <option value="Kabupaten Tulungagung">Kabupaten Tulungagung</option>
                                                <option value="Kota Batu">Kota Batu</option>
                                                <option value="Kota Blitar">Kota Blitar</option>
                                                <option value="Kota Madiun">Kota Madiun</option>
                                                <option value="Kota Malang">Kota Malang</option>
                                                <option value="Kota Mojokerto">Kota Mojokerto</option>
                                                <option value="Kota Pasuruan">Kota Pasuruan</option>
                                                <option value="Kota Probolinggo">Kota Probolinggo</option>
                                                <option value="Kota Surabaya">Kota Surabaya</option>
                                            </select>
                                            <!-- <input type="text" class="form-control" id="basicInput"> -->
                                        </div>

                                        <div class="form-group">
                                            <label for="helpInputTop">Cota Laki-laki</label>
                                            <input type="text" name="cotal" class="form-control" id="helpInputTop">
                                        </div>

                                        <div class="form-group">
                                            <label for="helpInputTop">Cota Perempuan</label>
                                            <input type="text" name="cotap" class="form-control" id="helpInputTop">
                                        </div>

                                        <div class="form-group">
                                            <label for="helperText">Nama CAA</label>
                                            <input type="text" name="anak" id="helperText" class="form-control">
                                        </div>

                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="helperText">Tahun SK Terbit</label>
                                            <input type="text" name="tahun" id="helperText" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="helperText">Upload SK Pengangkatan Anak</label>
                                            <input type="file" name="skpa" accept="application/pdf" id="skpa"
                                                class="form-control">
                                            <p><small class="text-muted">Upload file dengan format pdf.</small>
                                            </p>
                                        </div>

                                        <div class="form-group">
                                            <label for="helperText">Upload Berkas Pengangkatan</label>
                                            <input type="file" name="final" accept="application/pdf" id="final"
                                                class="form-control">
                                            <p><small class="text-muted">Upload file dengan format pdf.</small>
                                            </p>
                                        </div>

                                        <div class="btn-btn">
                                            <input type="submit" value="Submit" class="btn btn-primary" id="simpan"
                                                name="simpan">
                                            <a href="datacota.php" class="btn btn-danger">Batal</a>
                                        </div>
                        </form>
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

    <!-- Need: Apexcharts -->
    <script src="assets/extensions/apexcharts/apexcharts.min.js"></script>
    <script src="assets/js/pages/dashboard.js"></script>

</body>

</html>