<?php
session_start();
error_reporting(0);
$page = "Profil ".$_SESSION['nama'];

include '../../config/route.php';
include "../../config/database.php";

// Keamanan
if($_SESSION['status']!="masuk") {
    header("location:../../logout.php");
}

include "../header.php";
?>

                        <div id="ProfilForm">
                            <div class="card mb-4">
                                <div class="card-header container-fluid">
                                    <div class="row">
                                        <div class="col">
                                            <i class="fas fa-table mr-1"></i>
                                            Form Profil
                                        </div>                                                                                
                                    </div>                                    
                                </div>
                                <div class="card-body">
                                    <form method="post" action="aksi_profil.php?aksi=update" autocomplete="off" id="in-form">
                                        <?php
                                            $id_mahasiswa = $_SESSION['no_id'];
                                            
                                            $sql = "SELECT A.npm_mahasiswa, A.nm_mahasiswa, A.alamat, A.id_fakultas, A.id_jurusan, B.nm_fakultas, C.nm_jurusan, A.id_anggota_perpus, A.email FROM tbl_mahasiswa A 
                                                        LEFT JOIN tbl_fakultas B ON A.id_fakultas=B.id_fakultas
                                                        LEFT JOIN tbl_jurusan C ON A.id_fakultas=C.id_fakultas AND A.id_jurusan=C.id_jurusan                                                                                 
                                                        WHERE A.npm_mahasiswa='$id_mahasiswa'";
                                            $result = $mysqli->query($sql);
                                            while ($col = $result->fetch_assoc()) {  
                                        ?>

                                        <div class="row">
                                            <label for="npm_mahasiswa" class="col-sm-4 col-form-label-sm text-right font-weight-bold">NPM MAHASISWA</label>
                                            <div class="col-sm-4">
                                                <input type="text" class="form-control form-control-sm" name="npm_mahasiswa" id="npm_mahasiswa" value="<?php echo $col['npm_mahasiswa']; ?>" placeholder="NPM Mahasiswa" readonly required onkeydown="return f_cekenter(this, event)" tabIndex="1">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="nama" class="col-sm-4 col-form-label-sm text-right font-weight-bold">NAMA MAHASISWA</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control form-control-sm" name="nama" id="nama" value="<?php echo $col['nm_mahasiswa']; ?>" placeholder="Nama Mahasiswa" readonly required onkeydown="return f_cekenter(this, event)" tabIndex="2">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="id_fakultas" class="col-sm-4 col-form-label-sm text-right font-weight-bold">FAKULTAS</label>
                                            <div class="col-sm-8">
                                                <select class="id_fakultas form-control form-control-sm" name="id_fakultas" id="id_fakultas" fakultas="<?php echo $col['id_fakultas']; ?>" placeholder="Nama Fakultas" disabled required onkeydown="return f_cekenter(this, event)" tabIndex="3">
                                                <option value="">- PILIH FAKULTAS -</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="id_jurusan" class="col-sm-4 col-form-label-sm text-right font-weight-bold">JURUSAN / PROGRAM STUDI</label>
                                            <div class="col-sm-8">
                                                <select class="id_jurusan form-control form-control-sm" name="id_jurusan" id="id_jurusan" jurusan="<?php echo $col['id_jurusan']; ?>" placeholder="Nama Jurusan" disabled required onkeydown="return f_cekenter(this, event)" tabIndex="4">
                                                    <option value="">- PILIH JURUSAN / PROGRAM STUDI -</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="alamat" class="col-sm-4 col-form-label-sm text-right font-weight-bold">ALAMAT MAHASISWA</label>
                                            <div class="col-sm-8">
                                                <textarea row="3" class="form-control form-control-sm" name="alamat" id="alamat" placeholder="Alamat Mahasiswa" readonly required onkeydown="return f_cekenter(this, event)" tabIndex="5"><?php echo $col['alamat']; ?></textarea>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="id_perpus" class="col-sm-4 col-form-label-sm text-right font-weight-bold">ID ANGGOTA PERPUSTAKAAN</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control form-control-sm" name="id_perpus" id="id_perpus" value="<?php echo $col['id_anggota_perpus']; ?>" placeholder="ID Anggota Perpustakaan" readonly required onkeydown="return f_cekenter(this, event)" tabIndex="6">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <label for="email" class="col-sm-4 col-form-label-sm text-right font-weight-bold">EMAIL MAHASISWA</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control form-control-sm" name="email" id="email" value="<?php echo $col['email']; ?>" placeholder="Email Mahasiswa" readonly required tabIndex="7">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-4"></div>
                                            <div class="col-sm-8">
                                                <button class="btn btn-sm btn-primary" type="submit" id="simpan" form="in-form" hidden><i class="fa fa-save"></i><span> Simpan</span></button>
                                                <button class="btn btn-sm btn-info" type="button" id="edit"><i class="fa fa-edit"></i><span> Edit Profil</span></button>
                                                <button class="btn btn-sm btn-warning" type="button" id="batal" hidden><i class="fa fa-reply"></i><span> Batal</span></button>
                                            </div>
                                        </div>
                                        <?php 
                                            };
                                        ?>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <script>
                            $(document).ready(function(){
                                var nama = document.getElementById('nama').value;
                                var fakultas = $('.id_fakultas').attr("fakultas");
                                var jurusan = $('.id_jurusan').attr("jurusan");
                                var alamat = document.getElementById('alamat').value;
                                var id_perpus = document.getElementById('id_perpus').value;
                                var email = document.getElementById('email').value;                                
                                $.ajax({
                                    type: 'POST',
                                    url: "aksi_profil.php?getData=fakultas",
                                    data: {id_fakultas: fakultas},
                                    cache: false, 
                                    success: function(msg){
                                        $(".id_fakultas").html(msg);
                                    }
                                });
                                $.ajax({
                                    type: 'POST',
                                    url: "aksi_profil.php?getData=jurusan",
                                    data: {id_fakultas: fakultas, id_jurusan: jurusan},
                                    cache: false,
                                    success: function(msg){
                                        $(".id_jurusan").html(msg);
                                    }
                                });                                
                                $(".id_fakultas").change(function(){
                                    var fakultas = $(".id_fakultas").val();                            
                                    $.ajax({
                                        type: 'POST',
                                        url: "aksi_profil.php?getData=jurusan",
                                        data: {id_fakultas: fakultas},
                                        cache: false,
                                        success: function(msg){
                                            $(".id_jurusan").html(msg);
                                        }
                                    });
                                });


                                $("#edit").click(function(){                                    
                                    $("input[name='nama']").removeAttr("readonly");
                                    $("select[name='id_fakultas']").removeAttr("disabled");
                                    $("select[name='id_jurusan']").removeAttr("disabled");
                                    $("textarea[name='alamat']").removeAttr("readonly");
                                    $("input[name='id_perpus']").removeAttr("readonly");
                                    $("input[name='email']").removeAttr("readonly");
                                    $("input[name='nama']").focus();
                                    $("button[id='simpan']").removeAttr("hidden");
                                    $("button[id='batal']").removeAttr("hidden");
                                    document.getElementById("edit").setAttribute("hidden", "true");
                                });
                                
                                $("#batal").click(function(){
                                    document.getElementById("nama").value = nama;
                                    document.getElementById("nama").setAttribute("readonly", "true");
                                    document.getElementById("id_fakultas").setAttribute("disabled", "true");
                                    document.getElementById("id_jurusan").setAttribute("disabled", "true");
                                    $("button[id='edit']").removeAttr("hidden");
                                    $.ajax({
                                        type: 'POST',
                                        url: "aksi_profil.php?getData=fakultas",
                                        data: {id_fakultas: fakultas},
                                        cache: false, 
                                        success: function(msg){
                                            $(".id_fakultas").html(msg);
                                        }
                                    });
                                    $.ajax({
                                        type: 'POST',
                                        url: "aksi_profil.php?getData=jurusan",
                                        data: {id_fakultas: fakultas, id_jurusan: jurusan},
                                        cache: false,
                                        success: function(msg){
                                            $(".id_jurusan").html(msg);
                                        }
                                    });
                                    document.getElementById("alamat").value = alamat;
                                    document.getElementById("alamat").setAttribute("readonly", "true");
                                    document.getElementById("id_perpus").value = id_perpus;
                                    document.getElementById("id_perpus").setAttribute("readonly", "true");
                                    document.getElementById("email").value = email;
                                    document.getElementById("email").setAttribute("readonly", "true");
                                    document.getElementById("simpan").setAttribute("hidden", "true");
                                    document.getElementById("batal").setAttribute("hidden", "true");                                                                        
                                });                                
                            });
                        </script>
<?php 
include "../footer.php";
?>