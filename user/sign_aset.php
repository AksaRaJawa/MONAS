<?php
include 'config.php';
include "bulan.php";
require('../assets/pdf/fpdf.php');
date_default_timezone_set("Asia/Jakarta");
$day = date("d");
$mon = date("m");
$thn = date("Y");
$bln = bulan($mon);
$tggl = $day.' '.$bln.' '.$thn;
$uu_depo = $_POST['uu_depo'];
$uu_nama_depo = $_POST['uu_nama_depo'];
$uu_region = $_POST['uu_region'];
$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(1,1,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);
$pdf->Image('../logo/logo.jpg',1.8,0.2,3,3);
$pdf->ln(0);
$pdf->Line(0.8,1,28.8,1);   
$pdf->SetLineWidth(0);
$pdf->ln(0);
$pdf->Line(0.8,1,0.8,2.4);   
$pdf->SetLineWidth(0);
$pdf->ln(0);
$pdf->Line(6,1,6,2.4);   
$pdf->SetLineWidth(0);
$pdf->ln(0);            
$pdf->MultiCell(32,0.7,'SIGN OFF DATA ASET MODIS',0,'C');
$pdf->ln(0);
$pdf->Line(6,1.7,28.8,1.7);   
$pdf->SetLineWidth(0);
$pdf->ln(0);
$pdf->MultiCell(32,0.9,''.$uu_nama_depo.' '.$uu_region.'   Per '.$tggl,0,'C');    
$pdf->SetFont('Arial','B',10);
$pdf->ln(0);
$pdf->Line(0.8,2.4,28.8,2.4);
$pdf->SetLineWidth(0); 
$pdf->ln(0);
$pdf->Line(28.8,1,28.8,2.4);   
$pdf->SetLineWidth(0);
$pdf->ln(0);     
$pdf->Rect(0.8,2.5,28,17.8);   
$pdf->SetLineWidth(0);
$pdf->ln(0.2);
$pdf->SetFont('Arial','B',8);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'No.IMEI', 1, 0, 'C');
$pdf->Cell(1.6, 0.8, 'Merk', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Tipe', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'No.Asset', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'S/N', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'NIK', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Nama', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Status Kepemilikan', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Status Modis', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Status Device', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'ID Device', 1, 1, 'C');
$pdf->SetFont('Arial','',6);
$no=1;
$query=sqlsrv_query($kon, "select a.*, b.nama_karyawan from asset a LEFT JOIN karyawan b ON a.nik_karyawan = b.nik_karyawan where a.id_depo = '".$uu_depo."' AND a.status_validasi = '1'");
while($lihat=sqlsrv_fetch_array($query)){
	$sttus = $lihat['status_modis'];
	if($sttus == '1')
	{
		$modis = 'AKTIF';
	}
	else if($sttus == '0')
	{
		$modis = 'NON-AKTIF';
	}
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(2, 0.8, $lihat['no_imei'],1, 0, 'C');
	$pdf->Cell(1.6, 0.8, $lihat['nama_merk'], 1, 0,'C');
	$pdf->Cell(2, 0.8, $lihat['nama_tipe'],1, 0, 'C');
	$pdf->Cell(2, 0.8, $lihat['no_asset'], 1, 0,'C');
	$pdf->Cell(3, 0.8, $lihat['serial_number'],1, 0, 'C');
	$pdf->Cell(2, 0.8, $lihat['nik_karyawan'], 1, 0,'C');
	$pdf->Cell(3, 0.8, $lihat['nama_karyawan'], 1, 0,'C');
	$pdf->Cell(3, 0.8, $lihat['nama_kepemilikan'], 1, 0,'C');
	$pdf->Cell(2, 0.8, $modis, 1, 0,'C');
	$pdf->Cell(2, 0.8, $lihat['status_device'], 1, 0,'C');
	$pdf->Cell(4, 0.8, $lihat['id_device'], 1, 1,'C');
	$no++;
}
	$pdf->ln(0.5);
	$pdf->setX(2.2);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(3.5,0.7,"Dibuat Oleh,",0,0,'C');
	$pdf->Cell(10.5,0.7,"Mengetahui,",0,0,'C');

	$pdf->Cell(10.5,0.7,"Menyetujui,",0,0,'C');

	$pdf->ln(1.6);
	$pdf->setX(2.2);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(3.5,0.7,"OSAT",0,0,'C');
	$pdf->Cell(3.5,0.7,"BAC Region",0,0,'C');
	$pdf->Cell(3.5,0.7,"SAC Region",0,0,'C');
	$pdf->Cell(3.5,0.7,"S&S Region",0,0,'C');
	$pdf->Cell(3.5,0.7,"BH",0,0,'C');
	$pdf->Cell(3.5,0.7,"SMD",0,0,'C');
	$pdf->Cell(3.5,0.7,"RACH",0,0,'C');
	
	
	$pdf->Output("Sign_Off_Modis.pdf","I");

?>

