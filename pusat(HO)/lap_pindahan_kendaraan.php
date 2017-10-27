<?php
//include "config.php";
include "../PHPExcel.php";
$db_server = "10.50.1.78";
$db_user = "adminmodis";
$db_pass = "Zaq!2wsxcvbnm";

$db_name = "dbmodis";

$connectioninfo = array("Database"=>$db_name,
"UID"=>$db_user,
"PWD"=>$db_pass);

$kon = sqlsrv_connect($db_server,$connectioninfo);

$param = array();
$option = array("Scrollable"=>'static');

date_default_timezone_set("Asia/Jakarta");

$excelku = new PHPExcel();

// Set properties
$excelku->getProperties()->setCreator("IT HO ---  SNS");

// Set lebar kolom
$excelku->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$excelku->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('C')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('D')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('H')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('I')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('J')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('K')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('L')->setWidth(20);



// Mergecell, menyatukan beberapa kolom
$excelku->getActiveSheet()->mergeCells('A1:F1');

// Buat Kolom judul tabel
$SI = $excelku->setActiveSheetIndex(0);
$SI->setCellValue('A1', 'PERPINDAHAN ASET KENDARAAN HO AND ALL REGION == SNS'); //Judul laporan
$SI->setCellValue('A3', 'No'); //Kolom No
$SI->setCellValue('B3', 'Tanggal'); //Kolom
$SI->setCellValue('C3', 'Waktu'); //Kolom
$SI->setCellValue('D3', 'No. Aset'); //Kolom
$SI->setCellValue('E3', 'Merk');
$SI->setCellValue('F3', 'Tipe');
$SI->setCellValue('G3', 'CC Sebelumnya');
$SI->setCellValue('H3', 'PC Sebelumnya');
$SI->setCellValue('I3', 'CC Sekarang');
$SI->setCellValue('J3', 'PC Sekarang');
$SI->setCellValue('K3', 'Depo Sekarang');
$SI->setCellValue('L3', 'Region Sekarang');
//Mengeset Syle nya
$headerStylenya = new PHPExcel_Style();
$bodyStylenya   = new PHPExcel_Style();

$headerStylenya->applyFromArray(
	array('fill' 	=> array(
		  'type'    => PHPExcel_Style_Fill::FILL_SOLID,
		  'color'   => array('argb' => 'FFEEEEEE'))
	));

$bodyStylenya->applyFromArray(
	array('fill' 	=> array(
		  'type'	=> PHPExcel_Style_Fill::FILL_SOLID,
		  'color'	=> array('argb' => 'FFFFFFFF'))
    ));

//Menggunakan HeaderStylenya
$excelku->getActiveSheet()->setSharedStyle($headerStylenya,"A3:L3");


$strsql	= "SELECT * from pindahan_kendaraan";
$res    = sqlsrv_query($kon, $strsql);
$baris  = 4; //Ini untuk dimulai baris datanya, karena di baris 3 itu digunakan untuk header tabel
$no     = 1;

while ($row = sqlsrv_fetch_array($res)) {

  $SI->setCellValue("A".$baris,$no++); //mengisi data untuk nomor urut
  $SI->setCellValue("B".$baris,$row['tanggal']); //mengisi data
  $SI->setCellValue("C".$baris,$row['waktu']); //mengisi data
  $SI->setCellValue("D".$baris,$row['no_aset_kendaraan']); //mengisi data
  $SI->setCellValue("E".$baris,$row['nama_merk']); //mengisi data
  $SI->setCellValue("F".$baris,$row['nama_tipe']); //mengisi data
  $SI->setCellValue("G".$baris,$row['cost_center_dulu']); //mengisi data
  $SI->setCellValue("H".$baris,$row['profit_center_dulu']); //mengisi data
  $SI->setCellValue("I".$baris,$row['cost_center_sekarang']); //mengisi data
  $SI->setCellValue("J".$baris,$row['profit_center_sekarang']); //mengisi data
  $SI->setCellValue("K".$baris,$row['depo_sekarang']); //mengisi data
  $SI->setCellValue("L".$baris,$row['region_sekarang']); //mengisi data

  $baris++; //looping untuk barisnya
}

//Memberi nama sheet
$excelku->getActiveSheet()->setTitle('Pindahan Kendaraan');

$excelku->setActiveSheetIndex(0);

// untuk excel 2007 atau yang berekstensi .xlsx
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename=pindahan_kendaraan'.date("Y-m-d____H:i:s").'.xlsx');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($excelku, 'Excel2007');
$objWriter->save('php://output');
exit;

?>
