<?php 
include 'config.php';
$id_depo=$_POST['id_depo'];
$nama_depo=strtoupper($_POST['nama_depo']);
$nama_region=strtoupper($_POST['nama_region']);

$sql = sqlsrv_query($kon, "update depo set nama_depo='$nama_depo', nama_region='$nama_region' where id_depo='$id_depo'");
if($sql)
{
	echo"<script>alert('EDIT DATA SUKSES. TERIMAKASIH');history.go(-2)</script>";
}
else{
	echo"<script>alert('GAGAL EDIT DATA !!!. SILAHKAN ULANGI KEMBALI');history.go(-1)</script>";
}

?>