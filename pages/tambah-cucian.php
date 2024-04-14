<?php
session_start();

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'pencucian';

$conn = mysqli_connect($hostname, $username, $password, $database);

// pengecekan koneksi
if (!$conn) {
    echo('koneksi database gagal');
    exit;
}

// cek cookie
if (!isset($_COOKIE['ingat_saya'])) {
} else {
  $_SESSION['sudah_login'] = true;
}

// cek session
if(isset($_SESSION['sudah_login'])) {
} else {
  $_SESSION['sudah_login'] = true; 
  echo "<script>alert('Harap login terlebih dahulu!')</script>";
  echo "<script>window.location.href = '../index.php';</script>"; 
}

if (isset($_POST['submit'])) {
    $nama_pegawai = $_POST['nama_pegawai'];
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $nama_layanan = $_POST['nama_layanan'];
    $plat_kendaraan = $_POST['plat_kendaraan'];
  
    $sql = "INSERT INTO
      transaksi (pelanggan_kode_pelanggan, pegawai_kode_pegawai, layanan_kode_layanan, kendaraan_plat_kendaraan)
      VALUES ('$nama_pelanggan', '$nama_pegawai', '$nama_layanan', '$plat_kendaraan')";
    
    $result = mysqli_query($conn, $sql);
  
    if ($result == true) {
      echo "<script>alert('Data berhasil ditambah')</script>";
      echo "<script>window.location.href = './lihat-cucian.php'</script>";
    } else {
      echo "<script>alert('Gagal menambah data')</script>";
      echo "<script>window.location.reload()</script>";
    }
  }

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Kuma Car Spa</title>

  <link rel="stylesheet" href="../vendors/feather/feather.css">
  <link rel="stylesheet" href="../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../vendors/select2/select2.min.css">
  <link rel="stylesheet" href="../vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  <link rel="stylesheet" href="../css/vertical-layout-light/style.css">
  <link rel="shortcut icon" href="../images/favicon.png" />
</head>

<body>
<div class="container-scroller">
        <?php include '../partials/_navbar.php'; ?>

        <div class="container-fluid page-body-wrapper">
        <?php include '../partials/_sidebar-pegawai.php'; ?>
        
        <!-- partial -->
      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Pendaftaran Pencucian</h4>
                  <form class="forms-sample" method="POST" action="tambah-cucian.php">
                    
                  <div class="form-group">
                      <label for="nama_pegawai">Penanggung Jawab</label>
                      <select class="form-control" id="nama_pegawai" name="nama_pegawai">
                        <?php
                        $sql = "SELECT id_pegawai, nama_pegawai FROM pegawai";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['id_pegawai'] . "'>" . $row['nama_pegawai'] . "</option>";
                        }
                        ?>
                    </select>
                    </div>

                    <div class="form-group">
                      <label for="nama_pelanggan">Nama Pelanggan</label>
                      <select class="form-control" id="nama_pelanggan" name="nama_pelanggan">
                        <?php
                        $sql = "SELECT id_pelanggan, nama_pelanggan FROM pelanggan";
                        $result = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<option value='" . $row['id_pelanggan'] . "'>" . $row['nama_pelanggan'] . "</option>";
                        }
                        ?>
                    </select>
                    </div>

                    <div class="form-group">
                        <label for="plat_kendaraan">Plat Kendaraan</label>
                        <select class="form-control" id="plat_kendaraan" name="plat_kendaraan">
                            <?php
                            $sql = "SELECT plat_kendaraan FROM kendaraan";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row['plat_kendaraan'] . "'>" . $row['plat_kendaraan'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="layanan">Layanan</label>
                        <select class="form-control" id="layanan" name="nama_layanan">
                            <?php
                            $sql = "SELECT id_layanan, nama_layanan FROM layanan";
                            $result = mysqli_query($conn, $sql);
                            while ($row = mysqli_fetch_assoc($result)) {
                                echo "<option value='" . $row['id_layanan'] . "'>" . $row['nama_layanan'] . "</option>";
                            }
                            ?>
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary mr-2" name="submit">Submit</button>
                    <button class="btn btn-light">Cancel</button>
                  </form>
                </div>
              </div>
            </div>           
          </div>
        </div>

        <?php include '../partials/_footer.php'; ?>

      </div>
    </div>
  </div>

  <script src="../vendors/js/vendor.bundle.base.js"></script>
  <script src="../vendors/typeahead.js/typeahead.bundle.min.js"></script>
  <script src="../vendors/select2/select2.min.js"></script>
  <script src="../js/off-canvas.js"></script>
  <script src="../js/hoverable-collapse.js"></script>
  <script src="../js/template.js"></script>
  <script src="../js/settings.js"></script>
  <script src="../js/todolist.js"></script>
  <script src="../js/file-upload.js"></script>
  <script src="../js/typeahead.js"></script>
  <script src="../js/select2.js"></script>

</body>
</html>
