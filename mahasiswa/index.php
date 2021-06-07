<?php
session_start();
error_reporting(0);
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
                    <h3>
                        Selamat Datang <?php echo $_SESSION['nama']; ?>
                    </h3>
<?php 
include "footer.php";
?>