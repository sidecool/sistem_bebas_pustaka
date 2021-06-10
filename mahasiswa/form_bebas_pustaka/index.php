<?php
session_start();
error_reporting(0);
$page = "Pengajuan Bebas Pustaka";

include '../../config/route.php';
include "../../config/database.php";

// Keamanan
if($_SESSION['status']!="masuk") {
    header("location:../../logout.php");
}

include "../header.php";
?>
                        <div id="InfoForm">
                            <div class="card mb-4">
                                <div class="card-header container-fluid">
                                    <div class="row">
                                        <div class="col">
                                            <i class="fas fa-table mr-1"></i>
                                            Informasi Dokumen
                                        </div>                                                                                
                                    </div>                                    
                                </div>
                                <div class="card-body">
                                    <form method="post" action="aksi_info.php" autocomplete="off" id="in-form">
                                        <?php
                                            $id_mahasiswa = $_SESSION['no_id'];
                                            
                                            $sql = "SELECT nm_mahasiswa, judul_skripsi, pembimbing_1, pembimbing_2, judul_buku_1, tahun_buku_1, judul_buku_2, tahun_buku_2, judul_buku_3, tahun_buku_3 
                                                    FROM tbl_info_dokumen WHERE npm_mahasiswa='$id_mahasiswa'";
                                            $result = $mysqli->query($sql);
                                            $col = $result->fetch_assoc();
                                        ?>

                                        <div class="form-group row">
                                            <label for="npm_mahasiswa" class="col-sm-4 col-form-label text-right font-weight-bold">NPM Mahasiswa</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="npm_mahasiswa" id="npm_mahasiswa" value="<?php echo $id_mahasiswa; ?>" placeholder="NPM Mahasiswa" readonly required onkeydown="return f_cekenter(this, event)" tabIndex="1">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="nama" class="col-sm-4 col-form-label text-right font-weight-bold">NAMA MAHASISWA</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="nama" id="nama" value="<?php echo $col['nm_mahasiswa']; ?>" placeholder="Nama Mahasiswa" readonly required onkeydown="return f_cekenter(this, event)" tabIndex="2">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="judul_skripsi" class="col-sm-4 col-form-label text-right font-weight-bold">JUDUL SKRIPSI</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="judul_skripsi" id="judul_skripsi" value="<?php echo $col['judul_skripsi']; ?>" placeholder="Judul Skripsi" required onkeydown="return f_cekenter(this, event)" tabIndex="3">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="pembimbing1" class="col-sm-4 col-form-label text-right font-weight-bold">DOSEN PEMBIMBING 1</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="pembimbing1" id="pembimbing1" value="<?php echo $col['pembimbing_1']; ?>" placeholder="Nama Dosen Pembimbing" required onkeydown="return f_cekenter(this, event)" tabIndex="4">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="pembimbing2" class="col-sm-4 col-form-label text-right font-weight-bold">DOSEN PEMBIMBING 2</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="pembimbing2" id="pembimbing2" value="<?php echo $col['pembimbing_2']; ?>" placeholder="Nama Dosen Pembimbing" required onkeydown="return f_cekenter(this, event)" tabIndex="5">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="judulbuku1" class="col-sm-4 col-form-label text-right font-weight-bold">JUDUL BUKU 1</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="judulbuku1" id="judulbuku1" value="<?php echo $col['judul_buku_1']; ?>" placeholder="Judul Buku" required onkeydown="return f_cekenter(this, event)" tabIndex="6">
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" name="tahunbuku1" id="tahunbuku1" value="<?php echo $col['tahun_buku_1']; ?>" placeholder="Tahun Buku" required tabIndex="7">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="judulbuku2" class="col-sm-4 col-form-label text-right font-weight-bold">JUDUL BUKU 2</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="judulbuku2" id="judulbuku2" value="<?php echo $col['judul_buku_2']; ?>" placeholder="Judul Buku" required onkeydown="return f_cekenter(this, event)" tabIndex="8">
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" name="tahunbuku2" id="tahunbuku2" value="<?php echo $col['tahun_buku_2']; ?>" placeholder="Tahun Buku" required tabIndex="9">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="judulbuku3" class="col-sm-4 col-form-label text-right font-weight-bold">JUDUL BUKU 3</label>
                                            <div class="col-sm-6">
                                                <input type="text" class="form-control" name="judulbuku3" id="judulbuku3" value="<?php echo $col['judul_buku_3']; ?>" placeholder="Judul Buku" required tabIndex="10">
                                            </div>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" name="tahunbuku3" id="tahunbuku3" value="<?php echo $col['tahun_buku_3']; ?>" placeholder="Tahun Buku" required tabIndex="11">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4"></div>
                                            <div class="col-sm-8">
                                                <button class="btn btn-sm btn-primary" type="submit" id="simpan" form="in-form"><i class="fa fa-save"></i><span> Simpan</span></button>                                                
                                                <button class="btn btn-sm btn-warning" type="button" id="batal"><i class="fa fa-reply"></i><span> Batal</span></button>
                                            </div>
                                        </div>                                        
                                    </form>
                                </div>
                            </div>
                        </div>
                    
                    
                    <div id="TabelData">
                        <div class="card mb-4">
                            <div class="card-header container-fluid">
                                <div class="row">
                                    <div class="col">
                                        <i class="fas fa-table mr-1"></i>
                                        Upload Dokumen
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-sm" id="uploadTable" width="100%" cellspacing="0">
                                        <thead class="text-center">
                                            <tr>
                                                <th>No.</th>
                                                <th style="display:none;">ID</th>
                                                <th>Keterangan</th>
                                                <th>Upload</th>
                                                <th>Download</th>
                                                <th>Verifikasi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $folder = $_SESSION['username'];                                                
                                                $sql = "SELECT id_daftar_upload, ket_daftar_upload, filetype FROM tbl_daftar_upload ORDER BY id_daftar_upload ASC";
                                                $result = $mysqli->query($sql);
                            
                                                $numrow = $result->num_rows;
                                                
                                                if($numrow > 0) {
                                                    $no_urut = 1;
                                                    while($column = $result->fetch_assoc()) {
                                                        $id_upload = $column['id_daftar_upload'];
                                                        $ket_upload = $column['ket_daftar_upload'];
                                            ?>

                                            <tr>
                                                <td width = "5%" class="text-center"><?php echo $no_urut; ?></td>
                                                <td style="display:none;" id="id<?php echo $id_upload; ?>" ><?php echo $id_upload; ?></td>
                                                <td width = "80%" id="nama<?php echo $id_upload; ?>" >
                                                    <?php 
                                                        echo $ket_upload;
                                                        if($column['filetype'] == ".pdf"){
                                                            echo ' (PDF)';
                                                        }elseif($column['filetype'] == ".doc, .docx"){
                                                            echo ' (Word)';
                                                        }
                                                        $filename = strtolower(str_replace(' ', '_', $ket_upload));
                                                    ?>
                                                
                                                </td>
                                                <td width = "5%" class="text-center">
                                                    <div>
                                                        <span title="Upload File"><label for="<?php echo $no_urut; ?>"><i class="fa fa-upload text-info"></i></label></span>
                                                        <input type="file" name="file" id="<?php echo $no_urut; ?>" style="display:none;" accept="<?php echo $column['filetype']; ?>" onchange="f_upload(this.id, '<?php echo $id_upload; ?>', '<?php echo $filename; ?>');">                                                        
                                                    </div>                                                    
                                                </td>
                                                <td width = "5%" class="text-center">
                                                    <div>
                                                        <span id="<?php echo $no_urut; ?>proses"  title="Download File">
                                                        <?php 
                                                            $sql_2 = "SELECT nama_file FROM tbl_upload_dokumen 
                                                                      WHERE npm_mahasiswa='$folder' AND id_daftar_upload='$id_upload'";                                                            
                                                            $result_2 = $mysqli->query($sql_2);

                                                            $numrow_2 = $result_2->num_rows;                                                            
                                                            if($numrow_2 > 0) {
                                                                $column_2 = $result_2->fetch_assoc();
                                                                $file_cari = $column_2['nama_file'];                                                                
                                                                if(file_exists('../../files/'.$folder.'/'.$file_cari)){
                                                                    echo 
                                                                    '<a href="aksi_download.php?id='.$folder.'&file='.$file_cari.'">
                                                                        <label>
                                                                            <i class="fa fa-download text-danger"></i>
                                                                        </label>
                                                                    </a>';
                                                                } else {
                                                                    echo '';
                                                                }
                                                            }
                                                        ?>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td width = "5%" class="text-center">
                                                    <div>
                                                        <span id="<?php echo $no_urut; ?>verif">
                                                        <?php
                                                            $sql_3 = "SELECT verifikasi FROM tbl_upload_dokumen 
                                                                      WHERE npm_mahasiswa='$folder' AND id_daftar_upload='$id_upload'";
                                                            
                                                            $result_3 = $mysqli->query($sql_3);

                                                            $numrow_3 = $result_3->num_rows;
                                          
                                                            if($numrow_3 > 0) {
                                                                $column_3 = $result_3->fetch_assoc();
                                                                if($column_3['verifikasi'] == 'B'){
                                                                    echo '<label title="Belum diverifikasi"><i class="fa fa-check-circle text-basic"></i></label>';
                                                                } elseif($column_3['verifikasi'] == 'S'){
                                                                    echo '<label title="Telah diterima"><i class="fa fa-check-circle text-success"></i></label>';
                                                                } else {
                                                                    echo '<label title="Telah ditolak"><i class="fa fa-times-circle text-danger"></i></label>';
                                                                }
                                                            } 
                                                        ?>
                                                        </span>  
                                                    </div>
                                                </td>
                                            </tr>

                                            <?php
                                                        $no_urut++;
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <?php
                                    $sql_3 = "SELECT verifikasi FROM tbl_upload_dokumen 
                                              WHERE npm_mahasiswa='$folder'";
                                    $result_3 = $mysqli->query($sql_3);

                                    $numrow_3 = $result_3->num_rows;
                                    $x=1;
                                    while($column_3 = $result_3->fetch_assoc()){
                                        if($column_3['verifikasi'] != 'S'){
                                            $verified = false;
                                            break;
                                        } else {
                                            $verified = true;
                                        } 
                                        $x++;                                                                            
                                    }                                                     
                                    if($verified == true){
                                        echo '
                                        <div id="btn-download" class="row">
                                            <div class="col-sm-6 text-right">
                                                <a href="../../pdf/bebas_tanggungan.php?id='.$folder.'">
                                                    <button class="btn btn-sm btn-success" type="button" id="file1" >
                                                        Surat Keterangan Bebas Pinjaman/Tanggungan
                                                    </button>
                                                </a>
                                            </div>
                                            <div class="col-sm-6 text-left">
                                                <a href="../../pdf/bebas_pustaka.php?id='.$folder.'">
                                                    <button class="btn btn-sm btn-success" type="button" id="file2" >
                                                        Surat Keterangan Bebas Pustaka
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                        ';        
                                    }     
                                ?>                           
                            </div>
                        </div>
                    </div>

                    <script>
                        $('#judul_skripsi').focus();

                        function f_upload(id_element, get_id, get_nama){
                            var id = get_id;
                            var nama = get_nama.toLowerCase();
                            var uploader = <?php echo $_SESSION[username]?>;
                            var files = document.getElementById(id_element);
                            for (var x = 0; x < files.length; x++){                                
                                var namaFile = files.files[0].name;
                            };                            
                            
                            var form_data = new FormData();
                            form_data.append("file", files.files[0]);
                            form_data.append("fileid", id);
                            form_data.append('filename', nama);
                            form_data.append('username', uploader);
                            
                            $.ajax({
                                url: "aksi_upload.php",
                                method: "POST",
                                data: form_data,
                                contentType: false,
                                cache: false,
                                processData: false,
                                beforeSend:function(){
                                    document.getElementById(id_element+'proses').innerHTML = "<label class='text-success'>Proses upload...</label>";
                                },
                                success:function(data){
                                    toastr.success("Data telah disimpan, Anda berhasil menyimpan data.", "Pesan Berhasil", 3000);
                                    $('#'+id_element+'proses').html(data);
                                    $('#'+id_element+'verif').html("<label><i class='fa fa-check-circle text-basic'></i></label>");
                                }
                            });                            
                        }                                            
                    </script>

<?php 
include "../footer.php";
?>