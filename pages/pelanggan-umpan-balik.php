<?php 
session_start();

// cek cookie
if (isset($_COOKIE['ingat_saya'])) {
    $_SESSION['sudah_login_pelanggan'] = true;
  }
  
  // cek session
  if(isset($_SESSION['sudah_login_pelanggan'])) {
  } else {
    echo "<script>alert('Harap login terlebih dahulu!')</script>";
    echo "<script>window.location.href = '../index.php';</script>"; 
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
        <?php include '../partials/_sidebar-pelanggan.php'; ?>

      <!-- main content -->
        <div class="main-panel">        
            <div class="content-wrapper">
            <div class="row">
                <div class="col-md-8 grid-margin stretch-card mx-auto">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Umpan Balik</h4> <br>

                    <form class="forms-sample" method="POST" action="myForm">
                        <div class="form-group">
                        <label for="nama_pelanggan">Nama pelanggan</label>
                        <input type="text" class="form-control" name="nama_pelanggan" id="nama_pelanggan" placeholder="Nama Pelanggan">
                        </div>

                        <div class="form-group">
                        <label for="username_pelanggan">Username</label>
                        <input type="text" class="form-control" name="username_pelanggan" id="username_pelanggan" placeholder="Username">
                        </div>

                        <div class="form-group">
                        <label for="tanggal_keluhan">Tanggal</label>
                        <input type="date" class="form-control" name="tanggal_keluhan" id="tanggal_keluhan">
                        </div>

                        <div class="form-group">
                        <label for="umpan_balik">Umpan Balik</label>
                        <textarea class="form-control" name="umpan_balik" id="umpan_balik" rows="4"></textarea>
                        </div>
                        
                        <button type="submit" class="btn btn-primary mr-2">Kirim</button>
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


    <script>
        // function
        function greetUser(nama_pelanggan, username_pelanggan, tanggal_keluhan, umpan_balik) {
        var alertMessage = "Respon dari " + nama_pelanggan + " ( " + username_pelanggan + " )" + " pada tanggal " + tanggal_keluhan + " yang berisi " + umpan_balik + " berhasil dikirim!";
        alert(alertMessage);
        }

        // masukkan ke dalam local storage
        document.addEventListener("DOMContentLoaded", function() {
            var form = document.querySelector(".forms-sample");
            form.addEventListener("submit", function(event) {
                event.preventDefault();
                var nama_pelanggan = document.getElementById("nama_pelanggan").value;
                var username_pelanggan = document.getElementById("username_pelanggan").value;
                var tanggal_keluhan = document.getElementById("tanggal_keluhan").value;
                var umpan_balik = document.getElementById("umpan_balik").value;

                if (this.checkValidity() === false) {
                    event.stopPropagation();
                } else {
                    var feedback = {
                        "nama_pelanggan": nama_pelanggan,
                        "username_pelanggan": username_pelanggan,
                        "tanggal_keluhan": tanggal_keluhan,
                        "umpan_balik": umpan_balik
                    };

                    var feedbackJSON = JSON.stringify(feedback);
                    localStorage.setItem("feedback", feedbackJSON);
                    
                    document.getElementById("nama_pelanggan").value = '';
                    document.getElementById("username_pelanggan").value = '';
                    document.getElementById("tanggal_keluhan").value = '';
                    document.getElementById("umpan_balik").value = '';
                }

                greetUser(nama_pelanggan, username_pelanggan, tanggal_keluhan, umpan_balik);
                this.classList.add("was-validated");
            });
        });

    </script>
</body>
</html>
