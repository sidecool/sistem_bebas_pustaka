<?php

include '../../config/database.php';

$aksi = $_GET[aksi];

if($aksi=='insert') {
    $sql = "INSERT INTO tbl_jurusan (id_fakultas, id_jurusan, nm_jurusan)
            VALUES ('$_POST[id_fakultas]',
                    '$_POST[id_jurusan]',
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
    $sql = "UPDATE tbl_jurusan SET 
            nm_jurusan='$_POST[nama]'
            WHERE id_fakultas='$_POST[id_fakultas]' 
            AND id_jurusan='$_POST[id_jurusan]'";
    $proses = $mysqli->query($sql);
    if(!$proses) {
        // echo "Error : ".$mysqli->error;
        header("location:index.php?p=gagal-edit");
    } else {
        header("location:index.php?p=berhasil-edit");
    }
}

if($aksi=='delete') {    
    $sql = "DELETE FROM tbl_jurusan WHERE id_fakultas='$_POST[id_fakultas]' AND id_jurusan='$_POST[id_jurusan]'";
    $proses = $mysqli->query($sql);
    if(!$proses) {
        // echo "Error : ".$mysqli->error;
        header("location:index.php?p=gagal-hapus");
    } else {
        header("location:index.php?p=berhasil-hapus");
    }
}

?>