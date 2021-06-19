<?php
session_start();
error_reporting(0);
$page = "Master Data Mahasiswa";

include '../../config/route.php';
include "../../config/database.php";

// Keamanan
if($_SESSION['status']!="masuk") {
    header("location:../logout.php");
}

include "../header.php";
?>
                    <div id="accordion">
                        <div id="baru" class="collapse" data-parent="#accordion">
                            <div class="card mb-4">
                                <div class="card-header container-fluid">
                                    <div class="row">
                                        <div class="col">
                                            <i class="fas fa-table mr-1"></i>
                                            Tambah Data Mahasiswa
                                        </div>
                                        <div class="col text-right">
                                            <button type="reset" data-toggle="collapse" data-target="#baru" class="btn btn-sm"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="aksi_mahasiswa.php?aksi=insert" autocomplete="off" id="in-form">                                                                                
                                        <div class="row">
                                            <label for="npm_mahasiswa" class="col-sm-4 col-form-label-sm text-right font-weight-bold">NPM Mahasiswa</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control form-control-sm" name="npm_mahasiswa" id="npm_mahasiswa" placeholder="NPM Mahasiswa" required onkeydown="return f_cekenter(this, event)" tabIndex="1">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="nama" class="col-sm-4 col-form-label-sm text-right font-weight-bold">NAMA MAHASISWA</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control form-control-sm" name="nama" id="nama" placeholder="Nama Mahasiswa" required onkeydown="return f_cekenter(this, event)" tabIndex="2">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="id_fakultas" class="col-sm-4 col-form-label-sm text-right font-weight-bold">FAKULTAS</label>
                                            <div class="col-sm-8">
                                                <select class="id_fakultas form-control form-control-sm" name="id_fakultas" placeholder="Nama Fakultas" required onkeydown="return f_cekenter(this, event)" tabIndex="3"></select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="id_jurusan" class="col-sm-4 col-form-label-sm text-right font-weight-bold">JURUSAN / PROGRAM STUDI</label>
                                            <div class="col-sm-8">
                                                <select class="id_jurusan form-control form-control-sm" name="id_jurusan" placeholder="Nama Jurusan" required onkeydown="return f_cekenter(this, event)" tabIndex="4">
                                                    <option value="">- PILIH JURUSAN / PROGRAM STUDI -</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="alamat" class="col-sm-4 col-form-label-sm text-right font-weight-bold">ALAMAT MAHASISWA</label>
                                            <div class="col-sm-8">
                                                <textarea row="3" class="form-control form-control-sm" name="alamat" placeholder="Alamat Mahasiswa" required onkeydown="return f_cekenter(this, event)" tabIndex="5"></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="id_perpus" class="col-sm-4 col-form-label-sm text-right font-weight-bold">ID ANGGOTA PERPUSTAKAAN</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control form-control-sm" name="id_perpus" id="id_perpus" placeholder="ID Anggota Perpustakaan" required onkeydown="return f_cekenter(this, event)" tabIndex="6">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="email" class="col-sm-4 col-form-label-sm text-right font-weight-bold">EMAIL MAHASISWA</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control form-control-sm" name="email" id="email" placeholder="Email Mahasiswa" required tabIndex="7">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4"></div>
                                            <div class="col-sm-8">
                                                <button class="btn btn-sm btn-primary" type="submit" form="in-form"><i class="fa fa-save"></i><span> Simpan</span></button>
                                                <button class="btn btn-sm btn-warning" type="reset" data-toggle="collapse" data-target="#baru"><i class="fa fa-reply"></i><span> Batal</span></button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="TabelData">
                        <div class="card mb-4">
                            <div class="card-header container-fluid">
                                <div class="row">
                                    <div class="col">
                                        <i class="fas fa-table mr-1"></i>
                                        Data Mahasiswa
                                    </div>
                                    <div id="add-btn-div" class="col text-right">
                                        <button id="showBaru" class="btn btn-sm btn-success"><i class="fa fa-plus"></i><span> Tambah Data</span></button>
                                    </div>
                                </div>                                                                
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-sm" id="dataTable" width="100%" cellspacing="0">
                                        <thead class="text-center">
                                            <tr>
                                                <th>NO.</th>
                                                <th>NPM MAHASISWA</th>
                                                <th>NAMA MAHASISWA</th>
                                                <th>NAMA FAKULTAS</th>
                                                <th>NAMA JURUSAN</th>
                                                <th>AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $sql = "SELECT A.npm_mahasiswa, A.nm_mahasiswa, A.alamat, A.id_fakultas, B.nm_fakultas, A.id_jurusan, C.nm_jurusan FROM tbl_mahasiswa A 
                                                        LEFT JOIN tbl_fakultas B ON A.id_fakultas=B.id_fakultas
                                                        LEFT JOIN tbl_jurusan C ON A.id_fakultas=C.id_fakultas AND A.id_jurusan=C.id_jurusan
                                                        ORDER BY nm_mahasiswa ASC";
                                                $result = $mysqli->query($sql);
                            
                                                $numrow = $result->num_rows;
                                                
                                                if($numrow > 0) {
                                                    $no_urut = 1;
                                                    while($column = $result->fetch_assoc()) {
                                            ?>
                                                        <tr>
                                                            <td class="text-center" width=5%><?php echo $no_urut; ?></td>
                                                            <td width=15%><?php echo $column['npm_mahasiswa']; ?></td>
                                                            <td width=20%><?php echo $column['nm_mahasiswa']; ?></td>                                                        
                                                            <td width=20%><?php echo $column['nm_fakultas']; ?></td>
                                                            <td width=20%><?php echo $column['nm_jurusan']; ?></td>
                                                            <td class="text-center" width=20%>
                                                                <button type="button" id="showEdit" fakultas="<?php echo $column['id_fakultas']; ?>" jurusan="<?php echo $column['id_jurusan']; ?>" class="btn btn-sm btn-primary showEdit" data-toggle="modal" data-target="#Edit<?php echo $column['npm_mahasiswa']; ?>"><i class="fa fa-edit"></i><span> Edit</span></button>
                                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#Delete<?php echo $column['npm_mahasiswa']; ?>"><i class="fa fa-trash"></i><span> Hapus</span></button>                                                                
                                                            </td>
                                                        </tr>   

                                                        <!-- Modal Edit -->
                                                        <div class="modal fade" id="Edit<?php echo $column['npm_mahasiswa']; ?>" role="dialog">
                                                            <div class="modal-dialog modal-dialog-centered modal-lg">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Edit Data Mahasiswa</h4>
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    </div>
                                                                    <form method="post" action="aksi_mahasiswa.php?aksi=update" autocomplete="off" id="up-form<?php echo $column['npm_mahasiswa']; ?>">                                                                        
                                                                        <div class="modal-body">
                                                                            <?php
                                                                                $id_mahasiswa = $column['npm_mahasiswa'];
                                                                                
                                                                                $sql_2 = "SELECT A.npm_mahasiswa, A.nm_mahasiswa, A.alamat, A.id_fakultas, A.id_jurusan, B.nm_fakultas, C.nm_jurusan, A.id_anggota_perpus, A.email FROM tbl_mahasiswa A 
                                                                                            LEFT JOIN tbl_fakultas B ON A.id_fakultas=B.id_fakultas
                                                                                            LEFT JOIN tbl_jurusan C ON A.id_fakultas=C.id_fakultas AND A.id_jurusan=C.id_jurusan                                                                                 
                                                                                            WHERE A.npm_mahasiswa='$id_mahasiswa'";
                                                                                $result_2 = $mysqli->query($sql_2);
                                                                                while ($col = $result_2->fetch_assoc()) {  
                                                                            ?>
                                                                            <div class="row">
                                                                                <label for="npm_mahasiswa" class="col-sm-4 col-form-label-sm text-right font-weight-bold">NPM Mahasiswa</label>
                                                                                <div class="col-sm-4">
                                                                                    <input type="text" class="form-control form-control-sm" name="npm_mahasiswa" value="<?php echo $col['npm_mahasiswa']; ?>" placeholder="NPM Mahasiswa" readonly required onkeydown="return f_cekenter(this, event)" tabIndex="1">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <label for="nama" class="col-sm-4 col-form-label-sm text-right font-weight-bold">NAMA MAHASISWA</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" class="nama form-control form-control-sm" name="nama" value="<?php echo $col['nm_mahasiswa']; ?>" placeholder="Nama Mahasiswa" required onkeydown="return f_cekenter(this, event)" tabIndex="2">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <label for="id_fakultas" class="col-sm-4 col-form-label-sm text-right font-weight-bold">FAKULTAS</label>
                                                                                <div class="col-sm-8">
                                                                                    <select class="id_fakultas_edit form-control form-control-sm" name="id_fakultas" placeholder="Nama Fakultas" required onkeydown="return f_cekenter(this, event)" tabIndex="3"></select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <label for="id_jurusan" class="col-sm-4 col-form-label-sm text-right font-weight-bold">JURUSAN / PROGRAM STUDI</label>
                                                                                <div class="col-sm-8">
                                                                                    <select class="id_jurusan form-control form-control-sm" name="id_jurusan" placeholder="Nama Jurusan" required onkeydown="return f_cekenter(this, event)" tabIndex="4"></select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <label for="alamat" class="col-sm-4 col-form-label-sm text-right font-weight-bold">ALAMAT MAHASISWA</label>
                                                                                <div class="col-sm-8">
                                                                                    <textarea row="3" class="form-control form-control-sm" name="alamat" placeholder="Alamat Mahasiswa" required onkeydown="return f_cekenter(this, event)" tabIndex="5"><?php echo $col['alamat']; ?></textarea>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <label for="id_perpus" class="col-sm-4 col-form-label-sm text-right font-weight-bold">ID ANGGOTA PERPUSTAKAAN</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" class="form-control form-control-sm" name="id_perpus" value="<?php echo $col['id_anggota_perpus']; ?>" placeholder="ID Anggota Perpustakaan" required onkeydown="return f_cekenter(this, event)" tabIndex="6">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <label for="email" class="col-sm-4 col-form-label-sm text-right font-weight-bold">EMAIL MAHASISWA</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" class="form-control form-control-sm" name="email" value="<?php echo $col['email']; ?>" placeholder="Email Mahasiswa" required tabIndex="7">
                                                                                </div>
                                                                            </div>
                                                                            <?php 
                                                                                };
                                                                            ?>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button class="btn btn-sm btn-primary" type="submit" form="up-form<?php echo $column['npm_mahasiswa']; ?>"><i class="fa fa-save"></i><span> Simpan</span></button>
                                                                            <button type="button" class="btn btn-sm" data-dismiss="modal"><i class="fa fa-times"></i><span> Batal</span></button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>    
                                                        </div>

                                                        <!-- Modal Delete -->
                                                        <div class="modal fade" id="Delete<?php echo $column['npm_mahasiswa']; ?>" role="dialog">                                                            
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Konfirmasi Hapus</h4>
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <p>Apakah Anda yakin akan menghapus data ini "<?php echo $column['npm_mahasiswa']; ?>" ?</p>                    
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <form method="post" action="aksi_mahasiswa.php?aksi=delete" autocomplete="off">
                                                                            <input type="hidden" name="npm_mahasiswa" value="<?php echo $column['npm_mahasiswa']; ?>">                                                                            
                                                                            <button type="submit" class="btn btn-sm btn-danger"> Hapus</button>
                                                                        </form>
                                                                        <button type="button" class="btn btn-sm" data-dismiss="modal"><i class="fa fa-times"></i><span> Batal</span></button>
                                                                    </div>                                                                    
                                                                </div>
                                                            </div>
                                                        </div> 
                                            <?php
                                                        $no_urut++;
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>                    
                    
                    <script>
                        $(document).ready(function(){
                            $("#showBaru").click(function(){
                                $("#baru").collapse('show');
                                $("#npm_mahasiswa").focus();
                            })
                        });                        
                        
                        $('#baru').on('hidden.bs.collapse', function () {
                            $(this).find('form').trigger('reset');
                        });

                        $('.modal').on('shown.bs.modal', function(){
                            // $('#nama', this).focus();
                            $('.nama', this).select();
                        });

                        $('.modal').on('hidden.bs.modal', function () {
                            $(this).find('form').trigger('reset');
                        })
                    </script>   

                    <script>
	                    $(document).ready(function(){                            
                            $.ajax({
                                type: 'POST',
          	                    url: "aksi_mahasiswa.php?getData=fakultas",
                                cache: false, 
                                success: function(msg){
                                    $(".id_fakultas").html(msg);
                                }
                            });
                            $(".id_fakultas").change(function(){
                                var fakultas = $(".id_fakultas").val();                            
                                $.ajax({
                                    type: 'POST',
                                    url: "aksi_mahasiswa.php?getData=jurusan",
                                    data: {id_fakultas: fakultas},
                                    cache: false,
                                    success: function(msg){
                                        $(".id_jurusan").html(msg);
                                    }
                                });
                            });
                            $(".showEdit").click(function(){
                                var fakultas = $(this).attr("fakultas");
                                var jurusan = $(this).attr("jurusan");
                                $.ajax({
                                    type: 'POST',
                                    url: "aksi_mahasiswa.php?getData=fakultas",
                                    data: {id_fakultas: fakultas},
                                    cache: false, 
                                    success: function(msg){
                                        $(".id_fakultas_edit").html(msg);
                                    },                                    
                                });

                                $.ajax({
                                    type: 'POST',
                                    url: "aksi_mahasiswa.php?getData=jurusan",
                                    data: {id_fakultas: fakultas, id_jurusan: jurusan},
                                    cache: false,
                                    success: function(msg){
                                        $(".id_jurusan").html(msg);
                                    }
                                });

                                $(".id_fakultas_edit").change(function(){
                                    var fakultas = $(".id_fakultas_edit").val();
                                    $.ajax({
                                        type: 'POST',
                                        url: "aksi_mahasiswa.php?getData=jurusan",
                                        data: {id_fakultas: fakultas},
                                        cache: false,
                                        success: function(msg){
                                            $(".id_jurusan").html(msg);
                                        }
                                    });
                                });                                
                            });                                 
                        });
                    </script>
                
<?php 
include "../footer.php";
?>