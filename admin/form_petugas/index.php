<?php
session_start();
error_reporting(0);
$page = "Master Data Petugas";

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
                                            Tambah Data Petugas
                                        </div>
                                        <div class="col text-right">
                                            <button data-toggle="collapse" data-target="#baru" class="btn btn-sm"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>                                        
                                </div>
                                <div class="card-body">
                                    <form method="post" action="aksi_petugas.php?aksi=insert" autocomplete="off" id="in-form">
                                        <div class="form-group row">
                                            <label for="nip" class="col-sm-2 col-form-label text-right font-weight-bold">NIP / NIK</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="nip" id="nip" placeholder="NIP / NIK" required onkeydown="return f_cekenter(this, event)" tabIndex="1">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="nama" class="col-sm-2 col-form-label text-right font-weight-bold">NAMA</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="nama" placeholder="Nama" required onkeydown="return f_cekenter(this, event)" tabIndex="2">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="jabatan" class="col-sm-2 col-form-label text-right font-weight-bold">JABATAN</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="jabatan" placeholder="Jabatan" required tabIndex="3">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-4">
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
                                        Data Petugas
                                    </div>
                                    <div id="add-btn-div" class="col text-right">
                                        <button id="showBaru" class="btn btn-sm btn-success"><i class="fa fa-plus"></i><span> Tambah Data</span></button>
                                    </div>
                                </div>                                                                
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-sm" id="dataTable" style="width:100%" cellspacing="0">
                                        <thead class="text-center">
                                            <tr>
                                                <th>NO.</th>
                                                <th>NIP / NIK</th>
                                                <th>NAMA</th>
                                                <th>JABATAN</th>
                                                <th>AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>                                        
                                            <?php                                            
                                                $sql = "SELECT id_pegawai, username, nm_pegawai, nip_pegawai, jabatan FROM tbl_pegawai ORDER BY nm_pegawai ASC";
                                                $result = $mysqli->query($sql);
                            
                                                $numrow = $result->num_rows;
                                                
                                                if($numrow > 0) {
                                                    $no_urut = 1;
                                                    while($column = $result->fetch_assoc()) {
                                            ?>
                                                        <tr>
                                                            <td class="text-center" width=5%><?php echo $no_urut; ?></td>
                                                            <td width=15%><?php echo $column['nip_pegawai']; ?></td>
                                                            <td width=45%><?php echo $column['nm_pegawai']; ?></td>
                                                            <td width=15%><?php echo $column['jabatan']; ?></td>
                                                            <td class="text-center" width=20%>
                                                                <button type="button" id="showEdit" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#Edit<?php echo $column['id_pegawai']; ?>"><i class="fa fa-edit"></i><span> Edit</span></button>
                                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#Delete<?php echo $column['id_pegawai']; ?>"><i class="fa fa-trash"></i><span> Hapus</span></button>                                                                
                                                            </td>
                                                        </tr>   

                                                        <!-- Modal Edit -->
                                                        <div class="modal fade" id="Edit<?php echo $column['id_pegawai']; ?>" role="dialog">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Edit Data</h4>
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    </div>
                                                                    <form method="post" action="aksi_petugas.php?aksi=update" autocomplete="off" id="up-form<?php echo $column['id_pegawai']; ?>">
                                                                        <div class="modal-body">                                                                        
                                                                            <?php
                                                                                $id = $column['nip_pegawai'];
                                                                                $sql_2 = "SELECT id_pegawai, username, nm_pegawai, nip_pegawai, jabatan FROM tbl_pegawai WHERE nip_pegawai='$id'";
                                                                                $result_2 = $mysqli->query($sql_2);
                                                                                while ($col = $result_2->fetch_array()) {  
                                                                            ?>
                                                                            <div class="form-group row">
                                                                                <label for="nip" class="col-sm-4 col-form-label text-right font-weight-bold">NIP / NIK</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" class="form-control" name="nip" value="<?php echo $col['nip_pegawai']; ?>" placeholder="NIP / NIK" readonly required onkeydown="return f_cekenter(this, event)" tabIndex="1">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label for="nama" class="col-sm-4 col-form-label text-right font-weight-bold">NAMA</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" class="nama form-control" name="nama" value="<?php echo $col['nm_pegawai']; ?>" placeholder="Nama" required onkeydown="return f_cekenter(this, event)" tabIndex="2">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group row">
                                                                                <label for="jabatan" class="col-sm-4 col-form-label text-right font-weight-bold">JABATAN</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" class="form-control" name="jabatan" value="<?php echo $col['jabatan']; ?>" placeholder="Jabatan" required tabIndex="3">
                                                                                </div>
                                                                            </div>
                                                                            <?php 
                                                                                };
                                                                            ?>                                                                                                                                   
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button class="btn btn-sm btn-primary" type="submit" form="up-form<?php echo $column['id_pegawai']; ?>"><i class="fa fa-save"></i><span> Simpan</span></button>
                                                                            <button type="button" class="btn btn-sm" data-dismiss="modal"><i class="fa fa-times"></i><span> Batal</span></button>
                                                                        </div>
                                                                    </form>                                                                                                                                                
                                                                </div>
                                                            </div>                                                            
                                                        </div>

                                                        <!-- Modal Delete -->
                                                        <div class="modal fade" id="Delete<?php echo $column['id_pegawai']; ?>" role="dialog">                                                            
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Konfirmasi Hapus</h4>
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <p>Apakah Anda yakin akan menghapus data ini "<?php echo $column['nip_pegawai']; ?>" ?</p>                    
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <form method="post" action="aksi_petugas.php?aksi=delete" autocomplete="off">                                                                            
                                                                            <input type="hidden" name="id" value="<?php echo $column['id_pegawai']; ?>">
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
                    
                    <script type="text/javascript">                        
                        $(document).ready(function(){
                            $("#showBaru").click(function(){
                                $("#baru").collapse('show');
                                $("#nip").select();
                            })
                        });  

                        $('.modal').on('shown.bs.modal', function(){
                            // $('#nama', this).focus();
                            $('.nama', this).select();
                        });

                        $('.modal').on('hidden.bs.modal', function () {
                            $(this).find('form').trigger('reset');
                        })
                    </script>   


                
<?php 
include "../footer.php";
?>