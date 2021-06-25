<?php
include "../config/database.php";
include "../config/tgl_indo.php";
require("fpdf.php");

$npm = $_GET['id'];
$title = $npm."-Surat Keterangan Bebas Pinjaman";
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
    
    function Body($nomor, $nama, $npm, $idperpus, $alamat, $jurusan, $fakultas){
        $this->SetFont("Times","B",12);
        $this->Cell(190,10,"SURAT KETERANGAN BEBAS PINJAMAN/TANGGUNGAN",0,0,"C");
        $this->Ln(5);
        $this->SetLineWidth(0);
        $this->Line(45,64,165,64);
        $this->SetFont("Times","",12);
        $this->Ln(1);
        $this->Cell(190,10,"Nomor : ".$nomor,0,0,"C");
        $this->Ln(15);
        $this->Cell(10);
        $this->Cell(190,10,"Menerangkan dengan sebenarnya bahwa mahasiswa tersebut dibawah ini:",0,0,"FJ");
        $this->Ln();
        
        $this->SetFillColor(255,255,255);
        $this->Cell(20);
        $y = $this->GetY();
        $this->MultiCell(90,8,"Nama\nNPM\nID Anggota\nAlamat\nJurusan\nFakultas",0,"L",1);
        $this->SetXY(60,$y);
        $this->MultiCell(90,8,": ".$nama."\n: ".$npm."\n: ".$idperpus."\n: ".$alamat."\n: ".$jurusan."\n: ".$fakultas,0,"J",1);

        $this->Cell(10);
        $this->Cell(190,10,"Telah menyelesaikan pinjaman dan/atau tanggungan pada UPT Perpustakaan UNMUS.",0,0,"FJ");
        $this->Ln(5);
        $this->Cell(10);
        $this->Cell(190,10,"Demikian surat keterangan ini dibuat untuk dipergunakan sebagaimana mestinya.",0,0,"FJ");
        $this->Ln(25);
    }

    function Ttd($tanggal,$Kepala,$NIPKa,$Petugas,$NIPPtgs){
        $this->SetFillColor(255,255,255);
        $this->Cell(10);
        $y = $this->GetY();
        $this->MultiCell(80,5,"Mengetahui\nUPT. Perpustakaan UNMUS\nKepala\n\n\n\n\n".$Kepala."\nNIP. ".$NIPKa,0,"L",1);
        $this->SetXY(110,$y);
        $this->MultiCell(80,5,"Merauke, ".$tanggal."\nPetugas Pemeriksa\n\n\n\n\n\n".$Petugas."\nNIK. ".$NIPPtgs,0,"C",1);
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

$sql_petugas = "SELECT nm_pegawai, nip_pegawai FROM tbl_pegawai WHERE jabatan='Petugas Pemeriksa'";
$result_petugas = $mysqli->query($sql_petugas);
$numrow_petugas = $result_petugas->num_rows;
if($numrow_petugas > 0) {
    $col_petugas = $result_petugas->fetch_assoc();
    $nama_petugas = $col_petugas['nm_pegawai'];
    $nip_petugas = $col_petugas['nip_pegawai']; 
}

$sql_mahasiswa = "SELECT A.nm_mahasiswa, A.id_anggota_perpus, A.alamat, B.nm_jurusan, C.nm_fakultas FROM tbl_mahasiswa A
                  LEFT JOIN tbl_jurusan B ON A.id_fakultas=B.id_fakultas AND A.id_jurusan=B.id_jurusan
                  LEFT JOIN tbl_fakultas C ON A.id_fakultas=C.id_fakultas 
                  WHERE npm_mahasiswa='$npm'";
$result_mahasiswa = $mysqli->query($sql_mahasiswa);
$numrow_mahasiswa = $result_mahasiswa->num_rows;
if($numrow_mahasiswa > 0) {
    $col_mahasiswa = $result_mahasiswa->fetch_assoc();
    $nama = $col_mahasiswa['nm_mahasiswa']; 
    $idperpus = $col_mahasiswa['id_anggota_perpus'];
    $alamat = $col_mahasiswa['alamat'];
    $jurusan = $col_mahasiswa['nm_jurusan'];
    $fakultas = $col_mahasiswa['nm_fakultas'];
}

$pdf = new PDF("P", "mm", array(330,215));
$pdf->SetTitle($title);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->Body($nomor, $nama, $npm, $idperpus, $alamat, $jurusan, $fakultas);
$pdf->Ttd(tgl_indo($tanggal), $nama_kepala, $nip_kepala, $nama_petugas, $nip_petugas);
$pdf->Output($title.".pdf", "I");
?>