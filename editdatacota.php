<?php

session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit();
}

include 'proses/koneksi.php';
$id = $_GET['id'];
$conn = new Koneksi();
$kueri = $conn->kueri("SELECT * FROM tb_arsipadopsi WHERE id_adopsi = '$id' ");
$data = $conn->hasil_data($kueri);
if (isset($_POST['edit'])) {
    $id = $_GET['id'];
    $kota = htmlspecialchars($_POST['kota']);
    $cotal = htmlspecialchars($_POST['cotal']);
    $cotap = htmlspecialchars($_POST['cotap']);
    $anak = htmlspecialchars($_POST['anak']);
    $tahun = htmlspecialchars($_POST['tahun']);
    // $skpa = htmlspecialchars($_POST['skpa']);

    $targetSk1 = "skpa/"; // Direktori tempat menyimpan file yang diupload
    $targetSkpa1 = $targetSk1 .  basename($_FILES["skpa"]["name"]); // Path lengkap file yang diupload
    // echo $targetSkpa1;


    $targetDir1 = "final/"; // Direktori tempat menyimpan file yang diupload
    $targetFile1 = $targetDir1 . basename($_FILES["final"]["name"]); // Path lengkap file yang diupload
    // echo $targetFile1;
    // die;

    $Kfinal = $data['final'];
    $Kskp = $data['skpa'];




    if ($targetSkpa1 == "skpa/" && $targetFile1 == "final/") {
        // echo "no";
        // die;
        // $status = 1;
        $abc = $conn->kueri("
    UPDATE tb_arsipadopsi SET kota='$kota',cotal='$cotal',cotap='$cotap',anak='$anak',tahun='$tahun' WHERE id_adopsi = '$id' ");
        if ($abc == true) {
            header("Location: datacota.php");
            exit();
        } else {
            $_SESSION['edit'] = "0";
            header("Location: datacota.php");
            exit();
        }
    } else 



    if ($targetSkpa1 != $Kskp && $targetFile1 == "final/") {

        // echo "yes";
        // die;

        $random    = rand(10, 1000);
        $targetSk = "skpa/"; // Direktori tempat menyimpan file yang diupload
        $targetSkpa = $targetSk . $random . "_" .  basename($_FILES["skpa"]["name"]); // Path lengkap file yang diupload
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

        // // Batasi ukuran file yang diupload (misalnya, maksimal 5MB)
        // $maxFileSize = 5 * 1024 * 1024; // 5 MB
        // if ($_FILES["skpa"]["size"] > $maxFileSize) {
        //     echo "Maaf, ukuran file terlalu besar. Maksimal 5MB.";
        //     $uploadDone = 0;
        // }


        // Hapus file lama


        // Jika semua kondisi terpenuhi, lakukan upload file
        if ($uploadDone == 1) {
            unlink($Kskp);

            if (move_uploaded_file($_FILES["skpa"]["tmp_name"], $targetSkpa)) {
                echo "File PDF berhasil diupload.";
            } else {
                echo "Maaf, terjadi kesalahan saat mengupload file.";
            }
        }


        $abc = $conn->kueri("
        UPDATE tb_arsipadopsi SET kota='$kota',cotal='$cotal',cotap='$cotap',anak='$anak',tahun='$tahun',skpa = '$targetSkpa'  WHERE id_adopsi = '$id' ");
        if ($abc == true) {
            header("Location: datacota.php");
            exit();
        } else {
            $_SESSION['edit'] = "0";
            header("Location: datacota.php");
            exit();
        }
    } else

if ($targetFile1 != $Kfinal && $targetSkpa1 == "skpa/") {
        // echo "yes2";
        // die;

        $random1    = rand(10, 9090);
        $targetDir = "final/"; // Direktori tempat menyimpan file yang diupload
        $targetFile = $targetDir . $random1 . "_" . basename($_FILES["final"]["name"]); // Path lengkap file yang diupload
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

        // // Batasi ukuran file yang diupload (misalnya, maksimal 5MB)
        // $maxFileSize = 5 * 1024 * 1024; // 5 MB
        // if ($_FILES["final"]["size"] > $maxFileSize) {
        //     echo "Maaf, ukuran file terlalu besar. Maksimal 5MB.";
        //     $uploadOk = 0;
        // }

        // Jika semua kondisi terpenuhi, lakukan upload file
        if ($uploadOk == 1) {
            unlink($Kfinal);
            if (move_uploaded_file($_FILES["final"]["tmp_name"], $targetFile)) {
                echo "File PDF berhasil diupload.";
            } else {
                echo "Maaf, terjadi kesalahan saat mengupload file.";
            }
        }

        $abc = $conn->kueri("
        UPDATE tb_arsipadopsi SET kota='$kota',cotal='$cotal',cotap='$cotap',anak='$anak',tahun='$tahun',final = '$targetFile'  WHERE id_adopsi = '$id' ");
        if ($abc == true) {
            header("Location: datacota.php");
            exit();
        } else {
            $_SESSION['edit'] = "0";
            header("Location: datacota.php");
            exit();
        } // Periksa apakah file yang diupload adalah file PD

    } else {
        // echo "yes3";
        // die;
        $random    = rand(10, 1000);
        $targetSk = "skpa/"; // Direktori tempat menyimpan file yang diupload
        $targetSkpa = $targetSk . $random . "_" .  basename($_FILES["skpa"]["name"]); // Path lengkap file yang diupload
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
        $maxFileSize = 5 * 1024 * 1024; // 5 MB
        if ($_FILES["skpa"]["size"] > $maxFileSize) {
            echo "Maaf, ukuran file terlalu besar. Maksimal 5MB.";
            $uploadDone = 0;
        }

        // Jika semua kondisi terpenuhi, lakukan upload file
        if ($uploadDone == 1) {
            unlink($Kskp);
            if (move_uploaded_file($_FILES["skpa"]["tmp_name"], $targetSkpa)) {
                echo "File PDF berhasil diupload.";
            } else {
                echo "Maaf, terjadi kesalahan saat mengupload file.";
            }
        }
        $random1    = rand(10, 9090);
        $targetDir = "final/"; // Direktori tempat menyimpan file yang diupload
        $targetFile = $targetDir . $random1 . "_" . basename($_FILES["final"]["name"]); // Path lengkap file yang diupload
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
        $maxFileSize = 5 * 1024 * 1024; // 5 MB
        if ($_FILES["final"]["size"] > $maxFileSize) {
            echo "Maaf, ukuran file terlalu besar. Maksimal 5MB.";
            $uploadOk = 0;
        }

        // Jika semua kondisi terpenuhi, lakukan upload file
        if ($uploadOk == 1) {
            unlink($Kfinal);
            if (move_uploaded_file($_FILES["final"]["tmp_name"], $targetFile)) {
                echo "File PDF berhasil diupload.";
            } else {
                echo "Maaf, terjadi kesalahan saat mengupload file.";
            }
        }

        $abc = $conn->kueri("
        UPDATE tb_arsipadopsi SET kota='$kota',cotal='$cotal',cotap='$cotap',anak='$anak',tahun='$tahun',skpa = '$targetSkpa', final = '$targetFile'  WHERE id_adopsi = '$id' ");
        if ($abc == true) {
            header("Location: datacota.php");
            exit();
        } else {
            $_SESSION['edit'] = "0";
            header("Location: datacota.php");
            exit();
        }
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
                            <h4 class="card-title">Edit Data Cota</h4>
                        </div>
                        <form action="" method="post" enctype="multipart/form-data">
                            <div class="card-body">
                                <?php
                                if (isset($_SESSION['simpan'])) {
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
                                                <option value="" selected>Pilih Kabupaten / Kota</option>
                                                <option value="Kabupaten Bangkalan"
                                                    <?php if ($data['kota'] == 'Kabupaten Bangkalan') echo 'selected'; ?>>
                                                    Kabupaten
                                                    Bangkalan</option>
                                                <option value="Kabupaten Banyuwangi"
                                                    <?php if ($data['kota'] == 'Kabupaten Banyuwangi') echo 'selected'; ?>>
                                                    Kabupaten
                                                    Banyuwangi</option>
                                                <option value="Kabupaten Blitar"
                                                    <?php if ($data['kota'] == 'Kabupaten Blitar') echo 'selected'; ?>>
                                                    Kabupaten
                                                    Blitar</option>
                                                <option value="Kabupaten Bojonegoro"
                                                    <?php if ($data['kota'] == 'Kabupaten Bojonegoro') echo 'selected'; ?>>
                                                    Kabupaten
                                                    Bojonegoro</option>
                                                <option value="Kabupaten Bondowoso"
                                                    <?php if ($data['kota'] == 'Kabupaten Bondowoso') echo 'selected'; ?>>
                                                    Kabupaten
                                                    Bondowoso</option>
                                                <option value="Kabupaten Gresik"
                                                    <?php if ($data['kota'] == 'Kabupaten Gresik') echo 'selected'; ?>>
                                                    Kabupaten
                                                    Gresik</option>
                                                <option value="Kabupaten Jember"
                                                    <?php if ($data['kota'] == 'Kabupaten Jember') echo 'selected'; ?>>
                                                    Kabupaten
                                                    Jember</option>

                                                <option value="Kabupaten Kediri"
                                                    <?php if ($data['kota'] == 'Kabupaten Kediri') echo 'selected'; ?>>
                                                    Kabupaten
                                                    Kediri</option>
                                                <option value="Kabupaten Jombang"
                                                    <?php if ($data['kota'] == 'Kabupaten Jombang') echo 'selected'; ?>>
                                                    Kabupaten
                                                    Jombang</option>
                                                <option value="Kabupaten Lamongan"
                                                    <?php if ($data['kota'] == 'Kabupaten Lamongan') echo 'selected'; ?>>
                                                    Kabupaten
                                                    Lamongan</option>
                                                <option value="Kabupaten Lumajang"
                                                    <?php if ($data['kota'] == 'Kabupaten Lumajang') echo 'selected'; ?>>
                                                    Kabupaten
                                                    Lumajang</option>
                                                <option value="Kabupaten Madiun"
                                                    <?php if ($data['kota'] == 'Kabupaten Madiun') echo 'selected'; ?>>
                                                    Kabupaten
                                                    Madiun</option>
                                                <option value="Kabupaten Magetan"
                                                    <?php if ($data['kota'] == 'Kabupaten Magetan') echo 'selected'; ?>>
                                                    Kabupaten
                                                    Magetan</option>
                                                <option value="Kabupaten Malang"
                                                    <?php if ($data['kota'] == 'Kabupaten Malang') echo 'selected'; ?>>
                                                    Kabupaten
                                                    Malang</option>


                                                <option value="Kabupaten Mojokerto"
                                                    <?php if ($data['kota'] == 'Kabupaten Mojokerto') echo 'selected'; ?>>
                                                    Kabupaten
                                                    Mojokerto</option>
                                                <option value="Kabupaten Nganjuk"
                                                    <?php if ($data['kota'] == 'Kabupaten Nganjuk') echo 'selected'; ?>>
                                                    Kabupaten
                                                    Nganjuk</option>
                                                <option value="Kabupaten Ngawi"
                                                    <?php if ($data['kota'] == 'Kabupaten Ngawi') echo 'selected'; ?>>
                                                    Kabupaten
                                                    Ngawi</option>
                                                <option value="Kabupaten Pacitan"
                                                    <?php if ($data['kota'] == 'Kabupaten Pacitan') echo 'selected'; ?>>
                                                    Kabupaten
                                                    Pacitan</option>
                                                <option value="Kabupaten Pamekasan"
                                                    <?php if ($data['kota'] == 'Kabupaten Pamekasan') echo 'selected'; ?>>
                                                    Kabupaten
                                                    Pamekasan</option>
                                                <option value="Kabupaten Pasuruan"
                                                    <?php if ($data['kota'] == 'Kabupaten Pasuruan') echo 'selected'; ?>>
                                                    Kabupaten
                                                    Pasuruan</option>
                                                <option value="Kabupaten Ponorogo"
                                                    <?php if ($data['kota'] == 'Kabupaten Ponorogo') echo 'selected'; ?>>
                                                    Kabupaten
                                                    Ponorogo</option>

                                                <option value="Kabupaten Probolinggo"
                                                    <?php if ($data['kota'] == 'Kabupaten Probolinggo') echo 'selected'; ?>>
                                                    Kabupaten
                                                    Probolinggo</option>
                                                <option value="Kabupaten Sampang"
                                                    <?php if ($data['kota'] == 'Kabupaten Sampang') echo 'selected'; ?>>
                                                    Kabupaten
                                                    Sampang</option>
                                                <option value="Kabupaten Sidoarjo"
                                                    <?php if ($data['kota'] == 'Kabupaten Sidoarjo') echo 'selected'; ?>>
                                                    Kabupaten
                                                    Sidoarjo</option>
                                                <option value="Kabupaten Situbondo"
                                                    <?php if ($data['kota'] == 'Kabupaten Situbondo') echo 'selected'; ?>>
                                                    Kabupaten
                                                    Situbondo</option>
                                                <option value="Kabupaten Sumenep"
                                                    <?php if ($data['kota'] == 'Kabupaten Sumenep') echo 'selected'; ?>>
                                                    Kabupaten
                                                    Sumenep</option>
                                                <option value="Kabupaten Trenggalek"
                                                    <?php if ($data['kota'] == 'Kabupaten Trenggalek') echo 'selected'; ?>>
                                                    Kabupaten
                                                    Trenggalek</option>
                                                <option value="Kabupaten Tuban"
                                                    <?php if ($data['kota'] == 'Kabupaten Tuban') echo 'selected'; ?>>
                                                    Kabupaten
                                                    Tuban</option>

                                                <option value="Kabupaten Tulungagung"
                                                    <?php if ($data['kota'] == 'Kabupaten Tulungagung') echo 'selected'; ?>>
                                                    Kabupaten
                                                    Tulungagung</option>
                                                <option value="Kota Batu"
                                                    <?php if ($data['kota'] == 'Kota Batu') echo 'selected'; ?>>
                                                    Kota
                                                    Batu</option>
                                                <option value="Kota Blitar"
                                                    <?php if ($data['kota'] == 'Kota Blitar') echo 'selected'; ?>>
                                                    Kota
                                                    Blitar</option>
                                                <option value="Kota Madiun"
                                                    <?php if ($data['kota'] == 'Kota Madiun') echo 'selected'; ?>>
                                                    Kota
                                                    Madiun</option>
                                                <option value="Kota Malang"
                                                    <?php if ($data['kota'] == 'Kota Malang') echo 'selected'; ?>>
                                                    Kota
                                                    Malang</option>
                                                <option value="Kota Mojokerto"
                                                    <?php if ($data['kota'] == 'Kota Mojokerto') echo 'selected'; ?>>
                                                    Kota
                                                    Mojokerto</option>
                                                <option value="Kota Pasuruan"
                                                    <?php if ($data['kota'] == 'Kota Pasuruan') echo 'selected'; ?>>
                                                    Kota
                                                    Pasuruan</option>
                                                <option value="Kota Probolinggo"
                                                    <?php if ($data['kota'] == 'Kota Probolinggo') echo 'selected'; ?>>
                                                    Kota
                                                    Probolinggo</option>
                                                <option value="Kota Surabaya"
                                                    <?php if ($data['kota'] == 'Kota Surabaya') echo 'selected'; ?>>
                                                    Kota
                                                    Surabaya</option>
                                            </select>

                                            <!-- <input type="text" class="form-control" id="basicInput"> -->
                                        </div>

                                        <div class="form-group">
                                            <label for="helpInputTop">Cota Laki-laki</label>
                                            <input type="text" name="cotal" value="<?= $data['cotal'] ?>"
                                                class="form-control" id="helpInputTop">
                                        </div>

                                        <div class="form-group">
                                            <label for="helpInputTop">Cota Perempuan</label>
                                            <input type="text" name="cotap" value="<?= $data['cotap'] ?>"
                                                class="form-control" id="helpInputTop">
                                        </div>

                                        <div class="form-group">
                                            <label for="helperText">Nama CAA</label>
                                            <input type="text" name="anak" value="<?= $data['anak'] ?>" id="helperText"
                                                class="form-control">
                                        </div>

                                    </div>
                                    <div class="col-md-6">

                                        <div class="form-group">
                                            <label for="helperText">Tahun SK Terbit</label>
                                            <input type="text" name="tahun" value="<?= $data['tahun'] ?>"
                                                id="helperText" class="form-control">
                                        </div>

                                        <div class="form-group">
                                            <label for="skpa">Upload SK Pengangkatan Anak</label>
                                            <p><?php echo isset($data['skpa']) ? $data['skpa'] : 'Tidak ada file yang diunggah'; ?>
                                            </p>
                                            <input type="file" name="skpa" accept="application/pdf" id="skpa"
                                                class="form-control">
                                            <p><small class="text-muted">Upload file dengan format pdf.</small>

                                        </div>


                                        <div class="form-group">
                                            <label for="skpa">Upload Berkas Pengangkatan</label>
                                            <p><?php echo isset($data['final']) ? $data['final'] : 'Tidak ada file yang diunggah'; ?>
                                            </p>
                                            <input type="file" name="final" accept="application/pdf" id="final"
                                                class="form-control">
                                            <p><small class="text-muted">Upload file dengan format pdf.</small>

                                        </div>

                                        <div class="btn-btn">
                                            <input type="submit" value="Submit" class="btn btn-primary" id="simpan"
                                                name="edit">
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