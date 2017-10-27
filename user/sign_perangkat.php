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
$pdf->MultiCell(32,0.7,'SIGN OFF DATA ASET PERANGKAT IT',0,'C');
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
$pdf->Cell(2, 0.8, 'No.Aset', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Profit Center', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Cost Center', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Desc CC', 1, 0, 'C');
$pdf->Cell(6.6, 0.8, 'Aset Description', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'User Responsible', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Nama User', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Status Aset', 1, 0, 'C');
$pdf->Cell(3, 0.8, 'Status Perangkat', 1, 1, 'C');
$pdf->SetFont('Arial','',6);
$no=1;
$query=sqlsrv_query($kon, "select a.*, b.nama_karyawan, c.desc_cc from perangkat_it a LEFT JOIN karyawan_perangkat_it b ON a.nik_karyawan = b.nik_karyawan LEFT JOIN cost_center c ON a.cost_center = c.id_cc where a.nama_depo = '".$uu_nama_depo."' AND a.status_validasi = '1' AND status_approve != '1'");

while($lihat=sqlsrv_fetch_array($query)){
	$sttus = $lihat['status_aset'];
	if($sttus == '1')
	{
		$aset = 'AKTIF';
	}
	else if($sttus == '0')
	{
		$aset = 'NON-AKTIF';
	}
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(2, 0.8, $lihat['no_aset'],1, 0, 'C');
	$pdf->Cell(2, 0.8, $lihat['profit_center'], 1, 0,'C');
	$pdf->Cell(2, 0.8, $lihat['cost_center'],1, 0, 'C');
	$pdf->Cell(3, 0.8, $lihat['desc_cc'], 1, 0,'C');
	$pdf->Cell(6.6, 0.8, $lihat['aset_desc'], 1, 0,'C');
	$pdf->Cell(3, 0.8, $lihat['nik_karyawan'], 1, 0,'C');
	$pdf->Cell(3, 0.8, $lihat['nama_karyawan'], 1, 0,'C');
	$pdf->Cell(2, 0.8, $aset, 1, 0,'C');
	$pdf->Cell(3, 0.8, $lihat['status_perangkat'],1, 1, 'C');
	$no++;
}
$querysatu=sqlsrv_query($kon, "select  count(no_aset) as jumlah from perangkat_it where nama_depo = '".$uu_nama_depo."' AND status_validasi = '1' ", $param, $option);
$satu = sqlsrv_fetch_array($querysatu);
$querysemua=sqlsrv_query($kon, "select  count(no_aset) as jumlah from perangkat_it  where nama_depo = '".$uu_nama_depo."' ", $param, $option);
$semua = sqlsrv_fetch_array($querysemua);
$pdf->ln(0);
$pdf->SetFont('Arial','',8);
$pdf->Cell(26,0.7,"Yg sdh tervalidasi = ".$satu['jumlah']." aset - dari : ".$semua['jumlah'],0,10,'L');
	$pdf->ln(0.3);
	$pdf->setX(2.2);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(5.5,0.7,"Dibuat Oleh,",0,0,'C');
	$pdf->Cell(10.5,0.7,"Mengetahui,",0,0,'C');

	$pdf->Cell(10.5,0.7,"Menyetujui,",0,0,'C');

	$pdf->ln(1.6);
	$pdf->setX(2.2);
	$pdf->SetFont('Arial','',8);
	$pdf->Cell(5.5,0.7,"OSAT",0,0,'C');
	$pdf->Cell(3.5,0.7,"BAC Region",0,0,'C');
	$pdf->Cell(3.5,0.7,"BH Region",0,0,'C');
	$pdf->Cell(3.5,0.7,"GA Region",0,0,'C');
	$pdf->Cell(5.5,0.7,"RACH",0,0,'C');
	$pdf->Cell(4.5,0.7,"HC Region",0,0,'C');
	//$pdf->Cell(3.5,0.7,"RACH",0,0,'C');


	$pdf->Output("Sign_Off_Modis.pdf","I");

		sqlsrv_query($kon, "update perangkat_it set status_approve = '1' where nama_depo = '".$uu_nama_depo."' AND status_validasi = '1'")


?>
