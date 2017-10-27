<?php
include 'config.php';
$id_merk=$_GET['id'];
$det=sqlsrv_query($kon, "select * from merk where id_merk='$id_merk'");
while($d=sqlsrv_fetch_array($det)){
	$x = $d['status'];
}
if($x=='1')
	{
		sqlsrv_query($kon, "update merk set status='0' where id_merk = '$id_merk'");
	}
	else if($x=='0')
	{
		sqlsrv_query($kon, "update merk set status='1' where id_merk = '$id_merk'");
	}
header("location:merk.php");
?>					
	