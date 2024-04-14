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
    <link rel="stylesheet" href="../vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="../vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" type="text/css" href="../js/select.dataTables.min.css">
    <link rel="stylesheet" href="../css/vertical-layout-light/style.css">
    <link rel="shortcut icon" href="../images/favicon.png" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@5.x/css/materialdesignicons.min.css">
</head>

<body>
    <!-- navbar -->
    <div class="container-scroller">
    <?php include '../partials/_navbar.php'; ?>


        <div class="container-fluid page-body-wrapper">
            <?php include '../partials/_sidebar-pelanggan.php'; ?>

            <!-- main content -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-md-12 grid-margin">
                            <div class="row">
                                <div class="col-12 col-xl-8 mb-4 mb-xl-0">
                                    <h3 class="font-weight-bold">Welcome to Kuma Car Spa!</h3>
                                </div>
                                <div class="col-12 col-xl-4">
                                    <div class="justify-content-end d-flex"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card tale-bg">
                                <div class="card-people mt-auto">
                                    <img src="../images/img car wash.jpg" alt="people">
                                    <div class="weather-info">
                                        <div class="d-flex">
                                            <div class="ml-2">
                                                <h4 class="location font-weight-normal">Kuma Car Spa</h4>
                                                <h2 class="mb-0 font-weight-normal"><i class="icon-sun mr-2"></i></h2>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 grid-margin transparent">
                            <div class="row">
                                <div class="col-md-6 mb-4 stretch-card transparent">
                                    <div class="card card-tale">
                                        <div class="card-body">
                                            <p class="mb-4">Total Antrian</p>
                                            <p class="fs-30 mb-2">24</p>
                                            <p>Hari ini</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-4 stretch-card transparent">
                                    <div class="card card-dark-blue">
                                        <div class="card-body">
                                            <p class="mb-4">Total Cucian</p>
                                            <p class="fs-30 mb-2">650</p>
                                            <p>30 hari</p>
                                            </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-4 mb-lg-0 stretch-card transparent">
                                    <div class="card card-light-blue">
                                        <div class="card-body">
                                            <p class="mb-4">Total Kendaraan</p>
                                            <p class="fs-30 mb-2">500</p>
                                            <p>Kendaraan</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 stretch-card transparent">
                                    <div class="card card-light-danger">
                                        <div class="card-body">
                                            <p class="mb-4">Total Pelanggan</p>
                                            <p class="fs-30 mb-2">600</p>
                                            <p>Pelanggan</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <!-- our review -->
                    <div class="row">
                        <div class="col-md-12 grid-margin stretch-card">
                            <div class="card position-relative">
                                <div class="card-body">
                                    <div id="detailedReports" class="carousel slide detailed-report-carousel position-static pt-2" data-ride="carousel">
                                        <div class="carousel-inner">

                                            <div class="carousel-item active">
                                                <div class="row">
                                                    <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                                                        <div class="ml-xl-4 mt-3">
                                                            <p class="card-title">Our Review!</p>
                                                            <h1 class="text-primary"> <i class="mdi mdi-star"></i> 4.8/5</h1>
                                                        </div>  
                                                    </div>
                                                    <div class="col-md-12 col-xl-9">
                                                        <div class="row">
                                                            <div class="col-md-6 border-right">
                                                                <div class="table-responsive mb-3 mb-md-0 mt-3">
                                                                    <table class="table table-borderless report-table">
                                                                        <tr>
                                                                            <ul class="icon-data-list">
                                                                                <li>
                                                                                    <div class="d-flex"><img src="../images/faces/face9.jpg" alt="user">
                                                                                        <div>
                                                                                            <p class="text-info mb-1">Ahmad</p>
                                                                                            <p class="mb-0">Pelayanan yang luar biasa! Kendaraan saya terlihat bersih dan segar setelah dicuci di sini. Sangat direkomendasikan!</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 mt-3">
                                                                <table class="table table-borderless report-table">
                                                                    <tr>
                                                                        <ul class="icon-data-list">
                                                                            <li>
                                                                                <div class="d-flex">
                                                                                    <img src="../images/faces/face2.jpg" alt="user">
                                                                                    <div>
                                                                                        <p class="text-info mb-1">Hana</p>
                                                                                        <p class="mb-0">Tempat yang nyaman dan bersih, dengan hasil cucian yang memuaskan. Tak heran mendapat rating tinggi</p>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </tr>
                                                                </table>
                                                                <div id="north-america-legend"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                        
                                            <div class="carousel-item">
                                                <div class="row">
                                                    <div class="col-md-12 col-xl-3 d-flex flex-column justify-content-start">
                                                        <div class="ml-xl-4 mt-3">
                                                            <p class="card-title">Our Review!</p>
                                                            <h1 class="text-primary"> <i class="mdi mdi-star"></i> 4.8/5</h1>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12 col-xl-9">
                                                        <div class="row">
                                                            <div class="col-md-6 border-right">
                                                                <div class="table-responsive mb-3 mb-md-0 mt-3">
                                                                    <table class="table table-borderless report-table">
                                                                        <tr>
                                                                            <ul class="icon-data-list">
                                                                                <li>
                                                                                    <div class="d-flex">
                                                                                        <img src="../images/faces/face3.jpg" alt="user">
                                                                                        <div>
                                                                                            <p class="text-info mb-1">Candra</p>
                                                                                            <p class="mb-0">Staf yang ramah dan profesional. Hasil cucian sangat memuaskan, tidak ada cela. Akan kembali lagi!</p>
                                                                                        </div>
                                                                                    </div>
                                                                                </li>
                                                                            </ul>
                                                                        </tr>
                                                                    </table>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-6 mt-3">
                                                                <table class="table table-borderless report-table">
                                                                    <tr>
                                                                        <ul class="icon-data-list">
                                                                            <li>
                                                                                <div class="d-flex">
                                                                                    <img src="../images/faces/face4.jpg" alt="user">
                                                                                    <div>
                                                                                        <p class="text-info mb-1">Lio</p>
                                                                                        <p class="mb-0">Tempat yang nyaman dan bersih, dengan hasil cucian yang memuaskan. Tak heran mendapat rating tinggi</p>
                                                                                    </div>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                    </tr>
                                                                </table>
                                                                <div id="north-america-legend"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <a class="carousel-control-prev" href="#detailedReports" role="button" data-slide="prev">
                                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Previous</span>
                                            </a>
                                            <a class="carousel-control-next" href="#detailedReports" role="button" data-slide="next">
                                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                <span class="sr-only">Next</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>  

                <!-- footer -->
                <?php include '../partials/_footer.php'; ?>
                </footer>  
            </div>
        </div>
    </div>

    <script src="../vendors/js/vendor.bundle.base.js"></script>
    <script src="../vendors/chart.js/Chart.min.js"></script>
    <script src="../vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="../vendors/datatables.net-bs4/dataTables.bootstrap4.js"></script>
    <script src="../js/dataTables.select.min.js"></script>
    <script src="../js/off-canvas.js"></script>
    <script src="../js/hoverable-collapse.js"></script>
    <script src="../js/template.js"></script>
    <script src="../js/settings.js"></script>
    <script src="../js/todolist.js"></script>
    <script src="../js/dashboard.js"></script>
    <script src="../js/Chart.roundedBarCharts.js"></script>

</body>
</html>