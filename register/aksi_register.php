<?php
error_reporting(0);

include '../config/database.php';

$getData = $_GET[getData];

if($getData=='fakultas'){ 
    $id_fakultas = $_POST[id_fakultas];   
    echo '<option value="">- Pilih Fakultas -</option>';
    
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
    echo '<option value="">- Pilih Jurusan / Program Studi -</option>';

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

if($aksi == 'simpan') {
    $sql = "INSERT INTO tbl_mahasiswa (npm_mahasiswa, username, nm_mahasiswa, id_fakultas, id_jurusan) 
            VALUES ('$_POST[data1]',
                    '$_POST[data1]',
                    '$_POST[data2]',
                    '$_POST[data3]',
                    '$_POST[data4]')";
    $proses = $mysqli->query($sql);
    if(!$proses){
        $result = array(
            'response' => array(
                'status' => 'error'
            )
        );
    } else {
        $result = array(
            'response' => array(
                'status' => 'success'
            )
        );
    }    
    echo json_encode($result);
}

if($aksi=='update') {
    $sql = "UPDATE tbl_login SET password = '$_POST[data2]'
            WHERE username =  '$_POST[data1]'";
    $proses = $mysqli->query($sql);
    if(!$proses) {
        $result = array(
            'response' => array(
                'status' => 'error'                
            )
        );
    } else {
        $result = array(
            'response' => array(
                'status' => 'success'
            )
        );
    } 
    echo json_encode($result);
}

?>