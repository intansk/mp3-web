<?php
$hostname = 'localhost';
$db_username = 'root';
$db_password = '';
$database = 'pencucian';

session_start();
$conn = mysqli_connect($hostname, $db_username, $db_password, $database);

// pengecekan conn
if (!$conn) {
  echo('Koneksi database gagal');
  exit;
}

if (isset($_POST['submit'])) {
  $username = $_POST['username_pegawai'];
  $password = $_POST['password_pegawai'];

  $sql = "SELECT * FROM pegawai WHERE username_pegawai = '$username' AND password_pegawai = '$password'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    $_SESSION['sudah_login'] = true;
    if (isset($_POST['rememberMe'])) {
      setcookie(
        'ingat_saya',
        'true',
        time() + (86400 * 1), // 1 hari
        '/'
      );
    }
    header('Location: ./register.php');

    exit;
  } else {
    echo "<script>alert('username atau password tidak tepat')</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login Pegawai</title>

  <link rel="stylesheet" href="../vendors/feather/feather.css">
  <link rel="stylesheet" href="../vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="../vendors/css/vendor.bundle.base.css">
  <link rel="stylesheet" href="../css/vertical-layout-light/style.css">
  <link rel="shortcut icon" href="../images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <img src="../images/logo.png" alt="logo">
              </div>
              <h4>Hello Kuma's Employees!</h4>
              <h6 class="font-weight-light">Login to continue.</h6>

              <form class="pt-3" action="login-pegawai.php" method="POST">
    <div class="form-group">
        <label for="username">Username</label>
        <input required type="text" name="username_pegawai" class="form-control form-control-lg" id="username" placeholder="Username" autocomplete="username">
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input required type="password" name="password_pegawai" class="form-control form-control-lg" id="password" placeholder="Password" autocomplete="current-password">
    </div>
    
    <div class="my-2 d-flex justify-content-between align-items-center">
        <div class="form-check">
            <label class="form-check-label text-muted" for="rememberMe">
                <input type="checkbox" class="form-check-input" value="true" name="rememberMe" id="rememberMe" autocomplete="on">
                Keep me signed in
            </label>
        </div>
    </div>
    <div class="">
        <button type="submit" name="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">LOGIN</button>
    </div>
</form>

            </div>
          </div>
        </div>
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
