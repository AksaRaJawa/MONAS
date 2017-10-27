<?php
include 'config.php';
$id=$_GET['id'];
$det=sqlsrv_query($kon, "select * from [user] where uname='".$id."'");
$d=sqlsrv_fetch_array($det);
	$x = $d['status'];
if($x=='1')
	{
		sqlsrv_query($kon, "update [user] set status='0' where uname = '".$id."'");
	}
	else if($x=='0')
	{
		sqlsrv_query($kon, "update [user] set status='1' where uname = '".$id."'");
	}
header("location:user.php");
?>					
	