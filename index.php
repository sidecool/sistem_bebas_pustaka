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
    
    <link rel="shortcut icon" href="./assets/img/icon/favicon.ico">
    <link rel="stylesheet" href="./assets/css/login.css">

    <script>
        function f_showpassword() {
            var x = document.getElementById("passwd");
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
<body>
<header>
    <div class="container">
        <div class="title">
            <h2>SISTEM PELAYANAN SATU PINTU</h2>
            <h3>Bebas Pustaka dan Unggah Mandiri Tugas Akhir</h3>
        </div>        
        <div class="logo logo-img">
            <h1>
                <a href title="Universitas Musamus Merauke">
                    <span>Universitas Musamus Merauke</span>
                </a>
            </h1>
        </div>
    </div>    
</header>
<main>
    <div class="main-bg">
        <div class="container">
            <div class="side">
                <h1>SISTEM PELAYANAN SATU PINTU</h1>
                <h2>Bebas Pustaka dan Unggah Mandiri Tugas Akhir</h2>
            </div>
            <div class="login">
                <div class="login-content">
                    <div class="img-login">
                        <img src="./assets/img/logo.png" alt="Universitas Musamus" class="avatar">
                    </div>
                    <form method="post" action="aksi.php" autocomplete="off">
                        <input type="text" class="name" name="username" placeholder="Username" autofocus onkeydown="return f_cekenter(this, event)" tabIndex="1">
                        <input type="password" class="password" name="password" placeholder="Passowrd" id="passwd" tabIndex="2">
                        <p>
                            <input type="checkbox" onclick="f_showpassword()"> Show password
                        </p>                
                        <input type="submit" class="btn" value="Login" tabIndex="3">
                    </table>
                    </form>

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
                </div>                
            </div>            
        </div>        
    </div>
</main>
<footer>

</footer>
</body>
</html>