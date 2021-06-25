<?php
session_start();
error_reporting(0);
$page = "Laporan Bulanan";

include '../../config/route.php';
include "../../config/database.php";

// Keamanan
if($_SESSION['status']!="masuk") {
    header("location:../logout.php");
}

include "../header.php";
?>
                    <div id="TabelData">
                        <div class="card mb-4">
                            <div class="card-header container-fluid">
                                <div class="row">
                                    <div class="col">
                                        <i class="fas fa-table mr-1"></i>
                                        Data Jurusan
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
                                                <th>NAMA JURUSAN</th>
                                                <th>NAMA FAKULTAS</th>
                                                <th>AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $sql = "SELECT A.id_fakultas, A.id_jurusan, A.nm_jurusan, B.nm_fakultas FROM tbl_jurusan A 
                                                        LEFT JOIN tbl_fakultas B ON A.id_fakultas=B.id_fakultas ORDER BY nm_fakultas, nm_jurusan ASC";
                                                $result = $mysqli->query($sql);
                            
                                                $numrow = $result->num_rows;
                                                
                                                if($numrow > 0) {
                                                    $no_urut = 1;
                                                    while($column = $result->fetch_assoc()) {
                                            ?>
                                                        <tr>
                                                            <td class="text-center" width=5%><?php echo $no_urut; ?></td>
                                                            <td width=45%><?php echo $column['nm_jurusan']; ?></td>
                                                            <td width=30%><?php echo $column['nm_fakultas']; ?></td>
                                                            <td class="text-center" width=20%>
                                                                <button type="button" id="showEdit" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#Edit<?php echo $column['id_fakultas'].'-'.$column['id_jurusan']; ?>"><i class="fa fa-edit"></i><span> Edit</span></button>
                                                                <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#Delete<?php echo $column['id_fakultas'].'-'.$column['id_jurusan']; ?>"><i class="fa fa-trash"></i><span> Hapus</span></button>
                                                            </td>
                                                        </tr>   

                                                        <!-- Modal Edit -->
                                                        <div class="modal fade" id="Edit<?php echo $column['id_fakultas'].'-'.$column['id_jurusan']; ?>" role="dialog">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Edit Data Jurusan</h4>
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    </div>
                                                                    <form method="post" action="aksi_jurusan.php?aksi=update" autocomplete="off" id="up-form<?php echo $column['id_fakultas'].'-'.$column['id_jurusan']; ?>">                                                                        
                                                                        <div class="modal-body">
                                                                            <?php
                                                                                $id_fakultas = $column['id_fakultas'];
                                                                                $id_jurusan = $column['id_jurusan'];
                                                                                $sql_2 = "SELECT A.id_fakultas, A.id_jurusan, A.nm_jurusan, B.nm_fakultas FROM tbl_jurusan A 
                                                                                          LEFT JOIN tbl_fakultas B ON A.id_fakultas=B.id_fakultas 
                                                                                          WHERE A.id_fakultas='$id_fakultas' AND A.id_jurusan='$id_jurusan'";
                                                                                $result_2 = $mysqli->query($sql_2);
                                                                                while ($col = $result_2->fetch_assoc()) {  
                                                                            ?>
                                                                            <div class="row">
                                                                                <label for="id_fakultas_edit" class="col-sm-4 col-form-label-sm text-right font-weight-bold">NAMA FAKULTAS</label>
                                                                                <div class="col-sm-8">
                                                                                    <select class="form-control form-control-sm" name="id_fakultas" id="id_fakultas<?php echo $col['id_fakultas'].'-'.$col['id_jurusan']; ?>" placeholder="Nama Fakultas" readonly required onkeydown="return f_cekenter(this, event)" tabIndex="1">
                                                                                        <option value="<?php echo $col['id_fakultas']; ?>"><?php echo $col['nm_fakultas']; ?></option>';                                                                                        
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            <div class="row">
                                                                                <label for="id_jurusan" class="col-sm-4 col-form-label-sm text-right font-weight-bold">KODE JURUSAN</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" class="form-control form-control-sm" name="id_jurusan" value="<?php echo $col['id_jurusan']; ?>" placeholder="ID Jurusan" readonly required onkeydown="return f_cekenter(this, event)" tabIndex="2">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row">
                                                                                <label for="nama" class="col-sm-4 col-form-label-sm text-right font-weight-bold">NAMA JURUSAN</label>
                                                                                <div class="col-sm-8">
                                                                                    <input type="text" class="nama form-control form-control-sm" name="nama" value="<?php echo $col['nm_jurusan']; ?>" placeholder="Nama Jurusan" required tabIndex="3">
                                                                                </div>
                                                                            </div>
                                                                            <?php 
                                                                                };
                                                                            ?>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button class="btn btn-sm btn-primary" type="submit" form="up-form<?php echo $column['id_fakultas'].'-'.$column['id_jurusan']; ?>"><i class="fa fa-save"></i><span> Simpan</span></button>
                                                                            <button type="button" class="btn btn-sm" data-dismiss="modal"><i class="fa fa-times"></i><span> Batal</span></button>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!-- Modal Delete -->
                                                        <div class="modal fade" id="Delete<?php echo $column['id_fakultas'].'-'.$column['id_jurusan']; ?>" role="dialog">                                                            
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Konfirmasi Hapus</h4>
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        <p>Apakah Anda yakin akan menghapus data ini "<?php echo $column['id_fakultas'].'-'.$column['id_jurusan']; ?>" ?</p>                    
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <form method="post" action="aksi_jurusan.php?aksi=delete" autocomplete="off">
                                                                            <input type="hidden" name="id_fakultas" value="<?php echo $column['id_fakultas']; ?>">
                                                                            <input type="hidden" name="id_jurusan" value="<?php echo $column['id_jurusan']; ?>">
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
<?php 
include "../footer.php";
?>