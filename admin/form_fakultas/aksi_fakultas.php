<?php

include '../../config/database.php';

$aksi = $_GET[aksi];

if($aksi=='insert') {
    $sql = "INSERT INTO tbl_fakultas (id_fakultas, nm_fakultas)
            VALUES ('$_POST[id_fakultas]',
                    '$_POST[nama]')";
    $proses = $mysqli->query($sql);
    if(!$proses) {
        // echo "Error : ".$mysqli->error;
        header("location:index.php?p=gagal-simpan");
    } else {
        header("location:index.php?p=berhasil-simpan");
    }
}

if($aksi=='update') {
    $sql = "UPDATE tbl_fakultas SET 
            nm_fakultas='$_POST[nama]'
            WHERE id_fakultas='$_POST[id_fakultas]'";
    $proses = $mysqli->query($sql);
    if(!$proses) {
        // echo "Error : ".$mysqli->error;
        header("location:index.php?p=gagal-edit");
    } else {
        header("location:index.php?p=berhasil-edit");
    }
}

if($aksi=='delete') {    
    $sql = "DELETE FROM tbl_fakultas WHERE id_fakultas='$_POST[id]'";
    $proses = $mysqli->query($sql);
    if(!$proses) {
        // echo "Error : ".$mysqli->error;
        header("location:index.php?p=gagal-hapus");
    } else {
        header("location:index.php?p=berhasil-hapus");
    }
}

?>