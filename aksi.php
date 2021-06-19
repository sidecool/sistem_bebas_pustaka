<?php
error_reporting(0);
session_start();

include './config/database.php';

$uname = $_POST['username'];
$paswd = $_POST['password'];
$akses = $_POST['hak_akses'];

$sql = "SELECT username, password, hak_akses FROM tbl_login 
        WHERE hak_akses='$akses' AND username='$uname' AND password='$paswd'";
   
$result = $mysqli->query($sql);
$numrow = $result->num_rows;

if($numrow == 1) {
    $column = $result->fetch_assoc();

    $_SESSION['username'] = $uname;
    $_SESSION['password'] = $paswd;    
    $_SESSION['status'] = "masuk";
    $_SESSION['hak_akses'] = $akses;    

    if($akses == "MAHASISWA"){
        $sql_2 = "SELECT npm_mahasiswa, nm_mahasiswa FROM tbl_mahasiswa
                  WHERE username='$uname'";
        $result_2 = $mysqli->query($sql_2);

        $numrow_2 = $result_2->num_rows;

        if($numrow_2 == 1) {
            $data = $result_2->fetch_assoc();
            $_SESSION['no_id'] = $data['npm_mahasiswa'];
            $_SESSION['nama'] = $data['nm_mahasiswa'];
        } 
        header("location:mahasiswa/index.php");
    }elseif($akses == "PEGAWAI"){
        $sql_2 = "SELECT nip_pegawai, nm_pegawai FROM tbl_pegawai
                  WHERE username='$uname'";
        $result_2 = $mysqli->query($sql_2);

        $numrow_2 = $result_2->num_rows;

        if($numrow_2 == 1) {
            $data = $result_2->fetch_assoc();
            $_SESSION['id'] = $data['nip_pegawai'];
            $_SESSION['nama'] = $data['nm_pegawai'];
        }        
        header("location:admin/dashboard.php");
    }elseif($akses == "ADMIN"){
        $_SESSION['id'] = "999";
        $_SESSION['nama'] = "Administrator";
        header("location:admin/dashboard.php");
    }
} else {
    header("location:index.php?pesan=gagal");
}
?>