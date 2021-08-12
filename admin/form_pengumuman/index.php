<?php
session_start();
error_reporting(0);
$page = "Pengumuman";

include '../../config/route.php';
include "../../config/database.php";

// Keamanan
if($_SESSION['status']!="masuk") {
    header("location:../logout.php");
}

include "../header.php";
?>
                    <div>
                        <textarea name="editor1" id="editor1" cols="30" rows="10"></textarea>
                    </div>                    
<?php 
include "../footer.php";
?>
<script>
  tinymce.init({
    selector: 'textarea#editor1',
    skin: 'bootstrap',
    plugins: 'lists, link, image, media',
    toolbar: 'h1 h2 bold italic strikethrough blockquote bullist numlist backcolor | link image media | removeformat help',
    menubar: false
  });
</script>