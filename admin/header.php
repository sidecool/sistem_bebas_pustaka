<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page; ?></title>
    
    <link rel="shortcut icon" href="<?php echo $baseurl; ?>/admin/assets/img/icon/favicon.ico">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo $baseurl; ?>/admin/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo $baseurl; ?>/admin/assets/css/datePicker/bootstrap-datepicker3.min.css">
    <link rel="stylesheet" href="<?php echo $baseurl; ?>/admin/assets/css/styles_admin.css">
    <link rel="stylesheet" href="<?php echo $baseurl; ?>/admin/assets/css/table_admin.css">
    <link rel="stylesheet" href="<?php echo $baseurl; ?>/admin/assets/css/dataTables/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo $baseurl; ?>/admin/assets/css/dataTables/fixedHeader.bootstrap4.min.css">
    <link rel="stylesheet" href="<?php echo $baseurl; ?>/admin/assets/css/dataTables/buttons.dataTables.min.css">
    <link rel="stylesheet" href="<?php echo $baseurl; ?>/admin/assets/css/toastr.css">
    <link rel="stylesheet" href="<?php echo $baseurl; ?>/admin/assets/css/toastr.min.css">

    <script src="<?php echo $baseurl; ?>/assets/js/jquery.min.js"></script>
    <script src="<?php echo $baseurl; ?>/admin/assets/js/toastr.min.js"></script>
    <script src="<?php echo $baseurl; ?>/admin/assets/js/dataTables/jquery.dataTables.min.js"></script>
    <script src="<?php echo $baseurl; ?>/admin/assets/js/datePicker/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo $baseurl; ?>/admin/assets/js/datePicker/bootstrap-datepicker.id.min.js"></script>
     
    <style> /* Logo Header */
        .logo-img {
            overflow: hidden;
        }
        .logo-img a {
            background-image: url(../assets/img/logo_header.png);
            background-size: contain;
            background-repeat: no-repeat;
            background-position: left top;
            width: 270px;
            height: 43px;
            padding: 0;
            margin-left: auto;
            margin-right: auto;
        }

        .logo-img a:hover,
        .logo-img a:active,
        .logo-img a:focus {
            background-position: left bottom;
        }

        .logo-img span {
            display: none;
        }                
    </style>
</head>
<body class="sb-nav-fixed">
    <!-- Top Navigation -->
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">        
        <div class="logo-img">
            <a href="<?php echo $baseurl;?>/admin" class="navbar-brand"><span>Universitas Musamus Merauke</span></a>
        </div>        
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href=""><i class="fas fa-bars"></i></button>
        <!-- Navbar Search (Optional) -->
        <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0"></div>
        <!-- Navbar -->        
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown">
                <a href="#!" class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a href="#!" class="dropdown-item">Info Profil</a>
                <a href="form_password" class="dropdown-item">Ganti Password</a>
                <div class="dropdown-divider"></div>
                <a href="<?php echo $baseurl; ?>/admin/logout.php" class="dropdown-item">Logout</a>
            </div>  
            </li>            
        </ul>
    </nav>
    <!-- End Top Navigation -->
    
    <div id="layoutSidenav">
        <!-- Side Navigation -->
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav" id="nav">                        
                        <div class="sb-sidenav-menu-heading">Dashboard</div>
                        <!-- Single Menu -->
                        <a href="<?php echo $baseurl;?>/admin" class="nav-link">
                                <div class="sb-nav-link-icon"><i class="fas fa-desktop"></i> Dashboard</div>
                        </a>
                        
                        <?php 
                            if(isset($_SESSION['hak_akses'])){
                                if($_SESSION['hak_akses'] == "ADMIN"){
                                    ?>
                                        <div class="sb-sidenav-menu-heading">Menu Admin</div>
                                        <!-- Double Menu -->
                                        <a href="" class="nav-link collapsed" data-toggle="collapse" data-target="#collapseMasters " aria-expanded="false" aria-controls="collapseLayouts">
                                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div> Master Data 
                                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                        </a>
                                        <div class="collapse" id="collapseMasters" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                            <nav class="sb-sidenav-menu-nested nav">
                                                <a href="<?php echo $baseurl; ?>/admin/form_dokumen_upload/" class="nav-link <?php if($page == 'Master Data Syarat Dokumen Upload') echo active; ?>"> Master Data Syarat Dokumen Upload</a>
                                                <a href="<?php echo $baseurl; ?>/admin/form_fakultas/" class="nav-link <?php if($page == 'Master Data Fakultas') echo active; ?>"> Master Data Fakultas</a>
                                                <a href="<?php echo $baseurl; ?>/admin/form_jurusan/" class="nav-link <?php if($page == 'Master Data Jurusan') echo active; ?>"> Master Data Jurusan</a>
                                                <a href="<?php echo $baseurl; ?>/admin/form_petugas/" class="nav-link <?php if($page == 'Master Data Petugas') echo active; ?>"> Master Data Petugas</a>
                                                <a href="<?php echo $baseurl; ?>/admin/form_mahasiswa/" class="nav-link <?php if($page == 'Master Data Mahasiswa') echo active; ?>"> Master Data Mahasiswa</a>
                                            </nav>
                                        </div>
                                    <?php ;
                                }
                            }
                        ?>                        
                        
                        <a href="" class="nav-link collapsed" data-toggle="collapse" data-target="#collapseVerif " aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div> Upload dan Verifikasi 
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>                
                        <div class="collapse" id="collapseVerif" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a href="<?php echo $baseurl; ?>/admin/form_bebas_pustaka/" class="nav-link <?php if($page == 'Pengajuan Bebas Pustaka') echo active; ?>"> Pengajuan Bebas Pustaka</a>
                            </nav>
                        </div>

                        <a href="<?php echo $baseurl; ?>/admin/form_pengumuman/" class="nav-link <?php if($page == 'Pengumuman') echo active; ?>" aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div> Pengumuman                                                          
                        </a>

                        <!-- <a href="" class="nav-link collapsed" data-toggle="collapse" data-target="#collapseInfo " aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div> Informasi 
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a> -->
                        <!-- <div class="collapse" id="collapseInfo" aria-labelledby="headingThree" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a href="#!" class="nav-link"> Pengumuman</a>                                
                            </nav>
                        </div> -->

                        <a href="" class="nav-link collapsed" data-toggle="collapse" data-target="#collapseLaporan " aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div> Laporan 
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseLaporan" aria-labelledby="headingFour" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a href="<?php echo $baseurl; ?>/admin/form_laporan/lap_bulanan.php" class="nav-link" <?php if($page == 'Laporan Bulanan') echo active; ?>"> Laporan Bulanan</a>
                                <a href="<?php echo $baseurl; ?>/admin/form_laporan/lap_tahunan.php" class="nav-link" <?php if($page == 'Laporan Tahunan') echo active; ?>"> Laporan Tahunan</a>
                            </nav>
                        </div>

                        <!-- Triple Menu  (Optional)-->
                        <!-- <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                            <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                            Induk Menu
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                    Anak Menu 1
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-parent="#sidenavAccordionPages">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link" href="#!">Cucu Menu 2</a>
                                        <a class="nav-link" href="#!">Cucu Menu 1</a>
                                        <a class="nav-link" href="#!">Cucu Menu 3</a>
                                    </nav>
                                </div>                                
                            </nav>
                        </div> -->
                    </div>
                </div>

                <!-- Footer Side Navigation -->
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?php echo $_SESSION['nama']; ?>
                </div>
            </nav>
        </div>    

        <!-- Content -->
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid">
                    <h1 class="mt-4"><?php echo $page; ?></h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><?php echo $page; ?></li>
                    </ol>    