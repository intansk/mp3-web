<?php

require './pages/koneksi.php';

// Ambil data dari form pendaftaran
if (isset($_POST['submit'])) {
    $nama_pelanggan = mysqli_real_escape_string($conn, $_POST['nama_pelanggan']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Query untuk memeriksa apakah username sudah terdaftar
    $check_username_query = "SELECT * FROM pelanggan WHERE username = '$username'";
    $check_username_result = mysqli_query($conn, $check_username_query);

    if (mysqli_num_rows($check_username_result) > 0) {
        // Jika username sudah terdaftar, tampilkan pesan kesalahan
        echo "<script>alert('Username sudah terdaftar')</script>";
    } else {
        // Jika username belum terdaftar, lakukan pendaftaran
        // Query untuk memasukkan data pelanggan baru ke dalam database dengan prepared statement
        $sql = "INSERT INTO pelanggan (nama_pelanggan, username, password) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (mysqli_stmt_prepare($stmt, $sql)) {
            mysqli_stmt_bind_param($stmt, "sss", $nama_pelanggan, $username, $password);
            mysqli_stmt_execute($stmt);

            echo "<script>alert('Data berhasil ditambah')</script>";
            header('Location: ./pages/pilih-role.php');
            exit;
        } else {
            echo "<script>alert('Gagal menambah data')</script>";
        }

        mysqli_stmt_close($stmt);
    }

    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Registrasi</title>

  <link rel="stylesheet" href="./vendors/feather/feather.css">
  <link rel="stylesheet" href="./vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="./vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="./css/vertical-layout-light/style.css">
  <link rel="shortcut icon" href="./images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="./images/logo.png" alt="logo">
              </div>
              <h4>Registrasi</h4>
              <h6 class="font-weight-light">Buat akun untuk menjadi bagian dari Kuma!</h6>

              <form class="pt-3" action="" method="POST">
                <div class="form-group">
                  <input required type="text" name="nama_pelanggan" class="form-control form-control-lg" id="nama_pelanggan" placeholder="Nama Pelanggan">
                </div>
                <div class="form-group">
                  <input required type="text" name="username" class="form-control form-control-lg" id="username" placeholder="Username">
                </div>
                <div class="form-group">
                  <input required type="password" name="password" class="form-control form-control-lg" id="password" placeholder="Password">
                </div>
                <div class="mb-4">
                  <div class="form-check">
                    <label class="form-check-label text-muted">
                      <input type="checkbox" class="form-check-input" required>
                      Saya menyetujui semua Syarat & Ketentuan
                    </label>
                  </div>
                </div>
                <!-- <div class="mt-3"> -->
                <button type="submit" name="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">Register Account</button>
                </div>
                <div class="text-center mt-4 font-weight-light">
                  Already have an account? <a href="./pages/pilih-role.php" class="text-primary">Login</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="./vendors/js/vendor.bundle.base.js"></script>
  <script src="./js/off-canvas.js"></script>
  <script src="./js/hoverable-collapse.js"></script>
  <script src="./js/template.js"></script>
  <script src="./js/settings.js"></script>
  <script src="./js/todolist.js"></script>
</body>
</html>