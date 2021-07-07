<?php 
// Abaikan Error Browser
error_reporting(0);
session_start();

include '../config/route.php';
include $baseurl.'/config/database.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun Baru</title>

    <link rel="shortcut icon" href="<?php echo $baseurl; ?>/assets/img/icon/favicon.ico" >
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo $baseurl; ?>/assets/css/styles.css" >
    <style>
        .header {
            background: linear-gradient(to right, #000046, #1cb5e0);
            height: 80px;    
        }        

        img {
            width: 70px;
            height: 70px;
        }

        #layoutAuthentication #layoutAuthentication_header {
            min-width: 0;
        }

        .logo-img {
            overflow: hidden;            
            width: 270px;
            height: 43px;
        }
        .logo-img a {
            display: inline-block;
            padding-top: 0.3125rem;
            padding-bottom: 0.3125rem;            
            font-size: 1.25rem;
            line-height: inherit;
            white-space: nowrap;
            background-image: url(../assets/img/logo_header.png);
            background-size: contain;
            background-repeat: no-repeat;
            background-position: left top;            
            padding: 0;
            width: 210px;
            height: 43px;
            margin-left: 1rem;
            margin-right: 1rem;    
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
    
    <!-- Javascript -->
    <script src="<?php echo $baseurl; ?>/assets/js/jquery.min.js"></script>    
    <script src="<?php echo $baseurl; ?>/assets/js/FontAwesome/all.min.js"></script>    
    <script src="<?php echo $baseurl; ?>/assets/js/Bootstrap4/bootstrap.bundle.min.js"></script>
    <script src="<?php echo $baseurl; ?>/assets/js/scripts.js" ></script>
</head>
<body>
    <div id="layoutAuthentication">
        <div class="layoutAuthentication_header">
            <header class="py-3 header mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">
                            <div class="logo-img">
                                <a href><span>Universitas Musamus Merauke</span></a>
                            </div>                        
                        </div>
                    </div>
                </div>
            </header>            
        </div>
        <div id="layoutAuthentication_content">
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="card shadow-lg border-0 rounded-lg mt-4">
                                <div class="card-header text-center">Pendaftaran Akun Baru</div>
                                <div class="card-body">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid">
                    <div class="d-flex align-items-center justify-content-between small">
                        <div class="text-muted">Copyright &copy; Administrator 2021</div>
                        <div>
                            <a href="#">Privacy Policy</a>
                            &middot;
                            <a href="#">Terms &amp; Conditions</a>
                        </div>
                    </div>
                </div>
            </footer>
        </div>   
    </div>
</body>
</html>