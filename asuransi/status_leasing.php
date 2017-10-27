<?php
include 'config.php';
$id_leasing=$_GET['id'];
$det=sqlsrv_query($kon, "select * from asuransi_leasing where id_leasing='$id_leasing'");
while($d=sqlsrv_fetch_array($det)){
	$x = $d['status'];
}
if($x=='1')
	{
		sqlsrv_query($kon, "update asuransi_leasing set status='0' where id_leasing = '$id_leasing'");
	}
	else if($x=='0')
	{
		sqlsrv_query($kon, "update asuransi_leasing set status='1' where id_leasing = '$id_leasing'");
	}
header("location:leasing.php");
?>
