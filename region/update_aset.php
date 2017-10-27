<?php
include 'config.php';
date_default_timezone_set('Asia/Jakarta');
$id_asset = $_POST['id_asset'];
$uname = $_POST['uname'];
$uu_depo = $_POST['uu_depo'];
$uu_region = $_POST['uu_region'];
$merk_dulu = $_POST['merk_dulu'];
$no_imei=$_POST['no_imei'];

$nama_merk=$_POST['nama_merk'];
$merk = explode("---", $nama_merk);
//$nama_tipe=$_POST['nama_tipe'];
$no_asset=$_POST['no_asset'];
$serial_number=$_POST['serial_number'];
$id_device=$_POST['id_device'];
$nik_karyawan=$_POST['nik_karyawan'];/////////////////

$nama_kepemilikan=$_POST['nama_kepemilikan'];
$status_modis=$_POST['status_modis'];
$status_device = $_POST['status_device'];
$tanggal_terima=$_POST['tanggal_terima'];
$keterangan=ucwords($_POST['keterangan']);
$status = '1';
$tanggal_beli = '';
$masa_berlaku = '';
$aktifitas = "Merubah Data Asset Modis";
$tanggal = date("d/m/Y");
$waktu = date("H:i:s");
date_default_timezone_set('Asia/Jakarta');
$tanggal_perubahan = date("d-M-Y");

if($merk_dulu=='SAMSUNG')
{
	echo"<script>alert('MAAF --- UNTUK MERK SAMSUNG TIDAK AKAN DIRUBAH !!!');history.go(-1)</script>";
	$sql = sqlsrv_query($kon, "update asset set no_imei = '".$no_imei."', no_asset = '".$no_asset."', serial_number = '".$serial_number."', id_device = '".$id_device."', nama_kepemilikan = '".$nama_kepemilikan."', status_modis = '".$status_modis."',
	status_device = '".$status_device."', tanggal_terima = '".$tanggal_terima."', keterangan = '".$keterangan."', uname = '".$uname."' where id_asset='".$id_asset."'");

	//$upsql = sqlsrv_query($kon, "update karyawan set id_depo = '".$depo[0]."', nama_region = '".$depo[1]."' where nik_karyawan = '".$karyawan[0]."' ");
	sqlsrv_query($kon, "insert into histori values (".$tanggal_perubahan."','".$aktifitas."','".$no_imei."','".$merk[0]."','".$merk[1]."','".$no_asset."','".$serial_number."','".$nik_karyawan."','".$tanggal_terima."','".$nama_kepemilikan."','".$status_modis."','".$status_device."','".$uname."','".$uu_depo."','".$uu_region."','".$waktu."')");

	if($sql)
	{
		echo"<script>alert('UBAH DATA SUKSES. TERIMAKASIH');history.go(-2)</script>";
	}
	else{
		echo"<script>alert('GAGAL UBAH DATA !!!, ADA KESALAHAN INPUT !!');history.go(-1)</script>";
	}

	}
else{
	$sql = sqlsrv_query($kon, "update asset set no_imei = '".$no_imei."', nama_merk = '".$merk[0]."', nama_tipe = '".$merk[1]."', no_asset = '".$no_asset."', serial_number = '".$serial_number."', id_device = '".$id_device."', nama_kepemilikan = '".$nama_kepemilikan."', status_modis = '".$status_modis."',
	status_device = '".$status_device."', tanggal_terima = '".$tanggal_terima."', keterangan = '".$keterangan."', uname = '".$uname."' where id_asset='".$id_asset."'");

	//$upsql = sqlsrv_query($kon, "update karyawan set id_depo = '".$depo[0]."', nama_region = '".$depo[1]."' where nik_karyawan = '".$karyawan[0]."' ");
	sqlsrv_query($kon, "insert into histori values (".$tanggal_perubahan."','".$aktifitas."','".$no_imei."','".$merk[0]."','".$merk[1]."','".$no_asset."','".$serial_number."','".$nik_karyawan."','".$tanggal_terima."','".$nama_kepemilikan."','".$status_modis."','".$status_device."','".$uname."','".$uu_depo."','".$uu_region."','".$waktu."')");

	if($sql)
	{
		echo"<script>alert('UBAH DATA SUKSES. TERIMAKASIH');history.go(-2)</script>";
	}
	else{
		echo"<script>alert('GAGAL UBAH DATA !!!, ADA KESALAHAN INPUT !!');history.go(-1)</script>";
	}

}


?>
