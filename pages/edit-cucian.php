<?php
session_start();

require 'koneksi.php';

// cek cookie
if (!isset($_COOKIE['ingat_saya'])) {
} else {
  $_SESSION['sudah_login'] = true;
}

// cek session
if(isset($_SESSION['sudah_login'])) {
} else {
  $_SESSION['sudah_login'] == true; 
  echo "<script>alert('Harap login terlebih dahulu!')</script>";
  echo "<script>window.location.href = '../index.php';</script>"; 
}

// edit data
if (isset($_POST['submit'])) {
    $plat_kendaraan = $_POST['plat_kendaraan'];
    $nama_pegawai = $_POST['nama_pegawai'];
    $jenis_kendaraan = $_POST['jenis_kendaraan'];
    $merek = $_POST['merek'];
    $layanan = $_POST['layanan'];

    $sql = "UPDATE kendaraan
            INNER JOIN transaksi ON kendaraan.plat_kendaraan = transaksi.kendaraan_plat_kendaraan
            INNER JOIN pegawai ON transaksi.pegawai_kode_pegawai = pegawai.id_pegawai
            INNER JOIN layanan ON transaksi.layanan_kode_layanan = layanan.id_layanan
            SET kendaraan.jenis_kendaraan = '$jenis_kendaraan',
                kendaraan.merek = '$merek',
                pegawai.nama_pegawai = '$nama_pegawai',
                layanan.nama_layanan = '$layanan'
            WHERE kendaraan.plat_kendaraan = '$plat_kendaraan'";

    $result = mysqli_query($conn, $sql);

    if ($result == true) {
        echo "<script>alert('Data berhasil diedit')</script>";
        echo "<script>window.location.href = './lihat-cucian.php'</script>";
    } else {
        echo "<script>alert('Data gagal di edit')</script>";
    }
}

if (isset($_GET['plat_kendaraan'])) {
    $plat_kendaraan = $_GET['plat_kendaraan'];
    $sql_select = "SELECT kendaraan.plat_kendaraan, pegawai.nama_pegawai, kendaraan.jenis_kendaraan, kendaraan.merek, layanan.nama_layanan
                    FROM kendaraan
                    INNER JOIN transaksi ON kendaraan.plat_kendaraan = transaksi.kendaraan_plat_kendaraan
                    INNER JOIN pegawai ON transaksi.pegawai_kode_pegawai = pegawai.id_pegawai
                    INNER JOIN layanan ON transaksi.layanan_kode_layanan = layanan.id_layanan
                    WHERE kendaraan.plat_kendaraan = '$plat_kendaraan'";
    $result_select = mysqli_query($conn, $sql_select);
    $row = mysqli_fetch_assoc($result_select);
}
  
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Skydash Admin</title>

  <link rel="stylesheet" href="../vendors/feather/feather.css">
  <link rel="stylesheet" href="../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../vendors/select2/select2.min.css">
  <link rel="stylesheet" href="../vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  <link rel="stylesheet" href="../css/vertical-layout-light/style.css">
  <link rel="shortcut icon" href="../images/favicon.png" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css">
</head>

<body>
    <div class="container-scroller">
        <?php include '../partials/_navbar.php'; ?>

        <div class="container-fluid page-body-wrapper">
        <?php include '../partials/_sidebar-pegawai.php'; ?>
    
      <!-- main content -->
      <div class="main-panel">        
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Edit Data</h4>
                  <form class="forms-sample" action="edit-cucian.php" method="POST">
                    <div class="form-group">
                      <label for="plat_kendaraan">Plat Kendaraan</label>
                      <input type="text" class="form-control" id="plat_kendaraan" name="plat_kendaraan" value="<?php echo $row['plat_kendaraan']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="penanggung_jawab">Penanggung Jawab</label>
                      <input type="text" class="form-control" name="nama_pegawai" id="nama_pegawai" value="<?php echo $row['nama_pegawai']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="jenis_kendaraan">Jenis Kendaraan</label>
                      <input type="text" class="form-control" name="jenis_kendaraan" id="jenis_kendaraan" value="<?php echo $row['jenis_kendaraan']; ?>" >
                    </div>
                    <div class="form-group">
                      <label for="merek">Merek</label>
                      <input type="text" class="form-control" name="merek" id="merek" value="<?php echo $row['merek']; ?>">
                    </div>
                    <div class="form-group">
                      <label for="layanan">Layanan</label>
                      <input type="text" class="form-control" name="layanan" id="layanan" value="<?php echo $row['nama_layanan']; ?>">
                    </div>
                    <button type="submit" class="btn btn-primary mr-2" name="submit">Simpan</button>
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