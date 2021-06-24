$(".btn-terima").click(function(){
    var konfirmasi = confirm("Apakah Anda sudah yakin akan menerima data ini?");
    if(konfirmasi == true){
        var id = $(this).attr("data-id");
        var filename = $(this).attr("data-file");
        var uploader = $(this).attr("data-user");
        var verif = document.getElementById(id+"verif");
        var table = document.getElementById("uploadTable");
        var totalRowCount = table.rows.length; 
        var tbodyRowCount = table.tBodies[0].rows.length;
        
        $.ajax({
            url: "aksi_verif.php?v=terima",
            method: "POST",
            data: {
                id: id,
                uploader: uploader
            },
            success: function(){
                toastr.success("Status Dokumen telah diterima.", "Pesan Berhasil", 3000);
                verif.innerHTML = '<span title="Diterima"><label><i class="fa fa-check-circle text-success"></i></label></span>  <span title="Ditolak"><label><i class="fa fa-times-circle text-basic"></i></label></span>';
                
                var status = false;
                for(let i=1; i<=tbodyRowCount; i++){
                    if(document.getElementById("btn-terima"+i)){
                        status = true;
                        break;
                    }
                }
                if(status==false){
                    var x = document.getElementById("btn-all");
                    x.style.display = "none";
                    var btnPrint = document.getElementById("btn-print");
                    btnPrint.innerHTML = '<div id="btn-download" class="row" style="width:100%;"><div class="col-sm-6 text-right"><a href="../../pdf/bebas_tanggungan.php?id='+uploader+'"><button class="btn btn-sm btn-success" type="button" id="file1" >Surat Keterangan Bebas Pinjaman/Tanggungan</button></a></div><div class="col-sm-6 text-left"><a href="../../pdf/bebas_pustaka.php?id='+uploader+'"><button class="btn btn-sm btn-success" type="button" id="file2" >Surat Keterangan Bebas Pustaka</button></a></div></div>';
                }
            },            
            cache: false
        });
    }    
});

$(".btn-terima-all").click(function(){
    var konfirmasi = confirm("Apakah Anda sudah yakin akan menerima semua data ini?");
    if(konfirmasi == true){
        var uploader = document.getElementById('npm_mahasiswa').value;
        var table = document.getElementById("uploadTable");
        var totalRowCount = table.rows.length; 
        var tbodyRowCount = table.tBodies[0].rows.length; 
        
        $.ajax({
            url: "aksi_verif.php?v=terima-all",
            method: "POST",
            data: {
                uploader: uploader
            },
            success: function(){
                toastr.success("Semua Status Dokumen telah diterima.", "Pesan Berhasil", 3000);
                for(let i=1; i<=tbodyRowCount; i++){
                    var verif = document.getElementById(i+"verif");
                    verif.innerHTML = '<span title="Diterima"><label><i class="fa fa-check-circle text-success"></i></label></span>  <span title="Ditolak"><label><i class="fa fa-times-circle text-basic"></i></label></span>';
                    var btnPrint = document.getElementById("btn-print");
                    btnPrint.innerHTML = '<div id="btn-download" class="row" style="width:100%;"><div class="col-sm-6 text-right"><a href="../../pdf/bebas_tanggungan.php?id='+uploader+'"><button class="btn btn-sm btn-success" type="button" id="file1" >Surat Keterangan Bebas Pinjaman/Tanggungan</button></a></div><div class="col-sm-6 text-left"><a href="../../pdf/bebas_pustaka.php?id='+uploader+'"><button class="btn btn-sm btn-success" type="button" id="file2" >Surat Keterangan Bebas Pustaka</button></a></div></div>';
                };
                var x = document.getElementById("btn-all");
                x.style.display = "none";                
            },
            cache: false
        });        
    }    
});

$(".btn-tolak").click(function(){
    var konfirmasi = confirm("Apakah Anda sudah yakin akan menolak data ini?");
    if(konfirmasi == true){
        var id = $(this).attr("data-id");
        var filename = $(this).attr("data-file");
        var uploader = $(this).attr("data-user");
        var verif = document.getElementById(id+"verif");
        var table = document.getElementById("uploadTable");
        var totalRowCount = table.rows.length; 
        var tbodyRowCount = table.tBodies[0].rows.length;        
        
        $.ajax({
            url: "aksi_verif.php?v=tolak",
            method: "POST",
            data: {
                id: id,
                uploader: uploader
            },
            success: function(){
                toastr.error("Status Dokumen telah ditolak.", "Pesan Berhasil", 3000);
                verif.innerHTML = '<span title="Diterima"><label><i class="fa fa-check-circle text-basic"></i></label></span>  <span title="Ditolak"><label><i class="fa fa-times-circle text-danger"></i></label></span>';
                
                var status = false;
                for(let i=1; i<=tbodyRowCount; i++){
                    if(document.getElementById("btn-terima"+i)){
                        status = true;
                        break;
                    }
                }
                if(status==false){
                    var x = document.getElementById("btn-all");
                    x.style.display = "none";    
                }
            },
            cache: false        
        });
    }
});

$(".btn-tolak-all").click(function(){
    var konfirmasi = confirm("Apakah Anda sudah yakin akan menolak semua data ini?");
    if(konfirmasi == true){
        var uploader = document.getElementById('npm_mahasiswa').value;
        var table = document.getElementById("uploadTable");
        var totalRowCount = table.rows.length; 
        var tbodyRowCount = table.tBodies[0].rows.length; 
        
        $.ajax({
            url: "aksi_verif.php?v=tolak-all",
            method: "POST",
            data: {
                uploader: uploader
            },
            success: function(){
                toastr.error("Semua Status Dokumen telah ditolak.", "Pesan Berhasil", 3000);
                for(let i=1; i<=tbodyRowCount; i++){
                    var verif = document.getElementById(i+"verif");
                    verif.innerHTML = '<span title="Diterima"><label><i class="fa fa-check-circle text-basic"></i></label></span>  <span title="Ditolak"><label><i class="fa fa-times-circle text-danger"></i></label></span>';                    
                };
                var x = document.getElementById("btn-all");
                x.style.display = "none";                
            },
            cache: false        
        });
    }
});