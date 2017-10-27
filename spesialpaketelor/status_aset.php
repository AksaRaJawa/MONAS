<?php
include 'config.php';
$id_asset=$_GET['id'];
$det=sqlsrv_query($kon, "select * from asset where id_asset='$id_asset'");
while($d=sqlsrv_fetch_array($det)){
	$x = $d['status'];
}
if($x=='1')
	{
		sqlsrv_query($kon, "update asset set status='0' where id_asset = '$id_asset'");
	}
	else if($x=='0')
	{
		sqlsrv_query($kon, "update asset set status='1' where id_asset = '$id_asset'");
	}
header("location:aset.php");
?>					
	