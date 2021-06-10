<?php

include "../../config/database.php";

if(isset($_POST["judul_skripsi"]) && isset($_POST["pembimbing1"]) && isset($_POST["pembimbing2"])
    && isset($_POST["judulbuku1"]) && isset($_POST["judulbuku2"]) && isset($_POST["judulbuku3"])
    && isset($_POST["tahunbuku1"]) && isset($_POST["tahunbuku2"]) && isset($_POST["tahunbuku3"])) {
    $sql = "INSERT INTO tbl_info_dokumen (npm_mahasiswa, nm_mahasiswa, judul_skripsi, pembimbing_1, pembimbing_2, 
            judul_buku_1, tahun_buku_1, judul_buku_2, tahun_buku_2, judul_buku_3, tahun_buku_3)
            VALUES ('$_POST[npm_mahasiswa]', '$_POST[nm_mahasiswa]', '$_POST[judul_skripsi]', '$_POST[pembimbing1]', '$_POST[pembimbing2]', 
            '$_POST[judulbuku1]', '$_POST[tahunbuku1]', '$_POST[judulbuku2]', '$_POST[tahunbuku2]', '$_POST[judulbuku3]', '$_POST[tahunbuku3]')
            ON DUPLICATE KEY UPDATE 
            judul_skripsi='$_POST[judul_skripsi]',
            pembimbing_1='$_POST[pembimbing1]',
            pembimbing_2='$_POST[pembimbing2]',
            judul_buku_1='$_POST[judulbuku1]',
            tahun_buku_1='$_POST[tahunbuku1]',
            judul_buku_2='$_POST[judulbuku2]',
            tahun_buku_2='$_POST[tahunbuku2]',
            judul_buku_3='$_POST[judulbuku3]',
            tahun_buku_3='$_POST[tahunbuku3]'";
    $proses = $mysqli->query($sql);
    if(!$proses) {
        // echo "Error : ".$mysqli->error;
        header("location:index.php?p=gagal");
    } else {
        header("location:index.php?p=simpan");
    }
} else {
    header("location:index.php?p=gagal");
}
?>