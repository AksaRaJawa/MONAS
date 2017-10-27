<?php
include 'config.php';
$nik_karyawan = $_POST['nik_karyawan'];
$nama_karyawan= addslashes($_POST['nama_karyawan']);
$nama_jabatan = strtoupper($_POST['nama_jabatan']);
$id_pc = $_POST['id_pc'];
$id_cc = $_POST['id_cc'];
$nama_depo = $_POST['nama_depo'];
$nama_region = $_POST['nama_region'];

$sql = sqlsrv_query($kon, "update karyawan_perangkat_it set nama_karyawan='".$nama_karyawan."', nama_jabatan = '".$nama_jabatan."', id_pc = '".$id_pc."', id_cc = '".$id_cc."', nama_depo = '".$nama_depo."', nama_region= '".$nama_region."' where nik_karyawan= '".$nik_karyawan."'");
if($sql)
{
	echo"<script>alert('EDIT DATA SUKSES. TERIMAKASIH');history.go(-2)</script>";
}
else{
	echo"<script>alert('GAGAL EDIT DATA !!!. SILAHKAN ULANGI KEMBALI');history.go(-1)</script>";
}

?>
