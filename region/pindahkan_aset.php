<?php 
include 'config.php';
date_default_timezone_set('Asia/Jakarta');
$id_asset = $_POST['id_asset'];
$uname = $_POST['uname'];
$uu_depo = $_POST['uu_depo'];
$uu_region = $_POST['uu_region'];

$nik_dulu = $_POST['nik_dulu'];
$nama_dulu = $_POST['nama_dulu'];
$depo_dulu = $_POST['depo_dulu'];
$tanggal_terima = $_POST['tanggal_terima'];
$nama_kepemilikan = $_POST['nama_kepemilikan'];
$status_modis = $_POST['status_modis'];
$status_device = $_POST['status_device'];

$no_imei=$_POST['no_imei'];
$nama_merk=$_POST['nama_merk'];/////////////////////////
$nama_tipe=$_POST['nama_tipe'];////////////////////////
$no_asset=$_POST['no_asset'];/////////////////////////
$serial_number=$_POST['serial_number'];///////////////

$nik_karyawan=$_POST['nik_karyawan'];
$karyawan = explode("---", $nik_karyawan);
$id_depo=$_POST['id_depo'];
$depo = explode("---", $id_depo);
$status = '1';
$aktifitas = "Memindahkan Data Asset Modis";
$tanggal = date("d/m/Y"); 
$waktu = date("H:i:s");
date_default_timezone_set('Asia/Jakarta');
$tanggal_perubahan = date("d-M-Y");


$sql = sqlsrv_query($kon, "update asset set no_imei = '".$no_imei."', nik_karyawan = '".$karyawan[0]."', id_depo = '".$depo[0]."', nama_region = '".$depo[2]."', uname = '".$uname."' where id_asset='".$id_asset."'");

$sqlsave = sqlsrv_query($kon, "insert into pindahan values ('$no_imei','$nama_merk','$nama_tipe','$no_asset','$nik_dulu','$nama_dulu','$depo_dulu','".$karyawan[0]."','".$karyawan[2]."','".$depo[1]."','$uname','$tanggal_perubahan','$waktu')");

//$upsql = sqlsrv_query("update karyawan set id_depo = '".$depo[0]."', nama_region = '".$depo[1]."' where nik_karyawan = '".$karyawan[0]."' ");
sqlsrv_query($kon, "insert into histori values ('".$tanggal_perubahan."','".$aktifitas."','".$no_imei."','".$nama_merk."','".$nama_tipe."','".$no_asset."','".$serial_number."','".$karyawan[0]."','".$tanggal_terima."','".$nama_kepemilikan."','".$status_modis."','".$status_device."','".$uname."','".$uu_depo."','".$uu_region."','".$waktu."')");

if($sqlsave)
{
	echo"<script>alert('PINDAH ASSET SUKSES. TERIMAKASIH');history.go(-2)</script>";
}
else{
	echo"<script>alert('GAGAL PINDAH ASSET !!!, ADA KESALAHAN INPUT !!');history.go(-1)</script>";
}



?>