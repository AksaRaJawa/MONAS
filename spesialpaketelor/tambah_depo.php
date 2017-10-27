<?php 
include 'config.php';
$id_depo = $_POST['id_depo'];
$nama_depo=strtoupper($_POST['nama_depo']);
$nama_region=strtoupper($_POST['nama_region']);

$status = "1";

$sql = sqlsrv_query($kon, "insert into depo values('$id_depo','$nama_depo','$nama_region','$status')");
if($sql)
{
	echo"<script>alert('INPUT DATA SUKSES. TERIMAKASIH');history.go(-1)</script>";
}
else{
	echo"<script>alert('GAGAL INPUT DATA !!!, KODE DEPO SUDAH ADA !!');history.go(-1)</script>";
}
//header("location:depo.php");

 ?>