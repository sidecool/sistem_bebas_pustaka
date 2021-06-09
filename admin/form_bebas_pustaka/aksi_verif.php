<?php

include '../../config/database.php';

$getVerifikasi = $_GET["v"];

if(isset($_POST['id']) && isset($_POST['uploader'])){    
    if($getVerifikasi == "terima"){        
        $sql = "UPDATE tbl_upload_dokumen SET verifikasi='S', tgl_verifikasi=NOW() WHERE npm_mahasiswa='$_POST[uploader]' AND id_daftar_upload='$_POST[id]'";
        $proses = $mysqli->query($sql);
        if(!$proses) {
            echo "Error : ".$mysqli->error;        
        } 
    } else {        
        $sql = "UPDATE tbl_upload_dokumen SET verifikasi='T', tgl_verifikasi=NOW() WHERE npm_mahasiswa='$_POST[uploader]' AND id_daftar_upload='$_POST[id]'";
        $proses = $mysqli->query($sql);
        if(!$proses) {
            echo "Error : ".$mysqli->error;        
        } 
    }
}

?>