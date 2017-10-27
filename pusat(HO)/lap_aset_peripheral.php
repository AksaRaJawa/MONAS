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
$excelku->getActiveSheet()->getColumnDimension('N')->setWidth(40);
$excelku->getActiveSheet()->getColumnDimension('O')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('P')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('Q')->setWidth(20);


// Mergecell, menyatukan beberapa kolom
$excelku->getActiveSheet()->mergeCells('A1:F1');

// Buat Kolom judul tabel
$SI = $excelku->setActiveSheetIndex(0);
$SI->setCellValue('A1', 'DATA ASET KENDARAAN HO AND ALL REGION == SNS'); //Judul laporan
$SI->setCellValue('A3', 'No'); //Kolom No
$SI->setCellValue('B3', 'No. Aset'); //Kolom
$SI->setCellValue('C3', 'Jenis'); //Kolom
$SI->setCellValue('D3', 'Description'); //Kolom
$SI->setCellValue('E3', 'No. Aset Kendaraan');
$SI->setCellValue('F3', 'CC');
$SI->setCellValue('G3', 'PC');
$SI->setCellValue('H3', 'Depo');
$SI->setCellValue('I3', 'Region');
$SI->setCellValue('J3', 'NIK User');
$SI->setCellValue('K3', 'Nama User');
$SI->setCellValue('L3', 'Cap. Date');
$SI->setCellValue('M3', 'Acquis Value');
$SI->setCellValue('N3', 'Thn Pemakaian');
$SI->setCellValue('O3', 'Status Perangkat');
$SI->setCellValue('P3', 'Status Jual');
$SI->setCellValue('Q3', 'Harga Jual');

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


$strsql	= "SELECT a.*, b.nama_karyawan from kendaraan_peripheral a LEFT JOIN karyawan_perangkat_it b ON a.nik_baru = b.nik_karyawan ORDER BY a.nama_region_peripheral";
$res    = sqlsrv_query($kon, $strsql);
$baris  = 4; //Ini untuk dimulai baris datanya, karena di baris 3 itu digunakan untuk header tabel
$no     = 1;

while ($row = sqlsrv_fetch_array($res)) {
	$sttus = $row['status_perangkat'];
	if($sttus=='1')
	{
		$status_perangkat = 'AKTIF';
	}
	elseif($sttus=='0')
	{
		$status_perangkat = 'NON-AKTIF';
	}
  $SI->setCellValue("A".$baris,$no++); //mengisi data untuk nomor urut
  $SI->setCellValue("B".$baris,$row['no_aset_peripheral']); //mengisi data
  $SI->setCellValue("C".$baris,$row['jenis_peripheral']); //mengisi data
  $SI->setCellValue("D".$baris,$row['desc_peripheral']); //mengisi data
  $SI->setCellValue("E".$baris,$row['no_aset_kendaraan']); //mengisi data
  $SI->setCellValue("F".$baris,$row['cost_center_id']); //mengisi data
  $SI->setCellValue("G".$baris,$row['profit_center_id']); //mengisi data
  $SI->setCellValue("H".$baris,$row['nama_depo_peripheral']); //mengisi data
  $SI->setCellValue("I".$baris,$row['nama_region_peripheral']); //mengisi data
  $SI->setCellValue("J".$baris,$row['nik_baru']); //mengisi data
  $SI->setCellValue("K".$baris,$row['nama_karyawan']); //mengisi data
  $SI->setCellValue("L".$baris,$row['cap_date']); //mengisi data
  $SI->setCellValue("M".$baris,$row['acquis_value']); //mengisi data
  $SI->setCellValue("N".$baris,$row['thn_pemakaian']); //mengisi data
  $SI->setCellValue("O".$baris,$status_perangkat); //mengisi data
  $SI->setCellValue("P".$baris,$row['status_jual']); //mengisi data
  $SI->setCellValue("Q".$baris,$row['harga_jual']); //mengisi data

  $baris++; //looping untuk barisnya
}

//Memberi nama sheet
$excelku->getActiveSheet()->setTitle('Data Aset Peripheral');

$excelku->setActiveSheetIndex(0);

// untuk excel 2007 atau yang berekstensi .xlsx
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename=aset_peripheral'.date("Y-m-d____H:i:s").'.xlsx');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($excelku, 'Excel2007');
$objWriter->save('php://output');
exit;

?>
