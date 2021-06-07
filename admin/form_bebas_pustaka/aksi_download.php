<?php

include '../../config/database.php';

if (isset($_GET['file'])) {
    $folder = $_GET['id'];
    $filename = $_GET['file'];    

    $location = '../../files/'.$folder;
    $download = $location.'/'.$filename;
    echo $download;
    if(file_exists($download)){
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($download));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: private');
        header('Pragma: private');
        header('Content-Length: ' . filesize($download));
        ob_clean();
        flush();
        readfile($download);
        
        echo "Ketemu";
        // exit;
    } else {
        echo "Oops! File tidak ditemukan.";
    }
}
?>