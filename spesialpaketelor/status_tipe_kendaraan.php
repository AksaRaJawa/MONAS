<?php
include 'config.php';
$id=$_GET['id'];
$det=sqlsrv_query($kon, "select * from kendaraan_tipekendaraan where id_tipe_kendaraan='$id'");
while($d=sqlsrv_fetch_array($det)){
	$x = $d['status'];
}
if($x=='1')
	{
		sqlsrv_query($kon, "update kendaraan_tipekendaraan set status='0' where id_tipe_kendaraan = '$id'");
	}
	else if($x=='0')
	{
		sqlsrv_query($kon, "update kendaraan_tipekendaraan set status='1' where id_tipe_kendaraan = '$id'");
	}
header("location:tipe_kendaraan.php");
?>
