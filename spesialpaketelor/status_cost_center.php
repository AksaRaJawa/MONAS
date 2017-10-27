<?php
include 'config.php';
$id_cc=$_GET['id'];
$det=sqlsrv_query($kon, "select * from cost_center where id_cc='$id_cc'");
while($d=sqlsrv_fetch_array($det)){
	$x = $d['status'];
}
if($x=='1')
	{
		sqlsrv_query($kon, "update cost_center set status='0' where id_cc = '$id_cc'");
	}
	else if($x=='0')
	{
		sqlsrv_query($kon, "update cost_center set status='1' where id_cc = '$id_cc'");
	}
header("location:cost_center.php");
?>
