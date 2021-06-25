<?php
session_start();
error_reporting(0);
$page = "Laporan Tahunan";

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
                                        Laporan Tahunan
                                    </div>                                    
                                </div>                                                                
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <div class="filter">
                                        <div class="row">
                                            <label for="id_fakultas" class="col-sm-2 col-form-label-sm text-right font-weight-bold">Pilih Tahun Laporan</label>
                                            <div class="col-sm-2">
                                                <select class="id_fakultas form-control form-control-sm" name='tahun'>
                                                    <?php 
                                                        for($i=date('Y'); $i>=date('Y')-32; $i-=1){
                                                            echo "<option value='$i'> $i </option>";
                                                        }                                               
                                                    ?>
                                                </select>
                                            </div>
                                        </div>                                        
                                    </div>
                                    <table class="table table-bordered table-striped table-sm" id="dataTable" width="100%" cellspacing="0">
                                        <thead class="text-center">
                                            <tr>
                                                <th>NO.</th>
                                                <th>NPM MAHASISWA</th>
                                                <th>NO. SURAT</th>
                                                <th>TGL. SURAT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                $sql = "SELECT npm_mahasiswa, no_surat_keluar, tgl_surat_keluar, nm_file FROM tbl_surat_keluar 
                                                        ORDER BY no_surat_keluar ASC";
                                                $result = $mysqli->query($sql);
                            
                                                $numrow = $result->num_rows;
                                                
                                                if($numrow > 0) {
                                                    $no_urut = 1;
                                                    while($column = $result->fetch_assoc()) {
                                            ?>
                                                        <tr>
                                                            <td class="text-center" width=5%><?php echo $no_urut; ?></td>
                                                            <td width=45%><?php echo $column['npm_mahasiswa']; ?></td>
                                                            <td width=30%><?php echo $column['no_surat_keluar']; ?></td>
                                                            <td width=20%><?php echo $column['tgl_surat_keluar']; ?></td>
                                                        </tr>
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