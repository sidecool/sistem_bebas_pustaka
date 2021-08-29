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
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-4 d-flex">
                                <div class="card flex-fill">
                                    <div class="card-header container-fluid">
                                        <div class="row">
                                            <div class="col">
                                                <i class="fas fa-table mr-1"></i>
                                                Daftar Informasi
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="tbl_info" class="table table-bordered table-striped table-sm" width="100%" cellspacing="0">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th style="width: 10px">No.</th>
                                                        <th style="display:none;">ID</th>
                                                        <th>Judul</th>
                                                        <th style="display:none;">Informasi</th>
                                                        <th style="width: 50px">Aksi</th>                                                        
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $sql = "SELECT id_informasi, judul_informasi, isi_informasi, is_aktif FROM tbl_informasi ORDER BY id_informasi DESC";
                                                        $result = $mysqli->query($sql);
                                                        
                                                        if($result->num_rows > 0){
                                                            $no_urut = 1;
                                                            while($column = $result->fetch_assoc()) {                                                                
                                                                echo '
                                                                    <tr>
                                                                        <td class="text-center">'.$no_urut.'</td>
                                                                        <td style="display:none;">'.$column[id_informasi].'</td>
                                                                        <td>'.$column[judul_informasi].'</td>
                                                                        <td style="display:none;">'.$column[isi_informasi].'</td>
                                                                        <td class="text-center">';                       
                                                                            if($column[is_aktif]=="T"){ echo '
                                                                                                            <span title="Aktifkan" class="aktif">
                                                                                                                <label><i class="fa fa-check-circle text-primary" style="cursor: pointer"></i></label>
                                                                                                            </span>
                                                                                                        ';};
                                                                echo '
                                                                            <span title="Hapus" class="hapus">
                                                                                <label><i class="fa fa-trash text-danger" style="cursor: pointer"></i></label>
                                                                            </span>
                                                                        </td>
                                                                    </tr>
                                                                ';
                                                                $no_urut++;
                                                            }
                                                        }
                                                    ?>                                                
                                                </tbody>                                        
                                            </table>
                                            <div id="btn-print" style="display: none; margin: 10px 0px 10px 0px;"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm d-flex">
                                <div class="card flex-fill">
                                    <div class="card-header container-fluid">
                                        <div class="row">
                                            <div class="col">
                                                <i class="fas fa-table mr-1"></i>
                                                Daftar Informasi
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <form action="aksi_pengumuman.php?aksi=insert" method="post" autocomplete="off">
                                            <div class="row">
                                                <!-- <label for="id" class="col-sm-2 col-form-label-sm text-left font-weight-bold">ID INFORMASI</label> -->
                                                <div class="col-sm-10">
                                                    <input id="id" type="hidden" class="form-control form-control-sm " name="id" placeholder="ID INFORMASI">
                                                </div>
                                            </div>                                
                                            <div class="row">
                                                <label for="judul" class="col-sm-2 col-form-label-sm text-left font-weight-bold">JUDUL INFORMASI</label>
                                                <div class="col-sm-10">
                                                    <input id="judul" type="text" class="form-control form-control-sm " name="judul" placeholder="JUDUL INFORMASI" required tabIndex="1">
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
                            </div>                                                
                        </div>
                    </div>                                       


<?php 
include "../footer.php";
?>

<script>
    var dataTable = $("#tbl_info").dataTable({
        dom: 'ltp',
        "language": {
            "infoFiltered": '',
            "EmptyTable": 'Tidak ada data di database',
            "zeroRecords": "Tidak ada data yang ditampilkan"
        }
    });   
    
    $(document).ready(function() {
        var table = $('#tbl_info').DataTable();
        
        $('#tbl_info tbody').on('dblclick', 'tr', function () {
            var data = table.row( this ).data();                        
            var id = data[1];
            var judul = data[2];
            var isi = data[3];            
            document.getElementById('id').value = id;
            document.getElementById('judul').value = judul;
            tinymce.get("editor1").setContent(isi);
        } );
        
        $('#tbl_info').on('click', '.aktif', function () {
            var currentRow=$(this).closest("tr");
            var id = currentRow.find("td:eq(1)").text();
            $.ajax({
                type: "POST",
                url: "aksi_pengumuman.php?aksi=update",
                data: {id: id},
                cache: false,
                success: function(msg){
                    window.location.href=window.location.href;
                }
            });  
        } );

        $('#tbl_info').on('click', '.hapus', function () {
            var currentRow=$(this).closest("tr");
            var id = currentRow.find("td:eq(1)").text();
            $.ajax({
                type: "POST",
                url: "aksi_pengumuman.php?aksi=delete",
                data: {id: id},
                cache: false,
                success: function(msg){
                    window.location.href=window.location.href;
                }
            });
        } );
    } );
    
    
</script>

<script>
tinymce.init({
    selector: 'textarea#editor1',
    skin: 'bootstrap',
    // plugins: 'lists, link, image, media code',
    toolbar_mode: 'wrap',
    toolbar: 'undo redo | fontselect fontsizeselect styleselect | forecolor | bold italic underline | alignleft aligncenter alignright alignjustify | outdent indent | link image media | code',
    menubar: false,
    branding: false,
    
    images_upload_url: 'postAcceptor.php'       
});
</script>