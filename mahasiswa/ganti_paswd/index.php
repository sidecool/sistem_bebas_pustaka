<?php
session_start();
error_reporting(0);
$page = "Ganti Password ".$_SESSION['nama'];

include '../../config/route.php';
include "../../config/database.php";

// Keamanan
if($_SESSION['status']!="masuk") {
    header("location:../../logout.php");
}
if(isset($_POST['paswd_old'])){
    if($_POST['paswd_old']!=$_SESSION['password']){
        header("location:index.php?pas=pw-salah");
    } else {
        $sql = "UPDATE tbl_login SET 
                password='$_POST[paswd_conf]'
                WHERE username='$_SESSION[username]'";
        $proses = $mysqli->query($sql);
        if(!$proses) {
            // echo "Error : ".$mysqli->error;
            header("location:index.php?pas=pw-gagal-edit");
        } else {
            header("location:index.php?pas=pw-berhasil-edit");
        }        
    }
}

include "../header.php";
include "../../password/index.php";
include "../footer.php";
?>