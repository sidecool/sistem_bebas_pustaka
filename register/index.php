<?php 
// Abaikan Error Browser
// error_reporting(0);
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
    <link rel="stylesheet" href="<?php echo $baseurl; ?>/assets/css/toastr.css" >
    <link rel="stylesheet" href="<?php echo $baseurl; ?>/assets/css/toastr.min.css">
    <style>
        .header {
            background: linear-gradient(to right, #000046, #1cb5e0);
            height: 80px;    
        }

        .main-bg {
            background: linear-gradient(to right, rgba(57, 106, 252, 0.5), rgba(41, 72, 255, 0.2));
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
    <script src="<?php echo $baseurl; ?>/assets/js/toastr.min.js"></script>
    <script src="<?php echo $baseurl; ?>/assets/js/FontAwesome/all.min.js"></script>    
    <script src="<?php echo $baseurl; ?>/assets/js/Bootstrap4/bootstrap.bundle.min.js"></script>
    <script src="<?php echo $baseurl; ?>/assets/js/scripts.js" ></script>
    <script> // Cek enter
        function f_cekenter(sender, e) {
            if(e.which == 13 || e.keyCode == 13) {
                for (i = 0; i < sender.form.elements.length; i++) {                    
                    if (sender.form.elements[i].tabIndex == sender.tabIndex + 1) {
                        sender.form.elements[i].focus();                        
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
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="card shadow-lg border-0 rounded-lg mt-4">
                                <div class="card-header text-center">Pendaftaran Akun Baru</div>
                                <div class="card-body">
                                    <form action="" method="post" autocomplete="off" id="reg-form">
                                        <div class="row">
                                            <label for="npm_mahasiswa" class="col-sm-4 col-form-label-sm text-right font-weight-bold">NPM MAHASISWA</label>
                                            <div class="col-sm-4">
                                                <input type="text" autofocus class="form-control form-control-sm" name="npm_mahasiswa" id="npm_mahasiswa" placeholder="NPM Mahasiswa" required onkeydown="return f_cekenter(this, event)" tabIndex="1">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="nama" class="col-sm-4 col-form-label-sm text-right font-weight-bold">NAMA MAHASISWA</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control form-control-sm" name="nama" id="nama" placeholder="Nama Mahasiswa" required onkeydown="return f_cekenter(this, event)" tabIndex="2">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="id_fakultas" class="col-sm-4 col-form-label-sm text-right font-weight-bold">FAKULTAS</label>
                                            <div class="col-sm-8">
                                                <select class="id_fakultas form-control form-control-sm" name="id_fakultas" id="id_fakultas" placeholder="Nama Fakultas" required onkeydown="return f_cekenter(this, event)" tabIndex="3">
                                                <option value="">- Pilih Fakultas -</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="id_jurusan" class="col-sm-4 col-form-label-sm text-right font-weight-bold">JURUSAN / PROGRAM STUDI</label>
                                            <div class="col-sm-8">
                                                <select class="id_jurusan form-control form-control-sm" name="id_jurusan" id="id_jurusan" placeholder="Nama Jurusan" required onkeydown="return f_cekenter(this, event)" tabIndex="4">
                                                    <option value="">- Pilih Jurusan / Program Studi -</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="password" class="col-sm-4 col-form-label-sm text-right font-weight-bold">PASSWORD</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control form-control-sm" name="password" id="password" placeholder="Password" required onkeydown="return f_cekenter(this, event)" tabIndex="5">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="re-password" class="col-sm-4 col-form-label-sm text-right font-weight-bold">RE-PASSWORD</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control form-control-sm" name="re-password" id="re-password" placeholder="Re-password" required onkeydown="return f_cekenter(this, event)" tabIndex="6">
                                            </div>
                                        </div>                                        
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                    <button class="btn btn-sm btn-primary" type="button" id="simpan" form="reg-form" ><i class="fa fa-user-circle"></i><span> Daftar</span></button>
                                    <button class="btn btn-sm btn-warning" type="reset" id="batal" onclick="location.replace('<?php echo $baseurl; ?>')"><i class="fa fa-reply"></i><span> Batal</span></button>                                    
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

    <script>
        $(document).ready(function(){
            var npm = document.getElementById('npm_mahasiswa').value; 
            var nama = document.getElementById('nama').value;
            var fakultas = $('.id_fakultas').attr("fakultas");
            var jurusan = $('.id_jurusan').attr("jurusan");
            var password = document.getElementById('password').value;
            var repassword = document.getElementById('re-password').value;
            $.ajax({
                type: 'POST',
                url: "aksi_register.php?getData=fakultas",
                data: {id_fakultas: fakultas},
                cache: false, 
                success: function(msg){
                    $(".id_fakultas").html(msg);
                }
            });
            $.ajax({
                type: 'POST',
                url: "aksi_register.php?getData=jurusan",
                data: {id_fakultas: fakultas, id_jurusan: jurusan},
                cache: false,
                success: function(msg){
                    $(".id_jurusan").html(msg);
                }
            });                                
            $(".id_fakultas").change(function(){
                var fakultas = $(".id_fakultas").val();                            
                $.ajax({
                    type: 'POST',
                    url: "aksi_register.php?getData=jurusan",
                    data: {id_fakultas: fakultas},
                    cache: false,
                    success: function(msg){
                        $(".id_jurusan").html(msg);
                    }
                });
            });

            $("#simpan").click(function(){
                var npm = document.getElementById('npm_mahasiswa').value; 
                var nama = document.getElementById('nama').value;
                var fakultas = $('.id_fakultas').val();
                var jurusan = $('.id_jurusan').val();
                var password = document.getElementById('password').value;
                var repassword = document.getElementById('re-password').value;
                $.ajax({
                    type: 'POST',
                    url: 'aksi_register.php?aksi=cek',
                    data: { data1: npm },
                    cache: false,
                    success: function(){
                        $.ajax({
                            type: 'POST',
                            url: 'aksi_register.php?aksi=insert',
                            data: {
                                data1: npm,
                                data2: nama,
                                data3: fakultas,
                                data4: jurusan,
                                data5: password,
                            },
                            cache: false,
                            success: function(){

                            },
                            error: function(){

                            }
                        });
                    },
                    error: function(){
                        toastr.error("Anda sudah mendaftar. Silahkan melakukan login.", "Pesan Gagal", 3000);
                    }
                });                
            });
        });
    </script>
</body>
</html>