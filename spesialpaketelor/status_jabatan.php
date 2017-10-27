<?php
include 'config.php';
$id_jabatan=$_GET['id'];
$det=sqlsrv_query($kon, "select * from jabatan where id_jabatan='$id_jabatan'");
while($d=sqlsrv_fetch_array($det)){
	$x = $d['status'];
}
if($x=='1')
	{
		sqlsrv_query($kon, "update jabatan set status='0', tipe_aktif = '0' where id_jabatan = '$id_jabatan'");
	}
	else if($x=='0')
	{
		sqlsrv_query($kon, "update jabatan set status='1', tipe_aktif = '1' where id_jabatan = '$id_jabatan'");
	}
header("location:jabatan.php");
?>					
	