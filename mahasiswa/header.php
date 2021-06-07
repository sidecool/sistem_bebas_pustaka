<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $page; ?></title>
    
    <link rel="shortcut icon" href="<?php echo $baseurl; ?>/mahasiswa/assets/img/icon/favicon.ico">
    <!-- Custom CSS -->    
    <link rel="stylesheet" href="<?php echo $baseurl; ?>/mahasiswa/assets/css/styles_mhs.css">
    <link rel="stylesheet" href="<?php echo $baseurl; ?>/mahasiswa/assets/css/toastr.css">
    <link rel="stylesheet" href="<?php echo $baseurl; ?>/mahasiswa/assets/css/toastr.min.css">
    
    <script src="<?php echo $baseurl; ?>/assets/js/jquery.min.js"></script>
    <script src="<?php echo $baseurl; ?>/mahasiswa/assets/js/toastr.min.js"></script>
    <script src="<?php echo $baseurl; ?>/mahasiswa/assets/js/bootstrap-show-password.min.js"></script>
    <script src="<?php echo $baseurl; ?>/mahasiswa/assets/js/FontAwesome/all.min.js"></script>  
         
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
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-mhs">
        <div class="logo-img">
        <a href="<?php echo $baseurl;?>/mahasiswa" class="navbar-brand"><span>Universitas Musamus Merauke</span></a>
        </div>
        <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
        <!-- Navbar Search (Optional) -->
        <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0"></div>
        <!-- Navbar -->        
        <ul class="navbar-nav ml-auto ml-md-0">
            <li class="nav-item dropdown">
                <a href="#!" class="nav-link dropdown-toggle" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>

                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a href="<?php echo $baseurl; ?>/mahasiswa/profil/" class="dropdown-item">Info Profil</a>
                <a href="<?php echo $baseurl; ?>/mahasiswa/ganti_paswd/" class="dropdown-item">Ganti Password</a>
                <div class="dropdown-divider"></div>
                <a href="<?php echo $baseurl; ?>/logout.php" class="dropdown-item">Logout</a>
            </div>  
            </li>            
        </ul>
    </nav>
    <!-- End Top Navigation -->
    
    <div id="layoutSidenav">
        <!-- Side Navigation -->
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-light" id="sidenavAccordion">
                <div class="sb-sidenav-menu">
                    <div class="nav" id="nav">                        
                        <div class="sb-sidenav-menu-heading">Dashboard</div>
                        <!-- Single Menu -->
                        <a href="<?php echo $baseurl;?>/mahasiswa" class="nav-link">
                                <div class="sb-nav-link-icon"><i class="fas fa-desktop"></i> Dashboard</div>
                        </a>
                        
                        <div class="sb-sidenav-menu-heading">Menu User</div>
                        <!-- Double Menu -->
                        <a href="" class="nav-link collapsed" data-toggle="collapse" data-target="#collapseMasters " aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div> Profil 
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseMasters" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a href="<?php echo $baseurl; ?>/mahasiswa/profil/" class="nav-link <?php if($page == 'Profil Mahasiswa') echo active; ?>"> Profil Mahasiswa</a>
                                <a href="<?php echo $baseurl; ?>/mahasiswa/ganti_paswd/" class="nav-link <?php if($page == 'Ganti Password') echo active; ?>"> Ganti Password</a>
                            </nav>
                        </div>
                        
                        <a href="" class="nav-link collapsed" data-toggle="collapse" data-target="#collapseVerif " aria-expanded="false" aria-controls="collapseLayouts">
                            <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div> Upload 
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="collapseVerif" aria-labelledby="headingTwo" data-parent="#sidenavAccordion">
                            <nav class="sb-sidenav-menu-nested nav">                                
                                <a href="<?php echo $baseurl; ?>/mahasiswa/form_bebas_pustaka/" class="nav-link <?php if($page == 'Pengajuan Bebas Pustaka') echo active; ?>"> Pengajuan Bebas Pustaka</a>
                            </nav>
                        </div>                        
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