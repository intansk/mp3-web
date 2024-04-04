<?php

// session_start();

// // cek 'ingat saya' dulu
// // kalau ingat, tambahkan sudah_login di Session
// if (isset($_COOKIE['ingat_saya'])) {
//   $_SESSION['sudah_login'] = true;
// }

// // cek session login
// if (!isset($_SESSION['sudah_login'])) {
//   header('Location: login.php');
//   exit;
// }

// require 'conn.php';

$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'pencucian';

$conn = mysqli_connect($hostname, $username, $password, $database);

// pengecekan conn
if (!$conn) {
    echo('conn database gagal');
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

    // Panggil fungsi untuk mendapatkan daftar plat kendaraan
    $plat_kendaraan_list = getPlatKendaraanList();

    // Periksa apakah tombol "Simpan" telah diklik
if (isset($_POST['submit-simpan'])) {
    // Tangkap nilai input dari form
    $id_transaksi = $_POST['id_transaksi'];
    $pembayaran = $_POST['pembayaran'];
    $status_cuci = $_POST['status_cuci'];

    // Update data dalam tabel transaksi
    $update_sql = "UPDATE transaksi 
                SET pembayaran = '$pembayaran', status_cuci = '$status_cuci' 
                WHERE id_transaksi = '$id_transaksi'";

    // Eksekusi query update
    $update_result = mysqli_query($conn, $update_sql);

    // Periksa apakah update berhasil
    if ($update_result) {
        echo "<script>alert('Data berhasil diperbarui')</script>";
        // Redirect ke halaman lain atau lakukan tindakan lainnya
    } else {
        echo "<script>alert('Gagal memperbarui data')</script>";
        // Tindakan lain jika update gagal
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Skydash Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="../../vendors/feather/feather.css">
  <link rel="stylesheet" href="../../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="../../vendors/select2/select2.min.css">
  <link rel="stylesheet" href="../../vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="../../css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="../../images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:../../partials/_navbar.html -->
    <nav class="navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
      <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
        <a class="navbar-brand brand-logo mr-5" href="../../index.html"><img src="../../images/logo.svg" class="mr-2" alt="logo"/></a>
        <a class="navbar-brand brand-logo-mini" href="../../index.html"><img src="../../images/logo-mini.svg" alt="logo"/></a>
      </div>
      <div class="navbar-menu-wrapper d-flex align-items-center justify-content-end">
        <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
          <span class="icon-menu"></span>
        </button>
        <ul class="navbar-nav mr-lg-2">
          <li class="nav-item nav-search d-none d-lg-block">
            <div class="input-group">
              <div class="input-group-prepend hover-cursor" id="navbar-search-icon">
                <span class="input-group-text" id="search">
                  <i class="icon-search"></i>
                </span>
              </div>
              <input type="text" class="form-control" id="navbar-search-input" placeholder="Search now" aria-label="search" aria-describedby="search">
            </div>
          </li>
        </ul>
        <ul class="navbar-nav navbar-nav-right">
          <li class="nav-item dropdown">
            <a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">
              <i class="icon-bell mx-0"></i>
              <span class="count"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
              <p class="mb-0 font-weight-normal float-left dropdown-header">Notifications</p>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-success">
                    <i class="ti-info-alt mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Application Error</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Just now
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-warning">
                    <i class="ti-settings mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">Settings</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    Private message
                  </p>
                </div>
              </a>
              <a class="dropdown-item preview-item">
                <div class="preview-thumbnail">
                  <div class="preview-icon bg-info">
                    <i class="ti-user mx-0"></i>
                  </div>
                </div>
                <div class="preview-item-content">
                  <h6 class="preview-subject font-weight-normal">New user registration</h6>
                  <p class="font-weight-light small-text mb-0 text-muted">
                    2 days ago
                  </p>
                </div>
              </a>
            </div>
          </li>
          <li class="nav-item nav-profile dropdown">
            <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
              <img src="../../images/faces/face28.jpg" alt="profile"/>
            </a>
            <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
              <a class="dropdown-item">
                <i class="ti-settings text-primary"></i>
                Settings
              </a>
              <a class="dropdown-item">
                <i class="ti-power-off text-primary"></i>
                Logout
              </a>
            </div>
          </li>
          <li class="nav-item nav-settings d-none d-lg-flex">
            <a class="nav-link" href="#">
              <i class="icon-ellipsis"></i>
            </a>
          </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
          <span class="icon-menu"></span>
        </button>
      </div>
    </nav>
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:../../partials/_settings-panel.html -->
      <div class="theme-setting-wrapper">
        <div id="settings-trigger"><i class="ti-settings"></i></div>
        <div id="theme-settings" class="settings-panel">
          <i class="settings-close ti-close"></i>
          <p class="settings-heading">SIDEBAR SKINS</p>
          <div class="sidebar-bg-options selected" id="sidebar-light-theme"><div class="img-ss rounded-circle bg-light border mr-3"></div>Light</div>
          <div class="sidebar-bg-options" id="sidebar-dark-theme"><div class="img-ss rounded-circle bg-dark border mr-3"></div>Dark</div>
          <p class="settings-heading mt-2">HEADER SKINS</p>
          <div class="color-tiles mx-0 px-4">
            <div class="tiles success"></div>
            <div class="tiles warning"></div>
            <div class="tiles danger"></div>
            <div class="tiles info"></div>
            <div class="tiles dark"></div>
            <div class="tiles default"></div>
          </div>
        </div>
      </div>
      <div id="right-sidebar" class="settings-panel">
        <i class="settings-close ti-close"></i>
        <ul class="nav nav-tabs border-top" id="setting-panel" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="todo-tab" data-toggle="tab" href="#todo-section" role="tab" aria-controls="todo-section" aria-expanded="true">TO DO LIST</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" id="chats-tab" data-toggle="tab" href="#chats-section" role="tab" aria-controls="chats-section">CHATS</a>
          </li>
        </ul>
        <div class="tab-content" id="setting-content">
          <div class="tab-pane fade show active scroll-wrapper" id="todo-section" role="tabpanel" aria-labelledby="todo-section">
            <div class="add-items d-flex px-3 mb-0">
              <form class="form w-100">
                <div class="form-group d-flex">
                  <input type="text" class="form-control todo-list-input" placeholder="Add To-do">
                  <button type="submit" class="add btn btn-primary todo-list-add-btn" id="add-task">Add</button>
                </div>
              </form>
            </div>
            <div class="list-wrapper px-3">
              <ul class="d-flex flex-column-reverse todo-list">
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Team review meeting at 3.00 PM
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Prepare for presentation
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li>
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox">
                      Resolve all the low priority tickets due today
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Schedule meeting for next week
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
                <li class="completed">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="checkbox" type="checkbox" checked>
                      Project review
                    </label>
                  </div>
                  <i class="remove ti-close"></i>
                </li>
              </ul>
            </div>
            <h4 class="px-3 text-muted mt-5 font-weight-light mb-0">Events</h4>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary mr-2"></i>
                <span>Feb 11 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Creating component page build a js</p>
              <p class="text-gray mb-0">The total number of sessions</p>
            </div>
            <div class="events pt-4 px-3">
              <div class="wrapper d-flex mb-2">
                <i class="ti-control-record text-primary mr-2"></i>
                <span>Feb 7 2018</span>
              </div>
              <p class="mb-0 font-weight-thin text-gray">Meeting with Alisa</p>
              <p class="text-gray mb-0 ">Call Sarah Graves</p>
            </div>
          </div>
          <!-- To do section tab ends -->
          <div class="tab-pane fade" id="chats-section" role="tabpanel" aria-labelledby="chats-section">
            <div class="d-flex align-items-center justify-content-between border-bottom">
              <p class="settings-heading border-top-0 mb-3 pl-3 pt-0 border-bottom-0 pb-0">Friends</p>
              <small class="settings-heading border-top-0 mb-3 pt-0 border-bottom-0 pb-0 pr-3 font-weight-normal">See All</small>
            </div>
            <ul class="chat-list">
              <li class="list active">
                <div class="profile"><img src="../../images/faces/face1.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Thomas Douglas</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">19 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="../../images/faces/face2.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <div class="wrapper d-flex">
                    <p>Catherine</p>
                  </div>
                  <p>Away</p>
                </div>
                <div class="badge badge-success badge-pill my-auto mx-2">4</div>
                <small class="text-muted my-auto">23 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="../../images/faces/face3.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Daniel Russell</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">14 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="../../images/faces/face4.jpg" alt="image"><span class="offline"></span></div>
                <div class="info">
                  <p>James Richardson</p>
                  <p>Away</p>
                </div>
                <small class="text-muted my-auto">2 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="../../images/faces/face5.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Madeline Kennedy</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">5 min</small>
              </li>
              <li class="list">
                <div class="profile"><img src="../../images/faces/face6.jpg" alt="image"><span class="online"></span></div>
                <div class="info">
                  <p>Sarah Graves</p>
                  <p>Available</p>
                </div>
                <small class="text-muted my-auto">47 min</small>
              </li>
            </ul>
          </div>
          <!-- chat tab ends -->
        </div>
      </div>
      <!-- partial -->
      <!-- partial:../../partials/_sidebar.html -->
      <nav class="sidebar sidebar-offcanvas" id="sidebar">
        <ul class="nav">
          <li class="nav-item">
            <a class="nav-link" href="../../index.html">
              <i class="icon-grid menu-icon"></i>
              <span class="menu-title">Dashboard</span>
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false" aria-controls="form-elements">
              <i class="icon-columns menu-icon"></i>
              <span class="menu-title">Form elements</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="form-elements">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"><a class="nav-link" href="../../pages/forms/basic_elements.html">Basic Elements</a></li>
              </ul>
            </div>
          </li>

          <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
              <i class="icon-grid-2 menu-icon"></i>
              <span class="menu-title">Tables</span>
              <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
              <ul class="nav flex-column sub-menu">
                <li class="nav-item"> <a class="nav-link" href="../../pages/tables/basic-table.html">Basic table</a></li>
              </ul>
            </div>
          </li>


        </ul>
      </nav>
      <!-- partial -->
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
                                        
                                    <!-- Sisipkan input hidden untuk menyimpan plat kendaraan -->
                                    <div class="form-group">
                                        <input type="hidden" name="plat_kendaraan" value="<?php echo $plat_kendaraan_search; ?>">
                                        <div>
                                            <label for="plat_kendaraan">Plat Kendaraan:</label>
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
                                            <label for="tanggal_transaksi">Tanggal:</label>
                                            <input class="form-control" type="text" id="tanggal" name="tanggal" value="<?php echo $transaksi['tanggal']; ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div>
                                            <label for="status_cuci">Status Cuci:</label>
                                            <select class="form-control" name="status_cuci" id="status_cuci">
                                                <option value="dalam_antrian" <?php echo ($transaksi['status_cuci'] == 'dalam_antrian') ? 'selected' : ''; ?>>Dalam antrian</option>
                                                <option value="selesai" <?php echo ($transaksi['status_cuci'] == 'selesai') ? 'selected' : ''; ?>>Selesai</option>
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
                                    <!-- Tombol submit untuk menyimpan data -->
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

        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Copyright © 2021.  Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash. All rights reserved.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Hand-crafted & made with <i class="ti-heart text-danger ml-1"></i></span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->

  <script src="../../vendors/js/vendor.bundle.base.js"></script>

  <script src="../../vendors/typeahead.js/typeahead.bundle.min.js"></script>
  <script src="../../vendors/select2/select2.min.js"></script>

  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <script src="../../js/settings.js"></script>
  <script src="../../js/todolist.js"></script>

  <script src="../../js/file-upload.js"></script>
  <script src="../../js/typeahead.js"></script>
  <script src="../../js/select2.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
        var cancelButton = document.getElementById("cancel-btn");
        cancelButton.addEventListener("click", function(event) {
            event.preventDefault();
            var inputElements = document.querySelectorAll('input[type="text"], select');
            inputElements.forEach(function(input) {
                input.value = '';
            });
        });
    });
</script>


</body>
</html>
