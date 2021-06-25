<?php

include '../../config/database.php';

$filter = $_GET['f'];

if($filter == 'tahun'){
    $column = array('no_surat_keluar', 'npm_mahasiswa');
    if(isset($_POST['f_tahun'])){
        $tahun = $_POST['f_tahun'];
        $query = "SELECT A.npm_mahasiswa, B.nm_mahasiswa, A.no_surat_keluar, A.tgl_surat_keluar, A.nm_file FROM tbl_surat_keluar A
                  LEFT JOIN tbl_mahasiswa B ON A.npm_mahasiswa=B.npm_mahasiswa
                  WHERE year(tgl_surat_keluar)='$tahun'";
    }

    if(isset($_POST['order'])){
        $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
    } else {
        $query .= 'ORDER BY no_surat_keluar ASC ';
    }
    
    $statement = $connect->prepare($query);
    $statement->execute();
    $number_filter_row = $statement->rowCount();
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();

    $data = array();
    $i = 1;
    foreach($result as $row){
        $sub_array = array();
        $sub_array[] = $i;
        $sub_array[] = $row['no_surat_keluar'];
        $sub_array[] = $row['tgl_surat_keluar'];
        $sub_array[] = $row['npm_mahasiswa'];
        $sub_array[] = $row['npm_mahasiswa'].' ( '.$row['nm_mahasiswa'].')';
        $data[] = $sub_array;
        $i++;
    }

    function count_all_data($connect){
        $query = "SELECT * FROM tbl_surat_keluar WHERE year(tgl_surat_keluar)='$tahun'";
        $statement = $connect->prepare($query);
        $statement->execute();
        return $statement->rowCount();
    }

    $output = array(
        "recordsTotal"      => count_all_data($connect),
        "recordsFiltered"   => $number_filter_row,
        "data"              => $data        
    );

    echo json_encode($output);
}

if($filter == 'bulan'){
    $column = array('no_surat_keluar', 'npm_mahasiswa');
    if((isset($_POST['f_tahun'])) && (isset($_POST['f_bulan']))){
        $tahun = $_POST['f_tahun'];
        $bulan = $_POST['f_bulan'];
        $query = "SELECT A.npm_mahasiswa, B.nm_mahasiswa, A.no_surat_keluar, A.tgl_surat_keluar, A.nm_file FROM tbl_surat_keluar A
                  LEFT JOIN tbl_mahasiswa B ON A.npm_mahasiswa=B.npm_mahasiswa
                  WHERE year(tgl_surat_keluar)='$tahun' AND month(tgl_surat_keluar)='$bulan'";
    }

    if(isset($_POST['order'])){
        $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
    } else {
        $query .= 'ORDER BY no_surat_keluar ASC ';
    }
    
    $statement = $connect->prepare($query);
    $statement->execute();
    $number_filter_row = $statement->rowCount();
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();

    $data = array();
    $i = 1;
    foreach($result as $row){
        $sub_array = array();
        $sub_array[] = $i;
        $sub_array[] = $row['no_surat_keluar'];
        $sub_array[] = $row['tgl_surat_keluar'];
        $sub_array[] = $row['npm_mahasiswa'].' ( '.$row['nm_mahasiswa'].')';
        $sub_array[] = $row['nm_file'];        
        $data[] = $sub_array;
        $i++;
    }

    function count_all_data($connect){
        $query = "SELECT * FROM tbl_surat_keluar WHERE year(tgl_surat_keluar)='$tahun' AND month(tgl_surat_keluar)='$bulan'";
        $statement = $connect->prepare($query);
        $statement->execute();
        return $statement->rowCount();
    }

    $output = array(
        "recordsTotal"      => count_all_data($connect),
        "recordsFiltered"   => $number_filter_row,
        "data"              => $data        
    );

    echo json_encode($output);
}

?>