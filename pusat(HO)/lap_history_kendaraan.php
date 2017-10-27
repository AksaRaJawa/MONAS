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
$excelku->getActiveSheet()->getColumnDimension('M')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('N')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('O')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('P')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('Q')->setWidth(20);



// Mergecell, menyatukan beberapa kolom
$excelku->getActiveSheet()->mergeCells('A1:F1');

// Buat Kolom judul tabel
$SI = $excelku->setActiveSheetIndex(0);
$SI->setCellValue('A1', 'HISTORI ASET KENDARAAN HO AND ALL REGION == SNS'); //Judul laporan
$SI->setCellValue('A3', 'No'); //Kolom No
$SI->setCellValue('B3', 'Tanggal'); //Kolom
$SI->setCellValue('C3', 'Waktu'); //Kolom
$SI->setCellValue('D3', 'Aktifitas'); //Kolom
$SI->setCellValue('E3', 'No. Aset');
$SI->setCellValue('F3', 'Merk');
$SI->setCellValue('G3', 'Tipe');
$SI->setCellValue('H3', 'No. Box Sebelumnya');
$SI->setCellValue('I3', 'No. Box Sekarang');
$SI->setCellValue('J3', 'CC');
$SI->setCellValue('K3', 'PC');
$SI->setCellValue('L3', 'NIK User Sebelumnya');
$SI->setCellValue('M3', 'NIK User Sekarang');
$SI->setCellValue('N3', 'Username');
$SI->setCellValue('O3', 'Depo Username');
$SI->setCellValue('P3', 'Region Username');
$SI->setCellValue('Q3', 'Level Akses');

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
$excelku->getActiveSheet()->setSharedStyle($headerStylenya,"A3:Q3");


$strsql	= "SELECT * from histori_kendaraan";
$res    = sqlsrv_query($kon, $strsql);
$baris  = 4; //Ini untuk dimulai baris datanya, karena di baris 3 itu digunakan untuk header tabel
$no     = 1;

while ($row = sqlsrv_fetch_array($res)) {

  $SI->setCellValue("A".$baris,$no++); //mengisi data untuk nomor urut
  $SI->setCellValue("B".$baris,$row['tanggal_perubahan']); //mengisi data
  $SI->setCellValue("C".$baris,$row['waktu']); //mengisi data
  $SI->setCellValue("D".$baris,$row['aktivitas']); //mengisi data
  $SI->setCellValue("E".$baris,$row['no_aset_kendaraan']); //mengisi data
  $SI->setCellValue("F".$baris,$row['nama_merk']); //mengisi data
  $SI->setCellValue("G".$baris,$row['nama_tipe']); //mengisi data
  $SI->setCellValue("H".$baris,$row['no_peripheral_lama']); //mengisi data
  $SI->setCellValue("I".$baris,$row['no_peripheral_baru']); //mengisi data
  $SI->setCellValue("J".$baris,$row['cost_center_id']); //mengisi data
  $SI->setCellValue("K".$baris,$row['profit_center_id']); //mengisi data
  $SI->setCellValue("L".$baris,$row['nik_lama']); //mengisi data
  $SI->setCellValue("M".$baris,$row['nik_baru']); //mengisi data
  $SI->setCellValue("N".$baris,$row['uname']); //mengisi data
  $SI->setCellValue("O".$baris,$row['depo_uname']); //mengisi data
  $SI->setCellValue("P".$baris,$row['region_uname']); //mengisi data
  $SI->setCellValue("Q".$baris,$row['akses']); //mengisi data

  $baris++; //looping untuk barisnya
}

//Memberi nama sheet
$excelku->getActiveSheet()->setTitle('Histori Kendaraan');

$excelku->setActiveSheetIndex(0);

// untuk excel 2007 atau yang berekstensi .xlsx
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename=histori_kendaraan'.date("Y-m-d____H:i:s").'.xlsx');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($excelku, 'Excel2007');
$objWriter->save('php://output');
exit;

?>
