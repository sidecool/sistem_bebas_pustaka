<?php

include '../../config/database.php';

$aksi = $_GET[aksi];

if($aksi=='insert') {
    $sql = "INSERT INTO tbl_informasi (id_informasi, isi_informasi, is_aktif)
            VALUES ('1',
                    '$_POST[editor]',
                    'A')";
    $proses = $mysqli->query($sql);
    if(!$proses) {
        // echo "Error : ".$mysqli->error;
        header("location:index.php?p=gagal-simpan");
    } else {
        header("location:index.php?p=berhasil-simpan");
    }
}

if($aksi=='update') {
    
}

if($aksi=='delete') {
    
}