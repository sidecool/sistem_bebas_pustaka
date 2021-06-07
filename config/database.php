<?php
date_default_timezone_set('Asia/Jakarta');

$hostname = "localhost";
$port = 3306;
$user = "root";
$passwd = "usbw";
$dbname = "db_sibebas_pustaka_firda";

$mysqli = @new mysqli($hostname, $user, $passwd, $dbname);
$connect = new PDO("mysql:host=localhost;dbname=db_sibebas_pustaka_firda", "root", "usbw");

// Cek Koneksi
if ($mysqli->connect_errno) {
    echo "Koneksi database gagal: ".$mysqli->connect_error;
    $mysqli->close;
    die();
} 
else {
    // echo "Koneksi berhasil."; exit;  
}
?>