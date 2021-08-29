<?php

include '../../config/database.php';

$aksi = $_GET[aksi];

if($aksi=='insert') {
    $sql = "UPDATE tbl_informasi SET is_aktif='T'";
    $proses = $mysqli->query($sql);
    $sql = "INSERT INTO tbl_informasi (judul_informasi, isi_informasi, is_aktif)
            VALUES ('$_POST[judul]',
                    '$_POST[editor]',
                    'A')
            ON DUPLICATE KEY UPDATE 
            judul_informasi='$_POST[judul]',
            isi_informasi='$_POST[editor]'";
    $proses = $mysqli->query($sql);
    if(!$proses) {
        // echo "Error : ".$mysqli->error;
        header("location:index.php?p=gagal-simpan");
    } else {
        header("location:index.php?p=berhasil-simpan");
    }
}

if($aksi=='update') {
    $sql = "UPDATE tbl_informasi SET is_aktif='T'";
    $proses = $mysqli->query($sql);
    $sql = "UPDATE tbl_informasi SET is_aktif='A'
            WHERE id_informasi='$_POST[id]'";
    $proses = $mysqli->query($sql);
    if(!$proses) {
        // echo "Error : ".$mysqli->error;
        header("location:index.php?p=gagal-edit");
    } else {
        header("location:index.php?p=berhasil-edit");
    }
}

if($aksi=='delete') {
    $sql = "DELETE FROM tbl_informasi WHERE id_informasi='$_POST[id]'";
    $proses = $mysqli->query($sql);
    if(!$proses) {
    // echo "Error : ".$mysqli->error;
        header("location:index.php?p=gagal-hapus");
    } else {
        header("location:index.php?p=berhasil-hapus");
    } 
}