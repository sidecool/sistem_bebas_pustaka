<?php

include '../../config/database.php';

$aksi = $_GET[aksi];

if($aksi=='insert') {
    $sql = "INSERT INTO tbl_daftar_upload (id_daftar_upload, ket_daftar_upload, filetype)
            VALUES ('$_POST[id_dokumen]',
                    '$_POST[nama]',
                    '$_POST[filetype]')";
    $proses = $mysqli->query($sql);
    if(!$proses) {
        // echo "Error : ".$mysqli->error;
        header("location:index.php?p=gagal-simpan");
    } else {
        header("location:index.php?p=berhasil-simpan");
    }
}

if($aksi=='update') {
    $sql = "UPDATE tbl_daftar_upload SET 
            ket_daftar_upload='$_POST[nama]',
            filetype='$_POST[filetype]'
            WHERE id_daftar_upload='$_POST[id_dokumen]'";
    $proses = $mysqli->query($sql);
    if(!$proses) {
        // echo "Error : ".$mysqli->error;
        header("location:index.php?p=gagal-edit");
    } else {
        header("location:index.php?p=berhasil-edit");
    }
}

if($aksi=='delete') {    
    $sql = "DELETE FROM tbl_daftar_upload WHERE id_daftar_upload='$_POST[id]'";
    $proses = $mysqli->query($sql);
    if(!$proses) {
        // echo "Error : ".$mysqli->error;
        header("location:index.php?p=gagal-hapus");
    } else {
        header("location:index.php?p=berhasil-hapus");
    }
}

?>