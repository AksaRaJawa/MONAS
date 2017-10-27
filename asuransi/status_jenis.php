<?php
include 'config.php';
$id_jenis_biaya=$_GET['id'];
$det=sqlsrv_query($kon, "select * from asuransi_jenis where id_jenis_biaya='$id_jenis_biaya'");
while($d=sqlsrv_fetch_array($det)){
	$x = $d['status'];
}
if($x=='1')
	{
		sqlsrv_query($kon, "update asuransi_jenis set status='0' where id_jenis_biaya = '$id_jenis_biaya'");
	}
	else if($x=='0')
	{
		sqlsrv_query($kon, "update asuransi_jenis set status='1' where id_jenis_biaya = '$id_jenis_biaya'");
	}
header("location:jenis.php");
?>
