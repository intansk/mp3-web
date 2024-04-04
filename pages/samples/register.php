<?php

$hostname = 'localhost';
$db_username = 'root';
$db_password = '';
$database = 'pencucian';

$conn = mysqli_connect($hostname, $db_username, $db_password, $database);

// pengecekan koneksi
if (!$conn) {
    echo 'koneksi database gagal';
    exit;
}

// Ambil data dari form pendaftaran
if (isset($_POST['submit'])) {
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $username = $_POST['username'];
    $password = $_POST['password'];

    // // Lakukan sanitasi input untuk mencegah SQL Injection
    // $name = mysqli_real_escape_string($conn, $name);
    // $username = mysqli_real_escape_string($conn, $username);
    // $password = mysqli_real_escape_string($conn, $password);

    // // Hash password sebelum disimpan ke database (disarankan)
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Query untuk memasukkan data pelanggan baru ke dalam database
    $sql = "INSERT INTO pelanggan (nama_pelanggan, username, password) VALUES ('$nama_pelanggan', '$username', '$password')";
    $result = mysqli_query($conn, $sql);

    if ($result) { // == true
        echo "<script>alert('Data berhasil ditambah')</script>";
        header('Location: ../../index.html');
      } else {
        // echo "<script>alert('Gagal menambah data')</script>";
        // echo "<script>window.location.reload()</script>";
      }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Registrasi</title>

  <link rel="stylesheet" href="../../vendors/feather/feather.css">
  <link rel="stylesheet" href="../../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../../vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../../css/vertical-layout-light/style.css">
  <link rel="shortcut icon" href="../../images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="../../images/logo.svg" alt="logo">
              </div>
              <h4>Registrasi</h4>
              <h6 class="font-weight-light">Register is easy. It only takes a few steps</h6>

              <form class="pt-3" action="register.php" method="POST">
                <div class="form-group">
                  <input type="text" name="nama_pelanggan" class="form-control form-control-lg" id="nama_pelanggan" placeholder="Nama Pelanggan">
                </div>
                <div class="form-group">
                  <input type="text" name="username" class="form-control form-control-lg" id="username" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="mb-4">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input">
                      I agree to all Terms & Conditions
                    </label>
                  </div>
                </div>
                <!-- <div class="mt-3"> -->
                <button type="submit" name="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Register Account</button>
                  <!-- <a class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" href="../../index.html">SIGN UP</a> -->
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Already have an account? <a href="login.html" class="text-primary">Login</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="../../vendors/js/vendor.bundle.base.js"></script>
  <script src="../../js/off-canvas.js"></script>
  <script src="../../js/hoverable-collapse.js"></script>
  <script src="../../js/template.js"></script>
  <script src="../../js/settings.js"></script>
  <script src="../../js/todolist.js"></script>
</body>
</html>
