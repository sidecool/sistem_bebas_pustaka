<?php

include '../../config/database.php';

if($_FILES['file']['name'] != ''){
    $nama = $_FILES['file']['name'];    
    $x = explode('.', $nama);
    $ekstensi = strtolower(end($x));
    $ukuran	= $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];
    $SaveAs = $_POST['fileid'].'. '.$_POST['username'].'_'.$_POST['filename'].'.'.$ekstensi;
    $SaveTo = '../../files/'.$_POST['username'];
    @mkdir($SaveTo, 0777, true);        
    $Save = $SaveTo.'/'.$SaveAs;
    if(move_uploaded_file($file_tmp, $Save)){        
        $sql = "INSERT INTO tbl_upload_dokumen(npm_mahasiswa, id_daftar_upload, nama_file, verifikasi, tgl_upload) 
                VALUES ('$_POST[username]', '$_POST[fileid]', '$SaveAs', 'B', NOW()) 
                ON DUPLICATE KEY UPDATE 
                nama_file = '$SaveAs', 
                verifikasi = 'B',
                tgl_upload = NOW(),
                tgl_verifikasi = '0000-00-00'";
        $proses = $mysqli->query($sql);
        if(!$proses) {
            // echo "Error : ".$mysqli->error;            
        } else {
            echo  
            '<a href="aksi_download.php?id='.$_POST['username'].'&file='.$SaveAs.'">
                <label>
                    <i class="fa fa-download text-danger" style="cursor: pointer"></i>
                </label>
            </a>';
        }
    } else {
        echo 'Gagal';
    }    
} else {
    echo "Nothing";
}
?>