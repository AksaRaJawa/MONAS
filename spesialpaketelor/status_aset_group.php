<?php
include 'config.php';
$id_group=$_GET['id'];
$det=sqlsrv_query($kon, "select * from aset_group where id_group='$id_group'");
while($d=sqlsrv_fetch_array($det)){
	$x = $d['status'];
}
if($x=='1')
	{
		sqlsrv_query($kon, "update aset_group set status='0' where id_group = '$id_group'");
	}
	else if($x=='0')
	{
		sqlsrv_query($kon, "update aset_group set status='1' where id_group = '$id_group'");
	}
header("location:aset_group.php");
?>
