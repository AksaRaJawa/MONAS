<?php
include 'config.php';
$nik_karyawan = $_POST['nik_karyawan'];
$nama_karyawan= addslashes($_POST['nama_karyawan']);
$nama_jabatan = strtoupper($_POST['nama_jabatan']);
$id_pc = $_POST['id_pc'];
$id_cc = $_POST['id_cc'];
$nama_depo = $_POST['nama_depo'];
$nama_region = $_POST['nama_region'];
$status = "1";
$sql = sqlsrv_query($kon, "insert into karyawan_perangkat_it values('$nik_karyawan','$nama_karyawan','$nama_jabatan','$id_pc','$id_cc', '".$nama_depo."', '".$nama_region."','$status')");
if($sql)
{
	echo"<script>alert('INPUT DATA SUKSES. TERIMAKASIH');history.go(-1)</script>";
}
else{
	echo"<script>alert('GAGAL INPUT DATA !!!, ADA KESALAHAN INPUT DATA !!');history.go(-1)</script>";
}


 ?>
