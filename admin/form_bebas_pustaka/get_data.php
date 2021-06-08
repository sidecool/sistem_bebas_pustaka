<?php

include '../../config/database.php';

$getData = $_GET[getData];

if($getData=='fakultas'){ 
    $id_fakultas = $_POST[id_fakultas];   
    echo '<option value="">- PILIH FAKULTAS -</option>';
    
    $sql = "SELECT id_fakultas, nm_fakultas FROM tbl_fakultas ORDER BY nm_fakultas ASC";
    $result = $mysqli->query($sql);
    $numrow = $result->num_rows;
    if($numrow > 0) {
        while($data = $result->fetch_assoc()) {
            if($id_fakultas == $data["id_fakultas"]) {
                echo '<option selected="selected" value="'.$data["id_fakultas"].'">'.$data["nm_fakultas"].'</option>';
            } else {
                echo '<option value="'.$data["id_fakultas"].'">'.$data["nm_fakultas"].'</option>';
            }
        }

    }
}

if($getData=='jurusan'){
    $id_fakultas = $_POST[id_fakultas];
    $id_jurusan = $_POST[id_jurusan];
    echo '<option value="">- PILIH JURUSAN / PROGRAM STUDI -</option>';

    $sql = "SELECT id_fakultas, id_jurusan, nm_jurusan FROM tbl_jurusan WHERE id_fakultas='$id_fakultas' ORDER BY nm_jurusan ASC";
    $result = $mysqli->query($sql);
    $numrow = $result->num_rows;
    if($numrow > 0) {
        while($data = $result->fetch_assoc()) {
            if($id_jurusan == $data["id_jurusan"]) {
                echo '<option selected="selected" value="'.$data["id_jurusan"].'">'.$data["nm_jurusan"].'</option>';
            } else {
                echo '<option value="'.$data["id_jurusan"].'">'.$data["nm_jurusan"].'</option>';
            }
        }
    }
}

if($getData=='detail'){
    $npm = $_POST["id_mahasiswa"];    
    $sql = "SELECT nm_mahasiswa, judul_skripsi, pembimbing_1, pembimbing_2, judul_buku_1, judul_buku_2, judul_buku_3 FROM tbl_info_dokumen WHERE npm_mahasiswa='$npm'";    
    $result = $mysqli->query($sql);
    $numrow = $result->num_rows;
    if($numrow > 0) {
        while ($data = $result->fetch_assoc()) {
            echo '<div class="form-group row">
                <label for="nama" class="col-sm-4 col-form-label text-right font-weight-bold">NAMA MAHASISWA</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="nama" id="nama" value="'.$data["nm_mahasiswa"].'" placeholder="Nama Mahasiswa" readonly required onkeydown="return f_cekenter(this, event)" tabIndex="2">
                </div>
            </div>
            <div class="form-group row">
                <label for="judul_skripsi" class="col-sm-4 col-form-label text-right font-weight-bold">JUDUL SKRIPSI</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="judul_skripsi" id="judul_skripsi" value="'.$data["judul_skripsi"].'" placeholder="Judul Skripsi" required onkeydown="return f_cekenter(this, event)" tabIndex="3">
                </div>
            </div>
            <div class="form-group row">
                <label for="pembimbing1" class="col-sm-4 col-form-label text-right font-weight-bold">DOSEN PEMBIMBING 1</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="pembimbing1" id="pembimbing1" value="'.$data["pembimbing_1"].'" placeholder="Nama Dosen Pembimbing" required onkeydown="return f_cekenter(this, event)" tabIndex="4">
                </div>
            </div>
            <div class="form-group row">
                <label for="pembimbing2" class="col-sm-4 col-form-label text-right font-weight-bold">DOSEN PEMBIMBING 2</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="pembimbing2" id="pembimbing2" value="'.$data["pembimbing_2"].'" placeholder="Nama Dosen Pembimbing" required onkeydown="return f_cekenter(this, event)" tabIndex="5">
                </div>
            </div>
            <div class="form-group row">
                <label for="judulbuku1" class="col-sm-4 col-form-label text-right font-weight-bold">JUDUL BUKU 1</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="judulbuku1" id="judulbuku1" value="'.$data["judul_buku_1"].'" placeholder="Judul Buku" required onkeydown="return f_cekenter(this, event)" tabIndex="6">
                </div>
            </div>
            <div class="form-group row">
                <label for="judulbuku2" class="col-sm-4 col-form-label text-right font-weight-bold">JUDUL BUKU 2</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="judulbuku2" id="judulbuku2" value="'.$data["judul_buku_2"].'" placeholder="Judul Buku" required onkeydown="return f_cekenter(this, event)" tabIndex="7">
                </div>
            </div>
            <div class="form-group row">
                <label for="judulbuku3" class="col-sm-4 col-form-label text-right font-weight-bold">JUDUL BUKU 3</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control" name="judulbuku3" id="judulbuku3" value="'.$data["judul_buku_3"].'" placeholder="Judul Buku" required tabIndex="8">
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-4"></div>
                <div class="col-sm-8">
                    <button class="btn btn-sm btn-primary" type="button" id="simpan" form="in-form"><i class="fa fa-save"></i><span> Simpan</span></button>                                                
                    <button class="btn btn-sm btn-warning" type="button" id="batal" onclick="location.reload();"><i class="fa fa-reply"></i><span> Batal</span></button>
                </div>
            </div>
            
            <script>
                $(document).ready(function(){
                    $("#simpan").click(function(){
                        var data = $("#in-form").serialize();
                        $.ajax({
                            type: "POST",
                            url: "aksi_info.php",
                            data: data,
                            success: function(msg){                                        
                                toastr.success("Data telah disimpan, Anda berhasil menyimpan data.", "Pesan Berhasil", 3000);
                            }, 
                            error: function (error) {
                                toastr.error("Data tidak dapat disimpan, Anda tidak berhasil menyimpan data.", "Pesan Gagal", 3000);
                            }
                        })
                    })
                });
            </script>';
        }
    }
}

if($getData=='modal'){
    $column = array('npm_mahasiswa', 'nm_mahasiswa');
    if(isset($_POST['filter_fakultas'], $_POST['filter_jurusan']) && $_POST['filter_fakultas'] != '' && $_POST['filter_jurusan'] != ''){
        $query = 'SELECT npm_mahasiswa, nm_mahasiswa FROM tbl_mahasiswa WHERE id_fakultas = "'.$_POST['filter_fakultas'].'" AND id_jurusan = "'.$_POST['filter_jurusan'].'" ';
    }

    if(isset($_POST['order'])){
        $query .= 'ORDER BY '.$column[$_POST['order']['0']['column']].' '.$_POST['order']['0']['dir'].' ';
    } else {
        $query .= 'ORDER BY npm_mahasiswa DESC ';
    }

    $statement = $connect->prepare($query);
    $statement->execute();
    $number_filter_row = $statement->rowCount();
    $statement = $connect->prepare($query);
    $statement->execute();
    $result = $statement->fetchAll();

    $data = array();
    foreach($result as $row){
        $sub_array = array();
        $sub_array[] = $row['npm_mahasiswa'];
        $sub_array[] = $row['nm_mahasiswa'];
        $data[] = $sub_array;
    }

    function count_all_data($connect){
        $query = "SELECT npm_mahasiswa, nm_mahasiswa FROM tbl_mahasiswa";
        $statement = $connect->prepare($query);
        $statement->execute();
        return $statement->rowCount();
    }

    $output = array(
        "draw"              => intval($_POST["draw"]),
        "recordsTotal"      => count_all_data($connect),
        "recordsFiltered"   => $number_filter_row,
        "data"              => $data        
    );

    echo json_encode($output);
}

?>