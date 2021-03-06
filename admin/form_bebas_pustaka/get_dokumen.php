<?php

include '../../config/database.php';

$folder = $_POST['id_mahasiswa'];                                                
$sql = "SELECT id_daftar_upload, ket_daftar_upload, filetype FROM tbl_daftar_upload ORDER BY id_daftar_upload ASC";
$result = $mysqli->query($sql);

$numrow = $result->num_rows;

if($numrow > 0) {
    $no_urut = 1;
    while($column = $result->fetch_assoc()) {
        $id_upload = $column['id_daftar_upload'];

        if($column["filetype"] == ".pdf"){
            $ext = ' (PDF)';
        }elseif($column["filetype"] == ".doc, .docx"){
            $ext = ' (Word)';
        } 

        $ket_upload = $column['ket_daftar_upload'];
        $filename = strtolower(str_replace(" ", "_", $ket_upload));
        $ket_upload_ext = $ket_upload . $ext;
            
        echo '
        <tr>
            <td width = "5%" class="text-center">'.$no_urut.'</td>
            <td style="display:none;" id="id'.$id_upload.'" >'.$id_upload.'</td>
            <td width = "80%" id="nama'.$id_upload.'" >'.$ket_upload_ext.'</td>
            <td width = "5%" class="text-center">
                <div>
                    <span title="Upload File"><label for="'.$no_urut.'"><i class="fa fa-upload text-info" style="cursor: pointer"></i></label></span>
                    <input type="file" name="file" id="'.$no_urut.'" style="display:none;" accept="'.$column["filetype"].'" onchange="f_upload(this.id, \''.$id_upload.'\', \''.$filename.'\');">
                </div>                                                    
            </td>
            <td width = "5%" class="text-center">
                <div>
                    <span id="'.$no_urut.'proses" title="Download File">
        ';
                    $sql_2 = "SELECT nama_file FROM tbl_upload_dokumen 
                              WHERE npm_mahasiswa='$folder' AND id_daftar_upload='$id_upload'";                    
                    $result_2 = $mysqli->query($sql_2);
  
                    $numrow_2 = $result_2->num_rows;
                    if($numrow_2 > 0) {
                        $column_2 = $result_2->fetch_assoc();
                        $file_cari = $column_2["nama_file"];
                        if(file_exists("../../files/".$folder."/".$file_cari)){
                            echo '
                                <a href="aksi_download.php?id='.$folder.'&file='.$file_cari.'">
                                    <label><i class="fa fa-download text-danger" style="cursor: pointer"></i></label>
                                </a>                                
                            ';
                        } else {
                            echo '';
                        }
                    }
        echo        '</span>
                </div>
            </td>
            <td width = "5%" class="text-center">
                <div id="'.$no_urut.'verif">
        ';
                $sql_3 = "SELECT verifikasi FROM tbl_upload_dokumen 
                          WHERE npm_mahasiswa='$folder' AND id_daftar_upload='$id_upload'";

                $result_3 = $mysqli->query($sql_3);
                $numrow_3 = $result_3->num_rows;                

                if($numrow_3 > 0) {
                    $column_3 = $result_3->fetch_assoc();
                    if($column_3['verifikasi'] == 'B'){
                        echo '
                            <span class="btn-terima" id="btn-terima'.$no_urut.'" title="Diterima" data-id="'.$id_upload.'" data-file="'.$filename.'" data-user="'.$folder.'">
                                <label><i id="i-terima'.$no_urut.'" class="fa fa-check-circle text-success" style="cursor: pointer"></i></label>
                            </span>
                            <span class="btn-tolak" id="btn-tolak'.$no_urut.'" title="Ditolak" data-id="'.$id_upload.'" data-file="'.$filename.'" data-user="'.$folder.'">
                                <label><i id="i-tolak'.$no_urut.'" class="fa fa-times-circle text-danger" style="cursor: pointer"></i></label>
                            </span>
                        ';
                    } elseif($column_3['verifikasi'] == 'S'){ 
                        echo '
                            <span title="Diterima">
                                <label><i class="fa fa-check-circle text-success"></i></label>
                            </span>
                            <span title="Ditolak">
                                <label><i class="fa fa-times-circle text-basic"></i></label>
                            </span>
                        ';
                    } else {
                        echo '
                            <span title="Diterima">
                                <label><i class="fa fa-check-circle text-basic"></i></label>
                            </span>
                            <span title="Ditolak">
                                <label><i class="fa fa-times-circle text-danger"></i></label>
                            </span>
                        ';
                    }                                                                              
                } 

        echo    '</div>
            </td>
        </tr>        
        ';        
        $no_urut++;        
    }      
}

$sql_dokumen = "SELECT COUNT(id_daftar_upload) AS NUM_DAFTAR FROM tbl_daftar_upload";
$result_dokumen = $mysqli->query($sql_dokumen);
$col_dokumen = $result_dokumen->fetch_assoc();

$sql_upload = "SELECT COUNT(id_daftar_upload) AS NUM_UPLOAD FROM tbl_upload_dokumen WHERE npm_mahasiswa='$folder'";
$result_upload = $mysqli->query($sql_upload);
$col_upload = $result_upload->fetch_assoc();

if($col_dokumen['NUM_DAFTAR']==$col_upload['NUM_UPLOAD']){
    $sql_ver = "SELECT verifikasi FROM tbl_upload_dokumen WHERE npm_mahasiswa='$folder'";
    $result_ver = $mysqli->query($sql_ver);
    while($column_ver = $result_ver->fetch_assoc()){            
        $isi_btnPrint = "<div id='btn-download' class='row' style='width:100%;'><div class='col-sm-6 text-right'><a href='../../pdf/bebas_tanggungan.php?id=".$folder."'><button class='btn btn-sm btn-success' type='button' id='file1' >Surat Keterangan Bebas Pinjaman/Tanggungan</button></a></div><div class='col-sm-6 text-left'><a href='../../pdf/bebas_pustaka.php?id=".$folder."'><button class='btn btn-sm btn-success' type='button' id='file2' >Surat Keterangan Bebas Pustaka</button></a></div></div>";
        if ($column_ver['verifikasi'] == "S") {
            $verified = true;            
        } else {
            $verified = false;            
            break;
        }
    }
    if($verified==true){
        echo '<script>
            var x = document.getElementById("btn-all");
            x.style.display = "none";
            var btnPrint = document.getElementById("btn-print");
            btnPrint.innerHTML = "'.$isi_btnPrint.'";
        </script>';
    } else {
        echo '<script>
            var x = document.getElementById("btn-all");
            x.style.display = "block";                    
        </script>';
    }
} else {
    echo '<script>
        var x = document.getElementById("btn-all");
        x.style.display = "none";            
    </script>';
} 

echo '
<script>
    function f_upload(id_element, kode, nama){        
        var id = kode;
        var nama = nama;
        var uploader = "'.$folder.'";
        var files = document.getElementById(id_element);
        for (var x = 0; x < files.length; x++){                                
            var namaFile = files.files[0].name;
        };                            
        
        var form_data = new FormData();
        form_data.append("file", files.files[0]);
        form_data.append("fileid", id);
        form_data.append("filename", nama);
        form_data.append("username", uploader);
        
        var pesan = "<label class=\'text-success\'>Proses upload...</label>";
        var btnVerifikasi = "<span class=\'btn-terima\' id=\'btn-terima"+id_element+"\' title=\'Diterima\' data-id=\'"+id+"\' data-file=\'"+nama+"\' data-user=\'"+uploader+"\'><label><i id=\'i-terima"+id+"\' class=\'fa fa-check-circle text-success\' style=\'cursor: pointer\'></i></label></span> <span class=\'btn-tolak\' id=\'btn-tolak"+id_element+"\' title=\'Ditolak\' data-id=\'"+id+"\' data-file=\'"+nama+"\' data-user=\'"+uploader+"\'><label><i id=\'i-tolak"+id+"\' class=\'fa fa-times-circle text-danger\' style=\'cursor: pointer\'></i></label></span>";
        
        $.ajax({            
            url: "aksi_upload.php",
            method: "POST",
            data: form_data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "html",
            beforeSend:function(){
                document.getElementById(id_element+"proses").innerHTML = pesan;
            },
            success: function(msg){                                                        
                toastr.success("Data telah disimpan, Anda berhasil menyimpan data.", "Pesan Berhasil", 3000);
                document.getElementById(id_element+"proses").innerHTML = msg; 
                document.getElementById(id_element+"verif").innerHTML = btnVerifikasi;
                $.getScript("../../assets/js/verifikasi.js");
            }, 
            error: function (error) {
                toastr.error("Data tidak dapat disimpan, Anda tidak berhasil menyimpan data.", "Pesan Gagal", 3000);
            }
        });                            
    };        
</script>
';
?>
