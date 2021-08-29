<?php

include '../../config/database.php';

$getData = $_GET[getData];

if($getData=='fakultas'){ 
    $id_fakultas = $_POST[id_fakultas];   
    echo '<option value="">- PILIH FAKULTAS -</option>';
    
    $sql = "SELECT id_fakultas, nm_fakultas FROM tbl_fakultas ORDER BY nm_fakultas ASC";
    $result = $mysqli->query($sql);
    $numrow = $result->num_rows;
    if($numrow > 0) {
        while($data = $result->fetch_assoc()) {
            if($id_fakultas == $data["id_fakultas"]) {
                echo '<option selected="selected" value="'.$data["id_fakultas"].'">'.$data["nm_fakultas"].'</option>';
            } else {
                echo '<option value="'.$data["id_fakultas"].'">'.$data["nm_fakultas"].'</option>';
            }
        }

    }
}

if($getData=='jurusan'){
    $id_fakultas = $_POST[id_fakultas];
    $id_jurusan = $_POST[id_jurusan];
    echo '<option value="">- PILIH JURUSAN / PROGRAM STUDI -</option>';

    $sql = "SELECT id_fakultas, id_jurusan, nm_jurusan FROM tbl_jurusan WHERE id_fakultas='$id_fakultas' ORDER BY nm_jurusan ASC";
    $result = $mysqli->query($sql);
    $numrow = $result->num_rows;
    if($numrow > 0) {
        while($data = $result->fetch_assoc()) {
            if($id_jurusan == $data["id_jurusan"]) {
                echo '<option selected="selected" value="'.$data["id_jurusan"].'">'.$data["nm_jurusan"].'</option>';
            } else {
                echo '<option value="'.$data["id_jurusan"].'">'.$data["nm_jurusan"].'</option>';
            }
        }
    }
}

$aksi = $_GET[aksi];

if($aksi=='insert') {
    $sql = "INSERT INTO tbl_mahasiswa (npm_mahasiswa, username, nm_mahasiswa, alamat, id_fakultas, id_jurusan, id_anggota_perpus, status_tanggungan_perpus, denda_perpus, email)
            VALUES ('$_POST[npm_mahasiswa]',
                    '$_POST[npm_mahasiswa]',
                    '$_POST[nama]',
                    '$_POST[alamat]',
                    '$_POST[id_fakultas]',
                    '$_POST[id_jurusan]',                    
                    '$_POST[id_perpus]',
                    '$_POST[stat_perpus]',
                    '$_POST[denda_perpus]',
                    '$_POST[email]')";
    $proses = $mysqli->query($sql);
    if(!$proses) {
        // echo "Error : ".$mysqli->error;
        header("location:index.php?p=gagal-simpan");
    } else {
        header("location:index.php?p=berhasil-simpan");
    }
}

if($aksi=='update') {
    $sql = "UPDATE tbl_mahasiswa SET nm_mahasiswa='$_POST[nama]',
            id_fakultas='$_POST[id_fakultas]',
            id_jurusan='$_POST[id_jurusan]',
            alamat='$_POST[alamat]',
            id_anggota_perpus='$_POST[id_perpus]',
            status_tanggungan_perpus='$_POST[stat_perpus]',
            denda_perpus='$_POST[denda_perpus]',
            email='$_POST[email]'
            WHERE npm_mahasiswa='$_POST[npm_mahasiswa]'";
    $proses = $mysqli->query($sql);
    if(!$proses) {
        // echo "Error : ".$mysqli->error;
        header("location:index.php?p=gagal-edit");
    } else {
        header("location:index.php?p=berhasil-edit");
    }
}

if($aksi=='delete') {    
    $sql = "DELETE FROM tbl_mahasiswa WHERE npm_mahasiswa='$_POST[npm_mahasiswa]'";
    $proses = $mysqli->query($sql);
    if(!$proses) {
        // echo "Error : ".$mysqli->error;
        header("location:index.php?p=gagal-hapus");
    } else {
        header("location:index.php?p=berhasil-hapus");
    }
}

?>