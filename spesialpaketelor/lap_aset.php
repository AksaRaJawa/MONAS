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
$excelku->getActiveSheet()->getColumnDimension('K')->setWidth(30);
$excelku->getActiveSheet()->getColumnDimension('L')->setWidth(30);
$excelku->getActiveSheet()->getColumnDimension('M')->setWidth(30);
$excelku->getActiveSheet()->getColumnDimension('N')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('O')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('P')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('R')->setWidth(50);
$excelku->getActiveSheet()->getColumnDimension('S')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('T')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('U')->setWidth(20);

// Mergecell, menyatukan beberapa kolom
$excelku->getActiveSheet()->mergeCells('A1:F1');

// Buat Kolom judul tabel
$SI = $excelku->setActiveSheetIndex(0);
$SI->setCellValue('A1', 'DATA ASET MODIS ALL REGION'); //Judul laporan
$SI->setCellValue('A3', 'No'); //Kolom No
$SI->setCellValue('B3', 'Depo'); //Kolom 
$SI->setCellValue('C3', 'Region'); //Kolom 
$SI->setCellValue('D3', 'No.IMEI'); //Kolom 
$SI->setCellValue('E3', 'Merk');
$SI->setCellValue('F3', 'Tipe');
$SI->setCellValue('G3', 'No.Aset');
$SI->setCellValue('H3', 'Tanggal Beli');
$SI->setCellValue('I3', 'Serial Number');
$SI->setCellValue('J3', 'NIK Karyawan');
$SI->setCellValue('K3', 'Nama Karyawan');
$SI->setCellValue('L3', 'Tanggal Terima');
$SI->setCellValue('M3', 'Status Kepemilikan');
$SI->setCellValue('N3', 'Status Modis');
$SI->setCellValue('O3', 'Status Device');
$SI->setCellValue('P3', 'ID Device');
$SI->setCellValue('Q3', 'Masa Berlaku');
$SI->setCellValue('R3', 'Keterangan');
$SI->setCellValue('S3', 'Provider');
$SI->setCellValue('T3', 'No HP');
$SI->setCellValue('U3', 'Tanggal Aktif');
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
$excelku->getActiveSheet()->setSharedStyle($headerStylenya,"A3:U3");


$strsql	= "SELECT a.*, b.nama_depo, c.nama_karyawan from asset a LEFT JOIN depo b ON a.id_depo = b.id_depo LEFT JOIN karyawan c ON a.nik_karyawan = c.nik_karyawan where a.status = '1' order by a.id_depo ASC";
$res    = sqlsrv_query($kon, $strsql);
$baris  = 4; //Ini untuk dimulai baris datanya, karena di baris 3 itu digunakan untuk header tabel
$no     = 1;

while ($row = sqlsrv_fetch_array($res)) {
		$stts = $row['status_modis'];
		if($stts == '1')
		{
			$sttus_modis = 'AKTIF';
		}
		else if ($stts == '0')
		{
			$sttus_modis = 'NON-AKTIF';
		}
  $SI->setCellValue("A".$baris,$no++); //mengisi data untuk nomor urut
  $SI->setCellValue("B".$baris,$row['nama_depo']); //mengisi data 
  $SI->setCellValue("C".$baris,$row['nama_region']); //mengisi data 
  $SI->setCellValue("D".$baris,$row['no_imei']); //mengisi data 
  $SI->setCellValue("E".$baris,$row['nama_merk']); //mengisi data 
  $SI->setCellValue("F".$baris,$row['nama_tipe']); //mengisi data 
  $SI->setCellValue("G".$baris,$row['no_asset']); //mengisi data
  $SI->setCellValue("H".$baris,$row['tanggal_beli']); //mengisi data
  $SI->setCellValue("I".$baris,$row['serial_number']); //mengisi data 
  $SI->setCellValue("J".$baris,$row['nik_karyawan']); //mengisi data  
  $SI->setCellValue("K".$baris,$row['nama_karyawan']); //mengisi data    
  $SI->setCellValue("L".$baris,$row['tanggal_terima']); //mengisi data   
  $SI->setCellValue("M".$baris,$row['nama_kepemilikan']); //mengisi data 
  $SI->setCellValue("N".$baris,$sttus_modis); //mengisi data 
  $SI->setCellValue("O".$baris,$row['status_device']); //mengisi data   
  $SI->setCellValue("P".$baris,$row['id_device']); //mengisi data   
  $SI->setCellValue("Q".$baris,$row['masa_berlaku']); //mengisi data
  $SI->setCellValue("R".$baris,$row['keterangan']); //mengisi data  
  $SI->setCellValue("S".$baris,$row['provider']); //mengisi data  
  $SI->setCellValue("T".$baris,$row['nohp']); //mengisi data  
  $SI->setCellValue("U".$baris,$row['tgglaktif']); //mengisi data  
  $baris++; //looping untuk barisnya
}

//Memberi nama sheet
$excelku->getActiveSheet()->setTitle('Data Aset Modis');

$excelku->setActiveSheetIndex(0);

// untuk excel 2007 atau yang berekstensi .xlsx
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename=aset_modis_'.date("Y-m-d____H:i:s").'.xlsx');
header('Cache-Control: max-age=0');
 
$objWriter = PHPExcel_IOFactory::createWriter($excelku, 'Excel2007');
$objWriter->save('php://output');
exit;

?>

