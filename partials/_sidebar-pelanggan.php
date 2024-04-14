<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="../pages/homepage-pelanggan.php">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#tables-layanan" aria-expanded="false" aria-controls="tables-layanan">
                <i class="mdi mdi-database menu-icon"></i>
                <span class="menu-title">Layanan</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables-layanan">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"><a class="nav-link" href="../pages/pelanggan-layanan.php">Layanan cuci</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                <i class="mdi mdi-table menu-icon"></i>
                <span class="menu-title">Lihat data</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="../pages/pelanggan-lihat-cucian.php">Antrian</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#contact" aria-expanded="false" aria-controls="contact" target="_blank">
                <i class="mdi mdi-email-open menu-icon"></i>
                <span class="menu-title">Hubungi Kami</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="contact">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="../pages/pelanggan-umpan-balik.php">Umpan balik</a></li>
                </ul>
            </div>
        </li>
    </ul>
</nav>