<?php

include '../../config/database.php';

$aksi = $_GET[aksi];

if($aksi=='insert') {
    $kode = $_POST[nip];

    $sql = "INSERT INTO tbl_pegawai (id_pegawai, username, nm_pegawai, nip_pegawai, jabatan) 
            VALUES ('$kode',
                    '$_POST[nip]',
                    '$_POST[nama]',
                    '$_POST[nip]',
                    '$_POST[jabatan]')";
    $proses = $mysqli->query($sql);
    if(!$proses) {
        // echo "Error : ".$mysqli->error;
        header("location:index.php?p=gagal-simpan");
    } else {
        header("location:index.php?p=berhasil-simpan");
    }
}

if($aksi=='update') {
    $sql = "UPDATE tbl_pegawai SET 
            nm_pegawai='$_POST[nama]', 
            jabatan='$_POST[jabatan]' 
            WHERE username='$_POST[nip]'";    
    $proses = $mysqli->query($sql);
    if(!$proses) {
        // echo "Error : ".$mysqli->error;
        header("location:index.php?p=gagal-edit");
    } else {
        header("location:index.php?p=berhasil-edit");
    }
}

if($aksi=='delete') {    
    $kode = $_POST[id];
    
    $sql = "DELETE FROM tbl_pegawai WHERE id_pegawai='$kode'";
    $proses = $mysqli->query($sql);
    if(!$proses) {
        // echo "Error : ".$mysqli->error;
        header("location:index.php?p=gagal-hapus");
    } else {
        header("location:index.php?p=berhasil-hapus");
    }
}

?>