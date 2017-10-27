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
$excelku->getActiveSheet()->getColumnDimension('C')->setWidth(40);
$excelku->getActiveSheet()->getColumnDimension('D')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('G')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('H')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('I')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('J')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('K')->setWidth(30);
$excelku->getActiveSheet()->getColumnDimension('L')->setWidth(30);
$excelku->getActiveSheet()->getColumnDimension('M')->setWidth(30);
$excelku->getActiveSheet()->getColumnDimension('N')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('O')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('P')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('Q')->setWidth(20);

// Mergecell, menyatukan beberapa kolom
$excelku->getActiveSheet()->mergeCells('A1:F1');

// Buat Kolom judul tabel
$SI = $excelku->setActiveSheetIndex(0);
$SI->setCellValue('A1', 'HISTORY AKTIVITAS USER PERANGKAT IT TOOLS'); //Judul laporan
$SI->setCellValue('A3', 'No'); //Kolom No
$SI->setCellValue('B3', 'Tanggal'); //Kolom
$SI->setCellValue('C3', 'Aktivitas'); //Kolom
$SI->setCellValue('D3', 'No.Aset'); //Kolom
$SI->setCellValue('E3', 'Aset Group');
$SI->setCellValue('F3', 'Aset Desc');
$SI->setCellValue('G3', 'Merk & Type');
$SI->setCellValue('H3', 'Cost Center');
$SI->setCellValue('I3', 'NIK User Resp.');
$SI->setCellValue('J3', 'Status Perangkat');
$SI->setCellValue('K3', 'Username');
$SI->setCellValue('L3', 'Depo');
$SI->setCellValue('M3', 'Region');
$SI->setCellValue('N3', 'Waktu');

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
$excelku->getActiveSheet()->setSharedStyle($headerStylenya,"A3:N3");


$strsql	= "SELECT * from histori_perangkat_it";
$res    = sqlsrv_query($kon, $strsql);
$baris  = 4; //Ini untuk dimulai baris datanya, karena di baris 3 itu digunakan untuk header tabel
$no     = 1;

while ($row = sqlsrv_fetch_array($res)) {
  $SI->setCellValue("A".$baris,$no++); //mengisi data untuk nomor urut
  $SI->setCellValue("B".$baris,$row['tanggal_perubahan']); //mengisi data
  $SI->setCellValue("C".$baris,$row['aktivitas']); //mengisi data
  $SI->setCellValue("D".$baris,$row['no_aset']); //mengisi data
  $SI->setCellValue("E".$baris,$row['aset_group']); //mengisi data
  $SI->setCellValue("F".$baris,$row['aset_desc']); //mengisi data
  $SI->setCellValue("G".$baris,$row['nama_merk']); //mengisi data
  $SI->setCellValue("H".$baris,$row['cost_center']); //mengisi data
  $SI->setCellValue("I".$baris,$row['nik_karyawan']); //mengisi data
  $SI->setCellValue("J".$baris,$row['status_perangkat']); //mengisi data
  $SI->setCellValue("K".$baris,$row['uname']); //mengisi data
  $SI->setCellValue("L".$baris,$row['nama_depo']); //mengisi data
  $SI->setCellValue("M".$baris,$row['nama_region']); //mengisi data
  $SI->setCellValue("N".$baris,$row['waktu']); //mengisi data

  $baris++; //looping untuk barisnya
}

//Memberi nama sheet
$excelku->getActiveSheet()->setTitle('Data History Perangkat IT Tools');

$excelku->setActiveSheetIndex(0);

// untuk excel 2007 atau yang berekstensi .xlsx
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename=histori_perangkat_it_'.date("Y-m-d____H:i:s").'.xlsx');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($excelku, 'Excel2007');
$objWriter->save('php://output');
exit;

?>
