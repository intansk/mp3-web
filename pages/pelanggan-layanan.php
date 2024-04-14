<?php
session_start();

require 'koneksi.php'; 

// cek cookie
if (isset($_COOKIE['ingat_saya'])) {
  $_SESSION['sudah_login_pelanggan'] = true;
}

// cek session
if(isset($_SESSION['sudah_login_pelanggan'])) {
} else {
  echo "<script>alert('Harap login terlebih dahulu!')</script>";
  echo "<script>window.location.href = '../index.php';</script>"; 
  exit;
}

// Eksekusi kueri SQL
$sql = "SELECT * FROM layanan";

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
      <?php include '../partials/_sidebar-pelanggan.php'; ?>

      <!-- main content -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-lg-12 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <h4 class="card-title">Layanan Pencucian</h4>
                  <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Layanan</th>
                                <th>Deskripsi Layanan</th>
                                <th>Harga</th>
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
                                echo "<td>" . $data['nama_layanan'] . "</td>";
                                echo "<td>" . $data['deskripsi_layanan'] . "</td>";
                                echo "<td>" . $data['harga'] . "</td>";
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
