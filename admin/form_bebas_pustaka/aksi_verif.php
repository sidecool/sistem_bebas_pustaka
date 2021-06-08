<?php

include '../../config/database.php';

$getVerifikasi = $_GET["v"];

if(isset($_POST['id']) && isset($_POST['uploader'])){    
    if($getVerifikasi == "terima"){        
        $sql = "UPDATE tbl_upload_dokumen SET verifikasi='S', tgl_verifikasi=NOW() WHERE npm_mahasiswa='$_POST[uploader]' AND id_daftar_upload='$_POST[id]'";
        $proses = $mysqli->query($sql);
        if(!$proses) {
            echo "Error : ".$mysqli->error;        
        } else {
            echo '                
                <span title="Diterima">
                    <label><i class="fa fa-check-circle text-success"></i></label>
                </span>
                <span title="Ditolak">
                    <label><i class="fa fa-times-circle text-basic"></i></label>
                </span>                    
            ';
        }
    } else {        
        $sql = "UPDATE tbl_upload_dokumen SET verifikasi='T', tgl_verifikasi=NOW() WHERE npm_mahasiswa='$_POST[uploader]' AND id_daftar_upload='$_POST[id]'";
        $proses = $mysqli->query($sql);
//         // if(!$proses) {
//         //     echo "Error : ".$mysqli->error;        
//         // } else {
//         //     echo '<label><i class="fa fa-check-circle text-basic"></i></label>';
//         // }
    }    
//     echo $sql;
// } else {
//     echo 'embuh';
}

?>