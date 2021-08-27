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
                    <div class="card mb-4">
                        <div class="card-header container-fluid">
                            <div class="row">
                                <div class="col">
                                    <i class="fas fa-table mr-1"></i>
                                    Informasi
                                </div>                                
                            </div>                                                                
                        </div>
                        <div class="card-body">
                            <form action="aksi_pengumuman.php?aksi=insert" method="post" autocomplete="off">
                                <div class="row">
                                    <label for="judul" class="col-sm-2 col-form-label-sm text-left font-weight-bold">JUDUL INFORMASI</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control form-control-sm " name="judul" placeholder="JUDUL INFORMASI" required tabIndex="1">
                                    </div>
                                </div>
                                <div class="row">
                                    <label for="editor" class="col-sm-2 col-form-label-sm text-left font-weight-bold">ISI INFORMASI</label>
                                    <div class="col-sm-10" style="padding-bottom: 10px">
                                        <textarea name="editor" id="editor1" cols="30" rows="10"></textarea>
                                    </div>                                    
                                </div>
                                <div class="row">
                                    <div class="col-sm-2"></div>
                                    <div class="col-sm-10">
                                        <button class="btn btn-sm btn-primary" type="submit"><i class="fa fa-save"></i><span> Simpan</span></button>
                                    </div>    
                                </div>
                            </form>
                        </div>
                    </div>                    


<?php 
include "../footer.php";
?>
<script>
tinymce.init({
    selector: 'textarea#editor1',
    skin: 'bootstrap',
    plugins: 'lists, link, image, media code',
    toolbar_mode: 'wrap',
    toolbar: 'undo redo | fontselect fontsizeselect styleselect | forecolor | bold italic underline | alignleft aligncenter alignright alignjustify | outdent indent | link image media | code',
    menubar: false,
    branding: false
});
</script>