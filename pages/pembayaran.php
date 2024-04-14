<?php
session_start();

require 'koneksi.php';

// Cek apakah cookie 'ingat_saya' sudah ada
if (isset($_COOKIE['ingat_saya'])) {
  $_SESSION['sudah_login'] = true;
}

// Cek session login
if (!isset($_SESSION['sudah_login'])) {
  header('Location: ../samples/register.php');
  exit;
}

// mengambil plat kendaraan dari tabel transaksi
function getPlatKendaraanList() {
    global $conn;
    
    $plat_kendaraan_list = array();

    $sql = "SELECT DISTINCT kendaraan_plat_kendaraan FROM transaksi";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $plat_kendaraan_list[] = $row['kendaraan_plat_kendaraan'];
        }
    }
    return $plat_kendaraan_list;
}

function getTransaksiByPlatKendaraan($plat_kendaraan) {
    global $conn;
    $sql = "SELECT transaksi.*, pelanggan.nama_pelanggan, pegawai.nama_pegawai
            FROM transaksi 
            JOIN pelanggan ON transaksi.pelanggan_kode_pelanggan = pelanggan.id_pelanggan 
            JOIN pegawai ON transaksi.pegawai_kode_pegawai = pegawai.id_pegawai 
            WHERE kendaraan_plat_kendaraan = '$plat_kendaraan'";
    
    $result = mysqli_query($conn, $sql);
    $transaksi_list = array();
    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $transaksi_list[] = $row;
        }
    }
    return $transaksi_list;
}

    // cari plat 
    if (isset($_POST['submit'])) {
        $plat_kendaraan_search = $_POST['plat_kendaraan_search'];
        $transaksi_list = getTransaksiByPlatKendaraan($plat_kendaraan_search);
    }

    $plat_kendaraan_list = getPlatKendaraanList();

if (isset($_POST['submit-simpan'])) {
    $id_transaksi = $_POST['id_transaksi'];
    $pembayaran = $_POST['pembayaran'];
    $status_cuci = $_POST['status_cuci'];

    $update_sql = "UPDATE transaksi 
                SET pembayaran = '$pembayaran', status_cuci = '$status_cuci' 
                WHERE id_transaksi = '$id_transaksi'";

    $update_result = mysqli_query($conn, $update_sql);

    // Periksa apakah update berhasil
    if ($update_result) {
        echo "<script>alert('Data berhasil diperbarui')</script>";
        echo "<script>window.location.href = './lihat-cucian.php'</script>";
    } else {
        echo "<script>alert('Gagal memperbarui data')</script>";
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
                <div class="col-12 grid-margin stretch-card">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Pembayaran Pencucian Kendaraan</h4> <br>
                            <form method="POST">
                                <div class="form-group d-flex align-items-center">
                                    <label for="plat_kendaraan_search" class="mr-2">Cari Plat Kendaraan:</label>
                                    <select class="form-control" name="plat_kendaraan_search" id="plat_kendaraan_search">
                                        <?php foreach ($plat_kendaraan_list as $plat_kendaraan) : ?>
                                            <option value="<?php echo $plat_kendaraan; ?>"><?php echo $plat_kendaraan; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                    <button type="submit" class="btn btn-primary ml-2" name="submit">Cari</button>
                                </div>

                                <div class="form-group">
                                    <?php if (isset($transaksi_list) && !empty($transaksi_list)) : ?>
                                        <?php foreach ($transaksi_list as $transaksi) : ?>
                                        <div>
                                            <label for="id_transaksi">ID Transaksi:</label>
                                            <input class="form-control" type="text" id="id_transaksi" name="id_transaksi" value="<?php echo $transaksi['id_transaksi']; ?>" readonly>
                                        </div>
                                </div>

                                    <div class="form-group">
                                        <div>
                                            <label for="kendaraan_plat_kendaraan">Plat Kendaraan:</label>
                                            <input class="form-control" type="text" id="kendaraan_plat_kendaraan" name="kendaraan_plat_kendaraan" value="<?php echo $transaksi['kendaraan_plat_kendaraan']; ?>" readonly>
                                        </div>
                                    </div>

                                     <div class="form-group">
                                        <div>
                                            <label for="nama_pelanggan">Nama pelanggan:</label>
                                            <input class="form-control" type="text" id="nama_pelanggan" name="nama_pelanggan" value="<?php echo $transaksi['nama_pelanggan']; ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div>
                                            <label for="nama_pegawai">Penanggung jawab</label>
                                            <input class="form-control" type="text" id="nama_pegawai" name="nama_pegawai" value="<?php echo $transaksi['nama_pegawai']; ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div>
                                            <label for="tanggal">Tanggal:</label>
                                            <input class="form-control" type="text" id="tanggal" name="tanggal" value="<?php echo $transaksi['tanggal']; ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div>
                                            <label for="status_cuci">Status Cuci:</label>
                                            <select class="form-control" name="status_cuci" id="status_cuci">
                                                <option value="Dalam antrian" <?php echo ($transaksi['status_cuci'] == 'Dalam antrian') ? 'selected' : ''; ?>>Dalam antrian</option>
                                                <option value="Selesai" <?php echo ($transaksi['status_cuci'] == 'Selesai') ? 'selected' : ''; ?>>Selesai</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div>
                                            <label for="pembayaran">Pembayaran:</label>
                                            <select class="form-control" name="pembayaran" id="pembayaran">
                                                <option value="Belum bayar" <?php echo ($transaksi['pembayaran'] == 'Belum bayar') ? 'selected' : ''; ?>>Belum bayar</option>
                                                <option value="Sudah bayar" <?php echo ($transaksi['pembayaran'] == 'Sudah bayar') ? 'selected' : ''; ?>>Sudah bayar</option>
                                            </select>
                                        </div>
                                    </div>

                                    
                                    <?php endforeach; ?>
                                    <button type="submit" class="btn btn-primary mr-2" name="submit-simpan">Simpan</button>
                                <?php endif; ?>
                            </form>

                        </div>
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