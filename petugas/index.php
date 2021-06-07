<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Si Bebas Pustaka - UPT Perpustakaan Universitas Musamus Merauke</title>
    <link rel="shortcut icon" href="../assets/img/icon/favicon.ico">
</head>
<body>

<?php
    session_start();
    if($_SESSION['status']!="masuk") {
        header("location:../index.php");
    }
?>

<h2>Anda masuk sebagai Petugas</h2>
<br/>
<h4>Selamat datang, <?php echo $_SESSION['nama'].' ('.$_SESSION['no_id'].')'; ?></h4>
<br/>
<a href="../logout.php">Logout</a>
    
</body>
</html>