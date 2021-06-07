<?php
error_reporting(0);
session_start();

include './config/database.php';

$uname = $_POST['username'];
$paswd = $_POST['password'];

$sql = "SELECT username, password, hak_akses FROM tbl_login 
        WHERE username='$uname' AND password='$paswd'";
   
$result = $mysqli->query($sql);

$numrow = $result->num_rows;

if($numrow == 1) {
    $column = $result->fetch_assoc();

    $_SESSION['username'] = $uname;
    $_SESSION['password'] = $paswd;    
    $_SESSION['status'] = "masuk";    

    if($column['hak_akses'] == "PEGAWAI") {
        $sql_2 = "SELECT nip_pegawai, nm_pegawai FROM tbl_pegawai
                  WHERE username='$uname'";
        $result_2 = $mysqli->query($sql_2);

        $numrow_2 = $result_2->num_rows;

        if($numrow_2 == 1) {
            $data = $result_2->fetch_assoc();
            $_SESSION['no_id'] = $data['nip_pegawai'];
            $_SESSION['nama'] = $data['nm_pegawai'];
        }        
        header("location:petugas/index.php");
    } elseif($column['hak_akses'] == "MAHASISWA") {
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
    } else { 
        session_destroy();
        header("location:index.php?pesan=gagal");
    }     
} else {
    header("location:index.php?pesan=gagal");
}

?>