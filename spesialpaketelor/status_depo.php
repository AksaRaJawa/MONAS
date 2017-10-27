<?php
include 'config.php';
$id_depo=$_GET['id'];
$det=sqlsrv_query($kon, "select * from depo where id_depo='$id_depo'");
while($d=sqlsrv_fetch_array($det)){
	$x = $d['status'];
}
if($x=='1')
	{
		sqlsrv_query($kon, "update depo set status='0' where id_depo = '$id_depo'");
	}
	else if($x=='0')
	{
		sqlsrv_query($kon, "update depo set status='1' where id_depo = '$id_depo'");
	}
header("location:depo.php");
?>					
	