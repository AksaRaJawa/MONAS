<?php
include 'config.php';
date_default_timezone_set('Asia/Jakarta');
$thn_sekarang = date("y");
$uname = $_POST['uname'];
$cost_center_dulu=$_POST['cc_dulu'];
$profit_center_dulu=$_POST['pc_dulu'];
$nama_merk=$_POST['nama_merk'];
$nama_tipe=$_POST['nama_tipe'];
$no_aset_kendaraan=$_POST['no_aset_kendaraan'];
$cost_center = $_POST['cost_center'];
$profit_center = $_POST['profit_center'];

$ambildp_ro = sqlsrv_query($kon, "select nama_depo, nama_ro from cost_center where id_cc = '$cost_center' ", $param, $option);
$dp_ro = sqlsrv_fetch_array($ambildp_ro);
$nama_depo = $dp_ro['nama_depo'];
$nama_region = $dp_ro['nama_ro'];
$tanggal = date("d/m/Y");
$tanggal_perubahan = date("d-M-Y");
$waktu = date("H:i:s");


$sql = sqlsrv_query($kon, "update kendaraan_asetkendaraan set cost_center_id = '".$cost_center."', profit_center_id = '".$profit_center."', nama_depo_kendaraan = '".$nama_depo."', nama_region_kendaraan = '".$nama_region."', uname = '".$uname."' where no_aset_kendaraan='".$no_aset_kendaraan."' ");

$sqlsave = sqlsrv_query($kon, "insert into pindahan_kendaraan values ('$no_aset_kendaraan','$nama_merk','$nama_tipe','$cost_center_dulu','$profit_center_dulu','$profit_center_dulu','".$cost_center."','".$profit_center."','".$nama_depo."','".$nama_region."','$uname','$tanggal_perubahan','$waktu')");

if($sql)
{
	echo"<script>alert('PINDAH PERANGKAT SUKSES. TERIMAKASIH');history.go(-2)</script>";
}
else{
	echo"<script>alert('GAGAL PINDAH PERANGKAT !!!. SILAHKAN ULANGI KEMBALI');history.go(-1)</script>";
}

?>
