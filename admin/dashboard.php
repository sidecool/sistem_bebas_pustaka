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
                                $sql = "SELECT id_informasi, isi_informasi, is_aktif 
                                        FROM tbl_informasi
                                        WHERE is_aktif='A' ";
                                $result = $mysqli->query($sql);
                                $data = $result->fetch_assoc();
                                
                                if($result->num_rows == 1) {
                                    ?>

                                    <div class="col-sm d-flex">
                                        <div class="card flex-fill">
                                            <div class="card-header">
                                                Informasi
                                            </div>
                                            <div class="card-body">
                                                <?php echo $data['isi_informasi']; ?>
                                            </div>                                    
                                        </div>
                                    </div>
                                    <?php    
                                }                                                                         
                            ?>

                            <div class="col-sm d-flex">
                                <div class="card flex-fill">
                                    <div class="card-header">
                                        Video
                                    </div>
                                    <div class="card-body">
                                        <div class="embed-responsive embed-responsive-16by9">
                                            <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/impekjT2ba8"></iframe>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>
                        </div>
                    </div>                 
<?php 
include "footer.php";
?>    