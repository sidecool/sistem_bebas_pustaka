<?php
session_start();
error_reporting(0);

include "../config/database.php";

$uname = $_POST['username'];
$paswd = $_POST['password'];

$sql = "SELECT username, password, hak_akses
        FROM tbl_login 
        WHERE username='$uname' AND password='$paswd' ";

$result = $mysqli->query($sql);

$numrow = $result->num_rows;

if($numrow == 1) {
    $column = $result->fetch_assoc();

    $_SESSION['username'] = $uname;
    $_SESSION['status'] = "masuk";
    
    if($column['hak_akses'] == "ADMIN") {
        $_SESSION['id'] = "999";
        $_SESSION['nama'] = "Administrator";
        header("location:dashboard.php");
    }        
} else {
    // header("location:index.php?pesan=gagal");
}                
?>