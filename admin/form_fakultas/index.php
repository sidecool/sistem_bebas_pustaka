<?php
session_start();
error_reporting(0);
$page = "Master Data Fakultas";

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
                                            Tambah Data Fakultas
                                        </div>
                                        <div class="col text-right">
                                            <button data-toggle="collapse" data-target="#baru" class="btn btn-sm"><i class="fa fa-times"></i></button>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <form method="post" action="aksi_fakultas.php?aksi=insert" autocomplete="off" id="in-form">
                                        <div class="row">
                                            <label for="id_fakultas" class="col-sm-4 col-form-label-sm text-right font-weight-bold">KODE FAKULTAS</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control form-control-sm " name="id_fakultas" id="id_fakultas" placeholder="Kode Fakultas" required onkeydown="return f_cekenter(this, event)" tabIndex="1">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="nama" class="col-sm-4 col-form-label-sm text-right font-weight-bold">NAMA FAKULTAS</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control form-control-sm " name="nama" placeholder="Nama Fakultas" required tabIndex="2">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4"></div>
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
                                        Data Fakultas
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
                                                <th>NAMA FAKULTAS</th>
                                                <th>AKSI</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $sql = "SELECT id_fakultas, nm_fakultas FROM tbl_fakultas ORDER BY nm_fakultas ASC";
                                                $result = $mysqli->query($sql);
                            
                                                $numrow = $result->num_rows;
                                                
                                                if($numrow > 0) {
                                                    $no_urut = 1;
                                                    while($column = $result->fetch_assoc()) {
                                            ?>
                                            <tr>
                                                <td class="text-center" width=5%><?php echo $no_urut; ?></td>
                                                <td width=75%><?php echo $column['nm_fakultas']; ?></td>
                                                <td class="text-center" width=20%>
                                                    <button type="button" id="showEdit" class="btn btn-sm btn-primary" data-toggle="modal" data-target="#Edit<?php echo $column['id_fakultas']; ?>"><i class="fa fa-edit"></i><span> Edit</span></button>
                                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#Delete<?php echo $column['id_fakultas']; ?>"><i class="fa fa-trash"></i><span> Hapus</span></button>                                                                
                                                </td>
                                            </tr>   

                                            <!-- Modal Edit -->
                                            <div class="modal fade" id="Edit<?php echo $column['id_fakultas']; ?>" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Edit Data Fakultas</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>
                                                        <form method="post" action="aksi_fakultas.php?aksi=update" autocomplete="off" id="up-form<?php echo $column['id_fakultas']; ?>">
                                                            <div class="modal-body">                                                                        
                                                                <?php
                                                                    $id = $column['id_fakultas'];
                                                                    $sql_2 = "SELECT id_fakultas, nm_fakultas FROM tbl_fakultas WHERE id_fakultas='$id'";
                                                                    $result_2 = $mysqli->query($sql_2);
                                                                    while ($col = $result_2->fetch_array()) {  
                                                                ?>
                                                                <div class="row">
                                                                    <label for="id_fakultas" class="col-sm-4 col-form-label-sm text-right font-weight-bold">KODE FAKULTAS</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="form-control form-control-sm " name="id_fakultas" value="<?php echo $col['id_fakultas']; ?>" placeholder="ID Fakultas" readonly required onkeydown="return f_cekenter(this, event)" tabIndex="1">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <label for="nama" class="col-sm-4 col-form-label-sm text-right font-weight-bold">NAMA FAKULTAS</label>
                                                                    <div class="col-sm-8">
                                                                        <input type="text" class="nama form-control form-control-sm " name="nama" value="<?php echo $col['nm_fakultas']; ?>" placeholder="Nama Fakultas" required tabIndex="2">
                                                                    </div>
                                                                </div>
                                                                <?php 
                                                                    };
                                                                ?>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button class="btn btn-sm btn-primary" type="submit" form="up-form<?php echo $column['id_fakultas']; ?>"><i class="fa fa-save"></i><span> Simpan</span></button>
                                                                <button type="button" class="btn btn-sm" data-dismiss="modal"><i class="fa fa-times"></i><span> Batal</span></button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal Delete -->
                                            <div class="modal fade" id="Delete<?php echo $column['id_fakultas']; ?>" role="dialog">                                                            
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h4 class="modal-title">Konfirmasi Hapus</h4>
                                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        </div>

                                                        <div class="modal-body">
                                                            <p>Apakah Anda yakin akan menghapus data ini "<?php echo $column['id_fakultas']; ?>" ?</p>                    
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="post" action="aksi_fakultas.php?aksi=delete" autocomplete="off">
                                                                <input type="hidden" name="id" value="<?php echo $column['id_fakultas']; ?>">
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
                                $("#id_fakultas").select();
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