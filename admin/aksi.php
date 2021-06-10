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
    } elseif($column['hak_akses'] == "PEGAWAI") {
        $sql_2 = "SELECT nip_pegawai, nm_pegawai FROM tbl_pegawai
                  WHERE username='$uname'";
        $result_2 = $mysqli->query($sql_2);

        $numrow_2 = $result_2->num_rows;

        if($numrow_2 == 1) {
            $data = $result_2->fetch_assoc();
            $_SESSION['id'] = $data['nip_pegawai'];
            $_SESSION['nama'] = $data['nm_pegawai'];
        }        
        header("location:dashboard.php");
    } else       
} else {
    // header("location:index.php?pesan=gagal");
}                
?>