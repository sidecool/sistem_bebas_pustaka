<?php 
// Abaikan Error Browser
error_reporting(0);
session_start();

include './config/route.php';
include $baseurl.'/config/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Si Bebas Pustaka - UPT Perpustakaan Universitas Musamus Merauke</title>

    <link rel="shortcut icon" href="<?php echo $baseurl; ?>/assets/img/icon/favicon.ico" >
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo $baseurl; ?>/assets/css/styles.css" >
    <style>
        .header {
            background: linear-gradient(to right, #000046, #1cb5e0);
            height: 80px;    
        }

        .main-bg {
            background: linear-gradient(to right, rgba(57, 106, 252, 0.5), rgba(41, 72, 255, 0.2)),  url(./assets/img/background.jpg);
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;    
            top:0px;
            left:0px;
            width: 100%;
            height: 100%;
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
            background-image: url(./assets/img/logo_header.png);
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
        
        input[type=text], 
        input[type=password] {
            outline: none;
            font-size: 14px;
            /* color: #cecfd3; */
            padding: 20px 30px 10px 10px;
            margin: 5px 0 22px 0;
            width: 100%;
            border: none;
            border-bottom: 2px solid #cecfd3;
            -webkit-appearance: none;
        }

        input[type=checkbox] {
            position: relative;
            width: 14px;
            height: 14px;
            top: 2px;       
        }

        input.username {
            background: url(./assets/img/l1.png) no-repeat 98% 67%;
        }

        input.password {
            background: url(./assets/img/l2.png) no-repeat 98% 67%;
        }
    </style>
    
    <!-- Javascript -->
    <script src="<?php echo $baseurl; ?>/assets/js/jquery.min.js"></script>    
    <script src="<?php echo $baseurl; ?>/assets/js/FontAwesome/all.min.js"></script>    
    <script src="<?php echo $baseurl; ?>/assets/js/Bootstrap4/bootstrap.bundle.min.js"></script>
    <script src="<?php echo $baseurl; ?>/assets/js/scripts.js" ></script>
    <script>
        function f_showpassword() {
            var x = document.getElementById("inputPassword");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        };

        function f_cekenter(sender, e) {
            if(e.which == 13 || e.keyCode == 13) {
                for (i = 0; i < sender.form.elements.length; i++) {                    
                    if (sender.form.elements[i].tabIndex == sender.tabIndex + 1) {
                        sender.form.elements[i].focus();
                        if (sender.form.elements[i].type == "password") {
                            sender.form.elements[i].select();
                            break;
                        }
                    }
                }                
                return false;
            }       
            return true;     
        };
    </script>
</head>
<body class="main-bg">    
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
                    <div class="row justify-content-end">
                        <div class="col-lg-4">
                            <div class="card shadow-lg border-0 rounded-lg mt-4">
                                <div class="card-header"><h3 class="text-center font-weight-light "><img src="./assets/img/logo.png" alt="Universitas Musamus" class="avatar"></h3></div>
                                <div class="card-body">
                                    <form method="post" action="aksi.php" autocomplete="off">
                                        <div class="form-group">
                                            <!-- <label class="small mb-1" for="inputUser">Username</label> -->
                                            <select class="form-control" name="hak_akses" id="inputAkses" autofocus onkeydown="return f_cekenter(this, event)" tabIndex="1">
                                                <option value="MAHASISWA">Mahasiswa</option>
                                                <option value="PEGAWAI">Petugas</option>
                                                <option value="ADMIN">Administrator</option>
                                            </select>                                            
                                        </div>
                                        <div class="form-group">
                                            <!-- <label class="small mb-1" for="inputUser">Username</label> -->
                                            <input class="form-control py-2 username" id="inputUsername" type="text" placeholder="Username" name="username" autofocus onkeydown="return f_cekenter(this, event)" tabIndex="2">
                                        </div>
                                        <div class="form-group">
                                            <!-- <label class="small mb-1" for="inputPassword">Password</label> -->
                                            <input class="form-control py-2 password" id="inputPassword" type="password" placeholder="Password" name="password" tabIndex="3">
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-checkbox">
                                                <input class="custom-control-input" id="rememberPasswordCheck" type="checkbox" onclick="f_showpassword()">
                                                <label class="custom-control-label" style="font-size: 10pt;" for="rememberPasswordCheck">Show password</label>
                                            </div>
                                        </div>
                                        <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                            <!-- <a class="small" href="">Forgot Password?</a> -->
                                            <input type="submit" name="Login" class="btn btn-primary" style="width: 100%;" value="Login" tabIndex="3">
                                        </div>
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                    <!-- <div class="small"><a href="register.html">Need an account? Sign up!</a></div> -->
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
    
    <?php
        if(isset($_GET['pesan'])) {
            if($_GET['pesan'] == "gagal") {
                echo '<script> 
                        alert("Login gagal! cek kembali username dan password Anda!");
                        document.location="index.php";
                    </script>
                ';                        
            }
        }
    ?>
</body>        
</html>