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
    } elseif($getVerifikasi == "terima-all"){
        $sql = "UPDATE tbl_upload_dokumen SET verifikasi='S', tgl_verifikasi=NOW() WHERE npm_mahasiswa='$_POST[uploader]'";
        $proses = $mysqli->query($sql);
        if(!$proses) {
            echo "Error : ".$mysqli->error;        
        } 
    } elseif($getVerifikasi == "tolak") {        
        $sql = "UPDATE tbl_upload_dokumen SET verifikasi='T', tgl_verifikasi=NOW() WHERE npm_mahasiswa='$_POST[uploader]' AND id_daftar_upload='$_POST[id]'";
        $proses = $mysqli->query($sql);
        if(!$proses) {
            echo "Error : ".$mysqli->error;        
        } 
    } elseif($getVerifikasi == "tolak-all") {
        $sql = "UPDATE tbl_upload_dokumen SET verifikasi='T', tgl_verifikasi=NOW() WHERE npm_mahasiswa='$_POST[uploader]'";
        $proses = $mysqli->query($sql);
        if(!$proses) {
            echo "Error : ".$mysqli->error;        
        } 
    }

    $sql_2 = "SELECT verifikasi FROM tbl_upload_dokumen 
              WHERE npm_mahasiswa='$_POST[uploader]'";
    $result_2 = $mysqli->query($sql_2);

    $numrow_2 = $result_2->num_rows;
    while($column_2 = $result_2->fetch_assoc()){
        if($column_2['verifikasi'] != 'S'){
            $verified = false;
            break;
        } else {
            $verified = true;
        } 
    }                                                     
    if($verified == true){
        $tahun = date('Y');
        $sql_count = "SELECT COUNT(no_surat_tugas) AS nomor FROM tbl_surat_tugas WHERE YEAR(tgl_surat_tugas) = '$tahun'";
        $result_count = $mysqli->query($sql_count);
        $count = $result_count->fetch_assoc();

        $nomor = sprintf("%03s", $count['nomor']);
        $nomor_2 = sprintf("%03s", $count['nomor']+1);
        $no_surat_bebas_tanggungan = $nomor."/UN52.10/TU/".$tahun;
        $no_surat_bebas_pustaka = $nomor_2."/UN52.10/TU/".$tahun;
    }
}

?>