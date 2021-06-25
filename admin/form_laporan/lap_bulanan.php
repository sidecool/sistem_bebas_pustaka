<?php
session_start();
error_reporting(0);
$page = "Laporan Bulanan";

include '../../config/route.php';
include "../../config/database.php";

// Keamanan
if($_SESSION['status']!="masuk") {
    header("location:../logout.php");
}

include "../header.php";
?>
                    <div class="filter">
                        <div class="row">
                            <label for="filter_bulan" class="col-sm-3 col-form-label-sm text-right font-weight-bold">Pilih Bulan dan Tahun Laporan</label>
                            <div class="col-sm-2">
                                <select class="filter_tahun form-control form-control-sm" name="bulan" id="bulan">
                                    <option value="01">Januari</option>
                                    <option value="02">Februari</option>
                                    <option value="03">Maret</option>
                                    <option value="04">April</option>
                                    <option value="05">Mei</option>
                                    <option value="06">Juni</option>
                                    <option value="07">Juli</option>
                                    <option value="08">Agustus</option>
                                    <option value="09">September</option>
                                    <option value="10">Oktober</option>
                                    <option value="12">November</option>
                                    <option value="12">Desember</option>
                                </select>
                            </div>
                            <div class="col-sm-1">
                                <select class="filter_tahun form-control form-control-sm" name="tahun" id="tahun">
                                    <?php 
                                        for($i=date('Y'); $i>=date('Y')-32; $i-=1){
                                            echo "<option value='$i'> $i </option>";
                                        }                                               
                                    ?>
                                </select>                                
                            </div>
                            <div class="col-sm-2">
                                <button type="button" name="filter" id="filter" class="btn btn-sm btn-info">Tampilkan Data</button>
                            </div>
                        </div>                                        
                    </div>
                    
                    <div id="TabelData" style="display:none;">
                        <div class="card mb-4">
                            <div class="card-header container-fluid">
                                <div class="row">
                                    <div class="col">
                                        <i class="fas fa-table mr-1"></i>
                                        Laporan Bulanan
                                    </div>                                    
                                </div>                                                                
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">                                    
                                    <table id="TabelLaporan" class="table table-bordered table-striped table-sm" width="100%" cellspacing="0">
                                        <thead class="text-center">
                                            <tr>
                                                <th>NO.</th>                                                
                                                <th>NO. SURAT</th>
                                                <th>TGL. SURAT</th>
                                                <th>NPM MAHASISWA</th>
                                                <th>KETERANGAN</th>
                                            </tr>
                                        </thead>                                        
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <script>
                        $('.input-group.date').datepicker({
                            format: "MM yyyy",
                            startView: 1,
                            minViewMode: 1,
                            language: "id",
                            forceParse: false,
                            autoclose: true
                        });

                        $("#filter").click(function(){
                            var bulan = document.getElementById("bulan").value;
                            var tahun = document.getElementById("tahun").value;
                            var tabel = $("#TabelLaporan").dataTable();
                            
                            $("#TabelLaporan").DataTable().clear().draw();
                            $("#TabelLaporan").DataTable().destroy();
                            tabel.DataTable({
                                "processing" : true,                                        
                                "language": {
                                    "infoFiltered": '',
                                    "EmptyTable": 'Tidak ada data di database',
                                    "zeroRecords": 'Tidak ada data yang ditampilkan'
                                },
                                "order" : [],                                
                                "ajax" : {
                                    url:"get_laporan.php?f=bulan",
                                    type:"POST",
                                    data:{
                                        f_bulan: bulan,
                                        f_tahun: tahun                                        
                                    },                                    
                                },
                                "dom": 'lBftpi',
                                "buttons": [
                                    'copy', 'csv', 'excel', 'pdf', 'print'
                                ]                                 
                            });
                            document.getElementById('TabelData').style.display = "block";
                        });
                    </script>
<?php 
include "../footer.php";
?>