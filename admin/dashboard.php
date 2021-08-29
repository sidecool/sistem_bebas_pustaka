<?php
session_start();
// error_reporting(0);
$page = "Dashboard";

include '../config/route.php';
include '../config/database.php';

// Keamanan
if($_SESSION['status']!='masuk') {
    session_destroy();
    header('location:index.php');
} 

include "header.php";
?>                                                                                    
                    <div class="container-fluid">
                        <div class="row">
                            <?php 
                                $sql = "SELECT DISTINCT A.npm_mahasiswa, B.nm_mahasiswa 
                                        FROM tbl_upload_dokumen A LEFT OUTER JOIN tbl_mahasiswa B ON A.npm_mahasiswa=B.npm_mahasiswa 
                                        WHERE A.verifikasi = 'B' ORDER BY A.tgl_upload ";
                                $result = $mysqli->query($sql);
                                if($result->num_rows > 0) {                                    
                            ?>
                                    <div class="col-sm d-flex">
                                        <div class="card flex-fill">
                                            <div class="card-header">
                                                Daftar Pengajuan Dokumen Bebas Pustaka Mahasiswa
                                            </div>
                                            <div class="card-body">
                                            <?php
                                                $i = 1;                                                 
                                                while($data = $result->fetch_assoc()){
                                                    echo '<a href="'.$baseurl.'/admin/form_bebas_pustaka/?npm='.$data[npm_mahasiswa].'" 
                                                        class="nav-link active"> '.$i.') ['.$data[npm_mahasiswa].'] '.$data[nm_mahasiswa].'</a>';
                                                    $i++;
                                                } 
                                            ?>
                                            </div>                                    
                                        </div>
                                    </div>          
                            <?php
                                }
                            ?>                            
                        </div>
                    </div>                 
<?php 
include "footer.php";
?>    