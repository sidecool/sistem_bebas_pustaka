$(".btn-terima").click(function(){
    var konfirmasi = confirm("Apakah Anda sudah yakin akan menerima data ini?");
    if(konfirmasi == true){
        var id = $(this).attr("data-id");
        var filename = $(this).attr("data-file");
        var uploader = $(this).attr("data-user");
        alert(id + filename + uploader);
        var icon = document.getElementById("i-tolak"+id);
        icon.classList.remove("text-danger");
        icon.classList.add("text-basic");

        $.ajax({
            url: "aksi_verif.php?v=terima",
            method: "POST",
            data: {
                id: id,
                uploader: uploader
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
        alert(id + filename + uploader);
        var icon = document.getElementById("i-terima"+id);
        icon.classList.remove("text-success");
        icon.classList.add("text-basic");
        
        $.ajax({
            url: "aksi_verif.php?v=tolak",
            method: "POST",
            data: {
                id: id,
                uploader: uploader
            },
            cache: false        
        });
    }
});