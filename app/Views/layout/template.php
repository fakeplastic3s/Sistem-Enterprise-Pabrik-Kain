<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title><?= $title; ?></title>
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- remix icon -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <!-- Favicons -->
    <link href="<?= base_url(); ?>/assets/img/favicon.png" rel="icon">
    <link href="<?= base_url(); ?>/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="<?= base_url(); ?>/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="<?= base_url(); ?>/assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="<?= base_url(); ?>/assets/css/style.css" rel="stylesheet">

    <!-- unicon -->
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <!-- =======================================================
  * Template Name: NiceAdmin - v2.4.1
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

</head>

<style>
    @media print {
        @page {
            margin-top: 30px;
            margin: 10px;
        }

        .btn,
        #header,
        #sidebar,
        footer,
        header,
        aside,
        .fixed-top,
        form,
        .breadcrumb,
        .aksi,
        .alert,
        h1,
        a {
            display: none;
            visibility: hidden;
        }
    }
</style>


<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">

        <div class="d-flex align-items-center justify-content-between">
            <a href="<?= base_url('Dashboard'); ?>" class="logo d-flex align-items-center">
                <img src="<?= base_url(); ?>/assets/img/ajiwijayatex.png" alt="" class="mx-4">
                <span class="d-none d-lg-block" id=""></span>
            </a>
            <i class="bi bi-list toggle-sidebar-btn"></i>
        </div><!-- End Logo -->

        <!-- End Icons Navigation -->
        <nav class="header-nav ms-auto">
            <ul class="d-flex align-items-center">


                <li class="nav-item dropdown pe-4">

                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
                        <!-- <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle"> -->
                        <i class="bi bi-person"></i>
                        <span class="d-none d-md-block dropdown-toggle ps-2"><?= session()->get('user_name'); ?> </span>
                    </a><!-- End Profile Iamge Icon -->

                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                        <li class="dropdown-header">
                            <h6><?= session()->get('user_name'); ?></h6>
                            <span><?= session()->get('user_email'); ?></span>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?= base_url('/Dashboard/profil'); ?>">
                                <i class="bi bi-person"></i>
                                <span>My Profile</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>

                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?= base_url('Ganti_Akun'); ?>">
                                <i class="bi bi-box-arrow-in-left"></i>
                                <span>Change Account</span>
                            </a>
                        </li>
                        <li>
                            <hr class="dropdown-divider">
                        </li>
                        <li>
                            <a class="dropdown-item d-flex align-items-center" href="<?= base_url('/login/logout'); ?>">
                                <i class="bi bi-box-arrow-right"></i>
                                <span>Logout</span>
                            </a>
                        </li>

                    </ul><!-- End Profile Dropdown Items -->
                </li><!-- End Profile Nav -->

            </ul>
        </nav><!-- End Icons Navigation -->

    </header><!-- End Header -->

    <!-- ======= Sidebar ======= -->


    <aside id="sidebar" class="sidebar">

        <ul class="sidebar-nav" id="sidebar-nav">
            <?php if (session()->get('user_name') == 'Admin' or session()->get('user_name') == 'Admin Mesin' or session()->get('user_name') == 'Admin Pengiriman') { ?>
                <li class="nav-item ">

                    <a class="nav-link collapsed" href="<?= base_url('Dashboard'); ?>">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li><!-- End Dashboard Nav -->
            <?php } ?>
            <!-- Dashboard Supplier -->
            <?php if (session()->get('user_name') == 'Admin Supplier') { ?>
                <li class="nav-item ">

                    <a class="nav-link collapsed" href="<?= base_url('Dashboard/indexSupplier'); ?>">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li><!-- End Dashboard Supplier Nav -->
            <?php } ?>
            <!-- Dashboard Gudang -->
            <?php if (session()->get('user_name') == 'Admin Gudang') { ?>
                <li class="nav-item ">

                    <a class="nav-link collapsed" href="<?= base_url('Dashboard/indexGudang'); ?>">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li><!-- End Dashboard Gudang Nav -->
            <?php } ?>
            <!-- Dashboard Produksi -->
            <?php if (session()->get('user_name') == 'Admin Produksi') { ?>
                <li class="nav-item ">

                    <a class="nav-link collapsed" href="<?= base_url('Dashboard/indexProduksi'); ?>">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li><!-- End Dashboard Produksi Nav -->
            <?php } ?>
            <!-- Dashboard Keuangan -->
            <?php if (session()->get('user_name') == 'Admin Keuangan') { ?>
                <li class="nav-item ">

                    <a class="nav-link collapsed" href="<?= base_url('Dashboard/indexKeuangan'); ?>">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li><!-- End Dashboard Keuangan Nav -->
            <?php } ?>
            <!-- Dashboard Pemasaran -->
            <?php if (session()->get('user_name') == 'Admin Pemasaran') { ?>
                <li class="nav-item ">

                    <a class="nav-link collapsed" href="<?= base_url('Dashboard/indexPemasaran'); ?>">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li><!-- End Dashboard Keuangan Nav -->
            <?php } ?>

            <!-- Supplier Akses Pemilik -->
            <?php if (session()->get('user_name') == 'Admin') { ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#supplier-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-box-seam"></i><span>Supplier</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="supplier-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="<?= base_url('Supplier'); ?>">
                                <i class="bi bi-circle-fill"></i><span>Daftar Supplier</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('PengadaanBahan'); ?>">
                                <i class="bi bi-circle-fill"></i><span>Pengadaan Bahan</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End supplier Nav -->
            <?php } ?>

            <!-- Admin Supplier -->
            <?php if (session()->get('user_name') == 'Admin Supplier') { ?>
                <li class="nav-item ">
                    <a class="nav-link collapsed" href="<?= base_url('Supplier'); ?>">
                        <i class="bi bi-box-seam"></i>
                        <span>Daftar Supplier</span>
                    </a>
                </li><!-- End Data Supplier Nav -->

                <li class="nav-item ">
                    <a class="nav-link collapsed" href="<?= base_url('PengadaanBahan'); ?>">
                        <i class="bi bi-layout-text-sidebar-reverse"></i>
                        <span>Pengadaan Bahan</span>
                    </a>
                </li><!-- End Data Supplier Nav -->

            <?php } ?>

            <!-- Gudang Akses Pemilik -->
            <?php if (session()->get('user_name') == 'Admin') { ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#inventory-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-archive"></i><span>Inventory</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="inventory-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="<?= base_url('BahanMentah'); ?>">
                                <i class="bi bi-circle-fill"></i><span>Bahan Mentah</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('BahanMasuk'); ?>">
                                <i class="bi bi-circle-fill"></i><span>Bahan Masuk</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('BahanTerpakai'); ?>">
                                <i class="bi bi-circle-fill"></i><span>Bahan Terpakai</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('StokBarangJadi'); ?>">
                                <i class="bi bi-circle-fill"></i><span>Stok Barang Jadi</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Inventory Nav -->

            <?php } ?>
            <!-- End -->

            <!-- Admin Gudang -->
            <?php if (session()->get('user_name') == 'Admin Gudang') { ?>

                <li class="nav-item ">

                    <a class="nav-link collapsed" href="<?= base_url('BahanMentah'); ?>">
                        <i class="bi bi-minecart-loaded"></i>
                        <span>Bahan Mentah</span>
                    </a>
                </li><!-- End Bahan Mentah Nav -->
                <li class="nav-item ">

                    <a class="nav-link collapsed" href="<?= base_url('BahanMasuk'); ?>">
                        <i class="bi bi-save"></i>
                        <span>Bahan Masuk</span>
                    </a>
                </li><!-- End Bahan Masuk Nav -->
                <li class="nav-item ">

                    <a class="nav-link collapsed" href="<?= base_url('BahanTerpakai'); ?>">
                        <i class="bi bi-scissors"></i>
                        <span>Bahan Terpakai</span>
                    </a>
                </li><!-- End Bahan Terpakai Nav -->
                <li class="nav-item ">

                    <a class="nav-link collapsed" href="<?= base_url('StokBarangJadi'); ?>">
                        <i class="bi bi-stack"></i>
                        <span>Stok Barang Jadi</span>
                    </a>
                </li><!-- End Bahan Jadi Nav -->

            <?php } ?>
            <!-- end -->

            <!-- Produksi Akses Pemilik -->
            <?php if (session()->get('user_name') == 'Admin') { ?>

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#produksi-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-building"></i><span>Production</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="produksi-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="<?= base_url('JadwalProduksi'); ?>">
                                <i class="bi bi-circle-fill"></i><span>Jadwal Produksi</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('HasilProduksi'); ?>">
                                <i class="bi bi-circle-fill"></i><span>Hasil Produksi</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('KebutuhanProduksi'); ?>">
                                <i class="bi bi-circle-fill"></i><span>Kebutuhan Produksi</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Produksi Nav -->
            <?php } ?>
            <!-- end -->


            <!-- Admin Produksi -->
            <?php if (session()->get('user_name') == 'Admin Produksi') { ?>
                <li class="nav-item ">
                    <a class="nav-link collapsed" href="<?= base_url('KebutuhanProduksi'); ?>">
                        <i class="bi bi-basket"></i>
                        <span>Kebutuhan Produksi</span>
                    </a>
                </li><!-- End Kebutuhan Produksi Nav -->
                <li class="nav-item ">
                    <a class="nav-link collapsed" href="<?= base_url('JadwalProduksi'); ?>">
                        <i class="bi bi-calendar-event"></i>
                        <span>Jadwal Produksi</span>
                    </a>
                </li><!-- End Jadwal Produksi Nav -->
                <li class="nav-item ">
                    <a class="nav-link collapsed" href="<?= base_url('HasilProduksi'); ?>">
                        <i class="bi bi-stack"></i>
                        <span>Hasil Produksi</span>
                    </a>
                </li><!-- End Hasil Produksi Nav -->
            <?php } ?>

            <?php if (session()->get('user_name') == 'Admin Mesin' or session()->get('user_name') == 'Admin') { ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#engineering-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-gear"></i><span>Engineering</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="engineering-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="<?= base_url('AsetMesin'); ?>">
                                <i class="bi bi-circle-fill"></i><span>Aset Mesin</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('KebutuhanPerawatan'); ?>">
                                <i class="bi bi-circle-fill"></i><span>Kebutuhan Perawatan</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('JadwalPerawatan'); ?>">
                                <i class="bi bi-circle-fill"></i><span>Jadwal Perawatan</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Mesin Nav -->
            <?php } ?>

            <!-- Finance Akses Pemilik -->
            <?php if (session()->get('user_name') == 'Admin') { ?>
                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#Finance-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-cash-coin"></i><span>Finance</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="Finance-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="<?= base_url('AnggaranPengadaanBahan'); ?>">
                                <i class="bi bi-circle-fill"></i><span>Anggaran Pengadaan Bahan</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('AnggaranKebutuhanPerawatan'); ?>">
                                <i class="bi bi-circle-fill"></i><span>Anggaran Perawatan</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Keuangan Nav -->
            <?php } ?>
            <!-- Akses Admin Keuangan -->
            <?php if (session()->get('user_name') == 'Admin Keuangan') { ?>
                <li class="nav-item ">
                    <a class="nav-link collapsed" href="<?= base_url('AnggaranPengadaanBahan'); ?>">
                        <i class="bi bi-cart"></i>
                        <span>Pengadaan Bahan</span>
                    </a>
                </li><!-- End Anggaran pengadaan Bahan Nav -->
                <li class="nav-item ">
                    <a class="nav-link collapsed" href="<?= base_url('AnggaranKebutuhanPerawatan'); ?>">
                        <i class="bi bi-gear"></i>
                        <span>Perawatan Mesin</span>
                    </a>
                </li><!-- End Absen Nav -->

            <?php } ?>

            <!-- HR Akses Pemilik -->
            <?php if (session()->get('user_name') == 'Admin') { ?>

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#hr-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-people"></i><span>Human Resources</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="hr-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="<?= base_url('Pegawai'); ?>">
                                <i class="bi bi-circle-fill"></i><span>Pegawai</span>
                            </a>
                        </li>
                    </ul>
                    <ul id="hr-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="<?= base_url('Penggajian'); ?>">
                                <i class="bi bi-circle-fill"></i><span>Penggajian</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End HR Nav -->
            <?php } ?>

            <!-- Admin HR -->
            <?php if (session()->get('user_name') == 'Admin Personalia') { ?>
                <li class="nav-item ">
                    <a class="nav-link collapsed" href="<?= base_url('Pegawai'); ?>">
                        <i class="bi bi-people"></i>
                        <span>Pegawai</span>
                    </a>
                </li><!-- End Pegawai Nav -->
                <li class="nav-item ">
                    <a class="nav-link collapsed" href="<?= base_url('Absensi'); ?>">
                        <i class="bi bi-person-check"></i>
                        <span>Presensi</span>
                    </a>
                </li><!-- End Absen Nav -->
                <li class="nav-item ">
                    <a class="nav-link collapsed" href="<?= base_url('Penggajian'); ?>">
                        <i class="bi bi-cash-stack"></i>
                        <span>Penggajian</span>
                    </a>
                </li><!-- End Penggajian Nav -->
            <?php } ?>

            <?php if (session()->get('user_name') == 'Admin Pengiriman' or session()->get('user_name') == 'Admin') { ?>

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#delivery-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-truck"></i><span>Delivery</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="delivery-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="<?= base_url('JadwalPengiriman'); ?>">
                                <i class="bi bi-circle-fill"></i><span>Jadwal Pengiriman</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('Armada'); ?>">
                                <i class="bi bi-circle-fill"></i><span>Armada</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Delivery Nav -->
            <?php } ?>

            <?php if (session()->get('user_name') == 'Admin') { ?>

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#sales-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-bar-chart-line"></i><span>Sales Marketing</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="sales-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="<?= base_url('SalesMarketing'); ?>">
                                <i class="bi bi-circle-fill"></i><span>Sales Marketing</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?= base_url('Penjualan'); ?>">
                                <i class="bi bi-circle-fill"></i><span>Penjualan</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Marketing Nav -->
            <?php } ?>

            <!-- Akses Admin Pemasaran -->
            <?php if (session()->get('user_name') == 'Admin Pemasaran') { ?>
                <li class="nav-item ">
                    <a class="nav-link collapsed" href="<?= base_url('SalesMarketing'); ?>">
                        <i class="bi bi-people"></i>
                        <span>Sales Marketing</span>
                    </a>
                </li><!-- End Anggaran pengadaan Bahan Nav -->
                <li class="nav-item ">
                    <a class="nav-link collapsed" href="<?= base_url('Penjualan'); ?>">
                        <i class="bi bi-cash-stack"></i>
                        <span>Penjualan</span>
                    </a>
                </li><!-- End Absen Nav -->

            <?php } ?>

            <?php if (session()->get('user_name') == 'Admin Customer Support') { ?>

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#cs-nav" data-bs-toggle="collapse" href="#">
                        <i class="bi bi-layout-text-window-reverse"></i><span>Customer Support</span><i class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="cs-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="<?= base_url('Pemesanan'); ?>">
                                <i class="bi bi-circle-fill"></i><span>Pemesanan</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End CS Nav -->
            <?php } ?>


            <?php if (session()->get('user_name') == 'Admin Produksi' or session()->get('user_name') == 'Admin' or session()->get('user_name') == 'Admin Pemasaran' or session()->get('user_name') == 'Admin Supplier') { ?>
                <li class="nav-heading">Report</li>
            <?php } ?>

            <?php if (session()->get('user_name') == 'Admin Produksi' or session()->get('user_name') == 'Admin' or session()->get('user_name') == 'Admin Supplier') { ?>
                <li class="nav-item ">
                    <a class="nav-link collapsed" href="<?= base_url('Laporan/bahanmentah'); ?>">
                        <i class="bi bi-journal-text"></i>
                        <span>Laporan Bahan Mentah</span>
                    </a>
                </li> <!--end-->
            <?php } ?>

            <?php if (session()->get('user_name') == 'Admin Produksi' or session()->get('user_name') == 'Admin' or session()->get('user_name') == 'Admin Pemasaran') { ?>
                <li class="nav-item ">
                    <a class="nav-link collapsed" href="<?= base_url('Laporan/barangjadi'); ?>">
                        <i class="bi bi-journal-text"></i>
                        <span>Laporan Barang jadi</span>
                    </a>
                </li> <!--end-->
            <?php } ?>

            <?php if (session()->get('user_name') == 'Admin Pemasaran' or session()->get('user_name') == 'Admin') { ?>
                <li class="nav-item ">
                    <a class="nav-link collapsed" href="<?= base_url('Laporan/index'); ?>">
                        <i class="bi bi-journal-text"></i>
                        <span>Laporan Penjualan</span>
                    </a>
                </li> <!--end-->
            <?php } ?>


            <li class="nav-heading">Pages</li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="<?= base_url('Dashboard/profil'); ?>">
                    <i class="bi bi-person"></i>
                    <span> Profile </span>
                </a>
            </li>
            <!-- End Profile Page Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" href="<?= base_url('Ganti_Akun'); ?>">
                    <i class="bi bi-box-arrow-in-left"></i>
                    <span>Change Account</span>
                </a>
            </li><!-- End Login Page Nav -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="<?= base_url('login/logout'); ?>">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>Logout</span>
                </a>
            </li><!-- End Logout Page Nav -->

        </ul>

    </aside><!-- End Sidebar-->
    <div class="content-wrapper">
        <main id="main" class="main">
            <div class="pagetitle">
                <h1><?= $title; ?></h1>
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Home</a></li>
                        <li class="breadcrumb-item active"><?= $title; ?></li>
                    </ol>
                </nav>
            </div><!-- End Page Title -->

            <?= $this->renderSection('content'); ?>
            <!-- content -->

        </main>
    </div>
    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
        <div class="copyright">
            &copy; Copyright <strong><span>fsolo</span></strong>. All Rights Reserved
        </div>
        <div class="credits">
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="<?= base_url(); ?>/assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/chart.js/chart.min.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/echarts/echarts.min.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/quill/quill.min.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="<?= base_url(); ?>/assets/vendor/php-email-form/validate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.12/dist/sweetalert2.all.min.js"></script>


    <!-- Template Main JS File -->
    <script src="<?= base_url(); ?>/assets/js/main.js"></script>
    <script src="<?= base_url(); ?>/assets/js/myscript.js"></script>
    <script>
        // let myDiv = document.getElementById('notif');
        // setTimeout(function() {
        //     myDiv.remove();
        // }, 500);




        $(document).ready(function() {
            // Setelah 5 detik, panggil fungsi untuk menghapus div
            setTimeout(function() {
                $(".alert").fadeTo(500, 0, function() {
                    $(this).slideUp(500, function() {
                        $(this).remove();
                    });
                });
            }, 3000);
        });

        // let myDiv = $('#notif');
        // myDiv.fadeTo(500, 0, function() {
        //     myDiv.slideUp(500, function() {
        //         myDiv.remove();
        //     }, 500);
        // });

        // Fungsi untuk memperbarui waktu pada elemen dengan ID "clock"
    </script>


</body>

</html>