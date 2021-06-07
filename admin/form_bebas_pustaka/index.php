<?php
session_start();
error_reporting(0);
$page = "Pengajuan Bebas Pustaka";

include '../../config/route.php';
include "../../config/database.php";

// Keamanan
if($_SESSION['status']!="masuk") {
    header("location:../logout.php");
}

include "../header.php";
?>
                        <div id="InfoForm">
                            <div class="card mb-4">
                                <div class="card-header container-fluid">
                                    <div class="row">
                                        <div class="col">
                                            <i class="fas fa-table mr-1"></i>
                                            Informasi Dokumen
                                        </div>                                                                                
                                    </div>                                    
                                </div>
                                <div class="card-body">
                                    <form method="post" action="" autocomplete="off" id="in-form">                                        
                                        <div class="form-group row">
                                            <label for="npm_mahasiswa" class="col-sm-4 col-form-label text-right font-weight-bold">NPM MAHASISWA</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control" name="npm_mahasiswa" id="npm_mahasiswa" placeholder="NPM Mahasiswa" readonly required onkeydown="return f_cekenter(this, event)" tabIndex="3">
                                            </div>                                            
                                            <div class="col-sm-2">
                                                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#ModalNPM" id="btnCari"><b>Cari </b><i class="fa fa-search"></i></button>
                                            </div>
                                        </div>
                                        <!-- ModalNPM -->
                                        <div class="modal fade" id="ModalNPM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" style="width:800px">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title" id="myModalLabel">Pencarian Mahasiswa</h4>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>                                                        
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <div class="form-group row">
                                                                    <label for="id_fakultas" class="col-sm-4 col-form-label text-right font-weight-bold">FAKULTAS</label>
                                                                    <div class="col-sm-8">
                                                                        <select class="id_fakultas form-control" name="id_fakultas" placeholder="Nama Fakultas" required onkeydown="return f_cekenter(this, event)" tabIndex="1"></select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="id_jurusan" class="col-sm-4 col-form-label text-right font-weight-bold">JURUSAN / PROGRAM STUDI</label>
                                                                    <div class="col-sm-8">
                                                                        <select class="id_jurusan form-control" name="id_jurusan" placeholder="Nama Jurusan" required onkeydown="return f_cekenter(this, event)" tabIndex="2">
                                                                            <option value="">- PILIH JURUSAN / PROGRAM STUDI -</option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group row">
                                                                    <label for="button" class="col-sm-4"></label>
                                                                    <div class="col-sm-8">
                                                                        <button type="button" name="filter" id="filter" class="btn btn-info">Tampilkan Data</button>
                                                                    </div>
                                                                </div>
                                                            </div>                                                            
                                                        </div>
                                                        <table id="lookup" class="table table-bordered table-hover table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>NPM</th>
                                                                    <th>Nama Mahasiswa</th>                                                                    
                                                                </tr>
                                                            </thead>                                                            
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- End ModalNPM -->
                                        <!-- <div class="detail_body"></div> -->
                                    </form>
                                </div>
                            </div>
                        </div>
                    
                    
                    <div id="TabelData">
                        <div class="card mb-4">
                            <div class="card-header container-fluid">
                                <div class="row">
                                    <div class="col">
                                        <i class="fas fa-table mr-1"></i>
                                        Upload Dokumen
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped table-sm" id="uploadTable" width="100%" cellspacing="0">
                                        <thead class="text-center">
                                            <tr>
                                                <th>No.</th>
                                                <th style="display:none;">ID</th>
                                                <th>Keterangan</th>
                                                <th>Upload</th>
                                                <th>Download</th>
                                                <th>Verifikasi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        $(document).ready(function(){
                            $(".id_fakultas").focus();
                            $.ajax({
                                type: 'POST',
          	                    url: "get_data.php?getData=fakultas",
                                cache: false, 
                                success: function(msg){
                                    $(".id_fakultas").html(msg);                                     
                                }
                            });
                            $(".id_fakultas").change(function(){
                                var fakultas = $(".id_fakultas").val();
                                $(".detail-body").remove();
                                document.getElementById('npm_mahasiswa').value = '';                               
                                $.ajax({
                                    type: 'POST',
                                    url: "get_data.php?getData=jurusan",
                                    data: {id_fakultas: fakultas},
                                    cache: false,
                                    success: function(msg){                                        
                                        $(".id_jurusan").html(msg);                                        
                                    }
                                });
                            });
                            
                            $("#btnCari").click(function(){                                
                                $(".detail-body").remove();
                                $("<div class='detail-body'></div>").insertAfter("div#ModalNPM");                                                                                                                             
                            }); 

                            function fill_datatable(fakultas = '', jurusan = ''){
                                var dataTable = $('#lookup').DataTable({
                                    "processing" : true,
                                    "serverSide" : true,
                                    "order" : [],
                                    "searching" : false,
                                    "ajax" : {
                                        url:"get_data.php?getData=modal",
                                        type:"POST",
                                        data:{
                                            filter_fakultas:fakultas, 
                                            filter_jurusan:jurusan
                                        }
                                    }
                                });
                            }
  
                            $('#filter').click(function(){
                                var fakultas = $(".id_fakultas").val();
                                var jurusan = $(".id_jurusan").val();
                                if(fakultas != '' && jurusan != ''){
                                    $('#lookup').DataTable().destroy();
                                    fill_datatable(fakultas, jurusan);
                                } else {
                                    alert('Anda belum memilih fakultas dan jurusan, silahkan pilih terlebih dahulu.');
                                    $('#lookup').DataTable().destroy();
                                    fill_datatable();
                                }
                            });                                                       
                        });

                        $(document).on('click', '.pilih', function (e) {
                            document.getElementById("npm_mahasiswa").value = $(this).attr('data-nim');
                            var npm = $("#npm_mahasiswa").val();
                            $.ajax({
                                type: 'POST',
                                url: "get_data.php?getData=detail",
                                data: {id_mahasiswa: npm},
                                cache: false,
                                success: function(msg){
                                    $(".detail-body").html(msg);
                                }
                            });
                            $('#ModalNPM').modal('hide');
                        });
                    </script>    

<?php 
include "../footer.php";
?>