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
$excelku->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$excelku->getActiveSheet()->getColumnDimension('D')->setWidth(40);
$excelku->getActiveSheet()->getColumnDimension('E')->setWidth(30);
$excelku->getActiveSheet()->getColumnDimension('F')->setWidth(30);

// Mergecell, menyatukan beberapa kolom
$excelku->getActiveSheet()->mergeCells('A1:F1');

// Buat Kolom judul tabel
$SI = $excelku->setActiveSheetIndex(0);
$SI->setCellValue('A1', 'SALESMAN YANG SUDAH PAKAI MODIS'); //Judul laporan
$SI->setCellValue('A3', 'No'); //Kolom No
$SI->setCellValue('B3', 'NIK Salesman'); //Kolom
$SI->setCellValue('C3', 'Nama Salesman'); //Kolom
$SI->setCellValue('D3', 'Jabatan'); //Kolom
$SI->setCellValue('E3', 'Depo');
$SI->setCellValue('F3', 'Region');
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
$excelku->getActiveSheet()->setSharedStyle($headerStylenya,"A3:F3");


$strsql	= "SELECT a.nik_karyawan, a.nama_karyawan, a.nama_jabatan, b.nama_depo, a.nama_region from karyawan a
		LEFT JOIN depo b ON a.id_depo = b.id_depo
		LEFT JOIN jabatan c ON a.nama_jabatan = c.nama_jabatan
		WHERE c.butuh_modis = '1' AND a.status = '1' AND a.nik_karyawan IN (select nik_karyawan from asset)";
$res    = sqlsrv_query($kon, $strsql);
$baris  = 4; //Ini untuk dimulai baris datanya, karena di baris 3 itu digunakan untuk header tabel
$no     = 1;

while ($row = sqlsrv_fetch_array($res)) {
  $SI->setCellValue("A".$baris,$no++); //mengisi data untuk nomor urut
  $SI->setCellValue("B".$baris,$row['nik_karyawan']); //mengisi data
  $SI->setCellValue("C".$baris,$row['nama_karyawan']); //mengisi data
  $SI->setCellValue("D".$baris,$row['nama_jabatan']); //mengisi data
  $SI->setCellValue("E".$baris,$row['nama_depo']); //mengisi data
  $SI->setCellValue("F".$baris,$row['nama_region']); //mengisi data
  $baris++; //looping untuk barisnya
}

//Memberi nama sheet
$excelku->getActiveSheet()->setTitle('Salesman Sudah Pakai Modis');

$excelku->setActiveSheetIndex(0);

//====== Sheet 2 ========
$excelku->createSheet();
$excelku->setActiveSheetIndex(1);

$SI2 = $excelku->setActiveSheetIndex(1);

$SI2->setCellValue('A1', 'SALESMAN YANG BELUM PAKAI MODIS'); //Judul laporan
$SI2->setCellValue('A3', 'No'); //Kolom No
$SI2->setCellValue('B3', 'NIK Salesman'); //Kolom
$SI2->setCellValue('C3', 'Nama Salesman'); //Kolom
$SI2->setCellValue('D3', 'Jabatan'); //Kolom
$SI2->setCellValue('E3', 'Depo');
$SI2->setCellValue('F3', 'Region');

$excelku->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$excelku->getActiveSheet()->getColumnDimension('B')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$excelku->getActiveSheet()->getColumnDimension('D')->setWidth(40);
$excelku->getActiveSheet()->getColumnDimension('E')->setWidth(30);
$excelku->getActiveSheet()->getColumnDimension('F')->setWidth(30);

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
$excelku->getActiveSheet()->setSharedStyle($headerStylenya,"A3:F3");


$strsql2	= "SELECT a.nik_karyawan, a.nama_karyawan, a.nama_jabatan, b.nama_depo, a.nama_region from karyawan a
		LEFT JOIN depo b ON a.id_depo = b.id_depo
		LEFT JOIN jabatan c ON a.nama_jabatan = c.nama_jabatan
		WHERE c.butuh_modis = '1' AND a.status = '1' AND a.nik_karyawan NOT IN (select nik_karyawan from asset)";
$res2    = sqlsrv_query($kon, $strsql2);
$baris2  = 4; //Ini untuk dimulai baris datanya, karena di baris 3 itu digunakan untuk header tabel
$no2     = 1;

while ($row2 = sqlsrv_fetch_array($res2)) {
  $SI2->setCellValue("A".$baris2,$no2++); //mengisi data untuk nomor urut
  $SI2->setCellValue("B".$baris2,$row2['nik_karyawan']); //mengisi data
  $SI2->setCellValue("C".$baris2,$row2['nama_karyawan']); //mengisi data
  $SI2->setCellValue("D".$baris2,$row2['nama_jabatan']); //mengisi data
  $SI2->setCellValue("E".$baris2,$row2['nama_depo']); //mengisi data
  $SI2->setCellValue("F".$baris2,$row2['nama_region']); //mengisi data
  $baris2++; //looping untuk barisnya
}

//Memberi nama sheet
$excelku->getActiveSheet()->setTitle('Salesman Belum Pakai Modis');

$excelku->setActiveSheetIndex(1);

//====== Sheet 3 ========
$excelku->createSheet();
$excelku->setActiveSheetIndex(2);

$SI3 = $excelku->setActiveSheetIndex(2);

$SI3->setCellValue('A1', 'JUMLAH MODIS BACKUP'); //Judul laporan
$SI3->setCellValue('A3', 'No'); //Kolom No
$SI3->setCellValue('B3', 'IMEI'); //Kolom
$SI3->setCellValue('C3', 'Merk'); //Kolom
$SI3->setCellValue('D3', 'Tipe'); //Kolom
$SI3->setCellValue('E3', 'No.Aset');
$SI3->setCellValue('F3', 'NIK Salesman');
$SI3->setCellValue('G3', 'Nama Salesman'); //Kolom
$SI3->setCellValue('H3', 'Jabatan'); //Kolom
$SI3->setCellValue('I3', 'Depo');
$SI3->setCellValue('J3', 'Region');

$excelku->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$excelku->getActiveSheet()->getColumnDimension('B')->setWidth(30);
$excelku->getActiveSheet()->getColumnDimension('C')->setWidth(30);
$excelku->getActiveSheet()->getColumnDimension('D')->setWidth(30);
$excelku->getActiveSheet()->getColumnDimension('E')->setWidth(30);
$excelku->getActiveSheet()->getColumnDimension('F')->setWidth(30);
$excelku->getActiveSheet()->getColumnDimension('G')->setWidth(40);
$excelku->getActiveSheet()->getColumnDimension('H')->setWidth(40);
$excelku->getActiveSheet()->getColumnDimension('I')->setWidth(30);
$excelku->getActiveSheet()->getColumnDimension('J')->setWidth(30);

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
$excelku->getActiveSheet()->setSharedStyle($headerStylenya,"A3:J3");


$strsql3	= "SELECT
	a.no_imei,
	a.nama_merk,
	a.nama_tipe,
	a.no_asset,
	a.nik_karyawan,
	c.nama_karyawan,
	c.nama_jabatan,
	b.nama_depo,
	a.nama_region
FROM
	asset a
LEFT JOIN depo b ON a.id_depo = b.id_depo
LEFT JOIN karyawan c ON a.nik_karyawan = c.nik_karyawan
WHERE
	a.status_device = 'Backup'";
$res3    = sqlsrv_query($kon, $strsql3);
$baris3  = 4; //Ini untuk dimulai baris datanya, karena di baris 3 itu digunakan untuk header tabel
$no3     = 1;

while ($row3 = sqlsrv_fetch_array($res3)) {
  $SI3->setCellValue("A".$baris3,$no3++); //mengisi data untuk nomor urut
  $SI3->setCellValue("B".$baris3,$row3['no_imei']); //mengisi data
  $SI3->setCellValue("C".$baris3,$row3['nama_merk']); //mengisi data
  $SI3->setCellValue("D".$baris3,$row3['nama_tipe']); //mengisi data
  $SI3->setCellValue("E".$baris3,$row3['no_asset']); //mengisi data
  $SI3->setCellValue("F".$baris3,$row3['nik_karyawan']); //mengisi data
  $SI3->setCellValue("G".$baris3,$row3['nama_karyawan']); //mengisi data
  $SI3->setCellValue("H".$baris3,$row3['nama_jabatan']); //mengisi data
  $SI3->setCellValue("I".$baris3,$row3['nama_depo']); //mengisi data
  $SI3->setCellValue("J".$baris3,$row3['nama_region']); //mengisi data
  $baris3++; //looping untuk barisnya
}

//Memberi nama sheet
$excelku->getActiveSheet()->setTitle('Jumlah Modis Backup');

$excelku->setActiveSheetIndex(2);

//====== Sheet 4 ========
$excelku->createSheet();
$excelku->setActiveSheetIndex(3);

$SI4 = $excelku->setActiveSheetIndex(3);

$SI4->setCellValue('A1', 'SALESMAN KEPEMILIKAN MODIS 2/LEBIH'); //Judul laporan
$SI4->setCellValue('A3', 'No'); //Kolom No
$SI4->setCellValue('B3', 'NIK Salesman'); //Kolom
$SI4->setCellValue('C3', 'Nama Salesman'); //Kolom
$SI4->setCellValue('D3', 'Depo'); //Kolom
$SI4->setCellValue('E3', 'Jumlah Modis');
$SI4->setCellValue('F3', 'AKTIF');
$SI4->setCellValue('G3', 'NON-AKTIF'); //Kolom


$excelku->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$excelku->getActiveSheet()->getColumnDimension('B')->setWidth(30);
$excelku->getActiveSheet()->getColumnDimension('C')->setWidth(40);
$excelku->getActiveSheet()->getColumnDimension('D')->setWidth(30);
$excelku->getActiveSheet()->getColumnDimension('E')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('F')->setWidth(20);
$excelku->getActiveSheet()->getColumnDimension('G')->setWidth(20);


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
$excelku->getActiveSheet()->setSharedStyle($headerStylenya,"A3:G3");


$strsql4	= "SELECT
						a.nik_karyawan, c.nama_karyawan, b.nama_depo, COUNT(a.nik_karyawan) AS jumlah_modis
					FROM
						asset a
					LEFT JOIN depo b ON a.id_depo = b.id_depo
					LEFT JOIN karyawan c ON a.nik_karyawan = c.nik_karyawan
					WHERE a.nik_karyawan !=' '
					GROUP BY
					a.nik_karyawan, c.nama_karyawan, b.nama_depo
					HAVING
					COUNT (a.nik_karyawan) > 1";
$res4    = sqlsrv_query($kon, $strsql4);
$baris4  = 4; //Ini untuk dimulai baris datanya, karena di baris 3 itu digunakan untuk header tabel
$no4     = 1;

while ($row4 = sqlsrv_fetch_array($res4)) {
	$sttsm = sqlsrv_query($kon, "select COUNT(status_modis) AS jml from asset where nik_karyawan = '".$row4['nik_karyawan']."' AND status_modis = '1'", $param, $option);
	$stb = sqlsrv_fetch_array($sttsm);
	$sttsmx = sqlsrv_query($kon, "select COUNT(status_modis) AS jmlx from asset where nik_karyawan = '".$row4['nik_karyawan']."' AND status_modis = '0'", $param, $option);
	$stbx = sqlsrv_fetch_array($sttsmx);
  $SI4->setCellValue("A".$baris4,$no4++); //mengisi data untuk nomor urut
  $SI4->setCellValue("B".$baris4,$row4['nik_karyawan']); //mengisi data
  $SI4->setCellValue("C".$baris4,$row4['nama_karyawan']); //mengisi data
  $SI4->setCellValue("D".$baris4,$row4['nama_depo']); //mengisi data
  $SI4->setCellValue("E".$baris4,$row4['jumlah_modis']); //mengisi data
  $SI4->setCellValue("F".$baris4,$stb['jml']); //mengisi data
  $SI4->setCellValue("G".$baris4,$stbx['jmlx']); //mengisi data
  $baris4++; //looping untuk barisnya
}

//Memberi nama sheet
$excelku->getActiveSheet()->setTitle('Kepemilikan Double');

$excelku->setActiveSheetIndex(3);

// untuk excel 2007 atau yang berekstensi .xlsx
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename=export_dashboard_'.date("Y-m-d____H:i:s").'.xlsx');
header('Cache-Control: max-age=0');

$objWriter = PHPExcel_IOFactory::createWriter($excelku, 'Excel2007');
$objWriter->save('php://output');
exit;

?>
