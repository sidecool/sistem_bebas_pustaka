<?php
include "../config/database.php";
include "../config/tgl_indo.php";
require("fpdf.php");

$npm = $_GET['id'];
$title = $npm."-Surat Keterangan Bebas Pustaka";
$tahun = date("Y");
$sql = "SELECT npm_mahasiswa, no_surat_keluar, tgl_surat_keluar, nm_file FROM tbl_surat_keluar 
        WHERE npm_mahasiswa='$npm' AND year(tgl_surat_keluar)='$tahun'";
$result = $mysqli->query($sql);
$baru = false;
if($result->num_rows == 0){
    $baru = true;
    $sql_count = "SELECT COUNT(no_surat_keluar)+1 AS num FROM tbl_surat_keluar WHERE year(tgl_surat_keluar)='$tahun'";
    $result_count = $mysqli->query($sql_count);
    $urut = $result_count->fetch_assoc();
    $nomor = sprintf('%03d', $urut['num'])."/UN52.10/TU/".$tahun;
    $tanggal = date("Y-m-d");
} else {    
    while($column = $result->fetch_assoc()){        
        if(($column['npm_mahasiswa'] == $npm) && ($column['nm_file'] == $title)){
            $baru = false;
            $nomor = $column['no_surat_keluar'];
            $tanggal = $column['tgl_surat_keluar'];
            break;            
        } elseif(($column['npm_mahasiswa'] == $npm) && ($column['nm_file'] != $title)) {
            $baru = true;
            $sql_count = "SELECT COUNT(no_surat_keluar)+1 AS num FROM tbl_surat_keluar WHERE year(tgl_surat_keluar)='$tahun'";
            $result_count = $mysqli->query($sql_count);
            $urut = $result_count->fetch_assoc();
            $nomor = sprintf('%03d', $urut['num'])."/UN52.10/TU/".$tahun;
            $tanggal = date("Y-m-d");            
        }
    }
}

if($baru == true){
    $insert = "INSERT INTO tbl_surat_keluar (npm_mahasiswa, no_surat_keluar, tgl_surat_keluar, nm_file) 
               VALUES ('$npm','$nomor','$tanggal','$title')";    
    $proses = $mysqli->query($insert);
}

class PDF extends FPDF {
    function Header(){
        $this->image("../assets/img/logo.png", 20, 10, 40, 40);
        $this->SetFont("Arial","",15);
        $this->Cell(100);
        $this->Cell(30,10,"KEMENTRIAN PENDIDIKAN DAN KEBUDAYAAN",0,0,"C");
        $this->Ln(7);
        $this->SetFont("Arial","B",15);
        $this->Cell(100);
        $this->Cell(30,10,"UNIVERSITAS MUSAMUS (UNMUS)",0,0,"C");
        $this->Ln(7);
        $this->Cell(100);
        $this->Cell(30,10,"UNIT PELAKSANA TEKNIS PERPUSTAKAAN",0,0,"C");
        $this->Ln(7);
        $this->SetFont("Times","",12);
        $this->Cell(100);
        $this->Cell(30,10,"Jalan Kamizaun Mopah Lama Merauke 99611",0,0,"C");
        $this->Ln(5);
        $this->Cell(100);
        $this->Cell(30,10,"Telp: 0971-325923 Fax: 0971-325976",0,0,"C");
        $this->Ln(5);
        $this->Cell(100);
        $this->Cell(30,10,"Email: info@unmus.ac.id",0,0,"C");
        $this->Ln(5);
        $this->SetLineWidth(1);
        $this->Line(20,53,190,53);
        $this->SetLineWidth(0);
        $this->Line(20,54,190,54);
        $this->Ln(10);
    }
    
    function Body($nomor, $Kepala, $NIPKa, $nama, $npm, $jurusan){
        $this->SetFont("Times","B",12);
        $this->Cell(190,10,"SURAT KETERANGAN BEBAS PUSTAKA",0,0,"C");
        $this->Ln(5);
        $this->SetLineWidth(0);
        $this->Line(64,64,146,64);
        $this->SetFont("Times","",12);
        $this->Ln(1);
        $this->Cell(190,10,"Nomor : ".$nomor,0,0,"C");
        $this->Ln(15);
        $this->Cell(10);
        $this->Cell(190,10,"Yang bertandatangan dibawah ini:",0,0,"FJ");
        $this->Ln();
        
        $this->SetFillColor(255,255,255);
        $this->Cell(20);
        $y = $this->GetY();
        $this->MultiCell(90,8,"Nama\nNIP\nJabatan",0,"L",1);
        $this->SetXY(60,$y);
        $this->MultiCell(90,8,": ".$Kepala."\n: ".$NIPKa."\n: Kepala UPT. Perpustakaan",0,"J",1);

        $this->Cell(10);
        $this->Cell(190,10,"Menerangkan bahwa Mahasiswa:",0,0,"FJ");
        $this->Ln();
        
        $this->SetFillColor(255,255,255);
        $this->Cell(20);
        $y = $this->GetY();
        $this->MultiCell(90,8,"Nama\nNPM\nJurusan",0,"L",1);
        $this->SetXY(60,$y);
        $this->MultiCell(90,8,": ".$nama."\n: ".$npm."\n: ".$jurusan,0,"J",1);

        $this->SetFillColor(255,255,255);
        $this->Cell(10);
        $y = $this->GetY();
        $this->MultiCell(190,5,"Benar-benar telah dinyatakan bebas pustaka pada UPT. Perpustakaan dan telah menyerahkan\ndokumen, berkas, buku sebagai persyaratan yudisium dan wisuda.",0,"L",1);
        $this->Cell(10);
        $this->Cell(190,10,"Adapun buku yang diserahkan sebagai berikut:",0,0,"FJ");
        $this->Cell(10);
        $this->Ln(10);
    }

    function Tabel($tgl_verifikasi, $buku1, $tahun1, $buku2, $tahun2, $buku3, $tahun3){
        $this->Cell(20);
        $this->SetFont("Times","B",12);
        $this->Cell(15,5,'No.',1,0,'C');
        $this->Cell(80,5,'Judul Buku',1,0,'C');
        $this->Cell(30,5,'Tahun',1,0,'C');
        $this->Cell(30,5,'Keterangan',1,0,'C');

        $this->Ln();
        $this->Cell(20);
        $this->SetFont("Times","",12);
        $this->Cell(15,5,'1.',1,0,'C');
        $this->Cell(80,5,$buku1,1,0,'L');
        $this->Cell(30,5,$tahun1,1,0,'C');
        $this->SetFont('ZapfDingbats','', 10);
        $this->Cell(30,5,'4',1,0,'C');
        $this->SetFont("Times","",12);
        $this->Ln();
        $this->Cell(20);
        $this->Cell(15,5,'2.',1,0,'C');
        $this->Cell(80,5,$buku2,1,0,'L');
        $this->Cell(30,5,$tahun2,1,0,'C');
        $this->SetFont('ZapfDingbats','', 10);
        $this->Cell(30,5,'4',1,0,'C');
        $this->SetFont("Times","",12);
        $this->Ln();
        $this->Cell(20);
        $this->Cell(15,5,'3.',1,0,'C');
        $this->Cell(80,5,$buku3,1,0,'L');
        $this->Cell(30,5,$tahun3,1,0,'C');
        $this->SetFont('ZapfDingbats','', 10);
        $this->Cell(30,5,'4',1,0,'C');
        $this->SetFont("Times","",12);
        $this->Ln();
        $this->Cell(20);
        $this->Cell(15,5,'4.',1,0,'C');
        $this->Cell(80,5,'Sudah Upload Skripsi',1,0,'L');
        $this->Cell(30,5,$tgl_verifikasi,1,0,'C');
        $this->SetFont('ZapfDingbats','', 10);
        $this->Cell(30,5,'4',1,0,'C');
        $this->SetFont("Times","",12);
        $this->Ln(10);
        $this->Cell(10);
        $this->Cell(190,10,"Demikian surat keterangan ini dibuat untuk digunakan sebagaimana mestinya.",0,0,"FJ");
        $this->Ln(25);
    }

    function Ttd($tanggal, $Kepala, $NIPKa){
        $this->SetFillColor(255,255,255);
        $this->Cell(10);
        $y = $this->GetY();
        $this->MultiCell(80,5,"",0,"L",1);
        $this->SetXY(120,$y);
        $this->MultiCell(80,5,"Merauke, ".$tanggal."\nUPT. Perpustakaan UNMUS\nKepala\n\n\n\n\n".$Kepala."\nNIK. ".$NIPKa,0,"L",1);
        $this->Ln(15);
    }

    function Tembusan(){
        $this->Cell(10);
        $this->Cell(190,10,"Tembusan :",0,0,"FJ");
        $this->Ln(5);
        $this->Cell(15);
        $this->Cell(190,10,"1. Dekan Fakultas Keguruan dan Ilmu Pendidikan",0,0,"FJ");
        $this->Ln(5);
        $this->Cell(15);
        $this->Cell(190,10,"2. Kepala Biro Akademik dan Kerja Sama",0,0,"FJ");
        $this->Ln(5);
        $this->Cell(15);
        $this->Cell(190,10,"3. Yang Bersangkutan",0,0,"FJ");        
    }
}

$sql_kepala = "SELECT nm_pegawai, nip_pegawai FROM tbl_pegawai WHERE jabatan='Kepala UPT. Perpustakaan'";
$result_kepala = $mysqli->query($sql_kepala);
$numrow_kepala = $result_kepala->num_rows;
if($numrow_kepala > 0) {
    $col_kepala = $result_kepala->fetch_assoc();
    $nama_kepala = $col_kepala['nm_pegawai'];
    $nip_kepala = $col_kepala['nip_pegawai']; 
}

$sql_mahasiswa = "SELECT A.nm_mahasiswa, B.nm_jurusan, C.judul_buku_1, C.tahun_buku_1, C.judul_buku_2, C.tahun_buku_2, 
                  C.judul_buku_3, C.tahun_buku_3 FROM tbl_mahasiswa A
                  LEFT JOIN tbl_jurusan B ON A.id_fakultas=B.id_fakultas AND A.id_jurusan=B.id_jurusan
                  LEFT JOIN tbl_info_dokumen C ON A.npm_mahasiswa=C.npm_mahasiswa                  
                  WHERE A.npm_mahasiswa='$npm'";
$result_mahasiswa = $mysqli->query($sql_mahasiswa);
$numrow_mahasiswa = $result_mahasiswa->num_rows;
if($numrow_mahasiswa > 0) {
    $col_mahasiswa = $result_mahasiswa->fetch_assoc();
    $nama = $col_mahasiswa['nm_mahasiswa'];
    $jurusan = $col_mahasiswa['nm_jurusan']; 
    $judul1 = $col_mahasiswa['judul_buku_1'];
    $tahun1 = $col_mahasiswa['tahun_buku_1'];
    $judul2 = $col_mahasiswa['judul_buku_2'];
    $tahun2 = $col_mahasiswa['tahun_buku_2'];
    $judul3 = $col_mahasiswa['judul_buku_3'];
    $tahun3 = $col_mahasiswa['tahun_buku_3'];    
}

$sql_verifikasi = "SELECT DISTINCT tgl_verifikasi FROM tbl_upload_dokumen WHERE npm_mahasiswa='$npm'";
$result_verifikasi = $mysqli->query($sql_verifikasi);
$numrow_verifikasi = $result_verifikasi->num_rows;
if($numrow_verifikasi > 0) {
    $col_verifikasi = $result_verifikasi->fetch_assoc();
    $tgl_verifikasi = $col_verifikasi['tgl_verifikasi'];
}

$pdf = new PDF("P", "mm", array(330,215));
$pdf->SetTitle($title);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Body($nomor, $nama_kepala, $nip_kepala, $nama, $npm, $jurusan);
$pdf->Tabel(tgl_indo($tgl_verifikasi), $judul1, $tahun1, $judul2, $tahun2, $judul3, $tahun3);
$pdf->Ttd(tgl_indo($tanggal), $nama_kepala, $nip_kepala);
$pdf->Tembusan();
$pdf->Output($title.".pdf", "I");
?>