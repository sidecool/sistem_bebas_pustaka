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
                                                <div class="input-group mb-3">
                                                    <input type="password" id="password" name="password" class="form-control form-control-sm" placeholder="Password" autocomplete="off" required onkeydown="return f_cekenter(this, event)" tabIndex="5">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-sm btn-outline-secondary" type="button" id="show"><i class="fa fa-eye-slash"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="re-password" class="col-sm-4 col-form-label-sm text-right font-weight-bold">RE-PASSWORD</label>
                                            <div class="col-sm-4">
                                                <div class="input-group mb-3">
                                                    <input type="password" id="re-password" name="re-password" class="form-control form-control-sm" placeholder="Re-password" autocomplete="off" required onkeydown="return f_cekenter(this, event)" tabIndex="6">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-sm btn-outline-secondary" type="button" id="re-show"><i class="fa fa-eye-slash"></i></button>
                                                    </div>
                                                </div>                                                
                                            </div>
                                        </div>                                        
                                    </form>
                                </div>
                                <div class="card-footer text-center">
                                    <button class="btn btn-sm btn-primary" type="button" id="simpan" form="reg-form" tabIndex="7"><i class="fa fa-user-circle"></i><span> Daftar</span></button>
                                    <button class="btn btn-sm btn-warning" type="reset" id="batal" onclick="location.replace('<?php echo $baseurl; ?>')"  tabIndex="8"><i class="fa fa-reply"></i><span> Batal</span></button>
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

            $('#show').click(function(){
                $('#password').focus();
                var x = document.getElementById("password");
                var y = document.getElementById("show");
                if (x.type === "password") {
                    x.type = "text";
                    y.innerHTML = "<i class='fa fa-eye'>";
                } else {
                    x.type = "password";
                    y.innerHTML = "<i class='fa fa-eye-slash'>";
                }
            });

            $('#re-show').click(function(){
                $('#re-password').focus();
                var x = document.getElementById("re-password");
                var y = document.getElementById("re-show");
                if (x.type === "password") {
                    x.type = "text";
                    y.innerHTML = "<i class='fa fa-eye'>";
                } else {
                    x.type = "password";
                    y.innerHTML = "<i class='fa fa-eye-slash'>";
                }
            });

            $("#simpan").click(function(){
                var npm = document.getElementById('npm_mahasiswa').value; 
                var nama = document.getElementById('nama').value;
                var fakultas = $('.id_fakultas').val();
                var jurusan = $('.id_jurusan').val();
                var password = document.getElementById('password').value;
                var repassword = document.getElementById('re-password').value; 
                if(npm == ''){
                    $('#npm_mahasiswa').focus();
                    document.getElementById('npm_mahasiswa').reportValidity();
                    return false;
                }

                if(nama == ''){
                    $('#nama').focus();
                    document.getElementById('nama').reportValidity();
                    return false;
                }

                if(fakultas == ''){
                    $('#id_fakultas').focus();
                    document.getElementById('id_fakultas').reportValidity();
                    return false;
                }

                if(jurusan == ''){
                    $('#id_jurusan').focus();
                    document.getElementById('id_jurusan').reportValidity();
                    return false;
                }

                if(password == ''){
                    $('#password').focus();
                    document.getElementById('password').reportValidity();
                    return false;
                }

                if(repassword == ''){
                    $('#re-password').focus();
                    document.getElementById('re-password').reportValidity();
                    return false;
                }                
                
                if((npm != '') && (nama != '') && (fakultas != '') && (jurusan != '') && (password != '') && (repassword != '')) {
                    if (password != repassword) {
                        $('#re-password').focus();
                        document.getElementById("re-password").setCustomValidity('Re-password belum sama dengan Password');
                        document.getElementById('re-password').reportValidity();
                        return false;
                    }

                    $.ajax({
                        type: 'POST',
                        url: 'aksi_register.php?aksi=simpan',
                        data: { 
                            data1: npm,
                            data2: nama,
                            data3: fakultas,
                            data4: jurusan                            
                        },
                        cache: false,
                        success: function(result){
                            var json = $.parseJSON(result);
                            if(json.response.status == 'success') {
                                $.ajax({
                                    type: 'POST',
                                    url: 'aksi_register.php?aksi=update',
                                    data: {
                                        data1: npm,                                        
                                        data2: password
                                    },
                                    cache: false,
                                    success: function(result){
                                        var json2 = $.parseJSON(result);
                                        if(json2.response.status == 'success') {                                            
                                            toastr.success("Selamat Anda telah terdaftar dengan akun "+npm+", Silahkan melakukan login.", "Pesan Berhasil", 3000);
                                            document.getElementById('batal').click();
                                        } else {
                                            toastr.error("Anda tidak dapat mendaftar. </br>Silahkan hubungi Petugas.", "Pesan Gagal", 3000);
                                        }
                                    }
                                });
                            } else {
                                toastr.error(npm+" sudah terdaftar. </br>Anda tidak dapat mendaftar lagi dengan akun ini. </br>Silahkan melakukan login.", "Pesan Gagal", 3000);
                            }                        
                        }
                    });
                }                
            });
        });
    </script>
</body>
</html>