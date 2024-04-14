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
  $_SESSION['sudah_login'] == true; 
  echo "<script>alert('Harap login terlebih dahulu!')</script>";
  echo "<script>window.location.href = '../index.php';</script>"; 
}

// Eksekusi kueri SQL
$sql = "SELECT kendaraan.plat_kendaraan, kendaraan.jenis_kendaraan, kendaraan.merek,
            pegawai.nama_pegawai,
            layanan.nama_layanan, layanan.harga,
            transaksi.status_cuci
        FROM transaksi
        INNER JOIN kendaraan ON transaksi.pelanggan_kode_pelanggan = kendaraan.kode_pelanggan
        INNER JOIN pegawai ON transaksi.pegawai_kode_pegawai = pegawai.id_pegawai
        INNER JOIN layanan ON transaksi.layanan_kode_layanan = layanan.id_layanan";
        

$result = mysqli_query($conn, $sql);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Kuma Car Span</title>

  <link rel="stylesheet" href="../vendors/feather/feather.css">
  <link rel="stylesheet" href="../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
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
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">History pencucian</h4>
                  <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nomor Polisi</th>
                                <th>Penanggung Jawab</th>
                                <th>Jenis</th>
                                <th>Merek</th>
                                <th>Layanan</th>
                            </tr>
                        </thead>
                    <tbody>
                        <?php
                        $no = 1;

                        // Tampilkan data dalam tabel HTML
                        if (mysqli_num_rows($result) > 0) {
                            while ($data = mysqli_fetch_assoc($result)) {
                                echo "<tr>";
                                echo "<td>" . $no . "</td>";
                                echo "<td>" . $data['plat_kendaraan'] . "</td>";
                                echo "<td>" . $data['nama_pegawai'] . "</td>";
                                echo "<td>" . $data['jenis_kendaraan'] . "</td>";
                                echo "<td>" . $data['merek'] . "</td>";
                                echo "<td>" . $data['nama_layanan'] . "</td>";
                                echo "</tr>";
                                $no++;
                            }
                        } else {
                            echo "Tidak ada data.";
                        }
                        ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        
        <!-- footer -->
        <?php include '../partials/_footer.php'; ?>
      </div>
    </div>
  </div>

  <script src="../vendors/js/vendor.bundle.base.js"></script>
  <script src="../js/off-canvas.js"></script>
  <script src="../js/hoverable-collapse.js"></script>
  <script src="../js/template.js"></script>
  <script src="../js/settings.js"></script>
  <script src="../js/todolist.js"></script>

</body>
</html>